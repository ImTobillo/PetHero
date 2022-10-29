CREATE DATABASE IF NOT EXISTS PetHero;

USE PetHero;

CREATE TABLE IF NOT EXISTS TipoUser
(
    IdTipo int IDENTITY,
    Tipo varchar(30) not null,
    CONSTRAINT PK_IdTipo PRIMARY KEY (IdTipo)
) Engine=InnoDB;