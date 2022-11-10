<?php
require_once 'header.php'; 
require_once 'nav.php';

?>

    <link property="stylesheet" href=" <?php echo CSS_PATH . 'registro.css' ?> " rel="stylesheet">

    <main>
        <div class="contenedor">
            <h1 class="titulo">Registro</h1>
            <h2 class="tituloh2">Datos personales</h2>
    
            <form action="<?php echo FRONT_ROOT . "Home/registro"?>" method="post" class="form" enctype="multipart/form-data">
                <!-- agregar names a los inputs -->
                    
                    <input name="nombre" class="input-nombre" type="text" required placeholder="Nombre">
                    <input name="apellido" class="input-apellido" type="text" required placeholder="Apellido">
                    <input name="dni" class="input-dni" type="number" min="1000000" required placeholder="DNI">
                    <input name="email" class="input-email" type="email" required placeholder="Email">
                    <input name="contraseña" class="input-contraseña" type="password" required placeholder="Contraseña">
                    <input name="telefono" class="input-telefono" type="tel" required placeholder="Telefono">
                    <input name="fechaNacimiento" class="input-nacimiento" type="date" max="<?php echo date("Y-m-d",strtotime(date("Y-m-d")."- 13 year"));?>" required placeholder="Fecha de nacimiento">
                    <input name="ciudad" class="input-ciudad" type="text" required placeholder="Ciudad">
                    <input name="calle" class="input-calle" type="text" required placeholder="Calle">
                    <input name="numCalle" class="input-num-calle" type="number" required placeholder="Numero" min="0">
                    <input name="nombreUser" class="" type="text" required placeholder="Nombre de usuario"> <!-- arreglar -->

                    <?php if($tipoCuenta == "Dueño"){ ?>
                        <input type="text" name="tipoCuenta" value="Dueño" hidden>
                   <?php } else{ ?>
                        <input type="text" name="tipoCuenta" value="Guardian" hidden>
                    <?php } ?>


                    <div class="contenedor_button">
                        <button class="button" type="submit">Registrarse</button>
                    </div>
                    
                    
            </form>
        </div>
    </main>
<?php require_once 'footer.php' ?>