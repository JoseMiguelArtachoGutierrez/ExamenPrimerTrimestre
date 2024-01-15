CREATE DATABASE tienda;
SET NAMES UTF8;
CREATE DATABASE IF NOT EXISTS tienda;
USE tienda;

DROP TABLE IF EXISTS usuarios;
CREATE TABLE IF NOT EXISTS usuarios(
    id              int(255) auto_increment not null,
    nombre          varchar(100) not null,
    apellidos       varchar(255),
    email           varchar(255) not null,
    password        varchar(255) not null,
    rol             varchar(20),
    CONSTRAINT pk_usuarios PRIMARY KEY(id),
    CONSTRAINT uq_email UNIQUE(email)
    )ENGINE=InnoDb DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


DROP TABLE IF EXISTS categorias;
CREATE TABLE IF NOT EXISTS categorias(
    id              int(255) auto_increment not null,
    nombre          varchar(100) not null,
    CONSTRAINT pk_categorias PRIMARY KEY(id)
    )ENGINE=InnoDb DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


DROP TABLE IF EXISTS productos;
CREATE TABLE IF NOT EXISTS productos(
    id              int(255) auto_increment not null,
    categoria_id    int(255) not null,
    nombre          varchar(100) not null,
    descripcion     text,
    precio          float(100,2) not null,
    stock           int(255) not null,
    oferta          varchar(2),
    fecha           date not null,
    imagen          varchar(255),
    CONSTRAINT pk_categorias PRIMARY KEY(id),
    CONSTRAINT fk_producto_categoria FOREIGN KEY(categoria_id) REFERENCES categorias(id)
    )ENGINE=InnoDb DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

DROP TABLE IF EXISTS pedidos;
CREATE TABLE IF NOT EXISTS pedidos(
    id              int(255) auto_increment not null,
    usuario_id      int(255) not null,
    provincia       varchar(100) not null,
    localidad       varchar(100) not null,
    direccion       varchar(255) not null,
    coste           float(200,2) not null,
    estado          varchar(20) not null,
    fecha           date,
    hora            time,
    CONSTRAINT pk_pedidos PRIMARY KEY(id),
    CONSTRAINT fk_pedido_usuario FOREIGN KEY(usuario_id) REFERENCES usuarios(id)
    )ENGINE=InnoDb DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

DROP TABLE IF EXISTS lineas_pedidos;
CREATE TABLE IF NOT EXISTS lineas_pedidos(
    id              int(255) auto_increment not null,
    pedido_id       int(255) not null,
    producto_id     int(255) not null,
    unidades        int(255) not null,
    CONSTRAINT pk_lineas_pedidos PRIMARY KEY(id),
    CONSTRAINT fk_linea_pedido FOREIGN KEY(pedido_id) REFERENCES pedidos(id),
    CONSTRAINT fk_linea_producto FOREIGN KEY(producto_id) REFERENCES productos(id)
    )ENGINE=InnoDb DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

# insert into usuarios values (null, 'admin','admin','admin@gmail.com','1234','admin');
insert into productos values (null,7,'Zapatillon','Las mejores zapatillas del mundo, colaboración de shrek y cars',200,20,'2x1','2022-01-10','shrekCrocs');
insert into productos values (null,7,'Boton','bota comunmente perfecta para las personas',100,10,'3x1','2022-01-10','boton');
update productos set imagen='shrekCrocs.jpg' where id=1;
select * from productos;
select * from usuarios;
select * from categorias;
/*
insert into categorias values (null,"Zapatos");
insert into categorias values (null,"Bestidos");
insert into categorias values (null,"Pantalones");
*/
# update usuarios set rol="admin" where email="admin@gmail.com";
select * from usuarios