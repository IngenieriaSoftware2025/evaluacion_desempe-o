import Swal from "sweetalert2";
import { Dropdown } from "bootstrap";
import { validarFormulario } from "../funciones";
import DataTable from "datatables.net-bs5";

// ELEMENTOS DEL DOM
const FormEvaluacion = document.getElementById("FormEvaluacion");
const BtnVolverListado = document.getElementById("BtnVolverListado");
const BtnPaginaSiguiente = document.getElementById("BtnPaginaSiguiente");

// Campos del evaluado (readonly)
const evaluadoCatalogo = document.getElementById("evaluado_catalogo");
const evaluadoGrado = document.getElementById("evaluado_grado");
const evaluadoNom1 = document.getElementById("evaluado_nom1");
const evaluadoNom2 = document.getElementById("evaluado_nom2");
const evaluadoApe1 = document.getElementById("evaluado_ape1");
const evaluadoApe2 = document.getElementById("evaluado_ape2");
const evaluadoLugarAlta = document.getElementById("evaluado_lugar_alta");
const evaluadoPuesto = document.getElementById("evaluado_puesto");
const evaluadoTiempo = document.getElementById("evaluado_tiempo");

// Campos del evaluador
const evaluadorCatalogo = document.getElementById("evaluador_catalogo");
const evaluadorGrado = document.getElementById("evaluador_grado");
const evaluadorNom1 = document.getElementById("evaluador_nom1");
const evaluadorNom2 = document.getElementById("evaluador_nom2");
const evaluadorApe1 = document.getElementById("evaluador_ape1");
const evaluadorApe2 = document.getElementById("evaluador_ape2");
const evaluadorPuesto = document.getElementById("evaluador_puesto");
const evaluadorTiempo = document.getElementById("evaluador_tiempo");

// Campos ocultos
const bolCatEvaluado = document.getElementById("bol_cat_evaluado");
const bolCeom = document.getElementById("bol_ceom");

// Elementos de alerta
const alertaValidacion = document.getElementById("alerta_validacion");
const mensajeValidacion = document.getElementById("mensaje_validacion");
const errorEvaluadorCatalogo = document.getElementById(
  "error_evaluador_catalogo"
);

const anioEvaluacion = document.getElementById("anio_evaluacion");
const bolAnio = document.getElementById("bol_anio");

// Obtener año actual y asignarlo
const anioActual = new Date().getFullYear();
anioEvaluacion.value = anioActual;
bolAnio.value = anioActual;

// Variables de control
let datosEvaluadorCargados = false;
let evaluadorValidado = false;
let evaluadoValidado = false;

// FUNCIÓN PARA CONVERTIR TIEMPO DE FORMATO AAMMDD A TEXTO
const formatearTiempo = (tiempoPuesto) => {
  if (!tiempoPuesto || tiempoPuesto === 0) return "No disponible";

  // Extraer años, meses y días del formato AAMMDD
  const años = Math.floor(tiempoPuesto / 10000);
  const meses = Math.floor((tiempoPuesto % 10000) / 100);
  const días = tiempoPuesto % 100;

  let resultado = "";
  if (años > 0) resultado += `${años} años`;
  if (meses > 0) {
    if (resultado) resultado += ", ";
    resultado += `${meses} meses`;
  }
  if (días > 0) {
    if (resultado) resultado += ", ";
    resultado += `${días} días`;
  }

  return resultado || "Sin datos";
};

// CARGAR DATOS DEL EVALUADO DESDE LA URL
const CargarDatosEvaluado = async () => {
  const catalogoEvaluado = new URLSearchParams(location.search).get("catalogo");

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

  const url = `/evaluacion_desempeno/API/evaluacionformulario/obtenerDatosEvaluado?catalogo=${catalogoEvaluado}`;
  const config = { method: "GET" };

  try {
    const respuesta = await fetch(url, config);
    const datos = await respuesta.json();
    const { codigo, mensaje, data } = datos;

    if (codigo === 1) {
      // Llenar campos del evaluado
      evaluadoCatalogo.value = data.catalogo || "";
      evaluadoGrado.value = data.grado || "";
      evaluadoNom1.value = data.per_nom1 || "";
      evaluadoNom2.value = data.per_nom2 || "";
      evaluadoApe1.value = data.per_ape1 || "";
      evaluadoApe2.value = data.per_ape2 || "";
      evaluadoLugarAlta.value = data.lugar_alta || "";
      evaluadoPuesto.value = data.puesto_ocupa || "";
      evaluadoTiempo.value = formatearTiempo(data.tiempo_ocupar_puesto);

      bolCatEvaluado.value = data.catalogo || "";

      // Validar si el evaluado puede ser evaluado
      evaluadoValidado = data.puede_ser_evaluado || false;

      if (!evaluadoValidado) {
        mostrarAlerta("danger", `EVALUADO: ${data.mensaje_tiempo}`);
        deshabilitarFormulario();
      } else {
        console.log("Evaluado válido:", data.mensaje_tiempo);
      }

      // Cargar datos relacionados automáticamente
      CargarDatosPafe(catalogoEvaluado);
      CargarDatosDemeritos(catalogoEvaluado);
      CargarDatosArrestos(catalogoEvaluado);
      CargarTodosLosMeritos();
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
    console.log(error);
    await Swal.fire({
      position: "center",
      icon: "error",
      title: "Error de conexión",
      text: "No se pudo cargar la información del evaluado",
      showConfirmButton: true,
    });
  }
};

// CARGAR DATOS DEL EVALUADOR
const CargarDatosEvaluador = async (catalogo) => {
  if (!catalogo || catalogo.trim() === "") {
    limpiarDatosEvaluador();
    return;
  }

  const url = `/evaluacion_desempeno/API/evaluacionformulario/obtenerDatosEvaluador?catalogo=${catalogo}`;
  const config = { method: "GET" };

  try {
    const respuesta = await fetch(url, config);
    const datos = await respuesta.json();
    const { codigo, mensaje, data } = datos;

    if (codigo === 1) {
      // Llenar campos del evaluador
      evaluadorGrado.value = data.grado || "";
      evaluadorNom1.value = data.per_nom1 || "";
      evaluadorNom2.value = data.per_nom2 || "";
      evaluadorApe1.value = data.per_ape1 || "";
      evaluadorApe2.value = data.per_ape2 || "";
      evaluadorPuesto.value = data.puesto_ocupa || "";
      evaluadorTiempo.value = formatearTiempo(data.tiempo_supervisar_evaluado);

      bolCeom.value = data.ceom || "";

      datosEvaluadorCargados = true;
      evaluadorCatalogo.classList.remove("is-invalid");
      errorEvaluadorCatalogo.textContent = "";

      // Validar si el evaluador puede evaluar
      evaluadorValidado = data.puede_evaluar || false;

      if (evaluadorValidado) {
        mostrarAlerta("success", `EVALUADOR: ${data.mensaje_tiempo}`);
      } else {
        mostrarAlerta("danger", `EVALUADOR: ${data.mensaje_tiempo}`);
        deshabilitarFormulario();
      }

      // Verificar estado general de la evaluación
      verificarEstadoEvaluacion();
    } else {
      limpiarDatosEvaluador();
      evaluadorCatalogo.classList.add("is-invalid");
      errorEvaluadorCatalogo.textContent = mensaje;
      mostrarAlerta("danger", mensaje);
    }
  } catch (error) {
    console.log(error);
    limpiarDatosEvaluador();
    evaluadorCatalogo.classList.add("is-invalid");
    errorEvaluadorCatalogo.textContent = "Error de conexión";
    mostrarAlerta("danger", "Error al cargar los datos del evaluador");
  }
};

// VERIFICAR EL ESTADO GENERAL DE LA EVALUACIÓN
const verificarEstadoEvaluacion = () => {
  if (!validarFormulario(FormEvaluacion, ['evaluado_catalogo', 'evaluador_catalogo'])) {
    mostrarAlerta("danger", "Debe completar todos los campos requeridos");
    deshabilitarFormulario();
    return;
  }
  
  if (evaluadoValidado && evaluadorValidado) {
    mostrarAlerta("success", "La evaluación puede proceder");
    habilitarFormulario();
  }
};

// DESHABILITAR EL FORMULARIO CUANDO NO SE CUMPLE CON LOS REQUISITOS
const deshabilitarFormulario = () => {
  // Deshabilitar sección III Factores de salud y conducta
  const perfilRadios = document.querySelectorAll('input[name="bol_perfil"]');
  const demeritosRadios = document.querySelectorAll(
    'input[name="rango_demeritos"]'
  );
  const arrestosRadios = document.querySelectorAll(
    'input[name="rango_arrestos"]'
  );
  const meritosSelects = document.querySelectorAll("#merito_1, #merito_2");

  // Deshabilitar todos los controles
  perfilRadios.forEach((radio) => (radio.disabled = true));
  demeritosRadios.forEach((radio) => (radio.disabled = true));
  arrestosRadios.forEach((radio) => (radio.disabled = true));
  meritosSelects.forEach((select) => (select.disabled = true));

  // Deshabilitar botón de página siguiente
  if (BtnPaginaSiguiente) {
    BtnPaginaSiguiente.disabled = true;
    BtnPaginaSiguiente.classList.add("btn-secondary");
    BtnPaginaSiguiente.classList.remove("btn-success");
  }
};

// HABILITAR EL FORMULARIO CUANDO SE CUMPLEN LOS REQUISITOS
const habilitarFormulario = () => {
  // Habilitar sección III Factores de salud y conducta
  const perfilRadios = document.querySelectorAll('input[name="bol_perfil"]');
  const demeritosRadios = document.querySelectorAll(
    'input[name="rango_demeritos"]'
  );
  const arrestosRadios = document.querySelectorAll(
    'input[name="rango_arrestos"]'
  );
  const meritosSelects = document.querySelectorAll("#merito_1, #merito_2");

  // Habilitar todos los controles (excepto los que están automáticamente cargados)
  perfilRadios.forEach((radio) => (radio.disabled = false));
  meritosSelects.forEach((select) => (select.disabled = false));

  // Los deméritos y arrestos quedan deshabilitados porque se cargan automáticamente
  // pero no por la validación de tiempo

  // Habilitar botón de página siguiente
  if (BtnPaginaSiguiente) {
    BtnPaginaSiguiente.disabled = false;
    BtnPaginaSiguiente.classList.remove("btn-secondary");
    BtnPaginaSiguiente.classList.add("btn-success");
  }
};

// CARGAR DATOS DE PAFEs DEL EVALUADO
const CargarDatosPafe = async (catalogo) => {
  if (!catalogo) return;

  mostrarInfoPafe("info", "Cargando evaluaciones PAFE...");

  const url = `/evaluacion_desempeno/API/evaluacionformulario/obtenerPafesEvaluado?catalogo=${catalogo}`;
  const config = { method: "GET" };

  try {
    const respuesta = await fetch(url, config);
    const datos = await respuesta.json();
    const { codigo, mensaje, data } = datos;

    if (codigo === 1) {
      const pafeEva1 = document.getElementById("pafe_eva1");
      const pafeEva2 = document.getElementById("pafe_eva2");
      const pafeEva3 = document.getElementById("pafe_eva3");
      const pafeEva4 = document.getElementById("pafe_eva4");
      const pafePromedio = document.getElementById("pafe_promedio");
      const bolPafe = document.getElementById("bol_pafe");

      const evaluaciones = data.puntajes;
      if (pafeEva1) pafeEva1.value = evaluaciones[0] || 0;
      if (pafeEva2) pafeEva2.value = evaluaciones[1] || 0;
      if (pafeEva3) pafeEva3.value = evaluaciones[2] || 0;
      if (pafeEva4) pafeEva4.value = evaluaciones[3] || 0;

      if (pafePromedio) pafePromedio.value = data.promedio || 0;
      if (bolPafe) bolPafe.value = data.puntos_pafe || 0;

      // Actualizar nombres de meses
      if (data.meses_consultados && data.meses_consultados.length >= 4) {
        const mesEva1 = document.getElementById("mes_eva1");
        const mesEva2 = document.getElementById("mes_eva2");
        const mesEva3 = document.getElementById("mes_eva3");
        const mesEva4 = document.getElementById("mes_eva4");

        if (mesEva1) mesEva1.textContent = data.meses_consultados[0];
        if (mesEva2) mesEva2.textContent = data.meses_consultados[1];
        if (mesEva3) mesEva3.textContent = data.meses_consultados[2];
        if (mesEva4) mesEva4.textContent = data.meses_consultados[3];
      }

      actualizarRangoPafe(data.puntos_pafe);
      mostrarInfoPafe(
        "success",
        `PAFEs cargados correctamente. Promedio: ${data.promedio} - ${data.rango_texto} (${data.puntos_pafe} puntos)`
      );

      setTimeout(() => calcularSumatoriaSeccionTercera(), 200);
    } else {
      limpiarDatosPafe();
      mostrarInfoPafe(
        "warning",
        mensaje || "No se encontraron evaluaciones PAFE para este especialista"
      );
    }
  } catch (error) {
    console.log(error);
    limpiarDatosPafe();
    mostrarInfoPafe("danger", "Error al cargar las evaluaciones PAFE");
  }
};

// CARGAR DATOS DE DEMÉRITOS DEL EVALUADO
const CargarDatosDemeritos = async (catalogo) => {
  if (!catalogo) return;

  const url = `/evaluacion_desempeno/API/evaluacionformulario/obtenerDemeritosEvaluado?catalogo=${catalogo}`;
  const config = { method: "GET" };

  try {
    const respuesta = await fetch(url, config);
    const datos = await respuesta.json();
    const { codigo, data } = datos;

    if (codigo === 1) {
      const radioDemeritos = document.querySelector(
        `input[name="rango_demeritos"][value="${data.puntos}"]`
      );
      if (radioDemeritos) {
        radioDemeritos.checked = true;
        actualizarDemeritosSeleccionado(data.puntos.toString());
        deshabilitarControlesDemeritos();
        setTimeout(() => calcularSumatoriaSeccionTercera(), 200);
      }
    }
  } catch (error) {
    console.log(error);
  }
};

// CARGAR DATOS DE ARRESTOS DEL EVALUADO
const CargarDatosArrestos = async (catalogo) => {
  if (!catalogo) return;

  const url = `/evaluacion_desempeno/API/evaluacionformulario/obtenerArrestosEvaluado?catalogo=${catalogo}`;
  const config = { method: "GET" };

  try {
    const respuesta = await fetch(url, config);
    const datos = await respuesta.json();
    const { codigo, data } = datos;

    if (codigo === 1) {
      const radioArrestos = document.querySelector(
        `input[name="rango_arrestos"][value="${data.puntos}"]`
      );
      if (radioArrestos) {
        radioArrestos.checked = true;
        actualizarArrestosSeleccionado(data.puntos.toString());
        deshabilitarControlesArrestos();
        setTimeout(() => calcularSumatoriaSeccionTercera(), 200);
      }
    }
  } catch (error) {
    console.log(error);
  }
};

// CARGAR MÉRITOS POR NOTA
const CargarMeritos = async (nota) => {
  const url = `/evaluacion_desempeno/API/evaluacionformulario/obtenerMeritos?nota=${nota}`;
  const config = { method: "GET" };

  try {
    const respuesta = await fetch(url, config);
    const datos = await respuesta.json();
    const { codigo, data } = datos;

    if (codigo === 1) {
      if (nota === 3) {
        llenarSelectMeritos("merito_1", data, 3);
      } else if (nota === 2) {
        llenarSelectMeritos("merito_2", data, 2);
      }
    } else {
      const select =
        nota === 3
          ? document.getElementById("merito_1")
          : document.getElementById("merito_2");
      if (select) {
        select.innerHTML =
          '<option value="0">No hay méritos disponibles</option>';
      }
    }
  } catch (error) {
    console.log(error);
    const select =
      nota === 3
        ? document.getElementById("merito_1")
        : document.getElementById("merito_2");
    if (select) {
      select.innerHTML = '<option value="0">Error al cargar méritos</option>';
    }
  }
};

// CARGAR TODOS LOS MÉRITOS
const CargarTodosLosMeritos = async () => {
  await Promise.all([
    CargarMeritos(3), // Mérito 1
    CargarMeritos(2), // Mérito 2
  ]);
};

// NAVEGACIÓN - VOLVER AL LISTADO
const VolverAlListado = () => {
  location.href = "/evaluacion_desempeno/evaluacionespecialistas";
};

// NAVEGACIÓN - IR A PÁGINA SIGUIENTE
const IrPaginaSiguiente = () => {
  if (evaluadoValidado && evaluadorValidado) {
    const catalogoEvaluado = document.getElementById("evaluado_catalogo").value;

    if (catalogoEvaluado) {
      location.href = `/evaluacion_desempeno/index2.php?catalogo=${catalogoEvaluado}`;
    } else {
      Swal.fire({
        position: "center",
        icon: "error",
        title: "Error",
        text: "No se encontró el catálogo del evaluado",
        showConfirmButton: true,
      });
    }
  } else {
    Swal.fire({
      position: "center",
      icon: "warning",
      title: "No se puede continuar",
      text: "Debe cumplir con los requisitos de tiempo mínimo para proceder con la evaluación",
      showConfirmButton: true,
    });
  }
};


// FUNCIONES PARA EVENT LISTENERS
const manejarCambioPerfil = (e) => {
    if (e.target.checked) {
        actualizarPerfilSeleccionado(e.target.value);
    }
};

const manejarCambioDemeritos = (e) => {
    if (e.target.checked) {
        actualizarDemeritosSeleccionado(e.target.value);
    }
};

const manejarCambioArrestos = (e) => {
    if (e.target.checked) {
        actualizarArrestosSeleccionado(e.target.value);
    }
};

const manejarInputEvaluador = (e) => {
    const catalogo = e.target.value.trim();
    if (catalogo.length >= 4) {
        cargarDatosEvaluadorDebounced(catalogo);
    } else {
        limpiarDatosEvaluador();
    }
};









// FUNCIONES DE APOYO
const mostrarAlerta = (tipo, mensaje) => {
  alertaValidacion.classList.remove(
    "d-none",
    "alert-danger",
    "alert-warning",
    "alert-success",
    "alert-info"
  );
  alertaValidacion.classList.add(`alert-${tipo}`);
  mensajeValidacion.textContent = mensaje;
};

const ocultarAlerta = () => {
  alertaValidacion.classList.add("d-none");
};

const debounce = (func, delay) => {
  let timeoutId;
  return (...args) => {
    clearTimeout(timeoutId);
    timeoutId = setTimeout(() => func(...args), delay);
  };
};

const limpiarDatosEvaluador = () => {
  evaluadorGrado.value = "";
  evaluadorNom1.value = "";
  evaluadorNom2.value = "";
  evaluadorApe1.value = "";
  evaluadorApe2.value = "";
  evaluadorPuesto.value = "";
  evaluadorTiempo.value = "";
  bolCeom.value = "";
  datosEvaluadorCargados = false;
  evaluadorValidado = false;
  ocultarAlerta();
  evaluadorCatalogo.classList.remove("is-invalid");
};

const limpiarDatosPafe = () => {
  const pafeEva1 = document.getElementById("pafe_eva1");
  const pafeEva2 = document.getElementById("pafe_eva2");
  const pafeEva3 = document.getElementById("pafe_eva3");
  const pafeEva4 = document.getElementById("pafe_eva4");
  const pafePromedio = document.getElementById("pafe_promedio");
  const bolPafe = document.getElementById("bol_pafe");

  if (pafeEva1) pafeEva1.value = "";
  if (pafeEva2) pafeEva2.value = "";
  if (pafeEva3) pafeEva3.value = "";
  if (pafeEva4) pafeEva4.value = "";
  if (pafePromedio) pafePromedio.value = "";
  if (bolPafe) bolPafe.value = "";

  const rangoItems = document.querySelectorAll(".rango-item");
  const puntoPafeItems = document.querySelectorAll(".punto-pafe-item");
  rangoItems.forEach((item) => item.classList.remove("selected"));
  puntoPafeItems.forEach((item) => item.classList.remove("selected"));
};

const mostrarInfoPafe = (tipo, mensaje) => {
  const pafeInfo = document.getElementById("pafe_info");
  const pafeMensaje = document.getElementById("pafe_mensaje");

  if (pafeInfo && pafeMensaje) {
    pafeInfo.classList.remove(
      "d-none",
      "alert-info",
      "alert-success",
      "alert-warning",
      "alert-danger"
    );
    pafeInfo.classList.add(`alert-${tipo}`);
    pafeMensaje.textContent = mensaje;
  }
};

const actualizarRangoPafe = (puntos) => {
  const rangoItems = document.querySelectorAll(".rango-item");
  const puntoPafeItems = document.querySelectorAll(".punto-pafe-item");

  rangoItems.forEach((item) => item.classList.remove("selected"));
  puntoPafeItems.forEach((item) => item.classList.remove("selected"));

  if (puntos !== null && puntos !== undefined) {
    const rangoSeleccionado = document.querySelector(
      `.rango-item[data-value="${puntos}"]`
    );
    const puntoSeleccionado = document.querySelector(
      `.punto-pafe-item[data-value="${puntos}"]`
    );

    if (rangoSeleccionado) {
      rangoSeleccionado.classList.add("selected");
      const radioButton = rangoSeleccionado.querySelector(
        'input[type="radio"]'
      );
      if (radioButton) {
        radioButton.checked = true;
      }
    }

    if (puntoSeleccionado) {
      puntoSeleccionado.classList.add("selected");
    }

    calcularSumatoriaSeccionTercera();
  }
};

const actualizarDemeritosSeleccionado = (valor) => {
  const demeritosTextos = {
    5: "0 deméritos - 5 puntos",
    4: "De 1 a 18 deméritos - 4 puntos",
    3: "De 19 a 36 deméritos - 3 puntos",
    2: "De 37 a 54 deméritos - 2 puntos",
    1: "De 55 a 74 deméritos - 1 punto",
    0: "De 75 a 100 deméritos - 0 puntos",
  };

  const rangoDemeritosItems = document.querySelectorAll(
    ".rango-demeritos-item"
  );
  const puntoDemeritosItems = document.querySelectorAll(
    ".punto-demeritos-item"
  );
  const demeritosSeleccionado = document.getElementById(
    "demeritos_seleccionado"
  );
  const demeritosTexto = document.getElementById("demeritos_texto");
  const bolDemeritos = document.getElementById("bol_demeritos");

  rangoDemeritosItems.forEach((item) => item.classList.remove("selected"));
  puntoDemeritosItems.forEach((item) => item.classList.remove("selected"));

  if (valor) {
    const rangoSeleccionado = document.querySelector(
      `.rango-demeritos-item[data-value="${valor}"]`
    );
    const puntoSeleccionado = document.querySelector(
      `.punto-demeritos-item[data-value="${valor}"]`
    );

    if (rangoSeleccionado) rangoSeleccionado.classList.add("selected");
    if (puntoSeleccionado) puntoSeleccionado.classList.add("selected");
    if (bolDemeritos) bolDemeritos.value = valor;

    if (demeritosTexto && demeritosSeleccionado) {
      demeritosTexto.textContent =
        demeritosTextos[valor] || "Selección inválida";
      demeritosSeleccionado.classList.remove("d-none", "alert-warning");
      demeritosSeleccionado.classList.add("alert-success");
    }

    calcularSumatoriaSeccionTercera();
  } else {
    if (bolDemeritos) bolDemeritos.value = "";

    if (demeritosTexto && demeritosSeleccionado) {
      demeritosTexto.textContent = "Seleccione un rango de deméritos";
      demeritosSeleccionado.classList.remove("d-none", "alert-success");
      demeritosSeleccionado.classList.add("alert-warning");
    }
  }
};

const actualizarArrestosSeleccionado = (valor) => {
  const arrestosTextos = {
    5: "0 arrestos - 5 puntos",
    4: "De 1 a 5 arrestos - 4 puntos",
    3: "De 6 a 10 arrestos - 3 puntos",
    2: "De 11 a 15 arrestos - 2 puntos",
    1: "De 16 a más arrestos - 1 punto",
  };

  const rangoArrestosItems = document.querySelectorAll(".rango-arrestos-item");
  const puntoArrestosItems = document.querySelectorAll(".punto-arrestos-item");
  const arrestosSeleccionado = document.getElementById("arrestos_seleccionado");
  const arrestosTexto = document.getElementById("arrestos_texto");
  const bolArrestos = document.getElementById("bol_arrestos");

  rangoArrestosItems.forEach((item) => item.classList.remove("selected"));
  puntoArrestosItems.forEach((item) => item.classList.remove("selected"));

  if (valor) {
    const rangoSeleccionado = document.querySelector(
      `.rango-arrestos-item[data-value="${valor}"]`
    );
    const puntoSeleccionado = document.querySelector(
      `.punto-arrestos-item[data-value="${valor}"]`
    );

    if (rangoSeleccionado) rangoSeleccionado.classList.add("selected");
    if (puntoSeleccionado) puntoSeleccionado.classList.add("selected");
    if (bolArrestos) bolArrestos.value = valor;

    if (arrestosTexto && arrestosSeleccionado) {
      arrestosTexto.textContent = arrestosTextos[valor] || "Selección inválida";
      arrestosSeleccionado.classList.remove("d-none", "alert-warning");
      arrestosSeleccionado.classList.add("alert-success");
    }

    calcularSumatoriaSeccionTercera();
  } else {
    if (bolArrestos) bolArrestos.value = "";

    if (arrestosTexto && arrestosSeleccionado) {
      arrestosTexto.textContent = "Seleccione un rango de arrestos";
      arrestosSeleccionado.classList.remove("d-none", "alert-success");
      arrestosSeleccionado.classList.add("alert-warning");
    }
  }
};

// FUNCIÓN NUEVA PARA PERFIL BIOFÍSICO (esta función no existe en tu código)
const actualizarPerfilSeleccionado = (valor) => {
  const perfilTextos = {
    1: "OBESIDAD II - 1 punto",
    2: "OBESIDAD I - 2 puntos",
    3: "SOBREPESO - 3 puntos",
    4: "DÉFICIT - 4 puntos",
    5: "NORMAL - 5 puntos",
  };

  const perfilItems = document.querySelectorAll(".perfil-color .option-item");
  const perfilPoints = document.querySelectorAll(".perfil-color .point-item");

  perfilItems.forEach((item) => item.classList.remove("selected"));
  perfilPoints.forEach((point) => point.classList.remove("selected"));

  if (valor) {
    const opcionSeleccionada = document.querySelector(
      `.perfil-color .option-item[data-value="${valor}"]`
    );
    const puntoSeleccionado = document.querySelector(
      `.perfil-color .point-item[data-value="${valor}"]`
    );

    if (opcionSeleccionada) opcionSeleccionada.classList.add("selected");
    if (puntoSeleccionado) puntoSeleccionado.classList.add("selected");

    calcularSumatoriaSeccionTercera();
  }
};

const llenarSelectMeritos = (selectId, meritos, nota) => {
  const select = document.getElementById(selectId);
  if (!select) return;

  select.innerHTML = "";

  const defaultOption = document.createElement("option");
  defaultOption.value = "0";
  defaultOption.textContent = "Ningún mérito aplicable (0 puntos)";
  select.appendChild(defaultOption);

  meritos.forEach((merito) => {
    const option = document.createElement("option");
    option.value = merito.mer_codigo;
    option.textContent = merito.mer_descripcion;
    option.dataset.nota = nota;
    select.appendChild(option);
  });

  const selectElement = document.getElementById(selectId);
  if (selectElement) {
    selectElement.removeEventListener("change", actualizarPuntosMeritos);
    selectElement.addEventListener("change", actualizarPuntosMeritos);
  }

  setTimeout(() => {
    actualizarPuntosMeritos();
  }, 100);
};

const actualizarPuntosMeritos = () => {
  const merito1Select = document.getElementById("merito_1");
  const merito2Select = document.getElementById("merito_2");
  const puntosMetiro1 = document.getElementById("puntos_merito_1");
  const puntosMetiro2 = document.getElementById("puntos_merito_2");
  const totalPuntos = document.getElementById("total_puntos_meritos");
  const detalleMeritos = document.getElementById("detalle_meritos");

  if (
    !merito1Select ||
    !merito2Select ||
    !puntosMetiro1 ||
    !puntosMetiro2 ||
    !totalPuntos
  ) {
    return;
  }

  // Calcular puntos
  const valorMerito1 = merito1Select.value;
  const puntosMerito1 = valorMerito1 && valorMerito1 !== "0" ? 3 : 0;
  puntosMetiro1.textContent = puntosMerito1;

  const valorMerito2 = merito2Select.value;
  const puntosMerito2 = valorMerito2 && valorMerito2 !== "0" ? 2 : 0;
  puntosMetiro2.textContent = puntosMerito2;

  const total = puntosMerito1 + puntosMerito2;
  totalPuntos.textContent = total;

  // Actualizar campos ocultos
  const campoOculto = document.getElementById("bol_meritos_total");
  if (campoOculto) campoOculto.value = total;

  // Actualizar detalle
  if (detalleMeritos) {
    let detalle = "";
    if (puntosMerito1 > 0) {
      const textoMerito1 =
        merito1Select.options[merito1Select.selectedIndex]?.text ||
        "Mérito seleccionado";
      detalle += `Mérito 1: ${textoMerito1.substring(
        0,
        50
      )}... (${puntosMerito1} puntos) `;
    }
    if (puntosMerito2 > 0) {
      const textoMerito2 =
        merito2Select.options[merito2Select.selectedIndex]?.text ||
        "Mérito seleccionado";
      detalle += `Mérito 2: ${textoMerito2.substring(
        0,
        50
      )}... (${puntosMerito2} puntos)`;
    }
    if (detalle === "") {
      detalle = "No hay méritos seleccionados";
    }
    detalleMeritos.textContent = detalle;
  }

  const campoDetalle = document.getElementById("bol_meritos_detalle");
  if (campoDetalle) {
    const detalleCompleto = {
      merito_1: valorMerito1 !== "0" ? valorMerito1 : null,
      merito_2: valorMerito2 !== "0" ? valorMerito2 : null,
      total_puntos: total,
    };
    campoDetalle.value = JSON.stringify(detalleCompleto);
  }

  calcularSumatoriaSeccionTercera();
};

const calcularSumatoriaSeccionTercera = () => {
  const perfilPuntos =
    document.querySelector('input[name="bol_perfil"]:checked')?.value || 0;
  const pafePuntos = document.getElementById("bol_pafe")?.value || 0;
  const demeritosPuntos = document.getElementById("bol_demeritos")?.value || 0;
  const arrestosPuntos = document.getElementById("bol_arrestos")?.value || 0;
  const meritosPuntos =
    document.getElementById("bol_meritos_total")?.value || 0;

  // Actualizar displays individuales
  const elemPerfil = document.getElementById("puntos_perfil_total");
  const elemPafe = document.getElementById("puntos_pafe_total");
  const elemDemeritos = document.getElementById("puntos_demeritos_total");
  const elemArrestos = document.getElementById("puntos_arrestos_total");
  const elemMeritos = document.getElementById("puntos_meritos_total_suma");

  if (elemPerfil) elemPerfil.textContent = perfilPuntos;
  if (elemPafe) elemPafe.textContent = pafePuntos;
  if (elemDemeritos) elemDemeritos.textContent = demeritosPuntos;
  if (elemArrestos) elemArrestos.textContent = arrestosPuntos;
  if (elemMeritos) elemMeritos.textContent = meritosPuntos;

  // Calcular total
  const total =
    parseInt(perfilPuntos) +
    parseInt(pafePuntos) +
    parseInt(demeritosPuntos) +
    parseInt(arrestosPuntos) +
    parseInt(meritosPuntos);

  // Actualizar total
  const elemTotal = document.getElementById("total_seccion_tercera");
  const elemTotalHidden = document.getElementById("bol_total_seccion_3");

  if (elemTotal) elemTotal.textContent = total;
  if (elemTotalHidden) elemTotalHidden.value = total;

  // Guardar total en sessionStorage para página 2
  sessionStorage.setItem("totalSaludConducta", total);
  console.log("Total Salud y Conducta guardado en sesión:", total);
};

const deshabilitarControlesDemeritos = () => {
  const demeritosRadios = document.querySelectorAll(
    'input[name="rango_demeritos"]'
  );
  demeritosRadios.forEach((radio) => (radio.disabled = true));

  const rangoDemeritosItems = document.querySelectorAll(
    ".rango-demeritos-item"
  );
  rangoDemeritosItems.forEach((item) => {
    item.style.pointerEvents = "none";
    item.style.opacity = "0.7";
    item.classList.add("disabled-auto");
  });

  const puntoDemeritosItems = document.querySelectorAll(
    ".punto-demeritos-item"
  );
  puntoDemeritosItems.forEach((item) => {
    item.style.pointerEvents = "none";
    item.style.opacity = "0.7";
    item.classList.add("disabled-auto");
  });
};

const deshabilitarControlesArrestos = () => {
  const arrestosRadios = document.querySelectorAll(
    'input[name="rango_arrestos"]'
  );
  arrestosRadios.forEach((radio) => (radio.disabled = true));

  const rangoArrestosItems = document.querySelectorAll(".rango-arrestos-item");
  rangoArrestosItems.forEach((item) => {
    item.style.pointerEvents = "none";
    item.style.opacity = "0.7";
    item.classList.add("disabled-auto");
  });

  const puntoArrestosItems = document.querySelectorAll(".punto-arrestos-item");
  puntoArrestosItems.forEach((item) => {
    item.style.pointerEvents = "none";
    item.style.opacity = "0.7";
    item.classList.add("disabled-auto");
  });
};

// Crear versión con debounce para cargar datos del evaluador
const cargarDatosEvaluadorDebounced = debounce(CargarDatosEvaluador, 800);

// INICIALIZACIÓN
CargarDatosEvaluado();
CargarTodosLosMeritos();

// EVENT LISTENERS
const perfilRadios = document.querySelectorAll('input[name="bol_perfil"]');
perfilRadios.forEach(radio => {
    radio.addEventListener('change', manejarCambioPerfil);
});

const demeritosRadios = document.querySelectorAll('input[name="rango_demeritos"]');
demeritosRadios.forEach(radio => {
    radio.addEventListener('change', manejarCambioDemeritos);
});

const arrestosRadios = document.querySelectorAll('input[name="rango_arrestos"]');
arrestosRadios.forEach(radio => {
    radio.addEventListener('change', manejarCambioArrestos);
});

BtnVolverListado.addEventListener('click', VolverAlListado);
BtnPaginaSiguiente.addEventListener('click', IrPaginaSiguiente);
evaluadorCatalogo.addEventListener('input', manejarInputEvaluador);