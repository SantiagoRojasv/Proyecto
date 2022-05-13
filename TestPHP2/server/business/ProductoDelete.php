<?php
    require_once('../Daos/ProductoDAO.php');

    $cuerpo = file_get_contents('php://input');
    $productoDTO = json_decode($cuerpo);

    $productoDAO = new ProductoDAO();
    $producto = new Producto(0,0,$productoDTO->idProducto);
    $results = $productoDAO->delete($producto);
    echo $results;

?>