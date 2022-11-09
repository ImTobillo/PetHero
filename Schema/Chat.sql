CREATE DATABASE IF NOT EXISTS PetHero;

USE PetHero;

CREATE TABLE IF NOT EXISTS Chat
(
    IdChat int auto_increment,
    IdUserFrom int not null,
    IdUserTo int not null,
    Mensaje varchar(500) not null,
    Fecha Date not null,
    CONSTRAINT PK_IdChat PRIMARY KEY (IdChat),
    CONSTRAINT FK_IdUserFrom FOREIGN KEY (IdUserFrom) REFERENCES User(IdUser),
    CONSTRAINT FK_IdUserTo FOREIGN KEY (IdUserTo) REFERENCES User(IdUser)
) Engine=InnoDB;