CREATE DATABASE IF NOT EXISTS PetHero;

USE PetHero;

CREATE TABLE IF NOT EXISTS Raza
(
    IdRaza int IDENTITY,
    Raza varchar(30) not null,
    CONSTRAINT PK_IdRaza PRIMARY KEY (IdRaza);
) Engine=InnoDB;