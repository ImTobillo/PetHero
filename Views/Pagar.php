<?php
require_once 'header.php'; 
require_once 'nav.php';
?>

    <link property="stylesheet" rel="stylesheet" href=" <?php echo CSS_PATH . 'pagar.css' ?> ">

    <main>
        <div class="contenedor">

            <form class="formulario" action="<?php echo FRONT_ROOT . 'Pago/pagar'?>" method="post">

                <div>
                    <h3>Numero de comprobante</h3>
                    <p><?php /*echo $pago->getIdPago()*/?></p>
                </div>

                <div class="item5">
                    <h3>Importe a pagar</h3>
                    <p><?php /*echo $pago->getMonto()*/?></p>
                </div>

                <div class="item6">
                    <label for="">Metodo de pago</label>
                    <select name="tipoTarjeta" required>
                        <option value="credito">Tarjeta de credito</option>
                        <option value="debito">Tarjeta de debito</option>
                    </select>
                </div>

                <div>
                    <label for="">Titular</label>
                    <input type="text" name="titular" required>
                </div>

                <div class="item7">
                    <label for="">Numero tarjeta</label>
                    <input type="number" name="nroTarjeta" min='1000000000000000' required>
                </div>

                <div class="item8">
                    <label for="">Codigo de seguridad</label>
                    <input type="number" name="codSeguridad" min='100' max='999' required>
                </div>

                <div>
                    <label for="">Fecha de vencimiento</label>
                    <input type="text" name="fechaVencimiento" placeholder="mm/dd">
                </div>

                <div class="item9">
                    <button type="submit">Confirmar pago</button>
                </div>

            </form>

        </div>
    </main>

<?php require_once 'footer.php'?>