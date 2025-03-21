<h1 class="page-name">Servicios</h1>
<p class="page-description">Administración de servicios</p>

<?php include_once(__DIR__ . '/../templates/bar.php'); ?>

<ul class="services">
  <?php foreach($services as $service): ?>
    <li>
      <p>Nombre: <span><?= $service->name; ?></span></p>
      <p>Precio: <span>$<?= $service->price; ?></span></p>

      <div class="actions">
        <a class="button" href="/services/update?id=<?= $service->id; ?>">Actualizar</a>

        <form action="/services/delete" method="POST">
          <input type="hidden" name="id" value="<?= $service->id; ?>">
          <input type="submit" value="Eliminar" class="button button-delete">
        </form>
      </div>
    </li>
  <?php endforeach; ?>
</ul>