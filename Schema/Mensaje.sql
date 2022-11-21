CREATE DATABASE IF NOT EXISTS PetHero;

USE PetHero;

CREATE TABLE IF NOT EXISTS Mensaje
(
	IdMensaje int auto_increment,
    IdChat int,
    IdUserFrom int not null,
    IdUserTo int not null,
    Mensaje varchar(500) not null,
    Fecha Date not null,
    CONSTRAINT PK_IdMensaje PRIMARY KEY (IdMensaje),
    CONSTRAINT FK_Mensaje_IdChat FOREIGN KEY (IdChat) REFERENCES Chat(IdChat),
    CONSTRAINT FK_Mensaje_IdUserFrom FOREIGN KEY (IdUserFrom) REFERENCES User(IdUser),
    CONSTRAINT FK_Mensaje_IdUserTo FOREIGN KEY (IdUserTo) REFERENCES User(IdUser)
) Engine=InnoDB;