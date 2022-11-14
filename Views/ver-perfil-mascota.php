<?php
require_once 'header.php'; 
require_once 'nav.php';

?>

<link property="stylesheet" href=" <?php echo CSS_PATH . 'ver-perfil-mascota.css' ?> " rel="stylesheet">

    <main class="main">
        <div class="contenedor-perfil">
            <?php if ($mascota->getImgPerro() != null) { ?>
                <img class="imgP" src="<?php echo IMG_PATH . 'ImgMascotas/' . $mascota->getImgPerro() ?>" alt="foto perfil" width="100x100">
            <?php } ?>

            <h1><?php echo $mascota->getNombre() ?></h1>
            <button class="button">Editar</button>
        </div>
        
        <div class="contenedor-datos">
            <div class="parrafo">
                <p><?php echo $mascota->getTamaño() ?></p>
            </div>
            <div class="parrafo">
                <p><?php echo $mascota->getEdad() ?></p>
            </div>
            <div class="parrafo">
                <p><?php echo $mascota->getRaza() ?></p>
            </div>
            <div class="parrafo">
                <p><?php echo $mascota->getObservaciones() ?></p>
            </div>
            <div class="parrafo">
                <p><?php echo $mascota->getTipoMascota() ?></p>
            </div>
            <?php if($mascota->getVideoPerro() != ""){ ?>
            <div class="video">
                <video width="320" height="240" controls>
                    <source src="<?php echo IMG_PATH . 'ImgMascotas/' . $mascota->getVideoPerro()?>" type="video/mp4">
                </video>
            </div>
            <?php } ?>
        </div>

        <div class="contenedor-multimedia">
            <div class="imagen"><img class="imgPlan" src="<?php echo IMG_PATH . 'ImgMascotas/' . $mascota->getPlanVacunacion() ?>" alt="imagen perro" height="200" width="200"></div>
        </div>
    </main>

    <?php require_once 'footer.php' ?>