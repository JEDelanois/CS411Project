<?php require '../classes/Database.php';?>
<div id="dashboard">
<table>
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
// echo "<a href="abujaba2web.engr.illinois.edu/cs411project/forms/editUser.form.php">edit</a>";
echo "<button type='button'>Delete</button>";
echo "</tr>";
}
?>
</tbody>
</table>


