<form class="form-horizontal" id="loginForm" method="post" action="../inc/loginUserProcess.php">
  <div class="form-group">
    <label for="loginFormEmailTextField" class="col-sm-2 control-label">Email</label>
    <div class="col-sm-10">
      <input type="email" class="form-control" id="loginFormEmailTextField" name="loginFormEmailTextField" placeholder="Email">
    </div>
  </div>
  <div class="form-group">
    <label for="PasswordTextField" class="col-sm-2 control-label">Password</label>
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
      <div class="checkbox">
        <label>
          <input type="checkbox"> Remember me
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">Sign in</button>
    </div>
  </div>
</form>
