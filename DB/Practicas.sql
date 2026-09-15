CREATE DATABASE IF NOT EXISTS Practicas;
USE Practicas;

CREATE TABLE IF NOT EXISTS Usuarios (
    cod_usuario INT PRIMARY KEY AUTO_INCREMENT,
    nombres VARCHAR(100) NOT NULL,
    apellidos VARCHAR(100) NOT NULL,
    telefono VARCHAR(15) NOT NULL,
    fecha_nacimiento DATE NOT NULL,
    direccion VARCHAR(150) NOT NULL,
    correo VARCHAR(100) UNIQUE NOT NULL,
    contrasena VARCHAR(255) NOT NULL
);