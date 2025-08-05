<?php

namespace Controllers;

use Exception;
use MVC\Router;
use Model\ActiveRecord;

class EvaluacionEspecialistasController extends ActiveRecord
{
    public static function renderizarPagina(Router $router)
    {
        $router->render('evaluacionespecialistas/index', []);
    }

    public static function buscarAPI()
    {
        try {
            $catalogo = isset($_GET['catalogo']) ? trim($_GET['catalogo']) : null;
            $nombre = isset($_GET['nombre']) ? trim($_GET['nombre']) : null;
            $apellido = isset($_GET['apellido']) ? trim($_GET['apellido']) : null;
            $grado = isset($_GET['grado']) ? trim($_GET['grado']) : null;
            $dependencia = isset($_GET['dependencia']) ? trim($_GET['dependencia']) : null;
            $periodo = isset($_GET['periodo']) ? trim($_GET['periodo']) : null;

            $condiciones = ["1=1"];

            // Filtros
            if ($catalogo && $catalogo !== '') {
                $condiciones[] = "p.per_catalogo = {$catalogo}";
            }

            if ($nombre && $nombre !== '') {
                $nombre_upper = strtoupper($nombre);
                $condiciones[] = "(UPPER(p.per_nom1) LIKE '%{$nombre_upper}%' OR UPPER(p.per_nom2) LIKE '%{$nombre_upper}%')";
            }

            if ($apellido && $apellido !== '') {
                $apellido_upper = strtoupper($apellido);
                $condiciones[] = "(UPPER(p.per_ape1) LIKE '%{$apellido_upper}%' OR UPPER(p.per_ape2) LIKE '%{$apellido_upper}%')";
            }

            if ($grado && $grado !== '') {
                $grado_upper = strtoupper($grado);
                $condiciones[] = "UPPER(g.gra_desc_md) LIKE '%{$grado_upper}%'";
            }

            if ($dependencia && $dependencia !== '') {
                $dependencia_upper = strtoupper($dependencia);
                $condiciones[] = "UPPER(d.dep_desc_md) LIKE '%{$dependencia_upper}%'";
            }

            if ($periodo && $periodo !== '') {
                $condiciones[] = "ev.eva_periodo[1,4] = '{$periodo}'";
            }

            $where = implode(" AND ", $condiciones);

            // FILTRAR SOLO ESPECIALISTAS (gra_clase = 4)
            $where .= " AND g.gra_clase = 4";

            // CONSULTA CORREGIDA CON TODOS LOS CAMPOS REALES
            $sql = "SELECT FIRST 50
                        CASE 
                            WHEN ev.eva_id IS NOT NULL THEN ev.eva_id
                            ELSE 0
                        END as evaluacion,
                        p.per_catalogo as catalogo,
                        NVL(g.gra_desc_md, 'SIN GRADO') as grado,
                        TRIM(
                            NVL(p.per_nom1, '') || ' ' || 
                            NVL(p.per_nom2, '') || ' ' || 
                            NVL(p.per_ape1, '') || ' ' || 
                            NVL(p.per_ape2, '')
                        ) as nombre_completo,
                        NVL(d.dep_desc_md, 'SIN DEPENDENCIA') as dependencia,
                        CASE
                            WHEN p.per_desc_empleo IS NOT NULL THEN TRIM(p.per_desc_empleo)
                            ELSE NVL(g.gra_desc_md, 'SIN EMPLEO')
                        END as empleo,
                        CASE 
                            WHEN ev.eva_situacion = 1 THEN 'ACTIVO'
                            WHEN ev.eva_situacion = 0 THEN 'INACTIVO'
                            ELSE 'SIN EVALUACION'
                        END as situacion,
                        NVL(n.not_nota, 0) as nota
                    FROM mper p
                    LEFT OUTER JOIN grados g ON p.per_grado = g.gra_codigo
                    LEFT OUTER JOIN morg o ON p.per_catalogo = o.org_plaza
                    LEFT OUTER JOIN mdep d ON o.org_dependencia = d.dep_llave
                    LEFT OUTER JOIN eva_evaluacion ev ON p.per_catalogo = ev.eva_cat1
                    LEFT OUTER JOIN eva_notas n ON ev.eva_id = n.not_evaluacion
                    WHERE $where 
                    ORDER BY 
                        CASE 
                            WHEN p.per_situacion IN ('11', 'T0', '12', '1*', '13') THEN 1
                            ELSE 2
                        END,
                        p.per_catalogo";

            $data = self::fetchArray($sql);

            // Limpiar datos
            foreach ($data as &$row) {
                if (isset($row['nombre_completo'])) {
                    $row['nombre_completo'] = preg_replace('/\s+/', ' ', trim($row['nombre_completo']));
                }
                foreach ($row as $key => &$value) {
                    if (is_string($value)) {
                        $value = trim($value);
                    }
                }
            }

            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'Búsqueda realizada correctamente',
                'data' => $data,
                'total' => count($data)
            ]);

        } catch (Exception $e) {
            http_response_code(400);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error en la búsqueda',
                'detalle' => $e->getMessage(),
                'linea' => $e->getLine(),
                'archivo' => $e->getFile()
            ]);
        }
    }

    public static function obtenerGradosAPI()
    {
        getHeadersApi();
        try {
            // FILTRAR SOLO GRADOS DE ESPECIALISTAS (gra_clase = 4)
            $sql = "SELECT gra_desc_md as grado 
                    FROM grados 
                    WHERE gra_clase = 4
                    AND gra_desc_md IS NOT NULL
                    AND LENGTH(TRIM(gra_desc_md)) > 0
                    ORDER BY gra_desc_md";

            $grados = self::fetchArray($sql);

            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'Grados obtenidos correctamente',
                'data' => $grados
            ]);
        } catch (Exception $e) {
            http_response_code(400);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al obtener grados',
                'detalle' => $e->getMessage()
            ]);
        }
    }

    public static function obtenerDependenciasAPI()
    {
        getHeadersApi();
        try {
            $sql = "SELECT DISTINCT dep_desc_md as dependencia 
                    FROM mdep 
                    WHERE dep_desc_md IS NOT NULL 
                    AND LENGTH(dep_desc_md) > 0
                    ORDER BY dep_desc_md";

            $dependencias = self::fetchArray($sql);

            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'Dependencias obtenidas correctamente',
                'data' => $dependencias
            ]);
        } catch (Exception $e) {
            http_response_code(400);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al obtener dependencias',
                'detalle' => $e->getMessage()
            ]);
        }
    }

    public static function obtenerPeriodosAPI()
    {
        getHeadersApi();
        try {
            $sql = "SELECT DISTINCT eva_periodo[1,4] as periodo 
                    FROM eva_evaluacion 
                    WHERE eva_periodo IS NOT NULL 
                    ORDER BY eva_periodo[1,4] DESC";

            $periodos = self::fetchArray($sql);

            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'Periodos obtenidos correctamente',
                'data' => $periodos
            ]);
        } catch (Exception $e) {
            http_response_code(400);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al obtener periodos',
                'detalle' => $e->getMessage()
            ]);
        }
    }

    public static function eliminarAPI()
    {
        try {
            $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
            
            $sql = "UPDATE eva_evaluacion SET eva_situacion = 0 WHERE eva_id = {$id}";
            self::SQL($sql);

            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'La evaluación ha sido eliminada correctamente'
            ]);
        } catch (Exception $e) {
            http_response_code(400);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al eliminar',
                'detalle' => $e->getMessage(),
            ]);
        }
    }

    public static function obtenerDetalleAPI()
    {
        try {
            $catalogo = filter_var($_GET['catalogo'], FILTER_SANITIZE_NUMBER_INT);

            $sql = "SELECT 
                        p.*,
                        ev.*,
                        NVL(g.gra_desc_md, 'SIN GRADO') as grado_desc,
                        TRIM(
                            NVL(p.per_nom1, '') || ' ' || 
                            NVL(p.per_nom2, '') || ' ' || 
                            NVL(p.per_ape1, '') || ' ' || 
                            NVL(p.per_ape2, '')
                        ) as nombre_completo,
                        NVL(d.dep_desc_md, 'SIN DEPENDENCIA') as dependencia_actual,
                        NVL(p.per_desc_empleo, 'SIN EMPLEO') as empleo_actual,
                        NVL(n.not_nota, 0) as nota_final
                    FROM mper p
                    LEFT OUTER JOIN grados g ON p.per_grado = g.gra_codigo
                    LEFT OUTER JOIN morg o ON p.per_catalogo = o.org_plaza
                    LEFT OUTER JOIN mdep d ON o.org_dependencia = d.dep_llave
                    LEFT OUTER JOIN eva_evaluacion ev ON p.per_catalogo = ev.eva_cat1
                    LEFT OUTER JOIN eva_notas n ON ev.eva_id = n.not_evaluacion
                    WHERE p.per_catalogo = {$catalogo}
                    AND g.gra_clase = 4";

            $data = self::fetchArray($sql);

            if (empty($data)) {
                http_response_code(404);
                echo json_encode([
                    'codigo' => 0,
                    'mensaje' => 'Especialista no encontrado'
                ]);
                return;
            }

            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'Detalle obtenido correctamente',
                'data' => $data[0]
            ]);
        } catch (Exception $e) {
            http_response_code(400);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al obtener detalle',
                'detalle' => $e->getMessage(),
            ]);
        }
    }
}