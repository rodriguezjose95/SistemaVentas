
/*LLAVES FORANEAS*/

/*CLIENTES*/
ALTER TABLE tbclientes ADD CONSTRAINT fk_cli_sexo FOREIGN KEY (sexo) REFERENCES tbsexo(id) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE tbclientes ADD CONSTRAINT fk_cli_doc FOREIGN KEY (tipo_doc) REFERENCES tbdocumento(id) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE tbclientes ADD CONSTRAINT fk_cli_depa FOREIGN KEY (departamento) REFERENCES tbdepartamento(id) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE tbclientes ADD CONSTRAINT fk_cli_clase FOREIGN KEY (clase) REFERENCES tbclasecliente(id) ON DELETE CASCADE ON UPDATE CASCADE;
/*COMENTARIOS*/
ALTER TABLE tbcomentarios ADD CONSTRAINT fk_coment_ped FOREIGN KEY (id_pedido) REFERENCES tbpedidos(id) ON DELETE CASCADE ON UPDATE CASCADE;
/*PEDIDOS*/
ALTER TABLE tbpedidos ADD CONSTRAINT fk_ped_usu FOREIGN KEY (id_usuario) REFERENCES tbusuario(id) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE tbpedidos ADD CONSTRAINT fk_ped_cli FOREIGN KEY (id_cliente) REFERENCES tbclientes(id) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE tbpedidos ADD CONSTRAINT fk_ped_prod FOREIGN KEY (id_producto) REFERENCES tbproducto(id) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE tbpedidos ADD CONSTRAINT fk_ped_ent FOREIGN KEY (tipo_entrega) REFERENCES tbentrega(id) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE tbpedidos ADD CONSTRAINT fk_ped_pago FOREIGN KEY (tipo_pago) REFERENCES tbtipopago(id) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE tbpedidos ADD CONSTRAINT fk_ped_est FOREIGN KEY (estado_pedido) REFERENCES tbestadopedido(id) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE tbpedidos ADD CONSTRAINT fk_ped_canal FOREIGN KEY (canal) REFERENCES tbcanal(id) ON DELETE CASCADE ON UPDATE CASCADE;
/*PRODUCTO*/
ALTER TABLE tbproducto ADD CONSTRAINT fk_prod_cat FOREIGN KEY (categoria) REFERENCES tbcategoria(id) ON DELETE CASCADE ON UPDATE CASCADE;
/*USUARIO*/
ALTER TABLE tbusuario ADD CONSTRAINT fk_usu_sexo FOREIGN KEY (sexo) REFERENCES tbsexo(id) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE tbusuario ADD CONSTRAINT fk_usu_doc FOREIGN KEY (tipo_doc) REFERENCES tbdocumento(id) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE tbusuario ADD CONSTRAINT fk_usu_cargo FOREIGN KEY (cargo) REFERENCES tbcargo(id) ON DELETE CASCADE ON UPDATE CASCADE;
/*VENTAS*/
ALTER TABLE tbventas ADD CONSTRAINT fk_vent_ped FOREIGN KEY (id_pedido) REFERENCES tbpedidos(id) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE tbventas ADD CONSTRAINT fk_vent_est FOREIGN KEY (estado_venta) REFERENCES tbestadoventa(id) ON DELETE CASCADE ON UPDATE CASCADE;