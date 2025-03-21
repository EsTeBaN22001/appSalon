<h1 class="page-name">Crear nueva cita</h1>
<p class="page-description">Elige tus servicios y coloca tus datos</p>

<?php include_once(__DIR__ .  '/../templates/bar.php'); ?>

<div id="app">
  <nav class="tabs">
    <button class="current" type="button" data-step="1">Servicios</button>
    <button type="button" data-step="2">Información cita</button>
    <button type="button" data-step="3">Resumen</button>
  </nav>
  <div class="section show" id="step-1">
    <h2>Servicios</h2>
    <p class="text-center">Elige tus servicios a continuación</p>
    <div id="services" class="services-list"></div>
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
        <input type="date" id="date" min="<?= date('Y-m-d', strtotime('+1 day')); ?>">
      </div>
      <div class="field">
        <label for="time">Hora:</label>
        <input type="time" id="time">
      </div>
      <input type="hidden" id="id" value="<?= $id; ?>">
    </form>
  </div>
  <div class="section summary-content" id="step-3">
    <h2>Resumen</h2>
    <p class="text-center">Verifica que la información sea correcta</p>
  </div>
  <div class="pagination">
    <button id="previous" class="button opacity0">&laquo; Anterior</button>
    <button id="next" class="button">Siguiente &raquo;</button>
  </div>
</div>