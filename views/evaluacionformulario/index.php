<div class="container mt-4">
    <!-- Sección I: DATOS DEL EVALUADO -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card main-card">
                <div class="card-header bg-primary text-white text-center header-gradient">
                    <div class="evaluation-icon">
                        <i class="bi bi-person-check"></i>
                    </div>
                    <h5 class="mb-1 header-subtitle">DATOS DEL EVALUADO</h5>
                    <h4 class="mb-0 header-title">BOLETA DE EVALUACIÓN DEL DESEMPEÑO PARA ESPECIALISTAS</h4>
                   
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
                                <i class="bi bi-person-check me-2"></i>A. Perfil Biofísico
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

                        <div class="evaluation-container perfil-color">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="options-container">
                                        <div class="option-item" data-value="1">
                                            <input type="radio" id="perfil_obesidad2" name="bol_perfil" value="1" class="option-radio">
                                            <label for="perfil_obesidad2" class="option-label">OBESIDAD II</label>
                                        </div>
                                        <div class="option-item" data-value="2">
                                            <input type="radio" id="perfil_obesidad1" name="bol_perfil" value="2" class="option-radio">
                                            <label for="perfil_obesidad1" class="option-label">OBESIDAD I</label>
                                        </div>
                                        <div class="option-item" data-value="3">
                                            <input type="radio" id="perfil_sobrepeso" name="bol_perfil" value="3" class="option-radio">
                                            <label for="perfil_sobrepeso" class="option-label">SOBREPESO</label>
                                        </div>
                                        <div class="option-item" data-value="4">
                                            <input type="radio" id="perfil_deficit" name="bol_perfil" value="4" class="option-radio">
                                            <label for="perfil_deficit" class="option-label">DÉFICIT</label>
                                        </div>
                                        <div class="option-item" data-value="5">
                                            <input type="radio" id="perfil_normal" name="bol_perfil" value="5" class="option-radio">
                                            <label for="perfil_normal" class="option-label">NORMAL</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="points-container">
                                        <h6 class="points-header"><i class="bi bi-award me-2"></i>Puntos</h6>
                                        <div class="points-list">
                                            <div class="point-item" data-value="1"><div class="point-box">1</div></div>
                                            <div class="point-item" data-value="2"><div class="point-box">2</div></div>
                                            <div class="point-item" data-value="3"><div class="point-box">3</div></div>
                                            <div class="point-item" data-value="4"><div class="point-box">4</div></div>
                                            <div class="point-item" data-value="5"><div class="point-box">5</div></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="status-indicator mt-3">
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
                                <i class="bi bi-activity me-2"></i>B. Condición Física
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

                        <div class="evaluation-container pafe-color">
                            <!-- Evaluaciones PAFE Grid -->
                            <div class="pafe-grid mb-4">
                                <div class="pafe-item">
                                    <label class="pafe-label">1era Evaluación</label>
                                    <input type="number" id="pafe_eva1" name="bol_eva1" class="form-control pafe-input" readonly>
                                    <small class="text-muted" id="mes_eva1">Abril 2025</small>
                                </div>
                                <div class="pafe-operator">+</div>
                                <div class="pafe-item">
                                    <label class="pafe-label">2da Evaluación</label>
                                    <input type="number" id="pafe_eva2" name="bol_eva2" class="form-control pafe-input" readonly>
                                    <small class="text-muted" id="mes_eva2">Mayo 2025</small>
                                </div>
                                <div class="pafe-operator">+</div>
                                <div class="pafe-item">
                                    <label class="pafe-label">3era Evaluación</label>
                                    <input type="number" id="pafe_eva3" name="bol_eva3" class="form-control pafe-input" readonly>
                                    <small class="text-muted" id="mes_eva3">Junio 2025</small>
                                </div>
                                <div class="pafe-operator">+</div>
                                <div class="pafe-item">
                                    <label class="pafe-label">4ta Evaluación</label>
                                    <input type="number" id="pafe_eva4" name="bol_eva4" class="form-control pafe-input" readonly>
                                    <small class="text-muted" id="mes_eva4">Julio 2025</small>
                                </div>
                                <div class="pafe-operator">=</div>
                                <div class="pafe-item promedio-item">
                                    <label class="pafe-label">Promedio</label>
                                    <input type="number" id="pafe_promedio" class="form-control pafe-input promedio-input" readonly>
                                    <small class="text-success">Calculado automáticamente</small>
                                </div>
                            </div>

                            <!-- Rangos y Puntos -->
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="options-container">
                                        <input type="hidden" id="bol_pafe" name="bol_pafe">
                                        <div class="option-item" data-value="0">
                                            <input type="radio" id="rango_0_59" name="rango_pafe" value="0" class="option-radio" disabled>
                                            <label for="rango_0_59" class="option-label">De 0 a 59</label>
                                        </div>
                                        <div class="option-item" data-value="2">
                                            <input type="radio" id="rango_60_70" name="rango_pafe" value="2" class="option-radio" disabled>
                                            <label for="rango_60_70" class="option-label">De 60 a 70</label>
                                        </div>
                                        <div class="option-item" data-value="3">
                                            <input type="radio" id="rango_71_80" name="rango_pafe" value="3" class="option-radio" disabled>
                                            <label for="rango_71_80" class="option-label">De 71 a 80</label>
                                        </div>
                                        <div class="option-item" data-value="4">
                                            <input type="radio" id="rango_81_90" name="rango_pafe" value="4" class="option-radio" disabled>
                                            <label for="rango_81_90" class="option-label">De 81 a 90</label>
                                        </div>
                                        <div class="option-item" data-value="5">
                                            <input type="radio" id="rango_91_mas" name="rango_pafe" value="5" class="option-radio" disabled>
                                            <label for="rango_91_mas" class="option-label">De 91 a más</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="points-container">
                                        <h6 class="points-header"><i class="bi bi-award me-2"></i>Puntos</h6>
                                        <div class="points-list">
                                            <div class="point-item" data-value="0"><div class="point-box">0</div></div>
                                            <div class="point-item" data-value="2"><div class="point-box">2</div></div>
                                            <div class="point-item" data-value="3"><div class="point-box">3</div></div>
                                            <div class="point-item" data-value="4"><div class="point-box">4</div></div>
                                            <div class="point-item" data-value="5"><div class="point-box">5</div></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="status-indicator mt-3">
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
                                <i class="bi bi-exclamation-triangle me-2"></i>C. Deméritos
                            </h5>
                        </div>

                        <div class="instructions-box mb-4">
                            <div class="instruction-text">
                                Verifique cuidadosamente en archivos físicos y magnéticos, la cantidad de deméritos acumulados
                                por el especialista, durante el periodo de evaluación; luego, marque con una X el rango donde se
                                encuentre la cantidad encontrada.
                            </div>
                        </div>

                        <div class="evaluation-container demeritos-color">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="options-container">
                                        <input type="hidden" id="bol_demeritos" name="bol_demeritos">
                                        <div class="option-item rango-demeritos-item" data-value="5">
                                            <input type="radio" id="demeritos_0" name="rango_demeritos" value="5" class="option-radio">
                                            <label for="demeritos_0" class="option-label">0</label>
                                        </div>
                                        <div class="option-item rango-demeritos-item" data-value="4">
                                            <input type="radio" id="demeritos_1_18" name="rango_demeritos" value="4" class="option-radio">
                                            <label for="demeritos_1_18" class="option-label">De 1 a 18</label>
                                        </div>
                                        <div class="option-item rango-demeritos-item" data-value="3">
                                            <input type="radio" id="demeritos_19_36" name="rango_demeritos" value="3" class="option-radio">
                                            <label for="demeritos_19_36" class="option-label">De 19 a 36</label>
                                        </div>
                                        <div class="option-item rango-demeritos-item" data-value="2">
                                            <input type="radio" id="demeritos_37_54" name="rango_demeritos" value="2" class="option-radio">
                                            <label for="demeritos_37_54" class="option-label">De 37 a 54</label>
                                        </div>
                                        <div class="option-item rango-demeritos-item" data-value="1">
                                            <input type="radio" id="demeritos_55_74" name="rango_demeritos" value="1" class="option-radio">
                                            <label for="demeritos_55_74" class="option-label">De 55 a 74</label>
                                        </div>
                                        <div class="option-item rango-demeritos-item" data-value="0">
                                            <input type="radio" id="demeritos_75_100" name="rango_demeritos" value="0" class="option-radio">
                                            <label for="demeritos_75_100" class="option-label">De 75 a 100</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="points-container">
                                        <h6 class="points-header"><i class="bi bi-award me-2"></i>Puntos</h6>
                                        <div class="points-list">
                                            <div class="point-item punto-demeritos-item" data-value="5"><div class="point-box punto-demeritos-box">5</div></div>
                                            <div class="point-item punto-demeritos-item" data-value="4"><div class="point-box punto-demeritos-box">4</div></div>
                                            <div class="point-item punto-demeritos-item" data-value="3"><div class="point-box punto-demeritos-box">3</div></div>
                                            <div class="point-item punto-demeritos-item" data-value="2"><div class="point-box punto-demeritos-box">2</div></div>
                                            <div class="point-item punto-demeritos-item" data-value="1"><div class="point-box punto-demeritos-box">1</div></div>
                                            <div class="point-item punto-demeritos-item" data-value="0"><div class="point-box punto-demeritos-box">0</div></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="status-indicator mt-3">
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
                                <i class="bi bi-person-x me-2"></i>D. Arrestos
                            </h5>
                        </div>

                        <div class="instructions-box mb-4">
                            <div class="instruction-text">
                                Verifique cuidadosamente en archivos físicos y magnéticos, la cantidad de arrestos impuestos al
                                especialista, durante el periodo de evaluación; luego, marque con una X el rango en donde se
                                encuentre la cantidad encontrada.
                            </div>
                        </div>

                        <div class="evaluation-container arrestos-color">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="options-container">
                                        <input type="hidden" id="bol_arrestos" name="bol_arrestos">
                                        <div class="option-item rango-arrestos-item" data-value="5">
                                            <input type="radio" id="arrestos_0" name="rango_arrestos" value="5" class="option-radio">
                                            <label for="arrestos_0" class="option-label">0</label>
                                        </div>
                                        <div class="option-item rango-arrestos-item" data-value="4">
                                            <input type="radio" id="arrestos_1_5" name="rango_arrestos" value="4" class="option-radio">
                                            <label for="arrestos_1_5" class="option-label">De 1 a 5</label>
                                        </div>
                                        <div class="option-item rango-arrestos-item" data-value="3">
                                            <input type="radio" id="arrestos_6_10" name="rango_arrestos" value="3" class="option-radio">
                                            <label for="arrestos_6_10" class="option-label">De 6 a 10</label>
                                        </div>
                                        <div class="option-item rango-arrestos-item" data-value="2">
                                            <input type="radio" id="arrestos_11_15" name="rango_arrestos" value="2" class="option-radio">
                                            <label for="arrestos_11_15" class="option-label">De 11 a 15</label>
                                        </div>
                                        <div class="option-item rango-arrestos-item" data-value="1">
                                            <input type="radio" id="arrestos_16_mas" name="rango_arrestos" value="1" class="option-radio">
                                            <label for="arrestos_16_mas" class="option-label">De 16 a más</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="points-container">
                                        <h6 class="points-header"><i class="bi bi-award me-2"></i>Puntos</h6>
                                        <div class="points-list">
                                            <div class="point-item punto-arrestos-item" data-value="5"><div class="point-box punto-arrestos-box">5</div></div>
                                            <div class="point-item punto-arrestos-item" data-value="4"><div class="point-box punto-arrestos-box">4</div></div>
                                            <div class="point-item punto-arrestos-item" data-value="3"><div class="point-box punto-arrestos-box">3</div></div>
                                            <div class="point-item punto-arrestos-item" data-value="2"><div class="point-box punto-arrestos-box">2</div></div>
                                            <div class="point-item punto-arrestos-item" data-value="1"><div class="point-box punto-arrestos-box">1</div></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="status-indicator mt-3">
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
                                <i class="bi bi-award me-2"></i>E. Méritos
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

                        <div class="evaluation-container meritos-color">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group mb-4">
                                        <label for="merito_1" class="form-label">
                                            <i class="bi bi-star-fill me-2"></i>Mérito 1 (3 puntos)
                                        </label>
                                        <select class="form-control" id="merito_1" name="merito_3" data-nota="3">
                                            <option value="0">Cargando méritos...</option>
                                        </select>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="merito_2" class="form-label">
                                            <i class="bi bi-star me-2"></i>Mérito 2 (2 puntos)
                                        </label>
                                        <select class="form-control" id="merito_2" name="merito_2" data-nota="2">
                                            <option value="0">Cargando méritos...</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="points-container">
                                        <h6 class="points-header"><i class="bi bi-award me-2"></i>Puntos</h6>
                                        <div class="meritos-points">
                                            <div class="merit-point-item">
                                                <div class="merit-point-box merit-3-points" id="puntos_merito_1">0</div>
                                                <small class="text-muted">Mérito 1</small>
                                            </div>
                                            <div class="point-spacer"></div>
                                            <div class="merit-point-item">
                                                <div class="merit-point-box merit-2-points" id="puntos_merito_2">0</div>
                                                <small class="text-muted">Mérito 2</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="status-indicator mt-4">
                                <div class="alert alert-info" id="resumen_meritos">
                                    <i class="bi bi-info-circle me-2"></i>
                                    <strong>Total de Méritos:</strong> <span id="total_puntos_meritos">0</span> puntos
                                    <div id="detalle_meritos" class="mt-2">No hay méritos seleccionados</div>
                                </div>
                            </div>

                            <!-- Campos ocultos para almacenar los valores -->
                            <input type="hidden" id="bol_meritos_total" name="bol_meritos_total" value="0">
                            <input type="hidden" id="bol_meritos_detalle" name="bol_meritos_detalle" value="">
                        </div>
                    </div>

                    <!-- Sumatoria Final de la Sección III -->
                    <div class="sumatoria-seccion mt-5">
                        <div class="sumatoria-header text-center mb-4">
                            <h4 class="sumatoria-title">
                                <i class="bi bi-calculator me-2"></i>
                                SUMATORIA SECCIÓN III - FACTORES DE SALUD Y CONDUCTA
                            </h4>
                            <p class="sumatoria-subtitle">
                                Sume los puntos que aparecen a la derecha de la categoría, rango y mérito que seleccione, 
                                para obtener el total del apartado III (FACTORES DE SALUD Y CONDUCTA).
                            </p>
                        </div>

                        <div class="sumatoria-container">
                            <div class="row">
                                <!-- Columna de conceptos -->
                                <div class="col-md-8">
                                    <div class="sumatoria-items">
                                        <div class="sumatoria-item">
                                            <div class="concepto-label">
                                                <i class="bi bi-person-check me-2"></i>
                                                A. Perfil Biofísico
                                            </div>
                                            <div class="concepto-description">
                                                Categoría seleccionada según evaluación médica
                                            </div>
                                        </div>

                                        <div class="sumatoria-item">
                                            <div class="concepto-label">
                                                <i class="bi bi-activity me-2"></i>
                                                B. Condición Física (PAFE)
                                            </div>
                                            <div class="concepto-description">
                                                Promedio de las 4 evaluaciones de aptitud física
                                            </div>
                                        </div>

                                        <div class="sumatoria-item">
                                            <div class="concepto-label">
                                                <i class="bi bi-exclamation-triangle me-2"></i>
                                                C. Deméritos
                                            </div>
                                            <div class="concepto-description">
                                                Rango según cantidad acumulada en el período
                                            </div>
                                        </div>

                                        <div class="sumatoria-item">
                                            <div class="concepto-label">
                                                <i class="bi bi-person-x me-2"></i>
                                                D. Arrestos
                                            </div>
                                            <div class="concepto-description">
                                                Rango según cantidad impuesta en el período
                                            </div>
                                        </div>

                                        <div class="sumatoria-item">
                                            <div class="concepto-label">
                                                <i class="bi bi-award me-2"></i>
                                                E. Méritos
                                            </div>
                                            <div class="concepto-description">
                                                Suma de méritos extraordinarios obtenidos
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Columna de puntos -->
                                <div class="col-md-4">
                                    <div class="sumatoria-puntos">
                                        <div class="puntos-header mb-3">
                                            <h6><i class="bi bi-calculator me-2"></i>Puntos Obtenidos</h6>
                                        </div>

                                        <div class="puntos-items">
                                            <div class="punto-sumatoria-item">
                                                <div class="punto-box-sumatoria" id="puntos_perfil_total">0</div>
                                                <small class="punto-label">Perfil</small>
                                            </div>

                                            <div class="punto-sumatoria-item">
                                                <div class="punto-box-sumatoria" id="puntos_pafe_total">0</div>
                                                <small class="punto-label">PAFE</small>
                                            </div>

                                            <div class="punto-sumatoria-item">
                                                <div class="punto-box-sumatoria" id="puntos_demeritos_total">0</div>
                                                <small class="punto-label">Deméritos</small>
                                            </div>

                                            <div class="punto-sumatoria-item">
                                                <div class="punto-box-sumatoria" id="puntos_arrestos_total">0</div>
                                                <small class="punto-label">Arrestos</small>
                                            </div>

                                            <div class="punto-sumatoria-item">
                                                <div class="punto-box-sumatoria" id="puntos_meritos_total_suma">0</div>
                                                <small class="punto-label">Méritos</small>
                                            </div>

                                            <!-- Línea divisoria -->
                                            <div class="suma-line"></div>

                                            <!-- Total -->
                                            <div class="punto-total-item">
                                                <div class="punto-box-total" id="total_seccion_tercera">0</div>
                                                <strong class="total-label">TOTAL</strong>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Campo oculto para guardar el total -->
                            <input type="hidden" id="bol_total_seccion_3" name="bol_total_seccion_3" value="0">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Variables CSS */
:root {
    --primary-blue: #1e3a8a;
    --secondary-blue: #3b82f6;
    --info-blue: #0ea5e9;
    --success-green: #10b981;
    --warning-orange: #f59e0b;
    --danger-red: #ef4444;
    --text-dark: #1f2937;
    --text-muted: #6b7280;
    --border-light: #e5e7eb;
    --shadow-soft: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    --shadow-medium: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
    --shadow-large: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
}

/* Layout Base */
body {
    background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
    font-family: 'Inter', 'Segoe UI', sans-serif;
    color: var(--text-dark);
}

/* Cards principales */
.main-card {
    border: none;
    border-radius: 20px;
    box-shadow: var(--shadow-large);
    background: rgba(255, 255, 255, 0.98);
    overflow: hidden;
    transition: all 0.3s ease;
    margin-bottom: 2rem;
}

.main-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
}

/* Headers */
.header-gradient, .header-gradient-secondary, .header-gradient-success {
    border-radius: 20px 20px 0 0 !important;
    padding: 2rem;
    position: relative;
    overflow: hidden;
}

.header-gradient {
    background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%) !important;
}

.header-gradient-secondary {
    background: linear-gradient(135deg, var(--info-blue) 0%, var(--secondary-blue) 100%) !important;
}

.header-gradient-success {
    background: linear-gradient(135deg, var(--success-green) 0%, #059669 100%) !important;
}

/* Efectos visuales para headers */
.header-gradient::before, .header-gradient-secondary::before, .header-gradient-success::before {
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

/* Títulos y badges */
.header-title {
    font-weight: 700;
    letter-spacing: 1px;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
    position: relative;
    z-index: 2;
}

.military-badge {
    background: linear-gradient(135deg, var(--success-green) 0%, var(--secondary-blue) 100%);
    color: white;
    padding: 0.75rem 1.5rem;
    border-radius: 50px;
    font-size: 0.9rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    display: inline-block;
    box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
    border: 2px solid rgba(255, 255, 255, 0.2);
}

/* Formularios */
.form-section {
    padding: 2.5rem;
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.9) 0%, rgba(248, 250, 252, 0.9) 100%);
}

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
    border-color: var(--secondary-blue);
    box-shadow: 0 0 0 0.25rem rgba(59, 130, 246, 0.15);
    transform: translateY(-1px);
    background: white;
}

.modern-input[readonly] {
    background: linear-gradient(135deg, rgba(241, 245, 249, 0.8) 0%, rgba(248, 250, 252, 0.9) 100%);
    border-color: rgba(203, 213, 225, 0.6);
    color: var(--text-muted);
}

/* Botones */
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

.btn-success.btn-modern {
    background: linear-gradient(135deg, var(--success-green) 0%, #059669 100%);
    box-shadow: 0 4px 15px rgba(16, 185, 129, 0.4);
}

.btn-success.btn-modern:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(16, 185, 129, 0.6);
}

.btn-secondary.btn-modern {
    background: linear-gradient(135deg, #6b7280 0%, #9ca3af 100%);
}

.btn-outline-primary.btn-modern {
    background: transparent;
    border: 2px solid var(--primary-blue);
    color: var(--primary-blue);
}

.btn-outline-primary.btn-modern:hover {
    background: var(--primary-blue);
    color: white;
    transform: translateY(-3px);
}

/* Alertas */
.alert {
    border: none;
    border-radius: 12px;
    padding: 1rem 1.5rem;
    box-shadow: var(--shadow-soft);
    font-weight: 500;
}

/* Subsecciones */
.subsection {
    border: 2px solid var(--border-light);
    border-radius: 15px;
    padding: 1.5rem;
    background: rgba(255, 255, 255, 0.95);
    box-shadow: var(--shadow-soft);
    margin-bottom: 2rem;
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

/* Cajas de instrucciones */
.instructions-box {
    background: linear-gradient(135deg, rgba(16, 185, 129, 0.05) 0%, rgba(243, 244, 246, 0.8) 100%);
    border: 1px solid rgba(16, 185, 129, 0.2);
    border-radius: 12px;
    padding: 1.5rem;
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

/* Contenedores de evaluación unificados */
.evaluation-container {
    border-radius: 12px;
    padding: 1.5rem;
    background: rgba(255, 255, 255, 0.9);
}

.perfil-color { border: 2px solid var(--success-green); }
.pafe-color { border: 2px solid var(--info-blue); }
.demeritos-color { border: 2px solid var(--danger-red); }
.arrestos-color { border: 2px solid var(--danger-red); }
.meritos-color { border: 2px solid var(--success-green); }

/* Contenedores de opciones unificados */
.options-container {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
}

.option-item {
    border: 2px solid var(--border-light);
    border-radius: 10px;
    transition: all 0.3s ease;
    cursor: pointer;
    background: white;
    padding: 1rem 1.5rem;
    display: flex;
    align-items: center;
}

.option-item:hover {
    border-color: currentColor;
    transform: translateX(5px);
    box-shadow: var(--shadow-soft);
}

.option-item.selected {
    border-color: currentColor;
    background: linear-gradient(135deg, rgba(16, 185, 129, 0.1) 0%, rgba(16, 185, 129, 0.05) 100%);
    box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
}

.option-radio {
    margin-right: 1rem;
    width: 18px;
    height: 18px;
    accent-color: currentColor;
    cursor: pointer;
}

.option-label {
    font-weight: 600;
    font-size: 1rem;
    color: var(--text-dark);
    cursor: pointer;
    margin: 0;
    user-select: none;
}

.option-item.selected .option-label {
    color: currentColor;
}

/* Contenedores de puntos unificados */
.points-container {
    text-align: center;
}

.points-header {
    color: currentColor;
    font-weight: 700;
    border-bottom: 2px solid currentColor;
    padding-bottom: 0.5rem;
    margin-bottom: 1rem;
}

.points-list {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
    align-items: center;
}

.point-item {
    transition: all 0.3s ease;
}

.point-box {
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

.point-item.selected .point-box {
    background: currentColor;
    color: white;
    border-color: currentColor;
    transform: scale(1.1);
    box-shadow: 0 4px 15px rgba(16, 185, 129, 0.4);
}

/* Estilos específicos para colores */
.perfil-color .option-item { color: var(--success-green); }
.pafe-color .option-item { color: var(--info-blue); }
.demeritos-color .option-item { color: var(--danger-red); }
.arrestos-color .option-item { color: var(--danger-red); }
.meritos-color .option-item { color: var(--success-green); }

/* PAFE específico */
.pafe-grid {
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

.pafe-item {
    text-align: center;
    min-width: 120px;
}

.pafe-label {
    display: block;
    font-size: 0.85rem;
    font-weight: 600;
    color: var(--text-dark);
    margin-bottom: 0.5rem;
}

.pafe-input {
    width: 80px;
    height: 40px;
    text-align: center;
    font-weight: bold;
    font-size: 1.1rem;
    border: 2px solid var(--border-light);
    border-radius: 8px;
    background: white;
}

.pafe-operator {
    font-size: 1.5rem;
    font-weight: bold;
    color: var(--text-muted);
    align-self: center;
    margin-top: -1rem;
}

.promedio-input {
    background: linear-gradient(135deg, var(--success-green) 0%, #059669 100%) !important;
    color: white !important;
    border-color: var(--success-green) !important;
}

/* Méritos específico */
.meritos-color .form-control {
    border: 2px solid var(--border-light);
    border-radius: 8px;
    padding: 0.75rem;
    transition: all 0.3s ease;
}

.meritos-color .form-control:focus {
    border-color: var(--success-green);
    box-shadow: 0 0 0 0.25rem rgba(16, 185, 129, 0.15);
}

.meritos-points {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 1rem;
}

.merit-point-item {
    text-align: center;
}

.merit-point-box {
    width: 60px;
    height: 60px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    font-size: 1.4rem;
    color: white;
    transition: all 0.3s ease;
}

.merit-3-points {
    background: linear-gradient(135deg, #059669 0%, var(--success-green) 100%);
    box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
}

.merit-2-points {
    background: linear-gradient(135deg, #0ea5e9 0%, var(--info-blue) 100%);
    box-shadow: 0 4px 15px rgba(14, 165, 233, 0.3);
}

.point-spacer {
    height: 2rem;
    position: relative;
}

.point-spacer::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 2px;
    height: 100%;
    background: linear-gradient(to bottom, transparent 0%, var(--border-light) 50%, transparent 100%);
}

/* Indicadores de estado */
.status-indicator .alert {
    border: none;
    background: linear-gradient(135deg, rgba(59, 130, 246, 0.1) 0%, rgba(219, 234, 254, 0.8) 100%);
    border-left: 4px solid var(--info-blue);
    color: var(--info-blue);
    font-weight: 500;
}

/* Validación */
.is-invalid {
    border-color: var(--danger-red) !important;
    box-shadow: 0 0 0 0.25rem rgba(239, 68, 68, 0.15) !important;
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
    .container { padding: 0 1rem; }
    .form-section { padding: 2rem 1.5rem; }
    .evaluation-icon { width: 60px; height: 60px; }
    .evaluation-icon i { font-size: 1.5rem; }
    .btn-modern { padding: 0.75rem 1.5rem; font-size: 0.85rem; }
    .pafe-grid { flex-direction: column; gap: 1.5rem; }
    .pafe-operator { display: none; }
    .option-item { padding: 0.75rem 1rem; }
    .point-box { width: 40px; height: 40px; font-size: 1rem; }
    .merit-point-box { width: 50px; height: 50px; font-size: 1.2rem; }
    .instruction-text { font-size: 0.9rem; }
}

/* Estados especiales para elementos deshabilitados automáticamente */
.disabled-auto {
    cursor: not-allowed !important;
    opacity: 0.7 !important;
    pointer-events: none !important;
}

.disabled-auto.selected {
    background: linear-gradient(135deg, rgba(220, 38, 38, 0.3) 0%, rgba(220, 38, 38, 0.1) 100%) !important;
    border-color: var(--danger-red) !important;
}

/* Estilos para Sumatoria de Sección III */
.sumatoria-seccion {
    border: 3px solid var(--primary-blue);
    border-radius: 15px;
    background: linear-gradient(135deg, rgba(30, 58, 138, 0.05) 0%, rgba(255, 255, 255, 0.95) 100%);
    padding: 2rem;
    margin-top: 3rem;
    box-shadow: var(--shadow-large);
}

.sumatoria-header {
    border-bottom: 3px solid var(--primary-blue);
    padding-bottom: 1rem;
    margin-bottom: 2rem;
}

.sumatoria-title {
    color: var(--primary-blue);
    font-weight: 800;
    font-size: 1.5rem;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin: 0;
}

.sumatoria-subtitle {
    color: var(--text-muted);
    font-size: 0.95rem;
    font-style: italic;
    margin: 0.5rem 0 0 0;
    line-height: 1.5;
}

.sumatoria-container {
    background: rgba(255, 255, 255, 0.8);
    border-radius: 12px;
    padding: 1.5rem;
    border: 1px solid rgba(30, 58, 138, 0.1);
}

.sumatoria-items {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.sumatoria-item {
    background: white;
    border: 2px solid var(--border-light);
    border-radius: 10px;
    padding: 1rem 1.5rem;
    transition: all 0.3s ease;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
}

.sumatoria-item:hover {
    border-color: var(--primary-blue);
    transform: translateX(3px);
    box-shadow: 0 4px 12px rgba(30, 58, 138, 0.1);
}

.concepto-label {
    font-weight: 700;
    font-size: 1.1rem;
    color: var(--primary-blue);
    margin-bottom: 0.3rem;
    display: flex;
    align-items: center;
}

.concepto-description {
    font-size: 0.9rem;
    color: var(--text-muted);
    font-style: italic;
}

.sumatoria-puntos {
    text-align: center;
}

.sumatoria-puntos .puntos-header {
    color: var(--primary-blue);
    font-weight: 700;
    border-bottom: 2px solid var(--primary-blue);
    padding-bottom: 0.5rem;
}

.puntos-items {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 1rem;
}

.punto-sumatoria-item {
    text-align: center;
    transition: all 0.3s ease;
}

.punto-box-sumatoria {
    width: 55px;
    height: 50px;
    border: 2px solid var(--border-light);
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    font-size: 1.3rem;
    color: var(--text-dark);
    background: white;
    transition: all 0.3s ease;
    margin: 0 auto 0.3rem auto;
}

.punto-box-sumatoria:not(:empty) {
    background: linear-gradient(135deg, var(--secondary-blue) 0%, var(--primary-blue) 100%);
    color: white;
    border-color: var(--primary-blue);
    transform: scale(1.05);
    box-shadow: 0 4px 15px rgba(30, 58, 138, 0.3);
}

.punto-label {
    font-size: 0.8rem;
    color: var(--text-muted);
    font-weight: 600;
}

.suma-line {
    width: 80%;
    height: 3px;
    background: linear-gradient(90deg, var(--primary-blue) 0%, var(--secondary-blue) 100%);
    border-radius: 2px;
    margin: 0.5rem auto;
}

.punto-total-item {
    text-align: center;
    padding: 1rem 0;
    background: linear-gradient(135deg, rgba(30, 58, 138, 0.1) 0%, rgba(59, 130, 246, 0.05) 100%);
    border-radius: 12px;
    border: 2px solid var(--primary-blue);
    margin-top: 0.5rem;
}

.punto-box-total {
    width: 70px;
    height: 60px;
    border: 3px solid var(--primary-blue);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 900;
    font-size: 1.8rem;
    color: white;
    background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%);
    margin: 0 auto 0.5rem auto;
    box-shadow: 0 6px 20px rgba(30, 58, 138, 0.4);
    animation: totalPulse 2s ease-in-out infinite;
}

@keyframes totalPulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.05); }
}

.total-label {
    font-size: 1rem;
    color: var(--primary-blue);
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 1px;
}

/* Responsive para sumatoria */
@media (max-width: 768px) {
    .sumatoria-seccion {
        padding: 1.5rem;
        margin-top: 2rem;
    }
    
    .sumatoria-title {
        font-size: 1.2rem;
    }
    
    .sumatoria-subtitle {
        font-size: 0.85rem;
    }
    
    .sumatoria-item {
        padding: 0.75rem 1rem;
    }
    
    .concepto-label {
        font-size: 1rem;
    }
    
    .concepto-description {
        font-size: 0.8rem;
    }
    
    .punto-box-sumatoria {
        width: 45px;
        height: 40px;
        font-size: 1.1rem;
    }
    
    .punto-box-total {
        width: 60px;
        height: 50px;
        font-size: 1.5rem;
    }
}
</style>

<script src="<?= asset('build/js/evaluacionformulario/index.js') ?>"></script>