<?php

namespace Controllers;

use Exception;
use MVC\Router;
use Model\ActiveRecord;

class EvaluacionEspecialistasController extends ActiveRecord
{
    // RENDERIZAR PÁGINA PRINCIPAL
    public static function renderizarPagina(Router $router)
    {
        $router->render('evaluacionespecialistas/index', []);
    }

    // BUSCAR ESPECIALISTAS POR CATÁLOGO Y GRADO
    public static function buscarAPI()
    {
        getHeadersApi();
        try {
            $catalogo = isset($_GET['catalogo']) ? trim($_GET['catalogo']) : null;
            $grado = isset($_GET['grado']) ? trim($_GET['grado']) : null;

            // CONDICIONES BASE PARA ESPECIALISTAS ACTIVOS
            $condiciones = [
                "org_dependencia = 10030",
                "gra_clase = 4", 
                "per_situacion in (11)"
            ];

            // FILTRO POR CATÁLOGO
            if ($catalogo && $catalogo !== '') {
                $condiciones[] = "per_catalogo = {$catalogo}";
            }

            // FILTRO POR GRADO
            if ($grado && $grado !== '') {
                $grado_escaped = str_replace("'", "''", $grado);
                $condiciones[] = "UPPER(gra_desc_md) LIKE UPPER('%{$grado_escaped}%')";
            }

            $where = implode(" AND ", $condiciones);

            // CONSULTA PRINCIPAL
            $sql = "SELECT per_catalogo as catalogo,  
                           TRIM(gra_desc_md) || ' ' || TRIM(per_nom1) || ' ' || TRIM(per_nom2) || ' ' || TRIM(per_ape1) || ' ' || TRIM(per_ape2) AS nombre_completo,
                           org_plaza_desc AS plaza,
                           TRIM(gra_desc_md) as grado
                    FROM morg 
                    INNER JOIN mper on per_plaza = org_plaza
                    INNER JOIN grados on per_grado = gra_codigo
                    WHERE $where
                    ORDER BY per_catalogo";

            $data = self::fetchArray($sql);

            // LIMPIAR DATOS
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
                'mensaje' => 'Datos obtenidos correctamente',
                'data' => $data,
                'total' => count($data)
            ]);

        } catch (Exception $e) {
            http_response_code(400);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error en la búsqueda',
                'detalle' => $e->getMessage()
            ]);
        }
    }

    // OBTENER GRADOS DISPONIBLES PARA EL FILTRO
    public static function obtenerGradosAPI()
    {
        getHeadersApi();
        try {
            $sql = "SELECT DISTINCT gra_desc_md as grado 
                    FROM morg 
                    INNER JOIN mper ON per_plaza = org_plaza
                    INNER JOIN grados ON per_grado = gra_codigo
                    WHERE gra_clase = 4
                    AND per_situacion IN (11)
                    AND org_dependencia = 10030
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
}









