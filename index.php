<?php
include 'conexion.php';
?>
<!DOCTYPE html>
<html>
        <head>
            <title>Inicio de sesión</title>

            <style>
                form {
                margin-bottom: 10px; /* Añadimos un poco de margen inferior */
                }
                input[type="text"], input[type="submit"] {
                display: inline-block; /* Mostrar elementos en línea */
                margin-right: 5px; /* Añadir un pequeño margen entre los elementos */
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
                .btn {
                padding: 20px 100px;
                font-size: 18px;
                margin: 0 10px;
                cursor: pointer;
                border: none;
                border-radius: 10px;
                background-color: #3498DB;
                color: #fff;
                }


            </style>
        </head>
        <body >
            <div class="container">
                <h2>Iniciar sesión</h2>

                <form method="post">
                    <label>ID USUARIO</label><br>
                    <p></p>
                    <input type="number" name="id" size="35" required><br>
                    <p></p>
                    <label>CONTRASEÑA</label><br>
                    <p></p>
                    <input type="password" name="contrasenya" size="35" required><br>
                    <p></p>
                    <button class="btn" type="submit" value="Iniciar sesión"><b>Iniciar sesión</b></button>
                </form>

                <?php

                    $id = $_POST['id'];
                    $contrasenya = $_POST['contrasenya'];
 
                    session_start();
                   $_SESSION['id'] = "$id";
                   $_SESSION['contrasenya'] = "$contrasenya";   

                    if (strlen($id) > 0 && strlen($contrasenya) > 0) {

                        $comprobando = "SELECT 
                                CASE 
                                    WHEN EXISTS (
                                        SELECT * FROM trabajadores 
                                        WHERE id = '$id' AND contrasena = '$contrasenya'
                                    ) THEN 1
                                ELSE 0
                                END AS resultado";
                        $respuesta = $conectar->query($comprobando);
                        $row = $respuesta->fetch_assoc();
                        $result = $row['resultado'];

                        if ($result == 1) {
                            header("Location: /fichaje.php/"); 
                            } 
                            else {
                                echo "<span style=\"color: red;\">el usuario y la contraseña no coinciden</span>";
                            }
                        
                    }   
                ?>
             </div>
        </body> 
</html>


