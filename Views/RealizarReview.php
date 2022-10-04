<?php require_once 'header.php' ?>

    <title>Realizar Review</title>
    <link rel="stylesheet" href="css/realizarReview.css">
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

    <main class="contenedor">

            <form action="">

                <div class="labText">
                    <label for=""><h1>Review del servicio</h1></label>
                    <textarea name="" id="" cols="30" rows="10" placeholder="Ingrese comentarios aqui"></textarea>
                </div>

                <button type="submit">Guardar cambios</button>

            </form>

    </main>
<?php require_once 'footer.php' ?>