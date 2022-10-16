<?php
require_once 'header.php'
?>

<link rel="stylesheet" href="<?php echo CSS_PATH . 'visualizarGuardianes-Mascotas.css' ?>">
<title>Visualizar Mascotas</title>

</head>
<!-- ACA VA EL NAV CON REQUIRE -->

<body>

    <header>
        <nav>

            <ul>
                <li><a href="inicio.html">Inicio</a></li>
                <li><a href="#">Sobre nosotros</a></li>
                <li><a href="#">Contacto</a></li>
            </ul>

            <div class="conTitulo">
                <h1 class="titulo">PetHero</h1>
            </div>
            <div class="contImg"><img class="logo" src="<?php echo FRONT_ROOT . IMG_PATH . 'logo.png' ?>" alt="Logo"></div>

        </nav>
    </header>

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