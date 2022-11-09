<?php

use Models\Guardian;

require_once 'header.php'; 
require_once 'nav.php';

?>

<link property="stylesheet" rel="stylesheet" href=" <?php echo CSS_PATH . 'visualizarGuardianes-Mascotas.css' ?> ">

    <main>

        <h1 class="tituloG">Guardianes</h1>
        <div>
            <!-- FILTRAR GUARDIANES POR FECHA DE DISPONIBILIDAD !-->
            <form action="<?php echo FRONT_ROOT . 'Guardian/filtrarGuardianes'?>" method="post">
                <h3>Filtrar disponibilidad</h3>
                <div class="contenedorFecha">
                    <label for="">Fecha inicio</label> 
                    <input class="datePickerInicio" id="inputFechaInicio"  name="fechaInicio" oninput="validarFecha()" type="date" min="<?php echo date("Y-m-d"); ?>">
                    <label for="">Fecha final</label>
                    <input class="datePickerFinal" id="inputFechaFinal"  name="fechaFinal" disabled type="date" min="<?php echo date("Y-m-d"); ?>">
                </div> 
                <button class="button" type="submit">Filtrar</button>
            </form>  
        </div>
        

        <?php foreach ($guardianList as $guardian) 
            { ?>
            <div class="igual">
                <img class="imagenPerf" src="http://www.gentedecanaveral.com/wp-content/uploads/2016/05/DATA_ART_8378410_VERTIL.jpg" alt="">
                <div class="info">

                    <p> <?php echo $guardian->getNombre(); ?> </p>
                    <p>Disponibilidad: </p>
                    <p> <?php echo $guardian->getFechaInicio() . ' - ' . $guardian->getFechaFinal(); ?></p>
                    <p> <?php echo $guardian->getTamaño(); ?> </p>

                    <form action="<?php echo FRONT_ROOT . 'Duenio/ShowViewReservar'?>" method="post">
                        <button class="boton" type="submit" name="id_guardian" value="<?php echo $guardian->getId(); ?>">Ver perfil</button>
                    </form>
                    
                </div>
            </div>
     <?php  } ?>
    </main>
    <script src="<?php echo JS_PATH . "validar.js" ?>"></script> 

    <?php require_once 'footer.php' ?>