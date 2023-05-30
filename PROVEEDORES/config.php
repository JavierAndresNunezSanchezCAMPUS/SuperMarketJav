<?php 

ini_set("display_errors", 1);

ini_set("display_startup_errors", 1);

error_reporting(E_ALL);

require_once("../db.php");
require_once("../PDO.php");

class Config extends AbstractPdo{
    private $id;
    private $nombreProveedor;
    private $telefono;
    private $ciudad;

    public function __construct($id = 0, $nombreProveedor = "", $telefono = "", $ciudad = "", $dbPDO = ""){
        $this->id = $id;
        $this->nombreProveedor = $nombreProveedor;
        $this->telefono = $telefono;
        $this->ciudad = $ciudad;
        parent::__construct($dbPDO);
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getId(){
        return $this->id;
    }

    public function setNombreProveedor($nombreProveedor){
        $this->nombreProveedor = $nombreProveedor;
    }

    public function getNombreProveedor(){
        return $this->nombreProveedor;
    }

    public function setTelefono($telefono){
        $this->telefono = $telefono;
    }

    public function getTelefono(){
        return $this->telefono;
    }

    public function setCiudad($ciudad){
        $this->ciudad = $ciudad;
    }

    public function getCiudad(){
        return $this->ciudad;
    }

    public function insertDatos(){
        try {
            $stm = $this-> dbPDO -> prepare("INSERT INTO proveedores (nombreProveedor, telefono, ciudad) values(?,?,?)");
            $stm -> execute([$this->nombreProveedor, $this->telefono, $this->ciudad]);
        } catch (Exception $e) {
            return var_dump($e->getMessage());
        }
    }

    public function obtener(){
        try {
            $stm = $this->dbPDO->prepare("SELECT * FROM proveedores");
            $stm -> execute();
            return $stm -> fetchAll(); // Método para obtener los registros PDO
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function delete(){
        try {
            $stm = $this->dbPDO->prepare("DELETE FROM proveedores WHERE id = ?");
            $stm -> execute([$this->id]);
            return $stm-> fetchAll();
            echo "<script>alert('Proveedor eliminado'); document.location='proveedores.php'</script>";
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function seleccionar(){
        try {
            $stm = $this->dbPDO->prepare("SELECT * FROM proveedores WHERE id = ?");
            $stm -> execute([$this->id]);
            return $stm-> fetchAll();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function update(){
        try {
            $stm = $this->dbPDO->prepare("UPDATE proveedores SET nombreProveedor = ?, telefono = ?, ciudad = ? WHERE id = ?");
            $stm -> execute([$this->nombreProveedor, $this->telefono, $this->ciudad, $this->id]);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
?>