import Swal from "sweetalert2";

// ELEMENTOS DEL DOM
const FormConceptualizacion = document.getElementById('FormConceptualizacion');
const BtnVolverPaginaAnterior = document.getElementById('BtnVolverPaginaAnterior');
const BtnCalcularTotal = document.getElementById('BtnCalcularTotal');
const BtnContinuar = document.getElementById('BtnContinuar');

// Contenedores
const preguntasContainer = document.getElementById('preguntas-container');
const loadingPreguntas = document.getElementById('loading_preguntas');
const errorPreguntas = document.getElementById('error_preguntas');
const mensajeErrorPreguntas = document.getElementById('mensaje_error_preguntas');

// Campos ocultos y totales
const catalogoEvaluado = document.getElementById('catalogo_evaluado');
const proyeccionSerie = document.getElementById('proyeccion_serie');
const bolTotalConcep = document.getElementById('bol_total_concep');
const tipoDescripcion = document.getElementById('tipo_descripcion');
const subtotalConceptualizacion = document.getElementById('subtotal_conceptualizacion');
const totalConceptualizacion = document.getElementById('total_conceptualizacion');

// Variables globales
let preguntasData = [];
let respuestasActuales = {};

// FUNCIÓN PARA OBTENER EL CATÁLOGO DE LA URL
const obtenerCatalogoDeURL = () => {
    const urlParams = new URLSearchParams(window.location.search);
    return urlParams.get('catalogo');
}

// CARGAR PREGUNTAS DE CONCEPTUALIZACIÓN
const CargarPreguntasConceptualizacion = async () => {
    const catalogo = obtenerCatalogoDeURL();
    
    if (!catalogo) {
        mostrarError('No se especificó el catálogo del evaluado en la URL');
        return;
    }

    // Mostrar loading
    mostrarLoading(true);
    ocultarError();

    const url = `/evaluacion_desempe-o/API/evaluacionformulario/obtenerPreguntasConceptualizacion?catalogo=${catalogo}`;
    const config = { method: 'GET' }

    try {
        const respuesta = await fetch(url, config);
        const datos = await respuesta.json();
        const { codigo, mensaje, data } = datos;

        if (codigo === 1) {
            // Guardar datos
            preguntasData = data.preguntas;
            catalogoEvaluado.value = catalogo;
            proyeccionSerie.value = data.proyeccion;
            tipoDescripcion.textContent = data.tipo_descripcion;

            // Renderizar preguntas
            renderizarPreguntas();
            mostrarLoading(false);

            console.log('Preguntas cargadas:', data);
        } else {
            mostrarError(mensaje || 'Error al cargar las preguntas');
            mostrarLoading(false);
        }

    } catch (error) {
        console.log(error);
        mostrarError('Error de conexión al cargar las preguntas');
        mostrarLoading(false);
    }
}

// RENDERIZAR LAS PREGUNTAS DINÁMICAMENTE
const renderizarPreguntas = () => {
    if (!preguntasData || preguntasData.length === 0) {
        mostrarError('No se encontraron preguntas para esta serie');
        return;
    }

    let htmlPreguntas = '';

    preguntasData.forEach((pregunta, index) => {
        const numeroPregunta = index + 1;
        
        htmlPreguntas += `
            <div class="pregunta-item" data-pregunta="${pregunta.pre_codigo}">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <div class="d-flex align-items-start">
                            <div class="pregunta-numero">${numeroPregunta}</div>
                            <div class="pregunta-texto">${pregunta.pre_descripcion}</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="opciones-respuesta">
                            <div class="opcion-radio-item insatisfactorio" data-valor="1">
                                <input type="radio" 
                                       class="radio-conceptualizacion" 
                                       name="pregunta_${pregunta.pre_codigo}" 
                                       value="1" 
                                       id="pregunta_${pregunta.pre_codigo}_1"
                                       data-pregunta-codigo="${pregunta.pre_codigo}">
                                <label class="radio-label" for="pregunta_${pregunta.pre_codigo}_1">1</label>
                            </div>
                            <div class="opcion-radio-item intermedio" data-valor="2">
                                <input type="radio" 
                                       class="radio-conceptualizacion" 
                                       name="pregunta_${pregunta.pre_codigo}" 
                                       value="2" 
                                       id="pregunta_${pregunta.pre_codigo}_2"
                                       data-pregunta-codigo="${pregunta.pre_codigo}">
                                <label class="radio-label" for="pregunta_${pregunta.pre_codigo}_2">2</label>
                            </div>
                            <div class="opcion-radio-item intermedio" data-valor="3">
                                <input type="radio" 
                                       class="radio-conceptualizacion" 
                                       name="pregunta_${pregunta.pre_codigo}" 
                                       value="3" 
                                       id="pregunta_${pregunta.pre_codigo}_3"
                                       data-pregunta-codigo="${pregunta.pre_codigo}">
                                <label class="radio-label" for="pregunta_${pregunta.pre_codigo}_3">3</label>
                            </div>
                            <div class="opcion-radio-item intermedio" data-valor="4">
                                <input type="radio" 
                                       class="radio-conceptualizacion" 
                                       name="pregunta_${pregunta.pre_codigo}" 
                                       value="4" 
                                       id="pregunta_${pregunta.pre_codigo}_4"
                                       data-pregunta-codigo="${pregunta.pre_codigo}">
                                <label class="radio-label" for="pregunta_${pregunta.pre_codigo}_4">4</label>
                            </div>
                            <div class="opcion-radio-item optimo" data-valor="5">
                                <input type="radio" 
                                       class="radio-conceptualizacion" 
                                       name="pregunta_${pregunta.pre_codigo}" 
                                       value="5" 
                                       id="pregunta_${pregunta.pre_codigo}_5"
                                       data-pregunta-codigo="${pregunta.pre_codigo}">
                                <label class="radio-label" for="pregunta_${pregunta.pre_codigo}_5">5</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;
    });

    // Agregar barra de progreso
    htmlPreguntas = `
        <div class="progreso-conceptualizacion mb-4">
            <div class="progreso-barra" id="progreso-barra"></div>
        </div>
        ${htmlPreguntas}
    `;

    preguntasContainer.innerHTML = htmlPreguntas;

    // Agregar event listeners a los radio buttons
    const radiosConceptualizacion = document.querySelectorAll('.radio-conceptualizacion');
    radiosConceptualizacion.forEach(radio => {
        radio.addEventListener('change', manejarCambioRespuesta);
    });

    // Calcular total inicial
    calcularTotalConceptualizacion();

}



// MANEJAR CAMBIO EN LAS RESPUESTAS
const manejarCambioRespuesta = (event) => {
    const radio = event.target;
    const preguntaCodigo = radio.dataset.preguntaCodigo;
    const valor = parseInt(radio.value);

    // Guardar respuesta
    respuestasActuales[preguntaCodigo] = valor;

    // Marcar pregunta como completada
    const preguntaItem = radio.closest('.pregunta-item');
    preguntaItem.classList.add('completada');

    // Actualizar progreso
    actualizarProgreso();

    // Recalcular total
    calcularTotalConceptualizacion();
}

// ACTUALIZAR PROGRESO VISUAL
const actualizarProgreso = () => {
    const totalPreguntas = preguntasData.length;
    const preguntasRespondidas = Object.keys(respuestasActuales).length;
    const porcentaje = (preguntasRespondidas / totalPreguntas) * 100;

    const progresoBarra = document.getElementById('progreso-barra');
    if (progresoBarra) {
        progresoBarra.style.width = `${porcentaje}%`;
    }
}

// CALCULAR TOTAL DE CONCEPTUALIZACIÓN
const calcularTotalConceptualizacion = () => {
    let subtotal = 0;

    // Sumar todas las respuestas
    Object.values(respuestasActuales).forEach(valor => {
        subtotal += valor;
    });

    // El total es igual al subtotal en esta sección
    const total = subtotal;

    // Actualizar displays
    if (subtotalConceptualizacion) subtotalConceptualizacion.textContent = subtotal;
    if (totalConceptualizacion) totalConceptualizacion.textContent = total;
    if (bolTotalConcep) bolTotalConcep.value = total;

    // Leer total de Salud y Conducta desde sessionStorage
const totalSaludConducta = parseInt(sessionStorage.getItem('totalSaludConducta')) || 0;
const totalGeneral = totalSaludConducta + total;

console.log('Total Salud y Conducta (desde sesión):', totalSaludConducta);
console.log('Total Conceptualización:', total);
console.log('TOTAL GENERAL:', totalGeneral);
// Actualizar Sección V - Categoría
actualizarSeccionCategoria(totalSaludConducta, total, totalGeneral);
}

// VALIDAR FORMULARIO COMPLETO
const validarFormularioCompleto = () => {
    const totalPreguntas = preguntasData.length;
    const preguntasRespondidas = Object.keys(respuestasActuales).length;

    if (preguntasRespondidas < totalPreguntas) {
        const faltantes = totalPreguntas - preguntasRespondidas;
        Swal.fire({
            position: "center",
            icon: "warning",
            title: "Formulario Incompleto",
            text: `Faltan ${faltantes} preguntas por responder`,
            showConfirmButton: true,
        });
        return false;
    }

    return true;
}

// MOSTRAR/OCULTAR ESTADOS
const mostrarLoading = (mostrar) => {
    if (loadingPreguntas) {
        loadingPreguntas.style.display = mostrar ? 'block' : 'none';
    }
}

const mostrarError = (mensaje) => {
    if (errorPreguntas && mensajeErrorPreguntas) {
        mensajeErrorPreguntas.textContent = mensaje;
        errorPreguntas.classList.remove('d-none');
    }
}

const ocultarError = () => {
    if (errorPreguntas) {
        errorPreguntas.classList.add('d-none');
    }
}

// NAVEGACIÓN
const VolverPaginaAnterior = () => {
    const catalogo = obtenerCatalogoDeURL();
    if (catalogo) {
        window.location.href = `/evaluacion_desempe-o/ingresar-datos?catalogo=${catalogo}`;
    } else {
        window.location.href = `/evaluacion_desempe-o/evaluacionespecialistas`;
    }
}

const ContinuarSiguientePagina = () => {
    if (validarFormularioCompleto()) {
        Swal.fire({
            position: "center",
            icon: "success",
            title: "Sección Completada",
            text: `Total de conceptualización: ${totalConceptualizacion.textContent} puntos`,
            showConfirmButton: true,
        }).then(() => {
            // Aquí continuaría a la siguiente sección
            console.log('Continuar a siguiente página...');
        });
    }
}

// CALCULAR TOTAL MANUAL (botón)
const calcularTotalManual = () => {
    calcularTotalConceptualizacion();
    
    const total = parseInt(totalConceptualizacion.textContent);
    const totalPreguntas = preguntasData.length;
    const maxPuntos = totalPreguntas * 5;
    const porcentaje = ((total / maxPuntos) * 100).toFixed(1);

    Swal.fire({
        position: "center",
        icon: "info",
        title: "Total Actualizado",
        html: `
            <strong>Subtotal:</strong> ${subtotalConceptualizacion.textContent} puntos<br>
            <strong>Total:</strong> ${total} puntos<br>
            <strong>Porcentaje:</strong> ${porcentaje}%<br>
            <small>Máximo posible: ${maxPuntos} puntos</small>
        `,
        showConfirmButton: true,
    });
}

// INICIALIZACIÓN
document.addEventListener('DOMContentLoaded', () => {
    CargarPreguntasConceptualizacion();
});





// FUNCIÓN PARA ACTUALIZAR SECCIÓN V - CATEGORÍA
const actualizarSeccionCategoria = (totalSalud, totalConceptualizacion, totalFinal) => {
    // Actualizar displays
    const elemSalud = document.getElementById('mostrar_total_salud');
    const elemConceptualizacion = document.getElementById('mostrar_total_conceptualizacion');
    const elemTotalFinal = document.getElementById('mostrar_total_final');
    const elemCategoria = document.getElementById('badge_categoria');
    const elemTotalHidden = document.getElementById('total_final_evaluacion');
    
    if (elemSalud) elemSalud.textContent = totalSalud;
    if (elemConceptualizacion) elemConceptualizacion.textContent = totalConceptualizacion;
    if (elemTotalFinal) elemTotalFinal.textContent = totalFinal;
    if (elemTotalHidden) elemTotalHidden.value = totalFinal;
    
    // Calcular categoría según rangos
    let categoria = '';
    let claseCSS = '';
    
    if (totalFinal >= 85) {
        categoria = 'EXCELENTE';
        claseCSS = 'bg-success';
    } else if (totalFinal >= 70) {
        categoria = 'MUY BUENO';
        claseCSS = 'bg-primary';
    } else if (totalFinal >= 55) {
        categoria = 'REGULAR';
        claseCSS = 'bg-warning';
    } else {
        categoria = 'INSATISFACTORIO';
        claseCSS = 'bg-danger';
    }
    
    if (elemCategoria) {
        elemCategoria.textContent = categoria;
        elemCategoria.className = `badge badge-categoria ${claseCSS} text-white`;
    }
    
    console.log(`Categoría asignada: ${categoria} (${totalFinal}/100 puntos)`);
}


// EVENT LISTENERS
if (BtnVolverPaginaAnterior) {
    BtnVolverPaginaAnterior.addEventListener('click', VolverPaginaAnterior);
}

if (BtnCalcularTotal) {
    BtnCalcularTotal.addEventListener('click', calcularTotalManual);
}

if (BtnContinuar) {
    BtnContinuar.addEventListener('click', ContinuarSiguientePagina);
}