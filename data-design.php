<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">

	<title>Conceptual Modle of DDL</title>
</head>


<body>

<h1>Conceptual Model</h1>

<h2>Entities & Attributes</h2>


<ul>

	<h3>User</h3>

	<li>userId(primary key)</li>
	<li>userActivationToken</li>
	<li>userAvatarUrl</li>
	<li>userEmail</li>
	<li>userHash</li>
	<li>userName</li>
</ul>

	<ul>

		<h3>Truck</h3>

		<li>truckId(primary Key)</li>
		<li>truckUserId(foreign key)</li>
		<li>truckAvatarUrl</li>
		<li>trckEmail</li>
		<li>truckFoodType</li>
		<li>truckMenu</li>
		<li>truckName</li>
		<li>truckPhoneNumber</li>
		<li>truckVerifyImage</li>
		<li>truckVerifyCheck</li>
	</ul>



	<ul>

		<h3>Post</h3>

		<li>postId(primary key)</li>
		<li>postTruckId(foreign key)</li>
		<li>postContent</li>
		<li>postDatetime</li>

	</ul>


		<h3>Relations</h3>

	<p>One <b>User</b> can have many<b>Trucks</b>. (1 - n)<br>
	One <b>Truck</b> can have one <b>User</b>. (1 - 1)<br>
	One <b>Truck</b> can make many <b>Posts</b>. (1 - n)<br>

	</p>
</body>
</html>

