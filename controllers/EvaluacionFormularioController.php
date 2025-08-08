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

    public static function renderizarPagina2(Router $router)
    {
        $router->render('evaluacionformulario/index2', []);
    }

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

            $especialista = $data[0];
            $especialista['nombre_completo'] = self::formatearNombreCompleto($especialista);

            // Validar tiempo mínimo del evaluado (3+ meses)
            $validacionEvaluado = self::validarTiempoMinimo($especialista['tiempo_ocupar_puesto']);
            $especialista['puede_ser_evaluado'] = $validacionEvaluado['puede'];
            $especialista['mensaje_tiempo'] = $validacionEvaluado['mensaje'];

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

            $evaluador = $data[0];
            $evaluador['nombre_completo'] = self::formatearNombreCompleto($evaluador);

            // Validar tiempo mínimo del evaluador (3+ meses)
            $validacionEvaluador = self::validarTiempoMinimo($evaluador['tiempo_supervisar_evaluado']);
            $evaluador['puede_evaluar'] = $validacionEvaluador['puede'];
            $evaluador['mensaje_tiempo'] = $validacionEvaluador['mensaje'];

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

    // FUNCIÓN PARA VALIDAR TIEMPO MÍNIMO (3+ MESES)
    private static function validarTiempoMinimo($tiempoPuesto)
    {
        if (!$tiempoPuesto) {
            return ['puede' => false, 'mensaje' => 'No se encontraron datos de tiempo'];
        }

        // Extraer años, meses y días del formato AAMMDD
        $años = floor($tiempoPuesto / 10000);
        $meses = floor(($tiempoPuesto % 10000) / 100);
        $días = $tiempoPuesto % 100;

        // Convertir todo a meses
        $totalMeses = ($años * 12) + $meses + ($días / 30);

        if ($totalMeses >= 3) {
            return ['puede' => true, 'mensaje' => "Cumple con el tiempo mínimo ({$años} años, {$meses} meses, {$días} días)"];
        } else {
            return ['puede' => false, 'mensaje' => "No cumple con el tiempo mínimo de 3 meses. Tiempo actual: {$años} años, {$meses} meses, {$días} días"];
        }
    }

    // FUNCIONES EXISTENTES SIN CAMBIOS
    public static function guardarAPI()
    {
        getHeadersApi();

        // CATÁLOGO DEL EVALUADO OBLIGATORIO
        if (empty($_POST['bol_cat_evaluado'])) {
            http_response_code(400);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'El catálogo del evaluado es obligatorio'
            ]);
            exit;
        }

        // CATÁLOGO DEL EVALUADOR OBLIGATORIO
        if (empty($_POST['bol_cat_evaluador'])) {
            http_response_code(400);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'El catálogo del evaluador es obligatorio'
            ]);
            exit;
        }

        // VALIDAR QUE EL EVALUADOR PUEDE EVALUAR
        $validacion = self::validarTiempoEvaluador($_POST['bol_cat_evaluador']);
        if ($validacion['validacion'] !== 'PUEDE_EVALUAR') {
            http_response_code(400);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => $validacion['mensaje']
            ]);
            exit;
        }

        // VERIFICAR SI YA EXISTE UNA EVALUACIÓN
        $anio = $_POST['bol_anio'] ?? 2025;
        if (self::existeEvaluacion($_POST['bol_cat_evaluado'], $anio)) {
            http_response_code(400);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Ya existe una evaluación para este especialista en el año ' . $anio
            ]);
            exit;
        }

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
                'mensaje' => 'Error al guardar la evaluación',
                'datos' => $_POST
            ]);
        }
    }

    public static function eliminarAPI()
    {
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
            $anio_actual = 2025;
            $mes_actual = 8;

            // Calcular los últimos 4 meses
            $meses = [];
            for ($i = 3; $i >= 0; $i--) {
                $mes = $mes_actual - $i;
                $anio = $anio_actual;

                if ($mes <= 0) {
                    $mes += 12;
                    $anio--;
                }

                $meses[] = [
                    'mes' => $mes,
                    'anio' => $anio,
                    'nombre' => self::obtenerNombreMes($mes)
                ];
            }

            $evaluaciones = [];
            $puntajes = [];

            // Consultar cada mes
            foreach ($meses as $periodo) {
                $primer_dia = 1;
                $ultimo_dia = cal_days_in_month(CAL_GREGORIAN, $periodo['mes'], $periodo['anio']);

                $fecha_inicio = sprintf("%04d-%02d-%02d", $periodo['anio'], $periodo['mes'], $primer_dia);
                $fecha_fin = sprintf("%04d-%02d-%02d", $periodo['anio'], $periodo['mes'], $ultimo_dia);

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
                    $evaluaciones[] = [
                        'mes' => $periodo['nombre'],
                        'puntaje' => 0,
                        'fecha' => null
                    ];
                    $puntajes[] = 0;
                }
            }

            $promedio = array_sum($puntajes) / 4;
            $puntos_pafe = self::calcularPuntosPafe($promedio);

            $respuesta = [
                'evaluaciones' => $evaluaciones,
                'puntajes' => $puntajes,
                'promedio' => round($promedio, 2),
                'puntos_pafe' => $puntos_pafe,
                'rango_texto' => self::obtenerTextoRangoPafe($puntos_pafe),
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

    public static function obtenerDemeritosEvaluadoAPI()
    {
        getHeadersApi();
        try {
            $catalogo = filter_var($_GET['catalogo'], FILTER_SANITIZE_NUMBER_INT);

            $sql = "SELECT est_demeritos 
                    FROM psan_estadistica 
                    WHERE est_catalogo = {$catalogo}
                    AND est_situacion = 1";

            $data = self::fetchArray($sql);
            $demeritos = empty($data) ? 0 : (int) $data[0]['est_demeritos'];
            $puntos_demeritos = self::calcularPuntosDemeritos($demeritos);

            $respuesta = [
                'demeritos' => $demeritos,
                'puntos' => $puntos_demeritos,
                'rango_texto' => self::obtenerTextoRangoDemeritos($puntos_demeritos)
            ];

            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'Deméritos obtenidos correctamente',
                'data' => $respuesta
            ]);
        } catch (Exception $e) {
            http_response_code(400);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al obtener deméritos',
                'detalle' => $e->getMessage()
            ]);
        }
    }

    public static function obtenerArrestosEvaluadoAPI()
    {
        getHeadersApi();
        try {
            $catalogo = filter_var($_GET['catalogo'], FILTER_SANITIZE_NUMBER_INT);
            $anio_actual = 2025;

            $sql = "SELECT COUNT(det_sancion) as total_arrestos
                    FROM psan_detalle 
                    WHERE det_catalogo = {$catalogo}
                    AND det_fecha >= '{$anio_actual}-01-01'
                    AND det_fecha <= '{$anio_actual}-12-31'
                    AND det_status = 0";

            $data = self::fetchArray($sql);
            $total_arrestos = (int) ($data[0]['total_arrestos'] ?? 0);
            $puntos_arrestos = self::calcularPuntosArrestos($total_arrestos);

            $respuesta = [
                'arrestos' => $total_arrestos,
                'puntos' => $puntos_arrestos,
                'rango_texto' => self::obtenerTextoRangoArrestos($puntos_arrestos),
                'anio_consultado' => $anio_actual
            ];

            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'Arrestos obtenidos correctamente',
                'data' => $respuesta
            ]);
        } catch (Exception $e) {
            http_response_code(400);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al obtener arrestos',
                'detalle' => $e->getMessage()
            ]);
        }
    }

    public static function obtenerMeritosAPI()
    {
        getHeadersApi();
        try {
            $nota = filter_var($_GET['nota'], FILTER_SANITIZE_NUMBER_INT);

            if (!in_array($nota, [2, 3])) {
                http_response_code(400);
                echo json_encode([
                    'codigo' => 0,
                    'mensaje' => 'La nota debe ser 2 o 3'
                ]);
                return;
            }

            $sql = "SELECT mer_codigo, mer_descripcion, mer_nota 
                    FROM eva_meritos 
                    WHERE mer_nota = {$nota}
                    ORDER BY mer_descripcion ASC";

            $data = self::fetchArray($sql);

            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'Méritos obtenidos correctamente',
                'data' => $data
            ]);
        } catch (Exception $e) {
            http_response_code(400);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al obtener méritos',
                'detalle' => $e->getMessage()
            ]);
        }
    }

    // FUNCIONES PRIVADAS DE VALIDACIÓN Y CÁLCULO
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

    private static function existeEvaluacion($catalogo_evaluado, $anio)
    {
        $sql = "SELECT COUNT(*) as total 
                FROM eva_boleta 
                WHERE bol_cat_evaluado = {$catalogo_evaluado} 
                AND bol_anio = {$anio}";

        $resultado = self::fetchArray($sql);
        return $resultado[0]['total'] > 0;
    }

    private static function formatearNombreCompleto($datos)
    {
        if (!$datos) return 'N/A';

        $nombre = trim($datos['per_nom1']) . ' ';
        $nombre .= !empty($datos['per_nom2']) ? trim($datos['per_nom2']) . ' ' : '';
        $nombre .= trim($datos['per_ape1']) . ' ';
        $nombre .= !empty($datos['per_ape2']) ? trim($datos['per_ape2']) : '';

        return trim($nombre);
    }

    private static function calcularPuntosPafe($promedio)
    {
        if ($promedio >= 91) return 5;
        if ($promedio >= 81) return 4;
        if ($promedio >= 71) return 3;
        if ($promedio >= 60) return 2;
        return 0;
    }

    private static function calcularPuntosDemeritos($demeritos)
    {
        if ($demeritos == 0) return 5;
        if ($demeritos >= 1 && $demeritos <= 18) return 4;
        if ($demeritos >= 19 && $demeritos <= 36) return 3;
        if ($demeritos >= 37 && $demeritos <= 54) return 2;
        if ($demeritos >= 55 && $demeritos <= 74) return 1;
        if ($demeritos >= 75) return 0;
        return 0;
    }

    private static function calcularPuntosArrestos($arrestos)
    {
        if ($arrestos == 0) return 5;
        if ($arrestos >= 1 && $arrestos <= 5) return 4;
        if ($arrestos >= 6 && $arrestos <= 10) return 3;
        if ($arrestos >= 11 && $arrestos <= 15) return 2;
        if ($arrestos >= 16) return 1;
        return 1;
    }

    private static function obtenerTextoRangoPafe($puntos)
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

    private static function obtenerTextoRangoDemeritos($puntos)
    {
        $rangos = [
            5 => '0 deméritos - 5 puntos',
            4 => 'De 1 a 18 deméritos - 4 puntos',
            3 => 'De 19 a 36 deméritos - 3 puntos',
            2 => 'De 37 a 54 deméritos - 2 puntos',
            1 => 'De 55 a 74 deméritos - 1 punto',
            0 => 'De 75 a 100 deméritos - 0 puntos'
        ];
        return $rangos[$puntos] ?? 'Rango no definido';
    }

    private static function obtenerTextoRangoArrestos($puntos)
    {
        $rangos = [
            5 => '0 arrestos - 5 puntos',
            4 => 'De 1 a 5 arrestos - 4 puntos',
            3 => 'De 6 a 10 arrestos - 3 puntos',
            2 => 'De 11 a 15 arrestos - 2 puntos',
            1 => 'De 16 a más arrestos - 1 punto'
        ];
        return $rangos[$puntos] ?? 'Rango no definido';
    }

    private static function obtenerNombreMes($mes)
    {
        $meses = [
            1 => 'Enero',
            2 => 'Febrero',
            3 => 'Marzo',
            4 => 'Abril',
            5 => 'Mayo',
            6 => 'Junio',
            7 => 'Julio',
            8 => 'Agosto',
            9 => 'Septiembre',
            10 => 'Octubre',
            11 => 'Noviembre',
            12 => 'Diciembre'
        ];
        return $meses[$mes] ?? 'Mes inválido';
    }

    public static function obtenerPreguntasConceptualizacionAPI()
    {
        getHeadersApi();
        try {
            $catalogo = filter_var($_GET['catalogo'], FILTER_SANITIZE_NUMBER_INT);

            if (!$catalogo) {
                http_response_code(400);
                echo json_encode([
                    'codigo' => 0,
                    'mensaje' => 'El catálogo del evaluado es obligatorio'
                ]);
                return;
            }

            // Query para obtener la serie del especialista
            $sql = "SELECT meom_serie FROM mper, morg, meom 
                WHERE per_plaza = org_plaza 
                AND org_ceom = meom_ceom 
                AND per_catalogo = {$catalogo}";

            $dataSerie = self::fetchArray($sql);

            if (empty($dataSerie)) {
                http_response_code(404);
                echo json_encode([
                    'codigo' => 0,
                    'mensaje' => 'No se encontró la serie para este especialista'
                ]);
                return;
            }

            $serie = strtoupper(trim($dataSerie[0]['meom_serie']));

            // Mapear serie a proyección según la lógica del profesor
            $proyeccion = self::mapearSerieAProyeccion($serie);

            if ($proyeccion === null) {
                http_response_code(400);
                echo json_encode([
                    'codigo' => 0,
                    'mensaje' => 'Serie no válida para evaluación: ' . $serie
                ]);
                return;
            }

            // Obtener preguntas según la proyección
            $sqlPreguntas = "SELECT pre_codigo, pre_descripcion, pre_proyeccion 
                         FROM eva_preguntas 
                         WHERE pre_proyeccion = {$proyeccion} 
                         ORDER BY pre_codigo ASC";

            $preguntas = self::fetchArray($sqlPreguntas);

            // Obtener tipo de especialista
            $sqlTipo = "SELECT tip_codigo, tip_descripcion 
                    FROM eva_tipo 
                    WHERE tip_codigo = {$proyeccion}";

            $tipoData = self::fetchArray($sqlTipo);
            $tipoDescripcion = !empty($tipoData) ? $tipoData[0]['tip_descripcion'] : 'ESPECIALISTA';

            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'Preguntas obtenidas correctamente',
                'data' => [
                    'serie' => $serie,
                    'proyeccion' => $proyeccion,
                    'tipo_descripcion' => $tipoDescripcion,
                    'preguntas' => $preguntas,
                    'total_preguntas' => count($preguntas)
                ]
            ]);
        } catch (Exception $e) {
            http_response_code(400);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al obtener preguntas de conceptualización',
                'detalle' => $e->getMessage()
            ]);
        }
    }

    // FUNCIÓN PRIVADA PARA MAPEAR SERIE A PROYECCIÓN
    private static function mapearSerieAProyeccion($serie)
    {
        switch ($serie) {
            case 'T':
            case 'P':
                return 1; // TÉCNICA
            case 'E':
                return 2; // ADMINISTRATIVA  
            case 'O':
                return 3; // OPERATIVA
            default:
                return null;
        }
    }

    // OBTENER ACCIONES MOTIVADORAS
    public static function obtenerAccionesMotivadorasAPI()
    {
        getHeadersApi(); // Agregar esta línea
        try {
            $sql = "SELECT mot_codigo, mot_descripcion FROM acc_motivadora ORDER BY mot_descripcion";
            $motivadoras = self::fetchArray($sql); // Cambiar Evaluacion por self

            if ($motivadoras) {
                http_response_code(200); // Agregar response code
                echo json_encode([
                    'codigo' => 1,
                    'mensaje' => 'Acciones motivadoras obtenidas correctamente',
                    'data' => $motivadoras
                ]);
            } else {
                http_response_code(404); // Agregar response code
                echo json_encode([
                    'codigo' => 0,
                    'mensaje' => 'No se encontraron acciones motivadoras',
                    'data' => []
                ]);
            }
        } catch (Exception $e) {
            http_response_code(400); // Agregar response code
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al obtener acciones motivadoras: ' . $e->getMessage(),
                'data' => []
            ]);
        }
    }

    // OBTENER ACCIONES CORRECTIVAS
    public static function obtenerAccionesCorrectivasAPI()
    {
        getHeadersApi(); // Agregar esta línea
        try {
            $sql = "SELECT corr_codigo, corr_descripcion FROM acc_correctiva ORDER BY corr_descripcion";
            $correctivas = self::fetchArray($sql); // Cambiar Evaluacion por self

            if ($correctivas) {
                http_response_code(200); // Agregar response code
                echo json_encode([
                    'codigo' => 1,
                    'mensaje' => 'Acciones correctivas obtenidas correctamente',
                    'data' => $correctivas
                ]);
            } else {
                http_response_code(404); // Agregar response code
                echo json_encode([
                    'codigo' => 0,
                    'mensaje' => 'No se encontraron acciones correctivas',
                    'data' => []
                ]);
            }
        } catch (Exception $e) {
            http_response_code(400); // Agregar response code
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al obtener acciones correctivas: ' . $e->getMessage(),
                'data' => []
            ]);
        }
    }
}