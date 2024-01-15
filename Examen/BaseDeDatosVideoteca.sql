CREATE DATABASE videoteca;
SET NAMES UTF8;
CREATE DATABASE IF NOT EXISTS videoteca;
USE videoteca;

DROP TABLE IF EXISTS usuarios;
CREATE TABLE IF NOT EXISTS usuarios(
    id              int(255) auto_increment not null,
    nombreUsuario   varchar(100) not null,
    password        varchar(255) not null,
    dni             varchar(100) not null,
    nombreCompleto  varchar(255) not null,
    apellidoDOS     varchar(255),
    apellidoUNO     varchar(255),
    email           varchar(255) not null,
    habilitado      bool not null,
    rol             varchar(20),
    CONSTRAINT pk_usuarios PRIMARY KEY(id),
    CONSTRAINT uq_email UNIQUE(email),
    CONSTRAINT uq_dni UNIQUE(dni)
    )ENGINE=InnoDb DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

DROP TABLE IF EXISTS usuarios;
CREATE TABLE IF NOT EXISTS pelicula(
   id               int(255) auto_increment not null,
   titulo           varchar(255) not null,
   director         varchar(255) not null,
   genero           varchar(255) not null,
   fecha  varchar(255) not null,
   CONSTRAINT pk_usuarios PRIMARY KEY(id)
)ENGINE=InnoDb DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


       update usuarios set rol='direccion' where email='josemiguel41104@gmail.com';

select * from usuarios;