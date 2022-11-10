<?php
require_once 'header.php'; 
require_once 'nav.php';

?>

  <link rel="stylesheet" property="stylesheet" href=" <?php echo CSS_PATH . 'inicio.css' ?> " />

  <main>
    <div class="contenedor">
      <h1 class="titulo">Inicio sesion</h1>

      <form action=" <?php echo FRONT_ROOT . 'Home/Login' ?> " method="post" class="form" enctype="multipart/form-data">

        <input name="username" class="input_email" type="text" required placeholder="Nombre de usuario" />
        <input name="password" class="input_contra" type="password" required placeholder="Contraseña" />

        <button class="button iniciar" type="submit">Iniciar</button>
      </form>

      <div class="contenedor-registrarse">
        <h2 class="tituloh2">Registrarse como</h2>

        <form class="formu" action=" <?php echo FRONT_ROOT . 'Home/registrarCuenta' ?> " method="post">
          <button type="submit" class="button" name="tipoCuenta" value="Dueño">Dueño</button>
          <button type="submit" class="button" name="tipoCuenta" value="Guardian">Guardian</button>
        </form>
      </div>
    </div>
  </main>

  <?php require_once 'footer.php' ?>