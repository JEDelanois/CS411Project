<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">WHAT TO EAT</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <?php
          $currFolderName = getDirectoryFromURL($_SERVER["REQUEST_URI"]);
        ?>
        <li class="<?php if($currFolderName == "recipes") echo 'active'; ?>"><a href="../recipes">Recipes <span class="sr-only">(current)</span></a></li>
        <li class="<?php if($currFolderName == "ingredients") echo 'active'; ?>"><a href="../ingredients">Ingredients</a></li>
        <!--<li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Separated link</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">One more separated link</a></li>
          </ul>
        </li>-->
      </ul>
      <form class="navbar-form navbar-left" role="search" method="get" action="">
    <div class="input-group">
    <input type="text" class="form-control" aria-label="..." name="s" value="<?= isset($_GET["s"]) ? htmlentities($_GET["s"]) : ''?>">
      <div class="input-group-btn">
        <button type="button" id="searchTypeBtn" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Recipes <span class="caret"></span></button>
        <ul id="searchTypeDropdown" class="dropdown-menu dropdown-menu-right">
          <li><a href="#" onClick="changeSearchType('recipes')">Recipes</a></li>
          <li><a href="#" onClick="changeSearchType('ingredients')">Ingredients</a></li>
        </ul>
      </div><!-- /btn-group -->
    </div><!-- /input-group -->
        <!--<button type="submit" class="btn btn-default" hidden="true"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>-->
<input type="text" hidden="true" value="recipes"  name="searchType" id="searchSubmit">
<input type="submit" hidden="true">
      </form>
      <ul class="nav navbar-nav navbar-right">
        <?php if(is_logged_in()): ?>
        <?php if(is_admin()): ?>
        <a href="../dashboard/index.php">
            <button type="button" class="btn btn-default navbar-btn" data-toggle="modal" data-target="dashboardBtn" id="dashboardBtn">Dashboard</button>
        </a>
        <?php endif; ?>


<?php

          require '../dbconfig.php';
          require '../classes/Database.php';

$date = new DateTime('now', new \DateTimeZone( 'UTC'));
$randomRecipe = suggest_rec_by_macros($currentUser["user_id"], $date);

?>
    <a href="../recipe/?id=<?= $randomRecipe?>">
            <button type="button" class="btn btn-primary navbar-btn" data-toggle="modal" data-target="nutritionLog" id="profileBtn">What Should I Eat ?</button>
        </a>

        <a href="../nutritionLog">
            <button type="button" class="btn btn-default navbar-btn" data-toggle="modal" data-target="nutritionLog" id="profileBtn">View Nutrition Log</button>
        </a>
        <a href="../profile">
            <button type="button" class="btn btn-default navbar-btn" data-toggle="modal" data-target="profileBtn" id="profileBtn">Profile</button>
        </a>
        <a href="../logout.php">
            <button type="button" class="btn btn-default navbar-btn" data-toggle="modal" data-target="logoutBtn" id="logoutBtn">Logout</button>
        </a>
        <?php else: ?>
        <button type="button" class="btn btn-primary navbar-btn" data-toggle="modal" data-target="#signInUp" id="signInUpBtn">Sign in / Sign Up</button>
        <?php endif; ?>
        <!-- <li><a href="#">Link</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Separated link</a></li>
          </ul>
        </li> -->
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<?php require '../partials.view/SignInUpPopup.view.php';
if(isset($_GET["login_registration_error"]) && intval($_GET["login_registration_error"]) > 0): ?>

    <script type="text/javascript">
        $("button#signInUpBtn").trigger("click");
    </script>

<?php endif; ?>


    <script type="text/javascript">

    var currentSearchType = '<?= htmlentities($_GET["searchType"]) ?>';

    function changeSearchType(newValue){
        $("input#searchSubmit").prop('value', newValue);
        if(newValue == "recipes")
            $("button#searchTypeBtn").text("Recipes");
        else if(newValue = "ingredients")
            $("button#searchTypeBtn").text("Ingredients");
    }

    if(currentSearchType == "ingredients")
        changeSearchType("ingredients");

    </script>


