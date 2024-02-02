-- Create Patient table
CREATE TABLE Patient (
    IdP INT PRIMARY KEY AUTO_INCREMENT,
    Nomp VARCHAR(255),
    prénomP VARCHAR(255),
    NumTel VARCHAR(15),
    password VARCHAR(255), -- Add a password field
    roleP VARCHAR(50) DEFAULT 'PATIENT', -- Set a default role and increase length for better clarity
    UNIQUE (NumTel) -- Ensure NumTel is unique
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
