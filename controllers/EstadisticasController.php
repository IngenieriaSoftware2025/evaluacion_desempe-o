<?php

namespace Controllers;

use Exception;
use MVC\Router;
use Model\ActiveRecord;

class EstadisticasController extends ActiveRecord
{
    public static function renderizarPagina(Router $router)
    {
        $router->render('estadisticas/index', []);
    }

    // DISTRIBUCIÓN POR CATEGORÍAS
    public static function buscarAPI()
    {
        getHeadersApi();
        try {
            $sql = "SELECT 
                        CASE 
                            WHEN eb.bol_total >= 85 THEN 'Excelente'
                            WHEN eb.bol_total >= 70 THEN 'Muy Bueno'
                            WHEN eb.bol_total >= 55 THEN 'Regular'
                            ELSE 'Insatisfactorio'
                        END as categoria,
                        COUNT(*) as cantidad,
                        CASE 
                            WHEN eb.bol_total >= 85 THEN 1
                            WHEN eb.bol_total >= 70 THEN 2
                            WHEN eb.bol_total >= 55 THEN 3
                            ELSE 4
                        END as orden
                    FROM eva_boleta eb
                    INNER JOIN mper p ON eb.bol_cat_evaluado = p.per_catalogo
                    INNER JOIN morg o ON p.per_plaza = o.org_plaza
                    INNER JOIN grados g ON p.per_grado = g.gra_codigo
                    WHERE eb.bol_total IS NOT NULL 
                      AND eb.bol_total > 0
                      AND o.org_dependencia = 10030
                      AND g.gra_clase = 4
                      AND p.per_situacion IN (11)
                    GROUP BY categoria, orden
                    ORDER BY orden";
            
            $categorias = self::fetchArray($sql);

            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'Categorías obtenidas correctamente',
                'data' => $categorias
            ]);
        } catch (Exception $e) {
            http_response_code(400);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al obtener categorías',
                'detalle' => $e->getMessage()
            ]);
        }
    }

    // APTOS PARA ASCENSO
    public static function aptosAscensoAPI()
    {
        getHeadersApi();
        try {
            $sqlAptos = "SELECT COUNT(*) as aptos
                        FROM eva_boleta eb
                        INNER JOIN mper p ON eb.bol_cat_evaluado = p.per_catalogo
                        INNER JOIN morg o ON p.per_plaza = o.org_plaza
                        INNER JOIN grados g ON p.per_grado = g.gra_codigo
                        WHERE eb.bol_total >= 70
                          AND eb.bol_eva2 IS NOT NULL 
                          AND eb.bol_eva2 > 0
                          AND eb.bol_eva3 IS NOT NULL 
                          AND eb.bol_eva3 > 0 
                          AND eb.bol_eva4 IS NOT NULL 
                          AND eb.bol_eva4 > 0
                          AND eb.bol_total_salud IS NOT NULL
                          AND o.org_dependencia = 10030
                          AND g.gra_clase = 4
                          AND p.per_situacion IN (11)";
            
            $aptos = self::fetchArray($sqlAptos);
            
            $sqlTotal = "SELECT COUNT(*) as total 
                        FROM eva_boleta eb
                        INNER JOIN mper p ON eb.bol_cat_evaluado = p.per_catalogo
                        INNER JOIN morg o ON p.per_plaza = o.org_plaza
                        INNER JOIN grados g ON p.per_grado = g.gra_codigo
                        WHERE eb.bol_total IS NOT NULL 
                          AND eb.bol_total > 0
                          AND o.org_dependencia = 10030
                          AND g.gra_clase = 4
                          AND p.per_situacion IN (11)";
            
            $total = self::fetchArray($sqlTotal);
            
            $aptosCount = $aptos[0]['aptos'] ?? 0;
            $totalCount = $total[0]['total'] ?? 0;
            $noAptos = $totalCount - $aptosCount;
            
            $resultado = [
                ['tipo' => 'Aptos', 'cantidad' => $aptosCount],
                ['tipo' => 'No Aptos', 'cantidad' => $noAptos]
            ];

            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'Aptos para ascenso obtenidos correctamente',
                'data' => $resultado
            ]);
        } catch (Exception $e) {
            http_response_code(400);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al obtener aptos para ascenso',
                'detalle' => $e->getMessage()
            ]);
        }
    }

    // ESTADÍSTICAS PAFE
    public static function pafesAPI()
    {
        getHeadersApi();
        try {
            $sql = "SELECT 
                        CASE 
                            WHEN (eb.bol_eva2 IS NOT NULL AND eb.bol_eva2 > 0) 
                                 AND (eb.bol_eva3 IS NOT NULL AND eb.bol_eva3 > 0)
                                 AND (eb.bol_eva4 IS NOT NULL AND eb.bol_eva4 > 0)
                                 AND (eb.bol_total_salud IS NOT NULL) THEN 4
                            WHEN (eb.bol_eva2 IS NOT NULL AND eb.bol_eva2 > 0) 
                                 AND (eb.bol_eva3 IS NOT NULL AND eb.bol_eva3 > 0)
                                 AND (eb.bol_eva4 IS NOT NULL AND eb.bol_eva4 > 0) THEN 3
                            WHEN (eb.bol_eva2 IS NOT NULL AND eb.bol_eva2 > 0) 
                                 AND (eb.bol_eva3 IS NOT NULL AND eb.bol_eva3 > 0) THEN 2
                            WHEN (eb.bol_eva2 IS NOT NULL AND eb.bol_eva2 > 0) THEN 1
                            ELSE 0
                        END as pafes_completos,
                        COUNT(*) as cantidad
                    FROM eva_boleta eb
                    INNER JOIN mper p ON eb.bol_cat_evaluado = p.per_catalogo
                    INNER JOIN morg o ON p.per_plaza = o.org_plaza
                    INNER JOIN grados g ON p.per_grado = g.gra_codigo
                    WHERE o.org_dependencia = 10030
                      AND g.gra_clase = 4
                      AND p.per_situacion IN (11)
                    GROUP BY pafes_completos
                    ORDER BY pafes_completos DESC";
            
            $pafes = self::fetchArray($sql);

            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'Estadísticas PAFE obtenidas correctamente',
                'data' => $pafes
            ]);
        } catch (Exception $e) {
            http_response_code(400);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al obtener estadísticas PAFE',
                'detalle' => $e->getMessage()
            ]);
        }
    }

    // RANKING DE ARRESTOS
    public static function arrestosAPI()
    {
        getHeadersApi();
        try {
            $sql = "SELECT 
                        eb.bol_cat_evaluado,
                        TRIM(g.gra_desc_md) || ' ' || TRIM(p.per_nom1) || ' ' || TRIM(p.per_nom2) || ' ' || TRIM(p.per_ape1) || ' ' || TRIM(p.per_ape2) as nombre,
                        MAX(eb.bol_arrestos) as arrestos
                    FROM eva_boleta eb
                    INNER JOIN mper p ON eb.bol_cat_evaluado = p.per_catalogo
                    INNER JOIN morg o ON p.per_plaza = o.org_plaza
                    INNER JOIN grados g ON p.per_grado = g.gra_codigo
                    WHERE eb.bol_arrestos IS NOT NULL 
                      AND eb.bol_arrestos > 0
                      AND o.org_dependencia = 10030
                      AND g.gra_clase = 4
                      AND p.per_situacion IN (11)
                    GROUP BY eb.bol_cat_evaluado, g.gra_desc_md, p.per_nom1, p.per_nom2, p.per_ape1, p.per_ape2
                    ORDER BY MAX(eb.bol_arrestos) DESC, eb.bol_cat_evaluado ASC
                    LIMIT 10";
            
            $arrestos = self::fetchArray($sql);

            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'Ranking de arrestos obtenido correctamente',
                'data' => $arrestos
            ]);
        } catch (Exception $e) {
            http_response_code(400);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al obtener ranking de arrestos',
                'detalle' => $e->getMessage()
            ]);
        }
    }
}