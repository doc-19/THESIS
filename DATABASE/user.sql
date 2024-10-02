CREATE DATABASE resource_management_system_user;

USE resource_management_system_user;

CREATE TABLE admin (
    admin_id int AUTO_INCREMENT PRIMARY KEY,
    username varchar(30),
    password varchar(30),
    role VARCHAR(20),
    email_address VARCHAR(70),
    phone_number VARCHAR(20),
    department_name VARCHAR(20)
);

CREATE TABLE other_user (
    other_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(30),
    password VARCHAR(30),
    role VARCHAR(20),
    email_address VARCHAR(70),
    phone_number VARCHAR(20),
    department_name VARCHAR(20)
);

