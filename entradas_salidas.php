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