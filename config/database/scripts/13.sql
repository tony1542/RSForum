CREATE TABLE user_skills
  (
      user_stat_id int AUTO_INCREMENT,
      username     varchar(12)   NOT NULL,
      skill_name   varchar(255)  NOT NULL,
      skill_exp    int DEFAULT 0 NOT NULL,
      `rank`       int DEFAULT 0 NOT NULL,
      CONSTRAINT user_skills_pk
          PRIMARY KEY (user_stat_id)
  );