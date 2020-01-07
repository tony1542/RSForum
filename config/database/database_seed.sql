# Create database
CREATE DATABASE IF NOT EXISTS tonysphpadminabuse;

# Select our new database for operation
USE tonysphpadminabuse;

# Create user table
CREATE TABLE user
(
    user_id       int AUTO_INCREMENT,
    username      varchar(12)  NOT NULL,
    email_address varchar(255) NOT NULL,
    password      varchar(255) NOT NULL,
    logged_in     tinyint      DEFAULT 0 NOT NULL,
    CONSTRAINT user_pk
        PRIMARY KEY (user_id)
);

CREATE TABLE user_skills
(
    user_stat_id int AUTO_INCREMENT,
    username     varchar(12)  NOT NULL,
    overall      int NULL,
    attack       int NULL,
    defence      int NULL,
    strength     int NULL,
    hitpoints    int NULL,
    ranged       int NULL,
    prayer       int NULL,
    magic        int NULL,
    cooking      int NULL,
    woodcutting  int NULL,
    fletching    int NULL,
    fishing      int NULL,
    firemaking   int NULL,
    crafting     int NULL,
    smithing     int NULL,
    mining       int NULL,
    herblore     int NULL,
    agility      int NULL,
    thieving     int NULL,
    slayer       int NULL,
    farming      int NULL,
    runecrafting int NULL,
    hunter       int NULL,
    construction int NULL,
    CONSTRAINT user_stats_pk
        PRIMARY KEY (user_stat_id)
);

CREATE INDEX user_skills_user_stat_id_index
    ON user_skills (user_stat_id);

CREATE INDEX user_skills_username_index
    ON user_skills (username);