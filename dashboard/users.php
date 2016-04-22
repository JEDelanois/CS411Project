<?php
// require '../user_session.php';
require '../partials.view/header.view.php';
if(!$currentUser || $currentUser["user_role"] != "administrator")
    header("Location: ../404.php");
?>
<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css">
<div id="dashboard">
<table class="table">
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
        <form method='get' action="../profile/">
        <input hidden="true" value="<?= $i->user_id ?>" name="user_id">
			<input type='submit' class="btn btn-default" value='Edit'>
		</form>
	</td>
	<td>
		<form method='get' action='inc/deleteUserProcess.php'>
			<input hidden="true" value="<?php echo $i->user_id; ?>" name="user_id">
			<input type='submit' value='Delete' class="btn btn-default">
		</form>
	</td>
</tr>
<?php } ?>
</tbody>
</table>

</div>











