<?php 

namespace DAO;

interface IRepositorio
{
    function add($usuario); // revisar
    function remove($id);
    function getById($id);
    function getAll();
}

?>