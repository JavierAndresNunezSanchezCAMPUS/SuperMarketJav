<?php 

ini_set("display_errors", 1);

ini_set("display_startup_errors", 1);

error_reporting(E_ALL);

if(isset($_POST["registrarse"])){
    require_once("RegistroUser.php");

    $register = new RegistroUser();

    $register -> setEmail($_POST["email"]);
    $register -> setUsername($_POST["username"]);
    $register -> setPassword($_POST["password"]);

    
    if ($register->checkUser($_POST["email"])){
        echo "<script>alert('Usuario existente'); location='loginRegister.php'</script>";
    } else {
        echo "<script>alert('Registro exitoso'); location='../../EMPLEADOS/empleados.php'</script>";
        $register -> insertData();
    }
}

?>