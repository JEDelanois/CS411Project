<form class="form-horizontal" id="registrationForm" method="post" action="../inc/registerUserProcess.php">
	<div class="form-group">
	    <label for="firstNameTextField" class="col-sm-2 control-label">First Name: </label>
	        <div class="col-sm-10">
	    <input type="text" class="form-control" id="firstNameTextField" name="registrationFormFirstNameTextField" placeholder="Jane">
	    </div>
	</div>
	<div class="form-group">
	    <label for="lastNameTextField" class="col-sm-2 control-label">Last Name: </label>
	    <div class="col-sm-10">
	    	<input type="text" class="form-control" id="lastNameTextField" name="registrationFormLastNameTextField" placeholder="Doe">
		</div>
	</div>
	<div class="form-group">
	    <label for="registrationFormEmailTextField" class="col-sm-2 control-label">Email</label>
	    <div class="col-sm-10">
	     	<input type="email" class="form-control" name="registrationFormEmailTextField" id="registrationFormEmailTextField" placeholder="Email">
	    </div>
  	</div>
  <div class="form-group">
    <label for="passwordTextField" class="col-sm-2 control-label">Password</label>
    <div class="col-lg-6">
        <div class="input-group">
          <input type="password" class="form-control" aria-label="password" name="passwordTextField" id="passwordTextField">
          <span class="input-group-addon">
            <input type="checkbox" aria-label="show-password" name="showPasswordCheckbox" id="showPasswordCheckbox">
            Show Password
          </span>
        </div><!-- /input-group -->
    </div>
  </div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
	  		<button type="submit" class="btn btn-default">Sign Up</button>
		</div>
	</div>
</form>
