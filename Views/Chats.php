<?php
require_once 'header.php'; 
require_once 'nav.php';

?>

    <link rel="stylesheet" href="<?php echo CSS_PATH . 'Chat.css'?>">
    <main>

        <div class="contenedorChats">
        <h1>Chats</h1>
        <?php ?>
            <?php foreach($listaChats as $chats){ ?>

                <form action="<?php echo FRONT_ROOT . 'Chat/ShowMensajes'?>">
                    <button class="chat" type="submit" name="idChat" value="<?php echo $chats->getIdChat();?>">

                    <?php if(get_class($_SESSION['loggedUser']) == "Models\Guardian"){
                        $To = $this->duenioDAO->getById($chats->getIdDuenio()); ?>
                        <h2><?php echo $To->getNombre();?></h2>
                    <?php }else{
                        $To = $this->guardianDAO->getById($chats->getIdGuardian()); ?>
                        <h2><?php echo $To->getNombre();?></h2>
                    <?php } ?>

                    </button>
                </form>
           <?php } ?>
        </div>

    </main>

<?php require_once 'footer.php' ?>