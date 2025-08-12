import { Dropdown } from "bootstrap";
import { validarFormulario } from "../funciones";
import Swal from "sweetalert2";

// ELEMENTOS DEL DOM
const FormConceptualizacion = document.getElementById("FormConceptualizacion");
const BtnVolverPaginaAnterior = document.getElementById(
  "BtnVolverPaginaAnterior"
);
const BtnCalcularTotal = document.getElementById("BtnCalcularTotal");
const BtnContinuar = document.getElementById("BtnContinuar");

// Contenedores
const preguntasContainer = document.getElementById("preguntas-container");
const loadingPreguntas = document.getElementById("loading_preguntas");
const errorPreguntas = document.getElementById("error_preguntas");
const mensajeErrorPreguntas = document.getElementById(
  "mensaje_error_preguntas"
);

// Campos ocultos y totales
const catalogoEvaluado = document.getElementById("catalogo_evaluado");
const proyeccionSerie = document.getElementById("proyeccion_serie");
const bolTotalConcep = document.getElementById("bol_total_concep");
const tipoDescripcion = document.getElementById("tipo_descripcion");
const subtotalConceptualizacion = document.getElementById(
  "subtotal_conceptualizacion"
);
const totalConceptualizacion = document.getElementById(
  "total_conceptualizacion"
);

// Variables globales
let preguntasData = [];
let respuestasActuales = {};

// ELEMENTOS DEL DOM PARA SECCIONES VI, VII Y VIII
const accionMotivadora = document.getElementById("accion_motivadora");
const accionCorrectiva = document.getElementById("accion_correctiva");
const observaciones = document.getElementById("observaciones");
const bolAccionMot = document.getElementById("bol_accion_mot");
const bolAccionCorrec = document.getElementById("bol_accion_correc");
const bolObs = document.getElementById("bol_obs");

// FUNCIÓN PARA OBTENER EL CATÁLOGO DE LA URL
const obtenerCatalogoDeURL = () => {
  const urlParams = new URLSearchParams(location.search);
  return urlParams.get("catalogo");
};

// CARGAR PREGUNTAS DE CONCEPTUALIZACIÓN
const CargarPreguntasConceptualizacion = async () => {
  const catalogo = obtenerCatalogoDeURL();

  mostrarErrorSinCatalogo();

  // Mostrar loading
  mostrarLoading();
  ocultarError();

  const url = `/evaluacion_desempeno/API/evaluacionformulario/obtenerPreguntasConceptualizacion?catalogo=${catalogo}`;
  const config = { method: "GET" };

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
      ocultarLoading();


    } else {
      mostrarErrorGeneral();
      ocultarLoading();
    }
  } catch (error) {
    console.log(error);
    mostrarErrorConexion();
    ocultarLoading();
  }
};

// RENDERIZAR LAS PREGUNTAS DINÁMICAMENTE
const renderizarPreguntas = () => {
  if (!preguntasData || preguntasData.length === 0) {
    mostrarErrorSinPreguntas();
    return;
  }

  let htmlPreguntas = "";

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
  const radiosConceptualizacion = document.querySelectorAll(
    ".radio-conceptualizacion"
  );
  radiosConceptualizacion.forEach((radio) => {
    radio.addEventListener("change", manejarCambioRespuesta);
  });

  // Calcular total inicial
  calcularTotalConceptualizacion();
};

// MANEJAR CAMBIO EN LAS RESPUESTAS
const manejarCambioRespuesta = (event) => {
  const radio = event.target;
  const preguntaCodigo = radio.dataset.preguntaCodigo;
  const valor = parseInt(radio.value);

  // Guardar respuesta
  respuestasActuales[preguntaCodigo] = valor;

  // Marcar pregunta como completada
  const preguntaItem = radio.closest(".pregunta-item");
  preguntaItem.classList.add("completada");

  // Actualizar progreso
  actualizarProgreso();

  // Recalcular total
  calcularTotalConceptualizacion();
};

// ACTUALIZAR PROGRESO VISUAL
const actualizarProgreso = () => {
  const totalPreguntas = preguntasData.length;
  const preguntasRespondidas = Object.keys(respuestasActuales).length;
  const porcentaje = (preguntasRespondidas / totalPreguntas) * 100;

  const progresoBarra = document.getElementById("progreso-barra");
  if (progresoBarra) {
    progresoBarra.style.width = `${porcentaje}%`;
  }
};

// CALCULAR TOTAL DE CONCEPTUALIZACIÓN
const calcularTotalConceptualizacion = () => {
  let subtotal = 0;

  // Sumar todas las respuestas
  Object.values(respuestasActuales).forEach((valor) => {
    subtotal += valor;
  });

  // El total es igual al subtotal en esta sección
  const total = subtotal;

  // Actualizar displays
  if (subtotalConceptualizacion)
    subtotalConceptualizacion.textContent = subtotal;
  if (totalConceptualizacion) totalConceptualizacion.textContent = total;
  if (bolTotalConcep) bolTotalConcep.value = total;

  // Leer total de Salud y Conducta desde sessionStorage
  const totalSaludConducta =
    parseInt(sessionStorage.getItem("totalSaludConducta")) || 0;
  const totalGeneral = totalSaludConducta + total;

  // Actualizar Sección V - Categoría
  actualizarSeccionCategoria(totalSaludConducta, total, totalGeneral);
};

// MOSTRAR/OCULTAR ESTADOS
const mostrarLoading = () => {
  loadingPreguntas.style.display = "block";
};

const ocultarLoading = () => {
  loadingPreguntas.style.display = "none";
};

const mostrarErrorSinCatalogo = () => {
  mensajeErrorPreguntas.textContent =
    "No se especificó el catálogo del evaluado en la URL";
  errorPreguntas.classList.remove("d-none");
};

const mostrarErrorConexion = () => {
  mensajeErrorPreguntas.textContent =
    "Error de conexión al cargar las preguntas";
  errorPreguntas.classList.remove("d-none");
};

const mostrarErrorSinPreguntas = () => {
  mensajeErrorPreguntas.textContent =
    "No se encontraron preguntas para esta serie";
  errorPreguntas.classList.remove("d-none");
};

const mostrarErrorGeneral = () => {
  mensajeErrorPreguntas.textContent = "Error al cargar las preguntas";
  errorPreguntas.classList.remove("d-none");
};

const ocultarError = () => {
  errorPreguntas.classList.add("d-none");
};

// NAVEGACIÓN
const VolverPaginaAnterior = () => {
  const catalogo = obtenerCatalogoDeURL();
  if (catalogo) {
    location.href = `/evaluacion_desempeno/ingresar-datos?catalogo=${catalogo}`;
  } else {
    location.href = `/evaluacion_desempeno/evaluacionespecialistas`;
  }
};

const ContinuarSiguientePagina = () => {
  if (
    validarFormulario(FormConceptualizacion, [
      "accion_motivadora",
      "accion_correctiva",
      "observaciones",
    ])
  ) {
    Swal.fire({
      position: "center",
      icon: "success",
      title: "Sección Completada",
      text: `Total de conceptualización: ${totalConceptualizacion.textContent} puntos`,
      showConfirmButton: true,
    }).then(() => {

    });
  }
};

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
};

// CARGAR ACCIONES MOTIVADORAS
const cargarAccionesMotivadoras = async () => {
  try {
    const url =
      "/evaluacion_desempeno/API/evaluacionformulario/obtenerAccionesMotivadoras";
    const respuesta = await fetch(url, { method: "GET" });
    const datos = await respuesta.json();

    if (datos.codigo === 1 && datos.data.length > 0) {
      // Limpiar select
      accionMotivadora.innerHTML =
        '<option value="">Seleccione una acción motivadora</option>';

      // Agregar opciones
      datos.data.forEach((accion) => {
        const option = document.createElement("option");
        option.value = accion.mot_codigo;
        option.textContent = accion.mot_descripcion;
        accionMotivadora.appendChild(option);
      });
    } else {
      console.log("No se encontraron acciones motivadoras");
    }
  } catch (error) {
    console.error("Error al cargar acciones motivadoras:", error);
  }
};

// CARGAR ACCIONES CORRECTIVAS
const cargarAccionesCorrectivas = async () => {
  try {
    const url =
      "/evaluacion_desempeno/API/evaluacionformulario/obtenerAccionesCorrectivas";
    const respuesta = await fetch(url, { method: "GET" });
    const datos = await respuesta.json();

    if (datos.codigo === 1 && datos.data.length > 0) {
      // Limpiar select
      accionCorrectiva.innerHTML =
        '<option value="">-- Seleccione una acción correctiva --</option>';

      // Agregar opciones
      datos.data.forEach((accion) => {
        const option = document.createElement("option");
        option.value = accion.corr_codigo;
        option.textContent = accion.corr_descripcion;
        accionCorrectiva.appendChild(option);
      });
    } else {
      console.log("No se encontraron acciones correctivas");
    }
  } catch (error) {
    console.error("Error al cargar acciones correctivas:", error);
  }
};


// CARGAR OFICIALES DE VALIDACIÓN
const cargarOficialesValidacion = async () => {
  try {
    const url = "/evaluacion_desempeno/API/evaluacionformulario/obtenerOficialesValidacion?dependencia=10030";
    const respuesta = await fetch(url, { method: "GET" });
    const datos = await respuesta.json();

    if (datos.codigo === 1) {
      const { oficial_personal, comandante } = datos.data;
      
      // Mostrar datos del Oficial de Personal
      if (oficial_personal) {
        const oficialesPersonalContainer = document.getElementById("oficial_personal_container");
        if (oficialesPersonalContainer) {
          oficialesPersonalContainer.innerHTML = `
            <div class="text-center">
              <strong>${oficial_personal.nombre_completo}</strong><br>
              <span>${oficial_personal.arma}</span>
            </div>
          `;
        }
      }

      // Mostrar datos del Comandante
      if (comandante) {
        const comandanteContainer = document.getElementById("comandante_container");
        if (comandanteContainer) {
          comandanteContainer.innerHTML = `
            <div class="text-center">
              <strong>${comandante.nombre_completo}</strong><br>
              <span>${comandante.arma}</span>
            </div>
          `;
        }
      }

      console.log("Oficiales de validación cargados correctamente");
    } else {
      console.log("No se encontraron oficiales de validación");
    }
  } catch (error) {
    console.error("Error al cargar oficiales de validación:", error);
  }
};


// MOSTRAR DATOS DE VALIDACIÓN DEL EVALUADO Y EVALUADOR  
const mostrarDatosValidacion = () => {
    // Intentar obtener datos del evaluado desde sessionStorage (página 1)
    const datosEvaluado = sessionStorage.getItem('datosEvaluado');
    const datosEvaluador = sessionStorage.getItem('datosEvaluador');
    
    // Mostrar datos del evaluado si están disponibles
    if (datosEvaluado) {
        try {
            const evaluado = JSON.parse(datosEvaluado);
            const nombreCompleto = `${evaluado.per_nom1 || ''} ${evaluado.per_nom2 || ''} ${evaluado.per_ape1 || ''} ${evaluado.per_ape2 || ''}`.trim();
            
            const evaluadoContainer = document.getElementById("evaluado_nombre_validacion");
            if (evaluadoContainer) {
                evaluadoContainer.innerHTML = `
                    <div class="text-center">
                        <strong>${nombreCompleto}</strong><br>
                        <span>${evaluado.grado || ''}</span>
                    </div>
                `;
            }
        } catch (error) {
            console.error("Error al parsear datos del evaluado:", error);
        }
    } else {
        // Si no hay datos en sessionStorage, cargar desde la URL
        const catalogoEvaluado = new URLSearchParams(location.search).get("catalogo");
        if (catalogoEvaluado) {
            cargarDatosEvaluadoValidacion(catalogoEvaluado);
        }
    }
    
    // Mostrar datos del evaluador si están disponibles
    if (datosEvaluador) {
        try {
            const evaluador = JSON.parse(datosEvaluador);
            const nombreCompleto = `${evaluador.per_nom1 || ''} ${evaluador.per_nom2 || ''} ${evaluador.per_ape1 || ''} ${evaluador.per_ape2 || ''}`.trim();
            
            const evaluadorContainer = document.getElementById("evaluador_nombre_validacion");
            if (evaluadorContainer) {
                evaluadorContainer.innerHTML = `
                    <div class="text-center">
                        <strong>${nombreCompleto}</strong><br>
                        <span>${evaluador.grado || ''}</span>
                    </div>
                `;
            }
        } catch (error) {
            console.error("Error al parsear datos del evaluador:", error);
        }
    } else {
        // Placeholder si no hay datos del evaluador
        const evaluadorContainer = document.getElementById("evaluador_nombre_validacion");
        if (evaluadorContainer) {
            evaluadorContainer.innerHTML = `
                <div class="text-center text-muted">
                    <small>Se completará con datos del evaluador</small>
                </div>
            `;
        }
    }
};

// CARGAR DATOS DEL EVALUADO PARA VALIDACIÓN
const cargarDatosEvaluadoValidacion = async (catalogo) => {
    try {
        const url = `/evaluacion_desempeno/API/evaluacionformulario/obtenerDatosEvaluado?catalogo=${catalogo}`;
        const respuesta = await fetch(url, { method: "GET" });
        const datos = await respuesta.json();

        if (datos.codigo === 1) {
            const evaluado = datos.data;
            const nombreCompleto = `${evaluado.per_nom1 || ''} ${evaluado.per_nom2 || ''} ${evaluado.per_ape1 || ''} ${evaluado.per_ape2 || ''}`.trim();
            
            const evaluadoContainer = document.getElementById("evaluado_nombre_validacion");
            if (evaluadoContainer) {
                evaluadoContainer.innerHTML = `
                    <div class="text-center">
                        <strong>${nombreCompleto}</strong><br>
                        <span>${evaluado.grado || ''}</span>
                    </div>
                `;
            }
        }
    } catch (error) {
        console.error("Error al cargar datos del evaluado para validación:", error);
    }
};


// FUNCIÓN PARA ACTUALIZAR SECCIÓN V - CATEGORÍA
const actualizarSeccionCategoria = (
  totalSalud,
  totalConceptualizacion,
  totalFinal
) => {
  // Actualizar displays
  const elemSalud = document.getElementById("mostrar_total_salud");
  const elemConceptualizacion = document.getElementById(
    "mostrar_total_conceptualizacion"
  );
  const elemTotalFinal = document.getElementById("mostrar_total_final");
  const elemCategoria = document.getElementById("badge_categoria");
  const elemTotalHidden = document.getElementById("total_final_evaluacion");

  if (elemSalud) elemSalud.textContent = totalSalud;
  if (elemConceptualizacion)
    elemConceptualizacion.textContent = totalConceptualizacion;
  if (elemTotalFinal) elemTotalFinal.textContent = totalFinal;
  if (elemTotalHidden) elemTotalHidden.value = totalFinal;

  // Calcular categoría según rangos
  let categoria = "";
  let claseCSS = "";

  if (totalFinal >= 85) {
    categoria = "EXCELENTE";
    claseCSS = "bg-success";
  } else if (totalFinal >= 70) {
    categoria = "MUY BUENO";
    claseCSS = "bg-primary";
  } else if (totalFinal >= 55) {
    categoria = "REGULAR";
    claseCSS = "bg-warning";
  } else {
    categoria = "INSATISFACTORIO";
    claseCSS = "bg-danger";
  }

  if (elemCategoria) {
    elemCategoria.textContent = categoria;
    elemCategoria.className = `badge badge-categoria ${claseCSS} text-white`;
  }

};

// FUNCIONES PARA FORMULARIOS
const manejarAccionMotivadora = () => {
    bolAccionMot.value = accionMotivadora.value || '';
};

const manejarAccionCorrectiva = () => {
    bolAccionCorrec.value = accionCorrectiva.value || '';
};

const manejarObservaciones = () => {
    bolObs.value = observaciones.value || '';
};



// INICIALIZACIÓN
CargarPreguntasConceptualizacion();
cargarAccionesMotivadoras();
cargarAccionesCorrectivas();
cargarOficialesValidacion();
mostrarDatosValidacion();

// EVENT LISTENERS
accionMotivadora.addEventListener('change', manejarAccionMotivadora);
accionCorrectiva.addEventListener('change', manejarAccionCorrectiva);
observaciones.addEventListener('input', manejarObservaciones);
BtnVolverPaginaAnterior.addEventListener('click', VolverPaginaAnterior);
BtnCalcularTotal.addEventListener('click', calcularTotalManual);
BtnContinuar.addEventListener('click', ContinuarSiguientePagina);



