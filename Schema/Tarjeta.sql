create table tarjeta
(
    idTarjeta        int auto_increment,
    tipo             varchar(30) not null,
    nroTarjeta       bigint      not null,
    id_duenio        int         null,
    titular          varchar(20) not null,
    codSeguridad     smallint    not null,
    fechaVencimiento varchar(10) not null,
    constraint pk_idTarjeta primary key (idTarjeta),
    constraint unq_Tarjeta unique (nroTarjeta, codSeguridad, fechaVencimiento),
    constraint fk_duenio foreign key (id_duenio) references duenio (IdUser)
);