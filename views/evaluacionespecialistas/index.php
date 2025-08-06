<div class="container mt-4">
    <div class="row mb-4">
        <div class="col-12">
            <div class="card main-card">
                <div class="card-header bg-primary text-white text-center header-gradient">
                    <div class="evaluation-icon">
                        <i class="bi bi-clipboard-check"></i>
                    </div>
                    <h5 class="mb-1 header-subtitle">Sistema de Gestión Militar - EMDN</h5>
                    <h4 class="mb-0 header-title">EVALUACIÓN DEL DESEMPEÑO - ESPECIALISTAS</h4>
                    <div class="military-badge mt-3">
                        <i class="bi bi-shield-check me-2"></i>
                        Directiva EMDN-009-SAGE-2008
                    </div>
                </div>
                <div class="card-body form-section">
                    <form id="FormBusqueda" enctype="multipart/form-data">
                        <div class="row mb-4">
                            <div class="col-md-3 mb-3">
                                <label for="catalogo" class="form-label">
                                    <i class="bi bi-person-badge me-1"></i>Catálogo
                                </label>
                                <input type="text" class="form-control modern-input" id="catalogo" name="catalogo" 
                                       placeholder="Ingrese catálogo">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="nombre" class="form-label">
                                    <i class="bi bi-person me-1"></i>Nombre
                                </label>
                                <input type="text" class="form-control modern-input" id="nombre" name="nombre" 
                                       placeholder="Ingrese nombre">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="apellido" class="form-label">
                                    <i class="bi bi-person-lines-fill me-1"></i>Apellido
                                </label>
                                <input type="text" class="form-control modern-input" id="apellido" name="apellido" 
                                       placeholder="Ingrese apellido">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="grado" class="form-label">
                                    <i class="bi bi-award me-1"></i>Grado
                                </label>
                                <select class="form-select modern-select" id="grado" name="grado">
                                    <option value="">Todos los grados</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="row mb-4">
                            <div class="col-md-6 mb-3">
                                <label for="dependencia" class="form-label">
                                    <i class="bi bi-building me-1"></i>Dependencia
                                </label>
                                <select class="form-select modern-select" id="dependencia" name="dependencia">
                                    <option value="">--Todas--</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3 d-flex align-items-end">
                                <div class="search-info">
                                    <small class="text-muted">
                                        <i class="bi bi-info-circle me-1"></i>
                                        Complete los campos necesarios y presione buscar
                                    </small>
                                </div>
                            </div>
                        </div>
                        
                        <div class="text-center button-section">
                            <button class="btn btn-primary btn-modern me-3" type="button" id="BtnBuscar">
                                <i class="bi bi-search me-2"></i>Buscar Evaluaciones
                            </button>
                            <button class="btn btn-secondary btn-modern" type="reset" id="BtnLimpiar">
                                <i class="bi bi-arrow-clockwise me-2"></i>Limpiar Filtros
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card table-card">
                <div class="card-header bg-info text-white table-header-gradient">
                    <div class="d-flex align-items-center justify-content-center">
                        <i class="bi bi-table me-2"></i>
                        <h4 class="mb-0">Evaluaciones del Desempeño - Especialistas</h4>
                    </div>
                </div>
                <div class="card-body table-section">
                    <div class="table-responsive">
                        <table class="table table-modern" id="TableEvaluaciones">
                            <!-- DataTable generará las columnas -->
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
        --success-green: #10b981;
        --warning-orange: #f59e0b;
        --danger-red: #ef4444;
        --text-dark: #1f2937;
        --text-muted: #6b7280;
        --border-light: #e5e7eb;
        --shadow-soft: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        --shadow-medium: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        --shadow-large: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }
    
    body {
        background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
        font-family: 'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        color: var(--text-dark);
    }
    
    /* Cards mejoradas */
    .main-card, .table-card {
        border: none;
        border-radius: 20px;
        box-shadow: var(--shadow-large);
        backdrop-filter: blur(20px);
        background: rgba(255, 255, 255, 0.98);
        overflow: hidden;
        transition: all 0.3s ease;
    }
    
    .main-card:hover, .table-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
    }
    
    /* Header mejorado */
    .header-gradient {
        background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 50%, var(--accent-blue) 100%) !important;
        border-radius: 20px 20px 0 0 !important;
        padding: 3rem 2rem;
        position: relative;
        overflow: hidden;
    }
    
    .header-gradient::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 200%;
        height: 200%;
        background: linear-gradient(45deg, rgba(255,255,255,0.1) 0%, transparent 50%, rgba(255,255,255,0.05) 100%);
        transform: rotate(45deg);
        animation: shimmer 3s ease-in-out infinite;
    }
    
    @keyframes shimmer {
        0%, 100% { opacity: 0.3; }
        50% { opacity: 0.7; }
    }
    
    .header-subtitle, .header-title {
        position: relative;
        z-index: 2;
        text-shadow: 0 2px 4px rgba(0,0,0,0.3);
    }
    
    .header-subtitle {
        font-weight: 500;
        opacity: 0.9;
        letter-spacing: 0.5px;
    }
    
    .header-title {
        font-weight: 700;
        letter-spacing: 1px;
        font-size: 1.75rem;
    }
    
    /* Ícono de evaluación mejorado */
    .evaluation-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, rgba(255,255,255,0.2) 0%, rgba(255,255,255,0.1) 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        border: 3px solid rgba(255,255,255,0.3);
        position: relative;
        z-index: 2;
        box-shadow: 0 8px 32px rgba(0,0,0,0.1);
    }
    
    .evaluation-icon i {
        font-size: 2rem;
        color: white;
        animation: pulse 2s ease-in-out infinite;
    }
    
    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.05); }
    }
    
    /* Badge militar mejorado */
    .military-badge {
        background: linear-gradient(135deg, var(--success-green) 0%, var(--accent-blue) 100%);
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: 50px;
        font-size: 0.9rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        display: inline-block;
        position: relative;
        z-index: 2;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        border: 2px solid rgba(255,255,255,0.2);
    }
    
    /* Sección de formulario */
    .form-section {
        padding: 3rem 2.5rem;
        background: linear-gradient(135deg, rgba(255,255,255,0.9) 0%, rgba(248,250,252,0.9) 100%);
    }
    
    /* Labels mejorados */
    .form-label {
        font-weight: 600;
        color: var(--primary-blue);
        margin-bottom: 0.75rem;
        font-size: 0.95rem;
        display: flex;
        align-items: center;
    }
    
    .form-label i {
        color: var(--accent-blue);
    }
    
    /* Inputs modernos */
    .modern-input, .modern-select {
        border: 2px solid var(--border-light);
        border-radius: 12px;
        padding: 0.875rem 1.25rem;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        background: rgba(255, 255, 255, 0.95);
        box-shadow: var(--shadow-soft);
    }
    
    .modern-input:focus, .modern-select:focus {
        border-color: var(--accent-blue);
        box-shadow: 0 0 0 0.25rem rgba(96, 165, 250, 0.15), var(--shadow-medium);
        transform: translateY(-1px);
        background: white;
    }
    
    .modern-input:hover, .modern-select:hover {
        border-color: var(--secondary-blue);
        transform: translateY(-1px);
    }
    
    /* Información de búsqueda */
    .search-info {
        padding: 1rem;
        background: linear-gradient(135deg, rgba(96, 165, 250, 0.1) 0%, rgba(59, 130, 246, 0.05) 100%);
        border-radius: 12px;
        border-left: 4px solid var(--accent-blue);
        width: 100%;
    }
    
    /* Sección de botones */
    .button-section {
        padding: 2rem 0 1rem 0;
        border-top: 1px solid rgba(229, 231, 235, 0.5);
        margin-top: 1rem;
    }
    
    /* Botones modernos */
    .btn-modern {
        border-radius: 12px;
        padding: 0.875rem 2rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
        border: none;
        font-size: 0.9rem;
        box-shadow: var(--shadow-medium);
        position: relative;
        overflow: hidden;
    }
    
    .btn-modern::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left 0.5s;
    }
    
    .btn-modern:hover::before {
        left: 100%;
    }
    
    .btn-primary.btn-modern {
        background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%);
        box-shadow: 0 4px 15px rgba(59, 130, 246, 0.4);
    }
    
    .btn-primary.btn-modern:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(59, 130, 246, 0.6);
        background: linear-gradient(135deg, #1d4ed8 0%, #2563eb 100%);
    }
    
    .btn-secondary.btn-modern {
        background: linear-gradient(135deg, #6b7280 0%, #9ca3af 100%);
        box-shadow: 0 4px 15px rgba(107, 114, 128, 0.3);
    }
    
    .btn-secondary.btn-modern:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(107, 114, 128, 0.5);
        background: linear-gradient(135deg, #4b5563 0%, #6b7280 100%);
    }
    
    /* Header de tabla mejorado */
    .table-header-gradient {
        background: linear-gradient(135deg, #101c3c 0%, #1e3a8a 50%, #3b82f6 100%) !important;
        border-radius: 20px 20px 0 0 !important;
        padding: 2rem;
        position: relative;
        overflow: hidden;
    }
    
    .table-header-gradient::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(45deg, rgba(255,255,255,0.05) 0%, transparent 100%);
    }
    
    .table-header-gradient h4 {
        position: relative;
        z-index: 2;
        text-shadow: 0 2px 4px rgba(0,0,0,0.3);
        font-weight: 600;
    }
    
    /* Sección de tabla */
    .table-section {
        padding: 0;
        background: white;
    }
    
    /* Tabla moderna */
    .table-modern {
        border-radius: 0 0 20px 20px;
        overflow: hidden;
        margin: 0;
        box-shadow: none;
    }
    
    .table-modern thead th {
        background: linear-gradient(135deg, var(--text-dark) 0%, #374151 100%);
        color: white;
        border: none;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.75px;
        padding: 1.25rem 1rem;
        font-size: 0.85rem;
        text-align: center;
        position: relative;
    }
    
    .table-modern thead th::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 2px;
        background: linear-gradient(90deg, var(--accent-blue) 0%, var(--secondary-blue) 100%);
    }
    
    .table-modern tbody tr {
        transition: all 0.3s ease;
        border-bottom: 1px solid var(--border-light);
    }
    
    .table-modern tbody tr:hover {
        background: linear-gradient(135deg, var(--light-blue) 0%, rgba(240, 249, 255, 0.8) 100%);
        transform: scale(1.002);
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.1);
    }
    
    .table-modern tbody td {
        padding: 1.25rem 1rem;
        vertical-align: middle;
        border-top: none;
        text-align: center;
        font-size: 0.9rem;
    }
    
    /* Badges mejorados */
    .badge {
        padding: 0.5rem 0.875rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.025em;
    }
    
    /* Responsive mejorado */
    @media (max-width: 768px) {
        .container {
            padding-left: 1rem;
            padding-right: 1rem;
        }
        
        .form-section {
            padding: 2rem 1.5rem;
        }
        
        .header-gradient {
            padding: 2rem 1.5rem;
        }
        
        .header-title {
            font-size: 1.5rem;
        }
        
        .evaluation-icon {
            width: 60px;
            height: 60px;
        }
        
        .evaluation-icon i {
            font-size: 1.5rem;
        }
        
        .btn-modern {
            padding: 0.75rem 1.5rem;
            font-size: 0.85rem;
            margin-bottom: 0.5rem;
        }
        
        .table-modern thead th,
        .table-modern tbody td {
            padding: 0.875rem 0.5rem;
            font-size: 0.8rem;
        }
    }
    
    @media (max-width: 576px) {
        .header-title {
            font-size: 1.25rem;
        }
        
        .military-badge {
            font-size: 0.8rem;
            padding: 0.5rem 1rem;
        }
        
        .form-label {
            font-size: 0.9rem;
        }
        
        .modern-input, .modern-select {
            padding: 0.75rem 1rem;
            font-size: 0.9rem;
        }
    }
    
    /* Animación de carga */
    .loading {
        opacity: 0.7;
        pointer-events: none;
    }
    
    .loading .btn-modern {
        position: relative;
    }
    
    .loading .btn-modern::after {
        content: '';
        position: absolute;
        width: 16px;
        height: 16px;
        margin: auto;
        border: 2px solid transparent;
        border-top-color: #ffffff;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }
    
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>

<script src="<?= asset('build/js/evaluacionespecialistas/index.js') ?>"></script>