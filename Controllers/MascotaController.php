<?php

namespace Controllers;

use DAO\MascotaDAO as MascotaDAO;
use Exception;
use Models\Perro as Perro;
use Models\Gato as Gato;

class MascotaController
{
    private $mascotasDAO;

    function __construct()
    {
        $this->mascotasDAO = new MascotaDAO();
    }

    /*FUNCIONES DE VISTAS*/
    public function ShowAddView()
    {
        require_once VIEWS_PATH . 'validarSesion.php';
        require_once(VIEWS_PATH . "crear-mascota.php");
    }

    public function ShowListView()
    {
        require_once VIEWS_PATH . 'validarSesion.php';
        $listMascotas = $this->mascotasDAO->getAll();
        //var_dump($listMascotas);
        require_once(VIEWS_PATH . "VisualizarMascotas.php");
    }

    public function verPerfil($id)
    {
        require_once VIEWS_PATH . 'validarSesion.php';
        $mascota = $this->mascotasDAO->getById($id);
        require_once(VIEWS_PATH . "ver-perfil-mascota.php");
    }
    
    public function creaMascota($nombre, $tamaño, $edad, $raza, $observaciones, $tipoMascota, $planVacunacion, $imgPerro, $videoPerro)
    {
        try
        {
            if($tipoMascota == "Perro"){
                $mascota = new Perro($_SESSION['loggedUser']->getId(), $tipoMascota, $nombre, $tamaño, $edad, $raza, $observaciones, $planVacunacion['name'], $imgPerro['name'], $videoPerro['name']);
            }
            else{
                $mascota = new Gato($_SESSION['loggedUser']->getId(), $tipoMascota, $nombre, $tamaño, $edad, $raza, $observaciones, $planVacunacion['name'], $imgPerro['name'], $videoPerro['name']);
            }
    
            $this->subirArch($planVacunacion['name'], $planVacunacion);   // Guarda imagen en carpeta del proyecto
    
            $this->subirArch($imgPerro['name'], $imgPerro);
    
            if ($videoPerro)
            {
                $this->subirArch($videoPerro['name'], $videoPerro);
            }
    
            $this->mascotasDAO->add($mascota);
        }
        catch (Exception $e)
        {
            $errorMessage = $e->getMessage();
        }
        finally
        {
            require_once(VIEWS_PATH . "crear-mascota.php");
        }

        
    }

    public function subirArch($nombreArch, $arch)
    {
        try
        {
            if (isset($arch)) {
                //Recogemos el archivo enviado por el formulario
                $archivo = $nombreArch;
                //Si el archivo contiene algo y es diferente de vacio
                if (isset($archivo) && $archivo != "") {
                    $tipo = $arch['type'];
                    $tamano = $arch['size'];
                    $temp = $arch['tmp_name'];
    
                    //Se comprueba si el archivo a cargar es correcto observando su extensión y tamaño
                    if (!((strpos($tipo, "jpeg") || strpos($tipo, "jpg") || strpos($tipo, "mp4") || strpos($tipo, "png")) && ($tamano < 10000000000000))) {
                        throw new Exception("La extensión o el tamaño de los archivos no es correcta. Se permiten archivos .gif, .jpg, .png. y de 200 kb como máximo.");
                    } else {
    
                        //Si la imagen es correcta en tamaño y tipo
                        //Se intenta subir al servidor
                        if (move_uploaded_file($temp, VIEWS_PATH . 'img/ImgMascotas/' . $archivo)) {
                            //Cambiamos los permisos del archivo a 777 para poder modificarlo posteriormente
                            chmod(VIEWS_PATH . 'img/ImgMascotas/' . $archivo, 0777);
                            //Mostramos el mensaje de que se ha subido co éxito
                                        //echo "<script> if(confirm('Archivo subido correctamente')); </script>";
                            //Mostramos la imagen subida
                            //echo '<p><img src=" ' . IMG_PATH . 'ImgMascotas/' . $archivo . '"></p>';
                        } else {
                            //Si no se ha podido subir la imagen, mostramos un mensaje de error
                            throw new Exception("Ocurrió algún error al subir el fichero. No pudo guardarse.");
                        }
                    }
                }
            }
        }
        catch (Exception $e)
        {
            throw $e;
        }
    }

    
}
