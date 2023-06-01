<?php 

ini_set("display_errors", 1);

ini_set("display_startup_errors", 1);

error_reporting(E_ALL);

session_start();

if(isset($_POST["logearse"])){
    
    require_once("LoginUser.php");

    $creeds = new LoginUser();

    $creeds-> setEmail($_POST["email"]);
    $creeds-> setPassword($_POST["password"]);

    $login = $creeds -> login();

    var_dump($login);
    if ($login){
        echo "<script> alert('Sesion Iniciada correctamente');</script>";
        header("Location: ../../EMPLEADOS/empleados.php");
    } else {
        echo "<script> alert('E-mail o Contraseña invalido(s)');document.location='loginRegister.php'</script>";
    }

}

?>