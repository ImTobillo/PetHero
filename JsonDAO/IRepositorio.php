<?php 

namespace DAO;

interface IRepositorio
{
    function add($obj);
    function getById($id);
    function getAll();
}

?>