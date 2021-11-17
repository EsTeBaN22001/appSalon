let step = 1;

// Selector estilo JQuery
const $ = $ => {return document.querySelector($)}


document.addEventListener('DOMContentLoaded', function(){
  startApp();
})

function startApp(){

  // Cambia la sección cuando se presionene los tabs
  tabs();

  // Agrega o quita los botones inferiores del paginador
  paginatorButtons();

  // Función para el botón de pagina anterior
  previousPage();

  // Función para el botón de pagina siguiente
  nextPage();
}

function tabs(){
  
  const tabs = $('.tabs');

  // Detecta a que elemento(tab) se le ha dado click
  tabs.addEventListener('click', function(e){
    step = parseInt(e.target.dataset.step);
    showSection();
  });

}

// Muestra la sección que esté asignada a cada step
function showSection(){

  // Ocultar la sección que tiene la clase de mostrar
  const previousSection = $('.show');
  previousSection.classList.remove('show');
  
  // Seleccionar la section según el paso que le corresponda
  const section = $(`#step-${step}`);
  
  // Añadir la clase mostrar para que se vea la sección en el DOM
  section.classList.remove('hide');
  section.classList.add('show');

  // Quitar la clase al tab anterior para resaltar el siguiente
  const previousTab = $('.current');
  previousTab.classList.remove('current');
  
  // Resaltar el tab acutal
  const tab = $(`[data-step="${step}"]`);
  tab.classList.add('current');

  // Mostrar u ocultar los botones según la página que se muestre al presionar los tabs
  paginatorButtons();

}

// Agrega o quita los botones inferiores del paginador
function paginatorButtons(){

  // Selecciono los botones de anterior y siguiente
  const previousPage = $('#previous');
  const nextPage = $('#next');

  if(step === 1){
    previousPage.classList.add('opacity0');
    nextPage.classList.remove('opacity0');
  }

  if(step === 2){
    previousPage.classList.remove('opacity0');
    nextPage.classList.remove('opacity0');
  }

  if(step === 3){
    nextPage.classList.add('opacity0');
    previousPage.classList.remove('opacity0');
  }
  
}

// Función para el botón de pagina anterior
function previousPage(){

  const previousPage = $('#previous');
  previousPage.addEventListener('click', function(){
    step--;
    showSection();
  })

}

// Función para el botón de página siguiente
function nextPage(){

  const nextPage = $('#next');
  nextPage.addEventListener('click', function(){
    step++;
    showSection();
  })

}