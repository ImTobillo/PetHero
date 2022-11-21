<?php 

namespace JsonDAO;

interface IRepositorio
{
    function add($obj);
    function getById($id);
    function getAll();
}

?>