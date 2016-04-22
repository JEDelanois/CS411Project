<?php require '../functions.php'; ?>
<div id="profilePage" class="panel panel-default center-block" style="width: 90%">
  <div class="panel-body">
		<?php if (is_logged_in()): ?>
			<h1 style="text-align: center">Nutrition Log</h1><br>
			<?php 
			$url = API_URL . "getNutritionLog.php?user_id=" . $currentUser['user_id'] . "&&";
			if(isset($_GET["date"]))
				$url .= "date=" . htmlentities($_GET["date"]) . "&&";
			if(isset($_GET["time_of_day"]))
				$url .= "time_of_day=" . htmlentities($_GET["time_of_day"]);
			$content = file_get_contents($url);
			$nutritionLog = json_decode($content, true)["results"];

			$currentDate = NULL;
			foreach($nutritionLog as $nl){
				if($currentDate == NULL || $currentDate != $nl["log_date"]): 
					if($currentDate != NULL){
						echo '</tbody>';
						echo '</table>';
					}
					$currentDate = $nl["log_date"]; ?>
					<h3><?= date("F j, Y, g:i a", strtotime($currentDate)) ?></h3>
					<table class="table">
					<thead>
					<tr>
					<th>Time of the Day</th>
					<th>Recipe</th>
					<th>Ingredient</th>
					<th>Ingredient Amount</th>
					<th>Calories</th>
					<th>Fat</th>
					<th>
					</tr>
					</thead>
					<tbody>
				<?php endif; ?>
				<tr>
					<td><?= isset($nl["log_time_of_the_day"]) ? $nl["log_time_of_the_day"] : "N/A" ?></td> 
					<td>
					<?php if(isset($nl["recipe_id"])): ?>
						<a href="<?= '../recipe/?id=' . $nl["recipe_id"]?>"><?= getRecipeNameFromAPI($nl["recipe_id"]) ?></a>
					<?php else: ?>
						N/A
					<?php endif; ?>
					</td>
					<td>
					<?php if(isset($nl["ingredient_id"])): ?>
						<a href="<?= '../ingredient/?id=' . $nl["ingredient_id"]?>"><?= getIngredientNameFromAPI($nl["ingredient_id"]) ?></a>
					<?php else: ?>
						N/A
					<?php endif; ?>
					</td>
					<td>
					<?php if(isset($nl["ingredient_amount"])): ?>
						<?= getIngredientNameFromAPI($nl["ingredient_amount"]) ?>
					<?php else: ?>
						N/A
					<?php endif; ?>
					</td>
				</tr>
			<?php } ?>

		<?php else: ?>
		<h2>You are not logged In</h2>
		<script type="text/javascript">
		    $("button#signInUpBtn").trigger("click");
		</script>
		<?php endif ?>
  </div>
</div>