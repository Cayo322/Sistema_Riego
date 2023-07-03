-- SQLBook: Code

use sistema_riego;
CREATE TABLE `sistema_humedad` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `dato` INT DEFAULT 0,
    `pub_date` DATETIME DEFAULT NOW()
);

CREATE TABLE `sistema_usuario` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `usuario` VARCHAR(100),
    `clave` VARCHAR(100)
);

CREATE TABLE `sistema_planta` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `nombre` VARCHAR(200),
    `pub_date` DATETIME DEFAULT NOW(),
    `descripcion` TEXT,
    `imagen` VARCHAR(200)
);