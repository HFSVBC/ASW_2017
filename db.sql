create table proj_users(
    id INT(5) UNSIGNED NOT NULL AUTO_INCREMENT,
    fName VARCHAR(250) NOT NULL,
    lName VARCHAR(250) NOT NULL,
    username VARCHAR(64) NOT NULL,
    email VARCHAR(250) NOT NULL,
    password VARCHAR(260) NOT NULL,
    balance FLOAT(20) NOT NULL DEFAULT 500.00,
    birthDate DATE NOT NULL,
    sex VARCHAR(2) NOT NULL,
    country VARCHAR(2) NOT NULL,
    district INT(10) UNSIGNED,
    county INT(10) UNSIGNED,
    avatar VARCHAR(250),
    active INT(1) UNSIGNED NOT NULL DEFAULT 0,
    hash VARCHAR(260) NOT NULL,
    creationDate TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    activationDate TIMESTAMP NOT NULL,
    level INT(1) UNSIGNED NOT NULL DEFAULT 1,
    PRIMARY KEY (id),
    UNIQUE (username, email)
    -- FOREIGN KEY (district) REFERENCES dist_con(id),
    -- FOREIGN KEY (county) REFERENCES dist_con(id)
);
CREATE TABLE proj_game(
    id INT(8) UNSIGNED,
    name VARCHAR(250) NOT NULL,
    active INT(1) NOT NULL DEFAULT 1,
    createdBy INT(5) UNSIGNED,
    creationDate TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    endedDate TIMESTAMP NOT NULL,
    winner INT(5) UNSIGNED,
    totalUsers INT(2) NOT NULL DEFAULT 1,
    PRIMARY KEY (id),
    UNIQUE (name),
    FOREIGN KEY (createdBy) REFERENCES proj_users(id),
    FOREIGN KEY (winner) REFERENCES proj_users(id)
);
CREATE TABLE proj_participants(
    user INT(5) UNSIGNED,
    game INT(8) UNSIGNED,
    enteredDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (user, game),
    FOREIGN KEY (user) REFERENCES proj_users(id),
    FOREIGN KEY (game) REFERENCES proj_game(id)
);