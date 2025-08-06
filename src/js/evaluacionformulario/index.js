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
        
        // Recargar datos del evaluado
        await cargarDatosEvaluado();
        
        await Swal.fire({
            position: "center",
            icon: "success",
            title: "Formulario limpiado",
            text: "Los datos del evaluado se han recargado automáticamente",
            timer: 2000,
            showConfirmButton: false
        });
    }
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

// Crear versión con debounce para cargar datos del evaluador
const cargarDatosEvaluadorDebounced = debounce(cargarDatosEvaluador, 800);

/**
 * Event Listeners
 */

// Cargar datos del evaluado al cargar la página
document.addEventListener('DOMContentLoaded', () => {
    cargarDatosEvaluado();
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

// Restaurar texto del botón si hay error
const restaurarBotonGuardar = () => {
    BtnGuardar.innerHTML = '<i class="bi bi-floppy me-2"></i>Guardar Datos de Evaluación';
    BtnGuardar.disabled = !evaluadorValidado;
};

// Restaurar botón en caso de error
window.addEventListener('beforeunload', restaurarBotonGuardar);

console.log('✅ JavaScript del Formulario de Evaluación cargado correctamente');