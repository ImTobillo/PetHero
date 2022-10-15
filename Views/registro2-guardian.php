<?php require_once 'header.php' ?>
<title>PetHero</title>
<link href=" <?php echo CSS_PATH . 'registro2-guardia.css' ?> " rel="stylesheet" />
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
      <h1 class="titulo">Registro</h1>

      <form action="<?php echo FRONT_ROOT . "Guardian/"?>" method="post" class="formulario">
        <div class="opciones">
          <div class="lado1">
            <input name="remuneracion" class="" type="number" required placeholder="Remuneracion" />
            <select name="Tamanio">
              <option value="" disabled selected hidden>Tamaño</option>
              <!--placeholder-->
              <option value="pequenio">Pequeño</option>
              <option value="mediano">Mediano</option>
              <option value="grande">Grande</option>
            </select>
          </div>

          <div class="lado2">
            <div class="disponible">
              <h3>Definir disponibilidad</h3>
              <div class="opcionesDisponibles">
                <div class="contenedorOpcionesDisponibles">
                  <label><input type="checkbox" name="disponibilidad" value="lunes" />Lunes</label>
                  <label><input type="checkbox" name="disponibilidad" value="martes" />Martes</label>
                  <label><input type="checkbox" name="disponibilidad" value="miercoles" />Miercoles</label>
                </div>
                <div class="contenedorOpcionesDisponibles">
                  <label><input type="checkbox" name="disponibilidad" value="jueves" />Jueves</label>
                  <label><input type="checkbox" name="disponibilidad" value="viernes" />Viernes</label>
                  <label><input type="checkbox" name="disponibilidad" value="sabado" />Sábado</label>
                </div>
              </div>

              <label><input type="checkbox" name="disponibilidad" value="domingo" />Domingo</label>
            </div>
          </div>
        </div>

        <div class="inputsFecha">
          <input class="opcionFecha timePickerInicial" type="time" name="horaInicial" />
          <input class="opcionFecha timePickerFinal" type="time" name="horaFinal" />
        </div>

        <div class="botonesForm">
          <button class="button" type="reset">Cancelar</button>
          <button class="button" type="submit">Registrarse</button>
        </div>
      </form>
    </div>
  </main>
  <?php require_once 'footer.php' ?>