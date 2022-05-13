<?php
require_once ('../config/ConnectionDB.php');
require_once ('../model/Producto.php');

class ProductoDAO {

    private $connectionDB;
    private $dbCon;
    const CONSULTA = "SELECT p.idProducto, p.descripcion, p.comentario FROM producto p";
    const INSERT = "INSERT INTO producto (descripcion, comentario) VALUES (?,?)";
    const UPDATE = "UPDATE producto SET descripcion = ?, comentario = ? WHERE idProducto = ?";
    const DELETE ="DELETE FROM producto WHERE idProducto = ?";

    public function __construct() {
        $this->connectionDB = new Connection();
        $this->dbCon=$this->connectionDB->getConnection();
    }

    public function readAll() {
        try {
            $statement =  $this->dbCon->prepare(self::CONSULTA);       
            $statement->execute();
            $producto = $statement->fetchAll(PDO::FETCH_ASSOC);
            $statement = null;
            $this->connectionDB->closeConnection();
        }
        catch(PDOException $ex){
            echo $ex->getMessage();
            die($ex->getMessage());
        }
        return $producto;
    } 

    public function create (Producto $producto){
        $result=false;
        try{
            $statement=$this->dbCon->prepare(self::INSERT);
            $statement->execute([$producto->descripcion, $producto->comentario]);
            $result=true;
            $this->connectionD8->closeConnection();
        }catch(PDOException $ex){
            echo $ex->getMessage();
            die ($ex->getMessage());
        }
        return $result;
    }

    public function update (Producto $producto){
        $result=false;
        try{
            $statement=$this->dbCon->prepare(self::UPDATE);
            $statement->execute([$producto->descripcion, $producto->comentario, $producto->idProducto]);
            $result=true;
            $this->connectionD8->closeConnection();
        }catch(PDOException $ex){
            echo $ex->getMessage();
            die ($ex->getMessage());
        }
        return $result;
    }

    public function delete (Producto $producto){
        $result=false;
        try{
            $statement=$this->dbCon->prepare(self::DELETE);
            $statement->execute([$producto->idProducto]);
            $result=true;
            $this->connectionD8->closeConnection();
        }catch(PDOException $ex){
            echo $ex->getMessage();
            die ($ex->getMessage());
        }
        return $result;
    }
}