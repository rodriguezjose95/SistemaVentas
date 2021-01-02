
SELECT * FROM tbcanal;
SELECT * FROM tbcargo;
SELECT * FROM tbclasecliente;
SELECT * FROM tbclientes;
SELECT * FROM tbcomentarios;
SELECT * FROM tbdepartamento;
SELECT * FROM tbdocumento;
SELECT * FROM tbentrega;
SELECT * FROM tbestadopedido;
SELECT * FROM tbestadoventa;
SELECT * FROM tbpedidos;
SELECT * FROM tbproducto;
SELECT * FROM tbsexo;
SELECT * FROM tbtipopago;
SELECT * FROM tbusuario;
SELECT * FROM tbventas;

/*VISTAS CREADAS*/

/*top 5 de usuario con mas ventas - PORCENTUAL*/
CREATE VIEW vw_user_max_ventas AS
SELECT u.id, u.nombres, u.apellidos, COUNT(p.id_usuario) AS ventas, 
(SELECT COUNT(id) FROM tbpedidos  WHERE estado_pedido = 4) AS total_ventas,
ROUND(COUNT(p.id_usuario) * 100 / (SELECT COUNT(id) FROM tbpedidos  WHERE estado_pedido = 4),1) AS porcentaje 
FROM tbpedidos AS p 
INNER JOIN tbusuario AS u ON p.id_usuario = u.id WHERE p.estado_pedido = 4 GROUP BY p.id_usuario
ORDER BY COUNT(p.id_usuario) DESC LIMIT 5;
DROP VIEW vw_user_max_ventas;
SELECT * FROM vw_user_max_ventas;

/*top 3 productos mas vendidos*/
CREATE VIEW vw_prod_max_ventas AS
SELECT pr.id, pr.producto, SUM(pe.cantidad) AS cant_total FROM tbproducto AS pr 
INNER JOIN tbpedidos pe ON pr.id = pe.id_producto WHERE pe.estado_pedido = 4 GROUP BY pe.id_producto
ORDER BY SUM(pe.cantidad) DESC LIMIT 3;

/*top 3 canal mas usado*/
CREATE VIEW vw_canal_max AS
SELECT c.canal, COUNT(p.canal) AS cantidad FROM tbpedidos AS p 
INNER JOIN tbcanal AS c ON p.canal = c.id GROUP BY p.canal;
DROP VIEW vw_canal_max;
SELECT * FROM vw_canal_max;

/*tipo de envio mas usado*/
CREATE VIEW vw_envio_max AS
SELECT e.tipo_entrega, COUNT(p.tipo_entrega) AS cantidad FROM tbpedidos AS p 
INNER JOIN tbentrega AS e ON p.tipo_entrega = e.id GROUP BY p.tipo_entrega
ORDER BY COUNT(p.tipo_entrega) DESC;
DROP VIEW vw_envio_max;
SELECT * FROM vw_envio_max;

/*top 3 tipo de pago mas usado*/
CREATE VIEW vw_tpago_max AS
SELECT t.tipo_pago, COUNT(p.tipo_pago) AS cantidad FROM tbpedidos AS p 
INNER JOIN tbtipopago AS t ON p.tipo_pago = t.id GROUP BY p.tipo_pago;
DROP VIEW vw_tpago_max;
SELECT * FROM vw_tpago_max;

/*top 3 de usuario con mas ingresos generados*/
CREATE VIEW vw_user_max_ingreso AS
SELECT u.id, u.nombres, u.apellidos, SUM(p.monto) AS ingreso_total FROM tbusuario AS u 
INNER JOIN tbpedidos AS p ON u.id = p.id_usuario WHERE p.estado_pedido = 4 GROUP BY p.id_usuario
ORDER BY SUM(p.monto) DESC LIMIT 3;

/* TOP 3 mejor porcentaje de cierre de ventas*/
CREATE VIEW vw_user_cierre_vent AS
SELECT u.id, u.nombres, u.apellidos, COUNT(p.id_usuario) AS ventas,
(SELECT COUNT(id_usuario) FROM tbpedidos WHERE p.id_usuario = id_usuario GROUP BY id_usuario) AS total_pedidos,
ROUND(COUNT(p.id_usuario) * 100 / (SELECT COUNT(id_usuario) FROM tbpedidos WHERE p.id_usuario = id_usuario GROUP BY id_usuario),1) AS porcentaje 
FROM tbpedidos AS p 
INNER JOIN tbusuario AS u ON p.id_usuario = u.id WHERE p.estado_pedido = 4 GROUP BY p.id_usuario
ORDER BY porcentaje DESC LIMIT 3;
DROP VIEW vw_user_cierre_vent;
SELECT * FROM vw_user_cierre_vent;

/*INGRESOS DE VENTAS POR MES*/
CREATE VIEW vw_ventas_mensual AS
SELECT v.fecha, CONCAT(YEAR(v.fecha),'-',MONTH(v.fecha)) AS mes, COUNT(CONCAT(MONTH(v.fecha),YEAR(v.fecha))) AS cantidad, SUM(p.monto) AS monto_mes 
FROM tbventas AS v INNER JOIN tbpedidos AS p ON v.id_pedido = p.id
GROUP BY CONCAT(MONTH(v.fecha),YEAR(v.fecha)) ORDER BY v.fecha ASC;
SELECT * FROM vw_ventas_mensual;
DROP VIEW vw_ventas_mensual;

/*VENTAS POR DEPARTAMENTO MES ACTUAL*/
CREATE VIEW vw_ventas_ciudad_mes_actual AS
SELECT d.id, d.departamento, MONTHNAME(v.fecha) as mes,YEAR(v.fecha) AS año, SUM(p.monto) AS monto_total FROM tbpedidos AS p 
INNER JOIN tbclientes AS c INNER JOIN tbdepartamento AS d INNER JOIN tbventas AS v
ON p.id_cliente = c.id AND c.departamento = d.id AND v.id_pedido = p.id
WHERE p.estado_pedido = 4 AND MONTH(v.fecha) = MONTH(CURDATE()) AND YEAR(v.fecha) = YEAR(CURDATE())
GROUP BY c.departamento, MONTH(v.fecha), YEAR(v.fecha);
SELECT * FROM vw_ventas_ciudad_mes_actual;
DROP VIEW vw_ventas_ciudad_mes_actual;

/*VENTAS POR DEPARTAMENTO MES ANTERIOR*/
CREATE VIEW vw_ventas_ciudad_mes_anterior AS
SELECT d.id, d.departamento, MONTHNAME(v.fecha) as mes,YEAR(v.fecha) AS año, SUM(p.monto) AS monto_total FROM tbpedidos AS p 
INNER JOIN tbclientes AS c INNER JOIN tbdepartamento AS d INNER JOIN tbventas AS v
ON p.id_cliente = c.id AND c.departamento = d.id AND v.id_pedido = p.id
WHERE p.estado_pedido = 4 AND d.id IN (SELECT id FROM vw_ventas_ciudad_mes_actual) AND MONTH(v.fecha) = MONTH(CURDATE())-1 AND YEAR(v.fecha) = YEAR(CURDATE())
GROUP BY c.departamento, MONTH(v.fecha), YEAR(v.fecha);
SELECT * FROM vw_ventas_ciudad_mes_anterior;
DROP VIEW vw_ventas_ciudad_mes_anterior;

CREATE VIEW vw_ventas_ciudad_mes_act_ant AS
SELECT act.id, act.departamento, MONTH(CURDATE()) AS mes_act, act.monto_total AS monto_act, MONTH(CURDATE())-1 AS mes_ant, ant.monto_total AS monto_ant
FROM vw_ventas_ciudad_mes_actual AS act LEFT JOIN vw_ventas_ciudad_mes_anterior AS ant ON act.id = ant.id;
SELECT * FROM vw_ventas_ciudad_mes_act_ant;
DROP VIEW vw_ventas_ciudad_mes_act_ant;

select * from tbclientes;
select * from tbpedidos where id = 118;


























