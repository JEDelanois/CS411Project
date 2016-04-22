<?php 
if(!isset($_GET["id"])){
	header("Location: ../404.php");
}
$recipe_id = htmlentities($_GET["id"]);
$content = file_get_contents(API_URL . "getRecipe.php?recipe_id=$recipe_id", true);
$array = json_decode($content, true);

if($array["num_results"] == 0): ?>
	<div class="panel panel-default">
		<div class="panel-body">
			<h1 class="center">404 Page Not Found</h1>
		</div>
	</div>
<?php else:
$currRecipe = $array["results"][0];
?>
<div class="panel panel-default center-block"  style="width: 90%;">
  <div class="panel-body">
  	<div class="text-center">
	    <div class="page-header">
			<h1><?= $currRecipe["recipe_name"]; ?></h1>
		</div>
		<img src="<?= BASE_URL . $currRecipe["recipe_image"]; ?>" alt="<?= $currRecipe["recipe_name"] ?>" >
	</div>	
	<hr>
	<div class="row"> 
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Ingredients</h3>
				</div>
				<ul class="list-group">
				  <?php foreach ($currRecipe["ingredients"] as $ingr): ?>
				  	<li class="list-group-item"><?= $ingr[0]; ?></li>
				  <?php endforeach ?>
				</ul>
			</div>
		</div>
		<div class="col-md-6">
			<div class="well well-lg">
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
		              <td>
		              	<span class="glyphicon glyphicon-time" aria-hidden="true"></span>
		                     <?= getTimeString($currRecipe["recipe_prep_time"]); ?>
		              </td>
		              <td>
		              	<span class="glyphicon glyphicon-time" aria-hidden="true"></span>
		                     <?= getTimeString($currRecipe["recipe_cook_time"]); ?></td>
		              <td>
		              <span class="glyphicon glyphicon-time" aria-hidden="true"></span>     
		                   <?= getTimeString($currRecipe["recipe_ready_in_time"]); ?></td>
		            </tr>
		          </tbody>
		        </table>
		        <hr> 
		        <div class="row">
			        <div class="col-md-6">
			        	<span class="glyphicon glyphicon-equalizer"></span>
			        	<label>Calories: </label> <?= $currRecipe["recipe_calories"]; ?>  kcal
			        </div>
		        	<div class="col-md-6">
			        	<span class="glyphicon glyphicon-equalizer"></span>
		        		<label>Fat: </label> <?= $currRecipe["recipe_fat"]; ?> g
		        	</div>
		        </div>
		        <div class="row">
			        <div class="col-md-6">
			        	<span class="glyphicon glyphicon-equalizer"></span>
				        <label>Carbs: </label> <?= $currRecipe["recipe_carbs"]; ?> g
			        </div>
			        <div class="col-md-6">
			        	<span class="glyphicon glyphicon-equalizer"></span>
		        		<label>Protein: </label> <?= $currRecipe["recipe_protein"]; ?> g
	        		</div>
        		</div>
        		<div class="row"> 
	        		<div class="col-md-6">
			        	<span class="glyphicon glyphicon-equalizer"></span>
		        		<label>Cholesterol: </label> <?= $currRecipe["recipe_cholesterol"]; ?> mg
	        		</div>
	        		<div class="col-md-6"> 
			        	<span class="glyphicon glyphicon-equalizer"></span>
				        <label>Sodium: </label> <?= $currRecipe["recipe_sodium"]; ?> mg
			        </div>
		        </div>
		        <?php if (is_logged_in()): ?>
		       <hr>
  				<td>
  					<a onClick="addToNutritionLog(<?= $currentUser["user_id"] ?>, <?= $recipe_id ?>)" >
  						<button class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span>   Add to Nutrition Log</button>
  					</a>
  				</td>
			<?php endif ?>
		    </div>
		    <div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Directions</h3>
				</div>
				<table class="table">
		          <tbody>
		          <?php foreach($currRecipe["directions"] as $key => $value): ?>
		            <tr> 
		              <td><?= $key ?></td>
		              <td><?= $value ?></td>
		            </tr>         	
		          <?php endforeach ?>
		          </tbody>
		        </table>
			</div>
		</div>
	</div>
	</div>
</div>
<?php endif; ?>

<script type="text/javascript">
	function addToNutritionLog(user_id, recipe_id){
		var APIURL = '<?= API_URL ?>';
		var utc = new Date().toJSON().slice(0,10);
		var url = APIURL + "addNutritionLog.php?user_id=" + user_id + "&&recipe_id=" + recipe_id + "&&date=" + utc;
		jQuery.get(url, function(){
			alert('Recipe is added to the log');
		});
	}
</script>