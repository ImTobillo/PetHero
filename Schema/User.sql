CREATE DATABASE IF NOT EXISTS PetHero;

USE PetHero;

create table user
(
    IdUser      int auto_increment,
    IdTipo      int not null,
    Username    varchar(30) not null,
    Contrasenia varchar(50) not null,
    constraint PK_IdUser primary key (IdUser),
    constraint UNQ_Username unique (Username),
    constraint FK_IdTipo foreign key (IdTipo) references tipouser (IdTipo)
) Engine=InnoDB;