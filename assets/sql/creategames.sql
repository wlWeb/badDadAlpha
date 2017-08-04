CREATE TABLE games(
    id INT (11) NOT NULL AUTO_INCREMENT, 
    user_id INT(255),
    league_id INT(255),
    score INT (255),
    strikes INT (20),
    spares INT (20),
    PRIMARY KEY (id),
    FOREIGN KEY (user_id) REFERENCES user(user_id)
);