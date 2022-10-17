<?php
require_once 'header.php'; 
require_once 'nav.php';
require_once 'validarSesion.php';
?>
    <link property="stylesheet" href=" <?php echo CSS_PATH . 'editar-perfil-mascota.css' ?> " rel="stylesheet">

    <main class="main">
        <div class="contenedor-perfil">
            <img src="" alt="foto perfil">
        </div>

        <div class="contenedor">
            <div class="contenedor-datos">

                <div class="parrafo">
                    <label for="nombre">Nombre </label>
                    <input name="nombre" type="text"> 
                </div> 

                <div class="parrafo">
                    <label for="tamaño">Tamaño
                        <select name="tamaño" class="selector-tamaño">
                            <option disabled selected>Tamaño</option>
                            <option value="1">Pequeño</option>
                                
                            <option value="2">Mediano</option>
                            
                            <option value="3">Grande</option>
                                
                        </select>
                    </label>
                </div>
                    
                <div class="parrafo">
                    <label for="edad">Edad 
                        <input name="edad" type="number" min="0" max="20">
                    </label>
                </div>

                <div class="parrafo">
                    <label for="raza">Raza 
                        <input name="raza" type="text">
                    </label>
                </div> 

                <div class="parrafo">
                    <label for="obs">Observaciones </label>
                    <textarea name="obs" id="" cols="30" rows="10"></textarea>
                </div>    
            </div>

            <div class="contenedor-multimedia">
                <div class="video">
                    <label for="video">Video
                        <input class="input-multimedia" accept="video/*" type="file">
                    </label>
                </div>
                <div class="imagen">
                    <label>Imagen
                        <input class="input-multimedia"accept="image/png,image/jpeg" type="file">
                    </label>
                </div>
            </div>

            <button class="button" type="submit">Guardar cambios</button>
        </div>

        
    </main>

<?php require_once 'footer.php'?>
