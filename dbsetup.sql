CREATE TABLE users (
	uid int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
	username varchar(20) NOT NULL,
	email varchar(128) NOT NULL,
	password varchar(128) NOT NULL,
	role varchar(128) NOT NULL
);

INSERT INTO users (username, email, password, role) VALUES ("admin", "admin@example.com", "$2a$12$GIoJFq4M59V7tbIc2CZ/K.gtFFZDv/QXRYGdrcEsCFgcQ9UyzCib2","admin");