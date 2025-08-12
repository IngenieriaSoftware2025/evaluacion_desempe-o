<div class="container-fluid mt-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary text-white text-center">
                    <h2><i class="bi bi-bar-chart"></i> Estadísticas del Sistema de Evaluación</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Cards de resumen -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-center bg-success text-white">
                <div class="card-body">
                    <h5><i class="bi bi-trophy"></i> Aptos para Ascenso</h5>
                    <h2 id="contador-aptos">-</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center bg-info text-white">
                <div class="card-body">
                    <h5><i class="bi bi-people"></i> Total Evaluados</h5>
                    <h2 id="contador-total">-</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center bg-warning text-white">
                <div class="card-body">
                    <h5><i class="bi bi-activity"></i> PAFE Completo</h5>
                    <h2 id="contador-pafe">-</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center bg-danger text-white">
                <div class="card-body">
                    <h5><i class="bi bi-exclamation-triangle"></i> Con Arrestos</h5>
                    <h2 id="contador-arrestos">-</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Gráficos -->
    <div class="row">
        <!-- Distribución por Categorías -->
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header bg-secondary text-white">
                    <h5><i class="bi bi-pie-chart"></i> Distribución por Categorías</h5>
                </div>
                <div class="card-body">
                    <canvas id="grafico-categorias" height="300"></canvas>
                </div>
            </div>
        </div>

        <!-- Aptos para Ascenso -->
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header bg-secondary text-white">
                    <h5><i class="bi bi-arrow-up-circle"></i> Aptos para Ascenso</h5>
                </div>
                <div class="card-body">
                    <canvas id="grafico-ascensos" height="300"></canvas>
                </div>
            </div>
        </div>

        <!-- Estadísticas PAFE -->
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header bg-secondary text-white">
                    <h5><i class="bi bi-heart-pulse"></i> Estadísticas PAFE</h5>
                </div>
                <div class="card-body">
                    <canvas id="grafico-pafes" height="300"></canvas>
                </div>
            </div>
        </div>

        <!-- Ranking de Arrestos -->
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header bg-secondary text-white">
                    <h5><i class="bi bi-list-ol"></i> Especialistas con Más Arrestos</h5>
                </div>
                <div class="card-body">
                    <canvas id="grafico-arrestos" height="300"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript -->
<script src="<?= asset('build/js/estadisticas/index.js') ?>"></script>