<?php
require_once 'header.php';
require_once 'nav.php';
?>

<link property="stylesheet" rel="stylesheet" href=" <?php echo CSS_PATH . 'verHistorialServOfrecidos-guardian.css' ?> " />

<main>
  <div class="contenedor">
    <h1 class="tit">Servicios aceptados</h1>

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
          <?php
          if (!empty($listaReservas)) {
            foreach ($listaReservas as $reserva) {
              if (($_SESSION["loggedUser"]->getId() == $reserva->getId_guardian()) && ($reserva->getEstado() == "Aceptado") && (strtotime($reserva->getFechaFinal())> date("y-m-d"))) { {
                  //$pago = $this->pagoDAO->getById($reserva->getId_pago());
                $dueño = $this->dueñoDAO->getById($reserva->getId_dueño());
                $mascota = $this->mascotaDAO->getById($reserva->getId_mascota()); ?>
                <tr>
                  <td><?php echo date("d-m-y"); //$pago->getFecha(); ?></td>
                  <td><?php echo $reserva->getId_reserva(); ?></td>
                  <td><?php echo $dueño->getNombre() . ' ' . $dueño->getApellido(); ?></td>
                  <td><?php echo $dueño->getDni(); ?></td>
                  <td><?php echo $mascota->getNombre(); ?></td>
                  <td><?php echo $mascota->getRaza(); ?></td>
                  <td><?php echo 
                  (((((new DateTime($reserva->getHora_inicio()))->diff((new DateTime($reserva->getHora_final()))))->format('%i') >= 120) // si la reserva es por mas de dos horas
                      ? ((new DateTime($reserva->getHora_inicio()))->diff((new DateTime($reserva->getHora_final()))))->format('%H') 
                      : 1) 
                    
                    * (($reserva->getFechaInicio() != $reserva->getFechaFinal()) 
                      ? ((new DateTime($reserva->getFechaInicio()))->diff((new DateTime($reserva->getFechaFinal()))))->format('%D') 
                      : 1)
                    
                    * 1 /* monto por hora */); ?></td> <!-- $pago->getMonto() -->
                </tr>
          <?php }
              }
            }
          } ?>
        </tbody>
        <tfoot>
          <tr>
            <td colspan="7">Todos los datos actualizados al día '...'.</td>
          </tr>
        </tfoot>
      </table>
    </div>

    <h1 class="tit">Servicios ya ofrecidos</h1>

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
          <?php
          if (!empty($listaReservas)) {
            foreach ($listaReservas as $reserva) {
              if (($_SESSION["loggedUser"]->getId() == $reserva->getId_guardian()) && ($reserva->getEstado() == "Aceptado") && (strtotime($reserva->getFechaFinal()) <= date("y-m-d"))) {
                //$pago = $this->pagoDAO->getById($reserva->getId_pago());
                $dueño = $this->dueñoDAO->getById($reserva->getId_dueño());
                $mascota = $this->mascotaDAO->getById($reserva->getId_mascota()); ?>
                <tr>
                  <td><?php echo date("d-m-y"); //$pago->getFecha(); 
                      ?></td>
                  <td><?php echo $reserva->getId_reserva(); ?></td>
                  <td><?php echo $dueño->getNombre() . $dueño->getApellido(); ?></td>
                  <td><?php echo $dueño->getDni(); ?></td>
                  <td><?php echo $mascota->getNombre(); ?></td>
                  <td><?php echo $mascota->getRaza(); ?></td>
                  <td><?php echo (((((new DateTime($reserva->getHora_inicio()))->diff((new DateTime($reserva->getHora_final()))))->format('%i') >= 120) // si la reserva es por mas de dos horas
                        ? ((new DateTime($reserva->getHora_inicio()))->diff((new DateTime($reserva->getHora_final()))))->format('%H')
                        : 1)

                        * (($reserva->getFechaInicio() != $reserva->getFechaFinal())
                          ? ((new DateTime($reserva->getFechaInicio()))->diff((new DateTime($reserva->getFechaFinal()))))->format('%D')
                          : 1)

                        * $_SESSION["loggedUser"]->getRemuneracion() /* monto por hora */); ?></td> <!-- $pago->getMonto() -->
                </tr>
          <?php }
            }
          } ?>
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