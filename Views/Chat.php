<?php
require_once 'header.php'; 
require_once 'nav.php';

?>

    <link property="stylesheet" rel="stylesheet" href=" <?php echo CSS_PATH . 'Chat.css' ?> ">

    <main class="contenedor">
        <div class="listaChats">
            
        </div>

        <div class="chat">

        </div>


            <form action="">

                <div>
                    <textarea name="" id="" cols="30" rows="10" placeholder="Ingrese comentarios aqui"></textarea>
                </div>

                <button type="submit">Guardar cambios</button>

            </form>

    </main>
<?php require_once 'footer.php' ?>