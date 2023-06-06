<?php 

$empleados = '[
    {
    "nombre": "Jaime Andres Lizarazo",
    "celular": 312415534,
    "direccion": #46-16,
    "imagen": "3.png",
    "id": 1
    },
    {
    "nombre": "Diego Fernando Tarazona",
    "celular": 315431710,
    "direccion": #95-12,
    "imagen": "4.png",
    "id": 2
    },
    {
    "nombre": "Vermen Ayala",
    "celular": 316565733,
    "direccion": #637-72,
    "imagen": "5.png",
    "id": 3
    },
    {
    "nombre": "Johlver Jose Pardo",
    "celular": 318529384,
    "direccion": #325-51,
    "imagen": "6.png",
    "id": 4
    },
    {
    "nombre": "Miguel Castro",
    "celular": 316953245,
    "direccion": #635-63,
    "imagen": "7.png",
    "id": 5
    },
    {
    "nombre": "Karen Lorena Celis",
    "celular": 317658542,
    "direccion": #14-103,
    "imagen": "8.png",
    "id": 6
    },
    {
    "nombre": "Juan David Castillo",
    "celular": 317388959,
    "direccion": #316-22,
    "imagen": "9.png",
    "id": 7
    },
    {
    "nombre": "Eduar Leonel Cala",
    "celular": 311658475,
    "direccion": #25-256,
    "imagen": "10.png",
    "id": 8
    },
    {
    "nombre": "Eimer Leguizamon",
    "celular": 317045746,
    "direccion": #515-253,
    "imagen": "11.png",
    "id": 9
    },
    {
    "nombre": "AndSergio Valbuena",
    "celular": 319345465,
    "direccion": #41-62,
    "imagen": "12.png",
    "id": 10
    },
    {
    "nombre": "Andres Galvis",
    "celular": 316043367,
    "direccion": #414-64,
    "imagen": "13.png",
    "id": 11
    },
    {
    "nombre": "Angie Suarez",
    "celular": 312685687,
    "direccion": #41-364,
    "imagen": "14.png",
    "id": 12
    },
    {
    "nombre": "Ricardo Diescanezco",
    "celular": 315431110,
    "direccion": #412-7,
    "imagen": "alejandro.jpg",
    "id": 13
    },
    {
    "nombre": "Omar Valera",
    "celular": 315431710,
    "direccion": #143-95,
    "imagen": "diego.jpg",
    "id": 14
    },
    {
    "nombre": "Eustaquio Florez",
    "celular": 315431110,
    "direccion": #943-125,
    "imagen": "haissam.jpg",
    "id": 15
    },
]';

$datosEmpleados = json_decode($empleados, true);

$server = "localhost";
$user = "campus";
$pass = "campus2023";
$bd = "estadisticas";

// Creamos la conexión
$conexion = mysqli_connect($server, $user, $pass,$bd) 
or die("Ha sucedido un error inexperado en la conexion de la base de datos");

foreach ($datosEmpleados as $empleado) {
    
    mysqli_query($conexion,"INSERT INTO empleados (id,nombre,celular,direccion,imagen) 
    VALUES ('".$empleado['id']."','".$empleado['nombre']."','".$empleado['celular']."','".$empleado['direccion']."','".$empleado['imagen']);	
}	

mysqli_close($conexion);

?>