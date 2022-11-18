CREATE TABLE users (
	uid int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
	username varchar(20) NOT NULL,
	email varchar(128) NOT NULL,
	password varchar(128) NOT NULL,
	role varchar(128) NOT NULL
);