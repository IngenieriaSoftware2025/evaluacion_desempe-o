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
// DEMÉRITOS - Elementos y Variables
// =============================================================================
const demeritosRadios = document.querySelectorAll('input[name="rango_demeritos"]');
const rangoDemeritosItems = document.querySelectorAll('.rango-demeritos-item');
const puntoDemeritosItems = document.querySelectorAll('.punto-demeritos-item');
const demeritosSeleccionado = document.getElementById('demeritos_seleccionado');
const demeritosTexto = document.getElementById('demeritos_texto');
const bolDemeritos = document.getElementById('bol_demeritos');

// Mapeo de valores a texto para deméritos
const demeritosTextos = {
    '5': '0 deméritos - 5 puntos',
    '4': 'De 1 a 18 deméritos - 4 puntos',
    '3': 'De 19 a 36 deméritos - 3 puntos',
    '2': 'De 37 a 54 deméritos - 2 puntos',
    '1': 'De 55 a 74 deméritos - 1 punto',
    '0': 'De 75 a 100 deméritos - 0 puntos'
};

// Variables de control deméritos
let datosDemeritosCargados = false;

// =============================================================================
// ARRESTOS - Elementos y Variables
// =============================================================================
const arrestosRadios = document.querySelectorAll('input[name="rango_arrestos"]');
const rangoArrestosItems = document.querySelectorAll('.rango-arrestos-item');
const puntoArrestosItems = document.querySelectorAll('.punto-arrestos-item');
const arrestosSeleccionado = document.getElementById('arrestos_seleccionado');
const arrestosTexto = document.getElementById('arrestos_texto');
const bolArrestos = document.getElementById('bol_arrestos');

// Mapeo de valores a texto para arrestos
const arrestosTextos = {
    '5': '0 arrestos - 5 puntos',
    '4': 'De 1 a 5 arrestos - 4 puntos',
    '3': 'De 6 a 10 arrestos - 3 puntos',
    '2': 'De 11 a 15 arrestos - 2 puntos',
    '1': 'De 16 a más arrestos - 1 punto'
};

// Variables de control arrestos
let datosArrestosCargados = false;

// =============================================================================
// MÉRITOS - Elementos y Variables
// =============================================================================
const merito1Select = document.getElementById('merito_1');
const merito2Select = document.getElementById('merito_2');
const totalPuntosMeritos = document.getElementById('total_puntos_meritos');
const detalleMeritos = document.getElementById('detalle_meritos');
const bolMeritosTotal = document.getElementById('bol_meritos_total');
const bolMeritosDetalle = document.getElementById('bol_meritos_detalle');
const contadorMerito1 = document.getElementById('contador_merito_1');
const contadorMerito2 = document.getElementById('contador_merito_2');

// Variables de control méritos
let datosMeritosNota3Cargados = false;
let datosMeritosNota2Cargados = false;
let meritosNota3 = [];
let meritosNota2 = [];

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
    if (pafeInfo && pafeMensaje) {
        pafeInfo.classList.remove('d-none', 'alert-info', 'alert-success', 'alert-warning', 'alert-danger');
        pafeInfo.classList.add(`alert-${tipo}`);
        pafeMensaje.textContent = mensaje;
    }
}

/**
 * Función para ocultar información de PAFE
 */
const ocultarInfoPafe = () => {
    if (pafeInfo) {
        pafeInfo.classList.add('d-none');
    }
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
    if (pafeEva1) pafeEva1.value = '';
    if (pafeEva2) pafeEva2.value = '';
    if (pafeEva3) pafeEva3.value = '';
    if (pafeEva4) pafeEva4.value = '';
    if (pafePromedio) pafePromedio.value = '';
    if (bolPafe) bolPafe.value = '';
    
    // Limpiar selecciones visuales
    rangoItems.forEach(item => item.classList.remove('selected'));
    puntoPafeItems.forEach(item => item.classList.remove('selected'));
    
    // Resetear texto de meses
    if (mesEva1) mesEva1.textContent = 'Abril 2025';
    if (mesEva2) mesEva2.textContent = 'Mayo 2025';
    if (mesEva3) mesEva3.textContent = 'Junio 2025';
    if (mesEva4) mesEva4.textContent = 'Julio 2025';
    
    datosPafeCargados = false;
    ocultarInfoPafe();
}

/**
 * Función para limpiar datos de deméritos y arrestos
 */
const limpiarDatosDemeritosArrestos = () => {
    // Limpiar deméritos
    const demeritosRadios = document.querySelectorAll('input[name="rango_demeritos"]');
    demeritosRadios.forEach(radio => radio.checked = false);
    actualizarDemeritosSeleccionado(null);
    datosDemeritosCargados = false;
    
    // Limpiar arrestos
    const arrestosRadios = document.querySelectorAll('input[name="rango_arrestos"]');
    arrestosRadios.forEach(radio => radio.checked = false);
    actualizarArrestosSeleccionado(null);
    datosArrestosCargados = false;
    
    // ⭐ NUEVAS LÍNEAS - Habilitar controles al limpiar
    habilitarControlesDemeritos();
    habilitarControlesArrestos();
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

            console.log('✅ Datos del evaluado cargados correctamente');
            
            // Cargar automáticamente los datos de PAFE
            await cargarDatosPafe(catalogoEvaluado);
            
            // ⭐ NUEVAS LÍNEAS - Cargar automáticamente deméritos y arrestos
            await cargarDatosDemeritos(catalogoEvaluado);
            await cargarDatosArrestos(catalogoEvaluado);
            
            // ⭐ INTEGRACIÓN - Cargar méritos
            await cargarTodosLosMeritos();
            
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
// FUNCIONES DE CARGA AUTOMÁTICA DE DEMÉRITOS Y ARRESTOS
// =============================================================================

/**
 * Cargar datos de deméritos del evaluado
 */
const cargarDatosDemeritos = async (catalogo) => {
    if (!catalogo) return;

    console.log('🔍 Cargando deméritos para catálogo:', catalogo);

    const url = `/evaluacion_desempe-o/API/evaluacionformulario/obtenerDemeritosEvaluado?catalogo=${catalogo}`;
    const config = {
        method: 'GET'
    }

    try {
        const respuesta = await fetch(url, config);
        const datos = await respuesta.json();
        const { codigo, mensaje, data } = datos;

        if (codigo === 1) {
            // Marcar automáticamente el radio button correspondiente
            const radioDemeritos = document.querySelector(`input[name="rango_demeritos"][value="${data.puntos}"]`);
            if (radioDemeritos) {
                radioDemeritos.checked = true;
                actualizarDemeritosSeleccionado(data.puntos.toString());
                datosDemeritosCargados = true;
                // ⭐ NUEVA LÍNEA - Deshabilitar controles después de cargar
                deshabilitarControlesDemeritos();
            }

            console.log(`✅ Deméritos cargados: ${data.demeritos} deméritos = ${data.puntos} puntos`);
            console.log(`📊 Rango: ${data.rango_texto}`);
            
        } else {
            console.warn('⚠️ No se pudieron cargar los deméritos:', mensaje);
            // En caso de error, no seleccionar nada automáticamente
        }

    } catch (error) {
        console.error('❌ Error al cargar datos de deméritos:', error);
        // En caso de error, no hacer nada para no romper el formulario
    }
}

/**
 * Cargar datos de arrestos del evaluado
 */
const cargarDatosArrestos = async (catalogo) => {
    if (!catalogo) return;

    console.log('🔍 Cargando arrestos para catálogo:', catalogo);

    const url = `/evaluacion_desempe-o/API/evaluacionformulario/obtenerArrestosEvaluado?catalogo=${catalogo}`;
    const config = {
        method: 'GET'
    }

    try {
        const respuesta = await fetch(url, config);
        const datos = await respuesta.json();
        const { codigo, mensaje, data } = datos;

        if (codigo === 1) {
            // Marcar automáticamente el radio button correspondiente
            const radioArrestos = document.querySelector(`input[name="rango_arrestos"][value="${data.puntos}"]`);
            if (radioArrestos) {
                radioArrestos.checked = true;
                actualizarArrestosSeleccionado(data.puntos.toString());
                datosArrestosCargados = true;
                // ⭐ NUEVA LÍNEA - Deshabilitar controles después de cargar
                deshabilitarControlesArrestos();
            }

            console.log(`✅ Arrestos cargados: ${data.arrestos} arrestos = ${data.puntos} puntos`);
            console.log(`📊 Rango: ${data.rango_texto}`);
            
        } else {
            console.warn('⚠️ No se pudieron cargar los arrestos:', mensaje);
            // En caso de error, no seleccionar nada automáticamente
        }

    } catch (error) {
        console.error('❌ Error al cargar datos de arrestos:', error);
        // En caso de error, no hacer nada para no romper el formulario
    }
}

// =============================================================================
// FUNCIONES DE CARGA DE MÉRITOS
// =============================================================================

/**
 * Cargar méritos por nota (2 o 3)
 */
const cargarMeritos = async (nota) => {
    const url = `/evaluacion_desempe-o/API/evaluacionformulario/obtenerMeritos?nota=${nota}`;
    const config = {
        method: 'GET'
    }

    try {
        const respuesta = await fetch(url, config);
        const datos = await respuesta.json();
        const { codigo, mensaje, data } = datos;

        if (codigo === 1) {
            if (nota === 3) {
                meritosNota3 = data;
                llenarSelectMeritos('merito_1', data, 3);
                datosMeritosNota3Cargados = true;
                console.log(`✅ Méritos nota 3 cargados: ${data.length} opciones`);
            } else if (nota === 2) {
                meritosNota2 = data;
                llenarSelectMeritos('merito_2', data, 2);
                datosMeritosNota2Cargados = true;
                console.log(`✅ Méritos nota 2 cargados: ${data.length} opciones`);
            }
        } else {
            console.warn(`⚠️ No se pudieron cargar los méritos nota ${nota}:`, mensaje);
            if (nota === 3) {
                merito1Select.innerHTML = '<option value="">No hay méritos disponibles</option>';
            } else {
                merito2Select.innerHTML = '<option value="">No hay méritos disponibles</option>';
            }
        }

    } catch (error) {
        console.error(`❌ Error al cargar méritos nota ${nota}:`, error);
        if (nota === 3) {
            merito1Select.innerHTML = '<option value="">Error al cargar méritos</option>';
        } else {
            merito2Select.innerHTML = '<option value="">Error al cargar méritos</option>';
        }
    }
}

/**
 * Llenar select con las opciones de méritos
 */
const llenarSelectMeritos = (selectId, meritos, nota) => {
    const select = document.getElementById(selectId);
    if (!select) return;

    // Limpiar opciones anteriores
    select.innerHTML = '';

    // Agregar opción por defecto
    const defaultOption = document.createElement('option');
    defaultOption.value = '';
    defaultOption.textContent = '-- Seleccione méritos aplicables --';
    defaultOption.disabled = true;
    select.appendChild(defaultOption);

    // Agregar méritos
    meritos.forEach(merito => {
        const option = document.createElement('option');
        option.value = merito.mer_codigo;
        option.textContent = merito.mer_descripcion;
        option.dataset.nota = nota;
        select.appendChild(option);
    });

    console.log(`📝 Select ${selectId} llenado con ${meritos.length} méritos`);
}

/**
 * Cargar todos los méritos al inicializar
 */
const cargarTodosLosMeritos = async () => {
    console.log('🔍 Cargando méritos...');
    await Promise.all([
        cargarMeritos(3), // Mérito 1
        cargarMeritos(2)  // Mérito 2
    ]);
    console.log('✅ Todos los méritos cargados');
}

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
            if (pafeEva1) pafeEva1.value = evaluaciones[0] || 0;
            if (pafeEva2) pafeEva2.value = evaluaciones[1] || 0;
            if (pafeEva3) pafeEva3.value = evaluaciones[2] || 0;
            if (pafeEva4) pafeEva4.value = evaluaciones[3] || 0;
            
            // Llenar promedio
            if (pafePromedio) pafePromedio.value = data.promedio || 0;
            
            // Llenar valor oculto para guardar en BD
            if (bolPafe) bolPafe.value = data.puntos_pafe || 0;
            
            // Actualizar nombres de meses
            if (data.meses_consultados && data.meses_consultados.length >= 4) {
                if (mesEva1) mesEva1.textContent = data.meses_consultados[0];
                if (mesEva2) mesEva2.textContent = data.meses_consultados[1];
                if (mesEva3) mesEva3.textContent = data.meses_consultados[2];
                if (mesEva4) mesEva4.textContent = data.meses_consultados[3];
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
    if (!datosPafeCargados && document.getElementById('pafe_eva1')) {
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
// FUNCIONES DE DEMÉRITOS
// =============================================================================

/**
 * Función para actualizar la visualización de deméritos seleccionados
 */
const actualizarDemeritosSeleccionado = (valor) => {
    // Limpiar selecciones anteriores
    rangoDemeritosItems.forEach(item => item.classList.remove('selected'));
    puntoDemeritosItems.forEach(item => item.classList.remove('selected'));
    
    if (valor) {
        // Marcar el item seleccionado
        const rangoSeleccionado = document.querySelector(`.rango-demeritos-item[data-value="${valor}"]`);
        const puntoSeleccionado = document.querySelector(`.punto-demeritos-item[data-value="${valor}"]`);
        
        if (rangoSeleccionado) {
            rangoSeleccionado.classList.add('selected');
        }
        
        if (puntoSeleccionado) {
            puntoSeleccionado.classList.add('selected');
        }
        
        // Actualizar campo oculto
        if (bolDemeritos) {
            bolDemeritos.value = valor;
        }
        
        // Actualizar texto informativo
        if (demeritosTexto && demeritosSeleccionado) {
            demeritosTexto.textContent = demeritosTextos[valor] || 'Selección inválida';
            demeritosSeleccionado.classList.remove('d-none');
            demeritosSeleccionado.classList.remove('alert-warning');
            demeritosSeleccionado.classList.add('alert-success');
        }
        
        console.log(`✅ Deméritos seleccionados: ${demeritosTextos[valor]}`);
    } else {
        // No hay selección
        if (bolDemeritos) {
            bolDemeritos.value = '';
        }
        
        if (demeritosTexto && demeritosSeleccionado) {
            demeritosTexto.textContent = 'Seleccione un rango de deméritos';
            demeritosSeleccionado.classList.remove('d-none');
            demeritosSeleccionado.classList.remove('alert-success');
            demeritosSeleccionado.classList.add('alert-warning');
        }
    }
}

/**
 * Función para validar que los deméritos estén seleccionados
 */
const validarDemeritos = () => {
    const demeritosSeleccionadoRadio = document.querySelector('input[name="rango_demeritos"]:checked');
    
    if (!demeritosSeleccionadoRadio && document.querySelector('input[name="rango_demeritos"]')) {
        Swal.fire({
            position: "center",
            icon: "warning",
            title: "Deméritos Requerido",
            text: "Debe seleccionar un rango de deméritos",
            showConfirmButton: true,
        });
        
        // Scroll hacia la sección de deméritos
        const demeritosContainer = document.querySelector('.demeritos-container');
        if (demeritosContainer) {
            demeritosContainer.scrollIntoView({
                behavior: 'smooth',
                block: 'center'
            });
        }
        
        return false;
    }
    
    return true;
}

// =============================================================================
// FUNCIONES DE ARRESTOS
// =============================================================================

/**
 * Función para actualizar la visualización de arrestos seleccionados
 */
const actualizarArrestosSeleccionado = (valor) => {
    // Limpiar selecciones anteriores
    rangoArrestosItems.forEach(item => item.classList.remove('selected'));
    puntoArrestosItems.forEach(item => item.classList.remove('selected'));
    
    if (valor) {
        // Marcar el item seleccionado
        const rangoSeleccionado = document.querySelector(`.rango-arrestos-item[data-value="${valor}"]`);
        const puntoSeleccionado = document.querySelector(`.punto-arrestos-item[data-value="${valor}"]`);
        
        if (rangoSeleccionado) {
            rangoSeleccionado.classList.add('selected');
        }
        
        if (puntoSeleccionado) {
            puntoSeleccionado.classList.add('selected');
        }
        
        // Actualizar campo oculto
        if (bolArrestos) {
            bolArrestos.value = valor;
        }
        
        // Actualizar texto informativo
        if (arrestosTexto && arrestosSeleccionado) {
            arrestosTexto.textContent = arrestosTextos[valor] || 'Selección inválida';
            arrestosSeleccionado.classList.remove('d-none');
            arrestosSeleccionado.classList.remove('alert-warning');
            arrestosSeleccionado.classList.add('alert-success');
        }
        
        console.log(`✅ Arrestos seleccionados: ${arrestosTextos[valor]}`);
    } else {
        // No hay selección
        if (bolArrestos) {
            bolArrestos.value = '';
        }
        
        if (arrestosTexto && arrestosSeleccionado) {
            arrestosTexto.textContent = 'Seleccione un rango de arrestos';
            arrestosSeleccionado.classList.remove('d-none');
            arrestosSeleccionado.classList.remove('alert-success');
            arrestosSeleccionado.classList.add('alert-warning');
        }
    }
}

/**
 * Función para validar que los arrestos estén seleccionados
 */
const validarArrestos = () => {
    const arrestosSeleccionadoRadio = document.querySelector('input[name="rango_arrestos"]:checked');
    
    if (!arrestosSeleccionadoRadio && document.querySelector('input[name="rango_arrestos"]')) {
        Swal.fire({
            position: "center",
            icon: "warning",
            title: "Arrestos Requerido",
            text: "Debe seleccionar un rango de arrestos",
            showConfirmButton: true,
        });
        
        // Scroll hacia la sección de arrestos
        const arrestosContainer = document.querySelector('.arrestos-container');
        if (arrestosContainer) {
            arrestosContainer.scrollIntoView({
                behavior: 'smooth',
                block: 'center'
            });
        }
        
        return false;
    }
    
    return true;
}

// =============================================================================
// FUNCIONES DE MANEJO DE MÉRITOS
// =============================================================================

/**
 * Marcar todas las opciones de un mérito
 */
const marcarTodosLosMeritos = (selectId) => {
    const select = document.getElementById(selectId);
    if (!select) return;

    // Seleccionar todas las opciones (excepto la primera que es el placeholder)
    Array.from(select.options).forEach((option, index) => {
        if (index > 0) { // Saltar la primera opción (placeholder)
            option.selected = true;
        }
    });

    // Actualizar contador y totales
    actualizarContadorMeritos(selectId);
    calcularTotalMeritos();

    console.log(`✅ Todas las opciones seleccionadas en ${selectId}`);
}

/**
 * Limpiar selecciones de un mérito
 */
const limpiarMeritos = (selectId) => {
    const select = document.getElementById(selectId);
    if (!select) return;

    // Deseleccionar todas las opciones
    Array.from(select.options).forEach(option => {
        option.selected = false;
    });

    // Actualizar contador y totales
    actualizarContadorMeritos(selectId);
    calcularTotalMeritos();

    console.log(`🧹 Selecciones limpiadas en ${selectId}`);
}

/**
 * Actualizar contador de un mérito específico
 */
const actualizarContadorMeritos = (selectId) => {
    const select = document.getElementById(selectId);
    const contador = document.getElementById(`contador_${selectId}`);
    
    if (!select || !contador) return;

    const seleccionados = Array.from(select.selectedOptions).filter(option => option.value !== '');
    contador.textContent = `${seleccionados.length} seleccionados`;

    // Cambiar color del badge según cantidad
    contador.className = 'badge ms-2';
    if (seleccionados.length === 0) {
        contador.classList.add('bg-secondary');
    } else if (seleccionados.length <= 3) {
        contador.classList.add('bg-info');
    } else {
        contador.classList.add('bg-success');
    }
}

/**
 * Calcular total de puntos de méritos
 */
const calcularTotalMeritos = () => {
    let total = 0;
    let detalleArray = [];

    // Mérito 1 (3 puntos cada uno)
    if (merito1Select) {
        const seleccionados1 = Array.from(merito1Select.selectedOptions).filter(option => option.value !== '');
        const puntos1 = seleccionados1.length * 3;
        total += puntos1;
        
        if (seleccionados1.length > 0) {
            detalleArray.push(`Mérito 1: ${seleccionados1.length} × 3 = ${puntos1} puntos`);
        }
    }

    // Mérito 2 (2 puntos cada uno)
    if (merito2Select) {
        const seleccionados2 = Array.from(merito2Select.selectedOptions).filter(option => option.value !== '');
        const puntos2 = seleccionados2.length * 2;
        total += puntos2;
        
        if (seleccionados2.length > 0) {
            detalleArray.push(`Mérito 2: ${seleccionados2.length} × 2 = ${puntos2} puntos`);
        }
    }

    // Actualizar UI
    if (totalPuntosMeritos) {
        totalPuntosMeritos.textContent = total;
    }

    if (detalleMeritos) {
        if (detalleArray.length > 0) {
            detalleMeritos.innerHTML = detalleArray.map(detalle => 
                `<span class="merito-detalle-item">${detalle}</span>`
            ).join('');
        } else {
            detalleMeritos.innerHTML = '<em>No hay méritos seleccionados</em>';
        }
    }

    // Actualizar campos ocultos
    if (bolMeritosTotal) {
        bolMeritosTotal.value = total;
    }

    if (bolMeritosDetalle) {
        const detalleFinal = {
            merito_1: merito1Select ? Array.from(merito1Select.selectedOptions)
                .filter(option => option.value !== '')
                .map(option => option.value) : [],
            merito_2: merito2Select ? Array.from(merito2Select.selectedOptions)
                .filter(option => option.value !== '')
                .map(option => option.value) : [],
            total_puntos: total
        };
        bolMeritosDetalle.value = JSON.stringify(detalleFinal);
    }

    console.log(`💰 Total de méritos calculado: ${total} puntos`);
}

/**
 * Limpiar todos los méritos
 */
const limpiarTodosMeritos = () => {
    limpiarMeritos('merito_1');
    limpiarMeritos('merito_2');
    console.log('🧹 Todos los méritos limpiados');
}

/**
 * Validar que haya al menos un mérito seleccionado (opcional)
 */
const validarMeritos = () => {
    // Esta validación es opcional, los méritos pueden estar vacíos
    const total = parseInt(bolMeritosTotal?.value || '0');
    
    if (total === 0) {
        console.log('ℹ️ No hay méritos seleccionados (opcional)');
    } else {
        console.log(`✅ Méritos validados: ${total} puntos`);
    }
    
    return true; // Siempre válido porque es opcional
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

    // Validación de deméritos (si la sección existe)
    if (!validarDemeritos()) {
        BtnGuardar.disabled = false;
        return;
    }

    // Validación de arrestos (si la sección existe)
    if (!validarArrestos()) {
        BtnGuardar.disabled = false;
        return;
    }

    // ⭐ INTEGRACIÓN - Validación de méritos (opcional pero recomendada)
    validarMeritos();

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
        limpiarDatosDemeritosArrestos();
        // ⭐ INTEGRACIÓN - Limpiar méritos
        limpiarTodosMeritos();
        
        // Limpiar selecciones
        if (typeof actualizarPerfilSeleccionado === 'function') {
            actualizarPerfilSeleccionado(null);
        }
        actualizarDemeritosSeleccionado(null);
        actualizarArrestosSeleccionado(null);
        
        // Recargar datos del evaluado
        await cargarDatosEvaluado();
        
        await Swal.fire({
            position: "center",
            icon: "success",
            title: "Formulario limpiado",
            text: "Los datos del evaluado, PAFEs, deméritos, arrestos y méritos se han recargado automáticamente",
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
// FUNCIONES PARA DESHABILITAR CONTROLES AUTOMÁTICOS
// =============================================================================

/**
 * Deshabilitar todos los controles de deméritos
 */
const deshabilitarControlesDemeritos = () => {
    // Deshabilitar todos los radio buttons de deméritos
    const demeritosRadios = document.querySelectorAll('input[name="rango_demeritos"]');
    demeritosRadios.forEach(radio => {
        radio.disabled = true;
    });

    // Deshabilitar clicks en los items visuales
    const rangoDemeritosItems = document.querySelectorAll('.rango-demeritos-item');
    rangoDemeritosItems.forEach(item => {
        item.style.pointerEvents = 'none';
        item.style.opacity = '0.7';
        item.classList.add('disabled-auto');
    });

    const puntoDemeritosItems = document.querySelectorAll('.punto-demeritos-item');
    puntoDemeritosItems.forEach(item => {
        item.style.pointerEvents = 'none';
        item.style.opacity = '0.7';
        item.classList.add('disabled-auto');
    });

    console.log('🔒 Controles de deméritos deshabilitados (carga automática)');
}

/**
 * Deshabilitar todos los controles de arrestos
 */
const deshabilitarControlesArrestos = () => {
    // Deshabilitar todos los radio buttons de arrestos
    const arrestosRadios = document.querySelectorAll('input[name="rango_arrestos"]');
    arrestosRadios.forEach(radio => {
        radio.disabled = true;
    });

    // Deshabilitar clicks en los items visuales
    const rangoArrestosItems = document.querySelectorAll('.rango-arrestos-item');
    rangoArrestosItems.forEach(item => {
        item.style.pointerEvents = 'none';
        item.style.opacity = '0.7';
        item.classList.add('disabled-auto');
    });

    const puntoArrestosItems = document.querySelectorAll('.punto-arrestos-item');
    puntoArrestosItems.forEach(item => {
        item.style.pointerEvents = 'none';
        item.style.opacity = '0.7';
        item.classList.add('disabled-auto');
    });

    console.log('🔒 Controles de arrestos deshabilitados (carga automática)');
}

/**
 * Habilitar controles de deméritos (para cuando se limpia)
 */
const habilitarControlesDemeritos = () => {
    const demeritosRadios = document.querySelectorAll('input[name="rango_demeritos"]');
    demeritosRadios.forEach(radio => {
        radio.disabled = false;
    });

    const rangoDemeritosItems = document.querySelectorAll('.rango-demeritos-item');
    rangoDemeritosItems.forEach(item => {
        item.style.pointerEvents = 'auto';
        item.style.opacity = '1';
        item.classList.remove('disabled-auto');
    });

    const puntoDemeritosItems = document.querySelectorAll('.punto-demeritos-item');
    puntoDemeritosItems.forEach(item => {
        item.style.pointerEvents = 'auto';
        item.style.opacity = '1';
        item.classList.remove('disabled-auto');
    });
}

/**
 * Habilitar controles de arrestos (para cuando se limpia)
 */
const habilitarControlesArrestos = () => {
    const arrestosRadios = document.querySelectorAll('input[name="rango_arrestos"]');
    arrestosRadios.forEach(radio => {
        radio.disabled = false;
    });

    const rangoArrestosItems = document.querySelectorAll('.rango-arrestos-item');
    rangoArrestosItems.forEach(item => {
        item.style.pointerEvents = 'auto';
        item.style.opacity = '1';
        item.classList.remove('disabled-auto');
    });

    const puntoArrestosItems = document.querySelectorAll('.punto-arrestos-item');
    puntoArrestosItems.forEach(item => {
        item.style.pointerEvents = 'auto';
        item.style.opacity = '1';
        item.classList.remove('disabled-auto');
    });
}

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

    // Inicializar deméritos si existe
    const demeritosSeleccionadoActual = document.querySelector('input[name="rango_demeritos"]:checked');
    if (demeritosSeleccionadoActual) {
        actualizarDemeritosSeleccionado(demeritosSeleccionadoActual.value);
    }

    // Inicializar arrestos si existe
    const arrestosSeleccionadoActual = document.querySelector('input[name="rango_arrestos"]:checked');
    if (arrestosSeleccionadoActual) {
        actualizarArrestosSeleccionado(arrestosSeleccionadoActual.value);
    }

    // ⭐ NUEVA LÍNEA - Log de integración
    console.log('✅ JavaScript de Deméritos y Arrestos integrado correctamente');
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

/**
 * Event listeners para deméritos
 */
if (demeritosRadios.length > 0) {
    demeritosRadios.forEach(radio => {
        radio.addEventListener('change', (e) => {
            if (e.target.checked) {
                actualizarDemeritosSeleccionado(e.target.value);
            }
        });
    });
}

if (rangoDemeritosItems.length > 0) {
    rangoDemeritosItems.forEach(item => {
        item.addEventListener('click', (e) => {
            // Evitar doble disparo si se hace click directamente en el radio
            if (e.target.type !== 'radio') {
                const valor = item.dataset.value;
                const radio = document.querySelector(`input[name="rango_demeritos"][value="${valor}"]`);
                if (radio) {
                    radio.checked = true;
                    actualizarDemeritosSeleccionado(valor);
                }
            }
        });
    });
}

if (puntoDemeritosItems.length > 0) {
    puntoDemeritosItems.forEach(item => {
        item.addEventListener('click', (e) => {
            const valor = item.dataset.value;
            const radio = document.querySelector(`input[name="rango_demeritos"][value="${valor}"]`);
            if (radio) {
                radio.checked = true;
                actualizarDemeritosSeleccionado(valor);
            }
        });
    });
}

/**
 * Event listeners para arrestos
 */
if (arrestosRadios.length > 0) {
    arrestosRadios.forEach(radio => {
        radio.addEventListener('change', (e) => {
            if (e.target.checked) {
                actualizarArrestosSeleccionado(e.target.value);
            }
        });
    });
}

if (rangoArrestosItems.length > 0) {
    rangoArrestosItems.forEach(item => {
        item.addEventListener('click', (e) => {
            // Evitar doble disparo si se hace click directamente en el radio
            if (e.target.type !== 'radio') {
                const valor = item.dataset.value;
                const radio = document.querySelector(`input[name="rango_arrestos"][value="${valor}"]`);
                if (radio) {
                    radio.checked = true;
                    actualizarArrestosSeleccionado(valor);
                }
            }
        });
    });
}

if (puntoArrestosItems.length > 0) {
    puntoArrestosItems.forEach(item => {
        item.addEventListener('click', (e) => {
            const valor = item.dataset.value;
            const radio = document.querySelector(`input[name="rango_arrestos"][value="${valor}"]`);
            if (radio) {
                radio.checked = true;
                actualizarArrestosSeleccionado(valor);
            }
        });
    });
}

/**
 * Event listeners para méritos
 */
// Event listeners para cambios en las selecciones
if (merito1Select) {
    merito1Select.addEventListener('change', () => {
        actualizarContadorMeritos('merito_1');
        calcularTotalMeritos();
    });
}

if (merito2Select) {
    merito2Select.addEventListener('change', () => {
        actualizarContadorMeritos('merito_2');
        calcularTotalMeritos();
    });
}

// =============================================================================
// CSS ADICIONAL PARA ELEMENTOS DESHABILITADOS
// =============================================================================

// Agregar este CSS al final del archivo JavaScript (o al CSS principal):
const stylesCSS = `
<style>
.rango-demeritos-item.disabled-auto,
.rango-arrestos-item.disabled-auto,
.punto-demeritos-item.disabled-auto,
.punto-arrestos-item.disabled-auto {
    cursor: not-allowed !important;
    background-color: #f3f4f6 !important;
}

.rango-demeritos-item.disabled-auto:hover,
.rango-arrestos-item.disabled-auto:hover,
.punto-demeritos-item.disabled-auto:hover,
.punto-arrestos-item.disabled-auto:hover {
    transform: none !important;
    border-color: #e5e7eb !important;
}

/* Estilo especial para los elementos seleccionados automáticamente */
.rango-demeritos-item.selected.disabled-auto,
.rango-arrestos-item.selected.disabled-auto {
    background: linear-gradient(135deg, rgba(220, 38, 38, 0.3) 0%, rgba(220, 38, 38, 0.1) 100%) !important;
    border-color: #dc2626 !important;
}

.punto-demeritos-item.selected.disabled-auto .punto-demeritos-box,
.punto-arrestos-item.selected.disabled-auto .punto-arrestos-box {
    background: #dc2626 !important;
    color: white !important;
    opacity: 0.8 !important;
}

/* Estilos para méritos */
.merito-detalle-item {
    display: inline-block;
    background: #e0f2fe;
    color: #0277bd;
    padding: 2px 8px;
    border-radius: 12px;
    font-size: 0.875rem;
    margin: 2px;
    font-weight: 500;
}

.contador_merito_1,
.contador_merito_2 {
    transition: all 0.3s ease;
}

/* Estilos para select múltiple */
select[multiple] option:checked {
    background: #2563eb !important;
    color: white !important;
}

select[multiple] {
    min-height: 120px;
}
</style>
`;

// Inyectar CSS automáticamente
if (document.head) {
    document.head.insertAdjacentHTML('beforeend', stylesCSS);
}

// =============================================================================
// LOGS DE CONFIRMACIÓN
// =============================================================================

console.log('✅ JavaScript del Formulario de Evaluación cargado correctamente');
console.log('✅ JavaScript del Perfil Biofísico integrado correctamente');
console.log('✅ JavaScript de Condición Física (PAFEs) integrado correctamente');
console.log('✅ JavaScript de Deméritos integrado correctamente');
console.log('✅ JavaScript de Arrestos integrado correctamente');
console.log('✅ JavaScript de Méritos integrado correctamente');
console.log('🚀 Sistema de carga automática de deméritos y arrestos activado');
console.log('🎖️ Sistema de méritos con selección múltiple activado');