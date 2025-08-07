<!-- PÁGINA 1: DATOS DEL EVALUADO/EVALUADOR + FACTORES DE SALUD Y CONDUCTA -->

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
                        SERIE TÉCNICA TIPO ("C") - PÁGINA 1 DE 2
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
                    <form id="FormEvaluacionPagina1">
                        <!-- Campos ocultos -->
                        <input type="hidden" id="bol_cat_evaluado" name="bol_cat_evaluado">
                        <input type="hidden" id="bol_anio" name="bol_anio" value="2025">
                        <input type="hidden" id="bol_ceom" name="bol_ceom">

                        <div class="row mb-3">
                            <div class="col-md-2">
                                <label class="form-label required">
                                    <i class="bi bi-person-badge me-1"></i>No. Catálogo *
                                </label>
                                <input type="text" class="form-control modern-input" id="evaluador_catalogo"
                                    name="bol_cat_evaluador" required>
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
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Sección III: FACTORES DE SALUD Y CONDUCTA -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card main-card">
                <div class="card-header bg-success text-white text-center header-gradient-success">
                    <div class="evaluation-icon">
                        <i class="bi bi-heart-pulse"></i>
                    </div>
                    <h4 class="mb-0 header-title">III. FACTORES DE SALUD Y CONDUCTA</h4>
                </div>
                <div class="card-body form-section">
                    <!-- A. Perfil Biofísico -->
                    <div class="subsection mb-4">
                        <div class="subsection-header mb-3">
                            <h5 class="subsection-title">
                                <i class="bi bi-person-check me-2"></i>
                                A. Perfil Biofísico
                            </h5>
                        </div>

                        <div class="instructions-box mb-4">
                            <div class="instruction-item mb-3">
                                <span class="instruction-number">1.</span>
                                <span class="instruction-text">
                                    El Oficial Médico de la brigada, comando, dependencia o servicio militar deberá
                                    realizar una evaluación antropométrica, para establecer el perfil biofísico del
                                    evaluado.
                                </span>
                            </div>
                            <div class="instruction-item mb-3">
                                <span class="instruction-number">2.</span>
                                <span class="instruction-text">
                                    El Oficial evaluador, de conformidad al resultado médico, deberá marcar una X en la
                                    categoría en que se encuentre clasificado el evaluado.
                                </span>
                            </div>
                        </div>

                        <div class="perfil-biofisico-container">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="categorias-perfil">
                                        <div class="categoria-item" data-value="1">
                                            <div class="categoria-content">
                                                <input type="radio" id="perfil_obesidad2" name="bol_perfil" value="1"
                                                    class="categoria-radio">
                                                <label for="perfil_obesidad2" class="categoria-label">
                                                    OBESIDAD II
                                                </label>
                                            </div>
                                        </div>
                                        <div class="categoria-item" data-value="2">
                                            <div class="categoria-content">
                                                <input type="radio" id="perfil_obesidad1" name="bol_perfil" value="2"
                                                    class="categoria-radio">
                                                <label for="perfil_obesidad1" class="categoria-label">
                                                    OBESIDAD I
                                                </label>
                                            </div>
                                        </div>
                                        <div class="categoria-item" data-value="3">
                                            <div class="categoria-content">
                                                <input type="radio" id="perfil_sobrepeso" name="bol_perfil" value="3"
                                                    class="categoria-radio">
                                                <label for="perfil_sobrepeso" class="categoria-label">
                                                    SOBREPESO
                                                </label>
                                            </div>
                                        </div>
                                        <div class="categoria-item" data-value="4">
                                            <div class="categoria-content">
                                                <input type="radio" id="perfil_deficit" name="bol_perfil" value="4"
                                                    class="categoria-radio">
                                                <label for="perfil_deficit" class="categoria-label">
                                                    DÉFICIT
                                                </label>
                                            </div>
                                        </div>
                                        <div class="categoria-item" data-value="5">
                                            <div class="categoria-content">
                                                <input type="radio" id="perfil_normal" name="bol_perfil" value="5"
                                                    class="categoria-radio">
                                                <label for="perfil_normal" class="categoria-label">
                                                    NORMAL
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="puntos-header mb-2">
                                        <h6 class="text-center mb-3">
                                            <i class="bi bi-award me-2"></i>
                                            Puntos
                                        </h6>
                                    </div>
                                    <div class="puntos-container">
                                        <div class="punto-item" data-value="1">
                                            <div class="punto-box">1</div>
                                        </div>
                                        <div class="punto-item" data-value="2">
                                            <div class="punto-box">2</div>
                                        </div>
                                        <div class="punto-item" data-value="3">
                                            <div class="punto-box">3</div>
                                        </div>
                                        <div class="punto-item" data-value="4">
                                            <div class="punto-box">4</div>
                                        </div>
                                        <div class="punto-item" data-value="5">
                                            <div class="punto-box">5</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="seleccion-actual mt-3">
                                <div class="alert alert-info d-none" id="perfil_seleccionado">
                                    <i class="bi bi-info-circle me-2"></i>
                                    <span id="perfil_texto">Seleccione una categoría de perfil biofísico</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- B. Condición Física -->
                    <div class="subsection mb-4">
                        <div class="subsection-header mb-3">
                            <h5 class="subsection-title">
                                <i class="bi bi-activity me-2"></i>
                                B. Condición Física
                            </h5>
                        </div>

                        <div class="instructions-box mb-4">
                            <div class="instruction-text mb-3">
                                En el espacio siguiente anote el resultado de las últimas 4 pruebas de aptitud física 
                                (PAFE) realizadas, establezca el promedio de las mismas.
                            </div>
                            <div class="instruction-item mb-3">
                                <span class="instruction-text">
                                    Luego, el evaluador deberá marcar una X en el rango donde se encuentre ubicado el promedio obtenido.
                                    <strong>Nota:</strong> Si no tiene alguna nota deberá ingresar como cero "0".
                                </span>
                            </div>
                        </div>

                        <div class="condicion-fisica-container">
                            <div class="row mb-4">
                                <div class="col-12">
                                    <div class="evaluaciones-header mb-3">
                                        <h6 class="text-center mb-0">
                                            <i class="bi bi-clipboard-data me-2"></i>
                                            Evaluaciones PAFE (Últimos 4 Meses)
                                        </h6>
                                    </div>
                                    
                                    <div class="evaluaciones-grid">
                                        <div class="evaluacion-item">
                                            <label class="evaluacion-label">1era Evaluación</label>
                                            <input type="number" id="pafe_eva1" name="bol_eva1" class="form-control pafe-input" readonly>
                                            <small class="text-muted" id="mes_eva1">Abril 2025</small>
                                        </div>
                                        <div class="evaluacion-plus">+</div>
                                        <div class="evaluacion-item">
                                            <label class="evaluacion-label">2da Evaluación</label>
                                            <input type="number" id="pafe_eva2" name="bol_eva2" class="form-control pafe-input" readonly>
                                            <small class="text-muted" id="mes_eva2">Mayo 2025</small>
                                        </div>
                                        <div class="evaluacion-plus">+</div>
                                        <div class="evaluacion-item">
                                            <label class="evaluacion-label">3era Evaluación</label>
                                            <input type="number" id="pafe_eva3" name="bol_eva3" class="form-control pafe-input" readonly>
                                            <small class="text-muted" id="mes_eva3">Junio 2025</small>
                                        </div>
                                        <div class="evaluacion-plus">+</div>
                                        <div class="evaluacion-item">
                                            <label class="evaluacion-label">4ta Evaluación</label>
                                            <input type="number" id="pafe_eva4" name="bol_eva4" class="form-control pafe-input" readonly>
                                            <small class="text-muted" id="mes_eva4">Julio 2025</small>
                                        </div>
                                        <div class="evaluacion-equals">=</div>
                                        <div class="evaluacion-item promedio-item">
                                            <label class="evaluacion-label">Promedio</label>
                                            <input type="number" id="pafe_promedio" class="form-control promedio-input" readonly>
                                            <small class="text-success" id="promedio_texto">Calculado automáticamente</small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-8">
                                    <div class="rangos-header mb-3">
                                        <h6><i class="bi bi-target me-2"></i>Rangos de Puntuación</h6>
                                    </div>
                                    <div class="rangos-container">
                                        <input type="hidden" id="bol_pafe" name="bol_pafe">
                                        
                                        <div class="rango-item" data-value="0">
                                            <div class="rango-content">
                                                <input type="radio" id="rango_0_59" name="rango_pafe" value="0" class="rango-radio" disabled>
                                                <label for="rango_0_59" class="rango-label">De 0 a 59</label>
                                            </div>
                                        </div>
                                        <div class="rango-item" data-value="2">
                                            <div class="rango-content">
                                                <input type="radio" id="rango_60_70" name="rango_pafe" value="2" class="rango-radio" disabled>
                                                <label for="rango_60_70" class="rango-label">De 60 a 70</label>
                                            </div>
                                        </div>
                                        <div class="rango-item" data-value="3">
                                            <div class="rango-content">
                                                <input type="radio" id="rango_71_80" name="rango_pafe" value="3" class="rango-radio" disabled>
                                                <label for="rango_71_80" class="rango-label">De 71 a 80</label>
                                            </div>
                                        </div>
                                        <div class="rango-item" data-value="4">
                                            <div class="rango-content">
                                                <input type="radio" id="rango_81_90" name="rango_pafe" value="4" class="rango-radio" disabled>
                                                <label for="rango_81_90" class="rango-label">De 81 a 90</label>
                                            </div>
                                        </div>
                                        <div class="rango-item" data-value="5">
                                            <div class="rango-content">
                                                <input type="radio" id="rango_91_mas" name="rango_pafe" value="5" class="rango-radio" disabled>
                                                <label for="rango_91_mas" class="rango-label">De 91 a más</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="puntos-header mb-3">
                                        <h6 class="text-center">
                                            <i class="bi bi-award me-2"></i>
                                            Puntos
                                        </h6>
                                    </div>
                                    <div class="puntos-pafe-container">
                                        <div class="punto-pafe-item" data-value="0">
                                            <div class="punto-pafe-box">0</div>
                                        </div>
                                        <div class="punto-pafe-item" data-value="2">
                                            <div class="punto-pafe-box">2</div>
                                        </div>
                                        <div class="punto-pafe-item" data-value="3">
                                            <div class="punto-pafe-box">3</div>
                                        </div>
                                        <div class="punto-pafe-item" data-value="4">
                                            <div class="punto-pafe-box">4</div>
                                        </div>
                                        <div class="punto-pafe-item" data-value="5">
                                            <div class="punto-pafe-box">5</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="pafe-status mt-3">
                                <div class="alert alert-info d-none" id="pafe_info">
                                    <i class="bi bi-info-circle me-2"></i>
                                    <span id="pafe_mensaje">Cargando evaluaciones PAFE...</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- C. Deméritos -->
                    <div class="subsection mb-4">
                        <div class="subsection-header mb-3">
                            <h5 class="subsection-title">
                                <i class="bi bi-exclamation-triangle me-2"></i>
                                C. Deméritos
                            </h5>
                        </div>

                        <div class="instructions-box mb-4">
                            <div class="instruction-text">
                                Verifique cuidadosamente en archivos físicos y magnéticos, la cantidad de deméritos acumulados 
                                por el especialista, durante el periodo de evaluación; luego, marque con una X el rango donde se 
                                encuentre la cantidad encontrada.
                            </div>
                        </div>

                        <div class="demeritos-container">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="rangos-header mb-3">
                                        <h6><i class="bi bi-list-ol me-2"></i>Rango</h6>
                                    </div>
                                    <div class="rangos-demeritos-container">
                                        <input type="hidden" id="bol_demeritos" name="bol_demeritos">
                                        
                                        <div class="rango-demeritos-item" data-value="5">
                                            <div class="rango-content">
                                                <input type="radio" id="demeritos_0" name="rango_demeritos" value="5" class="rango-radio">
                                                <label for="demeritos_0" class="rango-label">0</label>
                                            </div>
                                        </div>
                                        <div class="rango-demeritos-item" data-value="4">
                                            <div class="rango-content">
                                                <input type="radio" id="demeritos_1_18" name="rango_demeritos" value="4" class="rango-radio">
                                                <label for="demeritos_1_18" class="rango-label">De 1 a 18</label>
                                            </div>
                                        </div>
                                        <div class="rango-demeritos-item" data-value="3">
                                            <div class="rango-content">
                                                <input type="radio" id="demeritos_19_36" name="rango_demeritos" value="3" class="rango-radio">
                                                <label for="demeritos_19_36" class="rango-label">De 19 a 36</label>
                                            </div>
                                        </div>
                                        <div class="rango-demeritos-item" data-value="2">
                                            <div class="rango-content">
                                                <input type="radio" id="demeritos_37_54" name="rango_demeritos" value="2" class="rango-radio">
                                                <label for="demeritos_37_54" class="rango-label">De 37 a 54</label>
                                            </div>
                                        </div>
                                        <div class="rango-demeritos-item" data-value="1">
                                            <div class="rango-content">
                                                <input type="radio" id="demeritos_55_74" name="rango_demeritos" value="1" class="rango-radio">
                                                <label for="demeritos_55_74" class="rango-label">De 55 a 74</label>
                                            </div>
                                        </div>
                                        <div class="rango-demeritos-item" data-value="0">
                                            <div class="rango-content">
                                                <input type="radio" id="demeritos_75_100" name="rango_demeritos" value="0" class="rango-radio">
                                                <label for="demeritos_75_100" class="rango-label">De 75 a 100</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="puntos-header mb-3">
                                        <h6 class="text-center">
                                            <i class="bi bi-award me-2"></i>
                                            Puntos
                                        </h6>
                                    </div>
                                    <div class="puntos-demeritos-container">
                                        <div class="punto-demeritos-item" data-value="5">
                                            <div class="punto-demeritos-box">5</div>
                                        </div>
                                        <div class="punto-demeritos-item" data-value="4">
                                            <div class="punto-demeritos-box">4</div>
                                        </div>
                                        <div class="punto-demeritos-item" data-value="3">
                                            <div class="punto-demeritos-box">3</div>
                                        </div>
                                        <div class="punto-demeritos-item" data-value="2">
                                            <div class="punto-demeritos-box">2</div>
                                        </div>
                                        <div class="punto-demeritos-item" data-value="1">
                                            <div class="punto-demeritos-box">1</div>
                                        </div>
                                        <div class="punto-demeritos-item" data-value="0">
                                            <div class="punto-demeritos-box">0</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="seleccion-actual mt-3">
                                <div class="alert alert-info d-none" id="demeritos_seleccionado">
                                    <i class="bi bi-info-circle me-2"></i>
                                    <span id="demeritos_texto">Seleccione un rango de deméritos</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- D. Arrestos -->
                    <div class="subsection mb-4">
                        <div class="subsection-header mb-3">
                            <h5 class="subsection-title">
                                <i class="bi bi-person-x me-2"></i>
                                D. Arrestos
                            </h5>
                        </div>

                        <div class="instructions-box mb-4">
                            <div class="instruction-text">
                                Verifique cuidadosamente en archivos físicos y magnéticos, la cantidad de arrestos impuestos al 
                                especialista, durante el periodo de evaluación; luego, marque con una X el rango en donde se 
                                encuentre la cantidad encontrada.
                            </div>
                        </div>

                        <div class="arrestos-container">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="rangos-header mb-3">
                                        <h6><i class="bi bi-list-ol me-2"></i>Rango</h6>
                                    </div>
                                    <div class="rangos-arrestos-container">
                                        <input type="hidden" id="bol_arrestos" name="bol_arrestos">
                                        
                                        <div class="rango-arrestos-item" data-value="5">
                                            <div class="rango-content">
                                                <input type="radio" id="arrestos_0" name="rango_arrestos" value="5" class="rango-radio">
                                                <label for="arrestos_0" class="rango-label">0</label>
                                            </div>
                                        </div>
                                        <div class="rango-arrestos-item" data-value="4">
                                            <div class="rango-content">
                                                <input type="radio" id="arrestos_1_5" name="rango_arrestos" value="4" class="rango-radio">
                                                <label for="arrestos_1_5" class="rango-label">De 1 a 5</label>
                                            </div>
                                        </div>
                                        <div class="rango-arrestos-item" data-value="3">
                                            <div class="rango-content">
                                                <input type="radio" id="arrestos_6_10" name="rango_arrestos" value="3" class="rango-radio">
                                                <label for="arrestos_6_10" class="rango-label">De 6 a 10</label>
                                            </div>
                                        </div>
                                        <div class="rango-arrestos-item" data-value="2">
                                            <div class="rango-content">
                                                <input type="radio" id="arrestos_11_15" name="rango_arrestos" value="2" class="rango-radio">
                                                <label for="arrestos_11_15" class="rango-label">De 11 a 15</label>
                                            </div>
                                        </div>
                                        <div class="rango-arrestos-item" data-value="1">
                                            <div class="rango-content">
                                                <input type="radio" id="arrestos_16_mas" name="rango_arrestos" value="1" class="rango-radio">
                                                <label for="arrestos_16_mas" class="rango-label">De 16 a más</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="puntos-header mb-3">
                                        <h6 class="text-center">
                                            <i class="bi bi-award me-2"></i>
                                            Puntos
                                        </h6>
                                    </div>
                                    <div class="puntos-arrestos-container">
                                        <div class="punto-arrestos-item" data-value="5">
                                            <div class="punto-arrestos-box">5</div>
                                        </div>
                                        <div class="punto-arrestos-item" data-value="4">
                                            <div class="punto-arrestos-box">4</div>
                                        </div>
                                        <div class="punto-arrestos-item" data-value="3">
                                            <div class="punto-arrestos-box">3</div>
                                        </div>
                                        <div class="punto-arrestos-item" data-value="2">
                                            <div class="punto-arrestos-box">2</div>
                                        </div>
                                        <div class="punto-arrestos-item" data-value="1">
                                            <div class="punto-arrestos-box">1</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="seleccion-actual mt-3">
                                <div class="alert alert-info d-none" id="arrestos_seleccionado">
                                    <i class="bi bi-info-circle me-2"></i>
                                    <span id="arrestos_texto">Seleccione un rango de arrestos</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- E. Méritos -->
                    <div class="subsection mb-4">
                        <div class="subsection-header mb-3">
                            <h5 class="subsection-title">
                                <i class="bi bi-award me-2"></i>
                                E. Méritos
                            </h5>
                        </div>

                        <div class="instructions-box mb-4">
                            <div class="instruction-text">
                                Se refiere a las acciones sobresalientes, extraordinarias y ejemplares que el evaluado 
                                halla realizado en beneficio de su unidad o de la institución armada, durante el año de 
                                evaluación. En los cuadros de la derecha el evaluador deberá escribir los méritos del evaluado 
                                iniciando con la fecha en que se ejecutó la acción. Asimismo, adjuntar a esta hoja, la 
                                constancia respectiva.
                            </div>
                        </div>

                        <div class="meritos-container">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="merito-item mb-4">
                                        <div class="merito-header">
                                            <h6><i class="bi bi-star-fill me-2"></i>Mérito 1</h6>
                                            <small class="text-muted">Seleccione todas las condecoraciones aplicables</small>
                                        </div>
                                        
                                        <select class="form-control merito-select" id="merito_1" name="meritos_3[]" 
                                                multiple size="6" data-nota="3">
                                            <option value="">Cargando méritos...</option>
                                        </select>
                                        
                                        <div class="merito-controls mt-2">
                                            <button type="button" class="btn btn-sm btn-outline-primary" 
                                                    onclick="marcarTodosLosMeritos('merito_1')">
                                                <i class="bi bi-check-all me-1"></i>Marcar Todas
                                            </button>
                                            <button type="button" class="btn btn-sm btn-outline-secondary" 
                                                    onclick="limpiarMeritos('merito_1')">
                                                <i class="bi bi-x-circle me-1"></i>Limpiar
                                            </button>
                                            <span class="badge bg-info ms-2" id="contador_merito_1">0 seleccionados</span>
                                        </div>
                                    </div>

                                    <div class="merito-item mb-4">
                                        <div class="merito-header">
                                            <h6><i class="bi bi-star me-2"></i>Mérito 2</h6>
                                            <small class="text-muted">Seleccione todas las condecoraciones aplicables</small>
                                        </div>
                                        
                                        <select class="form-control merito-select" id="merito_2" name="meritos_2[]" 
                                                multiple size="6" data-nota="2">
                                            <option value="">Cargando méritos...</option>
                                        </select>
                                        
                                        <div class="merito-controls mt-2">
                                            <button type="button" class="btn btn-sm btn-outline-primary" 
                                                    onclick="marcarTodosLosMeritos('merito_2')">
                                                <i class="bi bi-check-all me-1"></i>Marcar Todas
                                            </button>
                                            <button type="button" class="btn btn-sm btn-outline-secondary" 
                                                    onclick="limpiarMeritos('merito_2')">
                                                <i class="bi bi-x-circle me-1"></i>Limpiar
                                            </button>
                                            <span class="badge bg-info ms-2" id="contador_merito_2">0 seleccionados</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="puntos-header mb-3">
                                        <h6 class="text-center">
                                            <i class="bi bi-award me-2"></i>
                                            Puntos
                                        </h6>
                                    </div>
                                    
                                    <div class="puntos-meritos-container">
                                        <div class="punto-merito-item" data-merito="1">
                                            <div class="punto-merito-box merito-3-puntos">3</div>
                                            <small class="text-muted d-block text-center mt-1">Por cada selección</small>
                                        </div>
                                        <div class="punto-spacer my-4"></div>
                                        <div class="punto-merito-item" data-merito="2">
                                            <div class="punto-merito-box merito-2-puntos">2</div>
                                            <small class="text-muted d-block text-center mt-1">Por cada selección</small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="meritos-resumen mt-4">
                                <div class="alert alert-info" id="resumen_meritos">
                                    <i class="bi bi-info-circle me-2"></i>
                                    <strong>Total de Méritos:</strong> <span id="total_puntos_meritos">0</span> puntos
                                    <div id="detalle_meritos" class="mt-2"></div>
                                </div>
                            </div>

                            <input type="hidden" id="bol_meritos_total" name="bol_meritos_total" value="0">
                            <input type="hidden" id="bol_meritos_detalle" name="bol_meritos_detalle" value="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Botones de Navegación -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body text-center button-section">
                    <button class="btn btn-success btn-modern me-3" type="button" id="BtnGuardarPagina1">
                        <i class="bi bi-floppy me-2"></i>Guardar Página 1
                    </button>
                    <button class="btn btn-secondary btn-modern me-3" type="button" id="BtnLimpiar">
                        <i class="bi bi-arrow-clockwise me-2"></i>Limpiar Formulario
                    </button>
                    <button class="btn btn-primary btn-modern me-3" type="button" id="BtnSiguientePagina" disabled>
                        <i class="bi bi-arrow-right me-2"></i>Siguiente: Conceptualización
                    </button>
                    <a href="/evaluacion_desempe-o/evaluacionespecialistas" class="btn btn-outline-secondary btn-modern">
                        <i class="bi bi-arrow-left me-2"></i>Volver al Listado
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Incluir CSS desde tu archivo principal -->
<link rel="stylesheet" href="<?= asset('build/styles.css') ?>">

<!-- JavaScript específico para Página 1 -->
<script src="<?= asset('build/js/evaluacionformulario/pagina1.js') ?>"></script>