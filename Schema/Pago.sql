CREATE DATABASE IF NOT EXISTS PetHero;

USE PetHero;

CREATE TABLE IF NOT EXISTS Pago
(
    IdPago int IDENTITY,
    Fecha Date not null,
    Metodo varchar(30) not null,
    Monto float not null,
    Estado bit not null,
    CONSTRAINT PK_IdPago PRIMARY KEY (IdPago)
) Engine=InnoDB;