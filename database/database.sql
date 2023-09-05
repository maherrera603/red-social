CREATE DATABASE IF NOT EXISTS social;

USE social;

CREATE TABLE IF NOT EXISTS users(
    id INT(255) AUTO_INCREMENT NOT NULL,
    name VARCHAR(100) NOT NULL,
    lastname VARCHAR(100) NOT NULL,
    phone VARCHAR(10) NULL,
    profile_image VARCHAR(100) NULL,
    cover_image VARCHAR(100) NULL,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(100) NOT NULL,
    status VARCHAR(50) NOT NULL,
    created_at DATE NOT NULL,
    updated_at DATE NULL,
    CONSTRAINT pk_user PRIMARY KEY(id),
    CONSTRAINT uq_user UNIQUE(email)
)ENGINE=InnoDb;


CREATE TABLE IF NOT EXISTS publications(
    id INT(255) AUTO_INCREMENT NOT NULL,
    user_id INT(255) NOT NULL,
    image VARCHAR(255) NULL,
    description TEXT NOT NULL,
    created_at DATE NOT NULL,
    updated_at DATE NULL,
    CONSTRAINT pk_publication PRIMARY KEY(id),
    CONSTRAINT fk_publication_user FOREIGN KEY(user_id) REFERENCES users(id)
)ENGINE=InnoDb;

CREATE TABLE IF NOT EXISTS likes(
    id INT(255) NOT NULL AUTO_INCREMENT,
    user_id INT(255) NOT NULL,
    publication_id INT(255) NOT NULL,
    likes INT(255) NOT NULL,
    created_at DATE NOT NULL,
    updated_at DATE NULL,
    CONSTRAINT pk_like PRIMARY KEY(id),
    CONSTRAINT fk_like_user FOREIGN KEY(user_id) REFERENCES users(id),
    CONSTRAINT fk_like_publication FOREIGN KEY(publication_id) REFERENCES publications(id)
)ENGINE=InnoDb;

CREATE TABLE IF NOT EXISTS friends(
    id INT(255) NOT NULL AUTO_INCREMENT,
    user_id INT(255) NOT NULL,
    friend_user_id INT(255) NOT NULL,
    status VARCHAR(30) NOT NULL,
    created_at DATE NOT NULL,
    updated_at DATE NULL,
    CONSTRAINT pk_friend PRIMARY KEY(id),
    CONSTRAINT fk_friends_user FOREIGN KEY(user_id) REFERENCES users(id),
    CONSTRAINT fk_friends_friend_user FOREIGN KEY(friend_user_id) REFERENCES users(id)
)ENGINE=InnoDb;

CREATE TABLE IF NOT EXISTS notifications(
    id INT(255) NOT NULL AUTO_INCREMENT,
    user_id INT(255) NOT NULL,
    friend_user_id INT(255) NOT NULL,
    notification TEXT NOT NULL,
    created_at DATE NOT NULL,
    updated_at DATE NULL,
    CONSTRAINT pk_notification PRIMARY KEY(id),
    CONSTRAINT fk_notification_user FOREIGN KEY(user_id) REFERENCES users(id),
    CONSTRAINT fk_notification_user_friend FOREIGN KEY(friend_user_id) REFERENCES users(id)
)ENGINE=InnoDb;