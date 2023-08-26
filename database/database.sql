SET client_encoding = 'UTF8';

CREATE TABLE users (
    id VARCHAR(50),
    username VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    PRIMARY KEY(id)
);

CREATE TABLE categories (
    id SERIAL,
    name VARCHAR(255) UNIQUE NOT NULL,
    picture VARCHAR(255) NOT NULL,
    PRIMARY KEY(id)
);

INSERT INTO categories (name, picture)
VALUES 
('Viandes', 'img/meat.png'),
('Légumes', 'img/vegetables.png'),
('Poissons', 'img/fish.png'),
('Glaces', 'img/ice_cream.png'),
('Condiments', 'img/spices.png'),
('Plats cuisinés', 'img/food.png'),
('Pains', 'img/bread.png'),
('Desserts', 'img/dessert.png'),
('Produits laitiers', 'img/milk.png'),
('Fruits', 'img/fruits.png');

CREATE TABLE foods (
    id SERIAL,
    name VARCHAR(255) NOT NULL,
    quantity INTEGER NOT NULL,
    details VARCHAR(1000),
    user_id VARCHAR(50),
    category INTEGER,
    FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY(category) REFERENCES categories(id) ON DELETE CASCADE,
    PRIMARY KEY(id)
);
