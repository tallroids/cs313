insert into users(username, password, fname, lname) values ('tallrois', 'tallroids', 'Ben', 'Harker');

insert into locations(title, description, coordinates, ispublic) values ('Falls Creek Falls', 'Right off the road in Swan Valley', '123.34.34.23, 123.12.12.23', 'true');
insert into locations(title, description, coordinates, ispublic) values ('St. Anthony Sand Dunes', 'A little out of the way, but free. Great for fashion photography', '123.56.34.23, 123.67.12.23', 'true');
insert into locations(title, description, coordinates, ispublic) values ('Rexburg Nature Park', 'Pretty in the summer, and has some cool scenes in the fall and spring as well.', '123.56.34.23, 123.67.12.23', 'true');

insert into categories(title) values ('Landscape');
insert into categories(title) values ('Portrait');

insert into favorites(userId, locationId) values (1, 1);
insert into favorites(userId, locationId) values (1, 2);

insert into locationCategories(locationId, categoryId) values (1, 1);
insert into locationCategories(locationId, categoryId) values (2, 1);
insert into locationCategories(locationId, categoryId) values (2, 2);
insert into locationCategories(locationId, categoryId) values (3, 2);
