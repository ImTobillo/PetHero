<?php
require_once 'header.php'; 
require_once 'nav.php';
require_once 'validarSesion.php';
?>

<link rel="stylesheet" property="stylesheet" href=" <?php echo CSS_PATH . 'crear-mascota.css' ?> ">

    <main>
        <div class="contenedor">
            <h1 class="titulo">Agregar mascota</h1>

            <form class="form" action="<?php echo FRONT_ROOT . "Mascota/creaMascota" ?>" method="POST" enctype="multipart/form-data">

                <input class="input-nombre" name="nombre" type="text" placeholder="Nombre" required>

                <select name="tamaño" class="selector-tamaño" required>
                    <option disabled selected>Tamaño</option>
                    <option value="1">Pequeño</option>
                    <option value="2">Mediano</option>
                    <option value="3">Grande</option>
                </select>

                <input class="input-edad" name="edad" type="number" placeholder="Edad" required min="0" max="20">

                <input class="input-raza" name="raza" type="text" placeholder="Raza" required>

                <textarea class="input-obs" name="observaciones" id="1" cols="30" rows="10" placeholder="Observaciones"></textarea>

                <div class="contenedor-imagenes">
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
                    <button class="button" type="button">Cancelar</button>
                    <button class="button" type="submit" value="Enviar datos">Registrar</button>
                </div>

            </form>

        </div>

    </main>

    <?php require_once 'footer.php'; ?>