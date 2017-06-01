CREATE DATABASE spotter;

CREATE TABLE users (
	id       serial unique,
	username varchar(20) not null,
	password varchar(120) not null,
	fname    varchar(100),
	lname    varchar(100)
);

CREATE TABLE locations (
	id          serial unique,
	title       varchar(100) not null,
	description text,
	coordinates varchar(100) not null,
	isPublic    bool
);

CREATE TABLE categories (
	id      serial unique,
	title   varchar(50) not null
);

CREATE TABLE favorites (
	id          serial unique,
	userId      int references users(id) not null,
	locationId  int references locations(id) not null
);

CREATE TABLE locationCategories (
	id          serial unique,
	locationId  int references locations(id) not null,
	categoryId  int references categories(id) not null
);