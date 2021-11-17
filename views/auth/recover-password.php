<h1 class="page-name">Recuperar contraseña</h1>
<p class="page-description">Coloca tu nueva contraseña a continuación</p>

<?php include_once __DIR__ . '/../templates/alerts.php'; 

if($error) return;
?>

<form class="form" method="POST">
  <div class="field">
    <label for="password">Contraseña</label>
    <input type="password" id="password" name="password" placeholder="Escribe tu nueva contraseña">
  </div>
  <input type="submit" value="Guardar la nueva contraseña" class="button">
</form>

<div class="actions">
  <a href="/forgot">¿Ya tienes cuenta? Inicia sesión</a>
  <a href="/create-account">¿Aún no tienes una cuenta? Crear una</a>
</div>