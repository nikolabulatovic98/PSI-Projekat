
CREATE TABLE Administrator
(
	Username             VARCHAR(16) NOT NULL,
	Password             CHAR(25) NOT NULL
);

ALTER TABLE Administrator
ADD CONSTRAINT XPKAdministrator PRIMARY KEY (Username);

CREATE TABLE Destinacija
(
	IdDestinacije        INTEGER NOT NULL,
	ImeDrzave            VARCHAR(20) NOT NULL,
	ImeDestinacije       VARCHAR(20) NOT NULL,
	Tip                  VARCHAR(15) NOT NULL
);

ALTER TABLE Destinacija
ADD CONSTRAINT XPKDestinacija PRIMARY KEY (IdDestinacije);

CREATE TABLE JePutovao
(
	Ocena                INTEGER NOT NULL,
	Trajanje             INTEGER NULL,
	Saputnik             VARCHAR(13) NULL,
	Username             VARCHAR(16) NOT NULL,
	IdDestinacije        INTEGER NOT NULL
);

ALTER TABLE JePutovao
ADD CONSTRAINT XPKJePutovao PRIMARY KEY (Username,IdDestinacije);

CREATE TABLE Komentar
(
	IdKom                INTEGER NOT NULL,
	Tekst                TEXT NULL,
	Username             VARCHAR(16) NULL
);

ALTER TABLE Komentar
ADD CONSTRAINT XPKKomentar PRIMARY KEY (IdKom);

CREATE TABLE Korisnik
(
	Username             VARCHAR(16) NOT NULL,
	Pol                  CHAR(1) NOT NULL,
	Password             VARCHAR(25) NOT NULL,
	Ime                  VARCHAR(30) NOT NULL,
	Prezime              VARCHAR(30) NOT NULL
);

ALTER TABLE Korisnik
ADD CONSTRAINT XPKKorisnik PRIMARY KEY (Username);

CREATE TABLE Moderator
(
	Username             VARCHAR(16) NOT NULL
);

ALTER TABLE Moderator
ADD CONSTRAINT XPKModerator PRIMARY KEY (Username);

CREATE TABLE Putovanje
(
	IdPutovanja          INTEGER NOT NULL,
	Saputnik             VARCHAR(13) NOT NULL,
	Trajanje             INTEGER NOT NULL,
	Opis                 TEXT NULL,
	IdDestinacije        INTEGER NULL,
	DonjiUzrast          INTEGER NOT NULL,
	GornjiUzrast         INTEGER NOT NULL
);

ALTER TABLE Putovanje
ADD CONSTRAINT XPKPutovanje PRIMARY KEY (IdPutovanja);

CREATE TABLE RegistrovaniKorisnik
(
	Username             VARCHAR(16) NOT NULL,
	Email                VARCHAR(25) NOT NULL,
	Godiste              INTEGER NOT NULL
);

ALTER TABLE RegistrovaniKorisnik
ADD CONSTRAINT XPKRegistrovaniKorisnik PRIMARY KEY (Username);

CREATE TABLE SeOdnosiNa
(
	IdKom                INTEGER NOT NULL,
	IdDestinacije        INTEGER NOT NULL
);

ALTER TABLE SeOdnosiNa
ADD CONSTRAINT XPKSeOdnosiNa PRIMARY KEY (IdKom,IdDestinacije);

ALTER TABLE JePutovao
ADD CONSTRAINT R_17 FOREIGN KEY (Username) REFERENCES RegistrovaniKorisnik (Username);

ALTER TABLE JePutovao
ADD CONSTRAINT R_18 FOREIGN KEY (IdDestinacije) REFERENCES Destinacija (IdDestinacije);

ALTER TABLE Komentar
ADD CONSTRAINT R_21 FOREIGN KEY (Username) REFERENCES RegistrovaniKorisnik (Username);

ALTER TABLE Moderator
ADD CONSTRAINT R_19 FOREIGN KEY (Username) REFERENCES Korisnik (Username);

ALTER TABLE Putovanje
ADD CONSTRAINT R_10 FOREIGN KEY (IdDestinacije) REFERENCES Destinacija (IdDestinacije);

ALTER TABLE RegistrovaniKorisnik
ADD CONSTRAINT R_1 FOREIGN KEY (Username) REFERENCES Korisnik (Username);

ALTER TABLE SeOdnosiNa
ADD CONSTRAINT R_22 FOREIGN KEY (IdKom) REFERENCES Komentar (IdKom);

ALTER TABLE SeOdnosiNa
ADD CONSTRAINT R_23 FOREIGN KEY (IdDestinacije) REFERENCES Destinacija (IdDestinacije);
