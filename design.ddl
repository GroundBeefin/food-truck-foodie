drop table if exists post;
drop table if exists user;
drop table if exists truck;


create table user(
	userId binary(16) not null,
	userActivationToken varchar(32) not null,
	userAvatarUrl varchar (32) not null,
	userEmail varchar(32) not null,
	userHash char(8)not null,
	userName Varchar(32),
	primary key (userId)

);

create table truck(
	truckId binary(16) not null,
	truckUserId varchar(16),
	truckAvatarUrl varchar(32),
	truckEmail varchar(128) not null,
	truckFoodType varchar(62),
	truckMenu varchar(8),
	truckName varchar(32) not null,
	truckPhoneNumber char(10) not null,
	truckVerifyImage boolean,
	truckVerifyCheck boolean,
	primary key(truckId)

);


create table post(
	postId binary(16) not null,
	postUserId varchar(16),
	postTruckId varchar(16),
	postContent varchar(144),
	postDatetime datetime(6),
	primary key(postId),
	foreign key(postTruckId) references truck(truckId)

);