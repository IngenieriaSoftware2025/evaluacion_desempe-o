import Swal from "sweetalert2";
import { validarFormulario } from '../funciones';


// ELEMENTOS DEL DOM - PÁGINA 2


const FormConceptualizacion = document.getElementById('FormConceptualizacion');
const BtnGuardarConceptualizacion = document.getElementById('BtnGuardarConceptualizacion');
const BtnGuardarCompleto = document.getElementById('BtnGuardarCompleto');
const BtnVolverPagina1 = document.getElementById('BtnVolverPagina1');

// Campos ocultos
const bolCatEvaluadoP2 = document.getElementById('bol_cat_evaluado_p2');
const bolCatEvaluadorP2 = document.getElementById('bol_cat_evaluador_p2');
const bolAnioP2 = document.getElementById('bol_anio_p2');

// Campos de información (readonly)
const infoEvaluado = document.getElementById('info_evaluado');
const infoEvaluador = document.getElementById('info_evaluador');
const totalSaludConducta = document.getElementById('total_salud_conducta');

// Elementos para mostrar subtotales y total
const subtotal1 = document.getElementById('subtotal_1');
const subtotal2 = document.getElementById('subtotal_2');
const subtotal3 = document.getElementById('subtotal_3');
const subtotal4 = document.getElementById('subtotal_4');
const subtotal5 = document.getElementById('subtotal_5');
const totalConcepto = document.getElementById('total_conceptualizacion');
const bolTotalConcep = document.getElementById('bol_total_concep');

// Elementos del resumen
const resumenSaludConducta = document.getElementById('resumen_salud_conducta');
const resumenConceptualizacion = document.getElementById('resumen_conceptualizacion');
const resumenTotal = document.getElementById('resumen_total');
const resumenCategoria = document.getElementById('resumen_categoria');

// Variables de control
let catalogoEvaluado = '';
let datosEvaluacionCargados = false;
let datosConceptualizacionGuardados = false;


// FUNCIONES GENERALES


/**
 * Función para obtener parámetros de la URL
 */
const obtenerParametroUrl = (nombre) => {
    const urlParams = new URLSearchParams(window.location.search);
    return urlParams.get(nombre);
}

/**
 * Función para formatear nombre completo
 */
const formatearNombreCompleto = (datos) => {
    if (!datos) return 'N/A';
    
    const nombre = (datos.per_nom1 || '').trim() + ' ' + (datos.per_nom2 || '').trim();
    const apellidos = (datos.per_ape1 || '').trim() + ' ' + (datos.per_ape2 || '').trim();
    const grado = datos.grado || '';
    
    return `${grado} ${nombre} ${apellidos}`.trim();
}

/**
 * Función para calcular categoría según puntos totales
 */
const calcularCategoria = (totalPuntos) => {
    if (totalPuntos >= 90) return { texto: 'Excelente', color: '#10b981' };
    if (totalPuntos >= 75) return { texto: 'Bueno', color: '#3b82f6' };
    if (totalPuntos >= 60) return { texto: 'Satisfactorio', color: '#f59e0b' };
    if (totalPuntos >= 40) return { texto: 'Regular', color: '#f97316' };
    return { texto: 'Deficiente', color: '#ef4444' };
}

/**
 * Función para cargar datos de evaluación existente (si existe)
 */
const cargarDatosEvaluacionExistente = async () => {
    if (!catalogoEvaluado) return;

    const url = `/evaluacion_desempe-o/API/evaluacion/obtenerDatos?catalogo=${catalogoEvaluado}&anio=2025`;
    const config = { method: 'GET' };

    try {
        const respuesta = await fetch(url, config);
        const datos = await respuesta.json();
        const { codigo, data } = datos;

        if (codigo === 1 && data) {
            console.log('📋 Datos de evaluación encontrados:', data);
            
            // Llenar información básica
            bolCatEvaluadoP2.value = data.bol_cat_evaluado || '';
            bolCatEvaluadorP2.value = data.bol_cat_evaluador || '';
            
            // Mostrar total de salud y conducta
            if (totalSaludConducta && data.bol_total_salud) {
                totalSaludConducta.value = data.bol_total_salud;
                actualizarResumen(data.bol_total_salud, data.bol_total_concep || 0, data.bol_total || 0);
            }
            
            // Si hay conceptualización guardada, cargarla
            if (data.bol_total_concep && data.bol_total_concep > 0) {
                console.log('🔄 Cargando conceptualización existente...');
                // Aquí podrías cargar los aspectos individuales si los guardas por separado
                totalConcepto.textContent = data.bol_total_concep;
                bolTotalConcep.value = data.bol_total_concep;
                datosConceptualizacionGuardados = true;
            }
            
            datosEvaluacionCargados = true;
            return data;
        } else {
            console.log('ℹ️ No se encontraron datos de evaluación existentes');
        }
    } catch (error) {
        console.error('Error al cargar datos existentes:', error);
    }
    
    return null;
}

/**
 * Función para cargar información del evaluado y evaluador
 */
const cargarInformacionBasica = async () => {
    catalogoEvaluado = obtenerParametroUrl('catalogo');
    
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

    // Cargar datos del evaluado
    const urlEvaluado = `/evaluacion_desempe-o/API/evaluacion/obtenerDatosEvaluado?catalogo=${catalogoEvaluado}`;
    
    try {
        const respuesta = await fetch(urlEvaluado);
        const datos = await respuesta.json();
        const { codigo, data } = datos;

        if (codigo === 1) {
            // Mostrar información del evaluado
            infoEvaluado.value = `${data.catalogo} - ${data.nombre_completo}`;
            bolCatEvaluadoP2.value = data.catalogo;
            
            console.log('✅ Información del evaluado cargada');
        } else {
            throw new Error('No se pudo cargar la información del evaluado');
        }
    } catch (error) {
        console.error('Error al cargar información básica:', error);
        await Swal.fire({
            position: "center",
            icon: "error",
            title: "Error",
            text: "No se pudo cargar la información básica",
            showConfirmButton: true,
        });
    }
}


// FUNCIONES DE CONCEPTUALIZACIÓN


/**
 * Función para calcular subtotales y total
 */
const calcularTotales = () => {
    let contadores = {1: 0, 2: 0, 3: 0, 4: 0, 5: 0};
    let totalGeneral = 0;

    // Contar respuestas por cada valor (1-5)
    for (let i = 1; i <= 15; i++) {
        const aspectoSeleccionado = document.querySelector(`input[name="aspecto_${i}"]:checked`);
        if (aspectoSeleccionado) {
            const valor = parseInt(aspectoSeleccionado.value);
            contadores[valor]++;
            totalGeneral += valor;
        }
    }

    // Actualizar subtotales en pantalla
    if (subtotal1) subtotal1.textContent = contadores[1];
    if (subtotal2) subtotal2.textContent = contadores[2];
    if (subtotal3) subtotal3.textContent = contadores[3];
    if (subtotal4) subtotal4.textContent = contadores[4];
    if (subtotal5) subtotal5.textContent = contadores[5];

    // Actualizar total
    if (totalConcepto) totalConcepto.textContent = totalGeneral;
    if (bolTotalConcep) bolTotalConcep.value = totalGeneral;

    // Actualizar resumen
    const totalSalud = parseInt(totalSaludConducta?.value || 0);
    const totalCompleto = totalSalud + totalGeneral;
    actualizarResumen(totalSalud, totalGeneral, totalCompleto);

    console.log('✅ Totales calculados:', contadores, 'Total:', totalGeneral);
}

/**
 * Función para actualizar el resumen visual
 */
const actualizarResumen = (saludConducta, conceptualizacion, totalCompleto) => {
    if (resumenSaludConducta) {
        resumenSaludConducta.textContent = saludConducta || '--';
    }
    
    if (resumenConceptualizacion) {
        resumenConceptualizacion.textContent = conceptualizacion || '--';
    }
    
    if (resumenTotal) {
        resumenTotal.textContent = totalCompleto || '--';
    }
    
    // Calcular y mostrar categoría
    if (resumenCategoria && totalCompleto > 0) {
        const categoria = calcularCategoria(totalCompleto);
        resumenCategoria.textContent = categoria.texto;
        resumenCategoria.style.color = categoria.color;
    }
}

/**
 * Función para validar que todos los aspectos estén respondidos
 */
const validarConceptualizacion = () => {
    const aspectosVacios = [];
    
    for (let i = 1; i <= 15; i++) {
        const aspectoSeleccionado = document.querySelector(`input[name="aspecto_${i}"]:checked`);
        if (!aspectoSeleccionado) {
            aspectosVacios.push(i);
        }
    }
    
    return {
        valido: aspectosVacios.length === 0,
        aspectosVacios: aspectosVacios
    };
}


// FUNCIONES PRINCIPALES


/**
 * Función para guardar solo la conceptualización
 */
const guardarConceptualizacion = async (event) => {
    event.preventDefault();
    BtnGuardarConceptualizacion.disabled = true;
    
    // Validar conceptualización
    const validacion = validarConceptualizacion();
    if (!validacion.valido) {
        await Swal.fire({
            position: "center",
            icon: "warning",
            title: "FORMULARIO INCOMPLETO",
            text: `Debe responder todas las preguntas de conceptualización. Faltan los aspectos: ${validacion.aspectosVacios.join(', ')}`,
            showConfirmButton: true,
        });
        BtnGuardarConceptualizacion.disabled = false;
        return;
    }

    // Confirmar guardado
    const confirmacion = await Swal.fire({
        position: "center",
        icon: "question",
        title: "¿Guardar conceptualización?",
        text: "Se guardará solo la conceptualización de esta página",
        showConfirmButton: true,
        confirmButtonText: 'Sí, Guardar',
        confirmButtonColor: '#f59e0b',
        cancelButtonText: 'Cancelar',
        showCancelButton: true
    });

    if (!confirmacion.isConfirmed) {
        BtnGuardarConceptualizacion.disabled = false;
        return;
    }

    const body = new FormData(FormConceptualizacion);
    const url = '/evaluacion_desempe-o/API/evaluacion/guardarConceptualizacion';
    const config = { method: 'POST', body }

    try {
        const respuesta = await fetch(url, config);
        const datos = await respuesta.json();
        const { codigo, mensaje } = datos;

        if (codigo === 1) {
            datosConceptualizacionGuardados = true;
            await Swal.fire({
                position: "center",
                icon: "success",
                title: "¡Éxito!",
                text: mensaje,
                showConfirmButton: true,
            });
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
        console.error('Error al guardar conceptualización:', error);
        await Swal.fire({
            position: "center",
            icon: "error",
            title: "Error de conexión",
            text: "No se pudo guardar la conceptualización",
            showConfirmButton: true,
        });
    }

    BtnGuardarConceptualizacion.disabled = false;
}

/**
 * Función para finalizar y guardar evaluación completa
 */
const finalizarEvaluacionCompleta = async () => {
    BtnGuardarCompleto.disabled = true;
    
    // Validar conceptualización
    const validacion = validarConceptualizacion();
    if (!validacion.valido) {
        await Swal.fire({
            position: "center",
            icon: "warning",
            title: "CONCEPTUALIZACIÓN INCOMPLETA",
            text: `Debe completar todos los aspectos antes de finalizar. Faltan los aspectos: ${validacion.aspectosVacios.join(', ')}`,
            showConfirmButton: true,
        });
        BtnGuardarCompleto.disabled = false;
        return;
    }

    // Verificar que haya datos de página 1
    if (!bolCatEvaluadorP2.value) {
        await Swal.fire({
            position: "center",
            icon: "warning",
            title: "DATOS INCOMPLETOS",
            text: "No se encontraron datos del evaluador. Debe completar la página 1 primero.",
            showConfirmButton: true,
        });
        BtnGuardarCompleto.disabled = false;
        return;
    }

    // Mostrar resumen antes de finalizar
    const totalSalud = parseInt(totalSaludConducta?.value || 0);
    const totalConceptualizacionValor = parseInt(bolTotalConcep?.value || 0);
    const totalGeneral = totalSalud + totalConceptualizacionValor;
    const categoria = calcularCategoria(totalGeneral);

    const confirmacion = await Swal.fire({
        position: "center",
        icon: "question",
        title: "¿Finalizar Evaluación Completa?",
        html: `
            <div style="text-align: left; margin: 1rem 0;">
                <p><strong>Resumen de la Evaluación:</strong></p>
                <p>• Salud y Conducta: <strong>${totalSalud} puntos</strong></p>
                <p>• Conceptualización: <strong>${totalConceptualizacionValor} puntos</strong></p>
                <p>• <strong>TOTAL GENERAL: ${totalGeneral} puntos</strong></p>
                <p>• Categoría: <strong style="color: ${categoria.color}">${categoria.texto}</strong></p>
            </div>
            <p>Una vez finalizada, la evaluación estará completa.</p>
        `,
        showConfirmButton: true,
        confirmButtonText: 'Sí, Finalizar Evaluación',
        confirmButtonColor: '#10b981',
        cancelButtonText: 'Cancelar',
        showCancelButton: true,
        width: '600px'
    });

    if (!confirmacion.isConfirmed) {
        BtnGuardarCompleto.disabled = false;
        return;
    }

    // Preparar todos los datos del formulario
    const body = new FormData(FormConceptualizacion);
    
    // Agregar datos adicionales necesarios
    body.append('bol_total_salud', totalSalud);
    body.append('bol_total', totalGeneral);

    const url = '/evaluacion_desempe-o/API/evaluacion/guardarCompleta';
    const config = { method: 'POST', body }

    try {
        const respuesta = await fetch(url, config);
        const datos = await respuesta.json();
        const { codigo, mensaje, totales } = datos;

        if (codigo === 1) {
            await Swal.fire({
                position: "center",
                icon: "success",
                title: "¡Evaluación Completada!",
                html: `
                    <div style="text-align: center; margin: 1rem 0;">
                        <p><strong>${mensaje}</strong></p>
                        ${totales ? `
                        <div style="background: #f0f9ff; padding: 1rem; border-radius: 8px; margin: 1rem 0;">
                            <p>Salud y Conducta: <strong>${totales.salud_conducta} pts</strong></p>
                            <p>Conceptualización: <strong>${totales.conceptualizacion} pts</strong></p>
                            <p><strong>TOTAL: ${totales.total_general} puntos</strong></p>
                        </div>
                        ` : ''}
                    </div>
                `,
                showConfirmButton: true,
                confirmButtonText: 'Ir al Listado Principal'
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
        console.error('Error al finalizar evaluación:', error);
        await Swal.fire({
            position: "center",
            icon: "error",
            title: "Error de conexión",
            text: "No se pudo finalizar la evaluación. Intente nuevamente.",
            showConfirmButton: true,
        });
    }

    BtnGuardarCompleto.disabled = false;
}

/**
 * Función para volver a página 1
 */
const volverAPagina1 = () => {
    const confirmacion = window.confirm('¿Está seguro de volver a la página 1? Los datos no guardados se perderán.');
    
    if (confirmacion) {
        window.location.href = `/evaluacion_desempe-o/evaluacion/pagina1?catalogo=${catalogoEvaluado}`;
    }
}


// INICIALIZACIÓN


/**
 * Función principal de inicialización
 */
const inicializarPagina2 = async () => {
    console.log('🚀 Inicializando Página 2...');
    
    // Cargar información básica
    await cargarInformacionBasica();
    
    // Intentar cargar datos existentes de evaluación
    await cargarDatosEvaluacionExistente();
    
    // Configurar event listeners para aspectos
    for (let i = 1; i <= 15; i++) {
        const radioButtons = document.querySelectorAll(`input[name="aspecto_${i}"]`);
        radioButtons.forEach(radio => {
            radio.addEventListener('change', calcularTotales);
        });
    }

    console.log('✅ Página 2 inicializada correctamente');
}


// EVENT LISTENERS


document.addEventListener('DOMContentLoaded', function() {
    inicializarPagina2();
    
    console.log('✅ JavaScript de página 2 (conceptualización) cargado correctamente');
});

// Event listeners para botones
if (FormConceptualizacion) {
    FormConceptualizacion.addEventListener('submit', guardarConceptualizacion);
}

if (BtnGuardarCompleto) {
    BtnGuardarCompleto.addEventListener('click', finalizarEvaluacionCompleta);
}

if (BtnVolverPagina1) {
    BtnVolverPagina1.addEventListener('click', volverAPagina1);
}