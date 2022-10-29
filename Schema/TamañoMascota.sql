CREATE DATABASE IF NOT EXISTS PetHero;

USE PetHero;

CREATE TABLE IF NOT EXISTS TamañoMascota
(
    IdTamañoMascota int IDENTITY,
    Tamaño varchar(30) not null,
    CONSTRAINT PK_IdTamañoMascota PRIMARY KEY (IdTamañoMascota)
) Engine=InnoDB;