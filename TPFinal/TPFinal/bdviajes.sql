CREATE DATABASE bdviajes;

CREATE TABLE empresa (
    idempresa bigint AUTO_INCREMENT,
    enombre varchar(150),
    edireccion varchar(150),
    PRIMARY KEY (idempresa)
) ENGINE = InnoDB DEFAULT CHARSET = utf8 AUTO_INCREMENT = 1;

CREATE TABLE viaje (
    idviaje bigint AUTO_INCREMENT,
    /*codigo de viaje*/ vdestino varchar(150),
    vcantmaxpasajeros int,
    idempresa bigint,
    rnumeroempleado bigint,
    vimporte float,
    PRIMARY KEY (idviaje),
    FOREIGN KEY (idempresa) REFERENCES empresa (idempresa),
    FOREIGN KEY (rnumeroempleado) REFERENCES responsable (rnumeroempleado) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE = InnoDB DEFAULT CHARSET = utf8 AUTO_INCREMENT = 1;

CREATE TABLE pasajero (
    pdocumento varchar(15),
    pnombre varchar(150),
    papellido varchar(150),
    ptelefono int,
    idviaje bigint,
    PRIMARY KEY (pdocumento),
    FOREIGN KEY (idviaje) REFERENCES viaje (idviaje)
) ENGINE = InnoDB DEFAULT CHARSET = utf8;

CREATE TABLE responsable (
    rnumeroempleado bigint AUTO_INCREMENT,
    rnumerolicencia bigint,
    rnombre varchar(150),
    rapellido varchar(150),
    PRIMARY KEY (rnumeroempleado)
) ENGINE = InnoDB DEFAULT CHARSET = utf8 AUTO_INCREMENT = 1;

-- //////////////////////////////////////////////////////////////////////

CREATE TABLE persona (
    idpersona bigint AUTO_INCREMENT,
    pnombre varchar(150),
    papellido varchar(150),
    PRIMARY KEY (idpersona)
) ENGINE = InnoDB DEFAULT CHARSET = utf8 AUTO_INCREMENT = 1;

CREATE TABLE responsable (
    rnumeroempleado bigint AUTO_INCREMENT,
    rnumerolicencia bigint,
    idpersona bigint,
    PRIMARY KEY (rnumeroempleado),
    FOREIGN KEY (idpersona) REFERENCES persona (idpersona) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE = InnoDB DEFAULT CHARSET = utf8 AUTO_INCREMENT = 1;

CREATE TABLE pasajero (
    idpasajero bigint AUTO_INCREMENT,
    pdocumento varchar(15),
    ptelefono int,
    idpersona bigint,
    idviaje bigint,
    PRIMARY KEY (idpasajero),
    FOREIGN KEY (idpersona) REFERENCES persona (idpersona) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (idviaje) REFERENCES viaje (idviaje)
) ENGINE = InnoDB DEFAULT CHARSET = utf8;