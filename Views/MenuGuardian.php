<?php require_once 'header.php' ?>

    <title>Menu guardian</title>
    <link rel="stylesheet" href=" <?php echo CSS_PATH . 'menuDueño-Guardian.css' ?> ">

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

        <h1 class="tit">Bienvenido de nuevo @</h1>

        <div class="contenedor2">
            
            <div class="iguales">

                <a href="visualizarFechasSolicitadas.html" class="enlace"></a>

                <h2>Fechas solicitadas</h2>

                <p>Visualice las fechas que tiene solicitadas por dueños</p>

                <img class="icono" src=" <?php echo IMG_PATH . 'person.png' ?> " alt="persona">

            </div>

            <div class="iguales">

                <a href="verHistorialServOfrecidos-guardian.html" class="enlace"></a>

                <h2>Servicios ofrecidos</h2>

                <p>Mire el historial de los servicios que estuvo ofreciendo a los distintos dueños</p>

                <img class="icono" src=" <?php echo IMG_PATH . 'trabajo.png' ?> " alt="compra">

            </div>

        </div>

    </main>

    <?php require_once 'footer.php' ?>