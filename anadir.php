<?php
include 'conexion_admin.php';

if(isset($_POST['accion']) && $_POST['accion'] == 'añadir') {

    // Obtener datos del formulario
    $nombre = $_POST['nombre'];
    $contrasena = $_POST['contrasena'];
    $admin = $_POST['administrador'];
    $id = $_POST['id'];

    // Verificar si el ID ya existe
    $consulta = "SELECT id FROM trabajadores WHERE id = '$id'";
    $resultado = $conectar->query($consulta);

    if ($resultado->num_rows > 0) {
        echo "Error: El ID ya existe.";
    } else {
        // Insertar el nuevo usuario si el ID no existe
        $insertando = "INSERT INTO trabajadores (id, nombre, contrasena, administrador) VALUES ('$id', '$nombre', '$contrasena', '$admin')";
        $conectar->query($insertando);
        header("Location: /usuarios.php");
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>AÑADIR</title>

    <style>
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
        body {
            font-family: Arial, sans-serif;
            text-align: center;
        }

        input[type="text"], input[type="submit"] {
            display: inline-block; 
            margin-right: 5px; 
            font-size: 18px;
            margin-top: 10px; 
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
    if(isset($_POST['accion']) && $_POST['accion'] == 'atras') {
        header("Location: /usuarios.php");  
    }
    ?>

    <form method="post">
        <label for="id">ID:</label>
        <input type="text" name="id" size="5" required>
        <br><br>
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" size="35" value="" required>
        <br><br>
        <label for="contrasena">Contraseña:</label>
        <input type="text" name="contrasena" size="35" value="" required>
        <br><br>
        <p>Administrador</p>
        <select name="administrador" required>
            <option value="si">Sí</option>
            <option value="no">No</option>
        </select>
        <br><br>
        <button class="btn" type="submit" name="accion" value="añadir"><b>Añadir Usuario</b></button>
    </form>
</body>
</html>
