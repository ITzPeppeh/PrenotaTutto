CREATE DATABASE IF NOT EXISTS divinodoni_prenotazioni;

USE divinodoni_prenotazioni;

CREATE TABLE IF NOT EXISTS attivita (
    CodA VARCHAR(100),
    NomeA VARCHAR(100) NOT NULL,
    MaxPosti INT(100) NOT NULL,
    PostiPren INT(100) NOT NULL,
    PRIMARY KEY (CodA)
);

CREATE TABLE IF NOT EXISTS utente (
    Username VARCHAR(50),
    Passwd VARCHAR(50) NOT NULL,
    Cognome VARCHAR(100) NOT NULL,
    Nome VARCHAR(100) NOT NULL,
    PRIMARY KEY (Username)
);

CREATE TABLE IF NOT EXISTS prenota (
    CodA VARCHAR(100),
    Username VARCHAR(50),
    Persone INT(5) DEFAULT 1,
    PRIMARY KEY (CodA, Username),
    FOREIGN KEY (CodA) REFERENCES attivita(CodA),
    FOREIGN KEY (Username) REFERENCES utente(Username)
);