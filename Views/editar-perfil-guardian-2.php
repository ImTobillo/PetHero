<?php
require_once 'header.php'; 
require_once 'nav.php';
require_once 'validarSesion.php';
?>

    <link property="stylesheet" href=" <?php echo CSS_PATH . 'registro2-guardia.css' ?> " rel="stylesheet" />

    <main>
      <div class="contenedor">
        <h1 class="titulo">Editar perfil</h1>

        <form class="formulario">
          <div class="opciones">
            <div class="lado1">
              <input
                class=""
                type="number"
                required
                placeholder="Remuneracion"
              />
              <input
                class=""
                type="text"
                required
                placeholder="Tipo de perro"
              />
              <select name="Tamanio">
                <option value="" disabled selected hidden>Tamaño</option> <!--placeholder-->
                <option value=""></option>
              </select>
            </div>

            <div class="lado2">
              <div class="disponible">
                <h3>Definir disponibilidad</h3>
                <div class="opcionesDisponibles">
                  <div class="contenedorOpcionesDisponibles">
                    <label
                      ><input
                        type="checkbox"
                        name="disponibilidad"
                        value=""
                      />Lunes</label
                    >
                    <label
                      ><input
                        type="checkbox"
                        name="disponibilidad"
                        value=""
                      />Martes</label
                    >
                    <label
                      ><input
                        type="checkbox"
                        name="disponibilidad"
                        value=""
                      />Miercoles</label
                    >
                  </div>
                  <div class="contenedorOpcionesDisponibles">
                    <label
                      ><input
                        type="checkbox"
                        name="disponibilidad"
                        value=""
                      />Jueves</label
                    >
                    <label
                      ><input
                        type="checkbox"
                        name="disponibilidad"
                        value=""
                      />Viernes</label
                    >
                    <label
                      ><input
                        type="checkbox"
                        name="disponibilidad"
                        value=""
                      />Sábado</label
                    >
                  </div>
                </div>

                <label
                  ><input
                    type="checkbox"
                    name="disponibilidad"
                    value=""
                  />Domingo</label
                >
              </div>

              <div class="inputsFecha">
                <input
                  class="opcionFecha"
                  type="time"
                  name="horaInicial"
                  id="timePickerInicial"
                />
                <input 
                class="opcionFecha" 
                type="time" 
                name="horaFinal" 
                id="timePickerFinal"
                />
              </div>
            </div>
          </div>

          <div class="botonesForm">
            <button class="button" type="button">Cancelar</button>
            <button class="button" type="submit">Guardar cambios</button>
          </div>
        </form>
      </div>
    </main>

<?php require_once 'footer.php'?>
