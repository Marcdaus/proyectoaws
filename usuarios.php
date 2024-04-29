<?php
    include 'conexion_admin.php';

    // funcionamiento de el boton atras y añadir y actualizaxion del boton guardar

    if(isset($_POST['accion'])) {
        $accion = $_POST['accion'];
    if ($accion == 'atras') {
        header("Location: /administrar.php/"); 
    } elseif ($accion == 'anadir') {
        header("Location: /anadir.php/"); 
    }
    elseif ($accion == 'guardar') {
        header("Location: /usuarios.php/"); 
    }
    elseif ($accion == 'eliminar') {
        header("Location: /usuarios.php/"); 
    }
    }


?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>USUARIOS</title>
    <style>
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
                    width: 50%; /* Ancho del contenedor */
                    margin: 0 auto; /* Centrar el contenedor */
                }

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
        .btnG {
            padding: 15px 30px;
            font-size: 18px;
            margin: 0 10px;
            margin-top: 10px;
            cursor: pointer;
            border: none;
            border-radius: 5px;
            background-color: #4FFF33;
            color: #fff;
        }
        .btnE {
            padding: 15px 30px;
            font-size: 18px;
            margin: 0 10px;
            margin-top: 10px;
            cursor: pointer;
            border: none;
            border-radius: 5px;
            background-color: #FF3333;
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


        input[type="text"],
                input[type="password"],
                input[type="submit"] {
                    display: inline-block; /* Mostrar elementos en línea */
                    margin-bottom: 10px; /* Añadir un pequeño margen inferior */
                    padding: 10px; /* Añadir un poco de espacio alrededor del contenido */
                    width: 10%; /* Ancho completo */
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
    <button class="btnA" type="submit" name="accion" value="atras">
    <img src="/var/www/html/atras.png">
</button>
    </form>

    <?php
        $todos_trabajadores = "SELECT * FROM `trabajadores`";
        $ejecutado = $conectar->query($todos_trabajadores);

        while ($fila = $ejecutado->fetch_assoc()) {
            // Agregar los datos de cada trabajador al arreglo
            $trabajadores[] = $fila;
        }

        foreach ($trabajadores as $trabajador) {
            if ($trabajador['id'] != 1) {
                echo '<form method="post" style="display: inline-block;">
                        <input type="hidden" name="id" value="' . $trabajador["id"] . '">
                        <p style="display: inline-block;"> ' . $trabajador["id"] . ' </p>
                        <input type="text" name="usuario" size="20" placeholder="Usuario" value="' . $trabajador["nombre"]  . '" required>
                        <input type="password" placeholder="Contraseña" name="contrasena" size="20" value="' . $trabajador["contrasena"]  . '" required>
                        <label for="admin">Administrador:</label>
                        <select name="administrador" required>
                            <option value="si"' . ($trabajador["administrador"] == "si" ? ' selected' : '') . '>Sí</option>
                            <option value="no"' . ($trabajador["administrador"]  == "no" ? ' selected' : '') . '>No</option>
                        </select>
                        <button class="btnE" type="submit" name="eliminar['.$trabajador["id"].']" value="eliminar"><b>eliminar</b></button>
                        <button class="btnG" type="submit" name="guardar['.$trabajador["id"].']" value="guardar"><b>guardar</b></button>
                    </form>';

                if(isset($_POST['eliminar'][$trabajador["id"]])) {
                    $id_eliminar = $trabajador["id"];
                    $comprobando = "DELETE FROM trabajadores WHERE id = $id_eliminar";
                    $conectar->query($comprobando);
                    header("Location: /usuarios.php/");
                }

                if(isset($_POST['guardar'][$trabajador["id"]])) {
                    $id_guardar = $trabajador["id"];
                    $nuevo_usuario = $_POST['usuario'];
                    $nueva_contrasena = $_POST['contrasena'];
                    $nuevo_administrador = $_POST['administrador'];
                    $actualizar = "UPDATE trabajadores SET nombre = '$nuevo_usuario', contrasena = '$nueva_contrasena', administrador = '$nuevo_administrador' WHERE id = $id_guardar";
                    $conectar->query($actualizar);
                    header("Location: /usuarios.php/");
                }
            }   
        }
    ?>
    <!-- botones de añadir -->
    <form method="post">
        <button class="btn" type="submit" name="accion" value="anadir"><b>añadir</b></button>
    </form>
    </div>

</body>
</html>

