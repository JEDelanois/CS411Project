<?php 
require '../dbconfig.php';
require '../classes/Database.php';
$db = new DatabaseConnection();
$user = $db->getUserFromID($_GET["user_id"]);
?>
<div id="userRegistrationForm">
	<form method="POST" action="forms/editUserProcess.php">
		<input hidden="true" name="user_id" value="<?php echo $user->user_id; ?>">
		<ul class='form-style-1'>
			<li>
				<label>Full Name: </label>
				<input type="text" name="user_firstName" class="field-divided" placeholder="First" 
					value="<?php echo $user->user_firstname; ?>"/>&nbsp;
					<input type="text" name="user_lastName" class="field-divided" placeholder="Last" 
					value="<?php echo $user->user_lastname; ?>"/>
			</li>
			<li>
			        <label>Email: </label>
			        <input type="email" name="user_email" class="field-long" 
			        value="<?php echo $user->user_email; ?>"/>
			</li>
			<li>
			        <label>Password: </label>
			        <input type="password" name="user_password" class="field-long" />
			</li>
			<li>
					<label>User Role: </label>
					<select name="user_role">
						<option value="user" <?php if($user->user_role == "user") echo 'selected' ?>>User</option>
						<option value="administrator" <?php if($user->user_role == "administrator") echo 'selected' ?>>Administrator</option>
					</select>
			</li>
			<br><br>
			<input type="submit" value="Edit">
		</ul>
	</form>
</div>