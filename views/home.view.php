<a href="register.php">Register</a>
<a href="login.php">Login</a>
<a href="dashboard/users.php">Dashboard</a>
<br>
<?php 
if($currentUser){
	echo "Logged in as $currentUser->user_firstname $currentUser->user_lastname ($currentUser->user_role)<br>";
	echo '<a href="logout.php">Logout</a>';
} else {
	echo 'not logged in <br>';
}
?>
