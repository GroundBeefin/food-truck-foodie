<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">

	<title>Conceptual Modle of DDL</title>
</head>


<body>

<h1>Conceptual Model</h1>

<h2>Entities & Attributes</h2>

<h3>User</h3>

<ul>
	<li>userId</li>
	<li>userActivationToken</li>
	<li>userAvatarUrl</li>
	<li>userEmail</li>
	<li>userHash</li>
	<li>UserName</li>
</ul>

 <h3>Truck</h3>

	<ul>
		<li>truckId</li>
		<li>truckUserId</li>
		<li>truckAvatarUrl</li>
		<li>truckFoodType</li>
		<li>truckMenu</li>
		<li>truckName</li>
	</ul>

	<ul>

		<li>postId</li>
		<li>postTruckId</li>
		<li>postContent</li>
		<li>postDatetime</li>

	</ul>

<h3>Comment</h3>
<ul>

	<li>commentId(primary key)</li>
	<li>commentUserId(foreign key)</li>
	<li>commentContent</li>
	<li>commentDateTime</li>
</ul>

<h3>Relations</h3>

	<p>One <b>User</b> can have many<b>Trucks</b>. (1 - n)<br>
	One <b>Truck</b> can make one <b>User</b>. (1 - 1)<br>
	One <b>Truck</b> can make many <b>Posts</b>. (1 - n)<br>
	One <b>User</b> can make many <b>Comments</b>.(1 - n)
	</p>
</body>
</html>

