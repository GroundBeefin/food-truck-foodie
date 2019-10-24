<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">

	<title>Conceptual Modle of DDL</title>
</head>


<body>

<h1>Conceptual Model</h1>

<h2>Entities & Attributes</h2>

<h3>Food Truck Profile</h3>

<ul>
	<li>foodTruckProfileId</li>
	<li> foodTruckProfileActivationToken</li>
	<li>foodTruckProfileAvatarUrl</li>
	<li> foodTruckProfileEmail</li>
	<li> foodTruckProfileFoodType</li>
	<li>foodTruckProfileHash</li>
	<li>foodTruckProfileUserName</li>
</ul>

<h3>Post</h3>

<ul>

	<li>postId</li>
	<li>postContent</li>
	<li>postDatetime</li>

</ul>
<h3>Profile</h3>

<ul>

	<li>userProfileId</li>
	<li>userProfileActivationToken</li>
	<li>userProfileAvatarUrl</li>
	<li>userProfileEmail</li>
	<li>userProfileHash</li>
	<li>userProfileUsername</li>

</ul>

<h3>Comment</h3>
<ul>

	<li> commentId(primary key)</li>
	<li>commentUserProfileId(foreign key)</li>
	<li>commentFoodTruckProfileId</li>
	<li>commentDateTime</li>
</ul>

<h3>Relations</h3>

<p>One <b>fooTruckProfile</b> can  make many<b>posts</b>. (1 - n)<br>
	One <b>userProfile</b> can make many <b>comments</b>. (1 - n)<br>
	One <b>fooTruckProfile</b> can make many <b>comments</b>. (1 - n)</p>

</body>
</html>

