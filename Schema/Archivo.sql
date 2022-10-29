CREATE DATABASE IF NOT EXISTS PetHero;

USE PetHero;

CREATE TABLE IF NOT EXISTS Archivo
(
    IdArchivo int IDENTITY,
    Url_ varchar(200) not null,
    CONSTRAINT PK_IdArchivo PRIMARY KEY (IdArchivo)
) Engine=InnoDB;
