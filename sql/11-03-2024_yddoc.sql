

create table if not EXISTS users (
	id integer PRIMARY KEY AUTO_INCREMENT,
    email text not null,
    pseudo text not null,
    password text not null,
    isAdmin boolean not null,
    token VARCHAR(255) NULL,
    lastRequestedDate TIMESTAMP NULL
);

create table if not EXISTS movies (
	id integer PRIMARY KEY AUTO_INCREMENT,
    title text not null,
    releaseDate text not null,
    runtime integer not null,
    posterPath text not null,
    overview text not null,
    tagline text not null
);

create table if not EXISTS genres (
	id integer PRIMARY KEY AUTO_INCREMENT,
    genre text not null
);

create table if not EXISTS countries (
	id integer PRIMARY KEY AUTO_INCREMENT,
    name text not null
);

create table if not EXISTS directors (
	id integer PRIMARY KEY AUTO_INCREMENT,
    name text not null
);

create table if not EXISTS movieDirectors (
	idMovie integer,
    idDirector integer,
    PRIMARY KEY (idMovie, idDirector),
    FOREIGN KEY (idMovie)  references movies(id),
    FOREIGN KEY (idDirector)  references directors(id)
);

create table if not EXISTS movieCountries (
	idMovie integer,
    idCountry integer,
    PRIMARY KEY (idMovie, idCountry),
    FOREIGN KEY (idMovie)  references movies(id),
    FOREIGN KEY (idCountry)  references countries(id)
);

create table if not EXISTS movieGenres (
	idMovie integer,
    idGenre integer,
    PRIMARY KEY (idMovie, idGenre),
    FOREIGN KEY (idMovie)  references movies(id),
    FOREIGN KEY (idGenre)  references genres(id)
);