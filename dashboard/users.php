<?php 
require '../dbconfig.php';
require '../classes/Database.php'; ?>
<div id="dashboard">
<table id="hor-minimalist-a">
<tbody>
<tr>
<td>ID</td>
<td>Role</td>
<td>First Name</td>
<td>Last Name</td>
<td>Email</td>
<td>DOB</td>
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
echo "<tr>";
echo "<td>$i->user_id</td>";
echo "<td>$i->user_role</td>";
echo "<td>$i->user_firstname</td>";
echo "<td>$i->user_lastname</td>";
echo "<td>$i->user_email</td>";
echo "<td>$i->user_dob</td>";
echo "<td>$i->user_last_logged_in</td>";


echo"<form method='post' action='forms/editUser.form.php'>";


echo"<input type='submit' value='Edit' name='editBtn$i->user_id'>";


echo "</form>";



echo"<form method='post' action=''>";

echo"<input type='submit' value='Delete' name='deleteBtn$i->user_id'>";
echo"</form>";
echo"</tr>";
}

?>
</tbody>
</table>

</div>











