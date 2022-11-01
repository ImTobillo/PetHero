CREATE DATABASE IF NOT EXISTS PetHero;

USE PetHero;

create table reserva
(
    IdReserva   int auto_increment,
    IdPago      int,
    IdDuenio    int,
    IdGuardian  int,
    IdMascota   int,
    FechaInicio date not null,
    FechaFinal  date not null,
    HoraInicio  varchar(20) not null,
    HoraFinal   varchar(20) not null,
    Estado      varchar(20) not null,
    
    constraint PK_IdReserva primary key (IdReserva),
    constraint FK_IdDueñoReserva foreign key (IdDuenio) references duenio (IdUser),
    constraint FK_IdGuardianReserva foreign key (IdGuardian) references guardian (IdUser),
    constraint FK_IdMascota foreign key (IdMascota) references mascota (IdMascota),
    constraint FK_IdPago foreign key (IdPago) references pago (IdPago)
); Engine=InnoDB;