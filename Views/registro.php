<?php require_once 'header.php' ?>
    <title>Registrarse</title>
    <link href=" <?php echo CSS_PATH . 'registro.css' ?> " rel="stylesheet">
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
        <div class="contenedor">
            <h1 class="titulo">Registro</h1>
            <h2 class="tituloh2">Datos personales</h2>

            <form action="" class="form">
                    <input class="input-nombre" type="text" required placeholder="Nombre">
                    <input class="input-apellido" type="text" required placeholder="Apellido">
                    <input class="input-dni" type="number" required placeholder="DNI">
                    <input class="input-email" type="email" required placeholder="Email">
                    <input class="input-contraseña" type="password" required placeholder="Contraseña">
                    <input class="input-telefono" type="tel" required placeholder="Telefono">
                    <input class="input-nacimiento" type="date" required placeholder="Fecha de nacimiento">
                    <input class="input-ciudad" type="text" required placeholder="Ciudad">
                    <input class="input-calle" type="text" required placeholder="Calle">
                    <input class="input-num-calle" type="number" required placeholder="Numero" min="0">

                    <div class="contenedor_button">
                        <button class="button" type="button">Cancelar</button>
                        <button class="button" type="submit">Registrarse</button>
                    </div>
                    
            </form>
        </div>
    </main>
<?php require_once 'footer.php' ?>