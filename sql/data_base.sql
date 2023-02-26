DROP DATABASE IF EXISTS cloud_fast;

CREATE DATABASE cloud_fast;

USE cloud_fast;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    user_username VARCHAR(255) UNIQUE DEFAULT NULL,
    user_email VARCHAR(255) UNIQUE DEFAULT NULL,
    registration_date_user TIMESTAMP NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
    user_password VARCHAR(255) DEFAULT NULL,
    storage_directory_user VARCHAR(255) DEFAULT NULL,
    policy_terms VARCHAR(255) DEFAULT NULL
);

CREATE TABLE files (
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    user_id INT NOT NULL,
    storage_directory VARCHAR(255) DEFAULT NULL,
    size DECIMAL(20,20) DEFAULT NULL,
    upload_date TIMESTAMP NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),

    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE texts (
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    user_id INT NOT NULL,
    texts_title VARCHAR(250) DEFAULT NULL,
    texts VARCHAR(5000) DEFAULT NULL,
    upload_date TIMESTAMP NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),

    FOREIGN KEY (user_id) REFERENCES users(id) 
);

CREATE TABLE multimedia (
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    user_id INT NOT NULL,
    storage_directory VARCHAR(255) DEFAULT NULL,
    size DECIMAL(20,20) DEFAULT NULL,
    upload_date TIMESTAMP NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),

    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE documents (
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    user_id INT NOT NULL,
    storage_directory VARCHAR(255) DEFAULT NULL,
    size DECIMAL(20,20) DEFAULT NULL,
    upload_date TIMESTAMP NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),

    FOREIGN KEY (user_id) REFERENCES users(id)
);
