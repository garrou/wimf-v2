SET client_encoding = 'UTF8';

CREATE TABLE users (
    id VARCHAR(50),
    username VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    registed_at DATE NOT NULL,
    PRIMARY KEY(id)
);

CREATE TABLE categories (
    id SERIAL,
    name VARCHAR(255) UNIQUE NOT NULL,
    picture VARCHAR(255) NOT NULL,
    PRIMARY KEY(id)
);

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
