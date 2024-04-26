<?php
    include 'conexion_admin.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>USUARIOS</title>
    <style>
          .btn {
            padding: 25px 50px;
            font-size: 18px;
            margin: 0 10px;
            margin-top: 100px;
            cursor: pointer;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
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

        body {
            font-family: Arial, sans-serif;
            text-align: center;
        }

        input[type="text"], input[type="password"], input[type="submit"], select {
            display: inline-block; 
            margin-right: 5px; 
            font-size: 18px;
            margin-top: 0px; 
        }
    </style>
</head>
<body>
    <!-- botones de atras  -->
    <form method="post">
        <button class="btnA" type="submit" name="accion" value="atras"><b>atras</b></button>
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
    <!-- botones de atras  -->
    <form method="post">
        <button class="btn" type="submit" name="accion" value="anadir"><b>añadir</b></button>
    </form>

    <!-- funcionamiento de el boton atras-->
    <?php

        if(isset($_POST['accion'])) {
            $accion = $_POST['accion'];
        if ($accion == 'atras') {
            header("Location: /administrar.php/"); 
        } elseif ($accion == 'anadir') {
            header("Location: /anadir.php/"); 
        }
        }

?>
</body>
</html>

