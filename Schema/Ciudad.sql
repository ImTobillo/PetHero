CREATE DATABASE IF NOT EXISTS PetHero;

USE PetHero;

CREATE TABLE IF NOT EXISTS Ciudad
(
    IdCiudad int IDENTITY,
    IdPais int not null,
    Nombre varchar(30) not null,
    CONSTRAINT PK_IdCiudad PRIMARY KEY (IdCiudad),
    CONSTRAINT FK_IdPais FOREIGN KEY (IdPais) REFERENCES Pais(IdPais)
) Engine=InnoDB;
