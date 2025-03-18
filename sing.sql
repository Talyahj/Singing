DROP TABLE IF EXISTS utilisateur;
DROP TABLE IF EXISTS Artistes;
DROP TABLE IF EXISTS Albums;

create table utilisateur(
    mailU varchar(150) PRIMARY KEY,
    mdpU varchar(50),
    pseudoU varchar(50),
    userType varchar(20) CHECK (userType IN ('utilisateur', 'admin'))
);

CREATE TABLE artistes (
    idArtiste INT PRIMARY KEY ,
    nomArt VARCHAR(50),
    paysArt VARCHAR(50),
    genreArt VARCHAR(50)
);

CREATE TABLE albums (
    idAlbum INT AUTO_INCREMENT PRIMARY KEY,
    titreAlb VARCHAR(50),  
    idArtiste INT,
    prix DECIMAL(10,2),
    photo VARCHAR(50),
    anneeSortie INT,
    FOREIGN KEY(idArtiste) REFERENCES artistes(idArtiste)
);


INSERT INTO artistes VALUES 
(1, 'Aya Nakamura', 'France', 'Pop'),
(2, 'Justin Bieber', 'Canada', 'Pop'),
(3, 'SZA', 'USA', 'R&B'),
(4, 'Tiakola', 'France', 'Rap');

INSERT INTO albums (idAlbum, titreAlb, idArtiste, anneeSortie, prix, photo) VALUES 
(11, 'NAKAMURA', 1, 2018, 11.00, 'nakamura.jpg'),
(12, 'Purpose', 2, 2015, 12.00, 'purpose.jpg'),
(13, 'SOS', 3, 2022, 13.00, 'sos.jpg'),
(14, 'Mélo', 4, 2022, 14.00, 'melo.jpg');

INSERT INTO utilisateur (mailU, mdpU, pseudoU, userType) VALUES 
('comeandgetit@gmail.com', 'TJ', 'bonjour', 'admin');


CREATE TABLE panier (
    idPanier INT AUTO_INCREMENT PRIMARY KEY,
    mailU VARCHAR(150),
    idAlbum INT,
    FOREIGN KEY(mailU) REFERENCES utilisateur(mailU),
    FOREIGN KEY(idAlbum) REFERENCES albums(idAlbum)
);