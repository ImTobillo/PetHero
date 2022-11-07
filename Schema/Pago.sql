CREATE DATABASE IF NOT EXISTS PetHero;

USE PetHero;

CREATE TABLE IF NOT EXISTS Pago
(
    IdPago    int auto_increment,
    Fecha     date        not null,
    Monto     float       not null,
    Estado    varchar(20) not null,
    IdReserva int         not null,
    IdTarjeta int         null,
    constraint pk_idPago primary key (IdPago),
    constraint fk_idReserva foreign key (IdReserva) references reserva (IdReserva),
    constraint fk_idTarjeta foreign key (IdTarjeta) references tarjeta (idTarjeta)
) Engine=InnoDB;