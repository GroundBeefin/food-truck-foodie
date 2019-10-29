drop table if exists post;
drop table if exists truck;
drop table if exists user;


create table user(
	userId binary(16) not null,
	userActivationToken char(32) not null,
	userAvatarUrl varchar(255),
	userEmail varchar(128) not null,
	userProfileHash char(97) not null,
	username varchar(16)not null,
	unique (userEmail),
	primary key(userId)
);

create table truck(
	truckId binary(16) not null,
	truckActivationToken char(32) not null,
	truckAvatarUrl varchar(255),
	truckEmail varchar(32) not null,
	truckFoodType varchar(50) not null,
	truckMenu varchar(255),
	truckVerifyImage varchar(255),
	truckVerifiedCheck varchar(255),
	truckHash char(97) not null,
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
