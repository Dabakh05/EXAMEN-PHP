CREATE DATABASE contacts_db;
USE contacts_db;

CREATE TABLE contacts (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nom VARCHAR(100),
  prenom VARCHAR(100),
  telephone VARCHAR(20),
  email VARCHAR(100),
  photo VARCHAR(255),
  date_ajout TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
