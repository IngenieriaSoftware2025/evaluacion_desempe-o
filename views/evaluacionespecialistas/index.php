<!-- VISTA PRINCIPAL - EVALUACIÓN DEL DESEMPEÑO PARA ESPECIALISTAS -->
<div class="container mt-4">
    <!-- SECCIÓN DE BÚSQUEDA -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card main-card">
                <div class="card-header bg-primary text-white text-center header-gradient">
                    <!-- ICONO PRINCIPAL -->
                    <div class="evaluation-icon">
                        <i class="bi bi-clipboard-check"></i>
                    </div>

                    <!-- TÍTULO PRINCIPAL -->
                    <h4 class="mb-0 header-title">EVALUACIÓN DEL DESEMPEÑO PARA ESPECIALISTAS</h4>
                </div>

                <!-- FORMULARIO DE BÚSQUEDA -->
                <div class="card-body form-section">
                    <form id="FormBusqueda" enctype="multipart/form-data">
                        <div class="row mb-4">
                            <!-- CAMPO CATÁLOGO -->
                            <div class="col-md-6 mb-3">
                                <label for="catalogo" class="form-label">
                                    <i class="bi bi-person-badge me-1"></i>Catálogo
                                </label>
                                <input type="text" class="form-control modern-input" id="catalogo" name="catalogo"
                                    placeholder="Ingrese catálogo">
                            </div>

                            <!-- SELECT DE GRADO -->
                            <div class="col-md-6 mb-3">
                                <label for="grado" class="form-label">
                                    <i class="bi bi-award me-1"></i>Grado
                                </label>
                                <select class="form-select modern-select" id="grado" name="grado">
                                    <option value="">Todos los grados</option>
                                </select>
                            </div>
                        </div>

                        <!-- BOTONES DE ACCIÓN -->
                        <div class="text-center button-section">
                            <button class="btn btn-primary btn-modern me-3" type="button" id="BtnBuscar">
                                <i class="bi bi-search me-2"></i>Buscar
                            </button>
                            <button class="btn btn-secondary btn-modern" type="reset" id="BtnLimpiar">
                                <i class="bi bi-arrow-clockwise me-2"></i>Limpiar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- SECCIÓN DE TABLA DE RESULTADOS -->
    <div class="row">
        <div class="col-12">
            <div class="card table-card">
                <div class="card-header bg-info text-white table-header-gradient">
                    <div class="d-flex align-items-center justify-content-center">
                        <i class="bi bi-table me-2"></i>
                        <h4 class="mb-0">Especialistas Activos para Evaluación</h4>
                    </div>
                </div>

                <!-- TABLA DE DATOS -->
                <div class="card-body table-section">
                    <div class="table-responsive">
                        <table class="table table-modern" id="TableEvaluaciones">
                            <!-- DataTable genera las columnas automáticamente -->
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- CARGAR CSS EXTERNO -->
<link rel="stylesheet" href="<?= asset('build/css/evaluacionespecialistas/style.css') ?>">

<!-- CARGAR JAVASCRIPT -->
<script src="<?= asset('build/js/evaluacionespecialistas/index.js') ?>"></script>