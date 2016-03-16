
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
$arr=getUsersFromTable();

foreach($arr=>$i)
{
echo "<tr>";
echo "<td>.i->user_id</td>";
echo "<td>.i->user_role</td>";
echo "<td>.i->user_firstname</td>";
echo "<td>.i->user_lastname</td>";
echo "<td>.i->user_email</td>";
echo "<td>.i->user_dob</td>";
echo "<td>.i->user_last_logged_in</td>";
echo "</tr>";
}
?>
</tbody>
</table>







