<?php
require_once 'header.php'; 
require_once 'nav.php';
?>

<link property="stylesheet" href=" <?php echo CSS_PATH . 'registro2-guardia.css' ?> " rel="stylesheet" />

  <main>
    <div class="contenedor">
      <h1 class="titulo">Registro</h1>

      <form action="<?php echo FRONT_ROOT . "Guardian/agregarGuardian"?>" method="post" id="formularioRegistroGuardian" class="formulario" enctype="multipart/form-data">
        <div class="opciones">
          <div class="lado1">
            <input name="remuneracion" type="number" required placeholder="Remuneracion por hora" />
            <select name="tamanio">
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
                <div class="contenedorFecha">
                  <input class="datePickerInicio" id="inputFechaInicio"  name="fechaInicio" oninput="validarFecha()" type="date" min="<?php echo date("Y-m-d"); ?>" required placeholder="Fecha de inicio">
                </div>
                <div class="contenedorFecha">
                  <input class="datePickerFinal" id="inputFechaFinal"  name="fechaFinal" disabled type="date" min="<?php echo date("Y-m-d"); ?>" required placeholder="Fecha de final">
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="inputsFecha">
          <input class="opcionFecha timePickerInicial" id="inputHoraInicio" type="time" name="horaInicial" oninput="validarHora()"/>
          <input class="opcionFecha timePickerFinal" id="inputHoraFinal" type="time" name="horaFinal" />
        </div>

        <div class="botonesForm">
          <input class="button" type='button' name="Cancelar" value="Cancelar" onClick="location.href='<?php echo FRONT_ROOT . 'Home/Index' ?>'">
          <button class="button" type="submit">Registrarse</button>
        </div>
      </form>
    </div>
  </main>
  <script src="<?php echo JS_PATH . "validar.js" ?>"></script> 
  <script>
    
  </script>
  <?php require_once 'footer.php' ?>