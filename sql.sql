
create table users(
userid int PRIMARY KEY auto_increment,
fname varchar(20) not null,
lname varchar(20) not null,
username varchar(30)  ,
password varchar (30) not null,
imageUrl varchar(50) not null default 'default'

);


create table profile(
userId int primary key,
Country varchar (20) not null,
PostalCode varchar (20) not null,
currentStatus int not null,
DOB varchar(20),
lang varchar(20) not null,
YearsOfExperience int not null,
joiningDate varchar(20),
profileUrl varchar (30),
FOREIGN KEY (userID) REFERENCES users(userid)

);

create table connections(
userId1 int,
userId2 int,
FOREIGN KEY (userId1) REFERENCES users(userid),
FOREIGN KEY (userId2) REFERENCES users(userid),
PRIMARY KEY (userId1,userId2)
);

create table requests(
userId1 int,
userId2 int,
FOREIGN KEY (userId1) REFERENCES users(userid),
FOREIGN KEY (userId2) REFERENCES users(userid),
PRIMARY KEY (userId1,userId2)
);


create table Company(
CompanyId int NOT NULL AUTO_INCREMENT primary key,
companyName varchar(30) not null,
companySize int
);




create table Job(
userId int,
FOREIGN KEY (userId) REFERENCES users(userid),
jobTitle varchar(30),
startDate varchar(20),
endDate varchar(20),
designation varchar(30),
self_employeed varchar(2),
CompanyId int,
FOREIGN KEY (CompanyId) REFERENCES company(CompanyId)
);



create table Institution(
institutionId int not null auto_increment primary key,
name varchar (20),
description varchar(100)
);

create table education(
userId int primary key,
program varchar(30) not null,
startDate varchar(20) not null,
endDate varchar(20) not null,
institutionId int,
FOREIGN KEY (institutionId) REFERENCES institution(institutionId),
FOREIGN KEY (userId) REFERENCES users(userid)
);


