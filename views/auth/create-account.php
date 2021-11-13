<h1 class="page-name">Crear cuenta</h1>
<p class="page-description">Llena el siguiente formulario para crear una cuenta</p>

<form action="/create-accoumt" method="POST" class="form">
  <div class="field">
    <label for="name">Nombre</label>
    <input type="text" name="name" id="name" placeholder="Escribe tu nombre">
  </div>
  <div class="field">
    <label for="surname">Apellido</label>
    <input type="text" name="surname" id="surname" placeholder="Escribe tu apellido">
  </div>
  <div class="field">
    <label for="phone">Telefono</label>
    <input type="tel" name="phone" id="phone" placeholder="Escribe tu telefono">
  </div>
  <div class="field">
    <label for="email">Email</label>
    <input type="email" name="email" id="email" placeholder="Escribe tu correo">
  </div>
  <div class="field">
    <label for="password">Contraseña</label>
    <input type="password" name="password" id="password" placeholder="Escribe tu contraseña">
  </div>

  <input type="submit" value="Crear cuenta" class="button">

</form>

<div class="actions">
  <a href="/">¿Ya tienes una cuenta? Inicia sesión</a>
  <a href="/forgot">¿Olvidaste tu password?</a>
</div>