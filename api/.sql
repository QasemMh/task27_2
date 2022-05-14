CREATE DATABASE task27_2;
use task27_2;

-- category
CREATE TABLE category(
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(60) NOT NULL
);
 
-- users
CREATE TABLE users(
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(60) NOT NULL,
    username VARCHAR(60) NOT NULL UNIQUE,
    email VARCHAR(60) UNIQUE,
    password VARCHAR(60) NOT NULL,
    createAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP()
);

-- slider
 CREATE TABLE slider(
id int(11) PRIMARY KEY AUTO_INCREMENT,
title varchar(50) not null,
sub_title varchar(250) not null
 );
 
 -- special section
CREATE TABLE special(
id int(11) PRIMARY KEY AUTO_INCREMENT,
title varchar(50) not null,
discount decimal(5,2) not null,
path varchar(255) not null
 );
 
 -- menu
 CREATE table menu(
id int(11) PRIMARY KEY AUTO_INCREMENT,
title varchar(250) not null,
sub_title varchar(250) not null,
price decimal(5,2) not null,     
path varchar(255) not null,
category_id int(11) not null,
FOREIGN KEY(category_id) REFERENCES category(id)
 );
 
-- about us
CREATE TABLE aboutUs(
id int(11) PRIMARY KEY AUTO_INCREMENT,
title varchar(250) not null,
content text not null);

-- home
CREATE TABLE home(
id int(11) PRIMARY KEY AUTO_INCREMENT,
tap_title varchar(50) not null,
logo_name varchar(50) not null,
facebook_url varchar(255) not null,
insta_url varchar(255) not null,
twitter_url varchar(255) not null,
phone varchar(14) not null,
email varchar(150) not null,
location varchar(50) not null,
open_hour varchar(50) not null,
about varchar(250) not null
);


 -- feedback
create table feedback(
id int(11) PRIMARY KEY AUTO_INCREMENT,
name varchar(20) not null,
content varchar(250) not null,
path varchar(255) not null
);

 -- book_table
create table book_table(
id int(11) PRIMARY KEY AUTO_INCREMENT,
name varchar(50) not null,
phone varchar(20) not null,
email varchar(255) not null,
capacity int(2) not null,
the_date timestamp not null
    
);



ALTER TABLE `book_table` ADD `user_id` INT(11) NOT NULL REFERENCES users(id);



