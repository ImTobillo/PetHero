CREATE DATABASE IF NOT EXISTS PetHero;

USE PetHero;

CREATE TABLE IF NOT EXISTS Reserva
(
    IdReserva int,
    IdPago int,
    IdDueño int,
    IdGuardian int,
    FechaInicio Date not null,
    FechaFinal Date not null,
    HoraInicio varchar(20) not null,
    HoraFinal varchar(20) not null,
    Estado Bit not null,
    CONSTRAINT PK_IdReserva PRIMARY KEY (IdReserva),
    CONSTRAINT FK_IdDueñoReserva FOREIGN KEY (IdDueño) REFERENCES Dueño(IdUser),
    CONSTRAINT FK_IdPago FOREIGN KEY (IdPago) REFERENCES Pago(IdPago),
    CONSTRAINT FK_IdGuardianReserva FOREIGN KEY (IdGuardian) REFERENCES Guardian(IdUser)
) Engine=InnoDB;