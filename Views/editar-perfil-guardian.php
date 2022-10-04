<?php require_once 'header.php'?>

    <link rel="stylesheet" href="css/basic.css" />
    <link rel="stylesheet" href="css/EditarPerfilDueño.css" />
    <link rel="shortcut icon" href="img/logo.png" type="image/x-icon" />

    <title>Editar perfil</title>
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
        <div class="contImg">
          <img class="logo" src="img/logo.png" alt="Logo" />
        </div>
      </nav>
    </header>

    <main class="nuevoMain">
      <div class="primero">
        <img class="foto" src="img/perfil.png" alt="Perfil" />

        <h1 class="perf">Perfil</h1>

        <img class="huella" src="img/huellas-perro.png" alt="Huellas" />
      </div>

      <div class="segundo">
        <p>Nombre</p>
        <p>Apellido</p>
        <p>Edad</p>
        <p>Email</p>
        <p>Dni</p>
        <p>Telefono</p>
        <p>Tamaño</p>

        <button class="boton" type="submit">Siguiente</button>
      </div>
    </main>

<?php require_once 'footer.php'?>
