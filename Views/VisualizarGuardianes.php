<?php require_once 'header.php' ?>

<link rel="stylesheet" href="css/visualizarGuardianes.css">
<title>Visualizar Guardianes</title>

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
            <div class="contImg"><img class="logo" src="img/logo.png" alt="Logo"></div>

        </nav>
    </header>

    <main>

        <h1 class="tituloG">Guardianes</h1>

        <div class="igual">
            <img class="imagenPerf" src="img/ejemploGuardian1.jpg" alt="">
            <div class="info">
                <p>Julian Weich</p>
                <p>Disponibilidad</p>
                <button class="boton" type="submit">Ver perfil</button>
            </div>
        </div>

        <div class="igual">
            <img class="imagenPerf" src="img/ejemploGuardian2.jpg" alt="">
            <div class="info">
                <p>Marley</p>
                <p>Disponibilidad</p>
                <button class="boton" type="submit">Ver perfil</button>
            </div>
        </div>

    </main>

    <?php require_once 'footer.php' ?>