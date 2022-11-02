<?php
require_once 'header.php';
require_once 'nav.php';


?>

<link property="stylesheet" rel="stylesheet" href=" <?php echo CSS_PATH . 'verFechasSolicitadas.css' ?> ">

<main>

    <h1 class="tituloG">Fechas solicitadas</h1>

    <?php
    if (!empty($listaReservas)) { // guardian recibe solo mascotas que coincidan con el tamaño que cuida (validacion hecha ya en lado del dueño)
        foreach ($listaReservas as $reserva) {
            
            if (($reserva->getEstado() == null) && ($reserva->getId_guardian() == $_SESSION['loggedUser']->getId())){
                
                $mascota = $this->mascotaDAO->getById($reserva->getId_mascota());
    ?>
            <div class="igual">
                <img class="imagenPerf" src="<?php echo IMG_PATH . 'ImgMascotas/' . $mascota->getImgPerro();?>" alt="foto perro">
                <div class="info">
                    <h2><?php echo 'Fecha Inicial: ' . date("d-m-y", strtotime($reserva->getFechaInicio()))?></h2>
                    <h2><?php echo 'Fecha Final: ' . date("d-m-y", strtotime($reserva->getFechaFinal()))?></h2>
                    <h2><?php echo 'Hora: ' . $reserva->getHora_inicio() . ' - ' . $reserva->getHora_final();?></h2>
                    <p><?php echo 'Nombre de Mascota: ' . $mascota->getNombre(); ?></p>
                    <p><?php echo 'Tamaño: ' . $mascota->getTamaño(); ?></p>
                    <p><?php echo 'Edad: ' . $mascota->getEdad();  ?></p>
                    <p><?php echo 'Raza: ' . $mascota->getRaza();  ?></p>
                    <div class="Aceptar-Rechazar">
                        <?php if($this->puedeAceptarRaza($reserva)){ ?>
                            <button type="button">
                                <a href="<?php echo FRONT_ROOT . 'Reserva/aceptarReserva?id=' . $reserva->getId_reserva(); ?>"
                                    >Aceptar
                                </a>
                            </button>
                        <?php } ?>
                        <button type="button"><a href="<?php echo FRONT_ROOT . 'Reserva/rechazarReserva?id=' . $reserva->getId_reserva(); ?>">Rechazar</a></button>
                    </div>
                </div>
            </div>

    <?php }
        }
    } ?>



</main>

<?php require_once 'footer.php' ?>