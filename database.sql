CREATE DATABASE IF NOT EXISTS divinodoni_prenotazioni;

USE divinodoni_prenotazioni;
--TO FINISH
CREATE TABLE IF NOT EXISTS attivita (
    'CodA',
    'NomeA',
    'MaxPosti',
    'PostiPren',
    PRIMARY KEY (CodA)
)

CREATE TABLE IF NOT EXISTS utente (
    'Username',
    'Password',
    'Cognome',
    'Nome',
    PRIMARY KEY (Username)
)

CREATE TABLE IF NOT EXISTS prenota (
    'CodA',
    'Username',
    'Persone',
    PRIMARY KEY ()
)