<div class="container mt-4">
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary text-white text-center" style="background: linear-gradient(135deg, #0b1635ff 0%, #0d203dff 100%);">
                    <div class="evaluation-icon">
                        <i class="bi bi-clipboard-check"></i>
                    </div>
                    <h5 class="mb-1">Sistema de Gestión Militar - EMDN</h5>
                    <h4 class="mb-0">EVALUACIÓN DEL DESEMPEÑO - ESPECIALISTAS</h4>
                    <div class="military-badge mt-3">
                        Directiva EMDN-009-SAGE-2008
                    </div>
                </div>
                <div class="card-body">
                    <form id="FormBusqueda" enctype="multipart/form-data">
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label for="catalogo" class="form-label">Catálogo</label>
                                <input type="text" class="form-control" id="catalogo" name="catalogo" 
                                       placeholder="Ingrese catálogo">
                            </div>
                            <div class="col-md-3">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" 
                                       placeholder="Ingrese nombre">
                            </div>
                            <div class="col-md-3">
                                <label for="apellido" class="form-label">Apellido</label>
                                <input type="text" class="form-control" id="apellido" name="apellido" 
                                       placeholder="Ingrese apellido">
                            </div>
                            <div class="col-md-3">
                                <label for="grado" class="form-label">Grado</label>
                                <select class="form-control" id="grado" name="grado">
                                    <option value="">Todos los grados</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="dependencia" class="form-label">Dependencia</label>
                                <select class="form-control" id="dependencia" name="dependencia">
                                    <option value="">--Todas--</option>
                                </select>
                            </div>
                           
                        </div>
                        
                        <div class="text-center">
                            <button class="btn btn-primary me-2" type="button" id="BtnBuscar">
                                <i class="bi bi-search me-1"></i>Buscar
                            </button>
                            <button class="btn btn-secondary" type="reset" id="BtnLimpiar">
                                <i class="bi bi-arrow-clockwise me-1"></i>Limpiar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-info text-white" style="background: linear-gradient(135deg, #101c3cff 0%, #091220ff 100%);">
                    <h4 class="text-center mb-0">Evaluaciones del Desempeño - Especialistas</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="TableEvaluaciones">
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    :root {
        --primary-blue: #1e3a8a;
        --secondary-blue: #3b82f6;
        --light-blue: #dbeafe;
        --dark-blue: #1e40af;
        --accent-blue: #60a5fa;
    }
    
    body {
        background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    
    .card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 10px 25px rgba(30, 58, 138, 0.1);
        backdrop-filter: blur(10px);
        background: rgba(255, 255, 255, 0.95);
    }
    
    .card-header {
        background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%) !important;
        border-radius: 15px 15px 0 0 !important;
        padding: 2rem;
        position: relative;
        overflow: hidden;
    }
    
    .card-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 100%;
        height: 100%;
        background: linear-gradient(45deg, rgba(255,255,255,0.1) 0%, transparent 100%);
        transform: rotate(45deg);
    }
    
    .card-header h4, .card-header h5 {
        position: relative;
        z-index: 2;
        text-shadow: 0 2px 4px rgba(0,0,0,0.3);
    }
    
    .card-body {
        padding: 2rem;
    }
    
    .form-label {
        font-weight: 600;
        color: var(--primary-blue);
        margin-bottom: 0.75rem;
    }
    
    .form-control, .form-select {
        border: 2px solid #e5e7eb;
        border-radius: 10px;
        padding: 0.75rem 1rem;
        transition: all 0.3s ease;
        background: rgba(255, 255, 255, 0.9);
    }
    
    .form-control:focus, .form-select:focus {
        border-color: var(--secondary-blue);
        box-shadow: 0 0 0 0.2rem rgba(59, 130, 246, 0.25);
        transform: translateY(-1px);
    }
    
    .btn {
        border-radius: 10px;
        padding: 0.75rem 1.5rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
        border: none;
    }
    
    .btn-primary {
        background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%);
        box-shadow: 0 4px 15px rgba(59, 130, 246, 0.4);
    }
    
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(59, 130, 246, 0.6);
    }
    
    .btn-secondary {
        background: linear-gradient(135deg, #6b7280 0%, #9ca3af 100%);
        box-shadow: 0 4px 15px rgba(107, 114, 128, 0.4);
    }
    
    .btn-secondary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(107, 114, 128, 0.6);
    }
    
    .table {
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    }
    
    .table thead th {
        background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%);
        color: white;
        border: none;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 1rem;
    }
    
    .table tbody tr {
        transition: all 0.3s ease;
    }
    
    .table tbody tr:hover {
        background-color: var(--light-blue);
        transform: scale(1.01);
    }
    
    .table tbody td {
        padding: 1rem;
        vertical-align: middle;
        border-top: 1px solid #e5e7eb;
    }
    
    .military-badge {
        background: linear-gradient(135deg, var(--accent-blue) 0%, var(--secondary-blue) 100%);
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 25px;
        font-size: 0.875rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        display: inline-block;
        margin-bottom: 1rem;
    }
    
    .evaluation-icon {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, var(--accent-blue) 0%, var(--secondary-blue) 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
    }
    
    .evaluation-icon i {
        font-size: 1.5rem;
        color: white;
    }
    
    @media (max-width: 768px) {
        .card-body {
            padding: 1rem;
        }
        
        .btn {
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
        }
    }
</style>

<script src="<?= asset('build/js/evaluacionespecialistas/index.js') ?>"></script>