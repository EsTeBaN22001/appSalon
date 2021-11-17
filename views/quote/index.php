<h1 class="page-name">Crear nueva cita</h1>
<p class="page-description">Elige tus servicios y coloca tus datos</p>

<div id="app">
  <div class="section" id="step-1">
    <h2>Servicios</h2>
    <p class="text-center">Elige tus servicios a continuación</p>
  </div>
  <div class="section" id="step-2">
    <h2>Tus datos y citas</h2>
    <p class="text-center">Coloca tus datos y fecha de cita</p>
    <form class="form">
      <div class="field">
        <label for="name">Nombre:</label>
        <input type="text" id="name" placeholder="Tu nombre" value="<?= $name; ?>" disabled>
      </div>
      <div class="field">
        <label for="date">Fecha:</label>
        <input type="date" id="date">
      </div>
      <div class="field">
        <label for="time">Hora:</label>
        <input type="time" id="time">
      </div>
    </form>
  </div>
  <div class="section" id="step-3">
    <h2>Resumen</h2>
    <p class="text-center">Verifica que la información sea correcta</p>
  </div>
</div>