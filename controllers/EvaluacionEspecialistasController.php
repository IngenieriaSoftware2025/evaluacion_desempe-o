<?php

namespace Controllers;

use Exception;
use MVC\Router;
use Model\ActiveRecord;
use Model\EvaluacionEspecialistas;

class EvaluacionEspecialistasController extends ActiveRecord
{
    public static function renderizarPagina(Router $router)
    {
         
        $router->render('evaluacionespecialistas/index', []);
    }

   public static function buscarAPI()
{
    error_log("DEBUG: Entrando a buscarAPI");
    
    try {
        $catalogo = isset($_GET['catalogo']) ? trim($_GET['catalogo']) : null;
        $grado = isset($_GET['grado']) ? trim($_GET['grado']) : null;

        // Condiciones base con tu filtro ya definido
        $condiciones = [
            "org_dependencia = 10030",  // Tu filtro específico
            "gra_clase = 4", 
            "per_situacion in (11)"
        ];

        // Filtros adicionales
        if ($catalogo && $catalogo !== '') {
            $condiciones[] = "per_catalogo = {$catalogo}";
        }

        if ($grado && $grado !== '') {
            $grado_escaped = str_replace("'", "''", $grado);
            $condiciones[] = "UPPER(gra_desc_md) LIKE UPPER('%{$grado_escaped}%')";
        }

        $where = implode(" AND ", $condiciones);

        // TU CONSULTA EXACTA
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

        error_log("DEBUG: Query ejecutado, filas encontradas: " . count($data));

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
        // FILTRAR SOLO GRADOS DE LA DEPENDENCIA 10030
        $sql = "SELECT DISTINCT gra_desc_md as grado 
                FROM morg 
                INNER JOIN mper ON per_plaza = org_plaza
                INNER JOIN grados ON per_grado = gra_codigo
                WHERE gra_clase = 4
                AND per_situacion IN (11)
                AND org_dependencia = 10030  -- FILTRO PARA LA DEPENDENCIA ESPECÍFICA
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
            // Obtener solo dependencias que están en morg
            $sql = "SELECT DISTINCT d.dep_desc_md as dependencia 
                    FROM morg 
                    INNER JOIN mper ON per_plaza = org_plaza
                    INNER JOIN grados ON per_grado = gra_codigo
                    LEFT JOIN mdep d ON org_dependencia = d.dep_llave
                    WHERE gra_clase = 4
                    AND per_situacion IN (11)
                    AND d.dep_desc_md IS NOT NULL 
                    AND LENGTH(TRIM(d.dep_desc_md)) > 0
                    ORDER BY d.dep_desc_md";

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

    public static function obtenerDetalleAPI()
{
    try {
        $catalogo = filter_var($_GET['catalogo'], FILTER_SANITIZE_NUMBER_INT);

        $sql = "SELECT 
                    per_catalogo as catalogo,
                    TRIM(gra_desc_md) || ' ' || TRIM(per_nom1) || ' ' || TRIM(per_nom2) || ' ' || TRIM(per_ape1) || ' ' || TRIM(per_ape2) AS nombre_completo,
                    TRIM(gra_desc_md) as grado,
                    NVL(d.dep_desc_md, 'SIN DEPENDENCIA') as dependencia,
                    per_nom1, per_nom2, per_ape1, per_ape2,
                    per_situacion,
                    org_plaza_desc as plaza
                FROM morg 
                INNER JOIN mper ON per_plaza = org_plaza
                INNER JOIN grados ON per_grado = gra_codigo
                LEFT JOIN mdep d ON org_dependencia = d.dep_llave
                WHERE per_catalogo = {$catalogo}
                AND gra_clase = 4
                AND per_situacion IN (11)
                AND org_dependencia = 10030"; 

        $data = self::fetchArray($sql);

        if (empty($data)) {
            http_response_code(404);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Especialista no encontrado en la dependencia especificada'
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

    public static function eliminarAPI()
    {
        
        try {
            $catalogo = filter_var($_GET['catalogo'], FILTER_SANITIZE_NUMBER_INT);
            
            // Para eliminar, cambiar situación del personal
            $sql = "UPDATE mper SET per_situacion = 0 WHERE per_catalogo = {$catalogo}";
            self::SQL($sql);

            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'El registro ha sido eliminado correctamente'
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
}