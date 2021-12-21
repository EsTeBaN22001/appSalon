<h1 class="page-name">Panel de administración</h1>
<p class="page-description">Panel para la administración del sitio</p>

<?php include_once(__DIR__ .  './../templates/bar.php'); ?>

<h2>Buscar citas</h2>
<div class="search">
  <form action="" class="form">
    <div class="field">
      <label for="date">Fecha</label>
      <input type="date" name="date" id="date" value="<?= $date; ?>">
    </div>
  </form>
</div>

<?php 

if(count($quotes) == 0){
  echo "<h4 style='text-align: center;'>No hay citas en esta fecha</h4>";
}

?>

<div id="quotes-admin">
  <ul class="quotes">
    <?php $quoteId = 0;
    foreach($quotes as $key => $quote):
    if($quoteId !== $quote->id): 
    $total = 0; ?>
      <li>
        <p>Id: <span><?= $quote->id; ?></span></p>
        <p>Hora: <span><?= $quote->time; ?></span></p>
        <p>Cliente: <span><?= $quote->client; ?></span></p>
        <p>Email: <span><?= $quote->email; ?></span></p>
        <p>Teléfono: <span><?= $quote->phone; ?></span></p>
        <h3>Servicios</h3>
        <?php 
        $quoteId = $quote->id; 
        endif;
        $total += $quote->price;
        ?>
        <p class="service"><?= $quote->service; ?> <span class="price">$<?= $quote->price; ?></span></p>
        <?php 
        
          $current = $quote->id;
          $next = $quotes[$key + 1]->id ?? 0;

          if(isLatest($current, $next)): ?>
            <p>Total: <span>$<?= $total; ?></span></p>
            <form action="/api/delete-quote" method="POST">
              <input type="hidden" name="id" value="<?= $quote->id; ?>">
              <input type="submit" value="Eliminar" class="button-delete">
            </form>
          <?php endif ?>
    <?php endforeach; ?>
  </ul>
</div>