create database yddoc;

create table if not EXISTS users (
	id integer PRIMARY KEY,
    email text not null,
    pseudo text not null,
    password text not null,
    isAdmin boolean not null
);