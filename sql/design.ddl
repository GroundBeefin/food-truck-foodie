drop table if exists post;
drop table if exists truck;
drop table if exists user;


create table user(
	userId binary(16) not null,
	userActivationToken char(32) not null,
	userAvatarUrl varchar(255),
	userEmail varchar(128) not null,
	userHash char(97) not null,
	userName varchar(16)not null,
	unique (userEmail),
	primary key(userId)
);

create table truck(
	truckId binary(16) not null,
	truckUserId binary (16) not null,
	truckAvatarUrl varchar(255),
	truckEmail varchar(128) not null,
	truckFoodType varchar(50) not null,
	truckMenuUrl varchar(255),
	truckPhoneNumber char (10),
	truckVerifyImage varchar(255),
	truckVerifiedCheck tinyint(1) not null,
	truckName varchar(16),
	primary key (truckId)
);


create table post(
	postId binary(16) not null,
	postTruckId binary(16),
	postUserId binary(16),
	postContent varchar(144) null,
	postDatetime datetime(6) not null,
	primary key (postId)
);
