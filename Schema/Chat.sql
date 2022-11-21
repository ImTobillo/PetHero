CREATE DATABASE IF NOT EXISTS PetHero;

USE PetHero;

CREATE TABLE IF NOT EXISTS Chat
(
    IdChat int auto_increment,
    IdUserFrom int not null,
    IdUserTo int not null,
    CONSTRAINT PK_IdChat PRIMARY KEY (IdChat),
    CONSTRAINT FK_Chat_IdUserFrom FOREIGN KEY (IdUserFrom) REFERENCES User(IdUser),
    CONSTRAINT FK_Chat_IdUserTo FOREIGN KEY (IdUserTo) REFERENCES User(IdUser)
) Engine=InnoDB;

