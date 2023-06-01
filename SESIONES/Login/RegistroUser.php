<?php 

ini_set("display_errors", 1);

ini_set("display_startup_errors", 1);

error_reporting(E_ALL);

require_once("../../db.php");
require_once("../Config/conectar.php");
require_once("LoginUser.php");

class RegistroUser extends Conectar {
    
    private $id;
    private $email;
    private $username;
    private $password;

    public function __construct($id = 0, $email = "", $username = "", $password = "", $dbCnx = ""){
        $this->id = $id;
        $this->email = $email;
        $this->username = $username;
        $this->password = $password;
        parent:: __construct($dbCnx);
    }

    function setId($id){
        $this->id = $id;
    }

    function getId(){
        return $this->id;
    }

    function setEmail($email){
        $this->email = $email;
    }

    function getEmail(){
        return $this->email;
    }

    function setUsername($username){
        $this->username = $username;
    }

    function getUsername(){
        return $this->username;
    }

    function setPassword($password){
        $this->password = $password;
    }

    function getPassword(){
        return $this->password;
    }

    public function checkUser($email){
        try {
            $stm = $this->dbCnx->prepare("SELECT * FROM users WHERE email = '$email'");
            $stm->execute();
            if ($stm->fetchColumn()){
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function insertData(){
        try {
            $stm = $this->dbCnx->prepare("INSERT INTO users (email, username, password) values (?,?,?)");
            $stm -> execute([$this->email, $this->username, MD5($this->password)]);
            
            $login = new LoginUser();

            $login->setEmail($_POST["email"]);
            $login->setPassword($_POST["password"]);

            $success = $login->login();

        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}

?>