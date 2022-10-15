<?php require_once 'header.php'?>

    <link rel="stylesheet" href=" <?php echo CSS_PATH . 'crear-mascota.css' ?> "> 
    <title>Crear mascota</title>

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
            <h1 class="titulo">Registrar mascota</h1>

            <form class="form">

                <input class="input-nombre" type="text" placeholder="Nombre" require>
                
                <select name="tamaño" class="selector-tamaño">
                    <option disabled selected>Tamaño</option>
                    <option value="1">Pequeño</option>
                    
                    <option value="2">Mediano</option>
                    
                    <option value="3">Grande</option>
                    
                </select>

                <input class="input-edad" type="number" placeholder="Edad" require min="0" max="20">
                
                <input class="input-raza" type="text" placeholder="Raza" require>
                
                <textarea class="input-obs" name="observaciones" id="1" cols="30" rows="10" placeholder="Observaciones"></textarea>
                
                <div class="contenedor-imagenes">
                    <label>Plan de vacunacion
                    <input accept="image/png,image/jpeg" type="file" required>
                    </label>
                    <label>Imagen
                    <input class="image"accept="image/png,image/jpeg" type="file">
                    </label>
                    <label>Video
                    <input accept="video/*" type="file">
                    </label>
                </div>

                <div class="contenedor-button">
                    <button class="button" type="button">Cancelar</button>
                    <button class="button" type="submit">Registrar</button>
                </div>
                
            </form>

        </div>

    </main>
        
<?php require_once 'footer.php'?>