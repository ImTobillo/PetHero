<?php
require_once 'header.php'; 
require_once 'nav.php';

use DAO\TarjetaDAO as TarjetaDAO;
$tarjetasDAO = new TarjetaDAO();
$tarjetas = $tarjetasDAO->getAllByIdDuenio($_SESSION['loggedUser']->getId());
?>

    <link property="stylesheet" rel="stylesheet" href=" <?php echo CSS_PATH . 'pagar.css?v=4' ?> ">

    <main>
        <div class="contenedor">

            <form class="formulario" action="<?php echo FRONT_ROOT . 'Reserva/confirmarReserva'?>" method="post">

            <h1>Cupon de pago</h1>
                
                <div class="item1">
                    <h3>Numero de comprobante: <?php echo $pago->getIdPago()?></h3>
                </div>

                <div class="item2">
                    <h3>Fecha de emision: <?php echo $pago->getFecha()?></h3>
                </div>

                <div class="item3">
                    <h3>Importe a pagar: <?php echo $pago->getMonto() / 2?></h3>
                </div>

                <div class="item4">
                    <h3>Seleccionar tarjeta</h3>
                    <select name="tarjeta" id="" required>
                        <?php foreach($tarjetas as $tarjeta){ ?>
                            <option value="<?php echo $tarjeta->getIdTarjeta();?>"><?php echo $tarjeta->getNroTarjeta();?></option>
                            <?php } ?>
                    </select>
                    <p>¿No tiene tarjetas cargadas?</p>
                    <a class="button" href="<?php echo FRONT_ROOT . 'Tarjeta/ShowAddTarjeta?IdPago = '. $pago->getIdPago() ; ?>">Cargar tarjeta</a>
                </div>                

                <div class="item5">
                    <button class="button" type="submit" name="idPago" value="<?php echo $pago->getIdPago();?>">Confirmar pago</button>                
                </div>

            </form>

        </div>
    </main>

<?php require_once 'footer.php'?>