<?php 

ini_set("display_errors", 1);

ini_set("display_startup_errors", 1);

error_reporting(E_ALL);

require_once("../db.php");
require_once("../PDO.php");

class Config extends AbstractPdo{
    private $id;
    private $nombreEmpleado;
    private $celular;
    private $direccion;
    private $imagen;

    public function __construct($id = 0, $nombreEmpleado = "", $celular = "", $direccion = "", $imagen = "", $dbPDO = ""){
        $this->id = $id;
        $this->nombreEmpleado = $nombreEmpleado;
        $this->celular = $celular;
        $this->direccion = $direccion;
        $this->imagen = $imagen;
        parent:: __construct($dbPDO);
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getId(){
        return $this->id;
    }

    public function setNombreEmpleado($nombreEmpleado){
        $this->nombreEmpleado = $nombreEmpleado;
    }

    public function getNombreEmpleado(){
        return $this->nombreEmpleado;
    }

    public function setCelular($celular){
        $this->celular = $celular;
    }

    public function getCelular(){
        return $this->celular;
    }

    public function setDireccion($direccion){
        $this->direccion = $direccion;
    }

    public function getDireccion(){
        return $this->direccion;
    }

    public function setImagen($imagen){
        $this->imagen = $imagen;
    }

    public function getImagen(){
        return $this->imagen;
    }

    public function insertDatos(){
        try {
            $stm = $this-> dbPDO -> prepare("INSERT INTO empleados (nombreEmpleado, celular, direccion, imagen) values(?,?,?,?)");
            $stm -> execute([$this->nombreEmpleado, $this->celular, $this->direccion, $this->imagen]);
        } catch (Exception $e) {
            return var_dump($e->getMessage());
        }
    }

    public function obtener(){
        try {
            $stm = $this->dbPDO->prepare("SELECT * FROM empleados");
            $stm -> execute();
            return $stm -> fetchAll(); // Método para obtener los registros PDO
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function delete(){
        try {
            $stm = $this->dbPDO->prepare("DELETE FROM empleados WHERE id = ?");
            $stm -> execute([$this->id]);
            return $stm-> fetchAll();
            echo "<script>alert('Empleado eliminado'); document.location='empleados.php'</script>";
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function seleccionar(){
        try {
            $stm = $this->dbPDO->prepare("SELECT * FROM empleados WHERE id = ?");
            $stm -> execute([$this->id]);
            return $stm-> fetchAll();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function update(){
        try {
            $stm = $this->dbPDO->prepare("UPDATE empleados SET nombreEmpleado = ?, celular = ?, direccion = ?, imagen = ? WHERE id = ?");
            $stm -> execute([$this->nombreEmpleado, $this->celular, $this->direccion, $this->imagen, $this->id]);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
?>