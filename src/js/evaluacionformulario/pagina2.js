import Swal from "sweetalert2";
import { validarFormulario } from '../funciones';

const FormConceptualizacion = document.getElementById('FormConceptualizacion');

// Elementos para mostrar subtotales y total
const subtotal1 = document.getElementById('subtotal_1');
const subtotal2 = document.getElementById('subtotal_2');
const subtotal3 = document.getElementById('subtotal_3');
const subtotal4 = document.getElementById('subtotal_4');
const subtotal5 = document.getElementById('subtotal_5');
const totalConcepto = document.getElementById('total_conceptualizacion');
const bolTotalConcep = document.getElementById('bol_total_concep');

// Función para calcular subtotales y total
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

    console.log('✅ Totales calculados:', contadores, 'Total:', totalGeneral);
}

// Función para guardar conceptualización
const guardarConceptualizacion = async (event) => {
    event.preventDefault();
    
    if (!validarFormulario(FormConceptualizacion, [])) {
        await Swal.fire({
            position: "center",
            icon: "warning",
            title: "FORMULARIO INCOMPLETO",
            text: "Debe responder todas las preguntas de conceptualización",
            showConfirmButton: true,
        });
        return;
    }

    const body = new FormData(FormConceptualizacion);
    const url = '/evaluacion_desempe-o/API/conceptualizacion/guardar';
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
        console.error('Error al guardar:', error);
        await Swal.fire({
            position: "center",
            icon: "error",
            title: "Error de conexión",
            text: "No se pudo guardar la conceptualización",
            showConfirmButton: true,
        });
    }
}

// Event listeners
document.addEventListener('DOMContentLoaded', function() {
    // Agregar event listener a todos los radio buttons
    for (let i = 1; i <= 15; i++) {
        const radioButtons = document.querySelectorAll(`input[name="aspecto_${i}"]`);
        radioButtons.forEach(radio => {
            radio.addEventListener('change', calcularTotales);
        });
    }

    // Event listener para el formulario
    if (FormConceptualizacion) {
        FormConceptualizacion.addEventListener('submit', guardarConceptualizacion);
    }

    console.log('✅ JavaScript de conceptualización cargado correctamente');
});