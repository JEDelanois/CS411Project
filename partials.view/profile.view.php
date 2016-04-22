<div id="profilePage" class="panel panel-default center-block" style="width: 80%">
  <div class="panel-body">
		<?php if (is_logged_in()): ?>
			<h1>Hello, <?= $currentUser["user_firstname"]; ?></h1>
			<form class="form-horizontal">
			  <div class="form-group">
			    <label for="firstNameTextField" class="col-sm-2 control-label">First Name</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="firstNameTextField" placeholder="First Name"
			      value="<?= $currentUser ? $currentUser["user_firstname"] : '' ?>">
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="lastNameTextField" class="col-sm-2 control-label">Last Name</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="lastNameTextField" placeholder="Last Name"
			      value="<?= $currentUser ? $currentUser["user_lastname"] : ''?>">
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="emailTextField" class="col-sm-2 control-label">Email Address</label>
			    <div class="col-sm-10">
			      <input type="email" class="form-control" id="emailTextField" placeholder="Email"
			      value="<?= $currentUser ? $currentUser["user_email"] : '' ?>">
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="passwordTextField" class="col-sm-2 control-label">Password</label>
			    <div class="col-sm-10">
			      <input type="password" class="form-control" id="passwordTextField" placeholder="">
			    </div>
			  </div>
			  <?php if ($currentUser["user_role"] == "administrator"): ?>
			  <div class="form-group">
			    <label for="userRoleSelection" class="col-sm-2 control-label">User Role</label>
			    <div class="col-sm-10">
			      <select name="userRoleSelection" class="form-control">
						<option value="user" <?php if($currentUser["user_role"] == "user") echo 'selected' ?>>User</option>
						<option value="administrator" <?php if($currentUser["user_role"] == "administrator") echo 'selected' ?>>Administrator</option>
					</select>
			    </div>
			  </div>	  	
			  <?php endif ?>
			  <div class="form-group">
			    <label for="dobTextField" class="col-sm-2 control-label">Date of Birth</label>
			    <div class="col-sm-10">
			    <?php 
			    	if($currentUser && $currentUser["user_dob"]){
				    	$time = strtotime($currentUser["user_dob"]);
						$dob = date("Y-d-m", $time);
					} else {
						$dob = "";
					}
			    ?>
			      <input type="date" class="form-control" id="dobTextField" placeholder=""
			      value="<?= $dob ?>">
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="weightTextField" class="col-sm-2 control-label">Weight</label>
			    <div class="col-sm-10">
				    <div class="input-group">
				      <input type="text" class="form-control" id="weightTextField" placeholder="Weight" 
				      value="<?= $currentUser ? $currentUser["user_weight"] : '' ?>" aria-describedby="weightUnit">
				      <span class="input-group-addon" id="weightUnit">lbs</span>
				    </div>
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="targetWeightTextField" class="col-sm-2 control-label">Target Weight</label>
			    <div class="col-sm-10">
				    <div class="input-group">
				      <input type="text" class="form-control" id="targetWeightTextField" placeholder="Target Weight" 
				      value="<?= $currentUser ? $currentUser["user_targetweight"] : '' ?>" aria-describedby="weightUnit">
				      <span class="input-group-addon" id="weightUnit">lbs</span>
				    </div>
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="heightTextField" class="col-sm-2 control-label">Height</label>
			    <div class="col-sm-10 form-inline">
			    	<?php 
			    		if($currentUser && $currentUser["user_height"]){
			    			$height_total = floatval($currentUser["user_height"]);
							$height_ft = floor($height_total / 12);
							$height_in = ($height_total % 12);
			    		} else {
			    			$height_ft = "";
			    			$height_in = "";
			    		}
			    	?>
				    <div class="input-group">
				      <input type="text" class="form-control" id="heightTextField" placeholder="" 
				      value="<?= $height_ft ?>" aria-describedby="heightUnitFt">
				      <span class="input-group-addon" id="heightUnitFt">ft</span>
				    </div>
				    <div class="input-group">
				      <input type="text" class="form-control" id="heightTextField" placeholder="" 
				      value="<?= $height_in ?>" aria-describedby="heightUnitFt">
				      <span class="input-group-addon" id="heightUnitFt">in</span>
				    </div>
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="genderSelection" class="col-sm-2 control-label">Gender</label>
			    <div class="col-sm-10">
			      <select name="genderSelection" class="form-control">
						<option value="select" <?php if(!$currentUser["user_gender"]) echo 'selected' ?>>Select:</option>
						<option value="male" <?= $currentUser["user_gender"] == "male" ? 'selected' : "" ?> >Male</option>
						<option value="female" <?= $currentUser["user_gender"] == "female" ? 'selected' : "" ?> >Female</option>
					</select>
			    </div>
			  </div>
			  <div class="form-group">
			    <div class="col-sm-offset-2 col-sm-10">
			      <button type="submit" class="btn btn-default">Update</button>
			    </div>
			  </div>
			</form>
		<?php else: ?>
		<h2>You are not logged In</h2>
		<script type="text/javascript">
		    $("button#signInUpBtn").trigger("click");
		</script>
		<?php endif ?>
  </div>
</div>