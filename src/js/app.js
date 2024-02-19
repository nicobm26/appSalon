let paso = 1;
const pasoInicial=1;
const pasoFinal=3;

document.addEventListener('DOMContentLoaded', function(){
    iniciarApp();
})

function iniciarApp(){
    mostrarSeccion();  //muestra y oculta secciones
    tabs(); //Cambia la seccion cuando se presiona los tabs
    botonesPaginador(); //agrega o quita los botones del paginador
    paginaSiguiente();
    paginaAnterior();
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