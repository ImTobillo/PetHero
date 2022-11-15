<?php
require_once 'header.php';
require_once 'nav.php';

?>

<link property="stylesheet" rel="stylesheet" href=" <?php echo CSS_PATH . 'Chat.css' ?> ">

<main>
    <div class="contenedor">
        <section class="listaChats">
            <!--<?php //foreach($listaChats as $chat){ 
            ?> -->
            <div class="chatLista">
                <h1>chat</h1>
            </div>
            <!-- <?php //  } 
            ?> --> 
        </section>

        <section class="chatSeleccionado">
            <div class="chat">
                <!-- <?php //foreach($listaChats as $chat){ ?> -->
                <div class="mensaje">
                    <h1>mensaje</h1>
                </div>
                <!-- <?php // } ?> -->
            </div>
            <div class="escribir">
                <h1>escribir</h1>
            </div>
        </section>
    </div>



    <!--<form action="">

                
                <div>
                    <textarea name="" id="" cols="30" rows="10" placeholder="Ingrese comentarios aqui"></textarea>
                </div>

                <button type="submit">Guardar cambios</button>

            </form>-->

</main>
<?php require_once 'footer.php' ?>