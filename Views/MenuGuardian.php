<?php
require_once 'header.php'; 
require_once 'nav.php';
require_once 'validarSesion.php';
?>

    <link property="stylesheet" rel="stylesheet" href=" <?php echo CSS_PATH . 'menuDueño-Guardian.css' ?> ">

    <main>

        <h1 class="tit">Bienvenido de nuevo @</h1>

        <div class="contenedor2">
            
            <div class="iguales">

                <a href=" <?php echo FRONT_ROOT . 'Reserva/ShowListaReservas' ?> " class="enlace"></a>

                <h2>Fechas solicitadas</h2>

                <p>Visualice las fechas que tiene solicitadas por dueños</p>

                <img class="icono" src=" <?php echo IMG_PATH . 'person.png' ?> " alt="persona">

            </div>

            <div class="iguales">

                <a href="verHistorialServOfrecidos-guardian.html" class="enlace"></a>

                <h2>Servicios ofrecidos</h2>

                <p>Mire el historial de los servicios que estuvo ofreciendo a los distintos dueños</p>

                <img class="icono" src=" <?php echo IMG_PATH . 'trabajo.png' ?> " alt="compra">

            </div>

        </div>

    </main>

    <?php require_once 'footer.php' ?>