DROP DATABASE IF EXISTS fichar;

CREATE DATABASE fichar;
USE fichar;


CREATE TABLE trabajadores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    contrasena VARCHAR(255) NOT NULL
);

CREATE TABLE entradas_salidas (
    id_trabajador INT AUTO_INCREMENT PRIMARY KEY,
    fecha_hora TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    tipo ENUM('entrada', 'salida') NOT NULL
);

