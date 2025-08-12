import { Dropdown } from "bootstrap";
import { validarFormulario } from "../funciones";
import Swal from "sweetalert2";
import DataTable from "datatables.net-bs5";
import { lenguaje } from "../lenguaje";

// ELEMENTOS DEL DOM
const FormBusqueda = document.getElementById("FormBusqueda");
const BtnBuscar = document.getElementById("BtnBuscar");
const BtnLimpiar = document.getElementById("BtnLimpiar");
const SelectGrado = document.getElementById("grado");

// CARGAR GRADOS EN EL DROPDOWN
const CargarGrados = async () => {
  const url = "/evaluacion_desempeno/API/evaluacionespecialistas/obtenerGrados";
  const config = {
    method: "GET",
  };

  try {
    const respuesta = await fetch(url, config);
    const datos = await respuesta.json();
    const { codigo, data } = datos;

    if (codigo == 1) {
      SelectGrado.innerHTML = '<option value="">Todos los grados</option>';
      data.forEach((grado) => {
        SelectGrado.innerHTML += `<option value="${grado.grado}">${grado.grado}</option>`;
      });
    }
  } catch (error) {
    console.log(error);
  }
};

// BUSCAR EVALUACIONES CON FILTROS
const BuscarEvaluaciones = async () => {
  BtnBuscar.disabled = true;

  const catalogo = document.getElementById("catalogo").value;
  const grado = document.getElementById("grado").value;

  let url = "/evaluacion_desempeno/API/evaluacionespecialistas/buscar?";

  const params = [];
  if (catalogo) params.push(`catalogo=${encodeURIComponent(catalogo)}`);
  if (grado) params.push(`grado=${encodeURIComponent(grado)}`);

  url += params.join("&");

  const config = {
    method: "GET",
  };

  try {
    const respuesta = await fetch(url, config);
    const datos = await respuesta.json();
    const { codigo, mensaje, data } = datos;

    if (codigo == 1) {
      datatable.clear().draw();
      datatable.rows.add(data).draw();
    } else {
      await Swal.fire({
        position: "center",
        icon: "info",
        title: "Sin resultados",
        text: mensaje,
        showConfirmButton: true,
      });
    }
  } catch (error) {
    console.log(error);
    await Swal.fire({
      position: "center",
      icon: "error",
      title: "Error",
      text: "Error al buscar evaluaciones",
      showConfirmButton: true,
    });
  }
  BtnBuscar.disabled = false;
};

// CARGAR DATOS AUTOMÁTICAMENTE AL INICIAR
const CargarDatosIniciales = async () => {
  const url = "/evaluacion_desempeno/API/evaluacionespecialistas/buscar";
  const config = {
    method: "GET",
  };

  try {
    const respuesta = await fetch(url, config);
    const datos = await respuesta.json();
    const { codigo, data } = datos;

    if (codigo == 1) {
      datatable.clear().draw();
      datatable.rows.add(data).draw();
    }
  } catch (error) {
    console.log(error);
  }
};

// CONFIGURACIÓN DE DATATABLE
const datatable = new DataTable("#TableEvaluaciones", {
  dom: `
        <"row mt-3 justify-content-between" 
            <"col" l> 
            <"col" B> 
            <"col-3" f>
        >
        t
        <"row mt-3 justify-content-between" 
            <"col-md-3 d-flex align-items-center" i> 
            <"col-md-8 d-flex justify-content-end" p>
        >
    `,
  language: lenguaje,
  data: [],
  columns: [
    {
      title: "No.",
      data: "catalogo",
      width: "8%",
      className: "text-center",
      render: (data, type, row, meta) => meta.row + 1,
    },
    {
      title: "CATALOGO",
      data: "catalogo",
      width: "12%",
      className: "text-center fw-bold",
    },
    {
      title: "GRADO Y NOMBRE",
      data: "nombre_completo",
      width: "35%",
    },
    {
      title: "EMPLEO/PLAZA",
      data: "plaza",
      width: "25%",
    },
    {
      title: "INGRESO DE DATOS",
      data: "catalogo",
      searchable: false,
      orderable: false,
      width: "10%",
      className: "text-center",
      render: (data, type, row, meta) => {
        return `
                    <button class='btn btn-success btn-sm ingreso-datos' 
                        data-catalogo="${data}" 
                        title="Ingreso de Datos">
                        <i class="bi bi-plus-circle me-1"></i>INGRESAR EVALUACIÓN
                    </button>`;
      },
    },
    {
      title: "IMPRESIÓN DE FORMULARIOS",
      data: "catalogo",
      searchable: false,
      orderable: false,
      width: "10%",
      className: "text-center",
      render: (data, type, row, meta) => {
        return `
                    <button class='btn btn-primary btn-sm imprimir-formato' 
                        data-catalogo="${data}" 
                        title="Imprimir Formato">
                        <i class="bi bi-printer me-1"></i>IMPRIMIR FORMATO
                    </button>`;
      },
    },
  ],
});

// LIMPIAR FORMULARIO Y RECARGAR DATOS
const limpiarTodo = () => {
  FormBusqueda.reset();
  CargarDatosIniciales();
};

// REDIRIGIR A PÁGINA DE INGRESO DE DATOS
const IngresarDatos = (e) => {
  e.preventDefault();
  const catalogo = e.currentTarget.dataset.catalogo;
  location.href = `/evaluacion_desempeno/ingresar-datos?catalogo=${catalogo}`;
};

// REDIRIGIR A PÁGINA DE IMPRESIÓN DE FORMULARIOS
const ImprimirFormato = (e) => {
  e.preventDefault();
  const catalogo = e.currentTarget.dataset.catalogo;
  location.href = `/evaluacion_desempeno/imprimir-formato?catalogo=${catalogo}`;
};

// INICIALIZACIÓN
CargarGrados();
CargarDatosIniciales();

// EVENT LISTENERS
datatable.on("click", ".ingreso-datos", IngresarDatos);
datatable.on("click", ".imprimir-formato", ImprimirFormato);
BtnBuscar.addEventListener("click", BuscarEvaluaciones);
BtnLimpiar.addEventListener("click", limpiarTodo);
