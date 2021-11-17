<h1 class="page-name">Recuperar contraseña</h1>
<p class="page-description">Reestablece tu contraseña escribiendo tu correo a continuación</p>

<?php include_once __DIR__ . '/../templates/alerts.php'; ?>

<form action="/forgot" method="POST" class="form">
  <div class="field">
    <label for="email">Email</label>
    <input type="email" name="email" id="email" placeholder="Escribe tu correo">
  </div>
  <input type="submit" value="Enviar instrucciones" class="button">
</form>

<div class="actions">
  <a href="/">¿Ya tienes una cuenta? Inicia sesión</a>
  <a href="/create-account">¿Aún no tienes una cuenta? Crea una</a>
</div>