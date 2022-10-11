<?php 

namespace DAO;

interface IRepositorio
{
    function add(Object $obj);
    function remove($id);
    function getById($id);
    function getAll();
}

?>