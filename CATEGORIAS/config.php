<?php 

ini_set("display_errors", 1);

ini_set("display_startup_errors", 1);

error_reporting(E_ALL);

require_once("../db.php");
require_once("../PDO.php");

class Config extends AbstractPdo{
    
    private $id;
    private $nombreCategoria;
    private $descripcion;
    private $imagen;

    public function __construct($id = 0, $nombreCategoria = "", $descripcion = "", $imagen = "", $dbPDO = ""){
    
        $this->id = $id;
        $this->nombreCategoria = $nombreCategoria;
        $this->descripcion = $descripcion;
        $this->imagen = $imagen;
        parent::__construct($dbPDO);
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getId(){
        return $this->id;
    }

    public function setNombreCategoria($nombreCategoria){
        $this->nombreCategoria = $nombreCategoria;
    }

    public function getNombreCategoria(){
        return $this->nombreCategoria;
    }

    public function setDescripcion($descripcion){
        $this->descripcion = $descripcion;
    }

    public function getDescripcion(){
        return $this->descripcion;
    }

    public function setImagen($imagen){
        $this->imagen = $imagen;
    }

    public function getImagen(){
        return $this->imagen;
    }

    public function insertDatos(){
        try {
            $stm = $this-> dbPDO -> prepare("INSERT INTO categorias (nombreCategoria, descripcion, imagen) values(?,?,?)");
            $stm -> execute([$this->nombreCategoria, $this->descripcion, $this->imagen]);
        } catch (Exception $e) {
            return var_dump($e->getMessage());
        }
    }

    public function obtener(){
        try {
            $stm = $this->dbPDO->prepare("SELECT * FROM categorias");
            $stm -> execute();
            return $stm -> fetchAll(); // Método para obtener los registros PDO
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function delete(){
        try {
            $stm = $this->dbPDO->prepare("DELETE FROM categorias WHERE id = ?");
            $stm -> execute([$this->id]);
            return $stm-> fetchAll();
            echo "<script>alert('Categoria eliminada'); document.location='categorias.php'</script>";
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function seleccionar(){
        try {
            $stm = $this->dbPDO->prepare("SELECT * FROM categorias WHERE id = ?");
            $stm -> execute([$this->id]);
            return $stm-> fetchAll();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function update(){
        try {
            $stm = $this->dbPDO->prepare("UPDATE categorias SET nombreCategoria = ?, descripcion = ?, imagen = ? WHERE id = ?");
            $stm -> execute([$this->nombreCategoria, $this->descripcion, $this->imagen, $this->id]);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
?>