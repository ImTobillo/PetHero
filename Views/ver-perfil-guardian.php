<?php
require_once 'header.php'; 
require_once 'nav.php';
use DAO\GuardianDAO as GuardianDAO;
$guardianes = new GuardianDAO();
$guardian = $guardianes->getById($_SESSION['loggedUser']->getId());
?>

    <link property="stylesheet" href=" <?php echo CSS_PATH . 'ver-perfil.css?v=5' ?> " rel="stylesheet">

    <main>

        <div class="contenedor-datos">
            <h1>Datos personales</h1>
            <div class="parrafo"><p>Nombre: <?php echo $guardian->getNombre();?></p></div>
            <div class="parrafo"><p>Apellido: <?php echo $guardian->getApellido();?></p></div>
            <div class="parrafo"><p>Fecha de nacimiento: <?php echo $guardian->getfechaNacimiento();?></p></div>
            <div class="parrafo"><p>Email: <?php echo $guardian->getEmail();?></p></div>
            <div class="parrafo"><p>DNI: <?php echo $guardian->getDni();?></p></div>
            <div class="parrafo"><p>Telefono: <?php echo $guardian->getTelefono();?></p></div>
        </div>

        <div class="contenedor-datos-servicio">
            <h1>Datos del servicio</h1>
            <form action="<?php echo FRONT_ROOT . 'Guardian/ShowEditar' ?>" method="POST">
                <button class="button">Editar</button>
                <div class="parrafo"><p>Tamaño a cuidar: <?php echo $guardian->getTamaño();?></p></div>
                <div class="parrafo"><p>Remuneracion por hora: <?php echo $guardian->getRemuneracion();?></p></div>
                <div class="parrafo"><p>Fecha inicio de servicio: <?php echo $guardian->getFechaInicio();?></p></div>
                <div class="parrafo"><p>Fecha final de servicio: <?php echo $guardian->getFechaFinal();?></p></div>
                <div class="parrafo"><p>Horario de disponibilidad: <?php echo $guardian->getHoraDisponible();?></p></div>
            </form>
        </div>
    </main>

<?php require_once 'footer.php' ?>