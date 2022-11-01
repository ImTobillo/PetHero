CREATE DATABASE IF NOT EXISTS PetHero;

USE PetHero;

create table duenio
(
    IdUser          int not null,
    IdCiudad        int not null,
    Nombre          varchar(30) not null,
    Apellido        varchar(30) not null,
    FechaNacimiento date not null,
    Dni             varchar(8)  not null,
    Telefono        varchar(15) not null,
    Email           varchar(30) not null,
    Calle           varchar(30) not null,
    NumCalle        int not null,
    constraint PK_IdUser primary key (IdUser),
    constraint UNQ_Dni_Email unique (Dni, Email),
    constraint FK_IdCiudad foreign key (IdCiudad) references ciudad (IdCiudad),
    constraint FK_IdUser foreign key (IdUser) references user (IdUser)
) Engine=InnoDB;










