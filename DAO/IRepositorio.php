<?php 

namespace DAO;

interface IRepositorio
{
    function add($obj);
    function remove($id);
    function getById($id);
    function getAll();
}

?>