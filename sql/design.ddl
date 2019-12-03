drop table if exists post;
drop table if exists truck;
drop table if exists user;


create table user(
	userId binary(16) not null,
	userActivationToken char(32),
	userAvatarUrl varchar(255),
	userEmail varchar(128) not null,
	userHash char(97) not null,
	userName varchar(16)not null,
	unique (userEmail),
	index (userId),
	primary key(userId)
);

create table truck(
	truckId binary(16) not null,
	truckUserId binary (16) not null,
	truckAvatarUrl varchar(255),
	truckEmail varchar(128) not null,
	truckFoodType varchar(50) not null,
	truckMenuUrl varchar(255),
	truckName varchar(144),
	truckPhoneNumber varchar (32),
	truckVerifyImage varchar(255),
	index (truckUserId),
	foreign key (truckUserId) references user(userId),
	primary key (truckId)
);


create table post(
	postId binary(16) not null,
	postTruckId binary(16),
	postUserId binary(16),
	postContent varchar(144) null,
	postDatetime datetime(6) not null,
	index (postTruckId),
	index (postUserId),
	foreign key(postTruckId) references truck(truckId),
	foreign key(postUserId) references user(userId),
	primary key (postId)
);
