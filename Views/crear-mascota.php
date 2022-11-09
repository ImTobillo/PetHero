<?php
require_once 'header.php';
require_once 'nav.php';
?>

<link rel="stylesheet" property="stylesheet" href=" <?php echo CSS_PATH . 'crear-mascota.css' ?> ">

<main>
    <div class="contenedor">
        <h1 class="titulo">Agregar mascota</h1>

        <form class="form" action="<?php echo FRONT_ROOT . "Mascota/creaMascota" ?>" method="POST" enctype="multipart/form-data">

            <input class="input-nombre" name="nombre" type="text" placeholder="Nombre" required>

            <select name="tamaño" class="selector-tamaño" required>
                <option disabled selected>Tamaño</option>
                <option value="Chiquito">Chiquito</option>
                <option value="Mediano">Mediano</option>
                <option value="Grande">Grande</option>
                <option value="Enorme">Enorme</option>
            </select>

            <input class="input-edad" name="edad" type="number" placeholder="Edad" required min="0" max="20">

            <!-- <input class="input-raza" name="raza" type="text" placeholder="Raza" required> -->

            <select class="selector-raza" name="raza" required>
                <option disabled selected>Raza de la mascota</option>
                <option value="Border Collie">Border Collie</option>
                <option value="Caniche">Caniche</option>
                <option value="Collie">Collie</option>
                <option value="Golden">Golden</option>
                <option value="Persa">Persa</option>
                <option value="Esfinge">Esfinge</option>
                <option value="Cocker">Cocker</option>
                <option value="Callejero">Callejero</option>
                <option value="Rottweiler">Rottweiler</option>
                <option value="Asiatico">Asiatico</option>
                <option value="Perro del Faraon">Perro del Faraon</option>
                <option value="Shih tzu">Shih tzu</option>
                <option value="Otros">Otros</option>
            </select>

            <textarea class="input-obs" name="observaciones" id="1" cols="30" rows="10" placeholder="Observaciones"></textarea>

            <div class="contenedor-imagenes">
                <label>Tipo de mascota
                    <select name="tipoMascota" required>
                        <option disabled selected>Tipo</option>
                        <option value="Perro">Perro</option>
                        <option value="Gato">Gato</option>
                    </select>
                </label>

                <label>Plan de vacunacion
                    <input accept="image/png,image/jpeg" name="planVacunacion" type="file" required>
                </label>
                <label>Imagen
                    <input class="image" accept="image/png,image/jpeg" name="imgPerro" type="file">
                </label>
                <label>Video
                    <input accept=".mp4" name="videoPerro" type="file">
                </label>
            </div>

            <div class="contenedor-button">
                <input class="button" type='button' name="Cancelar" value="Cancelar" onClick="location.href='<?php echo FRONT_ROOT . 'Home/Index' ?>'">
                <button class="button" type="submit" value="Enviar datos">Registrar</button>
            </div>

        </form>

    </div>

</main>

<?php require_once 'footer.php'; ?>