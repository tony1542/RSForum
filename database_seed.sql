CREATE DATABASE IF NOT EXISTS tonysphpadminabuse;

CREATE TABLE user
(
    user_id       int AUTO_INCREMENT,
    username      varchar(12)  NOT NULL,
    email_address varchar(255) NOT NULL,
    column_4      int          NULL,
    password      varchar(255) NOT NULL,
    CONSTRAINT user_pk
        PRIMARY KEY (user_id)
);

