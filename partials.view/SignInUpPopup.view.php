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