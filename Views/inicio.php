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

      <form action= " <?php echo FRONT_ROOT . 'Home/Login' ?> " method="post" class="form">

        <input name="username" class="input_email" type="text" required placeholder="Nombre de usuario" />
        <input name="password" class="input_contra" type="password" required placeholder="Contraseña" />

        <button class="button iniciar" type="submit">Iniciar</button>
      </form>
      
      <div class="contenedor-registrarse">
        <h2 class="tituloh2">Registrarse como</h2>

        <form action=" <?php echo FRONT_ROOT . 'Home/registrarCuenta' ?> " method="post">
          <button type="submit" class="button" name="tipoCuenta" value="dueño">Dueño</button>
          <button type="submit" class="button" name="tipoCuenta" value="guardian">Guardian</button>
        </form>
      </div>
    </div>
  </main>

  <?php require_once 'footer.php' ?>