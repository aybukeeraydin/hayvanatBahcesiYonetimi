CREATE DATABASE dbstorage23360859747;
USE dbstorage23360859747;

CREATE TABLE animals (
  animal_id INT(11) NOT NULL AUTO_INCREMENT,
  name VARCHAR(255) NOT NULL,
  species VARCHAR(255) NOT NULL,
  birth_date DATE DEFAULT NULL,
  gender ENUM('Male','Female') NOT NULL,
  PRIMARY KEY (animal_id)
);

CREATE TABLE users (
  id INT(11) NOT NULL AUTO_INCREMENT,
  username VARCHAR(50) NOT NULL,
  password VARCHAR(255) NOT NULL,
  PRIMARY KEY (id)
);
