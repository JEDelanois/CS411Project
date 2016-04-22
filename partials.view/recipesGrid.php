<?php
  if(isset($_GET["page"]))
    $page = htmlentities($_GET["page"]);
  else
    $page = 1;
  $elementsPerPage = 30;
	$content = file_get_contents(API_URL . "getRecipe.php?limit=$elementsPerPage&&page=$page", true);
 	$array = json_decode($content, true);
 	$numElements = $array["num_results"];
 	$array = $array["results"];
 	$numRows = $numElements / 3;
  $content = file_get_contents(API_URL . "getNumElements.php?table_name=Recipes");
  $totalNumberOfElements = json_decode($content, true);
  $totalNumberOfElements = intval($totalNumberOfElements["result"]);
  $totalPages = $totalNumberOfElements / $elementsPerPage;
 	$index = 0;
?>
<div id="recipeGrid" class="center-box" style="width: 90%; margin:auto;">
<?php for ($i=0; $i < $numRows; $i++): ?>
<div class="row">
	<?php for($j = 0; $j < 3; $j++):
		$currRecipe = $array[$index++];
		?>
  <div class="col-sm-6 col-md-4">
    <div class="thumbnail">
      <img src="<?= BASE_URL . $currRecipe["recipe_image"]; ?>" alt="<?php $currRecipe["recipe_name"]; ?>">
      <div class="caption">
        <a href="../recipe/index.php?id=<?= $currRecipe["recipe_id"]; ?>"><h3><?= $currRecipe["recipe_name"]; ?></h3></a>
        <table class="table">
          <thead>
            <tr>
              <th>Preparation Time</th>
              <th>Cook Time</th>
              <th>Ready In</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><?= getTimeString($currRecipe["recipe_prep_time"]); ?></td>
              <td><?= getTimeString($currRecipe["recipe_cook_time"]); ?></td>
              <td><?= getTimeString($currRecipe["recipe_ready_in_time"]); ?></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
<?php endfor; ?>
</div>
<?php endfor; ?>
<nav>
  <div class="text-center">
  <ul class="pagination">
    <?php if ($page == 1): ?>
      <li class="disabled">
    <?php else: ?>
      <li>
    <?php endif ?>
    <a href="?page=<?= $page - 1 ?>" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a>
    </li>
    <li class="active"><a href="#"><?= $page ?> <span class="sr-only">(current)</span></a></li>
    <?php for ($i = $page + 1; $i < min($page + 5, $totalPages); $i++): ?>
    <li><a href="?page=<?= $i ?>"><?= $i ?></a></li>
    <?php endfor; ?>
  </ul>
  </div>
</nav>
</div>
