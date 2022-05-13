<?php
    require_once('../Daos/ProductoDAO.php');

    $cuerpo = file_get_contents('php://input');
    $productoDTO = json_decode($cuerpo);

    $productoDAO = new ProductoDAO();
    $producto = new Producto($productoDTO->descripcion,$productoDTO->comentario,0);
    $results = $productoDAO->create($producto);
    echo $results;

?>