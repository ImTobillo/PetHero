<?php

namespace Controllers;

use Models\Mascota as Mascota;
use DAO\MascotaDAO as MascotaDAO;
use Models\Perro as Perro;
use Models\Gato as Gato;

class MascotaController
{
    private $mascotasDAO;

    function __construct()
    {
        $this->mascotasDAO = new MascotaDAO();
    }

    public function ShowAddView()
    {
        require_once VIEWS_PATH . 'validarSesion.php';
        require_once(VIEWS_PATH . "crear-mascota.php");
    }

    public function ShowListView()
    {
        require_once VIEWS_PATH . 'validarSesion.php';
        $listMascotas = $this->mascotasDAO->getAll();
        require_once(VIEWS_PATH . "VisualizarMascotas.php");
    }

    public function creaMascota($nombre, $tamaño, $edad, $raza, $observaciones, $tipoMascota, $planVacunacion, $imgPerro, $videoPerro)
    {
        if($tipoMascota == "Perro"){
            $mascota = new Perro();
        }
        else{
            $mascota = new Gato();
        }

        $mascota->setIdDueño($_SESSION['loggedUser']->getId());    // $_SESSION['userLogged'] 
        $mascota->setNombre($nombre);
        $mascota->setTamaño($tamaño);
        $mascota->setEdad($edad);
        $mascota->setRaza($raza);
        $mascota->setTipoMascota($tipoMascota);
        $mascota->setObservaciones($observaciones);

        $mascota->setPlanVacunacion($_FILES['planVacunacion']['name']); // Guarda nombre de la imagen
        $this->subirArch("planVacunacion", $planVacunacion);   // Guarda imagen en carpeta del proyecto

        $mascota->setImgPerro($_FILES['imgPerro']['name']);
        $this->subirArch("imgPerro", $imgPerro);

        if ($videoPerro)
        {
            $mascota->setVideoPerro($_FILES['videoPerro']['name']);
            $this->subirArch("videoPerro", $videoPerro);
        }

        $this->mascotasDAO->add($mascota);

        $this->ShowAddView();
    }

    public function subirArch($nombreArch, $arch)
    {

        if (isset($arch)) {
            //Recogemos el archivo enviado por el formulario
            $archivo = $_FILES[$nombreArch]['name'];
            //Si el archivo contiene algo y es diferente de vacio
            if (isset($archivo) && $archivo != "") {
                $tipo = $_FILES[$nombreArch]['type'];
                $tamano = $_FILES[$nombreArch]['size'];
                $temp = $_FILES[$nombreArch]['tmp_name'];

                //Se comprueba si el archivo a cargar es correcto observando su extensión y tamaño
                if (!((strpos($tipo, "jpeg") || strpos($tipo, "jpg") || strpos($tipo, "mp4") || strpos($tipo, "png")) && ($tamano < 10000000000000))) {
                    echo '<div><b>Error. La extensión o el tamaño de los archivos no es correcta.<br/>
                    - Se permiten archivos .gif, .jpg, .png. y de 200 kb como máximo.</b></div>';
                } else {

                    //Si la imagen es correcta en tamaño y tipo
                    //Se intenta subir al servidor
                    if (move_uploaded_file($temp, VIEWS_PATH . 'img/ImgMascotas/' . $archivo)) {
                        //Cambiamos los permisos del archivo a 777 para poder modificarlo posteriormente
                        chmod(VIEWS_PATH . 'img/ImgMascotas/' . $archivo, 0777);
                        //Mostramos el mensaje de que se ha subido co éxito
                        echo "<script> if(confirm('Archivo subido correctamente')); </script>";
                        //Mostramos la imagen subida
                        //echo '<p><img src=" ' . IMG_PATH . 'ImgMascotas/' . $archivo . '"></p>';
                    } else {
                        //Si no se ha podido subir la imagen, mostramos un mensaje de error
                        echo '<div><b>Ocurrió algún error al subir el fichero. No pudo guardarse.</b></div>';
                    }
                }
            }
        }
    }

    // Falta remove

    public function verPerfil($id)
    {
        require_once VIEWS_PATH . 'validarSesion.php';
        $mascota = $this->mascotasDAO->getById($id);
        require_once(VIEWS_PATH . "ver-perfil-mascota.php");
    }
}
