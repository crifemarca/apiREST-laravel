CREATE DATABASE IF NOT EXISTS doublepartners;
USE apilaravel;

CREATE TABLE users(
id 		int(255) auto_increment not null,
email varchar(255),
role	varchar(20),
name	varchar(255),
surname	varchar(255),
password varchar(255),
created_at datetime DEFAULT NULL,
updated_at datetime DEFAULT NULL,
remember_token varchar(255),
CONSTRAINT pk_users PRIMARY KEY(id)
)ENGINE=InnoDb;

CREATE TABLE tickets(
id 		int(255) auto_increment not null,
user_id int(255) not null,
title	varchar(255),
description text,
status  varchar(30),
created_at datetime DEFAULT NULL,
updated_at datetime DEFAULT NULL,
CONSTRAINT pk_tickets PRIMARY KEY(id),
CONSTRAINT fk_tickets_users FOREIGN KEY(user_id) REFERENCES users(id)
)ENGINE=InnoDb;
