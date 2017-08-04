CREATE TABLE users(
    id INT (11) NOT NULL AUTO_INCREMENT, 
    username VARCHAR(255), 
    hashed_password TEXT,
    email VARCHAR(255),
    city VARCHAR(255),
    state VARCHAR(255),
    bio TEXT,
    avatar VARCHAR(255),
    PRIMARY KEY (id)
);