<?php 

if (!isset($_SESSION['loggedUser']))
{
    header('location: ' . FRONT_ROOT . 'index.php');
}

?>