
<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css">
<?php 
require '../user_session.php';
if(!$currentUser || $currentUser->user_role != "administrator")
	header("Location: ../404.php");
require '../dbconfig.php';
require '../classes/Database.php'; ?>
<div id="dashboard">
<table class="pure-table">
<tbody>
<tr>
<td>ID</td>
<td>Role</td>
<td>First Name</td>
<td>Last Name</td>
<td>Email</td>
<!-- <td>DOB</td> -->
<td>Last Login</td>
</tr>


<?php

// if(isset($_GET["user"]))
// 	echo $_GET["user"];
// else
// 	echo 'not found';

$db = new DatabaseConnection();
$arr = $db->getUsersFromTable();

// echo '<pre>';
// print_r($arr);
// echo '</pre>';

foreach($arr as $i)
{
echo "<tr class='pure-table-odd'>";
echo "<td>$i->user_id</td>";
echo "<td>$i->user_role</td>";
echo "<td>$i->user_firstname</td>";
echo "<td>$i->user_lastname</td>";
echo "<td>$i->user_email</td>";
// echo "<td>$i->user_dob</td>";
echo "<td>$i->user_last_logged_in</td>";
?>
	<td>
		<form method='get' action='forms/editUser.form.php'>
			<input hidden="true" value="<?php echo $i->user_id; ?>" name="user_id">
			<input type='submit' value='Edit'>
		</form>
	</td>
	<td>
		<form method='get' action='inc/deleteUserProcess.php'>
			<input hidden="true" value="<?php echo $i->user_id; ?>" name="user_id">
			<input type='submit' value='Delete'>
		</form>
	</td>
</tr>
<?php } ?>
</tbody>
</table>

</div>











