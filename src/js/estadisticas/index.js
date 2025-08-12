import { Chart } from "chart.js/auto";
import Swal from "sweetalert2";

// Obtener contextos de los canvas.
const grafico1 = document.getElementById("grafico-categorias").getContext("2d");
const grafico2 = document.getElementById("grafico-ascensos").getContext("2d");
const grafico3 = document.getElementById("grafico-pafes").getContext("2d");
const grafico4 = document.getElementById("grafico-arrestos").getContext("2d");

// Función para obtener colores
function getColorForEstado(cantidad) {
    const colores = [
        'rgba(40, 167, 69, 0.8)',    // Verde - Excelente
        'rgba(0, 123, 255, 0.8)',    // Azul - Muy Bueno  
        'rgba(255, 193, 7, 0.8)',    // Amarillo - Regular
        'rgba(220, 53, 69, 0.8)',    // Rojo - Insatisfactorio
        'rgba(108, 117, 125, 0.8)',  // Gris
        'rgba(23, 162, 184, 0.8)',   // Cyan
        'rgba(255, 159, 64, 0.8)',   // Naranja
        'rgba(153, 102, 255, 0.8)'   // Púrpura
    ];
    
    return colores[cantidad % colores.length];
}

// Crear gráficos vacíos
window.graficaCategorias = new Chart(grafico1, {
    type: 'pie',
    data: {
        labels: [],
        datasets: []
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            title: {
                display: true,
                text: 'Distribución por Categorías'
            }
        }
    }
});

window.graficaAscensos = new Chart(grafico2, {
    type: 'doughnut',
    data: {
        labels: [],
        datasets: []
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            title: {
                display: true,
                text: 'Aptos para Ascenso'
            }
        }
    }
});

window.graficaPafes = new Chart(grafico3, {
    type: 'bar',
    data: {
        labels: [],
        datasets: [{
            label: 'Cantidad de Especialistas',
            data: [],
            backgroundColor: 'rgba(23, 162, 184, 0.8)',
            borderColor: 'rgba(23, 162, 184, 1)',
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            y: { 
                beginAtZero: true,
                ticks: { stepSize: 1 }
            }
        },
        plugins: {
            title: {
                display: true,
                text: 'Estadísticas PAFE'
            }
        }
    }
});

window.graficaArrestos = new Chart(grafico4, {
    type: 'bar',
    data: {
        labels: [],
        datasets: [{
            label: 'Arrestos',
            data: [],
            backgroundColor: 'rgba(220, 53, 69, 0.8)',
            borderColor: 'rgba(220, 53, 69, 1)',
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        indexAxis: 'y',
        scales: {
            x: { 
                beginAtZero: true,
                ticks: { stepSize: 1 }
            }
        },
        plugins: {
            title: {
                display: true,
                text: 'Especialistas con Más Arrestos'
            }
        }
    }
});

// BUSCAR CATEGORÍAS 
const BuscarCategorias = async () => {
    const url = '/evaluacion_desempeno/estadisticas/buscarAPI';
    const config = {
        method: 'GET'
    }

    try {
        const respuesta = await fetch(url, config);
        const datos = await respuesta.json();
        const { codigo, mensaje, data } = datos;
        
        if (codigo == 1) {
            console.log('Categorías:', data);
            
            const categorias = [];
            const datosCategorias = new Map();
            
            data.forEach(d => {
                if (!datosCategorias.has(d.categoria)) {
                    datosCategorias.set(d.categoria, d.cantidad);
                    categorias.push({ 
                        categoria: d.categoria, 
                        cantidad: parseInt(d.cantidad)
                    });
                }
            });
            
            // Actualizar contador
            const totalEvaluados = categorias.reduce((total, cat) => total + cat.cantidad, 0);
            document.getElementById('contador-total').textContent = totalEvaluados;
            
            // Extraer etiquetas únicas
            const etiquetasCategorias = [...new Set(data.map(d => d.categoria))];
            
            // Actualizar gráfico
            if (window.graficaCategorias) {
                window.graficaCategorias.data.labels = etiquetasCategorias;
                window.graficaCategorias.data.datasets = [{
                    data: categorias.map(c => c.cantidad),
                    backgroundColor: [
                        'rgba(40, 167, 69, 0.8)',   // Verde - Excelente
                        'rgba(0, 123, 255, 0.8)',   // Azul - Muy Bueno
                        'rgba(255, 193, 7, 0.8)',   // Amarillo - Regular
                        'rgba(220, 53, 69, 0.8)'    // Rojo - Insatisfactorio
                    ]
                }];
                window.graficaCategorias.update();
            }

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
    }
};

// BUSCAR APTOS ASCENSO
const BuscarAptosAscenso = async () => {
    const url = '/evaluacion_desempeno/estadisticas/aptosAscensoAPI';
    const config = {
        method: 'GET'
    }

    try {
        const respuesta = await fetch(url, config);
        const datos = await respuesta.json();
        const { codigo, mensaje, data } = datos;
        
        if (codigo == 1) {
            console.log('Aptos ascenso:', data);
            
            // Actualizar contador
            const aptosData = data.find(item => item.tipo === 'Aptos');
            document.getElementById('contador-aptos').textContent = aptosData ? aptosData.cantidad : 0;
            
            // Extraer nombres y cantidades
            const tiposAscenso = data.map(item => item.tipo);
            const cantidadesAscenso = data.map(item => parseInt(item.cantidad));
            
            // Actualizar gráfico
            if (window.graficaAscensos) {
                window.graficaAscensos.data.labels = tiposAscenso;
                window.graficaAscensos.data.datasets = [{
                    data: cantidadesAscenso,
                    backgroundColor: [
                        'rgba(40, 167, 69, 0.8)',   // Verde - Aptos
                        'rgba(220, 53, 69, 0.8)'    // Rojo - No Aptos
                    ]
                }];
                window.graficaAscensos.update();
            }

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
        console.log('Error al cargar aptos ascenso:', error);
    }
};

// BUSCAR PAFEs
const BuscarPafes = async () => {
    const url = '/evaluacion_desempeno/estadisticas/pafesAPI';
    const config = {
        method: 'GET'
    }

    try {
        const respuesta = await fetch(url, config);
        const datos = await respuesta.json();
        const { codigo, mensaje, data } = datos;
        
        if (codigo == 1) {
            console.log('PAFEs:', data);
            
            // Actualizar contador 
            const pafeCompleto = data.find(p => parseInt(p.pafes_completos) === 4);
            document.getElementById('contador-pafe').textContent = pafeCompleto ? pafeCompleto.cantidad : 0;
            
            // Formatear los datos
            const etiquetasPafes = data.map(item => `${item.pafes_completos} PAFEs`);
            const cantidadesPafes = data.map(item => parseInt(item.cantidad));
            
            // Actualizar gráfico
            if (window.graficaPafes) {
                window.graficaPafes.data.labels = etiquetasPafes;
                window.graficaPafes.data.datasets[0].data = cantidadesPafes;
                window.graficaPafes.update();
            }

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
        console.log('Error al cargar PAFEs:', error);
    }
};

// BUSCAR ARRESTOS
const BuscarArrestos = async () => {
    const url = '/evaluacion_desempeno/estadisticas/arrestosAPI';
    const config = {
        method: 'GET'
    }

    try {
        const respuesta = await fetch(url, config);
        const datos = await respuesta.json();
        const { codigo, mensaje, data } = datos;
        
        if (codigo == 1) {
            console.log('Arrestos:', data);
            
            // Actualizar contador
            document.getElementById('contador-arrestos').textContent = data.length;
            
            // Extraer nombres y arrestos
            const nombresArrestos = data.map(item => item.nombre);
            const cantidadArrestos = data.map(item => parseInt(item.arrestos));
            
            // Actualizar gráfico
            if (window.graficaArrestos) {
                window.graficaArrestos.data.labels = nombresArrestos;
                window.graficaArrestos.data.datasets[0].data = cantidadArrestos;
                window.graficaArrestos.update();
            }

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
        console.log('Error al cargar arrestos:', error);
    }
};

// Llamar todas las funciones
BuscarCategorias();
BuscarAptosAscenso();
BuscarPafes();
BuscarArrestos();