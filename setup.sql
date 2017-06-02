CREATE DATABASE spotter;

CREATE TABLE users (
	id       serial unique primary key,
	username varchar(20) not null,
	password varchar(120) not null,
	fname    varchar(100),
	lname    varchar(100)
);

CREATE TABLE locations (
	id          serial unique primary key,
	title       varchar(100) not null,
	description text,
    lat         Numeric(10,6),
    lon         Numeric(10,6),
	isPublic    bool
);

CREATE TABLE categories (
	id      serial unique primary key,
	title   varchar(50) not null
);

CREATE TABLE favorites (
	id          serial unique primary key,
	userId      int references users(id) not null,
	locationId  int references locations(id) not null
);

CREATE TABLE locationCategories (
	id          serial unique primary key,
	locationId  int references locations(id) not null,
	categoryId  int references categories(id) not null
);