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
    
            <form action="<?php echo FRONT_ROOT . "Home/registro"?>" method="post" class="form">
                <!-- agregar names a los inputs -->
                    
                    <input name="nombre" class="input-nombre" type="text" required placeholder="Nombre">
                    <input name="apellido" class="input-apellido" type="text" required placeholder="Apellido">
                    <input name="dni" class="input-dni" type="number" required placeholder="DNI">
                    <input name="email" class="input-email" type="email" required placeholder="Email">
                    <input name="contraseña" class="input-contraseña" type="password" required placeholder="Contraseña">
                    <input name="telefono" class="input-telefono" type="tel" required placeholder="Telefono">
                    <input name="fechaNacimiento" class="input-nacimiento" type="date" max="<?php echo date("Y-m-d",strtotime(date("Y-m-d")."- 13 year"));?>" required placeholder="Fecha de nacimiento">
                    <input name="ciudad" class="input-ciudad" type="text" required placeholder="Ciudad">
                    <input name="calle" class="input-calle" type="text" required placeholder="Calle">
                    <input name="numCalle" class="input-num-calle" type="number" required placeholder="Numero" min="0">
                    <input name="nombreUser" class="" type="text" required placeholder="Nombre de usuario"> <!-- arreglar -->

                    <?php

                    if($tipoCuenta == "dueño"){ ?>
                        <input type="text" name="tipoCuenta" value="dueño" hidden>
                   <?php } ?>

                    <div class="contenedor_button">
                        <button class="button" type="button">Cancelar</button>
                        <button class="button" type="submit">Registrarse</button>
                    </div>
                    
                    
            </form>
        </div>
    </main>
<?php require_once 'footer.php' ?>