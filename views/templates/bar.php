<div class="bar">
  <p>Hola: <?= $name ?? ''; ?></p>
  <a href="/logout" class="button">Cerrar sesión</a>
</div>

<?php if(isset($_SESSION['admin'])) : ?>

  <div class="services-bar">
    <a href="/admin" class="button">Ver citas</a>
    <a href="/services" class="button">Ver servicios</a>
    <a href="/services/create" class="button">Crear servicio</a>
  </div>

<?php endif; ?>