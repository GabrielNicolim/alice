/* CREATE DATABASE  */
CREATE DATABASE alice_db;

/* USERS TABLE */
CREATE TABLE users (
id_user SERIAL PRIMARY KEY NOT NULL,
name_user VARCHAR(40) NOT NULL,
email_user VARCHAR(128) NOT NULL UNIQUE,
password_user VARCHAR(72) NOT NULL,
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
clearance INT NOT NULL DEFAULT 0
);

/* RECORDS TABLE */
CREATE TABLE user_records (
id_record SERIAL PRIMARY KEY NOT NULL,
name_record VARCHAR(100),
quantity_record INT NOT NULL,
type_record VARCHAR(20),
price_record DECIMAL(10,2),
deleted BOOLEAN NOT NULL,
timeDeleted TIMESTAMP DEFAULT NULL,
fk_user BIGINT UNSIGNED NOT NULL,
FOREIGN KEY (fk_user) REFERENCES users (id_user)
);

/* DROP TABLE */

/* DROP TABLE users_records , users; */