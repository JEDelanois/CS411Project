<div id="userRegistrationForm">
	<form method="POST" action="inc/registerUserProcess.php">
		<ul class='form-style-1'>
			<li>
				<label>Full Name <span class="required">*</span></label>
				<input type="text" name="user_firstName" class="field-divided" placeholder="First" />&nbsp;<input type="text" name="user_lastName" class="field-divided" placeholder="Last" />
			</li>
			<li>
			        <label>Email <span class="required">*</span></label>
			        <input type="email" name="user_email" class="field-long" />
			</li>
			<li>
			        <label>Password <span class="required">*</span></label>
			        <input type="password" name="user_password" class="field-long" />
			</li>
			<br><br>
			<input type="submit" value="Register">
		</ul>
	</form>
</div>