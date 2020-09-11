CREATE TABLE users (
    user_id int(11) AUTO_INCREMENT PRIMARY KEY not null,
    user_first VARCHAR(256) not null,
    user_last VARCHAR(256) not null,
    user_email VARCHAR(256) not null,
    user_uid VARCHAR(256) not null,
    user_pwd VARCHAR(256) not null
);

INSERT INTO users (user_first, user_last, user_email, user_uid, user_pwd) VALUES ('Daniel', 'Nielsen', 'dan@gmail.com', 'Daniel56-Niel', 'qwerty');

