<!-- Modal -->
<div id="signInUp" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Sign In / Sign Up</h4>
      </div>
      <div class="modal-body">

        <?php

            // check for errors
if(isset($_GET["login_registration_error"]) && intval($_GET["login_registration_error"]) > 0){
    $numErrors = intval(htmlentities($_GET["login_registration_error"]));
    echo '<div class="alert alert-danger" role="alert">';
    for($i = 1; $i <= $numErrors; $i++){
        echo "<p>" . htmlentities($_GET["login_registration_error_$i"]) . "</p>";
    }
    echo '</div>';

}

        ?>


        <h4>Sign In</h4>
        <?php require '../forms.view/login.form.php'; ?>
        <hr>
        <h4>Sign Up</h4>
        <?php require '../forms.view/register.form.php'; ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
