<?php
class Connection{
    private $dbhost ='localhost:3306';
    private $dbname ='tiendavirtual';
    private $dbuser ='root';
    private $dbpass ='';
    private $database = 'php_login_database';



    private $dbcon;

    public function __construct(){
        try{
            $this->dbcon = new PDO("mysql:host={$this->dbhost};dbname={$this->dbname}",$this->dbuser,$this->dbpass);
            $this->dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $ex){
            echo $ex->getMessage();
            die($ex->getMessage());
        }
    }
    

    public function getConnection(){
        return $this->dbcon;
    }

    public function closeConnection(){
        $this->dbcon=null;
    }
    
}

?>