CREATE TABLE clubs(
 id int PRIMARY KEY AUTO_INCREMENT,
    name varchar(255),
    ville varchar(255),
    created_at  timestamp DEFAULT timestamp
);

CREATE TABLE team(
    id int PRIMARY KEY AUTO_INCREMENT,
    name varchar (255),
    jeu varchar (255),
    club_id int,
    FOREIGN KEY(club_id) REFERENCES clubs(id)
);


CREATE TABLE joueur(
    pseudo varchar (255) UNIQUE,
    role varchar (255),
    salaire float,
    team_id int,
    FOREIGN KEY(team_id) REFERENCES team(id)
);

CREATE TABLE Tournoi(
    titre varchar(255)NOT null,
    cashprize float,
    format varchar(255)NOT null,
    tounoi_date date
);

CREATE TABLE sponsor(
    name varchar(255) not null UNIQUE,
    contribution_finan float,
    tournoi_id int,
    FOREIGN KEY(tournoi_id) REFERENCES tournoi(id)
);

ALTER TABLE Tournoi
ADD id INT  PRIMARY KEY AUTO_INCREMENT;

CREATE TABLE matches(
id int PRIMARY key AUTO_INCREMENT,
    score_A int,
    score_B int,
    idteam_A int not null ,
    FOREIGN key (idteam_A) REFERENCES team(id),
    idteam_B int not null,
    FOREIGN key (idteam_B) REFERENCES team(id),
    tournoi_id int NOT null,
    FOREIGN KEY (tournoi_id) REFERENCES tournoi(id),
    gagnant_id int DEFAULT null
    
);


CREATE INDEX idx_club_name
ON clubs(name)

CREATE INDEX idx_team_name
ON team(name)

CREATE INDEX idx_match_id
on matches(id)