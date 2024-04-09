drop database if exists sito;
create database sito;
use sito;

CREATE TABLE Products (
                          id INT AUTO_INCREMENT,
                          name VARCHAR(255),
                          description TEXT,
                          price DECIMAL(10,2),
                          PRIMARY KEY(id)
);
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

CREATE TABLE Orders (
                        id INT AUTO_INCREMENT,
                        user_id INT,
                        total DECIMAL(10,2),
                        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                        PRIMARY KEY(id),
                        FOREIGN KEY(user_id) REFERENCES Users(id)
);
INSERT INTO Products (name, description, price)
<<<<<<< HEAD
VALUES ('Nome del prodotto', 'Descrizione del prodotto', 99.99),
       ('integrali', 'matematica', 300),
       ('fisica', 'fisica', 200);
=======
VALUES ('Nome del prodotto', 'Descrizione del prodotto', 99.99);
VALUES ('integrali', 'matematica', 300);
VALUES ('fisica', 'fisica', 200);
>>>>>>> origin/master
