CREATE TABLE members (
    id VARCHAR(50) NOT NULL PRIMARY KEY,
	email VARCHAR(255) UNIQUE NOT NULL,
    picture VARCHAR(255),
    provider VARCHAR(50) NOT NULL
);

CREATE TABLE categories (

);

CREATE TABLE foods (
    id SERIAL PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    quantity INTEGER NOT NULL,
    details VARCHAR(500),
    cid INTEGER NOT NULL,
    uid VARCHAR NOT NULL REFERENCES bikes(bike_id) ON DELETE CASCADE
);
