<?php require_once 'header.php' ?>

    <link href="css/ver-perfil-mascota.css" rel="stylesheet">
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

            <div class="conTitulo"><h1 class="titulo">PetHero</h1></div>
            <div class="contImg"><img class="logo" src="img/logo.png" alt="Logo"></div>

        </nav>
    </header>

    <main class="main">
        <div class="contenedor-perfil">
            <img src="img/ejemploPerro1.jpg" alt="foto perfil" width="100x100">
            <button class="button">Editar</button>
        </div>

        <div class="contenedor-datos">
            <div class="parrafo"><p>Nombre</p></div>
            <div class="parrafo"><p>Tamaño</p></div>
            <div class="parrafo"><p>Edad</p></div>
            <div class="parrafo"><p>Raza</p></div>
            <div class="parrafo"><p>Observaciones</p></div>
        </div>

        <div class="contenedor-multimedia">
            <div class="video"><iframe width="400" height="200" src="https://www.youtube.com/embed/7bhKI0Mw6Yk" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
            <div class="imagen"><img src="img/logo.png" alt="imagen perro" height="200" width="200"></div>
        </div>
    </main>

    <?php require_once 'footer.php' ?>