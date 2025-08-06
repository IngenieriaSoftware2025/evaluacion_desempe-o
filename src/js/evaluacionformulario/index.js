import Swal from "sweetalert2";
import { validarFormulario } from '../funciones';

const FormEvaluacion = document.getElementById('FormEvaluacion');
const BtnGuardar = document.getElementById('BtnGuardar');
const BtnLimpiar = document.getElementById('BtnLimpiar');

// Campos del evaluado (readonly)
const evaluadoCatalogo = document.getElementById('evaluado_catalogo');
const evaluadoGrado = document.getElementById('evaluado_grado');
const evaluadoNom1 = document.getElementById('evaluado_nom1');
const evaluadoNom2 = document.getElementById('evaluado_nom2');
const evaluadoApe1 = document.getElementById('evaluado_ape1');
const evaluadoApe2 = document.getElementById('evaluado_ape2');
const evaluadoLugarAlta = document.getElementById('evaluado_lugar_alta');
const evaluadoPuesto = document.getElementById('evaluado_puesto');
const evaluadoTiempo = document.getElementById('evaluado_tiempo');

// Campos del evaluador (interactivos)
const evaluadorCatalogo = document.getElementById('evaluador_catalogo');
const evaluadorGrado = document.getElementById('evaluador_grado');
const evaluadorNom1 = document.getElementById('evaluador_nom1');
const evaluadorNom2 = document.getElementById('evaluador_nom2');
const evaluadorApe1 = document.getElementById('evaluador_ape1');
const evaluadorApe2 = document.getElementById('evaluador_ape2');
const evaluadorPuesto = document.getElementById('evaluador_puesto');
const evaluadorTiempo = document.getElementById('evaluador_tiempo');

// Campos ocultos
const bolCatEvaluado = document.getElementById('bol_cat_evaluado');
const bolCeom = document.getElementById('bol_ceom');

// Elementos de alerta
const alertaValidacion = document.getElementById('alerta_validacion');
const mensajeValidacion = document.getElementById('mensaje_validacion');
const errorEvaluadorCatalogo = document.getElementById('error_evaluador_catalogo');

// Variables de control
let datosEvaluadorCargados = false;
let evaluadorValidado = false;

// =============================================================================
// PERFIL BIOFÍSICO - Elementos y Variables
// =============================================================================
const perfilRadios = document.querySelectorAll('input[name="bol_perfil"]');
const categoriaItems = document.querySelectorAll('.categoria-item');
const puntoItems = document.querySelectorAll('.punto-item');
const perfilSeleccionado = document.getElementById('perfil_seleccionado');
const perfilTexto = document.getElementById('perfil_texto');

// Mapeo de valores a texto
const perfilTextos = {
    '1': 'OBESIDAD II - 1 punto',
    '2': 'OBESIDAD I - 2 puntos', 
    '3': 'SOBREPESO - 3 puntos',
    '4': 'DÉFICIT - 4 puntos',
    '5': 'NORMAL - 5 puntos'
};

// =============================================================================
// CONDICIÓN FÍSICA (PAFEs) - Elementos y Variables
// =============================================================================
const pafeEva1 = document.getElementById('pafe_eva1');
const pafeEva2 = document.getElementById('pafe_eva2');
const pafeEva3 = document.getElementById('pafe_eva3');
const pafeEva4 = document.getElementById('pafe_eva4');
const pafePromedio = document.getElementById('pafe_promedio');
const bolPafe = document.getElementById('bol_pafe');

const mesEva1 = document.getElementById('mes_eva1');
const mesEva2 = document.getElementById('mes_eva2');
const mesEva3 = document.getElementById('mes_eva3');
const mesEva4 = document.getElementById('mes_eva4');

const rangoItems = document.querySelectorAll('.rango-item');
const puntoPafeItems = document.querySelectorAll('.punto-pafe-item');
const pafeInfo = document.getElementById('pafe_info');
const pafeMensaje = document.getElementById('pafe_mensaje');

// Variables de control PAFE
let datosPafeCargados = false;

// =============================================================================
// FUNCIONES GENERALES
// =============================================================================

/**
 * Función para obtener parámetros de la URL
 */
const obtenerParametroUrl = (nombre) => {
    const urlParams = new URLSearchParams(window.location.search);
    return urlParams.get(nombre);
}

/**
 * Función para mostrar alertas con estilos
 */
const mostrarAlerta = (tipo, mensaje) => {
    alertaValidacion.classList.remove('d-none', 'alert-danger', 'alert-warning', 'alert-success');
    alertaValidacion.classList.add(`alert-${tipo}`);
    mensajeValidacion.textContent = mensaje;
}

/**
 * Función para ocultar alertas
 */
const ocultarAlerta = () => {
    alertaValidacion.classList.add('d-none');
}

/**
 * Función para mostrar información de PAFE
 */
const mostrarInfoPafe = (tipo, mensaje) => {
    pafeInfo.classList.remove('d-none', 'alert-info', 'alert-success', 'alert-warning', 'alert-danger');
    pafeInfo.classList.add(`alert-${tipo}`);
    pafeMensaje.textContent = mensaje;
}

/**
 * Función para ocultar información de PAFE
 */
const ocultarInfoPafe = () => {
    pafeInfo.classList.add('d-none');
}

/**
 * Función para limpiar datos del evaluador
 */
const limpiarDatosEvaluador = () => {
    evaluadorGrado.value = '';
    evaluadorNom1.value = '';
    evaluadorNom2.value = '';
    evaluadorApe1.value = '';
    evaluadorApe2.value = '';
    evaluadorPuesto.value = '';
    evaluadorTiempo.value = '';
    bolCeom.value = '';
    datosEvaluadorCargados = false;
    evaluadorValidado = false;
    ocultarAlerta();
    evaluadorCatalogo.classList.remove('is-invalid');
}

/**
 * Función para limpiar datos de PAFE
 */
const limpiarDatosPafe = () => {
    pafeEva1.value = '';
    pafeEva2.value = '';
    pafeEva3.value = '';
    pafeEva4.value = '';
    pafePromedio.value = '';
    bolPafe.value = '';
    
    // Limpiar selecciones visuales
    rangoItems.forEach(item => item.classList.remove('selected'));
    puntoPafeItems.forEach(item => item.classList.remove('selected'));
    
    // Resetear texto de meses
    mesEva1.textContent = 'Abril 2025';
    mesEva2.textContent = 'Mayo 2025';
    mesEva3.textContent = 'Junio 2025';
    mesEva4.textContent = 'Julio 2025';
    
    datosPafeCargados = false;
    ocultarInfoPafe();
}

/**
 * Función para formatear tiempo en texto legible
 */
const formatearTiempo = (meses) => {
    if (!meses || meses === 0) return 'No disponible';
    
    const años = Math.floor(meses / 12);
    const mesesRestantes = meses % 12;
    
    let resultado = '';
    if (años > 0) {
        resultado += `${años} ${años === 1 ? 'año' : 'años'}`;
    }
    if (mesesRestantes > 0) {
        if (resultado) resultado += ' ';
        resultado += `${mesesRestantes} ${mesesRestantes === 1 ? 'mes' : 'meses'}`;
    }
    
    return resultado;
}

/**
 * Debounce para optimizar las consultas
 */
const debounce = (func, delay) => {
    let timeoutId;
    return (...args) => {
        clearTimeout(timeoutId);
        timeoutId = setTimeout(() => func(...args), delay);
    };
}

// =============================================================================
// FUNCIONES DE CARGA DE DATOS
// =============================================================================

/**
 * Cargar datos del evaluado desde la URL
 */
const cargarDatosEvaluado = async () => {
    const catalogoEvaluado = obtenerParametroUrl('catalogo');
    
    if (!catalogoEvaluado) {
        await Swal.fire({
            position: "center",
            icon: "error",
            title: "Error",
            text: "No se especificó el catálogo del evaluado en la URL",
            showConfirmButton: true,
        });
        return;
    }

    const url = `/evaluacion_desempe-o/API/evaluacionformulario/obtenerDatosEvaluado?catalogo=${catalogoEvaluado}`;
    const config = {
        method: 'GET'
    }

    try {
        const respuesta = await fetch(url, config);
        const datos = await respuesta.json();
        const { codigo, mensaje, data } = datos;

        if (codigo === 1) {
            // Llenar datos del evaluado
            evaluadoCatalogo.value = data.catalogo || '';
            evaluadoGrado.value = data.grado || '';
            evaluadoNom1.value = data.per_nom1 || '';
            evaluadoNom2.value = data.per_nom2 || '';
            evaluadoApe1.value = data.per_ape1 || '';
            evaluadoApe2.value = data.per_ape2 || '';
            evaluadoLugarAlta.value = data.lugar_alta || '';
            evaluadoPuesto.value = data.puesto_ocupa || '';
            evaluadoTiempo.value = formatearTiempo(data.tiempo_ocupar_puesto);

            // Llenar campos ocultos
            bolCatEvaluado.value = data.catalogo || '';

            console.log('Datos del evaluado cargados correctamente');
            
            // Cargar automáticamente los datos de PAFE
            await cargarDatosPafe(catalogoEvaluado);
            
        } else {
            await Swal.fire({
                position: "center",
                icon: "error",
                title: "Error",
                text: mensaje,
                showConfirmButton: true,
            });
        }

    } catch (error) {
        console.error('Error al cargar datos del evaluado:', error);
        await Swal.fire({
            position: "center",
            icon: "error",
            title: "Error de conexión",
            text: "No se pudo cargar la información del evaluado",
            showConfirmButton: true,
        });
    }
}

/**
 * Cargar datos del evaluador
 */
const cargarDatosEvaluador = async (catalogo) => {
    if (!catalogo || catalogo.trim() === '') {
        limpiarDatosEvaluador();
        return;
    }

    const url = `/evaluacion_desempe-o/API/evaluacionformulario/obtenerDatosEvaluador?catalogo=${catalogo}`;
    const config = {
        method: 'GET'
    }

    try {
        const respuesta = await fetch(url, config);
        const datos = await respuesta.json();
        const { codigo, mensaje, data } = datos;

        if (codigo === 1) {
            // Llenar datos del evaluador
            evaluadorGrado.value = data.grado || '';
            evaluadorNom1.value = data.per_nom1 || '';
            evaluadorNom2.value = data.per_nom2 || '';
            evaluadorApe1.value = data.per_ape1 || '';
            evaluadorApe2.value = data.per_ape2 || '';
            evaluadorPuesto.value = data.puesto_ocupa || '';
            evaluadorTiempo.value = formatearTiempo(data.tiempo_supervisar_evaluado);
            
            // Llenar campos ocultos
            bolCeom.value = data.ceom || '';

            datosEvaluadorCargados = true;
            evaluadorCatalogo.classList.remove('is-invalid');
            errorEvaluadorCatalogo.textContent = '';

            // Validar tiempo del evaluador
            await validarTiempoEvaluador(catalogo);

        } else {
            limpiarDatosEvaluador();
            evaluadorCatalogo.classList.add('is-invalid');
            errorEvaluadorCatalogo.textContent = mensaje;
            mostrarAlerta('danger', mensaje);
        }

    } catch (error) {
        console.error('Error al cargar datos del evaluador:', error);
        limpiarDatosEvaluador();
        evaluadorCatalogo.classList.add('is-invalid');
        errorEvaluadorCatalogo.textContent = 'Error de conexión';
        mostrarAlerta('danger', 'Error al cargar los datos del evaluador');
    }
}

/**
 * Validar tiempo mínimo del evaluador
 */
const validarTiempoEvaluador = async (catalogo) => {
    const url = `/evaluacion_desempe-o/API/evaluacionformulario/validarTiempoEvaluador?catalogo=${catalogo}`;
    const config = {
        method: 'GET'
    }

    try {
        const respuesta = await fetch(url, config);
        const datos = await respuesta.json();
        const { codigo, data } = datos;

        if (codigo === 1) {
            evaluadorValidado = data.validacion === 'PUEDE_EVALUAR';
            
            if (evaluadorValidado) {
                mostrarAlerta('success', data.mensaje);
                BtnGuardar.disabled = false;
            } else {
                mostrarAlerta('warning', data.mensaje);
                BtnGuardar.disabled = true;
            }
        } else {
            evaluadorValidado = false;
            mostrarAlerta('danger', 'Error en la validación del evaluador');
            BtnGuardar.disabled = true;
        }

    } catch (error) {
        console.error('Error al validar evaluador:', error);
        evaluadorValidado = false;
        mostrarAlerta('danger', 'Error al validar el tiempo del evaluador');
        BtnGuardar.disabled = true;
    }
}

// Crear versión con debounce para cargar datos del evaluador
const cargarDatosEvaluadorDebounced = debounce(cargarDatosEvaluador, 800);

// =============================================================================
// FUNCIONES DEL PERFIL BIOFÍSICO
// =============================================================================

/**
 * Función para actualizar la visualización del perfil seleccionado
 */
const actualizarPerfilSeleccionado = (valor) => {
    // Limpiar selecciones anteriores
    categoriaItems.forEach(item => item.classList.remove('selected'));
    puntoItems.forEach(item => item.classList.remove('selected'));
    
    if (valor) {
        // Marcar el item seleccionado
        const categoriaSeleccionada = document.querySelector(`.categoria-item[data-value="${valor}"]`);
        const puntoSeleccionado = document.querySelector(`.punto-item[data-value="${valor}"]`);
        
        if (categoriaSeleccionada) {
            categoriaSeleccionada.classList.add('selected');
        }
        
        if (puntoSeleccionado) {
            puntoSeleccionado.classList.add('selected');
        }
        
        // Actualizar texto informativo
        if (perfilTexto && perfilSeleccionado) {
            perfilTexto.textContent = perfilTextos[valor] || 'Selección inválida';
            perfilSeleccionado.classList.remove('d-none');
            perfilSeleccionado.classList.remove('alert-warning');
            perfilSeleccionado.classList.add('alert-success');
        }
        
        console.log(`✅ Perfil biofísico seleccionado: ${perfilTextos[valor]}`);
    } else {
        // No hay selección
        if (perfilTexto && perfilSeleccionado) {
            perfilTexto.textContent = 'Seleccione una categoría de perfil biofísico';
            perfilSeleccionado.classList.remove('d-none');
            perfilSeleccionado.classList.remove('alert-success');
            perfilSeleccionado.classList.add('alert-warning');
        }
    }
}

/**
 * Función para validar que el perfil biofísico esté seleccionado
 */
const validarPerfilBiofisico = () => {
    const perfilSeleccionadoRadio = document.querySelector('input[name="bol_perfil"]:checked');
    
    if (!perfilSeleccionadoRadio) {
        Swal.fire({
            position: "center",
            icon: "warning",
            title: "Perfil Biofísico Requerido",
            text: "Debe seleccionar una categoría de perfil biofísico",
            showConfirmButton: true,
        });
        
        // Scroll hacia la sección de perfil biofísico si existe
        const perfilContainer = document.querySelector('.perfil-biofisico-container');
        if (perfilContainer) {
            perfilContainer.scrollIntoView({
                behavior: 'smooth',
                block: 'center'
            });
        }
        
        return false;
    }
    
    return true;
}

// =============================================================================
// FUNCIONES DE CONDICIÓN FÍSICA (PAFEs)
// =============================================================================

/**
 * Cargar datos de PAFEs del evaluado
 */
const cargarDatosPafe = async (catalogo) => {
    if (!catalogo) return;

    mostrarInfoPafe('info', 'Cargando evaluaciones PAFE...');

    const url = `/evaluacion_desempe-o/API/evaluacionformulario/obtenerPafesEvaluado?catalogo=${catalogo}`;
    const config = {
        method: 'GET'
    }

    try {
        const respuesta = await fetch(url, config);
        const datos = await respuesta.json();
        const { codigo, mensaje, data } = datos;

        if (codigo === 1) {
            // Llenar evaluaciones
            const evaluaciones = data.puntajes; // [eva1, eva2, eva3, eva4]
            pafeEva1.value = evaluaciones[0] || 0;
            pafeEva2.value = evaluaciones[1] || 0;
            pafeEva3.value = evaluaciones[2] || 0;
            pafeEva4.value = evaluaciones[3] || 0;
            
            // Llenar promedio
            pafePromedio.value = data.promedio || 0;
            
            // Llenar valor oculto para guardar en BD
            bolPafe.value = data.puntos_pafe || 0;
            
            // Actualizar nombres de meses
            if (data.meses_consultados && data.meses_consultados.length >= 4) {
                mesEva1.textContent = data.meses_consultados[0];
                mesEva2.textContent = data.meses_consultados[1];
                mesEva3.textContent = data.meses_consultados[2];
                mesEva4.textContent = data.meses_consultados[3];
            }
            
            // Actualizar visualización de rango seleccionado
            actualizarRangoPafe(data.puntos_pafe);
            
            datosPafeCargados = true;
            
            // Mostrar información de éxito
            mostrarInfoPafe('success', `PAFEs cargados correctamente. Promedio: ${data.promedio} - ${data.rango_texto} (${data.puntos_pafe} puntos)`);
            
            console.log('✅ Datos de PAFE cargados correctamente:', data);
            
        } else {
            limpiarDatosPafe();
            mostrarInfoPafe('warning', mensaje || 'No se encontraron evaluaciones PAFE para este especialista');
        }

    } catch (error) {
        console.error('Error al cargar datos de PAFE:', error);
        limpiarDatosPafe();
        mostrarInfoPafe('danger', 'Error al cargar las evaluaciones PAFE');
    }
}

/**
 * Actualizar la visualización del rango PAFE seleccionado
 */
const actualizarRangoPafe = (puntos) => {
    // Limpiar selecciones anteriores
    rangoItems.forEach(item => item.classList.remove('selected'));
    puntoPafeItems.forEach(item => item.classList.remove('selected'));
    
    if (puntos !== null && puntos !== undefined) {
        // Marcar el rango seleccionado
        const rangoSeleccionado = document.querySelector(`.rango-item[data-value="${puntos}"]`);
        const puntoSeleccionado = document.querySelector(`.punto-pafe-item[data-value="${puntos}"]`);
        
        if (rangoSeleccionado) {
            rangoSeleccionado.classList.add('selected');
            // Marcar el radio button correspondiente
            const radioButton = rangoSeleccionado.querySelector('input[type="radio"]');
            if (radioButton) {
                radioButton.checked = true;
            }
        }
        
        if (puntoSeleccionado) {
            puntoSeleccionado.classList.add('selected');
        }
        
        console.log(`✅ Rango PAFE actualizado: ${puntos} puntos`);
    }
}

/**
 * Validar que los datos de PAFE estén cargados
 */
const validarPafe = () => {
    if (!datosPafeCargados) {
        Swal.fire({
            position: "center",
            icon: "warning",
            title: "Evaluaciones PAFE no cargadas",
            text: "No se han cargado las evaluaciones de condición física (PAFE)",
            showConfirmButton: true,
        });
        
        // Scroll hacia la sección de PAFE
        const pafeContainer = document.querySelector('.condicion-fisica-container');
        if (pafeContainer) {
            pafeContainer.scrollIntoView({
                behavior: 'smooth',
                block: 'center'
            });
        }
        
        return false;
    }
    
    return true;
}

// =============================================================================
// FUNCIONES PRINCIPALES
// =============================================================================

/**
 * Guardar la evaluación
 */
const guardarEvaluacion = async (event) => {
    event.preventDefault();
    BtnGuardar.disabled = true;

    // Validaciones básicas
    if (!bolCatEvaluado.value) {
        await Swal.fire({
            position: "center",
            icon: "error",
            title: "Error",
            text: "No se ha cargado la información del evaluado",
            showConfirmButton: true,
        });
        BtnGuardar.disabled = false;
        return;
    }

    if (!evaluadorCatalogo.value.trim()) {
        await Swal.fire({
            position: "center",
            icon: "warning",
            title: "Formulario incompleto",
            text: "Debe ingresar el catálogo del evaluador",
            showConfirmButton: true,
        });
        evaluadorCatalogo.focus();
        BtnGuardar.disabled = false;
        return;
    }

    if (!datosEvaluadorCargados) {
        await Swal.fire({
            position: "center",
            icon: "warning",
            title: "Datos incompletos",
            text: "Los datos del evaluador no se han cargado correctamente",
            showConfirmButton: true,
        });
        BtnGuardar.disabled = false;
        return;
    }

    if (!evaluadorValidado) {
        await Swal.fire({
            position: "center",
            icon: "warning",
            title: "Evaluador no válido",
            text: "El evaluador no cumple con el tiempo mínimo requerido para realizar la evaluación",
            showConfirmButton: true,
        });
        BtnGuardar.disabled = false;
        return;
    }

    // Validación del perfil biofísico (si la sección existe)
    if (document.querySelector('input[name="bol_perfil"]') && !validarPerfilBiofisico()) {
        BtnGuardar.disabled = false;
        return;
    }

    // Validación de PAFE (si la sección existe)
    if (document.getElementById('pafe_eva1') && !validarPafe()) {
        BtnGuardar.disabled = false;
        return;
    }

    // Confirmar guardado
    const confirmacion = await Swal.fire({
        position: "center",
        icon: "question",
        title: "¿Confirmar guardado?",
        text: "¿Está seguro de guardar los datos de la evaluación?",
        showConfirmButton: true,
        confirmButtonText: 'Sí, Guardar',
        confirmButtonColor: '#10b981',
        cancelButtonText: 'No, Cancelar',
        showCancelButton: true
    });

    if (!confirmacion.isConfirmed) {
        BtnGuardar.disabled = false;
        return;
    }

    // Preparar datos para envío
    const body = new FormData(FormEvaluacion);
    const url = '/evaluacion_desempe-o/API/evaluacionformulario/guardar';
    const config = {
        method: 'POST',
        body
    }

    try {
        const respuesta = await fetch(url, config);
        const datos = await respuesta.json();
        const { codigo, mensaje } = datos;

        if (codigo === 1) {
            await Swal.fire({
                position: "center",
                icon: "success",
                title: "¡Éxito!",
                text: mensaje,
                showConfirmButton: true,
                confirmButtonText: 'Continuar'
            });

            // Redireccionar al listado
            window.location.href = '/evaluacion_desempe-o/evaluacionespecialistas';
        } else {
            await Swal.fire({
                position: "center",
                icon: "error",
                title: "Error",
                text: mensaje,
                showConfirmButton: true,
            });
        }

    } catch (error) {
        console.error('Error al guardar evaluación:', error);
        await Swal.fire({
            position: "center",
            icon: "error",
            title: "Error de conexión",
            text: "No se pudo guardar la evaluación. Intente nuevamente.",
            showConfirmButton: true,
        });
    }

    BtnGuardar.disabled = false;
}

/**
 * Limpiar todo el formulario
 */
const limpiarFormulario = async () => {
    const confirmacion = await Swal.fire({
        position: "center",
        icon: "question",
        title: "¿Limpiar formulario?",
        text: "Se perderán todos los datos ingresados",
        showConfirmButton: true,
        confirmButtonText: 'Sí, Limpiar',
        confirmButtonColor: '#6b7280',
        cancelButtonText: 'No, Cancelar',
        showCancelButton: true
    });

    if (confirmacion.isConfirmed) {
        FormEvaluacion.reset();
        limpiarDatosEvaluador();
        limpiarDatosPafe();
        
        // Limpiar selección de perfil biofísico si existe
        if (typeof actualizarPerfilSeleccionado === 'function') {
            actualizarPerfilSeleccionado(null);
        }
        
        // Recargar datos del evaluado
        await cargarDatosEvaluado();
        
        await Swal.fire({
            position: "center",
            icon: "success",
            title: "Formulario limpiado",
            text: "Los datos del evaluado y PAFEs se han recargado automáticamente",
            timer: 2000,
            showConfirmButton: false
        });
    }
}

/**
 * Restaurar texto del botón si hay error
 */
const restaurarBotonGuardar = () => {
    BtnGuardar.innerHTML = '<i class="bi bi-floppy me-2"></i>Guardar Datos de Evaluación';
    BtnGuardar.disabled = !evaluadorValidado;
};

// =============================================================================
// EVENT LISTENERS
// =============================================================================

/**
 * Event listeners principales
 */
// Cargar datos del evaluado al cargar la página
document.addEventListener('DOMContentLoaded', () => {
    cargarDatosEvaluado();
    
    // Inicializar perfil biofísico si existe
    const perfilSeleccionadoActual = document.querySelector('input[name="bol_perfil"]:checked');
    if (perfilSeleccionadoActual && typeof actualizarPerfilSeleccionado === 'function') {
        actualizarPerfilSeleccionado(perfilSeleccionadoActual.value);
    }
});

// Evento para el input del catálogo del evaluador
evaluadorCatalogo.addEventListener('input', (e) => {
    const catalogo = e.target.value.trim();
    
    if (catalogo.length >= 4) { // Mínimo 4 dígitos para hacer la consulta
        cargarDatosEvaluadorDebounced(catalogo);
    } else {
        limpiarDatosEvaluador();
    }
});

// Evento para el formulario
FormEvaluacion.addEventListener('submit', guardarEvaluacion);

// Evento para limpiar
BtnLimpiar.addEventListener('click', limpiarFormulario);

// Mostrar loading al enviar formulario
FormEvaluacion.addEventListener('submit', () => {
    BtnGuardar.innerHTML = '<i class="bi bi-hourglass-split me-2"></i>Guardando...';
});

// Restaurar botón en caso de error
window.addEventListener('beforeunload', restaurarBotonGuardar);

/**
 * Event listeners para el perfil biofísico (se ejecutan solo si existen los elementos)
 */
if (perfilRadios.length > 0) {
    perfilRadios.forEach(radio => {
        radio.addEventListener('change', (e) => {
            if (e.target.checked) {
                actualizarPerfilSeleccionado(e.target.value);
            }
        });
    });
}

if (categoriaItems.length > 0) {
    categoriaItems.forEach(item => {
        item.addEventListener('click', (e) => {
            // Evitar doble disparo si se hace click directamente en el radio
            if (e.target.type !== 'radio') {
                const valor = item.dataset.value;
                const radio = document.querySelector(`input[name="bol_perfil"][value="${valor}"]`);
                if (radio) {
                    radio.checked = true;
                    actualizarPerfilSeleccionado(valor);
                }
            }
        });
    });
}

if (puntoItems.length > 0) {
    puntoItems.forEach(item => {
        item.addEventListener('click', (e) => {
            const valor = item.dataset.value;
            const radio = document.querySelector(`input[name="bol_perfil"][value="${valor}"]`);
            if (radio) {
                radio.checked = true;
                actualizarPerfilSeleccionado(valor);
            }
        });
    });
}

console.log('✅ JavaScript del Formulario de Evaluación cargado correctamente');
console.log('✅ JavaScript del Perfil Biofísico integrado correctamente');
console.log('✅ JavaScript de Condición Física (PAFEs) integrado correctamente');