<?php
require_once 'header.php'; 
require_once 'nav.php';

use DAO\GuardianDAO as GuardianDAO;
use DAO\MascotaDAO as MascotaDAO;
use DAO\PagoDAO as PagoDAO;
$guardianesDAO = new GuardianDAO();
$mascotasDAO = new MascotaDAO();
$pagoDAO = new PagoDAO();
?>

    <link property="stylesheet" href=" <?php echo CSS_PATH . 'verPagosPendientes.css' ?> " rel="stylesheet">

    <main>
        <div class="contenedor">
            <h1>Pagos pendientes</h1>

            <div class="padre">

            <?php foreach ($reservas as $reserva) { ?>

                    <div class="hijo">
                        <h2>Guardian: 
                            <?php 
                            $guardian = $guardianesDAO->getById($reserva->getId_guardian());
                            echo $guardian->getNombre(); 
                            ?></h2>
                        <h3>Mascota: 
                            <?php 
                            $mascota = $mascotasDAO->getById($reserva->getId_mascota());
                            echo $mascota->getNombre();
                            ?></h3>
                        <h3>Estado: <?php echo $reserva->getEstado(); ?></h3>
                        
                        <!--ACA MUESTRO SI ESTADO ES ACEPTADO!-->
                        <?php if($reserva->getEstado() == 'Aceptado'){ ?>
                            <!--<h3>Monto a pagar: 
                                <?php 
                                /*$pago = $pagoDAO->getById($reserva->getIdPago());
                                echo $pago->getMonto();*/
                                ?></h3>!-->
                            <form action="<?php echo FRONT_ROOT . 'Pago/ShowPagar'?>" method="post">
                               <button type="submit" name='idPago' value='<?php /*echo $reserva->getIdPago()*/?>'>Pagar</button> 
                            </form>
                        <?php } else if($reserva->getEstado() == 'Rechazado') { ?>
                            <!--ACA MUESTRO SI ESTADO ES RECHAZADO!-->
                            <form action="<?php echo FRONT_ROOT . 'Reserva/borrarReserva'?>" method="post">
                               <button type="submit" name='idReserva' value='<?php echo $reserva->getId_reserva();?>'>Aceptar</button> 
                            </form>
                            
                        <?php } else if($reserva->getEstado() == 'Confirmada'){ ?>
                            <h3>Fecha inicio: <?php echo $reserva->getFechaInicio();?></h3>
                            <h3>Fecha final: <?php echo $reserva->getFechaFinal();?></h3>
                            <h3>Horario: <?php echo $reserva->getHora_inicio() . '-' . $reserva->getHora_final();?></h3>
                        <?php } 
                                else{ }?>
                                
                        
                    </div>
                
            <?php } ?>
                
            </div>
        </div>
    </main>

    <?php require_once 'footer.php' ?>