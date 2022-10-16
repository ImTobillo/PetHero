<?php require_once 'header.php' ?>

<link href=" <?php echo CSS_PATH . 'ver-perfil-mascota.css' ?> " rel="stylesheet">
<title>Perfil</title>
</head>

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
            <div class="contImg"><img class="logo" src=" <?php echo FRONT_ROOT . IMG_PATH . 'logo.png' ?> " alt="Logo"></div>

        </nav>
    </header>

    <main class="main">
        <div class="contenedor-perfil">
            <img src="<?php echo FRONT_ROOT . IMG_PATH . 'ImgMascotas/' . $mascota->getImgPerro() ?>" alt="foto perfil" width="100x100">
            <button class="button">Editar</button>
        </div>

        <div class="contenedor-datos">
            <div class="parrafo">
                <p><?php echo $mascota->getNombre() ?></p>
            </div>
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
        </div>

        <div class="contenedor-multimedia">
            <div class="video">
                <video width="320" height="240" controls>
                    <source src="<?php echo FRONT_ROOT . IMG_PATH . 'ImgMascotas/' . $mascota->getVideoPerro() ?>" type="video/mp4">
                </video>
            </div>
            <div class="imagen"><img src="<?php echo FRONT_ROOT . IMG_PATH . 'ImgMascotas/' . $mascota->getPlanVacunacion() ?>" alt="imagen perro" height="200" width="200"></div>
        </div>
    </main>

    <?php require_once 'footer.php' ?>