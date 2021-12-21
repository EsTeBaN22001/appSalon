<h1 class="page-name">Crear servicio</h1>
<p class="page-description">Llenar todos los campos para crear un nuevo servicio</p>

<?php include_once(__DIR__ . './../templates/alerts.php'); ?>

<form action="/services/create" method="POST" class="form">

  <?php include_once(__DIR__ . './form.php'); ?>

  <input type="submit" value="Guardar servicio" class="button">
</form>