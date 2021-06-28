create database db1;
use db1;

create table doctors (docID int primary key auto_increment ,username varchar(25) not NULL,email  varchar(25) not NULL, password varchar(25) not NULL);

create table patients (pID int primary key auto_increment ,pname varchar(25) not NULL,diagnosis   varchar(25) not NULL, casetype varchar(25) not NULL);

create table appointments   (aID int primary key auto_increment, apDate date, d_ID int, p_ID int );
alter table appointments  add foreign key (d_ID) references doctors(docID) on update cascade on delete cascade;
alter table appointments  add foreign key (p_ID) references patients  (pID) on update cascade on delete cascade;

insert into doctors (username, email, password) values ("maham", "maham@gmail.com", "M1m");

