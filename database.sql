
-- CREATE DATABASE appsalon_mvc DEFAULT CHARACTER SET utf8 ; 
--  utf8' es actualmente un alias para el juego de caracteres UTF8MB3, pero será un alias para UTF8MB4 en una versión futura. Considere utilizar UTF8MB4 para no tener ambigüedades. 

CREATE DATABASE appsalon_mvc DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;

USE appsalon_mvc;

CREATE TABLE usuarios(
    `id` INT NOT NULL AUTO_INCREMENT,
    `nombre` VARCHAR(60) NULL,
    `apellido` VARCHAR(60) NULL,
    `imagen` VARCHAR(90),
    `email` VARCHAR(60) NULL,
    `telefono` VARCHAR(10) NULL,
    `admin` TINYINT(1) NULL,
    `confirmado` TINYINT(1) NULL,
    `token` VARCHAR(60) NULL,
    PRIMARY KEY (`id`)
);

CREATE TABLE servicios(
    `id` INT NOT NULL AUTO_INCREMENT,
    `nombre` VARCHAR(60) NULL,
    `precio` DECIMAL(9,2),
    PRIMARY KEY (`id`)
);

CREATE TABLE citas(
    `id` INT NOT NULL AUTO_INCREMENT,
    `fecha` date NULL,
    `hora` time NULL,
    `usuarioId` INT,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`usuarioId`) REFERENCES `usuarios` (`id`)
    ON DELETE SET NULL
    ON UPDATE SET NULL
);

CREATE TABLE citasServicios(
    `id` INT NOT NULL AUTO_INCREMENT,
    `citaId` INT NULL,
    `servicioId` INT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`citaId`) REFERENCES `citas` (`id`)
        ON DELETE SET NULL
        ON UPDATE SET NULL,
    FOREIGN KEY (`servicioId`) REFERENCES `servicios` (`id`)
        ON DELETE SET NULL
        ON UPDATE SET NULL
);



INSERT INTO `servicios` (`id`,`nombre`,`precio`) VALUES
    (1,'Corte de Cabello Mujer', 50000),
    (2,'Corte de Cabello Hombre', 30000),
    (3,'Corte de Cabello Niño', 20000),
    (4,'Peinado Mujer', 70000),
    (5,'Peinado Hombre', 50000),
    (6,'Peinado Niño', 40000),
    (7,'Corte de Barba', 20000),
    (8,'Tinte Mujer', 50000),
    (9,'Uñas', 30000),
    (10,'Lavado de Cabello', 60000),
    (11,'Tratamiento Capilar', 150000);

-- Automaticamente cuando se guarden en mysql, se le agregan los 2 decimales quedado asi: 50000.00