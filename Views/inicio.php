<?php require_once 'header.php' ?>

<title>PetHero</title>
<link rel="stylesheet" href=" <?php echo CSS_PATH . 'inicio.css' ?> " />
</head>

<body>
  <header>
    <nav>
      <ul>
        <li><a href="inicio.html">Inicio</a></li>
        <li><a href="#">Sobre nosotros</a></li>
        <li><a href="#">Contacto</a></li>
      </ul>

      <div class="conTitulo">
        <h1 class="titulo">PetHero</h1>
      </div>
      <div class="contImg">
        <img class="logo" src=" <?php echo IMG_PATH . 'logo.png' ?> " alt="Logo" />
      </div>
    </nav>
  </header>

  <main>
    <div class="contenedor">
      <h1 class="titulo">Inicio sesion</h1>

      <form action="../Process/inicio-process.php" class="form">
        <input class="input_email" type="email" required placeholder="Email" />
        <input class="input_contra" type="password" required placeholder="Contraseña" />
        <button class="button iniciar" type="submit">Iniciar</button>
      </form>

      <div class="contenedor-registrarse">
        <h2 class="tituloh2">Registrarse como</h2>

        <form action="Process/inicio-process.php" method="post">
          <button type="submit" class="button" name="tipoCuenta" value="duenio">Dueño</button>
          <button type="submit" class="button" name="tipoCuenta" value="guardian">Guardian</button>
        </form>
      </div>
    </div>
  </main>

  <?php require_once 'footer.php' ?>