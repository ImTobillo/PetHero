

<body>
    <?php
    if (isset($errorMessage))
        echo "<script> if(confirm('" . $errorMessage . "')); </script>"; ?>

    <header> 
        <nav>

            <ul>
                <li><a href=" <?php echo FRONT_ROOT . 'Home/Index' ?> ">Inicio</a></li>
                <?php if (isset($_SESSION['loggedUser'])) { ?>
                    <li><a href="<?php echo FRONT_ROOT . 'Home/verPerfil'?> ">Ver Perfil</a></li>
                    <li><a href="<?php echo FRONT_ROOT . 'Chat/ShowChats'?> ">Chats</a></li>
                    <li><a href=" <?php echo FRONT_ROOT . 'Home/cerrarSesion'; ?> ">Cerrar Sesion</a></li>
                    
                <?php } ?>

            </ul>

            <div class="conTitulo"><h1 class="titulo">PetHero</h1></div>
            <div class="contImg"><img class="logo" src=" <?php echo IMG_PATH . 'logo.png' ?> " alt="Logo"></div>

        </nav>
    </header>

    