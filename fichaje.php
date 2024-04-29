<?php
    include 'conexion.php';

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
            

        .btn {
            padding: 25px 50px;
            font-size: 18px;
            margin: 0 10px;
            margin-top: 50px;
            cursor: pointer;
            border: none;
            border-radius: 5px;
            background-color: #3498DB;
            color: #fff;
        }
        .btnAtras {
    padding: 25px 50px;
    font-size: 18px;
    margin-right: 500px;
    margin-top: 0px;
    cursor: pointer;
    border: none;
    border-radius: 5px;
    background-color: #007bff;
    color: #fff;
    background-image: url('/var/www/html/atras.png');
    background-size: cover; 
    background-position: center; 
}



        .btnA {
            padding: 25px 50px;
            font-size: 18px;
            margin-top: 20px;
            cursor: pointer;
            border: none;
            border-radius: 5px;
            background-color: #F5B041;
            color: #fff;
        }
        body {
                    font-family: Arial, sans-serif;
                    text-align: center;
                    background-color: #AED6F1
                }
                .container {
                    background-color: rgba(128, 128, 128, 0.3); /* Gris translúcido */
                    padding: 20px;
                    border-radius: 10px;
                    border-color: #2980B9;
                    width: 30%; /* Ancho del contenedor */
                    margin: 0 auto; /* Centrar el contenedor */
                }
                input[type="number"],
                input[type="password"],
                input[type="submit"] {
                    display: inline-block; /* Mostrar elementos en línea */
                    margin-bottom: 10px; /* Añadir un pequeño margen inferior */
                    padding: 10px; /* Añadir un poco de espacio alrededor del contenido */
                    width: 70%; /* Ancho completo */
                    border-radius: 10px; /* Bordes redondeados */
                    border: 2px solid #1B2631; 
                    background-color: rgba(128, 128, 128, 0.3); 
                }
    </style>
</head>
<body>
<div class="container">
        <!-- botones de atras  -->
        <form method="post">
            <button class="btnAtras" type="submit" name="accion" value="atras"><b>atras</b></button>
        </form>


        <!-- funcionamiento de el boton atras-->
        <?php


            if(isset($_POST['accion'])) {
                $accion = $_POST['accion'];
                if ($accion == 'atras') {
                    header("Location: /index.php/"); 
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
                echo "<span style=\"color: green;\">Entrada registrada correctamente</span>";
            }
            elseif ($accion == 'salida') {
                $salida = "INSERT INTO entradas_salidas (trabajador_id, nombre, fecha_hora, tipo) VALUES ($id, '$nombre', CURRENT_TIMESTAMP, 'salida')";
                $conectar->query($salida);
                echo "<span style=\"color: green;\">Salida registrada correctamente</span>";
            }
        }

    ?>
        <!-- botones de aministador  -->
    <!-- solo se mostrara si el usuario es administrador  -->
    <?php
        $consulta_administrador = "SELECT administrador FROM `trabajadores` WHERE id=$id";
        $resultado_administrador = $conectar->query($consulta_administrador);
        $inf_admin = $resultado_administrador->fetch_assoc();
        $admin_sn = $inf_admin['administrador'];

        if ($admin_sn == 'si') {
            echo '<form method="post" action="">';
            echo '    <button class="btnA" type="submit" name="accion" value="administrar"><b>Administrar</b></button>';
            echo '</form>';
    
            if(isset($_POST['accion'])) {
                $accion = $_POST['accion']; 
                if ($accion == 'administrar') {
                    session_start();
                    $_SESSION['admin'] = "$admin";
                    header("Location: /administrar.php/"); 
                }
            }
        }

    ?>  
</div>
</body>
</html>


