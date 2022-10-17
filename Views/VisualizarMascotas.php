<?php
require_once 'header.php'; 
require_once 'nav.php';
require_once 'validarSesion.php';
?>

<link property="stylesheet" rel="stylesheet" href="<?php echo CSS_PATH . 'visualizarGuardianes-Mascotas.css' ?>">

    <main>
        <form action="<?php echo FRONT_ROOT . "Mascota/verPerfil" ?>" method="post">
            <h1 class="tituloG">Mascotas</h1>
            <?php foreach ($listMascotas as $value) {
                if ($value->getIdDueño() == 1) { ?>

                    <div class="igual">

                        <img class="imagenPerf" src="<?php echo FRONT_ROOT . IMG_PATH . 'ImgMascotas/' . $value->getPlanVacunacion() ?> " alt="Mascota">

                        <div class="info">
                            <p><?php echo $value->getNombre(); ?></p>
                            <p><?php echo $value->getEdad(); ?></p>

                            <button class="boton" type="submit" name="id" value="<?php echo $value->getId(); ?>"> Ver perfil </button>
                        </div>
                    </div>
            <?php }
            } ?>
        </form>

    </main>

    <?php require_once 'footer.php' ?>