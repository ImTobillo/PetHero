<?php require_once 'header.php' ?>
    
    <title>Menu dueño</title>
    <link rel="stylesheet" href=" <?php echo CSS_PATH . 'menuDueño-Guardian.css' ?> ">

</head>

<body>
    
    <header> 
        <nav>

            <ul>
                <li><a href=" <?php echo ROOT ?> ">Inicio</a></li>
                <li><a href="#">Sobre nosotros</a></li>
                <li><a href=" <?php echo FRONT_ROOT . 'Home/cerrarSesion' ?> ">Cerrar Sesion</a></li>
            </ul>

            <div class="conTitulo"><h1 class="titulo">PetHero</h1></div>
            <div class="contImg"><img class="logo" src=" <?php echo IMG_PATH . 'logo.png' ?> " alt="Logo"></div>

        </nav>
    </header>

    <main>

        <h1 class="tit">Bienvenido de nuevo @</h1>

        <div class="contenedor">
            
            <div class="iguales">

                <a href="VisualizarGuardianes.html" class="enlace"></a>

                <h2>Visualizar guardianes</h2>

                <p>Revise su perfil para chequear su información y editar lo que gustes.</p>

                <img class="icono" src=" <?php echo IMG_PATH . 'person.png' ?> " alt="persona">

            </div>

            <div class="iguales">

                <a href="VerPagosPendientes.html" class="enlace"></a>

                <h2>Pagos pendientes</h2>

                <p>Clickeá acá para ver a quien le debés.</p>

                <img class="icono" src=" <?php echo IMG_PATH . 'compra.png' ?> " alt="compra">

            </div>

            <div class="iguales">

                <a href=" <?php echo FRONT_ROOT . "Mascota/ShowListView" ?> " class="enlace"></a>

                <h2>Visualizar mascotas</h2>

                <p>Mire su lista de pichichus registrados</p>

                <img class="icono" src=" <?php echo IMG_PATH . 'dog.png' ?> " alt="perro">

            </div>

            <div class="iguales">

                <a href="crear-mascota.html" class="enlace"></a>

                <h2>Crear mascota</h2>

                <p>Aca puede agregar una nueva mascota a su lista</p>

                <img class="icono" src=" <?php echo IMG_PATH . 'pet.png' ?> " alt="perro">

            </div>

        </div>

    </main>

    <?php require_once 'footer.php' ?>