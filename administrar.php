<?php
    include 'conexion_admin.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">

<title>ADMINISTACION</title>
<style>
  body {
    font-family: Arial, sans-serif;
    text-align: center;
  }

  .btn {
    padding: 50px 100px;
    font-size: 18px;
    margin: 0 10px;
    margin-top: 300px;
    cursor: pointer;
    border: none;
    border-radius: 5px;
    background-color: #007bff;
    color: #fff;
  }
  .btnA {
            padding: 25px 50px;
            font-size: 18px;
            margin-right: 500px;
            margin-top: 0px;
            cursor: pointer;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: #fff;
            }

</style>
</head>
<body>
    <!-- botones de atras  -->
        <form method="post">
            <button class="btnA" type="submit" name="accion" value="atras"><b>atras</b></button>
        </form>


        <!-- funcionamiento de el boton atras-->
        <?php


            if(isset($_POST['accion'])) {
                $accion = $_POST['accion'];
                if ($accion == 'atras') {
                    header("Location: /fichaje.php/"); 
                }
            }
        ?>

<!-- botones de entrada y salida  -->

  <form method="post">
    <button class="btn" type="submit" name="accion" value="usuarios"><b>Usuarios</b></button>
    <button class="btn" type="submit" name="accion" value="entradas_salidas"><b>Entradas y Salidas</b></button>
  </form>


<!-- funcionamiento de los botones de usuarios y entradas_salidas-->

<?php

if(isset($_POST['accion'])) {
    $accion = $_POST['accion'];
    if ($accion == 'usuarios') {
        header("Location: /usuarios.php/"); 
    } elseif ($accion == 'entradas_salidas') {
        header("Location: /entradas_salidas.php/"); 
    }
}

?>

</body>
</html>