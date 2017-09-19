CREATE DATABASE lguids_db;
USE lguids_db;
GRANT ALL PRIVILEGES ON lguids_db.* TO 'lguidsuser'@'%' IDENTIFIED BY 'lguidsuser';
GRANT ALL PRIVILEGES ON lguids_db.* TO 'lguidsuser'@'localhost' IDENTIFIED BY 'lguidsuser';