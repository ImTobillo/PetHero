<?php
require_once 'header.php';
require_once 'nav.php';

?>

<link property="stylesheet" rel="stylesheet" href=" <?php echo CSS_PATH . 'verHistorialServOfrecidos-guardian.css' ?> " />

<main>
  <div class="contenedor">
    <h1 class="tit">Historial de servicios ofrecidos</h1>

    <div class="contInfo">
      <table>
        <thead>
          <tr>
            <th>Fecha de cobro</th>
            <th>Comprobante Nº</th>
            <th>Nombre del dueño</th>
            <th>DNI</th>
            <th>Nombre de la mascota</th>
            <th>Raza</th>
            <th>Monto</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>20/11/2021</td>
            <td>1002203</td>
            <td>Tobias Noya</td>
            <td>44562987</td>
            <td>Napo</td>
            <td>Collie</td>
            <td>1000</td>
          </tr>
          <?php
            if (!empty($listaReservas)){
              foreach ($listaReservas as $reserva) { 
              $pago = $this->pagoDAO->getById($reserva->getId_pago());
              $dueño = $this->dueñoDAO->getById($reserva->getId_dueño());
              $mascota = $this->mascotaDAO->getById($reserva->getId_mascota());?>
              <tr>
                <td><?php echo $pago->getFecha();?></td>
                <td><?php echo $reserva->getId_reserva();?></td>
                <td><?php echo $dueño->getNombre() . $dueño->getApellido();?></td>
                <td><?php echo $dueño->getDni();?></td>
                <td><?php echo $mascota->getNombre();?></td>
                <td><?php echo $mascota->getRaza();?></td>
                <td><?php echo $pago->getMonto();?></td>
              </tr>
            <?php }} ?>
        </tbody>
        <tfoot>
          <tr>
            <td colspan="7">Todos los datos actualizados al día '...'.</td>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
</main>

<?php require_once 'footer.php' ?>