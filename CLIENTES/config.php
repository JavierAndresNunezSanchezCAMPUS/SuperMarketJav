<?php 

ini_set("display_errors", 1);

ini_set("display_startup_errors", 1);

error_reporting(E_ALL);

require_once("../db.php");
require_once("../PDO.php");

class Config extends AbstractPdo{
    private $id;
    private $nombreCliente;
    private $celular;
    private $compañia;

    public function __construct($id = 0, $nombreCliente = "", $celular = "", $compañia = "", $dbPDO = ""){
        $this->id = $id;
        $this->nombreCliente = $nombreCliente;
        $this->celular = $celular;
        $this->compañia = $compañia;
        parent::__construct($dbPDO);
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getId(){
        return $this->id;
    }

    public function setNombreCliente($nombreCliente){
        $this->nombreCliente = $nombreCliente;
    }

    public function getNombreCliente(){
        return $this->nombreCliente;
    }

    public function setCelular($celular){
        $this->celular = $celular;
    }

    public function getCelular(){
        return $this->celular;
    }

    public function setCompañia($compañia){
        $this->compañia = $compañia;
    }

    public function getCompañia(){
        return $this->compañia;
    }

    public function insertDatos(){
        try {
            $stm = $this-> dbPDO -> prepare("INSERT INTO clientes (nombreCliente, celular, compañia) values(?,?,?)");
            $stm -> execute([$this->nombreCliente, $this->celular, $this->compañia]);
        } catch (Exception $e) {
            return var_dump($e->getMessage());
        }
    }

    public function obtener(){
        try {
            $stm = $this->dbPDO->prepare("SELECT * FROM clientes");
            $stm -> execute();
            return $stm -> fetchAll(); // Método para obtener los registros PDO
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function delete(){
        try {
            $stm = $this->dbPDO->prepare("DELETE FROM clientes WHERE id = ?");
            $stm -> execute([$this->id]);
            return $stm-> fetchAll();
            echo "<script>alert('Cliente eliminado'); document.location='clientes.php'</script>";
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function seleccionar(){
        try {
            $stm = $this->dbPDO->prepare("SELECT * FROM clientes WHERE id = ?");
            $stm -> execute([$this->id]);
            return $stm-> fetchAll();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function update(){
        try {
            $stm = $this->dbPDO->prepare("UPDATE clientes SET nombreCliente = ?, celular = ?, compañia = ? WHERE id = ?");
            $stm -> execute([$this->nombreCliente, $this->celular, $this->compañia, $this->id]);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
?>