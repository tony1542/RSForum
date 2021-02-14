CREATE TABLE post
(
    post_id int AUTO_INCREMENT,
    user_id int          NOT NULL,
    title   varchar(255) NOT NULL,
    body    text         NOT NULL,
    CONSTRAINT post_pk
        PRIMARY KEY (post_id)
);