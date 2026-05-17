use taller_mecanico;

CREATE TABLE `cliente` (
    `id_cliente` INT AUTO_INCREMENT PRIMARY KEY,
    `nombre` VARCHAR(100) NOT NULL,
    `dni_cedula` VARCHAR(20) UNIQUE,
    `telefono` VARCHAR(20),
    `email` VARCHAR(100)
);


CREATE TABLE `vehiculo` (
    `id_vehiculo` INT AUTO_INCREMENT PRIMARY KEY,
    `patente_placa` VARCHAR(15) UNIQUE NOT NULL,
    `marca` VARCHAR(50),
    `modelo` VARCHAR(50),
    `anio` INT,
    `id_cliente` INT,
    FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`) ON DELETE SET NULL
);


CREATE TABLE `personal_taller` (
    `id_personal` INT AUTO_INCREMENT PRIMARY KEY,
    `nombre` VARCHAR(100) NOT NULL,
    `cargo` VARCHAR(50), -- 'Mecánico' o 'Recepcionista'
    `telefono` VARCHAR(20)
);


CREATE TABLE `servicio` (
    `id_servicio` INT AUTO_INCREMENT PRIMARY KEY,
    `nombre_servicio` VARCHAR(100), -- Ej: Cambio de Aceite
    `precio_base` DECIMAL(10,2)
);


CREATE TABLE `repuesto` (
    `id_repuesto` INT AUTO_INCREMENT PRIMARY KEY,
    `nombre_repuesto` VARCHAR(100),
    `precio_unitario` DECIMAL(10,2),
    `stock` INT
);

select * from `historial_servicio`;
CREATE TABLE `historial_servicio` (
    `id_historial` INT AUTO_INCREMENT PRIMARY KEY,
    `id_vehiculo` INT,
    `id_personal` INT, -- Mecánico que atendió
    `id_servicio` INT, -- Qué servicio se hizo
    `fecha` DATE,
    `observaciones` TEXT,
    `costo_final` DECIMAL(10,2),
    FOREIGN KEY (`id_vehiculo`) REFERENCES `vehiculo` (`id_vehiculo`),
    FOREIGN KEY (`id_personal`) REFERENCES `personal_taller` (`id_personal`),
    FOREIGN KEY (`id_servicio`) REFERENCES `servicio` (`id_servicio`)
);

-- Relacionada con personal_taller mediante id_personal
CREATE TABLE `mecanico` (
    `id_personal` INT,
    `especialidad` VARCHAR(100), -- Ej: Frenos, Motor, Electricidad
    `nivel_experiencia` VARCHAR(50), -- Ej: Junior, Senior, Master
    FOREIGN KEY (`id_personal`) REFERENCES `personal_taller` (`id_personal`) ON DELETE CASCADE
);

-- Relacionada con personal_taller mediante id_personal
CREATE TABLE `recepcionista` (
    `id_personal` INT,
    `turno` VARCHAR(50), -- Ej: Mañana, Tarde, Noche
    FOREIGN KEY (`id_personal`) REFERENCES `personal_taller` (`id_personal`) ON DELETE CASCADE
);

INSERT INTO `cliente` (`id_cliente`, `nombre`, `telefono`) VALUES (1, 'Adrián', '555-5684');
INSERT INTO `cliente` (`id_cliente`, `nombre`, `telefono`) VALUES (2, 'Alberto', '555-7591');
INSERT INTO `cliente` (`id_cliente`, `nombre`, `telefono`) VALUES (3, 'Alejandro', '555-6255');
INSERT INTO `cliente` (`id_cliente`, `nombre`, `telefono`) VALUES (4, 'Alfonso', '555-7216');
INSERT INTO `cliente` (`id_cliente`, `nombre`, `telefono`) VALUES (5, 'Álvaro', '555-5131');

select * from `personal_taller`;
INSERT INTO `personal_taller` (`id_personal`, `nombre`, `telefono`) VALUES (1, 'Ernesto', '1405');
INSERT INTO `personal_taller` (`id_personal`, `nombre`, `telefono`) VALUES (2, 'Esteban', '2934');
INSERT INTO `personal_taller` (`id_personal`, `nombre`, `telefono`) VALUES (3, 'Fabio', '2495');
INSERT INTO `personal_taller` (`id_personal`, `nombre`, `telefono`) VALUES (4, 'Federico', '2371');
INSERT INTO `personal_taller` (`id_personal`, `nombre`, `telefono`) VALUES (5, 'Felipe', '2540');
INSERT INTO `personal_taller` (`id_personal`, `nombre`, `telefono`) VALUES (6, 'Fernando', '2200');
INSERT INTO `personal_taller` (`id_personal`, `nombre`, `telefono`) VALUES (7, 'Francisco', '3094');
INSERT INTO `personal_taller` (`id_personal`, `nombre`, `telefono`) VALUES (8, 'Gabriel', '2444');
INSERT INTO `personal_taller` (`id_personal`, `nombre`, `telefono`) VALUES (9, 'Gerardo', '2410');
INSERT INTO `personal_taller` (`id_personal`, `nombre`, `telefono`) VALUES (10, 'Gonzalo', '2396');

select * from `mecanico`;
INSERT INTO `mecanico` (`id_personal`, `especialidad`) VALUES (1, '1');
INSERT INTO `mecanico` (`id_personal`, `especialidad`) VALUES (2, '2');
INSERT INTO `mecanico` (`id_personal`, `especialidad`) VALUES (3, '3');
INSERT INTO `mecanico` (`id_personal`, `especialidad`) VALUES (4, '4');
INSERT INTO `mecanico` (`id_personal`, `especialidad`) VALUES (5, '5');
INSERT INTO `mecanico` (`id_personal`, `especialidad`) VALUES (6, '6');
INSERT INTO `mecanico` (`id_personal`, `especialidad`) VALUES (7, '7');
INSERT INTO `mecanico` (`id_personal`, `especialidad`) VALUES (8, '8');
INSERT INTO `mecanico` (`id_personal`, `especialidad`) VALUES (9, '9');
INSERT INTO `mecanico` (`id_personal`, `especialidad`) VALUES (10, '10');


INSERT INTO `servicio` (`id_servicio`, `precio_base`) VALUES (1, 146.00);
INSERT INTO `servicio` (`id_servicio`, `precio_base`) VALUES (2, 174.00);
INSERT INTO `servicio` (`id_servicio`, `precio_base`) VALUES (3, 253.00);
INSERT INTO `servicio` (`id_servicio`, `precio_base`) VALUES (4, 262.00);
INSERT INTO `servicio` (`id_servicio`, `precio_base`) VALUES (5, 173.00);
INSERT INTO `servicio` (`id_servicio`, `precio_base`) VALUES (6, 141.00);
INSERT INTO `servicio` (`id_servicio`, `precio_base`) VALUES (7, 235.00);
INSERT INTO `servicio` (`id_servicio`, `precio_base`) VALUES (8, 60.00);
INSERT INTO `servicio` (`id_servicio`, `precio_base`) VALUES (9, 138.00);
INSERT INTO `servicio` (`id_servicio`, `precio_base`) VALUES (10, 272.00);

INSERT INTO `vehiculo` (`id_vehiculo`, `patente_placa`, `marca`, `modelo`, `id_cliente`) VALUES (1, '1151ST', 'BMW', 'Sedan', 1);
INSERT INTO `vehiculo` (`id_vehiculo`, `patente_placa`, `marca`, `modelo`, `id_cliente`) VALUES (2, '9813JB', 'Honda', 'Deportivo', 2);
INSERT INTO `vehiculo` (`id_vehiculo`, `patente_placa`, `marca`, `modelo`, `id_cliente`) VALUES (3, '2144XH', 'Honda', 'PickUp', 3);
INSERT INTO `vehiculo` (`id_vehiculo`, `patente_placa`, `marca`, `modelo`, `id_cliente`) VALUES (4, '6744BB', 'BMW', 'Deportivo', 4);
INSERT INTO `vehiculo` (`id_vehiculo`, `patente_placa`, `marca`, `modelo`, `id_cliente`) VALUES (5, '8041UM', 'Honda', 'PickUp', 5);

select * from `recepcionista`;
INSERT INTO `recepcionista` (`id_personal`) VALUES (6);
INSERT INTO `recepcionista` (`id_personal`) VALUES (7);
INSERT INTO `recepcionista` (`id_personal`) VALUES (8);
INSERT INTO `recepcionista` (`id_personal`) VALUES (9);
INSERT INTO `recepcionista` (`id_personal`) VALUES (10);

delete from `recepcionista` where `id_personal`=5;
