CREATE DATABASE IF NOT EXISTS PetHero;

USE PetHero;

CREATE TABLE IF NOT EXISTS User
(
    IdUser int IDENTITY,
    IdTipo int not null,
    Username varchar(30) not null,
    Contraseña varchar(50) not null,
    CONSTRAINT PK_IdUser PRIMARY KEY (IdUser),
    CONSTRAINT FK_IdTipo FOREIGN KEY (IdTipo) REFERENCES TipoUser(IdTipo),
    CONSTRAINT UNQ_Username (Username);
) Engine=InnoDB;