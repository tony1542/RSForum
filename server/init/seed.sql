CREATE DATABASE IF NOT EXISTS rsforumvue;

CREATE TABLE
    user
(
    user_id         int AUTO_INCREMENT,
    username        varchar(12)       NOT NULL,
    account_type_id int(11) DEFAULT 0 NOT NULL,
    email_address   varchar(255)      NOT NULL,
    password        varchar(255)      NOT NULL,
    logged_in       tinyint DEFAULT 0 NOT NULL,
    admin           tinyint DEFAULT 0 NOT NULL,
    CONSTRAINT user_pk
        PRIMARY KEY (user_id)
);

CREATE TABLE user_skills
(
    user_stat_id int AUTO_INCREMENT
        PRIMARY KEY,
    username     varchar(12)                          NOT NULL,
    skill_name   varchar(255)                         NOT NULL,
    skill_exp    int      DEFAULT 0                   NOT NULL,
    `rank`       int      DEFAULT 0                   NOT NULL,
    date_added   datetime DEFAULT CURRENT_TIMESTAMP() NOT NULL
);

CREATE INDEX user_skills_user_stat_id_index
    ON user_skills (user_stat_id);

CREATE INDEX user_skills_username_index
    ON user_skills (username);

CREATE TABLE task
(
    task_id      int AUTO_INCREMENT
        PRIMARY KEY,
    title        varchar(255) NULL,
    description  varchar(255) NULL,
    is_completed tinyint(1) DEFAULT 0 NOT NULL,
    date         date NOT NULL,
    user_id      int NULL
);

CREATE INDEX user_id
    ON task (user_id);

CREATE TABLE user_accolades
(
    user_accolade_id int AUTO_INCREMENT,
    username         varchar(12) NOT NULL,
    date_added       datetime DEFAULT NOW() NULL,
    CONSTRAINT user_accolades_pk
        PRIMARY KEY (user_accolade_id)
);

CREATE TABLE user_accolades_line
(
    user_accolade_id int          NOT NULL,
    accolade_index   int          NOT NULL,
    accolade_name    varchar(255) NOT NULL,
    score            int          NOT NULL,
    `rank`           int          NOT NULL
);

CREATE TABLE post
(
    post_id    int AUTO_INCREMENT,
    user_id    int                    NOT NULL,
    title      varchar(255)           NOT NULL,
    body       text                   NOT NULL,
    date_added datetime DEFAULT NOW() NOT NULL,
    CONSTRAINT post_pk
        PRIMARY KEY (post_id)
);

CREATE TABLE post_comment
(
    post_comment_id int AUTO_INCREMENT,
    user_id         int                    NOT NULL,
    post_id         int                    NOT NULL,
    comment         text                   NOT NULL,
    date_added      datetime DEFAULT NOW() NOT NULL,
    CONSTRAINT post_comment_pk
        PRIMARY KEY (post_comment_id)
);

CREATE TABLE home_page_posts
(
    home_page_post_id int AUTO_INCREMENT,
    user_id           int                    NOT NULL,
    title             varchar(255)           NOT NULL,
    body              text                   NOT NULL,
    date_added        datetime DEFAULT NOW() NOT NULL,
    CONSTRAINT home_page_posts_pk
        PRIMARY KEY (home_page_post_id)
);

CREATE TABLE rss_results
(
    rss_results_id int AUTO_INCREMENT,
    saved_at       datetime DEFAULT NOW() NOT NULL,
    results        blob                   NOT NULL,
    CONSTRAINT rss_results_pk
        PRIMARY KEY (rss_results_id)
);