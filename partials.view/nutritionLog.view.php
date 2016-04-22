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
			$totalCalories = 0; $totalFat = 0; $totalCarbs = 0; $totalProtein = 0; $totalChol = 0;
			$totalSodium = 0; $totalSugar = 0;
            if(count($nutritionLog) > 0):
			foreach($nutritionLog as $nl){
				if($currentDate == NULL || $currentDate != $nl["log_date"]):
					if($currentDate != NULL): ?>
						<tr>
                            <th>Total</th>
                            <th></th>
                            <th><?= $totalCalories ?></th>
                            <th><?= $totalFat ?></th>
                            <th><?= $totalCarbs ?></th>
                            <th><?= $totalProtein ?></th>
                            <th><?= $totalChol ?></th>
                            <th><?= $totalSodium ?></th>
                            <th><?= $totalSugar ?></th>
						</tr>
						</tbody>
						</table>
					<?php endif;
					$currentDate = $nl["log_date"]; ?>
					<h3><?= date("F j, Y", strtotime($currentDate)) ?></h3>
					<table class="table">
					<thead>
					<tr>
					<!-- <th>Time of the Day</th> -->
					<th>Recipe</th>
					<th>Ingredient</th>
					<!-- <th>Ingredient Amount</th> -->
					<th>Calories (kcal)</th>
					<th>Fat (g)</th>
					<th>Carbs (g)</th>
					<th>Protein (g)</th>
					<th>Cholesterol (mg)</th>
					<th>Sodium (mg)</th>
					<th>Sugar (g)</th>
					</tr>
					</thead>
					<tbody>
				<?php endif; ?>
				<tr>
					<?php /*<td><?= isset($nl["log_time_of_the_day"]) ? $nl["log_time_of_the_day"] : "N/A" ?></td> */ ?>
					<td>
					<?php if(isset($nl["recipe_id"])):
						$recipe = getRecipeFromAPI($nl["recipe_id"]);
						?>
						<a href="<?= '../recipe/?id=' . $nl["recipe_id"]?>"><?= $recipe["recipe_name"] ?></a>
                        <?php else:
                            echo 'N/A'; ?>
					<?php endif; ?>
					</td>
					<td>
					<?php if(isset($nl["ingredient_id"])):
						$ingredient = getIngredientFromAPI($nl["ingredient_id"]);
						echo $ingredient["ingredient_name"];
                    else:
                        echo 'N/A';
					endif; ?>
					</td>
					<?php /*<td>
					<?php if(isset($nl["ingredient_amount"])): ?>
						<?= $ingredient["ingredient_amount"] ?>
					<?php else: ?>
						N/A
					<?php endif; ?>
					</td>*/ ?>
					<td>
					<?php if(isset($recipe)){
						echo $recipe["recipe_calories"];
						$totalCalories += floatval($recipe["recipe_calories"]);
					} else
						echo 'N/A';
					?>
					</td>
					<td>
					<?php if(isset($recipe)){
						echo $recipe["recipe_fat"];
						$totalFat += floatval($recipe["recipe_fat"]);
					} else if(isset($ingredient)){
						echo $ingredient["ingredient_fat"];
						$totalFat += floatval($ingredient["ingredient_fat"]);
					} else
						echo 'N/A';
					?>
					</td>
					<td>
					<?php if(isset($recipe)){
						echo $recipe["recipe_carbs"];
						$totalCarbs += floatval($recipe["recipe_carbs"]);
					} else if(isset($ingredient)){
						echo $ingredient["ingredient_carbs"];
						$totalCarbs += floatval($ingredient["ingredient_carbs"]);
					} else
						echo 'N/A';
					?>
					</td>
					<td>
					<?php if(isset($recipe)){
						echo $recipe["recipe_protein"];
						$totalProtein += floatval($recipe["recipe_protein"]);
					} else if(isset($ingredient)){
						echo $ingredient["ingredient_protien"];
						$totalProtein += floatval($ingredient["ingredient_protien"]);
					} else
						echo 'N/A';
					?>
					</td>
					<td>
					<?php if(isset($recipe)){
						echo $recipe["recipe_cholesterol"];
						$totalChol += floatval($recipe["recipe_cholesterol"]);
					} else
						echo 'N/A';
					?>
					</td>
					<td>
					<?php if(isset($recipe)){
						echo $recipe["recipe_sodium"];
						$totalSodium += floatval($recipe["recipe_sodium"]);
					} else
						echo 'N/A';
					?>
					</td>
					<td>
					<?php
					if(isset($ingredient)){
						echo $ingredient["ingredient_sugar"];
						$totalSugar += floatval($ingredient["ingredient_sugar"]);
					} else
						echo 'N/A';
					?>
					</td>
				</tr>
			<?php } ?>
			<tr>
			<th>Total</th>
			<th></th>
			<th><?= $totalCalories ?></th>
			<th><?= $totalFat ?></th>
			<th><?= $totalCarbs ?></th>
			<th><?= $totalProtein ?></th>
			<th><?= $totalChol ?></th>
			<th><?= $totalSodium ?></th>
			<th><?= $totalSugar ?></th>
			<th>
			</tr>
			</tbody>
			</table>
        <?php else: // if the count is zero ?>
                <h2> Your log is empty </h2>
        <?php endif; ?>
		<?php else: ?>
		<h2>You are not logged In</h2>
		<script type="text/javascript">
		    $("button#signInUpBtn").trigger("click");
		</script>
		<?php endif ?>
  </div>
</div>
