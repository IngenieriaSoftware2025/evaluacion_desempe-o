import Swal from "sweetalert2";
import { validarFormulario } from '../funciones';
import DataTable from "datatables.net-bs5";
import { lenguaje } from "../lenguaje";

const FormBusqueda = document.getElementById('FormBusqueda');
const BtnBuscar = document.getElementById('BtnBuscar');
const BtnLimpiar = document.getElementById('BtnLimpiar');
const SelectDependencia = document.getElementById('dependencia');
const SelectGrado = document.getElementById('grado');

// Cargar dependencias en el dropdown
const CargarDependencias = async () => {
    const url = '/evaluacion_desempe-o/API/evaluacionespecialistas/obtenerDependencias';
    const config = {
        method: 'GET'
    }

    try {
        const respuesta = await fetch(url, config);
        const datos = await respuesta.json();
        const { codigo, data } = datos

        if (codigo == 1) {
            SelectDependencia.innerHTML = '<option value="">--Todas--</option>';
            data.forEach(dep => {
                SelectDependencia.innerHTML += `<option value="${dep.dependencia}">${dep.dependencia}</option>`;
            });
        }

    } catch (error) {
        console.log(error)
    }
}

// Cargar grados en el dropdown
const CargarGrados = async () => {
    const url = '/evaluacion_desempe-o/API/evaluacionespecialistas/obtenerGrados';
    const config = {
        method: 'GET'
    }

    try {
        const respuesta = await fetch(url, config);
        const datos = await respuesta.json();
        const { codigo, data } = datos

        if (codigo == 1) {
            SelectGrado.innerHTML = '<option value="">Todos los grados</option>';
            data.forEach(grado => {
                SelectGrado.innerHTML += `<option value="${grado.grado}">${grado.grado}</option>`;
            });
        }

    } catch (error) {
        console.log(error)
    }
}

const BuscarEvaluaciones = async () => {
    BtnBuscar.disabled = true;
    
    const catalogo = document.getElementById('catalogo').value;
    const nombre = document.getElementById('nombre').value;
    const apellido = document.getElementById('apellido').value;
    const grado = document.getElementById('grado').value;
    const dependencia = document.getElementById('dependencia').value;

    let url = '/evaluacion_desempe-o/API/evaluacionespecialistas/buscar?';
    
    const params = [];
    if (catalogo) params.push(`catalogo=${encodeURIComponent(catalogo)}`);
    if (nombre) params.push(`nombre=${encodeURIComponent(nombre)}`);
    if (apellido) params.push(`apellido=${encodeURIComponent(apellido)}`);
    if (grado) params.push(`grado=${encodeURIComponent(grado)}`);
    if (dependencia) params.push(`dependencia=${encodeURIComponent(dependencia)}`);
    
    url += params.join('&');

    const config = {
        method: 'GET'
    }

    try {
        const respuesta = await fetch(url, config);
        const datos = await respuesta.json();
        const { codigo, mensaje, data } = datos

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
        console.log(error)
        await Swal.fire({
            position: "center",
            icon: "error",
            title: "Error",
            text: "Error al buscar evaluaciones",
            showConfirmButton: true,
        });
    }
    BtnBuscar.disabled = false;
}

const datatable = new DataTable('#TableEvaluaciones', {
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
            title: 'No.',
            data: 'catalogo',
            width: '5%',
            render: (data, type, row, meta) => meta.row + 1
        },
        { 
            title: 'EVALUACION', 
            data: 'evaluacion', 
            width: '8%',
            render: (data, type, row) => {
                return data && data > 0 ? data : 'N/A';
            }
        },
        { 
            title: 'CATALOGO', 
            data: 'catalogo', 
            width: '8%'
        },
        { 
            title: 'GRADO', 
            data: 'grado', 
            width: '10%'
        },
        { 
            title: 'NOMBRE COMPLETO', 
            data: 'nombre_completo', 
            width: '20%'
        },
        { 
            title: 'DEPENDENCIA', 
            data: 'dependencia', 
            width: '15%'
        },
        { 
            title: 'EMPLEO', 
            data: 'empleo', 
            width: '12%'
        },
        { 
            title: 'SITUACION', 
            data: 'situacion', 
            width: '8%',
            render: (data, type, row) => {
                let badgeClass = 'bg-secondary';
                switch(data) {
                    case 'ACTIVO':
                        badgeClass = 'bg-success';
                        break;
                    case 'INACTIVO':
                        badgeClass = 'bg-danger';
                        break;
                    case 'SIN EVALUACION':
                        badgeClass = 'bg-warning';
                        break;
                }
                return `<span class="badge ${badgeClass}">${data}</span>`;
            }
        },
        { 
            title: 'NOTA', 
            data: 'nota', 
            width: '6%',
            render: (data, type, row) => {
                return data && data > 0 ? data : 'N/A';
            }
        },
        {
            title: 'VERIFICAR',
            data: 'catalogo',
            searchable: false,
            orderable: false,
            width: '8%',
            render: (data, type, row, meta) => {
                return `
                    <div class='d-flex justify-content-center'>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                Opciones
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item ver-detalle" href="#" data-catalogo="${data}">
                                    <i class="bi bi-eye me-1"></i>Ver Detalle
                                </a></li>
                                <li><a class="dropdown-item evaluar" href="#" data-catalogo="${data}">
                                    <i class="bi bi-clipboard-check me-1"></i>Evaluar
                                </a></li>
                            </ul>
                        </div>
                    </div>`;
            }
        }
    ]
});

const limpiarTodo = () => {
    FormBusqueda.reset();
    datatable.clear().draw();
}

const VerDetalle = async (e) => {
    e.preventDefault();
    const catalogo = e.currentTarget.dataset.catalogo;
    
    await Swal.fire({
        position: "center",
        icon: "info",
        title: "Ver Detalle",
        text: `Mostrando detalle del catálogo: ${catalogo}`,
        showConfirmButton: true,
    });
}

const Evaluar = async (e) => {
    e.preventDefault();
    const catalogo = e.currentTarget.dataset.catalogo;
    
    await Swal.fire({
        position: "center",
        icon: "info",
        title: "Evaluar",
        text: `Evaluando catálogo: ${catalogo}`,
        showConfirmButton: true,
    });
}

// Cargar datos al iniciar
CargarDependencias();
CargarGrados();

// Event listeners
datatable.on('click', '.ver-detalle', VerDetalle);
datatable.on('click', '.evaluar', Evaluar);
BtnBuscar.addEventListener('click', BuscarEvaluaciones);
BtnLimpiar.addEventListener('click', limpiarTodo);