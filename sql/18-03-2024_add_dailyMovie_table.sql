create table if not exists dailyMovie (
    id integer primary key AUTO_INCREMENT,
    date date,
	idMovie integer,
    foreign key (idMovie) references movies(id)
);

create table if not exists playerHistory (
    idUser integer,
    idDailyMovie integer,
    tryNumber integer,
    success tinyint,
    primary key (idUser, idDailyMovie),
    foreign key (idUser) references users(id),
    foreign key (idDailyMovie) references dailyMovie(id)
)