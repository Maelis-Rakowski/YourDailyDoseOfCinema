create database yddoc;
CREATE USER 'yddoc'@'%' IDENTIFIED WITH caching_sha2_password BY 'QfqWbB25e7K(kS?s';GRANT USAGE ON *.* TO 'yddoc'@'%';GRANT ALL PRIVILEGES ON `yddoc`.* TO 'yddoc'@'%';
REVOKE ALL PRIVILEGES ON `yddoc`.* FROM 'yddoc'@'%'; GRANT ALL PRIVILEGES ON `yddoc`.* TO 'yddoc'@'%'; ALTER USER 'yddoc'@'%' ;

create table if not EXISTS users (
	id integer PRIMARY KEY AUTO_INCREMENT,
    email text not null,
    pseudo text not null,
    password text not null,
    isAdmin boolean not null
);