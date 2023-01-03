CREATE TABLE members (
    id VARCHAR(50) NOT NULL PRIMARY KEY,
	email VARCHAR(255) UNIQUE NOT NULL,
    picture VARCHAR(255),
    provider VARCHAR(50) NOT NULL
);

CREATE TABLE categories (
    id INTEGER PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    image VARCHAR(100) NOT NULL
);

CREATE TABLE foods (
    id SERIAL PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    quantity INTEGER NOT NULL,
    details VARCHAR(500),
    cid INTEGER REFERENCES categories(id) ON DELETE CASCADE,
    uid VARCHAR REFERENCES members(id) ON DELETE CASCADE
);

INSERT INTO categories 
VALUES 
(1, 'Viandes', 'https://freezer.alwaysdata.net/static/meat.png'),
(2, 'Légumes', 'https://freezer.alwaysdata.net/static/vegetables.png'),
(3, 'Poissons',	'https://freezer.alwaysdata.net/static/fish.png'),
(4, 'Fruits', 'https://freezer.alwaysdata.net/static/fruits.png'),
(5, 'Glaces', 'https://freezer.alwaysdata.net/static/ice_cream.png'),
(6, 'Condiments', 'https://freezer.alwaysdata.net/static/spices.png'),
(7, 'Plats cuisinés', 'https://freezer.alwaysdata.net/static/food.png'),
(8, 'Pains', 'https://freezer.alwaysdata.net/static/bread.png'),
(9, 'Desserts',	'https://freezer.alwaysdata.net/static/dessert.png'),
(10, 'Produits laitiers', 'https://freezer.alwaysdata.net/static/milk.png');