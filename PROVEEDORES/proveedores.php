<?php 

ini_set("display_errors", 1);

ini_set("display_startup_errors", 1);

error_reporting(E_ALL);

require_once("config.php");

$data = new Config();

$all = $data->obtener();

?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PROVEEDORES</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" href="css/proveedores.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body>
  <div class="boxes">
    <div class="izquierda">
      <h1>MENU</h1>
      <div class="flexMenu">
        <a href="../CATEGORIAS/categorias.php" style="text-decoration: none" class="colora">CATEGORIAS</a>
        <a href="../CLIENTES/clientes.php" style="text-decoration: none" class="colora">CLIENTES</a>
        <a href="../EMPLEADOS/empleados.php" style="text-decoration: none" class="colora">EMPLEADOS</a>
        <a href="../FACTURAS/facturas.php" style="text-decoration: none" class="colora">FACTURAS</a>
        <a href="../DETALLES/detalles.php" style="text-decoration: none" class="colora">DETALLE DE FACTURAS</a>
        <a href="../PRODUCTOS/productos.php" style="text-decoration: none" class="colora">PRODUCTOS</a>
        <a href="../PROVEEDORES/proveedores.php" style="text-decoration: none" class="colora">PROVEEDORES</a>
      </div>
      </div>
    <div class="container">
      <div class="boton">
        <button class="btn btn-success botoncito" data-bs-toggle="modal" data-bs-target="#registrarProveedores"><i class="bi bi-person-add" ></i></button>
      </div>
      <h1>PROVEEDORES</h1>
      <table class="table table-stripped table-success" style="text-align:center;">
                <thead>
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">NOMBRE</th>
                    <th scope="col">TELEFONO</th>
                    <th scope="col">CIUDAD</th>
                    <th scope="col">BORRAR</th>
                    <th scope="col">EDITAR</th>
                  </tr>
                </thead>
                <tbody class="tabla" id="tabla">
                    <?php
                      foreach($all as $key => $value){
                    ?>
                    <tr>
                      <td><?= $value['id']?></td>
                      <td><?= $value['nombreProveedor']?></td>
                      <td><?= $value['telefono']?></td>
                      <td><?= $value['ciudad']?></td>
                      <td>
                        <a class="btn btn-danger" href="borrarProveedor.php?id=<?=$value['id']?>&req=delete">Borrar</a>
                      </td>
                      <td>
                        <a class="btn btn-warning" href="actualizarProveedores.php?id=<?=$value['id']?>">Editar</a>
                      </td>
                    </tr>
                        <?php }?>
                </tbody>
              </table>
    </div>
  </div>











<div class="modal fade" id="registrarProveedores" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="backdrop-filter: blur(5px)">
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" >
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Nuevo Proveedor</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body" style="background-color: rgb(231, 253, 246);">
            <form class="col d-flex flex-wrap" action="registrarProveedor.php" method="post">
              <div class="mb-1 col-12">
                <label for="nombreProveedor" class="form-label">Nombre del Proveedor</label>
                <input 
                  type="text"
                  id="nombreProveedor"
                  name="nombreProveedor"
                  class="form-control"  
                />
              </div>

              <div class="mb-1 col-12">
                <label for="telefono" class="form-label">Teléfono</label>
                <input 
                  type="text"
                  id="telefono"
                  name="telefono"
                  class="form-control"  
                />
              </div>
              <div class="mb-1 col-12">
                <label for="ciudad" class="form-label">Ciudad</label>
                <input 
                  type="text"
                  id="ciudad"
                  name="ciudad"
                  class="form-control"  
                />
              </div>
              <div class=" col-12 m-2">
                <input type="submit" class="btn btn-primary" value="Enviar" name="guardar"/>
              </div>
            </form>  
         </div>       
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
      crossorigin="anonymous"></script>

      <footer class="foot">
          <h5>© Copyright - TODOS LOS DERECHOS RESERVADOS | Javier Andrés Núñez Sánchez PROFESSIONAL DESIGNER</h5>
          <p>Colombia - Santander</p>
        </footer>
</body>

</html>