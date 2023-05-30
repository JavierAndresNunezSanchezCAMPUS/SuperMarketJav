<?php

ini_set("display_errors", 1);

ini_set("display_startup_errors", 1);

error_reporting(E_ALL);

require_once("../db.php");
require_once("../PDO.php");

class Config extends AbstractPdo{
    private $id;
    private $nombreFactura;
    private $id_empleado;
    private $id_cliente;
    private $fecha;

    public function __construct($id = 0, $nombreFactura = "", $id_empleado = "", $id_cliente = "", $fecha = "", $dbPDO = ""){
        $this->id = $id;
        $this->nombreFactura = $nombreFactura;
        $this->id_empleado = $id_empleado;
        $this->id_cliente = $id_cliente;
        $this->fecha = $fecha;
        parent::__construct($dbPDO);
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getId(){
        return $this->id;
    }

        public function setNombreFactura($nombreFactura){
        $this->nombreFactura = $nombreFactura;
    }

    public function getNombreFactura(){
        return $this->nombreFactura;
    }

    public function setId_empleado($id_empleado){
        $this->id_empleado = $id_empleado;
    }

    public function getId_empleado(){
        return $this->id_empleado;
    }

    public function setId_cliente($id_cliente){
        $this->id_cliente = $id_cliente;
    }

    public function getId_cliente(){
        return $this->id_cliente;
    }

    public function setFecha($fecha){
        $this->fecha = $fecha;
    }

    public function getFecha(){
        return $this->fecha;
    }

    public function insertDatos(){
        try {
            $stm = $this-> dbPDO -> prepare("INSERT INTO facturas (nombreFactura, id_empleado, id_cliente, fecha) values(?,?,?,?)");
            $stm -> execute([$this->nombreFactura, $this->id_empleado, $this->id_cliente, $this->fecha]);
        } catch (Exception $e) {
            return var_dump($e->getMessage());
        }
    }

    public function obtener(){
        try {
            $stm = $this->dbPDO->prepare("SELECT facturas.id, facturas.nombreFactura, empleados.nombreEmpleado, clientes.nombreCliente, facturas.fecha FROM facturas INNER JOIN empleados ON facturas.id_empleado = empleados.id INNER JOIN clientes ON facturas.id_cliente = clientes.id");
            $stm -> execute();
            return $stm -> fetchAll(); // Método para obtener los registros PDO
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function obtenerEmpleado(){
        try {
            $stm = $this->dbPDO->prepare("SELECT id, nombreEmpleado FROM empleados");
            $stm -> execute();
            return $stm -> fetchAll(); // Método para obtener los registros PDO
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function obtenerCliente(){
        try {
            $stm = $this->dbPDO->prepare("SELECT id, nombreCliente FROM clientes");
            $stm -> execute();
            return $stm -> fetchAll(); // Método para obtener los registros PDO
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function delete(){
        try {
            $stm = $this->dbPDO->prepare("DELETE FROM facturas WHERE id = ?");
            $stm -> execute([$this->id]);
            return $stm-> fetchAll();
            echo "<script>alert('Factura eliminada'); document.location='facturas.php'</script>";
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function seleccionar(){
        try {
            $stm = $this->dbPDO->prepare("SELECT * FROM facturas WHERE id = ?");
            $stm -> execute([$this->id]);
            return $stm-> fetchAll();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function update(){
        try {
            $stm = $this->dbPDO->prepare("UPDATE facturas SET nombreFactura = ?, id_empleado = ?, id_cliente = ?, fecha = ? WHERE id = ?");
            $stm -> execute([$this->nombreFactura,  $this->id_empleado, $this->id_cliente, $this->fecha, $this->id]);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
?>