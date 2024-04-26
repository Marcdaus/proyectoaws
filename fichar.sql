DROP DATABASE IF EXISTS fichar;

CREATE DATABASE fichar;
USE fichar;

CREATE TABLE trabajadores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    contrasena VARCHAR(255) NOT NULL,
    administrador ENUM('no', 'si') NOT NULL
);

CREATE TABLE entradas_salidas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    trabajador_id INT,
    nombre VARCHAR(255) NOT NULL,
    fecha_hora TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    tipo ENUM('entrada', 'salida') NOT NULL,
    FOREIGN KEY (trabajador_id) REFERENCES trabajadores(id)
);

INSERT INTO trabajadores (nombre, contrasena, administrador) VALUES ('admin', 'admin' ,'si');
