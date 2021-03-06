CREATE DATABASE dberick;
USE dberick;
CREATE TABLE tbcanal(
id INT AUTO_INCREMENT PRIMARY KEY,
canal VARCHAR(20) NOT NULL
);

CREATE TABLE tbcargo(
id INT AUTO_INCREMENT PRIMARY KEY,
cargo VARCHAR(20) NOT NULL
);

CREATE TABLE tbcategoria(
id INT AUTO_INCREMENT PRIMARY KEY,
categoria VARCHAR(30) NOT NULL
);

CREATE  TABLE tbclasecliente(
id INT AUTO_INCREMENT PRIMARY KEY,
clase VARCHAR(20) NOT NULL
);

CREATE TABLE tbclientes(
id INT AUTO_INCREMENT PRIMARY KEY,
nombres VARCHAR(50) NOT NULL,
apellidos VARCHAR(50),
sexo INT NOT NULL,
tipo_doc INT NOT NULL,
num_doc VARCHAR(11),
celular VARCHAR(9),
correo VARCHAR(50),
password VARCHAR(50) DEFAULT '1234' NOT NULL,
departamento INT NOT NULL,
provincia VARCHAR(30),
distrito VARCHAR(30),
direccion VARCHAR(50),
clase INT NOT NULL
);

CREATE TABLE tbcomentarios(
id INT AUTO_INCREMENT PRIMARY KEY,
id_pedido INT NOT NULL,
fecha DATE NOT NULL,
comentario VARCHAR(200) NOT NULL
);

CREATE TABLE tbdepartamento(
id INT AUTO_INCREMENT PRIMARY KEY,
departamento VARCHAR(30) NOT NULL
);

CREATE TABLE tbdocumento(
id INT AUTO_INCREMENT PRIMARY KEY,
tipo_doc VARCHAR(30) NOT NULL
);

CREATE TABLE tbentrega(
id INT AUTO_INCREMENT PRIMARY KEY,
tipo_entrega VARCHAR(20) NOT NULL,
precio DECIMAL(10,2) NOT NULL
);

CREATE TABLE tbestadopedido(
id INT AUTO_INCREMENT PRIMARY KEY,
estado_pedido VARCHAR(30) NOT NULL
);

CREATE TABLE tbestadoventa(
id INT AUTO_INCREMENT PRIMARY KEY,
estado VARCHAR(30) NOT NULL
);

CREATE TABLE tbmeses(
id INT AUTO_INCREMENT PRIMARY KEY,
mes VARCHAR(20) NOT NULL
);

CREATE TABLE tbpedidos(
id INT AUTO_INCREMENT PRIMARY KEY,
id_usuario INT NOT NULL,
id_cliente INT NOT NULL,
id_producto INT NOT NULL,
cantidad INT NOT NULL,
monto DECIMAL(10,2) NOT NULL,
tipo_entrega INT NOT NULL,
tipo_pago INT NOT NULL,
monto_total DECIMAL(10,2) NOT NULL,
estado_pedido INT NOT NULL,
canal INT NOT NULL
);

CREATE TABLE tbproducto(
id INT AUTO_INCREMENT PRIMARY KEY,
producto VARCHAR(50) NOT NULL,
descripcion VARCHAR(200),
marca VARCHAR(20),
modelo VARCHAR(20),
categoria INT NOT NULL,
precio_costo DECIMAL(10,2) NOT NULL,
precio_venta DECIMAL(10,2) NOT NULL,
ganancia DECIMAL(10,2) NOT NULL,
stock INT,
imagen_min LONGBLOB,
imagen_max LONGBLOB
);

CREATE TABLE tbsexo(
id INT AUTO_INCREMENT PRIMARY KEY,
sexo VARCHAR(20) NOT NULL
);

CREATE TABLE tbtipopago(
id INT AUTO_INCREMENT PRIMARY KEY,
tipo_pago VARCHAR(30) NOT NULL
);

CREATE TABLE tbusuario(
id INT AUTO_INCREMENT PRIMARY KEY,
nombres VARCHAR(50) NOT NULL,
apellidos VARCHAR(50) NOT NULL,
sexo INT NOT NULL,
tipo_doc INT NOT NULL,
num_doc VARCHAR(11) NOT NULL,
celular VARCHAR(9) NOT NULL,
correo VARCHAR(50) NOT NULL,
password VARCHAR(30) DEFAULT '1234' NOT NULL,
cargo INT NOT NULL
);

CREATE TABLE tbventas(
id INT AUTO_INCREMENT PRIMARY KEY,
id_pedido INT NOT NULL,
fecha DATETIME NOT NULL,
estado_venta INT NOT NULL
);

