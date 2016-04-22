<?php
  if(isset($_GET["page"]))
    $page = htmlentities($_GET["page"]);
  else
    $page = 1;
  	$elementsPerPage = 50;
	$content = file_get_contents(API_URL . "ingredients.php?limit=$elementsPerPage&&page=$page", true);
 	$array = json_decode($content, true);
 	$numElements = $array["num_results"];
 	$array = $array["results"];
	$content = file_get_contents(API_URL . "getNumElements.php?table_name=Ingredients");
	$totalNumberOfElements = json_decode($content, true);
	$totalNumberOfElements = intval($totalNumberOfElements["result"]);
	$totalPages = $totalNumberOfElements / $elementsPerPage;
?>


<div class="panel panel-default center-block" id="ingredientsGrid" style="width: 80%">
  <div class="panel-body">
  	<h1 style="text-align: center">Ingredients</h1><br>
  	<table class="table">
  	<thead> 
  	<th>Name</th>
  	<th>Serving Size</th>
  	<th>Protein</th>
  	<th>Sugar</th>
  	<th>Carbs</th>
  	<th>Fat</th>
  	<?php if (is_logged_in()): ?>
  	<th>Add to Log</th>
  <?php endif; ?>
  	</thead>
  	<tbody>
  		<?php foreach ($array as $ing): ?>
  			<tr> 
  				<td><?= $ing["ingredient_name"]; ?></td>
  				<td><?= $ing['ingredient_serving_size'] ?></td>
  				<td><?= $ing["ingredient_protien"] ?></td>
  				<td><?= $ing["ingredient_sugar"] ?></td>
  				<td><?= $ing["ingredient_carbs"] ?></td>
  				<td><?= $ing["ingredient_fat"] ?></td>

  				<?php if (is_logged_in()): ?>
  				<td class="text-center">
  					<a onClick="addToNutritionLog(<?= $currentUser["user_id"] ?>, <?= $ing['ingredient_id'] ?>)" >
  						<span class="glyphicon glyphicon-plus"></span>
  					</a>
  				</td>
  				<?php endif ?>
  			</tr>
  		<?php endforeach; ?>
  	</tbody>
  	</table>
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
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript">
	function addToNutritionLog(user_id, ingredient_id){
		var APIURL = '<?= API_URL ?>';
		var utc = new Date().toJSON().slice(0,10);
		var url = APIURL + "addNutritionLog.php?user_id" + user_id + "&&ingredient_id=" + ingredient_id + "&&date=" + utc;
		jQuery.get(url, function(){
			$.alert('Ingredient added to the log');
		});
	}

</script>