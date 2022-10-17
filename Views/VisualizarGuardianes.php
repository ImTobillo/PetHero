<?php
require_once 'header.php'; 
require_once 'nav.php';
require_once 'validarSesion.php';
?>

<link property="stylesheet" rel="stylesheet" href=" <?php echo CSS_PATH . 'visualizarGuardianes-Mascotas.css' ?> ">

    <main>

        <h1 class="tituloG">Guardianes</h1>

        <div class="igual">
            <img class="imagenPerf" src=" <?php echo IMG_PATH . 'ejemploGuardian1.jpg' ?> " alt="">
            <div class="info">
                <p>Julian Weich</p>
                <p>Disponibilidad</p>
                <button class="boton" type="submit">Ver perfil</button>
            </div>
        </div>

        <div class="igual">
            <img class="imagenPerf" src=" <?php echo IMG_PATH . 'ejemploGuardian2.jpg' ?> " alt="">
            <div class="info">
                <p>Marley</p>
                <p>Disponibilidad</p>
                <button class="boton" type="submit">Ver perfil</button>
            </div>
        </div>

    </main>

    <?php require_once 'footer.php' ?>