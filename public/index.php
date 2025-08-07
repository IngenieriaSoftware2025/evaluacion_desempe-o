<?php 
require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controllers\AppController;
use Controllers\EvaluacionEspecialistasController;
use Controllers\EvaluacionFormularioController;

$router = new Router();
$router->setBaseURL('/' . $_ENV['APP_NAME']);

$router->get('/', [AppController::class,'index']);


// EVALUACIÓN DE ESPECIALISTAS (LISTADO PRINCIPAL)

$router->get('/evaluacionespecialistas', [EvaluacionEspecialistasController::class, 'renderizarPagina']);
$router->get('/API/evaluacionespecialistas/buscar', [EvaluacionEspecialistasController::class, 'buscarAPI']);
$router->get('/API/evaluacionespecialistas/eliminar', [EvaluacionEspecialistasController::class, 'eliminarAPI']);
$router->get('/API/evaluacionespecialistas/obtenerDependencias', [EvaluacionEspecialistasController::class, 'obtenerDependenciasAPI']);
$router->get('/API/evaluacionespecialistas/obtenerPeriodos', [EvaluacionEspecialistasController::class, 'obtenerPeriodosAPI']);
$router->get('/API/evaluacionespecialistas/obtenerGrados', [EvaluacionEspecialistasController::class, 'obtenerGradosAPI']);
$router->get('/API/evaluacionespecialistas/obtenerDetalle', [EvaluacionEspecialistasController::class, 'obtenerDetalleAPI']);


// FORMULARIO DE EVALUACIÓN - PÁGINA 1 (Datos + Factores de Salud)
$router->get('/evaluacion/pagina1', [EvaluacionFormularioController::class, 'renderizarPagina1']);

// APIs para datos básicos (Página 1)
$router->get('/API/evaluacion/obtenerDatosEvaluado', [EvaluacionFormularioController::class, 'obtenerDatosEvaluadoAPI']);
$router->get('/API/evaluacion/obtenerDatosEvaluador', [EvaluacionFormularioController::class, 'obtenerDatosEvaluadorAPI']);
$router->get('/API/evaluacion/validarTiempoEvaluador', [EvaluacionFormularioController::class, 'validarTiempoEvaluadorAPI']);

// APIs para factores de salud y conducta (Página 1)
$router->get('/API/evaluacion/obtenerPafesEvaluado', [EvaluacionFormularioController::class, 'obtenerPafesEvaluadoAPI']);
$router->get('/API/evaluacion/obtenerDemeritosEvaluado', [EvaluacionFormularioController::class, 'obtenerDemeritosEvaluadoAPI']);
$router->get('/API/evaluacion/obtenerArrestosEvaluado', [EvaluacionFormularioController::class, 'obtenerArrestosEvaluadoAPI']);
$router->get('/API/evaluacion/obtenerMeritos', [EvaluacionFormularioController::class, 'obtenerMeritosAPI']);

// Guardar datos de página 1
$router->post('/API/evaluacion/guardarPagina1', [EvaluacionFormularioController::class, 'guardarPagina1API']);


// FORMULARIO DE EVALUACIÓN - PÁGINA 2 (Conceptualización + Validación)
$router->get('/evaluacion/pagina2', [EvaluacionFormularioController::class, 'renderizarPagina2']);

// APIs para conceptualización (Página 2)
$router->post('/API/evaluacion/guardarConceptualizacion', [EvaluacionFormularioController::class, 'guardarConceptualizacionAPI']);


// APIS COMPARTIDAS ENTRE PÁGINAS
// Guardar evaluación completa (ambas páginas)
$router->post('/API/evaluacion/guardarCompleta', [EvaluacionFormularioController::class, 'guardarEvaluacionCompletaAPI']);

// Obtener datos existentes de una evaluación
$router->get('/API/evaluacion/obtenerDatos', [EvaluacionFormularioController::class, 'obtenerDatosEvaluacionAPI']);

// Eliminar evaluación
$router->get('/API/evaluacion/eliminar', [EvaluacionFormularioController::class, 'eliminarEvaluacionAPI']);


// RUTAS DE COMPATIBILIDAD (OPCIONAL - para no romper enlaces existentes)

// Redireccionar rutas antiguas a las nuevas
$router->get('/ingresar-datos', function() {
    $catalogo = $_GET['catalogo'] ?? '';
    header("Location: /evaluacion_desempe-o/evaluacion/pagina1?catalogo=$catalogo");
    exit;
});

$router->get('/conceptualizacion', function() {
    $catalogo = $_GET['catalogo'] ?? '';
    header("Location: /evaluacion_desempe-o/evaluacion/pagina2?catalogo=$catalogo");
    exit;
});


// VERIFICAR RUTAS

$router->comprobarRutas();