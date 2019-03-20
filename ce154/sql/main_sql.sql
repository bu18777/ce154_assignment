DROP DATABASE IF EXISTS ce154_bu18777;
CREATE DATABASE ce154_bu18777;
USE ce154_bu18777;

CREATE TABLE events (
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(120)
);

CREATE TABLE tasks (
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(120),
	priority ENUM("Low","Medium","High"),
	date DATETIME,
	event_id INT,
	FOREIGN KEY (event_id) REFERENCES events(id)
);