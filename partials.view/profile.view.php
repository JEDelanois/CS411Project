<div id="profilePage" class="panel panel-default center-block" style="width: 80%">
  <div class="panel-body">
		<?php if (is_logged_in()):

        if(isset($_GET["user_id"]) && $currentUser["user_role"] == 'administrator'){
            $url = API_URL . "getUser.php?id=" . htmlentities($_GET["user_id"]);
            $content = file_get_contents($url);
            $_currentUser = json_decode($content, true)["results"];
        } else
            $_currentUser = $currentUser;

?>
			<h1>Hello, <?= $_currentUser["user_firstname"]; ?></h1><br>
			<form class="form-horizontal" method="post" action="../inc/editUserProcess.php">
			  <div class="form-group">
			    <label for="firstNameTextField" class="col-sm-2 control-label">First Name</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" name="firstNameTextField" id="firstNameTextField" placeholder="First Name"
			      value="<?= $_currentUser ? $_currentUser["user_firstname"] : '' ?>">
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="lastNameTextField" class="col-sm-2 control-label">Last Name</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" name="lastNameTextField" id="lastNameTextField" name="lastNameTextField" placeholder="Last Name"
			      value="<?= $_currentUser ? $_currentUser["user_lastname"] : ''?>">
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="emailTextField" class="col-sm-2 control-label">Email Address</label>
			    <div class="col-sm-10">
			      <input type="email" class="form-control" id="emailTextField" name="emailTextField" placeholder="Email"
			      value="<?= $_currentUser ? $_currentUser["user_email"] : '' ?>">
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="passwordTextField" class="col-sm-2 control-label">Password</label>
			    <div class="col-sm-10">
			      <input type="password" class="form-control" id="passwordTextField" name="passwordTextField" placeholder="">
			    </div>
			  </div>
			  <?php if ($_currentUser["user_role"] == "administrator"): ?>
			  <div class="form-group">
			    <label for="userRoleSelection" class="col-sm-2 control-label">User Role</label>
			    <div class="col-sm-10">
			      <select name="userRoleSelection" class="form-control">
						<option value="user" <?php if($_currentUser["user_role"] == "user") echo 'selected' ?>>User</option>
						<option value="administrator" <?php if($_currentUser["user_role"] == "administrator") echo 'selected' ?>>Administrator</option>
					</select>
			    </div>
			  </div>
			  <?php endif ?>
			  <div class="form-group">
			    <label for="dobTextField" class="col-sm-2 control-label">Date of Birth</label>
			    <div class="col-sm-10">
			    <?php
			    	if($_currentUser && $_currentUser["user_dob"]){
				    	$time = strtotime($_currentUser["user_dob"]);
						$dob = date("Y-d-m", $time);
					} else {
						$dob = "";
					}
			    ?>
			      <input type="date" class="form-control" id="dobTextField" name="dobTextField" placeholder=""
			      value="<?= $dob ?>">
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="weightTextField" class="col-sm-2 control-label">Weight</label>
			    <div class="col-sm-10">
				    <div class="input-group">
				      <input type="text" class="form-control" id="weightTextField" name="weightTextField" placeholder="Weight"
				      value="<?= $_currentUser ? $_currentUser["user_weight"] : '' ?>" aria-describedby="weightUnit">
				      <span class="input-group-addon" id="weightUnit">lbs</span>
				    </div>
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="targetWeightTextField" class="col-sm-2 control-label">Target Weight</label>
			    <div class="col-sm-10">
				    <div class="input-group">
				      <input type="text" class="form-control" id="targetWeightTextField" name="targetWeightTextField" placeholder="Target Weight"
				      value="<?= $_currentUser ? $_currentUser["user_targetweight"] : '' ?>" aria-describedby="weightUnit">
				      <span class="input-group-addon" id="weightUnit">lbs</span>
				    </div>
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="heightTextField" class="col-sm-2 control-label">Height</label>
			    <div class="col-sm-10 form-inline">
			    	<?php
			    		if($_currentUser && $_currentUser["user_height"]){
			    			$height_total = floatval($_currentUser["user_height"]);
							$height_ft = floor($height_total / 12);
							$height_in = ($height_total % 12);
			    		} else {
			    			$height_ft = "";
			    			$height_in = "";
			    		}
			    	?>
				    <div class="input-group">
				      <input type="text" class="form-control" id="heightTextField" name="heightTextFieldFT" placeholder=""
				      value="<?= $height_ft ?>" aria-describedby="heightUnitFt">
				      <span class="input-group-addon" id="heightUnitFt">ft</span>
				    </div>
				    <div class="input-group">
				      <input type="text" class="form-control" id="heightTextField" name="heightTextFieldIN" placeholder=""
				      value="<?= $height_in ?>" aria-describedby="heightUnitFt">
				      <span class="input-group-addon" id="heightUnitFt">in</span>
				    </div>
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="genderSelection" class="col-sm-2 control-label">Gender</label>
			    <div class="col-sm-10">
			      <select name="genderSelection" class="form-control">
						<option value="select" <?php if(!$_currentUser["user_gender"]) echo 'selected' ?>>Select:</option>
						<option value="male" <?= $_currentUser["user_gender"] == "male" ? 'selected' : "" ?> >Male</option>
						<option value="female" <?= $_currentUser["user_gender"] == "female" ? 'selected' : "" ?> >Female</option>
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
