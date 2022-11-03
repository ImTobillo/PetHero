<?php
require_once 'header.php'; 
require_once 'nav.php';

?>

    <link property="stylesheet" href=" <?php echo CSS_PATH . 'ver-perfil.css' ?> " rel="stylesheet">

    <main>

        <div class="contenedor-datos">
            <h1>Datos del servicio</h1>
            <form action="<?php echo FRONT_ROOT . 'Guardian/Editar' ?>" method="POST">

                <div class="parrafo">
                    <label for="">Tamaño a cuidar</label>
                    <select name="tamanio">
                        <option value="" disabled selected hidden>Tamaño</option>
                        <!--placeholder-->
                        <option value="Chiquito">Chiquito</option>
                        <option value="Mediano">Mediano</option>
                        <option value="Grande">Grande</option>
                        <option value="Enorme">Enorme</option>
                    </select>
                </div>
                <div class="parrafo">
                    <label for="">Remuneracion por hora</label>
                    <input name="remuneracion" type="number" placeholder="<?php echo $_SESSION['loggedUser']->getRemuneracion();?>" />
                </div>
                <div class="parrafo">
                    <label for="">Fecha de inicio</label>
                    <input class="datePickerInicio" id="inputFechaInicio"  name="fechaInicio" oninput="validarFecha()" type="date" min="<?php echo date("Y-m-d"); ?>" value="<?php echo $_SESSION['loggedUser']->getFechaInicio()?>">
                </div>
                <div class="parrafo">
                    <label for="">Fecha final</label>
                    <input class="datePickerFinal" id="inputFechaFinal"  name="fechaFinal" type="date" min="<?php echo date("Y-m-d"); ?>" value="<?php echo $_SESSION['loggedUser']->getFechaFinal()?>">
                </div>
                <div class="parrafo">
                    <?php $array = explode("-", $_SESSION['loggedUser']->getHoraDisponible()?? "");?>
                    <label for="">Hora de inicio</label>
                    <input class="opcionFecha timePickerInicial" id="inputHoraInicio" type="time" name="horaInicial" value="<?php echo $array[0] ?>" oninput="validarHora()"/>
                    <br>
                    <label for="">Hora final</label>
                    <input class="opcionFecha timePickerFinal" id="inputHoraFinal" type="time" name="horaFinal" value="<?php echo $array[1] ?>"/>    
                </div>

                <input class="button" type='button' name="Cancelar" value="Cancelar" onClick="location.href='<?php echo FRONT_ROOT . 'Guardian/ShowVerPerfil' ?>'">
                <button class="button" type="submit" name="idGuardian" value="<?php echo $_SESSION['loggedUser']->getId()?>">Editar</button>
            </form>
        </div>
    
    </main>

    <script src="<?php echo JS_PATH . "validar.js" ?>"></script> 
    <?php require_once 'footer.php' ?>