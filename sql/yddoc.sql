create database yddoc;
CREATE USER 'yddoc'@'%' IDENTIFIED WITH caching_sha2_password BY '***';GRANT USAGE ON *.* TO 'yddoc'@'%';GRANT ALL PRIVILEGES ON `yddoc`.* TO 'yddoc'@'%';

create table if not EXISTS users (
	id integer PRIMARY KEY,
    email text not null,
    pseudo text not null,
    password text not null,
    isAdmin boolean not null
);