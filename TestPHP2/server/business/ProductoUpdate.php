<?php
    require_once('../Daos/ProductoDAO.php');

    $cuerpo = file_get_contents('php://input');
    $productoDTO = json_decode($cuerpo);

    $productoDAO = new ProductoDAO();
    $producto = new Producto($productoDTO->descripcion, $productoDTO->comentario, $productoDTO->idProducto);
    $results = $productoDAO->update($producto);
    echo $results;

?>