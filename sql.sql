CREATE DATABASE finanzas;
USE finanzas;

CREATE TABLE cat_egresos (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL
) engine=InnoDB;

CREATE TABLE egresos (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    monto DECIMAL(10,2) NOT NULL,
    concepto VARCHAR(255) NOT NULL,
    fecha DATETIME NOT NULL,
    id_cat INT NOT NULL,
    INDEX(id_cat), FOREIGN KEY(id_cat) REFERENCES cat_egresos(id)
) engine=InnoDB;

CREATE TABLE limite (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    monto DECIMAL(10,2) NOT NULL,
    mes DATE NOT NULL,
    id_cat INT NOT NULL,
    INDEX(id_cat), FOREIGN KEY(id_cat) REFERENCES cat_egresos(id)
) engine=InnoDB;

CREATE TABLE cat_ingresos (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL
) engine=InnoDB;

CREATE TABLE ingresos (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    monto DECIMAL(10,2) NOT NULL,
    concepto VARCHAR(255) NOT NULL,
    fecha DATETIME NOT NULL,
    id_cat INT NOT NULL,
    INDEX(id_cat), FOREIGN KEY(id_cat) REFERENCES cat_ingresos(id)
) engine=InnoDB;

CREATE TABLE meta_ahorro (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    monto_meta DECIMAL(10,2) NOT NULL,
    saldo DECIMAL(10,2) NOT NULL
) engine=InnoDB;

CREATE TABLE movimiento (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    monto DECIMAL(10,2) NOT NULL,
    tipo ENUM('INGRESO','EGRESO') NOT NULL,
    fecha DATETIME NOT NULL,
    id_meta INT NOT NULL,
    INDEX(id_meta), FOREIGN KEY(id_meta) REFERENCES meta_ahorro(id)
) engine=InnoDB;
``` 