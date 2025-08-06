<div class="container mt-4">
    <!-- Sección I: DATOS DEL EVALUADO -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card main-card">
                <div class="card-header bg-primary text-white text-center header-gradient">
                    <div class="evaluation-icon">
                        <i class="bi bi-person-check"></i>
                    </div>
                    <h5 class="mb-1 header-subtitle">I. DATOS DEL EVALUADO</h5>
                    <h4 class="mb-0 header-title">BOLETA DE EVALUACIÓN DEL DESEMPEÑO PARA ESPECIALISTAS</h4>
                    <div class="military-badge mt-3">
                        <i class="bi bi-shield-check me-2"></i>
                        SERIE TÉCNICA TIPO ("C")
                    </div>
                </div>
                <div class="card-body form-section">
                    <div class="row mb-3">
                        <div class="col-md-2">
                            <label class="form-label">
                                <i class="bi bi-person-badge me-1"></i>No. Catálogo
                            </label>
                            <input type="text" class="form-control modern-input" id="evaluado_catalogo" readonly>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">
                                <i class="bi bi-award me-1"></i>Grado Militar
                            </label>
                            <input type="text" class="form-control modern-input" id="evaluado_grado" readonly>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">1er. Nombre</label>
                            <input type="text" class="form-control modern-input" id="evaluado_nom1" readonly>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">2do. Nombre</label>
                            <input type="text" class="form-control modern-input" id="evaluado_nom2" readonly>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">1er. Apellido</label>
                            <input type="text" class="form-control modern-input" id="evaluado_ape1" readonly>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">2do. Apellido</label>
                            <input type="text" class="form-control modern-input" id="evaluado_ape2" readonly>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label">
                                <i class="bi bi-geo-alt me-1"></i>Lugar de Alta
                            </label>
                            <input type="text" class="form-control modern-input" id="evaluado_lugar_alta" readonly>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">
                                <i class="bi bi-briefcase me-1"></i>Puesto que ocupa
                            </label>
                            <input type="text" class="form-control modern-input" id="evaluado_puesto" readonly>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">
                                <i class="bi bi-clock me-1"></i>Tiempo de ocupar el puesto
                            </label>
                            <input type="text" class="form-control modern-input" id="evaluado_tiempo" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sección II: DATOS DEL EVALUADOR -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card main-card">
                <div class="card-header bg-info text-white text-center header-gradient-secondary">
                    <div class="evaluation-icon">
                        <i class="bi bi-person-gear"></i>
                    </div>
                    <h4 class="mb-0 header-title">II. DATOS DEL EVALUADOR</h4>
                </div>
                <div class="card-body form-section">
                    <form id="FormEvaluacion">
                        <!-- Campos ocultos -->
                        <input type="hidden" id="bol_cat_evaluado" name="bol_cat_evaluado">
                        <input type="hidden" id="bol_anio" name="bol_anio" value="2025">
                        <input type="hidden" id="bol_ceom" name="bol_ceom">

                        <div class="row mb-3">
                            <div class="col-md-2">
                                <label class="form-label required">
                                    <i class="bi bi-person-badge me-1"></i>No. Catálogo *
                                </label>
                                <input type="text" class="form-control modern-input" id="evaluador_catalogo" name="bol_cat_evaluador" required>
                                <div class="invalid-feedback" id="error_evaluador_catalogo"></div>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">
                                    <i class="bi bi-award me-1"></i>Grado Militar
                                </label>
                                <input type="text" class="form-control modern-input" id="evaluador_grado" readonly>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">1er. Nombre</label>
                                <input type="text" class="form-control modern-input" id="evaluador_nom1" readonly>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">2do. Nombre</label>
                                <input type="text" class="form-control modern-input" id="evaluador_nom2" readonly>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">1er. Apellido</label>
                                <input type="text" class="form-control modern-input" id="evaluador_ape1" readonly>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">2do. Apellido</label>
                                <input type="text" class="form-control modern-input" id="evaluador_ape2" readonly>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label">
                                    <i class="bi bi-briefcase me-1"></i>Puesto que ocupa
                                </label>
                                <input type="text" class="form-control modern-input" id="evaluador_puesto" readonly>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">
                                    <i class="bi bi-clock-history me-1"></i>Tiempo de supervisar al Evaluado
                                </label>
                                <input type="text" class="form-control modern-input" id="evaluador_tiempo" readonly>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">
                                    <i class="bi bi-calendar-check me-1"></i>Año de la Evaluación
                                </label>
                                <input type="text" class="form-control modern-input" value="2025" readonly>
                            </div>
                        </div>

                        <!-- Alerta de validación -->
                        <div class="row mb-3">
                            <div class="col-12">
                                <div id="alerta_validacion" class="alert d-none" role="alert">
                                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                    <span id="mensaje_validacion"></span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="text-center button-section">
                            <button class="btn btn-success btn-modern me-3" type="submit" id="BtnGuardar">
                                <i class="bi bi-floppy me-2"></i>Guardar Datos de Evaluación
                            </button>
                            <button class="btn btn-secondary btn-modern" type="button" id="BtnLimpiar">
                                <i class="bi bi-arrow-clockwise me-2"></i>Limpiar Formulario
                            </button>
                            <a href="/evaluacion_desempe-o/evaluacionespecialistas" class="btn btn-outline-primary btn-modern">
                                <i class="bi bi-arrow-left me-2"></i>Volver al Listado
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    :root {
        --primary-blue: #1e3a8a;
        --secondary-blue: #3b82f6;
        --info-blue: #0ea5e9;
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
    .main-card {
        border: none;
        border-radius: 20px;
        box-shadow: var(--shadow-large);
        backdrop-filter: blur(20px);
        background: rgba(255, 255, 255, 0.98);
        overflow: hidden;
        transition: all 0.3s ease;
        margin-bottom: 2rem;
    }
    
    .main-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
    }
    
    /* Header principal */
    .header-gradient {
        background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 50%, var(--accent-blue) 100%) !important;
        border-radius: 20px 20px 0 0 !important;
        padding: 3rem 2rem;
        position: relative;
        overflow: hidden;
    }

    /* Header secundario */
    .header-gradient-secondary {
        background: linear-gradient(135deg, var(--info-blue) 0%, var(--secondary-blue) 100%) !important;
        border-radius: 20px 20px 0 0 !important;
        padding: 2rem;
        position: relative;
        overflow: hidden;
    }
    
    .header-gradient::before,
    .header-gradient-secondary::before {
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
    
    /* Ícono de evaluación */
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
    
    /* Badge militar */
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
        padding: 2.5rem;
        background: linear-gradient(135deg, rgba(255,255,255,0.9) 0%, rgba(248,250,252,0.9) 100%);
    }
    
    /* Labels */
    .form-label {
        font-weight: 600;
        color: var(--primary-blue);
        margin-bottom: 0.5rem;
        font-size: 0.9rem;
        display: flex;
        align-items: center;
    }
    
    .form-label.required::after {
        content: ' *';
        color: var(--danger-red);
        font-weight: bold;
    }
    
    .form-label i {
        color: var(--accent-blue);
    }
    
    /* Inputs modernos */
    .modern-input {
        border: 2px solid var(--border-light);
        border-radius: 12px;
        padding: 0.75rem 1rem;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        background: rgba(255, 255, 255, 0.95);
        box-shadow: var(--shadow-soft);
    }
    
    .modern-input:focus {
        border-color: var(--accent-blue);
        box-shadow: 0 0 0 0.25rem rgba(96, 165, 250, 0.15), var(--shadow-medium);
        transform: translateY(-1px);
        background: white;
    }
    
    .modern-input:hover:not([readonly]) {
        border-color: var(--secondary-blue);
        transform: translateY(-1px);
    }
    
    .modern-input[readonly] {
        background: linear-gradient(135deg, rgba(241, 245, 249, 0.8) 0%, rgba(248, 250, 252, 0.9) 100%);
        border-color: rgba(203, 213, 225, 0.6);
        color: var(--text-muted);
    }
    
    /* Sección de botones */
    .button-section {
        padding: 2rem 0 1rem 0;
        border-top: 1px solid rgba(229, 231, 235, 0.5);
        margin-top: 2rem;
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
        text-decoration: none;
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
    
    .btn-success.btn-modern {
        background: linear-gradient(135deg, var(--success-green) 0%, #059669 100%);
        box-shadow: 0 4px 15px rgba(16, 185, 129, 0.4);
    }
    
    .btn-success.btn-modern:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(16, 185, 129, 0.6);
        background: linear-gradient(135deg, #059669 0%, #047857 100%);
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
    
    .btn-outline-primary.btn-modern {
        background: transparent;
        border: 2px solid var(--primary-blue);
        color: var(--primary-blue);
        box-shadow: var(--shadow-soft);
    }
    
    .btn-outline-primary.btn-modern:hover {
        background: var(--primary-blue);
        color: white;
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(30, 58, 138, 0.4);
    }
    
    /* Alertas */
    .alert {
        border: none;
        border-radius: 12px;
        padding: 1rem 1.5rem;
        margin-bottom: 1rem;
        box-shadow: var(--shadow-soft);
        font-weight: 500;
    }
    
    .alert-danger {
        background: linear-gradient(135deg, rgba(239, 68, 68, 0.1) 0%, rgba(254, 226, 226, 0.8) 100%);
        border-left: 4px solid var(--danger-red);
        color: #991b1b;
    }
    
    .alert-warning {
        background: linear-gradient(135deg, rgba(245, 158, 11, 0.1) 0%, rgba(254, 243, 199, 0.8) 100%);
        border-left: 4px solid var(--warning-orange);
        color: #92400e;
    }
    
    /* Validación de campos */
    .is-invalid {
        border-color: var(--danger-red);
        box-shadow: 0 0 0 0.25rem rgba(239, 68, 68, 0.15);
    }
    
    .invalid-feedback {
        display: none;
        color: var(--danger-red);
        font-size: 0.875rem;
        margin-top: 0.25rem;
    }
    
    .is-invalid ~ .invalid-feedback {
        display: block;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .container {
            padding-left: 1rem;
            padding-right: 1rem;
        }
        
        .form-section {
            padding: 2rem 1.5rem;
        }
        
        .header-gradient,
        .header-gradient-secondary {
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
        
        .form-label {
            font-size: 0.85rem;
        }
        
        .modern-input {
            padding: 0.625rem 0.875rem;
            font-size: 0.85rem;
        }
    }
</style>

<script src="<?= asset('build/js/evaluacionformulario/index.js') ?>"></script>