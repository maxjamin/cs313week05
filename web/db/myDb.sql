
CREATE TABLE Customer (
	user_id integer PRIMARY KEY,
	userName varchar(225),
	email varchar(225),
	login varchar(225)
);

CREATE TABLE Orders (
	order_id integer PRIMARY KEY,
	address varchar(225),
	user_id integer REFERENCES Customer(user_id)
);

CREATE TABLE OrderItems (
	order_iteamId integer PRIMARY KEY,
	quantity integer,
	artwork_id integer REFERENCES Artwork(artwork_id) ON DELETE RESTRICT,
	order_id integer REFERENCES Orders(order_id) ON DELETE CASCADE
);

CREATE TABLE Artist (
	artist_id integer PRIMARY KEY,
	name varchar(225),
	yearActivated int,
	email varchar(225),
	login varchar(225)	
);

CREATE TABLE Artwork (
	artwork_id integer PRIMARY KEY,
	price real,
	dimensions varchar(225),
	quantity int,
	description text,
	artist_id integer REFERENCES Artist(artist_id)

);














