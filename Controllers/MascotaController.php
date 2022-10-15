<?php

namespace Controllers;

use Models\Mascota as Mascota;
use DAO\MascotaDAO as MascotaDAO;

class MascotaController{

    private $mascotasDAO;

    function __construct()
    {
        $this->mascotasDAO = new MascotaDAO();
    } 

    function ShowAddView(){
        require_once(VIEWS_PATH . "crear-mascota.php");
    }

    function ShowListView(){
        $listMascotas = $this->mascotasDAO->getAll();
        require_once(VIEWS_PATH . "VisualizarMascotas.php");
    }

    public function creaMascota($nombre, $tamaño, $edad, $raza, $observaciones, $planVacunacion){ // falta img y video

        $mascota = new Mascota();

        $mascota->setIdDueño(1);    // $_SESSION['userLogged'] 
        $mascota->setNombre($nombre);
        $mascota->setTamaño($tamaño);
        $mascota->setEdad($edad);
        $mascota->setRaza($raza);
        $mascota->setObservaciones($observaciones);

        $mascota->setPlanVacunacion($_FILES['planVacunacion']['name']); // Guarda nombre de la imagen
        $this->subirImg($planVacunacion);   // Guarda imagen en carpeta del proyecto

        $this->mascotasDAO->add($mascota);

//        $this->ShowAddView();
        $this->ShowListView();
//        header("location: " . VIEWS_PATH . "VisualizarMascotas.php");
    }

    public function subirImg($planVacunacion){

        if (isset($planVacunacion)) {
            //Recogemos el archivo enviado por el formulario
            $archivo = $_FILES['planVacunacion']['name'];
            //Si el archivo contiene algo y es diferente de vacio
            if (isset($archivo) && $archivo != "") {
               $tipo = $_FILES['planVacunacion']['type'];
               $tamano = $_FILES['planVacunacion']['size'];
               $temp = $_FILES['planVacunacion']['tmp_name'];
               //Se comprueba si el archivo a cargar es correcto observando su extensión y tamaño
              if (!((strpos($tipo, "jpeg") || strpos($tipo, "jpg") || strpos($tipo, "png")) && ($tamano < 100000000000))) {
                 echo '<div><b>Error. La extensión o el tamaño de los archivos no es correcta.<br/>
                 - Se permiten archivos .gif, .jpg, .png. y de 200 kb como máximo.</b></div>';
              }
              else {
                 //Si la imagen es correcta en tamaño y tipo
                 //Se intenta subir al servidor
                 if (move_uploaded_file($temp, IMG_PATH . 'ImgMascotas/'. $archivo)) {
                     //Cambiamos los permisos del archivo a 777 para poder modificarlo posteriormente
                     chmod(IMG_PATH . 'ImgMascotas/' .$archivo, 0777);
                     //Mostramos el mensaje de que se ha subido co éxito
                     echo "<script> if(confirm('Imagen subida correctamente')); </script>";
                     //Mostramos la imagen subida
                     //echo '<p><img src=" ' . IMG_PATH . 'ImgMascotas/' . $archivo . '"></p>';
                 }
                 else {
                    //Si no se ha podido subir la imagen, mostramos un mensaje de error
                    echo '<div><b>Ocurrió algún error al subir el fichero. No pudo guardarse.</b></div>';
                 }
               }
            }
         }
    
    }

    // Falta remove

}

?>