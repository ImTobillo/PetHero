CREATE DATABASE IF NOT EXISTS PetHero;

USE PetHero;

CREATE TABLE IF NOT EXISTS Dueño
(
    IdDueño int,
    IdUser int,
    IdCiudad int,
    Nombre varchar(30) not null,
    Apellido varchar(30) not null,
    FechaNacimiento Date not null,
    Dni varchar(8) not null,
    Telefono varchar(15) not null,
    Email varchar(30) not null,
    Calle varchar(30) not null,
    NumCalle int not null,
    CONSTRAINT PK_IdDueño PRIMARY KEY (IdDueño),
    CONSTRAINT FK_IdUser FOREIGN KEY (IdUser) REFERENCES User(IdUser),
    CONSTRAINT FK_IdCiudad FOREIGN KEY (IdCiudad) REFERENCES Ciudad(IdCiudad),
    CONSTRAINT UNQ_Dni_Email (Dni, Email);
) Engine=InnoDB;










