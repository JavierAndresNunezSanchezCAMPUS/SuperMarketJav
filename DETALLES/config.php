<?php

ini_set("display_errors", 1);

ini_set("display_startup_errors", 1);

error_reporting(E_ALL);

require_once("../db.php");
require_once("../PDO.php");

class Config extends AbstractPdo{
    private $id;
    private $id_factura;
    private $id_producto;
    private $cantidad;
    private $precio;

    public function __construct($id = 0, $id_factura = "", $id_producto = "", $cantidad = "", $precio = "", $dbPDO = ""){
        $this->id = $id;
        $this->id_empleado = $id_factura;
        $this->id_cliente = $id_producto;
        $this->cantidad = $cantidad;
        $this->precio = $precio;
        parent::__construct($dbPDO);
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getId(){
        return $this->id;
    }

    public function setId_factura($id_factura){
        $this->id_factura = $id_factura;
    }

    public function getId_factura(){
        return $this->id_factura;
    }

    public function setId_producto($id_producto){
        $this->id_producto = $id_producto;
    }

    public function getId_producto(){
        return $this->id_producto;
    }

    public function setCantidad($cantidad){
        $this->cantidad = $cantidad;
    }

    public function getCantidad(){
        return $this->cantidad;
    }

    public function setPrecio($precio){
        $this->precio = $precio;
    }

    public function getPrecio(){
        return $this->precio;
    }

    public function insertDatos(){
        try {
            $stm = $this-> dbPDO -> prepare("INSERT INTO detalles (id_factura, id_producto, cantidad, precio) values(?,?,?,?)");
            $stm -> execute([$this->id_factura, $this->id_producto, $this->cantidad, $this->precio]);
        } catch (Exception $e) {
            return var_dump($e->getMessage());
        }
    }

    public function obtener(){
        try {
            $stm = $this->dbPDO->prepare("SELECT detalles.id, facturas.nombreFactura, productos.nombre, detalles.cantidad, detalles.precio FROM detalles INNER JOIN facturas ON detalles.id_factura = facturas.id INNER JOIN productos ON detalles.id_producto = productos.id");
            $stm -> execute();
            return $stm -> fetchAll(); // Método para obtener los registros PDO
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function obtenerFactura(){
        try {
            $stm = $this->dbPDO->prepare("SELECT id, nombreFactura FROM facturas");
            $stm -> execute();
            return $stm -> fetchAll(); // Método para obtener los registros PDO
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function obtenerProducto(){
        try {
            $stm = $this->dbPDO->prepare("SELECT id, nombre FROM productos");
            $stm -> execute();
            return $stm -> fetchAll(); // Método para obtener los registros PDO
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function delete(){
        try {
            $stm = $this->dbPDO->prepare("DELETE FROM detalles WHERE id = ?");
            $stm -> execute([$this->id]);
            return $stm-> fetchAll();
            echo "<script>alert('Detalle de Factura eliminada'); document.location='detalles.php'</script>";
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function seleccionar(){
        try {
            $stm = $this->dbPDO->prepare("SELECT * FROM detalles WHERE id = ?");
            $stm -> execute([$this->id]);
            return $stm-> fetchAll();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function update(){
        try {
            $stm = $this->dbPDO->prepare("UPDATE detalles SET id_factura = ?, id_producto = ?, cantidad = ?, precio = ? WHERE id = ?");
            $stm -> execute([$this->id_factura,$this->id_producto, $this->cantidad, $this->precio, $this->id]);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
?>