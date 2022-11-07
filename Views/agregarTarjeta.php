<?php 
require_once 'header.php'; 
require_once 'nav.php';
?>

<main>
        <link property="stylesheet" rel="stylesheet" href=" <?php echo CSS_PATH . 'agregarTarjeta.css' ?> ">

        <div class="contenedor">
        <div><h1>Datos tarjeta</h1></div>
        <form class="formulario" action="<?php echo FRONT_ROOT . 'Tarjeta/agregarTarjeta'?>" method="post">
            
                
                <div class="item1">
                    <label for="">Tipo de tarjeta</label>
                    <select name="tipoTarjeta" required>
                        <option value="credito">Tarjeta de credito</option>
                        <option value="debito">Tarjeta de debito</option>
                    </select>
                </div>

                <div class="item2">
                    <label for="">Titular de la tarjeta</label>
                    <input type="text" name="titular" required>
                </div>

                <div class="item3">
                    <label for="">Numero tarjeta</label>
                    <input type="number" name="nroTarjeta" min='1000000000000000' required>
                </div>

                <div class="item4">
                    <label for="">Codigo de seguridad</label>
                    <input type="number" name="codSeguridad" min='100' max='999' required>
                </div>

                <div class="item5">
                    <label for="">Fecha de vencimiento</label>
                    <input type="text" name="fechaVencimiento" placeholder="mm/dd">
                </div>

                <div class="item9">
                    <button class="button" type="submit">Agregar tarjeta</button>
                </div>
        </form>

        </div>
                
</main>