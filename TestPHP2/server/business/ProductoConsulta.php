<?php
    header("Access-Control-Allow-Origin: *");
    require_once('../daos/ProductoDAO.php');
    $productoDAO = new ProductoDAO();
    $results = json_encode($productoDAO -> readAll());
    echo $results;
?>


