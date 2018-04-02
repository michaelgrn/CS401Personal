CREATE TABLE users(
  username VARCHAR(20) NOT NULL,
  password VARCHAR(20) NOT NULL,
  email VARCHAR(20) NOT NULL,
  idnum int(11) NOT NULL PRIMARY KEY
);

CREATE TABLE product(
  name VARCHAR(100) NOT NULL,
  image VARCHAR(80) NOT NULL,
  type VARCHAR(20) NOT NULL,
  id int(11) NOT NULL PRIMARY KEY
);

CREATE TABLE riders(
  ridername VARCHAR(100) NOT NULL,
  thumbnail VARCHAR(100) NOT NULL,
  ridernumber int(11) NOT NULL PRIMARY KEY
);
