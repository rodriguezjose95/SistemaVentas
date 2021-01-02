
-------------------------------------------------------------------------------------------------
-----------------------------/*DATOS PREDETERMINADOS DEL SISTEMA*/-------------------------------
-------------------------------------------------------------------------------------------------

/*TABLA CANAL*/
INSERT INTO tbcanal(canal) VALUES ('Marketplace'),('Whatsapp'),('Mercado Libre'),('Instagram');

/*TABLA CARGO*/
INSERT INTO tbcargo(cargo) VALUES ('Administrador'),('Vendedor');

/*TABLA CLASE DE CLIENTE*/
INSERT INTO tbclasecliente(clase) VALUES ('General'),('Potencial');

/*TABLA DEPARTAMENTOS*/
INSERT INTO tbdepartamento(departamento) VALUES ('Lima/Callao'),('Amazonas'),('Ancash'),('Apurimac'),('Arequipa'),
('Ayacucho'),('Cajamarca'),('Cusco'),('Huancavelica'),('Huanuco'),('Ica'),('Junin'),('La Libertad'),('Lambayeque'),
('Loreto'),('Madre de Dios'),('Moquegua'),('Pasco'),('Piura'),('Puno'),('San Martin'),('Tacna'),('Tumbes'),
('Ucayali');

/*TABLA MESES*/
INSERT INTO tbmeses(mes) VALUES ('Enero'),('Febrero'),('Marzo'),('Abril'),('Mayo'),('Junio'),('Julio'),
('Agosto'),('Septiembre'),('Octubre'),('Noviembre'),('Diciembre');

/*TABLA TIPO DE DOCUMENTO*/
INSERT INTO tbdocumento(tipo_doc) VALUES ('DNI'),('RUC'),('Pasaporte'),('Carnet Extranjería');

/*TABLA TIPO DE ENTREGA*/
INSERT INTO tbentrega(tipo_entrega,precio) VALUES ('Agencia',15),('Curier',20),('Contraentrega',0);

/*TABLA ESTADO DE PEDIDO*/
INSERT INTO tbestadopedido(estado_pedido) VALUES ('Oportunidad'),('Prospecto'),('Aceptado'),('Carterizado');

/*TABLA ESTADO DE VENTA*/
INSERT INTO tbestadoventa(estado) VALUES ('Pagado'),('Enviado'),('Finalizado');

/*TABLA SEXO*/
INSERT INTO tbsexo(sexo) VALUES ('Hombre'),('Mujer');

/*TABLA TIPO DE PAGO*/
INSERT INTO tbtipopago(tipo_pago) VALUES ('Depósito'),('Transferencia'),('Contraentrega'),('Yape'),('Tunki'),
('Lukita'),('Plin'),('Bim');

-------------------------------------------------------------------------------------------------
--------------------------/*DATOS PARA PRUEBA DE SISTEMA OPCIONALES*/----------------------------
-------------------------------------------------------------------------------------------------

/*TABLA USUARIOS*/
INSERT INTO tbusuario (id, nombres, apellidos, sexo, tipo_doc, num_doc, celular, correo, password, cargo) VALUES
(1000, 'Jose Ammon Alfonso', 'Rodriguez Ruiz', 1, 1, '77162002', '936698941', 'josedrake95@gmail.com', '1234', 1),
(1001, 'Andres Alejandro', 'Casimiro Torres', 1, 3, '84565589', '998565452', 'andres@hotmail.com', '1234', 2),
(1002, 'Erick Andres', 'Eustaquio Chavez', 1, 1, '78954562', '969585424', 'erick4d5@gmail.com', '1234', 1),
(1003, 'Claudia', 'García Gutierrez', 1, 1, '2523432', '995456789', 'claudiarulosa@gmail.com', '1234', 2),
(1004, 'Marta Mercedes', 'Pierola Cotrina', 2, 1, '98652300', '989559661', 'marta@outlook.com', '1234', 2),
(1005, 'Cristiano Cristobal', 'Casemiro Diaz', 1, 1, '98562301', '999865258', 'criscase9@hotmail.com', '1234', 2),
(1006, 'Oliveria Policarpia', 'Mamani Quispe', 2, 1, '89562332', '996966123', 'oliveriapmq12@hotmail.com', '1234', 2),
(1007, 'Roberto Andres', 'Martinez Ordoñez', 1, 1, '89456231', '969565823', 'robertordo9@gmail.com', '1234', 2);

/*TABLA CLIENTES*/
INSERT INTO tbclientes(id,nombres,apellidos,sexo,tipo_doc,num_doc,celular,correo,departamento,provincia,distrito,direccion,clase) VALUES
(1000, 'Andres', 'Mamani Quispe', 1, 1, '89456958', '969887542', 'andres@hotmail.com', 8, 'Cusco', 'Ollantaytambo', 'Jr. Machu Picchu 241', 1),
(1001, 'Natsumi Aileen', 'Rodriguez Tocto', 2, 1, '92828181', '969855845', 'natsu18@live.es', 1, 'Lima', 'Carabayllo', 'Av. Condorcanqui 241', 1),
(1003, 'Thiago', 'Rodriguez Tocto', 1, 1, '78459966', '985255448', 'thiago@live.com', 1, 'Lima', 'Carabayllo', 'Av. Condorcanqui 241', 1),
(1005, 'Ingrid Katherine', 'Tocto La Madrid', 2, 2, '75620573', '956888525', 'ingrid9@gmail.com', 1, 'Lima', 'Carabayllo', 'Av. Condorcanqui 241', 1),
(1006, 'Glen', 'Gavidia Medina', 1, 1, '45855569', '954456852', 'glen@hotmail.com', 5, 'Arequipa', 'San Cristobal', 'Jr. Quesohelado 895', 1),
(1007, 'Andrea Ariana', 'Mendoza Caceres', 2, 3, '789544612', '965464564', 'andrea@gmail.com', 15, 'Tarapoto', 'Charapitas', 'Av. Los Shipivos 7896', 1),
(1008, 'Ortencia Melina', 'Casas De La Puente', 2, 1, '78994565', '963698526', 'ortencia@outlook.com', 21, 'Moyobamba', 'Moyobamba', 'Jr. Jaujas 452', 2),
(1009, 'Carla Fiorella', 'Velazco Reyes', 2, 1, '48965412', '999666555', 'fio_95_tulobita@gmail.com', 1, 'Callao', 'La Perla', 'Av. Foucett 4589', 1),
(1010, 'Raven Clarck', 'Reyes ', 2, 3, '896532005', NULL, 'raven100@gmail.com', 1, 'Lima', 'Miraflores', 'Av. El Ejercito 1452', 1),
(1011, 'Julia Carmen', 'Torrico Juarez', 2, 2, '1085585210', '969522587', 'julia@outlook.com', 13, 'Trujillo', 'Trujillo', 'Mz. R Lt. 56 Los Totoras', 1),
(1012, 'Josefa Juliana', 'Oliva Villareal', 2, 1, '00254852', '996966258', 'olivav@live.com', 16, 'Puerto Maldonado', 'Los Girasoles', 'Mz. A Lt. 15 Urb. Los Portales', 1),
(1013, 'Roberto ', 'Rivaguero Lopez', 1, 1, '78595625', NULL, 'robertra@live.com', 20, 'Desaguadero', 'Desaguadero', 'Ca. La Frontera 456', 1),
(1014, 'Rebeca', 'Scribens Suarez', 2, 2, '1589264578', '969542158', 'rss@gmail.com', 1, 'Lima', 'La Molina', 'Av. Javier Prado 5689', 1),
(1015, 'Fernando', 'Arias Cabrera', 1, 1, '78956235', '963696393', 'ferarias@gmail.com', 1, 'Lima', 'Lima', 'Av. Alfonso Ugarte 2365', 1),
(1016, 'Fernando Hernan', 'Fernandez Hernandez', 1, 1, '48622315', '996953158', 'fer2her2@hotmail.com', 7, 'Jaen', 'Jaen', 'AAHH Los Hermanitos Mz. R Lt. ', 1),
(1017, 'Manuel Gilberto', 'Regalado', 1, 1, '82520145', '015823658', NULL, 1, NULL, NULL, NULL, 1),
(1048, 'Yandel', 'Coronavirus Sars', 1, 1, '45454545', '999666999', 'covid-19@gmail.com', 5, 'Arequipa', 'Yanahuara', 'Jr. Wuhan 625', 1),
(1049, 'Fernanda', 'De Las Casas Maldini', 2, 1, '21313123', '997846546', 'ferdaad@gmail.com', 1, 'Lima', 'Ate', 'Av. Industrial 1052', 1),
(1050, 'Harumi', 'Vilchez Torres', 2, 1, '78945658', '996958965', 'haru95@yahoo.com', 1, 'Lima', 'Lima', 'Av. Colon 458', 1),
(1051, 'Sofia', 'Mulanovick', 2, 3, '789456004', '995268123', 'sofimulanocik@gmail.com', 1, 'Lima', 'Miraflores', 'Av. Costanera 1250', 2),
(1052, 'Carolina', 'Yñiguez Valencia', 2, 1, '84512363', '946546546', 'caroyv@yahoo.com', 1, 'Lima', 'Comas', 'Av. Peru 1020', 1),
(1053, 'Elder Carlos', 'Obando Mendez', 1, 2, '1080520252', '958563424', NULL, 1, NULL, NULL, NULL, 1),
(1054, 'Xiomara Cataleya', 'Santiesteban Gomez', 1, 1, '02512565', '958456548', NULL, 1, NULL, NULL, NULL, 1),
(1055, 'Ash', 'Ketchup Mostaza', 1, 1, '95856544', '998456213', 'pokemon-ash@yahoo.com', 1, 'Lima', 'Lima', 'Pueblo Paleta Mz E Lt 8', 1),
(1056, 'Diego', 'Jauregui Meoño', 1, 1, '78945620', '99659812', NULL, 1, NULL, NULL, NULL, 1),
(1057, 'Ines Fanny', 'Hernandez Ruiz', 1, 1, '54120041', '995124154', 'inesita@gmail.com', 1, NULL, NULL, NULL, 1),
(1058, 'Andres', 'Mamani Quispe', 1, 1, NULL, '969887542', 'andres@hotmail.com', 8, 'Cusco', 'Ollantaytambo', 'Jr. Machu Picchu 241', 1),
(1059, 'Jorge', 'Paredes', 1, 1, NULL, '986562032', NULL, 14, 'Chiclayo', NULL, NULL, 2),
(1065, 'Jorge', 'Benavidez', 1, 1, NULL, '999999999', NULL, 14, 'Chiclayo', NULL, NULL, 1),
(1068, 'Alfredo', 'Benavidez', 1, 1, NULL, '984654321', NULL, 14, 'Chiclayo', NULL, NULL, 2),
(1069, 'Alfonso Jesus', 'Ugarte Alvarado', 1, 1, NULL, '969585646', NULL, 1, NULL, NULL, NULL, 1);

/*TABLA CATEGORIA*/
INSERT INTO tbcategoria(categoria) VALUES ('Tecnologia'),('Electrodomesticos'),('Alimentos'),
('Deportes'),('Accesorios'),('Bebidas'),('Fotografía'),('Computadoras'),('Videojuegos'),('Ropa'),
('Herramientas'),('Calzados'),('Cocina');

/*TABLA PRODUCTOS*/
INSERT INTO tbproducto(id,producto,descripcion,marca,modelo,categoria,precio_costo,precio_venta,ganancia,stock) VALUES
(1000, 'Audifonos Bluethoot', 'Nuevos airpods i12 TWS compatible con Android, iOS y Windows. Puedes usarlos de forma
 independiente, microfonos incorporados en ambos auriculares.', 'NatsShop', 'i12 TWS 2019', 1, '30', '65', '35', '15'),
(1002, 'Sarten Electrica', NULL, 'Holstein', 'Electrica', 2, '40', '85', '45', '5'),
(1003, 'Panini Grill', NULL, 'Holstein', 'Electrico', 2, '35', '60', '25', '4'),
(1005, 'Dron', NULL, 'NathShop', 'Mavic Pro Platinum', 7, '230', '450', '220', '10'),
(1007, 'Smart TV 60', NULL, 'LG', 'K50', 1, '1500', '3000', '1500', '5'),
(1008, 'Laptop Core i5 8va Gen. ', NULL, 'HP', 'Pavilion', 8, '1600', '2400', '800', NULL),
(1009, 'Refrigerador 250L', NULL, 'Samsung', 'GT-74', 2, '790', '1290', '500', '6'),
(1014, 'Olla a Presión', NULL, 'Oster', '2020', 2, '45', '85', '40', '7'),
(1015, 'DVD', NULL, 'Samsung', 'G5', 1, '150', '320', '170', '30'),
(1016, 'Celular', NULL, 'Huawei', 'P Smart 2019', 1, '600', '900', '300', '4'),
(1017, 'Microondas', NULL, 'Xiaomi', 'Mi8T', 2, '100', '250', '150', '6'),
(1020, 'Jean', NULL, 'Levis', 'Classic', 10, '55', '175', '120', NULL),
(1021, 'Juego de Tazas', NULL, 'Metro', 'Clasico', 13, '30', '50', '20', '10'),
(1022, 'Zapatillas', NULL, 'Adidas', 'F50', 12, '120', '200', '80', '50'),
(1025, 'Licuadora', '2 Velocidades', 'Holstein', 'H43', 2, '45', '80', '35', '4'),
(1026, 'Play Station 4 256Gb', NULL, 'Sony', 'Slim', 9, '956', '1599', '643', '5');

/*TABLA PEDIDOS*/
INSERT INTO tbpedidos(id,id_usuario,id_cliente,id_producto,cantidad,monto,tipo_entrega,tipo_pago,monto_total,estado_pedido,canal) VALUES
(100,1000,1005,1005,2,900,2,1,920,2,1),
(101,1000,1056,1020,1,175,2,1,195,4,1),
(102,1005,1051,1008,1,2400,1,3,2415,2,1);

/*TABLA COMENTARIOS*/
INSERT INTO tbcomentarios(id_pedido,fecha,comentario) VALUES
(101,'2020-04-03','sin comentarios'),
(101,'2020-04-04','El Cliente acepto la compra, Esperar confirmación ...'),
(102,'2020-04-05','no tiene plata');

/*TABLA VENTAS*/
INSERT INTO tbventas(id,id_pedido,fecha,estado_venta) VALUES
(100,101,'2020-04-03 12:28:44',2);