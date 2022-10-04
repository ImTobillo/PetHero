<?php require_once 'header.php' ?>

    <link href="css/basic.css" rel="stylesheet">
    <link href="css/ver-perfil.css" rel="stylesheet">
    <link rel="shortcut icon" href="img/logo.png" type="image/x-icon">

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

    <main>
        <div class="contenedor-perfil">
            <img src="" alt="foto perfil">
            <button class="button">Editar</button>
        </div>

        <div class="contenedor-datos">
            <div class="parrafo"><p>Nombre</p></div>
            <div class="parrafo"><p>Apellido</p></div>
            <div class="parrafo"><p>Edad</p></div>
            <div class="parrafo"><p>Email</p></div>
            <div class="parrafo"><p>DNI</p></div>
            <div class="parrafo"><p>Telefono</p></div>
        </div>
    </main>

<?php require_once 'footer.php' ?>