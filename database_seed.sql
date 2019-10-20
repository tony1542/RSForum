# Create database
CREATE DATABASE IF NOT EXISTS tonysphpadminabuse;

CREATE TABLE user
(
    user_id       int AUTO_INCREMENT,
    username      varchar(12)  NOT NULL,
    email_address varchar(255) NOT NULL,
    password      varchar(255) NOT NULL,
    CONSTRAINT user_pk
        PRIMARY KEY (user_id)
);

INSERT INTO user
SET username      = 'test',
    email_address = 'test@test.com',
    password      = 'testpassword';