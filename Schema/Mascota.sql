CREATE DATABASE IF NOT EXISTS PetHero;

USE PetHero;

CREATE TABLE IF NOT EXISTS Mascota
(
    IdMascota int,
    IdDueño int,
    IdTipoMascota int,
    IdRaza int,
    IdTamaño int,
    Nombre varchar(30) not null,
    Edad int not null,
    Observaciones varchar(200),
    PlanVacunacion varchar(300),     -- ??????????????????????????????
    ImagenPerfil varchar(300),       -- ??????????????????????????????
    Video varchar(300),              -- ??????????????????????????????
    CONSTRAINT PK_IdMascota PRIMARY KEY (IdMascota),
    CONSTRAINT FK_IdDueño FOREIGN KEY (IdDueño) REFERENCES Dueño(IdDueño),
    CONSTRAINT FK_IdTipoMascota FOREIGN KEY (IdTipoMascota) REFERENCES TipoMascota(IdTipoMascota),
    CONSTRAINT FK_IdRaza FOREIGN KEY (IdRaza) REFERENCES Raza(IdRaza),
    CONSTRAINT FK_IdTamaño FOREIGN KEY (IdTamaño) REFERENCES TamañoMascota(IdTamaño);
) Engine=InnoDB;