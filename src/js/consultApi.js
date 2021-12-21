// Selector estilo JQuery
const $ = $ => {return document.querySelector($)};

// Objeto con información de la cita
const quote = {
  id: '',
  name: '',
  date: '',
  time: '',
  services: []
}

if($('.tabs')){
    // LLAMADA A FUNCIONES UTILIZADAS A LO LARGO DEL PROGRAMA
  consultApi();// Función asíncroma para consultar el api creada en php
  clientId(); //Obtiene el nombre del cliente y lo asigna al objeto global de quote
  clientName();// Obtiene el nombre del cliente y lo asigna al objeto global de quote
  selectDate();// Seleccionar y guardar la fecha en el objeto de quote
  selectTime();//Seleccionar y guardar la hora en el objeto de quote
  showSummary();//Mostrar el resumen de la cita
}

// Función asíncroma para consultar el api creada en php
async function consultApi(){

  try {

    const url = 'http://localhost:3000/api/services';
    const result = await fetch(url);
    const services = await result.json();

    showServices(services);

  } catch (error) {
    console.log(error);
  }

}

// Función para mostrar los servicios obtenidos de consultApi
function showServices(services){

  services.forEach(service => {

    const {id, name, price} = service;

    const nameService = document.createElement('p');
    nameService.classList.add('name-service');
    nameService.textContent = name;
    
    const priceService = document.createElement('p');
    priceService.classList.add('price-service');
    priceService.textContent = `$${price}`;

    const serviceContainer = document.createElement('div');
    serviceContainer.classList.add('service');
    serviceContainer.dataset.serviceId = id;
    serviceContainer.appendChild(nameService);
    serviceContainer.appendChild(priceService);

    // Asociar un evento a los servicios
    serviceContainer.onclick = function(){
      selectService(service);
    }
    
    $('#services').appendChild(serviceContainer);

  })

}

// Función para seleccionar un servicio y llenar el objeto de cita(quote)
function selectService(service){

  const {id} = service;
  const {services} = quote;

  const serviceId = $(`[data-service-id="${id}"]`);

  if(services.some( agregated => agregated.id === id )){
    quote.services = services.filter( agregated => agregated.id !== id );
    serviceId.classList.remove('selected');
  }else{
    quote.services = [...services, service];
    serviceId.classList.add('selected');
  }

}

function clientId(){
  quote.id = $('#id').value;
}

// Obtiene el nombre del cliente y lo asigna al objeto global de quote
function clientName(){
  quote.name = $('#name').value;
}

// Seleccionar y guardar la fecha en el objeto de quote
function selectDate(){

  const inputDate = $('#date');

  inputDate.addEventListener('input', function(e){
    
    const day = new Date(e.target.value).getUTCDay();

    if( [6, 0].includes(day) ){
      quote.date = '';
      showAlert('Fines de semana no permitidos', 'error', '.form');
    }else{
      quote.date = e.target.value;
    }

  })
}

// Seleccionar y guardar la hora en el objeto de quote
function selectTime(){

  const inputTime = $('#time');
  inputTime.addEventListener('input', function(e){
    
    const hourQuote = e.target.value.split(":")[0];

    if(hourQuote < 9 || hourQuote > 21){
      e.target.value = '';
      showAlert('Hora no válida', 'error', '.form');
    }else{
      quote.time = e.target.value;
    }

  })

}

// Función para mostrar una alerta
function showAlert(message, type, element, dysappear = true){

  // Previene que se generen más de una alerta
  const previousAlert = $('.alert');
  if(previousAlert){
    previousAlert.remove();
  }
  
  const alert = document.createElement('div');
  alert.textContent = message;
  alert.classList.add('alert');
  alert.classList.add(type);

  const elementDiv = $(element);
  elementDiv.appendChild(alert);

  if(dysappear){
    setTimeout(() => {
      alert.remove();
    }, 3000);
  }
  
}

// Muestra el resumen de la cita(quote)
function showSummary(){

  const summary = $('.summary-content');

  // Limpiar el contenido de resumen
  while(summary.firstChild){
    summary.removeChild(summary.firstChild);
  }

  if( Object.values(quote).includes('') || quote.services.length === 0 ){
    showAlert('Faltan datos de servicios, hora o fecha', 'error', '.summary-content', false);
    return;
  }

  const { name, date, time ,services } = quote;

  const clientName = document.createElement('p');
  clientName.innerHTML = `<span>Nombre:</span> ${name}`;

  // Formatear fecha
  const formatedDate = formatDate(date);

  const clientDate = document.createElement('p');
  clientDate.innerHTML = `<span>Fecha:</span> ${formatedDate}`;

  const clientTime = document.createElement('p');
  clientTime.innerHTML = `<span>Hora:</span> ${time} hs`;

  // Heading para los servicios en resumen(summary)
  const servicesHeader = document.createElement('h3');
  servicesHeader.textContent = 'Resumen de servicios';
  summary.appendChild(servicesHeader);

  // Iterando y mostrando los servicios
  services.forEach(service => {

    const { id, name, price } = service;

    const serviceContainer = document.createElement('div');
    serviceContainer.classList.add('service-container');

    const serviceText = document.createElement('p');
    serviceText.textContent = name;

    const servicePrice = document.createElement('p');
    servicePrice.innerHTML = `<span>Precio:</span> $${price}`;

    serviceContainer.appendChild(serviceText);
    serviceContainer.appendChild(servicePrice);

    summary.appendChild(serviceContainer);

  })

  // Heading para cita en resumen(summary)
  const quoteHeader = document.createElement('h3');
  quoteHeader.textContent = 'Resumen de cita';
  summary.appendChild(quoteHeader);

  // Botón para crear una cita
  const reserveButton = document.createElement('button');
  reserveButton.classList.add('button');
  reserveButton.textContent = 'Reservar cita';
  reserveButton.onclick = reserveQuote;

  summary.appendChild(clientName);
  summary.appendChild(clientDate);
  summary.appendChild(clientTime);
  summary.appendChild(reserveButton);

}

// Formater la fecha sin modificar el objeto original
function formatDate(date){
  const dateObj = new Date(date);
  const year = dateObj.getFullYear();
  const month = dateObj.getMonth();
  const day = dateObj.getDate() + 2;

  // Convertir fecha a UTC
  const dateUTC = new Date(Date.UTC(year, month, day));
  const options = {weekday: 'long', day: 'numeric', month: 'long', year: 'numeric'}
  const formatedDate = dateUTC.toLocaleDateString('es-AR', options);
  return formatedDate;
}

// Reservar cita(quote)
async function reserveQuote(){

  const { id, name, date, time, services } = quote;

  const idServices = services.map(service => service.id);

  const data = new FormData();
  
  data.append('userId', id);
  data.append('date', date);
  data.append('time', time);
  data.append('services', idServices);

  try{
    // Petición hacia la API
    const url = 'http://localhost:3000/api/quotes';
    const response = await fetch(url, {
      method: 'POST',
      body: data
    });
    const result = await response.json();
    
    if(result.result){
      Swal.fire(
        'Correcto!',
        'Se guardó su cita correctamente!',
        'success'
      ).then(()=>{
        window.location.reload();
      })
    }
  }catch(error){
    Swal.fire({
      icon: 'error',
      title: 'Error',
      text: 'Hubo un error al guardar la cita'
    })
  }

}