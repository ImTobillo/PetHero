<?php
require_once 'header.php'; 
require_once 'nav.php';

?>

    <link property="stylesheet" href=" <?php echo CSS_PATH . 'ver-perfil.css' ?> " rel="stylesheet">

    <main>

        <div class="contenedor-datos">
            <div class="parrafo"><p>Nombre: <?php echo $_SESSION['loggedUser']->getNombre();?></p></div>
            <div class="parrafo"><p>Apellido: <?php echo $_SESSION['loggedUser']->getApellido();?></p></div>
            <div class="parrafo"><p>Fecha de nacimiento: <?php echo $_SESSION['loggedUser']->getfechaNacimiento();?></p></div>
            <div class="parrafo"><p>Email: <?php echo $_SESSION['loggedUser']->getEmail();?></p></div>
            <div class="parrafo"><p>DNI: <?php echo $_SESSION['loggedUser']->getDni();?></p></div>
        </div>

    </main>

<?php require_once 'footer.php' ?>