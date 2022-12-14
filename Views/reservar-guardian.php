<?php
require_once 'header.php';
require_once 'nav.php';

use DAO\GuardianDAO as GuardianDAO;
use DAO\MascotaDAO as MascotaDAO;

$listaGuardianes = new GuardianDAO();
$guardian = $listaGuardianes->getById($id_guardian);

$listaMascotas = new MascotaDAO();
$mascotasDuenio = $listaMascotas->getAll();

?>
<link rel="stylesheet" href=" <?php echo CSS_PATH . 'reservar-guardian.css?v=32' ?> ">


<main class="contenedor">

    <div class="heading">

        <img class="foto" src=" <?php echo IMG_PATH . 'perfil.png' ?> " alt="Perfil">

        <h1 class="perf"><?php echo $guardian->getNombre() ?></h1>

        <img class="huella" src=" <?php echo IMG_PATH . 'huellas-perro.png' ?> " alt="Huellas">

    </div>
    <div class="info-y-enviar">

        <!-- INFORMACIÓN GUARDIAN !-->
        <div class="contenedor-datos ">
            <div class="datosGuardian">
                <p>Nombre: <?php echo $guardian->getNombre(); ?></p>
            </div>
            <div class="datosGuardian">
                <p>Apellido: <?php echo $guardian->getApellido(); ?></p>
            </div>
            <div class="datosGuardian">
                <p>Fecha de nacimiento: <?php echo $guardian->getfechaNacimiento(); ?></p>
            </div>
            <div class="datosGuardian">
                <p>Email: <?php echo $guardian->getEmail(); ?></p>
            </div>
            <div class="datosGuardian">
                <p>Telefono: <?php echo $guardian->getTelefono(); ?></p>
            </div>
            <div class="datosGuardian">
                <p>Tamaño de mascota: <?php echo $guardian->getTamaño(); ?></p>
            </div>
            <div class="datosGuardian">
                <p>Precio por hora: $<?php echo $guardian->getRemuneracion(); ?></p>
            </div>
            <div class="datosGuardian">
                <p>Horario: <?php echo $guardian->getHoraDisponible(); ?></p>
            </div>
        </div>

        <!-- SOLICITUD RESERVA !-->
        <div class="formReservaGuardian">
            <h1>Solicitar reserva</h1>

            <form class='reservar' action="<?php echo FRONT_ROOT . 'Reserva/solicitarReserva' ?>" method="post">

                <div class="inputs">

                    <?php
                    //valido que fecha es menor para saber cual es el minimo de fecha inicial
                    if ($guardian->getFechaInicio() < date("Y-m-d")) {
                        //la fecha de inicio del guardian ya pasó, el minimo es la fecha de hoy
                        $fecha_inicio = date("Y-m-d");
                    } else {
                        //la fecha de inicio del guardian todavía no pasó, el minimo será esa fecha
                        $fecha_inicio = $guardian->getFechaInicio();
                    }
                    ?>

                    <!-- INGRESAR FECHAS !-->

                    <label>Fecha inicial
                        <input class="datePickerInicio" id="inputFechaInicio" name="fechaInicio" oninput="validarFecha()" type="date" min="<?php echo $fecha_inicio; ?>" max="<?php echo $guardian->getFechaFinal(); ?>" required>
                    </label>
                    <label>Fecha final
                        <input class="datePickerFinal" id="inputFechaFinal" name="fechaFinal" disabled type="date" max="<?php echo $guardian->getFechaFinal(); ?>" required>
                    </label>
                </div>

                <!-- INGRESAR HORARIOS !-->
                <div class="inputs">

                    <?php $array = explode("-", $guardian->getHoraDisponible() ?? ""); ?>
                    <label>Hora inicial
                        <input class="horaForm timePickerInicial" id="inputHoraInicio" type="time" name="horaInicial" oninput="validarHora();" min=<?php echo $array[0] ?> max=<?php echo $array[1] ?> required>
                    </label>
                    <label>Hora final
                        <input class="horaForm timePickerFinal" id="inputHoraFinal" type="time" name="horaFinal" min=<?php echo $array[0] ?> max=<?php echo $array[1] ?> required>
                    </label>

                    <select name="mascota" id="" required>
                        <option value="" disabled selected hidden>Mascota</option>

                        <?php foreach ($mascotasDuenio as $mascota) {

                            if ($mascota->getIdDueño() == $_SESSION['loggedUser']->getId()) {
                                if (strcasecmp($mascota->getTamaño(), $guardian->getTamaño()) == 0) { ?>
                                    <option value="<?php echo $mascota->getId(); ?>"><?php echo $mascota->getNombre(); ?></option>
                        <?php }
                            }
                        } ?>
                    </select>

                </div>

                <!-- ELEGIR MASCOTA DE ACUERDO AL TAMAÑO !-->

                <div class="buttons">
                    <button type='button' name="Cancelar" value="Cancelar" onClick="location.href='<?php echo FRONT_ROOT . 'Home/Index' ?>'">Cancelar
                        <button name="id_guardian" value="<?php echo $guardian->getId(); ?>" type="submit">Solicitar</button>
                </div>

            </form>
        </div>
    </div>
</main>

<script src="<?php echo JS_PATH . "validar.js" ?>"></script>
<?php require_once 'footer.php' ?>