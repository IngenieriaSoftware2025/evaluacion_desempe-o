<div class="container mt-4">
    <!-- Sección IV: CONCEPTUALIZACIÓN -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card main-card">
                <div class="card-header bg-primary text-white text-center header-gradient">
                    <div class="evaluation-icon">
                        <i class="bi bi-clipboard-check"></i>
                    </div>
                    <h4 class="mb-0 header-title">EVALUACIÓN DEL DESEMPEÑO</h4>
                    <div class="military-badge mt-3" id="tipo_especialista">
                        <i class="bi bi-shield-check me-2"></i>
                        <span id="tipo_descripcion">ESPECIALISTAS</span>
                    </div>
                </div>
                
                <div class="card-body form-section">
                    <!-- Instrucciones -->
                    <div class="instructions-box mb-4">
                        <div class="instruction-text">
                            <strong>Instrucciones:</strong> A continuación encontrará quince aspectos relacionados con el 
                            desempeño laboral del evaluado; léalos detenidamente y marque con una X en la escala de la derecha.
                        </div>
                    </div>

                    <!-- Formulario de Conceptualización -->
                    <form id="FormConceptualizacion">
                        <!-- Campos ocultos -->
                        <input type="hidden" id="catalogo_evaluado" name="catalogo_evaluado">
                        <input type="hidden" id="proyeccion_serie" name="proyeccion_serie">
                        <input type="hidden" id="bol_total_concep" name="bol_total_concep" value="0">

                        <!-- Contenedor de preguntas -->
                        <div class="conceptualizacion-container">
                            <!-- Encabezado de escala -->
                            <div class="row mb-3">
                                <div class="col-md-8"></div>
                                <div class="col-md-4">
                                    <div class="escala-header">
                                        <div class="row text-center">
                                            <div class="col escala-col insatisfactorio-col">
                                                <strong>Insatisfactorio</strong>
                                            </div>
                                            <div class="col escala-col intermedio-col">
                                                <strong>Intermedio</strong>
                                            </div>
                                            <div class="col escala-col optimo-col">
                                                <strong>Óptimo</strong>
                                            </div>
                                        </div>
                                        <div class="row text-center mt-2">
                                            <div class="col"><strong>1</strong></div>
                                            <div class="col"><strong>2</strong></div>
                                            <div class="col"><strong>3</strong></div>
                                            <div class="col"><strong>4</strong></div>
                                            <div class="col"><strong>5</strong></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Contenedor dinámico de preguntas -->
                            <div id="preguntas-container">
                                <!-- Las preguntas se cargarán dinámicamente aquí -->
                            </div>

                            <!-- Sección de totales -->
                            <div class="totales-section mt-4 pt-3" style="border-top: 2px solid var(--primary-blue);">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="subtotal-labels">
                                            <div class="subtotal-item">
                                                <strong>SUBTOTAL</strong>
                                            </div>
                                            <div class="total-item mt-2">
                                                <strong>TOTAL</strong>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="subtotal-valores text-center">
                                            <div class="subtotal-box" id="subtotal_conceptualizacion">0</div>
                                            <div class="total-box mt-2" id="total_conceptualizacion">0</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Estado de carga -->
                        <div class="text-center" id="loading_preguntas">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Cargando preguntas...</span>
                            </div>
                            <p class="mt-2">Cargando preguntas de conceptualización...</p>
                        </div>

                        <!-- Mensaje de error -->
                        <div class="alert alert-danger d-none" id="error_preguntas" role="alert">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i>
                            <span id="mensaje_error_preguntas"></span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Sección V: CATEGORÍA -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card main-card">
            <div class="card-header bg-success text-white text-center header-gradient-success">
                <div class="evaluation-icon">
                    <i class="bi bi-trophy"></i>
                </div>
                <h4 class="mb-0 header-title">V. CATEGORÍA</h4>
                <p class="mb-0">Resultado Final de la Evaluación</p>
            </div>
            <div class="card-body form-section">
                <div class="row text-center">
                    <div class="col-md-4">
                        <h6>Punteo Salud y Conducta</h6>
                        <div class="total-box-categoria" id="mostrar_total_salud">0</div>
                    </div>
                    <div class="col-md-4">
                        <h6>Punteo Conceptualización</h6>
                        <div class="total-box-categoria" id="mostrar_total_conceptualizacion">0</div>
                    </div>
                    <div class="col-md-4">
                        <h6>TOTAL FINAL</h6>
                        <div class="total-box-final" id="mostrar_total_final">0</div>
                    </div>
                </div>
                
                <div class="row mt-4">
                    <div class="col-12 text-center">
                        <h5>Categoría Asignada:</h5>
                        <div class="categoria-resultado" id="categoria_resultado">
                            <span class="badge badge-categoria" id="badge_categoria">CALCULANDO...</span>
                        </div>
                    </div>
                </div>
                
                <!-- Campo oculto para guardar el total final -->
                <input type="hidden" id="total_final_evaluacion" name="total_final_evaluacion" value="0">
            </div>
        </div>
    </div>
</div>

    <!-- BOTONES DE NAVEGACIÓN -->
    <div class="row mt-4 mb-5">
        <div class="col-12">
            <div class="text-center">
                <button class="btn btn-secondary btn-modern me-3" type="button" id="BtnVolverPaginaAnterior">
                    <i class="bi bi-arrow-left me-2"></i>Volver a Página Anterior
                </button>
                <button class="btn btn-info btn-modern me-3" type="button" id="BtnCalcularTotal">
                    <i class="bi bi-calculator me-2"></i>Actualizar Total
                </button>
                <button class="btn btn-success btn-modern" type="button" id="BtnContinuar">
                    <i class="bi bi-arrow-right me-2"></i>Continuar
                </button>
            </div>
        </div>
    </div>
</div>
<link rel="stylesheet" href="<?= asset('build/css/evaluacionformulario/style.css') ?>">
<link rel="stylesheet" href="<?= asset('build/css/evaluacionformulario/index2.css') ?>">
<script src="<?= asset('build/js/evaluacionformulario/index2.js') ?>"></script>