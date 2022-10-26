CREATE DATABASE IF NOT EXISTS PetHero;

USE PetHero;

CREATE TABLE IF NOT EXISTS Pais
(
    IdPais int IDENTITY,
    Nombre varchar(30) not null,
    CONSTRAINT PK_IdPais PRIMARY KEY (IdPais);
) Engine=InnoDB;