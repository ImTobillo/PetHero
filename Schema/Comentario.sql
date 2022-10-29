CREATE DATABASE IF NOT EXISTS PetHero;

USE PetHero;

CREATE TABLE IF NOT EXISTS Comentario
(
    IdComentario int IDENTITY,
    IdDueño int not null,
    IdGuardian int not null,
    Comentario varchar(500) not null,
    Fecha Date not null,
    CONSTRAINT PK_IdComentario PRIMARY KEY (IdComentario),
    CONSTRAINT FK_IdDueñoComent FOREIGN KEY (IdDueño) REFERENCES Dueño(IdUser),
    CONSTRAINT FK_IdGuardianComent FOREIGN KEY (IdGuardian) REFERENCES Guardian(IdUser)
) Engine=InnoDB;
