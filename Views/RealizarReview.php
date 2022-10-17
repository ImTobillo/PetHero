<?php
require_once 'header.php'; 
require_once 'nav.php';
require_once 'validarSesion.php';
?>

    <link property="stylesheet" rel="stylesheet" href=" <?php echo CSS_PATH . 'realizarReview.css' ?> ">

    <main class="contenedor">

            <form action="">

                <div class="labText">
                    <label for=""><h1>Review del servicio</h1></label>
                    <textarea name="" id="" cols="30" rows="10" placeholder="Ingrese comentarios aqui"></textarea>
                </div>

                <button type="submit">Guardar cambios</button>

            </form>

    </main>
<?php require_once 'footer.php' ?>