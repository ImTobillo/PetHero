CREATE DATABASE IF NOT EXISTS PetHero;

USE PetHero;

CREATE TABLE IF NOT EXISTS Reserva
(
    IdReserva int,
    IdDueño int,
    IdGuardian int,
    FechaInicio Date not null,
    FechaFinal Date not null,
    HoraInicio varchar(20) not null,
    HoraFinal varchar(20) not null,
    Estado Bit not null,
    CONSTRAINT PK_IdReserva PRIMARY KEY (IdReserva),
    CONSTRAINT FK_IdDueño FOREIGN KEY (IdDueño) REFERENCES Dueño(IdDueño),
    CONSTRAINT FK_IdGuardian FOREIGN KEY (IdGuardian) REFERENCES Guardian(IdGuardian);
) Engine=InnoDB;