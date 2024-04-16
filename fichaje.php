<?php
    include 'conecsion.php';

    // solo pueden acceder a esta paguina los usarios de la lista
    session_start();
    $id = $_SESSION['id']; 
    $contrasenya = $_SESSION['contrasenya']; 
    $comprobando = "SELECT 
                    CASE 
                    WHEN EXISTS (SELECT * FROM trabajadores WHERE id = '$id' AND contrasena = '$contrasenya')  
                    THEN 1
                    ELSE 0
                    END AS resultado";

    $respuesta = $conectar->query($comprobando);
    $row = $respuesta->fetch_assoc();
    $resultado = $row['resultado'];

    if ($resultado == 0) {
        header("Location: /index.php/"); 
    }
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <title>FICHAJES</title>
        <style>
            body {
            font-family: Arial, sans-serif;
            text-align: center;
            }

            .btn {
            padding: 50px 100px;
            font-size: 18px;
            margin: 0 10px;
            margin-top: 150px;
            cursor: pointer;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: #fff;
            }

            .btnA {
            padding: 25px 50px;
            font-size: 18px;
            margin-left: 500px;
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

        <!-- botones de aministador  -->
        <!-- solo se mostrara si el usuario es administrador  -->
        <?php

            $consulta_administrador = "SELECT administrador FROM `trabajadores` WHERE id=$id";
            $resultado_administrador = $conectar->query($consulta_administrador);
            $inf_admin = $resultado_administrador->fetch_assoc();
            $admin_sn = $inf_admin['administrador'];

            if ($admin_sn == 'si') {
                echo '<form method="post" action="">';
                echo '<button class="btnA" type="submit" name="accion" value="administrar"><b>Administrar</b></button>';
                echo '</form>';
    
              if(isset($_POST['accion'])) {
                    $accion = $_POST['accion']; 
                    if ($accion == 'administrar') {
                        session_start();
                        $_SESSION['admin'] = "si";
                        header("Location: /administrar.php/"); 
                    }
                }
            }

        ?>  

        <!-- botones de entrada y salida  -->

        <form method="post">
            <button class="btn" type="submit" name="accion" value="entrada"><b>Entrada</b></button>
            <button class="btn" type="submit" name="accion" value="salida"><b>Salida</b></button>
        </form>


        <!-- funcionamiento de los botones de entrada y salida -->
        <?php

            $consulta_trabajdores = "SELECT * FROM `trabajadores` WHERE id=$id ";
            $result = $conectar->query($consulta_trabajdores);
            $datos = $result->fetch_assoc();
            $nombre = $datos["nombre"];

            if(isset($_POST['accion'])) {
                $accion = $_POST['accion'];
                if ($accion == 'entrada') {
                    $entrada = "INSERT INTO entradas_salidas (trabajador_id, nombre, fecha_hora, tipo) VALUES ($id, '$nombre', CURRENT_TIMESTAMP, 'entrada')";
                    $conectar->query($entrada);
                    echo "Entrada registrada correctamente";
                }
                elseif ($accion == 'salida') {
                    $salida = "INSERT INTO entradas_salidas (trabajador_id, nombre, fecha_hora, tipo) VALUES ($id, '$nombre', CURRENT_TIMESTAMP, 'salida')";
                    $conectar->query($salida);
                    echo "Salida registrada correctamente";
                }
            }

        ?>

    </body>
</html>

