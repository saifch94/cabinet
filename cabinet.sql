-- Create Patient table
CREATE TABLE Patient (
    IdP INT PRIMARY KEY AUTO_INCREMENT,
    firstname VARCHAR(255),
    lastname VARCHAR(255),
    uname VARCHAR(255) UNIQUE,
    pwd VARCHAR(255),
    numTel VARCHAR(15) UNIQUE,
    roleP VARCHAR(50) DEFAULT 'PATIENT'
);

-- Create Kiné table
CREATE TABLE Kiné (
    IdK INT PRIMARY KEY AUTO_INCREMENT,
    NomK VARCHAR(255),
    PrénomK VARCHAR(255)
);

-- Create Séance table
CREATE TABLE Séance (
    IdS INT PRIMARY KEY AUTO_INCREMENT,
    IdK INT,
    IdP INT,
    DateS DATE,
    HeureS TIME,
    TypeSoin VARCHAR(255),
    FOREIGN KEY (IdK) REFERENCES Kiné(IdK),
    FOREIGN KEY (IdP) REFERENCES Patient(IdP)
);

-- Correcting Séance table to include Kiné and Patient details
SELECT Séance.*, Kiné.NomK AS Kiné_Nom, Kiné.PrénomK AS Kiné_Prénom, Patient.firstname AS Patient_Nom, Patient.lastname AS Patient_Prénom
FROM Séance
LEFT JOIN Kiné ON Séance.IdK = Kiné.IdK
LEFT JOIN Patient ON Séance.IdP = Patient.IdP;

INSERT INTO Patient (firstname, lastname, uname, pwd, numTel, roleP) VALUES ("admin", "admin", "admin", "admin123", "123456789", "ADMIN");
