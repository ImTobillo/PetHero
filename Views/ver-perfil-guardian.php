<?php
require_once 'header.php'; 
require_once 'nav.php';
require_once 'validarSesion.php';
?>

    <link property="stylesheet" href=" <?php echo CSS_PATH . 'ver-perfil.css' ?> " rel="stylesheet">

    <main>
        <div class="contenedor-perfil">

            <button class="button">Editar</button>
        </div>

        <div class="contenedor-datos">
            <div class="parrafo"><p>Nombre</p></div>
            <div class="parrafo"><p>Apellido</p></div>
            <div class="parrafo"><p>Edad</p></div>
            <div class="parrafo"><p>Email</p></div>
            <div class="parrafo"><p>DNI</p></div>
            <div class="parrafo"><p>Telefono</p></div>
            <div class="parrafo"><p>Tamaño</p></div>
        </div>
    </main>

<?php require_once 'footer.php' ?>