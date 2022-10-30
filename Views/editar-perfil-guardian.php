<?php
require_once 'header.php'; 
require_once 'nav.php';
?>

    <link rel="stylesheet" property="stylesheet" href=" <?php echo CSS_PATH . 'EditarPerfilDueño.css' ?> " />

    <main class="nuevoMain">
      <div class="primero">
        <img class="foto" src=" <?php echo IMG_PATH . 'perfil.png' ?> " alt="Perfil" />

        <h1 class="perf">Perfil</h1>

        <img class="huella" src=" <?php echo IMG_PATH . 'huellas-perro.png' ?> " alt="Huellas" />
      </div>

      <div class="segundo">
        <p>Nombre</p>
        <p>Apellido</p>
        <p>Edad</p>
        <p>Email</p>
        <p>Dni</p>
        <p>Telefono</p>
        <p>Tamaño</p>

        <button class="boton" type="submit">Siguiente</button>
      </div>
    </main>

<?php require_once 'footer.php'?>
