create database homework_campaign;

use homework_campaign;

grant all on homework_campaign.* to testuser@localhost identified by '9999';

create table users (
id int primary key auto_increment,
name varchar(32),
email varchar(255),
adnum_a int(3),
adnum_b int(4),
adress varchar(255),
created_at datetime,
password int(7)
);