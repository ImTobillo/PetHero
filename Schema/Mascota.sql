CREATE DATABASE IF NOT EXISTS PetHero;

USE PetHero;

CREATE TABLE IF NOT EXISTS Mascota
(
    IdMascota int IDENTITY,
    IdDueño int,
    IdRaza int,
    IdTamaño int,
    IdArchivoImgPerfil int,
    IdArchivoImgPlanVacunacion int,
    IdArchivoVideoPerro int,
    Nombre varchar(30) not null,
    Edad int not null,
    Observaciones varchar(200),
    CONSTRAINT PK_IdMascota PRIMARY KEY (IdMascota),
    CONSTRAINT FK_IdDueño FOREIGN KEY (IdDueño) REFERENCES Dueño(IdUser),
    CONSTRAINT FK_IdRaza FOREIGN KEY (IdRaza) REFERENCES Raza(IdRaza),
    CONSTRAINT FK_IdTamaño FOREIGN KEY (IdTamaño) REFERENCES TamañoMascota(IdTamaño),
    CONSTRAINT FK_IdArchivoImgPerfil FOREIGN KEY (IdArchivoImgPerfil) REFERENCES Archivo(IdArchivo),
    CONSTRAINT FK_IdArchivoImgPlanVacunacion FOREIGN KEY (IdArchivoImgPlanVacunacion) REFERENCES Archivo(IdArchivo),
    CONSTRAINT FK_IdArchivoVideoPerro FOREIGN KEY (IdArchivoVideoPerro) REFERENCES Archivo(IdArchivo)
) Engine=InnoDB;
