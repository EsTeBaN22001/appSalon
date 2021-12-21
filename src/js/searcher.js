if($('.search')){

  const inputDate = $('#date');
  
  inputDate.addEventListener('input', function(e){
    
    const selectedDate = e.target.value;
    
    window.location = `?date=${selectedDate}`;

  })

}