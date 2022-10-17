<?php
require_once 'header.php'; 
require_once 'nav.php';
?>
    <link property="stylesheet" rel="stylesheet" href=" <?php echo CSS_PATH . 'reservar-guardian.css' ?> ">

    <main class="contenedor">
        <div class="heading">

            <img class="foto" src=" <?php echo IMG_PATH . 'perfil.png' ?> " alt="Perfil">

            <h1 class="perf">Perfil</h1>

            <img class="huella" src=" <?php echo IMG_PATH . 'huellas-perro.png' ?> " alt="Huellas">

        </div>

        <div class="info-y-enviar">
            <div class="contenedor-datos ">
                    <div class="datosGuardian"><p>Nombre</p></div>
                    <div class="datosGuardian"><p>Apellido</p></div>
                    <div class="datosGuardian"><p>Edad</p></div>
                    <div class="datosGuardian"><p>Email</p></div>
                    <div class="datosGuardian"><p>Telefono</p></div>
                    <div class="datosGuardian"><p>Tamaño que cuida</p></div>
            </div>
    
            <div class="formReservaGuardian">
                <h1>Selecciona el dia</h1>
                
                <form action="" method="get">
                    <div class="inputs">
                        <input type="date" name="fechaRequerida" required>
                        <input class="horaForm timePickerInicial" type="time" name="horaInicial" required>
                        <input class="horaForm timePickerFinal" type="time" name="horaFinal" required>
                    </div>

                    <button class="" type="submit">Elegir</button>
                </form>
            </div>
        </div>
    </main>
<?php require_once 'footer.php' ?>