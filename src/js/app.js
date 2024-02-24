let paso = 1;
const pasoInicial=1;
const pasoFinal=3;

const cita= {
    nombre: '',
    fecha: '',
    hora: '',
    servicios: []
}

document.addEventListener('DOMContentLoaded', function(){
    iniciarApp();
})

function iniciarApp(){
    mostrarSeccion();  //muestra y oculta secciones
    tabs(); //Cambia la seccion cuando se presiona los tabs
    botonesPaginador(); //agrega o quita los botones del paginador
    paginaSiguiente();
    paginaAnterior();

    consultarAPI();  //Consulta la API en el backend de PHP
    
    nombreCliente(); //Añande el nombre del cliente al objeto cita
    seleccionarFecha(); //Añade la fecha de la cita en el objeto
    seleccionarHora();

    mostrarResumen(); //Muestra el resumen de la cita
}

function mostrarSeccion(){

    //Ocultar la sección que tenga la clase mostrar
    const seccionAnterior = document.querySelector('.mostrar');
    if(seccionAnterior)
        seccionAnterior.classList.remove('mostrar');

    //Seleccionar la seccion con el paso..
    const pasoSelector =`#paso-${paso}`;    
    const seccion = document.querySelector(pasoSelector);
    seccion.classList.add('mostrar');

    //quitar la clase actual al tab anterior
    const tabAnterior = document.querySelector('.actual');
    if(tabAnterior){
        tabAnterior.classList.remove('actual');
    }    
    //Resalta el tab actual    
    const tab = document.querySelector(`[data-paso="${paso}"]`);
    tab.classList.add('actual');
}

function tabs(){
    const botones = document.querySelectorAll('.tabs button');
    botones.forEach( boton =>{
        boton.addEventListener('click', (e)=>{
            paso = parseInt(e.target.dataset.paso); 
            mostrarSeccion();
            botonesPaginador();
        })
    })
}

function botonesPaginador(){
    
    const paginaAnterior = document.querySelector("#anterior");   
    const paginaSiguiente = document.querySelector("#siguiente");
    
    if(paso === 1){
        paginaAnterior.classList.add('ocultar');
    }else if(paso === 3){
        paginaAnterior.classList.remove('ocultar');
        paginaSiguiente.classList.add('ocultar');
        
        mostrarResumen();
    }else{
        paginaAnterior.classList.remove('ocultar');
        paginaSiguiente.classList.remove('ocultar');
    }

    mostrarSeccion();
}

function paginaAnterior(){
    const paginaAnterior = document.querySelector('#anterior');
    paginaAnterior.addEventListener('click', () =>{
        if(paso<=pasoInicial) return;    
        paso--;
        // console.log(paso);
        botonesPaginador();
    })
}

function paginaSiguiente(){
    const paginaSiguiente = document.querySelector('#siguiente');
    paginaSiguiente.addEventListener('click', () =>{
        if(paso>=pasoFinal) return;    
        paso++;
        // console.log(paso);        
        botonesPaginador();
    })
}

async function consultarAPI(){
    try {
        const url = 'http://localhost:3000/api/servicios';
        const resultado = await fetch(url);
        const servicios = await resultado.json();
        mostrarServicios(servicios);
        // console.log(resultado);
        // console.log(servicios);
    } catch (error) {
        console.log(error)
    }
}

function mostrarServicios(servicios){
    servicios.forEach( servicio => {
        const { id, nombre , precio} = servicio;

        const nombreServicio = document.createElement('P');
        nombreServicio.classList.add('nombre-servicio');
        nombreServicio.textContent = nombre;

        const precioServicio = document.createElement('P');
        precioServicio.classList.add('precio-servicio');
        precioServicio.textContent = `$ ${precio}`;

        const servicioDiv = document.createElement('DIV');
        servicioDiv.classList.add('servicio');
        servicioDiv.dataset.idServicio = id;
        
        servicioDiv.onclick = function(){
            seleccionarServicio(servicio);
            //callback
        }

        servicioDiv.appendChild(nombreServicio);
        servicioDiv.appendChild(precioServicio);

        document.querySelector('#servicios').appendChild(servicioDiv);
    });    
}

function seleccionarServicio(servicio){
    const {id} = servicio;
    const {servicios} = cita;    

    //Identificar al elemento que se le da click
    const servicioDiv = document.querySelector(`[data-id-servicio="${id}"]`);

    //comprobar si un servicio ya fue agregado
    if(servicios.some(agregado=> agregado.id === id)){
        //eliminarlo
        cita.servicios = servicios.filter( agregado => agregado.id !== id);
        servicioDiv.classList.remove('seleccionado');
    }else{
        //agregarlo
        cita.servicios = [...servicios, servicio];
        servicioDiv.classList.add('seleccionado');
    }
    
    console.log(cita);    
}

function nombreCliente(){
    cita.nombre = document.querySelector('#nombre').value;
}

function seleccionarFecha(){
    const inputFecha = document.querySelector('#fecha');
    inputFecha.addEventListener('input', function(evento){
        const dia = new Date(evento.target.value).getUTCDay();
        if([6,0].includes(dia)){
            evento.target.value ='';
            mostrarMensaje('Fines de semana No permitido' , 'error', '.formulario');
        }else{
            cita.fecha = evento.target.value;
        }  
    });
}

function seleccionarHora(){
    const inputHora = document.querySelector("#hora");
    //evento, callback
    inputHora.addEventListener('input', function(e) {
        const horaCita = e.target.value;
        const hora = horaCita.split(":")[0];      
        if(hora< 9 || hora>20){
            mostrarMensaje("Hora no valida","error", '.formulario');
            e.target.value="";
        }else{
            cita.hora = e.target.value;
        }
    })
}

function mostrarMensaje(mensaje, tipo, elemento, desaparece=true){

    //Previene que se genere mas de una alerta
    const alertaPrevia = document.querySelector('.alerta');
    if(alertaPrevia){
        alertaPrevia.remove();
    }

    //Scripting para crear la alerta
    const alerta = document.createElement('DIV');
    alerta.textContent = mensaje;
    alerta.classList.add('alerta');
    alerta.classList.add(tipo);

    const referencia = document.querySelector(elemento);
    referencia.appendChild(alerta);

    if(desaparece){
        //Eliminar la alerta despues de cierto tiempo
        setTimeout(()=>{
            alerta.remove();
        }, 3000);
    }   
}


function mostrarResumen(){
    const resumen = document.querySelector(".contenido-resumen");   

    //Limpiar el contenido de resumen
    while(resumen.firstChild){
        resumen.removeChild(resumen.firstChild)
    }

    if(Object.values(cita).includes('') || cita.servicios.length === 0){
        mostrarMensaje("Faltan Datos de servicios, fecha u hora", 'error', '.contenido-resumen', false);
        return;
    }

    //Scripting
    //En este punto ya se que cita tiene todos los valores llenos (nombre,fecha,hora,servicios)
    const {nombre, fecha, hora, servicios } = cita;

    const nombreCliente = document.createElement('P');
    nombreCliente.innerHTML = `<span>Nombre:</span> ${nombre}`;

    const fechaCliente = document.createElement('P');
    fechaCliente.innerHTML = `<span>Fecha:</span> ${fecha}`;

    const horaCliente = document.createElement('P');
    horaCliente.innerHTML = `<span>Hora:</span> ${hora}`;

    resumen.appendChild(nombreCliente);
    resumen.appendChild(fechaCliente);
    resumen.appendChild(horaCliente);

    servicios.forEach(servicio => {
        const {precio, nombre} = servicio;
        
        const contenedorServicio = document.createElement('DIV');
        contenedorServicio.classList.add('contenedor-servicio');

        const textoServicio = document.createElement('P');
        textoServicio.textContent = nombre;

        const precioServicio = document.createElement('P');
        precioServicio.innerHTML = `<span;>Precio: </span> ${precio}`;

        contenedorServicio.appendChild(textoServicio);
        contenedorServicio.appendChild(precioServicio);

        resumen.appendChild(contenedorServicio);
    })

}
