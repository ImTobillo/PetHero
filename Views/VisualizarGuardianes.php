<?php

use Models\Guardian;

require_once 'header.php'; 
require_once 'nav.php';
require_once 'validarSesion.php';
?>

<link property="stylesheet" rel="stylesheet" href=" <?php echo CSS_PATH . 'visualizarGuardianes-Mascotas.css' ?> ">

    <main>

        <h1 class="tituloG">Guardianes</h1>

        <?php foreach ($guardianList as $guardian) 
            { ?>
            <div class="igual">
                <img class="imagenPerf" src="http://www.gentedecanaveral.com/wp-content/uploads/2016/05/DATA_ART_8378410_VERTIL.jpg" alt="">
                <div class="info">
                    <p> <?php echo $guardian->getNombre(); ?> </p>
                    <p> <?php echo $guardian->getDiasDisponibles(); ?> </p>
                    <button class="boton" type="submit">Ver perfil</button>
                </div>
            </div>
    <?php  } ?>
    </main>

    <?php require_once 'footer.php' ?>