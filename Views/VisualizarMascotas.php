<?php
require_once 'header.php';
require_once 'nav.php';
?>

<link property="stylesheet" rel="stylesheet" href="<?php echo CSS_PATH . 'visualizarGuardianes-Mascotas.css' ?>">

<main>
    <h1 class="tituloG">Mascotas</h1>
    <form class="formul" action="<?php echo FRONT_ROOT . "Mascota/verPerfil" ?>" method="post">

        <?php foreach ($listMascotas as $value) {
            if ($value->getIdDueño() == $_SESSION['loggedUser']->getId()) { ?>

                <div class="igual">
                    <?php if ($value->getImgPerro() != null) { ?>
                        <img class="imagenPerf" src="<?php echo IMG_PATH . 'ImgMascotas/' . $value->getImgPerro() ?> " alt="Mascota">
                    <?php } ?>

                    <div class="info">
                        <p><b>Nombre:</b> <?php echo $value->getNombre(); ?></p>
                        <p><b>Tamaño:</b> <?php echo $value->getTamaño(); ?></p>

                        <button class="boton" type="submit" name="id" value="<?php echo $value->getId(); ?>"> Ver perfil </button>
                    </div>
                </div>
        <?php }
        } ?>
    </form>

</main>

<?php require_once 'footer.php' ?>