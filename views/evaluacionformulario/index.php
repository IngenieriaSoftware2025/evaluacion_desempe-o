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

                        <div class="text-center button-section">
                            <button class="btn btn-success btn-modern me-3" type="submit" id="BtnGuardar">
                                <i class="bi bi-floppy me-2"></i>Guardar Datos de Evaluación
                            </button>
                            <button class="btn btn-secondary btn-modern" type="button" id="BtnLimpiar">
                                <i class="bi bi-arrow-clockwise me-2"></i>Limpiar Formulario
                            </button>
                            <a href="/evaluacion_desempe-o/evaluacionespecialistas"
                                class="btn btn-outline-primary btn-modern">
                                <i class="bi bi-arrow-left me-2"></i>Volver al Listado
                            </a>
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

                        <!-- Instrucciones -->
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

                        <!-- Opciones de Perfil Biofísico -->
                        <div class="perfil-biofisico-container">
                            <div class="row">
                                <!-- Columna de categorías -->
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

                                <!-- Columna de puntos -->
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

                            <!-- Indicador de selección actual -->
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

                        <!-- Instrucciones -->
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

                        <!-- Contenedor principal de condición física -->
                        <div class="condicion-fisica-container">
                            <!-- Evaluaciones PAFE -->
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

                            <!-- Rangos de Puntuación -->
                            <div class="row">
                                <!-- Columna de rangos -->
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

                                <!-- Columna de puntos -->
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

                            <!-- Estado de carga -->
                            <div class="pafe-status mt-3">
                                <div class="alert alert-info d-none" id="pafe_info">
                                    <i class="bi bi-info-circle me-2"></i>
                                    <span id="pafe_mensaje">Cargando evaluaciones PAFE...</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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

    <!-- Instrucciones -->
    <div class="instructions-box mb-4">
        <div class="instruction-text">
            Verifique cuidadosamente en archivos físicos y magnéticos, la cantidad de deméritos acumulados 
            por el especialista, durante el periodo de evaluación; luego, marque con una X el rango donde se 
            encuentre la cantidad encontrada.
        </div>
    </div>

    <!-- Contenedor principal de deméritos -->
    <div class="demeritos-container">
        <div class="row">
            <!-- Columna de rangos -->
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

            <!-- Columna de puntos -->
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

        <!-- Indicador de selección actual -->
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

    <!-- Instrucciones -->
    <div class="instructions-box mb-4">
        <div class="instruction-text">
            Verifique cuidadosamente en archivos físicos y magnéticos, la cantidad de arrestos impuestos al 
            especialista, durante el periodo de evaluación; luego, marque con una X el rango en donde se 
            encuentre la cantidad encontrada.
        </div>
    </div>

    <!-- Contenedor principal de arrestos -->
    <div class="arrestos-container">
        <div class="row">
            <!-- Columna de rangos -->
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

            <!-- Columna de puntos -->
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

        <!-- Indicador de selección actual -->
        <div class="seleccion-actual mt-3">
            <div class="alert alert-info d-none" id="arrestos_seleccionado">
                <i class="bi bi-info-circle me-2"></i>
                <span id="arrestos_texto">Seleccione un rango de arrestos</span>
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

/* Header success */
.header-gradient-success {
    background: linear-gradient(135deg, var(--success-green) 0%, #059669 100%) !important;
    border-radius: 20px 20px 0 0 !important;
    padding: 2rem;
    position: relative;
    overflow: hidden;
}

.header-gradient::before,
.header-gradient-secondary::before,
.header-gradient-success::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -50%;
    width: 200%;
    height: 200%;
    background: linear-gradient(45deg, rgba(255, 255, 255, 0.1) 0%, transparent 50%, rgba(255, 255, 255, 0.05) 100%);
    transform: rotate(45deg);
    animation: shimmer 3s ease-in-out infinite;
}

@keyframes shimmer {
    0%, 100% { opacity: 0.3; }
    50% { opacity: 0.7; }
}

.header-subtitle,
.header-title {
    position: relative;
    z-index: 2;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
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
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.2) 0%, rgba(255, 255, 255, 0.1) 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.5rem;
    border: 3px solid rgba(255, 255, 255, 0.3);
    position: relative;
    z-index: 2;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
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
    border: 2px solid rgba(255, 255, 255, 0.2);
}

/* Sección de formulario */
.form-section {
    padding: 2.5rem;
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.9) 0%, rgba(248, 250, 252, 0.9) 100%);
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
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
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

.is-invalid~.invalid-feedback {
    display: block;
}

/* Subsecciones */
.subsection {
    border: 2px solid var(--border-light);
    border-radius: 15px;
    padding: 1.5rem;
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(248, 250, 252, 0.95) 100%);
    box-shadow: var(--shadow-soft);
}

.subsection-header {
    border-bottom: 2px solid var(--success-green);
    padding-bottom: 0.75rem;
    margin-bottom: 1.5rem;
}

.subsection-title {
    color: var(--success-green);
    font-weight: 700;
    font-size: 1.2rem;
    display: flex;
    align-items: center;
    margin: 0;
}

.instructions-box {
    background: linear-gradient(135deg, rgba(16, 185, 129, 0.05) 0%, rgba(243, 244, 246, 0.8) 100%);
    border: 1px solid rgba(16, 185, 129, 0.2);
    border-radius: 12px;
    padding: 1.5rem;
    margin-bottom: 1.5rem;
}

.instruction-item {
    display: flex;
    align-items: flex-start;
    margin-bottom: 1rem;
    line-height: 1.6;
}

.instruction-number {
    background: var(--success-green);
    color: white;
    width: 24px;
    height: 24px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    font-size: 0.9rem;
    margin-right: 1rem;
    flex-shrink: 0;
}

.instruction-text {
    color: var(--text-dark);
    font-size: 0.95rem;
    text-align: justify;
}

/* Perfil Biofísico */
.perfil-biofisico-container {
    border: 2px solid var(--success-green);
    border-radius: 12px;
    padding: 1.5rem;
    background: rgba(255, 255, 255, 0.8);
}

.categorias-perfil {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
}

.categoria-item {
    border: 2px solid var(--border-light);
    border-radius: 10px;
    transition: all 0.3s ease;
    cursor: pointer;
    background: white;
}

.categoria-item:hover {
    border-color: var(--success-green);
    transform: translateX(5px);
    box-shadow: var(--shadow-soft);
}

.categoria-item.selected {
    border-color: var(--success-green);
    background: linear-gradient(135deg, rgba(16, 185, 129, 0.1) 0%, rgba(16, 185, 129, 0.05) 100%);
    box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
}

.categoria-content {
    padding: 1rem 1.5rem;
    display: flex;
    align-items: center;
}

.categoria-radio {
    margin-right: 1rem;
    width: 18px;
    height: 18px;
    accent-color: var(--success-green);
    cursor: pointer;
}

.categoria-label {
    font-weight: 600;
    font-size: 1rem;
    color: var(--text-dark);
    cursor: pointer;
    margin: 0;
    user-select: none;
}

.categoria-item.selected .categoria-label {
    color: var(--success-green);
}

.puntos-header h6 {
    color: var(--success-green);
    font-weight: 700;
    border-bottom: 2px solid var(--success-green);
    padding-bottom: 0.5rem;
}

.puntos-container {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
    align-items: center;
}

.punto-item {
    transition: all 0.3s ease;
}

.punto-box {
    width: 50px;
    height: 45px;
    border: 2px solid var(--border-light);
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    font-size: 1.2rem;
    color: var(--text-muted);
    background: white;
    transition: all 0.3s ease;
}

.punto-item.selected .punto-box {
    background: var(--success-green);
    color: white;
    border-color: var(--success-green);
    transform: scale(1.1);
    box-shadow: 0 4px 15px rgba(16, 185, 129, 0.4);
}

.seleccion-actual {
    text-align: center;
}

#perfil_seleccionado {
    border: none;
    background: linear-gradient(135deg, rgba(59, 130, 246, 0.1) 0%, rgba(219, 234, 254, 0.8) 100%);
    border-left: 4px solid var(--secondary-blue);
    color: var(--secondary-blue);
    font-weight: 500;
}

/* Condición Física */
.condicion-fisica-container {
    border: 2px solid #3b82f6;
    border-radius: 12px;
    padding: 1.5rem;
    background: rgba(255, 255, 255, 0.9);
}

.evaluaciones-header h6 {
    color: #3b82f6;
    font-weight: 700;
    border-bottom: 2px solid #3b82f6;
    padding-bottom: 0.5rem;
}

.evaluaciones-grid {
    display: flex;
    align-items: end;
    gap: 1rem;
    flex-wrap: wrap;
    justify-content: center;
    padding: 1.5rem;
    background: linear-gradient(135deg, rgba(59, 130, 246, 0.05) 0%, rgba(243, 244, 246, 0.8) 100%);
    border-radius: 10px;
    border: 1px solid rgba(59, 130, 246, 0.2);
}

.evaluacion-item {
    text-align: center;
    min-width: 120px;
}

.evaluacion-label {
    display: block;
    font-size: 0.85rem;
    font-weight: 600;
    color: #374151;
    margin-bottom: 0.5rem;
}

.pafe-input {
    width: 80px;
    height: 40px;
    text-align: center;
    font-weight: bold;
    font-size: 1.1rem;
    border: 2px solid #d1d5db;
    border-radius: 8px;
    background: white;
    margin: 0 auto;
}

.pafe-input:focus {
    border-color: #3b82f6;
    box-shadow: 0 0 0 0.2rem rgba(59, 130, 246, 0.25);
}

.evaluacion-plus,
.evaluacion-equals {
    font-size: 1.5rem;
    font-weight: bold;
    color: #6b7280;
    align-self: center;
    margin-top: -1rem;
}

.promedio-item .promedio-input {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    color: white;
    border: 2px solid #10b981;
    font-size: 1.2rem;
    font-weight: bold;
}

.rangos-header h6 {
    color: #3b82f6;
    font-weight: 700;
    border-bottom: 2px solid #3b82f6;
    padding-bottom: 0.5rem;
}

.rangos-container {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.rango-item {
    border: 2px solid #e5e7eb;
    border-radius: 8px;
    transition: all 0.3s ease;
    background: white;
}

.rango-item.selected {
    border-color: #3b82f6;
    background: linear-gradient(135deg, rgba(59, 130, 246, 0.1) 0%, rgba(59, 130, 246, 0.05) 100%);
    box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
}

.rango-content {
    padding: 0.75rem 1rem;
    display: flex;
    align-items: center;
}

.rango-radio {
    margin-right: 0.75rem;
    width: 16px;
    height: 16px;
    accent-color: #3b82f6;
}

.rango-label {
    font-weight: 600;
    color: #374151;
    cursor: not-allowed;
    margin: 0;
}

.rango-item.selected .rango-label {
    color: #3b82f6;
}

.puntos-pafe-container {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
    align-items: center;
}

.punto-pafe-item {
    transition: all 0.3s ease;
}

.punto-pafe-box {
    width: 50px;
    height: 42px;
    border: 2px solid #e5e7eb;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    font-size: 1.1rem;
    color: #6b7280;
    background: white;
    transition: all 0.3s ease;
}

.punto-pafe-item.selected .punto-pafe-box {
    background: #3b82f6;
    color: white;
    border-color: #3b82f6;
    transform: scale(1.1);
    box-shadow: 0 4px 15px rgba(59, 130, 246, 0.4);
}

#pafe_info {
    border: none;
    background: linear-gradient(135deg, rgba(59, 130, 246, 0.1) 0%, rgba(219, 234, 254, 0.8) 100%);
    border-left: 4px solid #3b82f6;
    color: #3b82f6;
    font-weight: 500;
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
    .header-gradient-secondary,
    .header-gradient-success {
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

    .perfil-biofisico-container {
        padding: 1rem;
    }

    .categoria-content {
        padding: 0.75rem 1rem;
    }

    .categoria-label {
        font-size: 0.9rem;
    }

    .punto-box {
        width: 40px;
        height: 40px;
        font-size: 1rem;
    }

    .instructions-box {
        padding: 1rem;
    }

    .instruction-text {
        font-size: 0.9rem;
    }

    .evaluaciones-grid {
        flex-direction: column;
        gap: 1.5rem;
    }

    .evaluacion-plus,
    .evaluacion-equals {
        display: none;
    }

    .evaluacion-item {
        min-width: auto;
        width: 100%;
    }

    .pafe-input {
        width: 100px;
    }
}

/* Estilos para Deméritos y Arrestos */
.demeritos-container,
.arrestos-container {
    border: 2px solid #dc2626;
    border-radius: 12px;
    padding: 1.5rem;
    background: rgba(255, 255, 255, 0.9);
}

.rangos-demeritos-container,
.rangos-arrestos-container {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.rango-demeritos-item,
.rango-arrestos-item {
    border: 2px solid #e5e7eb;
    border-radius: 8px;
    transition: all 0.3s ease;
    background: white;
    cursor: pointer;
}

.rango-demeritos-item:hover,
.rango-arrestos-item:hover {
    border-color: #dc2626;
    transform: translateX(3px);
}

.rango-demeritos-item.selected,
.rango-arrestos-item.selected {
    border-color: #dc2626;
    background: linear-gradient(135deg, rgba(220, 38, 38, 0.1) 0%, rgba(220, 38, 38, 0.05) 100%);
    box-shadow: 0 4px 15px rgba(220, 38, 38, 0.3);
}

.rango-demeritos-item .rango-content,
.rango-arrestos-item .rango-content {
    padding: 0.75rem 1rem;
    display: flex;
    align-items: center;
}

.rango-demeritos-item .rango-radio,
.rango-arrestos-item .rango-radio {
    margin-right: 0.75rem;
    width: 16px;
    height: 16px;
    accent-color: #dc2626;
    cursor: pointer;
}

.rango-demeritos-item .rango-label,
.rango-arrestos-item .rango-label {
    font-weight: 600;
    color: #374151;
    cursor: pointer;
    margin: 0;
    user-select: none;
}

.rango-demeritos-item.selected .rango-label,
.rango-arrestos-item.selected .rango-label {
    color: #dc2626;
}

.puntos-demeritos-container,
.puntos-arrestos-container {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
    align-items: center;
}

.punto-demeritos-item,
.punto-arrestos-item {
    transition: all 0.3s ease;
}

.punto-demeritos-box,
.punto-arrestos-box {
    width: 50px;
    height: 42px;
    border: 2px solid #e5e7eb;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    font-size: 1.1rem;
    color: #6b7280;
    background: white;
    transition: all 0.3s ease;
}

.punto-demeritos-item.selected .punto-demeritos-box,
.punto-arrestos-item.selected .punto-arrestos-box {
    background: #dc2626;
    color: white;
    border-color: #dc2626;
    transform: scale(1.1);
    box-shadow: 0 4px 15px rgba(220, 38, 38, 0.4);
}

#demeritos_seleccionado,
#arrestos_seleccionado {
    border: none;
    background: linear-gradient(135deg, rgba(220, 38, 38, 0.1) 0%, rgba(254, 226, 226, 0.8) 100%);
    border-left: 4px solid #dc2626;
    color: #dc2626;
    font-weight: 500;
}

/* Responsive */
@media (max-width: 768px) {
    .demeritos-container,
    .arrestos-container {
        padding: 1rem;
    }
    
    .rango-content {
        padding: 0.5rem 0.75rem;
    }
    
    .rango-label {
        font-size: 0.9rem;
    }
    
    .punto-demeritos-box,
    .punto-arrestos-box {
        width: 40px;
        height: 40px;
        font-size: 1rem;
    }
}
</style>

<script src="<?= asset('build/js/evaluacionformulario/index.js') ?>"></script>