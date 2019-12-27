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

# Insert a row of dummy data
INSERT INTO user
SET username      = 'test',
    email_address = 'test@test.com',
    password      = 'testpassword';