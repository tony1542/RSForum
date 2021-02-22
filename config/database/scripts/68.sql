CREATE TABLE post_comment
(
    post_comment_id int AUTO_INCREMENT,
    user_id         int  NOT NULL,
    post_id         int  NOT NULL,
    comment         text NOT NULL,
    CONSTRAINT post_comment_pk
        PRIMARY KEY (post_comment_id)
);
