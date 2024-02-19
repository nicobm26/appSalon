let paso = 1;

document.addEventListener('DOMContentLoaded', function(){
    iniciarApp();
})

function iniciarApp(){
    mostrarSeccion();  //muestra y oculta secciones
    tabs(); //Cambia la seccion cuando se presiona los tabs
    botonesPaginador(); //agrega o quita los botones del paginador
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
        })
    })
}
