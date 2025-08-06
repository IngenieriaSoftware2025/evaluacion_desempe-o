<?php

namespace Controllers;

use Exception;
use MVC\Router;
use Model\ActiveRecord;
use Model\EvaluacionFormulario;

class EvaluacionFormularioController extends ActiveRecord
{
    public static function renderizarPagina(Router $router)
    {
        $router->render('evaluacionformulario/index', []);
    }

    // API para obtener datos del evaluado (Consulta 1)
    public static function obtenerDatosEvaluadoAPI()
    {
        getHeadersApi();
        try {
            $catalogo = filter_var($_GET['catalogo'], FILTER_SANITIZE_NUMBER_INT);

            $sql = "SELECT 
                        p.per_catalogo as catalogo,
                        p.per_nom1, p.per_nom2, p.per_ape1, p.per_ape2,
                        g.gra_desc_md as grado,
                        p.per_desc_empleo as lugar_alta,
                        d.dep_desc_md as dependencia_alta,
                        o.org_plaza_desc as puesto_ocupa,
                        t.t_puesto as tiempo_ocupar_puesto
                    FROM mper p
                    INNER JOIN grados g ON p.per_grado = g.gra_codigo
                    LEFT JOIN morg o ON p.per_plaza = o.org_plaza
                    LEFT JOIN mdep d ON o.org_dependencia = d.dep_llave
                    LEFT JOIN tiempos t ON p.per_catalogo = t.t_catalogo
                    WHERE p.per_catalogo = {$catalogo}
                    AND g.gra_clase = 4
                    AND p.per_situacion IN (11)";

            $data = self::fetchArray($sql);

            if (empty($data)) {
                http_response_code(404);
                echo json_encode([
                    'codigo' => 0,
                    'mensaje' => 'Especialista no encontrado o no cumple los criterios'
                ]);
                return;
            }

            // Formatear nombre completo
            $especialista = $data[0];
            $especialista['nombre_completo'] = self::formatearNombreCompleto($especialista);

            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'Datos del evaluado obtenidos correctamente',
                'data' => $especialista
            ]);

        } catch (Exception $e) {
            http_response_code(400);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al obtener datos del evaluado',
                'detalle' => $e->getMessage()
            ]);
        }
    }

    // API para obtener datos del evaluador (Consulta 2)
    public static function obtenerDatosEvaluadorAPI()
    {
        getHeadersApi();
        try {
            $catalogo = filter_var($_GET['catalogo'], FILTER_SANITIZE_NUMBER_INT);

            $sql = "SELECT 
                        p.per_catalogo as catalogo,
                        p.per_nom1, p.per_nom2, p.per_ape1, p.per_ape2,
                        g.gra_desc_md as grado,
                        o.org_plaza_desc as puesto_ocupa,
                        o.org_ceom as ceom,
                        t.t_puesto as tiempo_supervisar_evaluado,
                        2025 as anio_evaluacion
                    FROM mper p
                    INNER JOIN grados g ON p.per_grado = g.gra_codigo
                    LEFT JOIN morg o ON p.per_plaza = o.org_plaza
                    LEFT JOIN tiempos t ON p.per_catalogo = t.t_catalogo
                    WHERE p.per_catalogo = {$catalogo}";

            $data = self::fetchArray($sql);

            if (empty($data)) {
                http_response_code(404);
                echo json_encode([
                    'codigo' => 0,
                    'mensaje' => 'Evaluador no encontrado'
                ]);
                return;
            }

            // Formatear nombre completo y validar tiempo
            $evaluador = $data[0];
            $evaluador['nombre_completo'] = self::formatearNombreCompleto($evaluador);
            
            // Validar tiempo mínimo
            $validacion = self::validarTiempoEvaluador($catalogo);
            $evaluador['puede_evaluar'] = $validacion['validacion'] === 'PUEDE_EVALUAR';
            $evaluador['mensaje_validacion'] = $validacion['mensaje'];

            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'Datos del evaluador obtenidos correctamente',
                'data' => $evaluador
            ]);

        } catch (Exception $e) {
            http_response_code(400);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al obtener datos del evaluador',
                'detalle' => $e->getMessage()
            ]);
        }
    }

    // API para validar tiempo mínimo del evaluador (Consulta 3)
    public static function validarTiempoEvaluadorAPI()
    {
        getHeadersApi();
        try {
            $catalogo = filter_var($_GET['catalogo'], FILTER_SANITIZE_NUMBER_INT);

            $validacion = self::validarTiempoEvaluador($catalogo);

            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'Validación realizada',
                'data' => $validacion
            ]);

        } catch (Exception $e) {
            http_response_code(400);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error en la validación',
                'detalle' => $e->getMessage()
            ]);
        }
    }

    // API para guardar la evaluación
    public static function guardarEvaluacionAPI()
    {
        getHeadersApi();
        try {
            // Validaciones básicas
            if (empty($_POST['bol_cat_evaluado'])) {
                http_response_code(400);
                echo json_encode([
                    'codigo' => 0,
                    'mensaje' => 'El catálogo del evaluado es obligatorio'
                ]);
                return;
            }

            if (empty($_POST['bol_cat_evaluador'])) {
                http_response_code(400);
                echo json_encode([
                    'codigo' => 0,
                    'mensaje' => 'El catálogo del evaluador es obligatorio'
                ]);
                return;
            }

            // Validar que el evaluador puede evaluar
            $validacion = self::validarTiempoEvaluador($_POST['bol_cat_evaluador']);
            if ($validacion['validacion'] !== 'PUEDE_EVALUAR') {
                http_response_code(400);
                echo json_encode([
                    'codigo' => 0,
                    'mensaje' => $validacion['mensaje']
                ]);
                return;
            }

            // Verificar si ya existe una evaluación
            if (self::existeEvaluacion($_POST['bol_cat_evaluado'], $_POST['bol_anio'] ?? 2025)) {
                http_response_code(400);
                echo json_encode([
                    'codigo' => 0,
                    'mensaje' => 'Ya existe una evaluación para este especialista en el año ' . ($_POST['bol_anio'] ?? 2025)
                ]);
                return;
            }

            // Crear y guardar la evaluación
            $evaluacion = new EvaluacionFormulario($_POST);
            $resultado = $evaluacion->crear();

            if ($resultado['resultado'] == 1) {
                http_response_code(200);
                echo json_encode([
                    'codigo' => 1,
                    'mensaje' => 'Evaluación guardada correctamente'
                ]);
            } else {
                http_response_code(500);
                echo json_encode([
                    'codigo' => 0,
                    'mensaje' => 'Error al guardar la evaluación'
                ]);
            }

        } catch (Exception $e) {
            http_response_code(400);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al procesar la evaluación',
                'detalle' => $e->getMessage()
            ]);
        }
    }

    // Función privada para validar tiempo del evaluador
    private static function validarTiempoEvaluador($catalogo)
    {
        $sql = "SELECT 
                    t_catalogo,
                    t_puesto,
                    CASE 
                        WHEN t_puesto >= 3 THEN 'PUEDE_EVALUAR'
                        ELSE 'NO_PUEDE_EVALUAR'
                    END as validacion
                FROM tiempos 
                WHERE t_catalogo = {$catalogo}";

        $data = self::fetchArray($sql);

        if (empty($data)) {
            return [
                'validacion' => 'NO_PUEDE_EVALUAR',
                'mensaje' => 'No se encontraron datos de tiempo para este evaluador'
            ];
        }

        $resultado = $data[0];
        
        if ($resultado['validacion'] === 'PUEDE_EVALUAR') {
            $resultado['mensaje'] = 'El evaluador cumple con el tiempo mínimo requerido';
        } else {
            $meses = $resultado['t_puesto'] ?? 0;
            $resultado['mensaje'] = "El evaluador solo tiene {$meses} meses en el puesto. Se requieren mínimo 3 meses para poder evaluar.";
        }

        return $resultado;
    }

    // Función privada para verificar si existe evaluación
    private static function existeEvaluacion($catalogo_evaluado, $anio)
    {
        $sql = "SELECT COUNT(*) as total 
                FROM eva_boleta 
                WHERE bol_cat_evaluado = {$catalogo_evaluado} 
                AND bol_anio = {$anio}";

        $resultado = self::fetchArray($sql);
        return $resultado[0]['total'] > 0;
    }

    // Función privada para formatear nombre completo
    private static function formatearNombreCompleto($datos)
    {
        if (!$datos) return 'N/A';

        $nombre = trim($datos['per_nom1']) . ' ';
        $nombre .= !empty($datos['per_nom2']) ? trim($datos['per_nom2']) . ' ' : '';
        $nombre .= trim($datos['per_ape1']) . ' ';
        $nombre .= !empty($datos['per_ape2']) ? trim($datos['per_ape2']) : '';

        return trim($nombre);
    }

    // API para eliminar evaluación
    public static function eliminarEvaluacionAPI()
    {
        getHeadersApi();
        try {
            $catalogo_evaluado = filter_var($_GET['catalogo'], FILTER_SANITIZE_NUMBER_INT);
            $anio = filter_var($_GET['anio'], FILTER_SANITIZE_NUMBER_INT) ?? 2025;

            $sql = "DELETE FROM eva_boleta 
                    WHERE bol_cat_evaluado = {$catalogo_evaluado} 
                    AND bol_anio = {$anio}";
            
            self::SQL($sql);

            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'Evaluación eliminada correctamente'
            ]);

        } catch (Exception $e) {
            http_response_code(400);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al eliminar la evaluación',
                'detalle' => $e->getMessage()
            ]);
        }
    }







    public static function obtenerPafesEvaluadoAPI()
{
    getHeadersApi();
    try {
        $catalogo = filter_var($_GET['catalogo'], FILTER_SANITIZE_NUMBER_INT);
        $anio_actual = 2025; // Año fijo según requerimientos
        $mes_actual = 8; // Agosto
        
        // Calcular los últimos 4 meses
        $meses = [];
        for ($i = 3; $i >= 0; $i--) {
            $mes = $mes_actual - $i;
            $anio = $anio_actual;
            
            // Ajustar si el mes es menor a 1 (año anterior)
            if ($mes <= 0) {
                $mes += 12;
                $anio--;
            }
            
            $meses[] = [
                'mes' => str_pad($mes, 2, '0', STR_PAD_LEFT),
                'anio' => $anio,
                'nombre' => self::obtenerNombreMes($mes)
            ];
        }

        $evaluaciones = [];
        $puntajes = [];

        // Consultar cada mes
        foreach ($meses as $index => $periodo) {
            $fecha_inicio = "{$periodo['anio']}-{$periodo['mes']}-01";
            $fecha_fin = "{$periodo['anio']}-{$periodo['mes']}-31";

            $sql = "SELECT not_promedio, not_fecha 
                    FROM opaf_notas 
                    WHERE not_catalogo = {$catalogo} 
                    AND not_fecha >= '{$fecha_inicio}' 
                    AND not_fecha <= '{$fecha_fin}'
                    ORDER BY not_fecha DESC 
                    LIMIT 1";

            $resultado = self::fetchArray($sql);

            if (!empty($resultado)) {
                $puntaje = (int) $resultado[0]['not_promedio'];
                $evaluaciones[] = [
                    'mes' => $periodo['nombre'],
                    'puntaje' => $puntaje,
                    'fecha' => $resultado[0]['not_fecha']
                ];
                $puntajes[] = $puntaje;
            } else {
                // No hay PAFE en este mes
                $evaluaciones[] = [
                    'mes' => $periodo['nombre'],
                    'puntaje' => 0,
                    'fecha' => null
                ];
                $puntajes[] = 0;
            }
        }

        // Calcular promedio
        $promedio = array_sum($puntajes) / 4;
        
        // Determinar rango de puntos PAFE
        $puntos_pafe = self::calcularPuntosPafe($promedio);

        $respuesta = [
            'evaluaciones' => $evaluaciones,
            'puntajes' => $puntajes, // [eva1, eva2, eva3, eva4]
            'promedio' => round($promedio, 2),
            'puntos_pafe' => $puntos_pafe,
            'rango_texto' => self::obtenerTextoRango($puntos_pafe),
            'meses_consultados' => array_column($meses, 'nombre')
        ];

        http_response_code(200);
        echo json_encode([
            'codigo' => 1,
            'mensaje' => 'Evaluaciones PAFE obtenidas correctamente',
            'data' => $respuesta
        ]);

    } catch (Exception $e) {
        http_response_code(400);
        echo json_encode([
            'codigo' => 0,
            'mensaje' => 'Error al obtener evaluaciones PAFE',
            'detalle' => $e->getMessage()
        ]);
    }
}


 // Calcular puntos PAFE según el promedio

private static function calcularPuntosPafe($promedio)
{
    if ($promedio >= 91) return 5;
    if ($promedio >= 81) return 4;
    if ($promedio >= 71) return 3;
    if ($promedio >= 60) return 2;
    return 0;
}


  //Obtener texto descriptivo del rango

private static function obtenerTextoRango($puntos)
{
    $rangos = [
        0 => 'De 0 a 59 puntos',
        2 => 'De 60 a 70 puntos', 
        3 => 'De 71 a 80 puntos',
        4 => 'De 81 a 90 puntos',
        5 => 'De 91 a más puntos'
    ];
    
    return $rangos[$puntos] ?? 'Rango no definido';
}


  //Obtener nombre del mes

private static function obtenerNombreMes($mes)
{
    $meses = [
        1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril',
        5 => 'Mayo', 6 => 'Junio', 7 => 'Julio', 8 => 'Agosto',
        9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre'
    ];
    
    return $meses[$mes] ?? 'Mes inválido';
}
}