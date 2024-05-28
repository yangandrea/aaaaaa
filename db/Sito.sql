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
INSERT INTO Users (username, password, email, birthdate)
VALUES ('admin', '12345678', 'admin@admin.com', '1990-01-01'),
       ('capra', '12345678', 'capra@capra.com', '1990-01-01');

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
VALUES ('Cuffie', 'Cuffie bluetooth', 29.99, '../images/cuffie.jpg', 1),
       ('Controller TV', 'Controller TV', 14.99, '../images/controller.jpg', 1),
       ('Auricolari', 'Auricolari', 19.99, '../images/auricolari.jpg', 1);

CREATE TABLE Orders (
    id INT AUTO_INCREMENT,
    user_id INT,
    total DECIMAL(10,2),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY(id),
    FOREIGN KEY(user_id) REFERENCES Users(id)
);

CREATE TABLE CartDetails (
     id INT AUTO_INCREMENT,
     order_id INT,
     product_id INT,
     count INT,
     PRIMARY KEY(id),
     FOREIGN KEY(order_id) REFERENCES Orders(id),
     FOREIGN KEY(product_id) REFERENCES Products(id)
);