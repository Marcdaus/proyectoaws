<?php

    include 'conecsion.php';

// solo pueden acceder a esta paguina los usarios administradores
session_start();
$admin= $_SESSION['admin']; 
$comprobando = "SELECT 
CASE 
    WHEN EXISTS (
        SELECT * FROM trabajadores 
        WHERE  administrador = '$admin' AND contrasena = '$contrasenya'
    ) THEN 1
    ELSE 0
END AS resultado";

$respuesta = $conectar->query($comprobando);
$row = $respuesta->fetch_assoc();
$resultado = $row['resultado'];

if ($resultado == 1) {
        header("Location: /index.php/"); 
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
    <style>
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

        input[type="text"], input[type="submit"] {
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

        <!-- funcionamiento de el boton atras-->
        <?php


            if(isset($_POST['accion'])) {
                $accion = $_POST['accion'];
                if ($accion == 'atras') {
                    header("Location: /administrar.php/"); 
                }
            }
        ?>
<?php

    
    $todos_trabajadores = "SELECT * FROM `trabajadores`";
    $ejecutado = $conectar->query($todos_trabajadores);

    while ($fila = $ejecutado->fetch_assoc()) {
        // Agregar los datos de cada trabajador al arreglo
        $trabajadores[] = $fila;
    }

    foreach ($trabajadores as $trabajador) {
    echo '<form style="display: inline-block;">
            <input type="text" name="id" size="35" value="' . $trabajador["nombre"]  . '" required>
            <input type="text" name="id" size="35" value="' . $trabajador["contrasena"]  . '" required>
            <label for="admin">Administrador:</label>
            <select name="administrador" required>
                <option value="si"' . ($trabajador["administrador"] == "si" ? ' selected' : '') . '>Sí</option>
                <option value="no"' . ($trabajador["administrador"]  == "no" ? ' selected' : '') . '>No</option>
            </select>
            <button class="btnE" type="submit" name="accion" value="eliminar"><b>eliminar</b></button>
            <button class="btnG" type="submit" name="accion" value="guardar"><b>guardar</b></button>
          </form>';

          if(isset($_POST['accion'])) {
            $accion = $_POST['accion'];
            if ($accion == 'eliminar') {
                header("Location: /fichaje.php/"); 
            }
        }

    
        }

        
    
    ?>


</body>
</html>
