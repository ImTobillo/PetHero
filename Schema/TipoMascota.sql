CREATE DATABASE IF NOT EXISTS PetHero;

USE PetHero;

CREATE TABLE IF NOT EXISTS TipoMascota
(
    IdTipoMascota int IDENTITY,
    Tipo varchar(30) not null,
    CONSTRAINT PK_IdTipoMascota PRIMARY KEY (IdTipoMascota);
) Engine=InnoDB;
