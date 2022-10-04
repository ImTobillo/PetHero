<?php require_once 'header.php' ?>

    <link rel="stylesheet" href="css/verFechasSolicitadas.css">
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

            <div class="conTitulo"><h1 class="titulo">PetHero</h1></div>
            <div class="contImg"><img class="logo" src="img/logo.png" alt="Logo"></div>

        </nav>
    </header>

    <main>

        <h1 class="tituloG">Fechas solicitadas</h1>

        <div class="igual">
            <img class="imagenPerf" src="https://us.123rf.com/450wm/isselee/isselee2003/isselee200300398/142504822-bulldog-ingl%C3%A9s-perro-sacando-la-lengua-aislado-en-blanco.jpg?ver=6" alt="">
            <div class="info">
                <h2>Dia / Hora</h2>
                <p>Nombre mascota</p>
                <p>Tamaño</p>
                <p>Edad</p>
                <div class="Aceptar-Rechazar">
                    <button type="submit">Aceptar</button>
                    <button type="submit">Rechazar</button>
                </div>
            </div>
        </div>

        <div class="igual">
            <img class="imagenPerf" src="https://t1.ea.ltmcdn.com/es/razas/1/6/1/san-bernardo_161_0_orig.jpg" alt="">
            <div class="info">
                <h2>Dia / Hora</h2>
                <p>Nombre mascota</p>
                <p>Tamaño</p>
                <p>Edad</p>
                <div class="Aceptar-Rechazar">
                    <button type="submit">Aceptar</button>
                    <button type="submit">Rechazar</button>
                </div>
            </div>
        </div>

    </main>

    <?php require_once 'footer.php' ?>