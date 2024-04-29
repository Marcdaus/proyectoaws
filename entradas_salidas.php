<?php
include 'conexion_admin.php'; // Incluir archivo de conexión

// Función para obtener las entradas y salidas de un trabajador
function obtenerEntradasSalidas($trabajador_id) {
    global $conectar;
    $consulta = "SELECT * FROM entradas_salidas WHERE trabajador_id = '$trabajador_id'";
    $resultado = $conectar->query($consulta);
    return $resultado;
}

// Función para actualizar la fecha de una entrada o salida
function actualizarFecha($id, $fecha_hora) {
    global $conectar;
    $consulta = "UPDATE entradas_salidas SET fecha_hora = '$fecha_hora' WHERE id = '$id'";
    $conectar->query($consulta);
}

// Verificar si se envió el formulario de actualización
if(isset($_POST['accion']) && $_POST['accion'] == 'actualizar') {
    $id = $_POST['id'];
    $fecha_hora = $_POST['fecha_hora'];
    actualizarFecha($id, $fecha_hora);
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Registro de Entradas y Salidas</title>
</head>
<body>
    <h2>Registro de Entradas y Salidas</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Fecha y Hora</th>
            <th>Tipo</th>
            <th>Acción</th>
        </tr>
        <?php
        // Obtener todas las entradas y salidas del trabajador con ID 1 (puedes cambiar este valor según tus necesidades)
        $trabajador_id = 1;
        $resultado = obtenerEntradasSalidas($trabajador_id);
        while($row = $resultado->fetch_assoc()) {
            echo "<tr>";
            echo "<td>".$row['id']."</td>";
            echo "<td>".$row['nombre']."</td>";
            echo "<td>".$row['fecha_hora']."</td>";
            echo "<td>".$row['tipo']."</td>";
            // Formulario para actualizar la fecha de entrada o salida
            echo "<td>
                    <form method='post'>
                        <input type='hidden' name='id' value='".$row['id']."'>
                        <input type='datetime-local' name='fecha_hora' value='".date('Y-m-d\TH:i:s', strtotime($row['fecha_hora']))."' required>
                        <input type='submit' name='accion' value='actualizar'>
                    </form>
                </td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>
