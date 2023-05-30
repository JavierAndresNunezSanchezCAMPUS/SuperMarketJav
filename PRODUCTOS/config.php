<?php

ini_set("display_errors", 1);

ini_set("display_startup_errors", 1);

error_reporting(E_ALL);

require_once("../db.php");
require_once("../PDO.php");

class Config extends AbstractPdo{
    private $id;
    private $id_categoria;
    private $precio;
    private $stock;
    private $unidades;
    private $id_proveedor;
    private $nombre;
    private $descontinuado;

    public function __construct($id = 0, $id_categoria = "", $precio = "", $stock = "", $unidades = "", $id_proveedor = "", $nombre = "", $descontinuado = "", $dbPDO = ""){
        $this->id = $id;
        $this->id_categoria = $id_categoria;
        $this->precio = $precio;
        $this->stock = $stock;
        $this->unidades = $unidades;
        $this->id_proveedor = $id_proveedor;
        $this->nombre = $nombre;
        $this->descontinuado = $descontinuado;
        parent::__construct($dbPDO);
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getId(){
        return $this->id;
    }

    public function setId_categoria($id_categoria){
        $this->id_categoria = $id_categoria;
    }

    public function getId_categoria(){
        return $this->id_categoria;
    }

    public function setPrecio($precio){
        $this->precio = $precio;
    }

    public function getPrecio(){
        return $this->precio;
    }

    public function setStock($stock){
        $this->stock = $stock;
    }

    public function getStock(){
        return $this->stock;
    }

    public function setUnidades($unidades){
        $this->unidades = $unidades;
    }

    public function getUnidades(){
        return $this->unidades;
    }

    public function setId_proveedor($id_proveedor){
        $this->id_proveedor = $id_proveedor;
    }

    public function getId_proveedor(){
        return $this->id_proveedor;
    }

    public function setNombre($nombre){
        $this->nombre = $nombre;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function setDescontinuado($descontinuado){
        $this->descontinuado = $descontinuado;
    }

    public function getDescontinuado(){
        return $this->descontinuado;
    }

    public function insertDatos(){
        try {
            $stm = $this-> dbPDO -> prepare("INSERT INTO productos (id_categoria, precio, stock, unidades, id_proveedor, nombre, descontinuado) values(?,?,?,?,?,?,?)");
            $stm -> execute([$this->id_categoria, $this->precio, $this->stock, $this->unidades, $this->id_proveedor, $this->nombre, $this->descontinuado]);
        } catch (Exception $e) {
            return var_dump($e->getMessage());
        }
    }

    public function obtener(){
        try {
            $stm = $this->dbPDO->prepare("SELECT productos.id, categorias.nombreCategoria, productos.precio, productos.stock, productos.unidades, proveedores.nombreProveedor, productos.nombre, productos.descontinuado FROM productos INNER JOIN categorias ON productos.id_categoria = categorias.id INNER JOIN proveedores ON productos.id_proveedor = proveedores.id");
            $stm -> execute();
            return $stm -> fetchAll(); // Método para obtener los registros PDO
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function obtenerCategoria(){
        try {
            $stm = $this->dbPDO->prepare("SELECT id, nombreCategoria FROM categorias");
            $stm -> execute();
            return $stm -> fetchAll(); // Método para obtener los registros PDO
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function obtenerProveedor(){
        try {
            $stm = $this->dbPDO->prepare("SELECT id, nombreProveedor FROM proveedores");
            $stm -> execute();
            return $stm -> fetchAll(); // Método para obtener los registros PDO
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function delete(){
        try {
            $stm = $this->dbPDO->prepare("DELETE FROM productos WHERE id = ?");
            $stm -> execute([$this->id]);
            return $stm-> fetchAll();
            echo "<script>alert('Producto eliminado'); document.location='productos.php'</script>";
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function seleccionar(){
        try {
            $stm = $this->dbPDO->prepare("SELECT * FROM productos WHERE id = ?");
            $stm -> execute([$this->id]);
            return $stm-> fetchAll();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function update(){
        try {
            $stm = $this->dbPDO->prepare("UPDATE productos SET id_categoria = ?, precio = ?, stock = ?, unidades = ?, id_proveedor = ?, nombre = ?, descontinuado = ? WHERE id = ?");
            $stm -> execute([$this->id_categoria, $this->precio, $this->stock, $this->unidades, $this->id_proveedor, $this->nombre, $this->descontinuado, $this->id]);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
?>