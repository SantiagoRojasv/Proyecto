<?php

class Producto {

    var $idProducto;
    var $descripcion;
    var $comentario;

    function __construct($descripcion, $comentario, $idProducto)
    {
        $this->descripcion = $descripcion;
        $this->comentario = $comentario;
        $this->idProducto = $idProducto;
    }

}
?>
