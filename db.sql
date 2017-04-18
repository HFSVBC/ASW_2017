create table proj_users(
    `id` int(5) unsigned NOT NULL AUTO_INCREMENT,

    `fName` varchar(250) NOT NULL,
    `lName` varchar(250) NOT NULL,

    `username` varchar(64) NOT NULL,
    `email` varchar(250) NOT NULL,
    `password` varchar(260) NOT NULL,

    `balance` float NOT NULL DEFAULT '500',

    `birthDate` date NOT NULL,
    `sex` varchar(2) NOT NULL,
    `country` varchar(64) NOT NULL,
    `district` int(10) unsigned DEFAULT NULL,
    `county` int(10) unsigned DEFAULT NULL,
    `avatar` varchar(250) DEFAULT NULL,
    `active` int(1) unsigned NOT NULL DEFAULT '0',
    `hash` varchar(260) NOT NULL,
    `creationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `activationDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
    `level` int(1) unsigned NOT NULL DEFAULT '1',
    PRIMARY KEY (`id`),
    UNIQUE KEY `username` (`username`,`email`)
);
CREATE TABLE IF NOT EXISTS proj_game_request (
    id INT NOT NULL AUTO_INCREMENT,

    -- description information
    owner       int(5) unsigned NOT NULL, -- the user that placed this game request
    name        VARCHAR(191) NOT NULL,
    description TEXT,

    -- game details
    max_players INT NOT NULL,
    -- mudar de first_bet para small blind e big blind
    first_bet   INT NOT NULL, -- the amount that the firstplayer will have to bet

    -- keys and indeces
    PRIMARY KEY (id),
    FOREIGN KEY (owner) REFERENCES proj_users (id)
);

CREATE TABLE IF NOT EXISTS proj_game_status (
    id INT NOT NULL, -- the same id as in the game_request table

    -- details
    started_at DATETIME NOT NULL,
    ended_at   DATETIME,

    -- cards
    deck        VARCHAR(191) NOT NULL, -- shuffled, in the format 'AS 2H 7C 9S ...'
    table_cards VARCHAR(191) NOT NULL, -- the same format

    -- current status
    current_player int(5) unsigned NOT NULL,
    current_bet    INT NOT NULL, -- the amount the players must bet to stay in game
    current_pot    INT NOT NULL, -- the collected bets
    last_to_raise  int(5) unsigned NOT NULL,          -- the last player that raised the bet, to identify when the betting stage is over

    -- keys and indeces
    PRIMARY KEY (id),
    FOREIGN KEY (id) REFERENCES proj_game_request (id),
    FOREIGN KEY (current_player) REFERENCES proj_users (id),
    FOREIGN KEY (last_to_raise) REFERENCES proj_users (id)
);

-- the players of each game are stored in a dedicated table
-- the order of the players in this table defines the order in which they play the game
CREATE TABLE IF NOT EXISTS proj_game_players (
    id            INT NOT NULL,
    player_id     int(5) unsigned NOT NULL,
    player_cards  VARCHAR(5), -- the format is 'KD 3C'
    player_bet    INT, -- the total amount the player contributed to the pot
    player_folded BOOLEAN, -- whether the player has given up

    -- keys and indeces
    PRIMARY KEY (id, player_id),
    FOREIGN KEY (id) REFERENCES proj_game_request (id),
    FOREIGN KEY (player_id) REFERENCES proj_users (id)
);
CREATE TABLE proj_game_hist(
    id            int(5) unsigned NOT NULL AUTO_INCREMENT,
    game_id       INT NOT NULL,
    player_id     int(5) unsigned NOT NULL,
    operation     VARCHAR(100) NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (game_id) REFERENCES proj_game_request (id),
    FOREIGN KEY (player_id) REFERENCES proj_users (id)
);