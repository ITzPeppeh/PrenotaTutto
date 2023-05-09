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

INSERT INTO `attivita` (`CodA`, `NomeA`, `MaxPosti`, `PostiPren`) VALUES
('1001','Calcetto', 25, 25),
('1002','Pallavolo', 25, 25),
('1003','Ping Pong', 25, 5),
('1004','Laboratorio musicale', 25, 5),
('1005','Simulatore di volo', 25, 0),
('1006','Aula studio', 25, 0),
('1007','Origami', 25, 0),
('1008','Scacchi', 25, 0),
('1009','Giochi da tavolo', 25, 0),
('1010','Educazione sessuale', 25, 22),
('1011','DJ Set', 25, 0),
('1012','Aula film', 25, 0),
('1013','Laboratorio di chimica', 25, 0),
('1014','Laboratorio di meccanica', 25, 0),
('1015','Arduino', 25, 12),
('1016','Croce Rossa', 25, 0),
('1017','Judo', 25, 0),
('1018','Murales', 25, 0),
('1019','Camminata', 25, 0),
('1020','Fotografia', 25, 4),
('1021','Teatro', 25, 0),
('1022','Sbandieratori e musici', 25, 16),
('1023','Karaoke', 25, 0),
('1024','Kick boxing', 25, 0);

INSERT INTO `utente` (`Username`, `Passwd`, `Cognome`, `Nome`) VALUES
('abderrahmane.aboulkassim', '06ca806fc8d1ca6ed063d64daa82bbc90fcf9aaa', 'Aboulkassim', 'Abderrahmane'),
('simone.albarello', '06ca806fc8d1ca6ed063d64daa82bbc90fcf9aaa', 'Albarello', 'Simone'),
('serena.basso', '06ca806fc8d1ca6ed063d64daa82bbc90fcf9aaa', 'Basso', 'Serena'),
('stefano.brun', '06ca806fc8d1ca6ed063d64daa82bbc90fcf9aaa', 'Brun', 'Stefano'),
('alberto.caccia', '06ca806fc8d1ca6ed063d64daa82bbc90fcf9aaa', 'Caccia', 'Alberto'),
('luca.castagnotti', '06ca806fc8d1ca6ed063d64daa82bbc90fcf9aaa', 'Castagnotti', 'Luca'),
('xhulian.celmeta', '06ca806fc8d1ca6ed063d64daa82bbc90fcf9aaa', 'Celmeta', 'Xhulian'),
('maria.dilorenzo', '06ca806fc8d1ca6ed063d64daa82bbc90fcf9aaa', 'Di Lorenzo', 'Maria Chiara'),
('giuseppe.divino', '06ca806fc8d1ca6ed063d64daa82bbc90fcf9aaa', 'Divino', 'Giuseppe'),
('massimo.doni', '06ca806fc8d1ca6ed063d64daa82bbc90fcf9aaa', 'Doni', 'Massimo'),
('sabrina.ghignone', '06ca806fc8d1ca6ed063d64daa82bbc90fcf9aaa', 'Ghignone', 'Sabrina'),
('daniele.giardina', '06ca806fc8d1ca6ed063d64daa82bbc90fcf9aaa', 'Giardina', 'Daniele'),
('davide.gioetto', '06ca806fc8d1ca6ed063d64daa82bbc90fcf9aaa', 'Gioetto', 'Davide'),
('badreddine.hafdi', '06ca806fc8d1ca6ed063d64daa82bbc90fcf9aaa', 'Hafdi', 'Badreddine'),
('xhoni.hysaj', '06ca806fc8d1ca6ed063d64daa82bbc90fcf9aaa', 'Hysaj', 'Xhoni'),
('simone.iacuzzo', '06ca806fc8d1ca6ed063d64daa82bbc90fcf9aaa', 'Iacuzzo', 'Simone'),
('ashraf.laaziri', '06ca806fc8d1ca6ed063d64daa82bbc90fcf9aaa', 'Laaziri', 'Ashraf'),
('edoardo.meliga', '06ca806fc8d1ca6ed063d64daa82bbc90fcf9aaa', 'Meliga', 'Edoardo'),
('davide.rabezzana', '06ca806fc8d1ca6ed063d64daa82bbc90fcf9aaa', 'Rabezzana', 'Davide'),
('emanuele.raia', '06ca806fc8d1ca6ed063d64daa82bbc90fcf9aaa', 'Raia', 'Emanuele'),
('filippo.rozzino', '06ca806fc8d1ca6ed063d64daa82bbc90fcf9aaa', 'Rozzino', 'Filippo'),
('luca.scapparino', '06ca806fc8d1ca6ed063d64daa82bbc90fcf9aaa', 'Scapparino', 'Luca'),
('vincenzo.sonnessa', '06ca806fc8d1ca6ed063d64daa82bbc90fcf9aaa', 'Sonnessa', 'Vincenzo Alessandro'),
('giacomo.sugamele', '06ca806fc8d1ca6ed063d64daa82bbc90fcf9aaa', 'Sugamele', 'Giacomo'),
('antonio.trinchero', '06ca806fc8d1ca6ed063d64daa82bbc90fcf9aaa', 'Trinchero', 'Antonio'),
('andrea.viarengo', '06ca806fc8d1ca6ed063d64daa82bbc90fcf9aaa', 'Viarengo', 'Andrea Roberto'),
('paolo.vitale', '06ca806fc8d1ca6ed063d64daa82bbc90fcf9aaa', 'Vitale', 'Paolo');

INSERT INTO `prenota` (`CodA`, `Username`, `Persone`) VALUES
('1001', 'abderrahmane.aboulkassim', 4),
('1001', 'badreddine.hafdi', 4),
('1001', 'xhoni.hysaj', 4),
('1001', 'paolo.vitale', 4),
('1001', 'simone.albarello', 4),
('1001', 'ashraf.laaziri', 3),
('1001', 'davide.rabezzana', 2),

('1002', 'giuseppe.divino', 4),
('1002', 'massimo.doni', 4),
('1002', 'davide.gioetto', 4),
('1002', 'edoardo.meliga', 4),
('1002', 'andrea.viarengo', 4),
('1002', 'simone.iacuzzo', 3),
('1002', 'davide.rabezzana', 2),

('1003', 'vincenzo.sonnessa', 2),
('1003', 'antonio.trinchero', 2),
('1003', 'stefano.brun', 1),

('1004', 'vincenzo.sonnessa', 2),
('1004', 'antonio.trinchero', 2),
('1004', 'stefano.brun', 1),

('1020', 'simone.iacuzzo', 4),

('1015', 'stefano.brun', 4),
('1015', 'filippo.rozzino', 4),
('1015', 'andrea.viarengo', 4),

('1022', 'serena.basso', 4),
('1022', 'sabrina.ghignone', 4),
('1022', 'maria.dilorenzo', 4),
('1022', 'paolo.vitale', 4),

('1010', 'giacomo.sugamele', 4),
('1010', 'emanuele.raia', 4),
('1010', 'luca.castagnotti', 4),
('1010', 'xhulian.celmeta', 4),
('1010', 'luca.scapparino', 4),
('1010', 'antonio.trinchero', 2);