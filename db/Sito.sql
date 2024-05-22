drop database if exists sito;
create database sito;
use sito;

CREATE TABLE Users (
                       id INT AUTO_INCREMENT,
                       username VARCHAR(255),
                       password VARCHAR(255),
                       email VARCHAR(255),
                       birthdate DATE,
                       PRIMARY KEY(id),
                       UNIQUE(username),
                       UNIQUE(email)
);

CREATE TABLE Categories (
                            id INT AUTO_INCREMENT,
                            name VARCHAR(255),
                            immagine VARCHAR(255),
                            PRIMARY KEY(id)
);

INSERT INTO Categories (name, immagine)
VALUES ('Tecnologia', '../images/Tecnologia.jpg'),
       ('Libri', '../images/libri.jpg'),
       ('Cucina', '../images/cucina.jpg'),
       ('Estetica', '../images/estetica.jpg'),
       ('Videogiochi', '../images/videogiochi.jpg'),
       ('Sport', '../images/sport.jpg');

CREATE TABLE Products (
                          id INT AUTO_INCREMENT,
                          name VARCHAR(255),
                          description TEXT,
                          price DECIMAL(10,2),
                          immagine VARCHAR(255),
                          idCategoria INT,
                          PRIMARY KEY(id),
                          foreign key (idCategoria) references Categories(id)
);

INSERT INTO Products (name, description, price, immagine, idCategoria)
VALUES ('Nome del prodotto', 'Descrizione del prodotto', 99.99, '../images/prodotto1.jpg', 1),
       ('integrali', 'matematica', 300, '../images/prodotto2.jpg', 1),
       ('fisica', 'fisica', 200, '../images/prodotto3.jpg', 1);

CREATE TABLE Orders (
                        id INT AUTO_INCREMENT,
                        user_id INT,
                        total DECIMAL(10,2),
                        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                        PRIMARY KEY(id),
                        FOREIGN KEY(user_id) REFERENCES Users(id)
);