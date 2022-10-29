CREATE DATABASE IF NOT EXISTS PetHero;

USE PetHero;

CREATE TABLE IF NOT EXISTS Guardian
(
    IdUser int,
    IdCiudad int,
    IdTamaño int,
    Nombre varchar(30) not null,
    Apellido varchar(30) not null,
    FechaNacimiento Date not null,
    Dni varchar(8) not null,
    Telefono varchar(15) not null,
    Email varchar(30) not null,
    Calle varchar(30) not null,
    NumCalle int not null,
    Remuneracion float not null,
    FechaInicio Date not null,
    FechaFinal Date not null,
    CONSTRAINT PK_IdUserG PRIMARY KEY (IdUser),
    CONSTRAINT FK_IdUserG FOREIGN KEY (IdUser) REFERENCES User(IdUser),
    CONSTRAINT FK_IdCiudadG FOREIGN KEY (IdCiudad) REFERENCES Ciudad(IdCiudad),
    CONSTRAINT FK_IdTamañoG FOREIGN KEY (IdTamaño) REFERENCES TamañoMascota(IdTamañoMascota),
    CONSTRAINT UNQ_Dni_EmailG UNIQUE(Dni, Email)
) Engine=InnoDB;