<?php 
require_once __DIR__ . '/../includes/app.php';


use MVC\Router;
use Controllers\AppController;
use Controllers\EvaluacionEspecialistasController;
use Controllers\EvaluacionFormularioController;

$router = new Router();
$router->setBaseURL('/' . $_ENV['APP_NAME']);

$router->get('/', [AppController::class,'index']);


// EVALUACIÓN DE ESPECIALISTAS
$router->get('/evaluacionespecialistas', [EvaluacionEspecialistasController::class, 'renderizarPagina']);
$router->get('/API/evaluacionespecialistas/buscar', [EvaluacionEspecialistasController::class, 'buscarAPI']);
$router->get('/API/evaluacionespecialistas/eliminar', [EvaluacionEspecialistasController::class, 'eliminarAPI']);
$router->get('/API/evaluacionespecialistas/obtenerDependencias', [EvaluacionEspecialistasController::class, 'obtenerDependenciasAPI']);
$router->get('/API/evaluacionespecialistas/obtenerPeriodos', [EvaluacionEspecialistasController::class, 'obtenerPeriodosAPI']);
$router->get('/API/evaluacionespecialistas/obtenerGrados', [EvaluacionEspecialistasController::class, 'obtenerGradosAPI']);
$router->get('/API/evaluacionespecialistas/obtenerDetalle', [EvaluacionEspecialistasController::class, 'obtenerDetalleAPI']);


// FORMULARIO DE EVALUACIÓN DEL DESEMPEÑO
$router->get('/ingresar-datos', [EvaluacionFormularioController::class, 'renderizarPagina']);
$router->get('/API/evaluacionformulario/obtenerDatosEvaluado', [EvaluacionFormularioController::class, 'obtenerDatosEvaluadoAPI']);
$router->get('/API/evaluacionformulario/obtenerDatosEvaluador', [EvaluacionFormularioController::class, 'obtenerDatosEvaluadorAPI']);
$router->get('/API/evaluacionformulario/validarTiempoEvaluador', [EvaluacionFormularioController::class, 'validarTiempoEvaluadorAPI']);
$router->post('/API/evaluacionformulario/guardar', [EvaluacionFormularioController::class, 'guardarEvaluacionAPI']);
$router->get('/API/evaluacionformulario/eliminar', [EvaluacionFormularioController::class, 'eliminarEvaluacionAPI']);
$router->get('/API/evaluacionformulario/obtenerPafesEvaluado', [EvaluacionFormularioController::class, 'obtenerPafesEvaluadoAPI']);









$router->comprobarRutas();