<?php require_once 'header.php'?>

    <link rel="stylesheet" href=" <?php echo CSS_PATH . 'visualizarGuardianes-Mascotas.css' ?> ">
    <title>Visualizar Mascotas</title>

</head>

<body>

    <header> 
        <nav>

            <ul>
                <li><a href="inicio.html">Inicio</a></li>
                <li><a href="#">Sobre nosotros</a></li>
                <li><a href="#">Contacto</a></li>
            </ul>

            <div class="conTitulo"><h1 class="titulo">PetHero</h1></div>
            <div class="contImg"><img class="logo" src=" <?php echo IMG_PATH . 'logo.png' ?> " alt="Logo"></div>

        </nav>
    </header>

    <main>

        <h1 class="tituloG">Mascotas</h1>

        <div class="igual">
            <img class="imagenPerf" src=" <?php echo IMG_PATH . 'ejemploPerro1.jpg' ?> " alt="">
            <div class="info">
                <p>Nombre</p>
                <p>Disponibilidad</p>
                <button class="boton" type="submit">Ver perfil</button>
            </div>
        </div>

        <div class="igual">
            <img class="imagenPerf" src=" <?php echo IMG_PATH . 'ejemploPerro2.jpg' ?> " alt="">
            <div class="info">
            <p>Nombre</p>
            <p>Disponibilidad</p>
            <button class="boton" type="submit">Ver perfil</button>
            </div>
        </div>

    </main>

<?php require_once 'footer.php'?>