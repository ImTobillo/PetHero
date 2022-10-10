<?php require_once 'header.php' ?>

    <title>Reservar guardian</title>
    <link rel="stylesheet" href=" <?php echo CSS_PATH . 'reservar-guardian.css' ?> ">
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

    <main class="contenedor">
        <div class="heading">

            <img class="foto" src=" <?php echo IMG_PATH . 'perfil.png' ?> " alt="Perfil">

            <h1 class="perf">Perfil</h1>

            <img class="huella" src=" <?php echo IMG_PATH . 'huellas-perro.png' ?> " alt="Huellas">

        </div>

        <div class="info-y-enviar">
            <div class="contenedor-datos ">
                    <div class="datosGuardian"><p>Nombre</p></div>
                    <div class="datosGuardian"><p>Apellido</p></div>
                    <div class="datosGuardian"><p>Edad</p></div>
                    <div class="datosGuardian"><p>Email</p></div>
                    <div class="datosGuardian"><p>Telefono</p></div>
                    <div class="datosGuardian"><p>Tamaño que cuida</p></div>
            </div>
    
            <div class="formReservaGuardian">
                <h1>Selecciona el dia</h1>
                
                <form action="" method="get">
                    <div class="inputs">
                        <input type="date" name="fechaRequerida" required>
                        <input class="horaForm timePickerInicial" type="time" name="horaInicial" required>
                        <input class="horaForm timePickerFinal" type="time" name="horaFinal" required>
                    </div>

                    <button class="" type="submit">Elegir</button>
                </form>
            </div>
        </div>
    </main>
<?php require_once 'footer.php' ?>