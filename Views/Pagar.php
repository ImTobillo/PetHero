<?php
require_once 'header.php'; 
require_once 'nav.php';
?>

    <link property="stylesheet" rel="stylesheet" href=" <?php echo CSS_PATH . 'pagar.css' ?> ">

    <main>
        <div class="contenedor">

            <form class="formulario" action="" method="">

                <!-- <div class="item1">
                    <label for="">Fecha de pago</label>
                    <input type="text" name="" id="">
                </div> se crea automaticamente ¿?  -->  

                <div class="item6">
                    <label for="">Metodo de pago</label>
                    <select name="" id="">
                        <option value="">Tarjeta de credito</option>
                        <option value="">Tarjeta de debito</option>
                    </select>
                </div>

                <div class="item2">
                    <label for="">Numero comprobante</label>
                    <input type="text" name="" id="">
                </div>

                <div class="item7">
                    <label for="">Numero tarjeta</label>
                    <input type="text" name="" id="">
                </div>

                <!-- <div class="item3">
                    <label for="">Propina</label>
                    <input type="text" name="" id="">
                </div> -->

                <div class="item8">
                    <label for="">Codigo de seguridad</label>
                    <input type="text" name="" id="">
                </div>

                <div class="item4">
                    <label for="">Documento</label>
                    <input type="text" name="" id="">
                </div>

                <div class="item5">
                    <label for="">Importe total</label>
                    <input type="text" name="" id="">
                </div>

                <div class="item9">
                    <button type="submit">Confirmar pago</button>
                </div>

            </form>

        </div>
    </main>

<?php require_once 'footer.php'?>