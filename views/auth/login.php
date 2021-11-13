<h1 class="page-name">Login</h1>
<p class="page-description">Inicia sesión con tus datos</p>

<form action="/" method="POST" class="form">
  <div class="field">
    <label for="email">Email</label>
    <input type="email" name="email" id="email" placeholder="Escribe tu email">
  </div>
  <div class="field">
    <label for="password">Contraseña</label>
    <input type="password" name="password" id="password" placeholder="Escribe tu contraseña">
  </div>

  <input type="submit" value="iniciar sesión" class="button">
</form>

<div class="actions">
  <a href="/create-account">¿Aún no tienes una cuenta? Crear una</a>
  <a href="/forgot">¿Olvidaste tu password?</a>
</div>