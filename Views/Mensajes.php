<?php
require_once 'header.php'; 
require_once 'nav.php';

?>

    <link rel="stylesheet" href=" <?php echo CSS_PATH . 'Mensajes.css'?>">
    <main>

    <div class="contenedor">

        <div class="to">
            <h1><?php echo $To->getNombre();?> </h1>
        </div>

        <div class="contMensajes">
            <?php 
            
            if(!empty($listaMensajes)){

                foreach($listaMensajes as $mensaje){ 

                    $user = $this->userDAO->getById($mensaje->getIdUserFrom());
                    if($user->getTipoCuenta() == "Guardian"){
                        $from = $this->guardianDAO->getById($mensaje->getIdUserFrom());
                    }else{
                        $from = $this->duenioDAO->getById($mensaje->getIdUserFrom());                     
                    }                         
                        if($_SESSION['loggedUser']->getId() == $from->getId()){?>
                            <div class="mensajeRight"><h2><?php echo  $mensaje->getMensaje() . ": [". $mensaje->getFecha() ."] ";?></h2></div>
                        <?php }else{?>
                            <div class="mensajeLeft"><h2><?php echo "[". $mensaje->getFecha() ."] : ". $mensaje->getMensaje();?></h2></div>
                        <?php } ?>
                    
                <?php  } 
            } ?>
            
        </div>

        <div class="enviar">
            <form action="<?php echo FRONT_ROOT . 'Chat/enviarMensaje'?>" method="post">
                <input class="escribirMensaje" type="text" name="mensaje" id="" autocomplete="off">
                <button class="enviarMensaje" type="submit" name="idTo" value="<?php echo $To->getId();?>">Enviar</button>
            </form>
        </div>
    </div>

        

    </main>

<?php require_once 'footer.php' ?>