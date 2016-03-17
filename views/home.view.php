<a href="register.php">Register</a>
<a href="login.php">Login</a>
<a href="dashboard/users.php">Dashboard</a>
<br>
<?php 
require 'dbconfig.php';
require 'classes/Database.php';
if($currentUser){
	echo "Logged in as $currentUser->user_firstname $currentUser->user_lastname ($currentUser->user_role)<br>";
	echo '<a href="logout.php">Logout</a>';
} else {
	echo 'not logged in <br>';
}
?> 

<form method="get" action="">

<input type="text" placeholder="Apples" name="s" value="<?php if(isset($_GET["s"])) echo $_GET["s"]; ?>">
<input type="submit" value="Search">

</form>

<?php 
echo '<table>';
$db = new DatabaseConnection();
if(isset($_GET["s"]))
	$ingredients = $db->getIngredientsSearchString($_GET["s"]);
else
	$ingredients = $db->getAllIngredients();
echo '<tr>';
echo '<td>Ingredient ID</td>';
echo '<td>Ingredient Name</td>';
echo '<td>Protient (100g)</td>';
echo '<td>Sugar (100g)</td>';
echo '<td>Carbs (100g)</td>';
echo '<td>Fats (100g)</td>';
echo '</tr>';
foreach($ingredients as $ingredient){
	echo '<tr>';
	echo "<td>" . $ingredient['ingredient_id'] . "</td>";
	echo "<td>" . $ingredient['ingredient_name'] . "</td>";
	echo "<td>" . $ingredient['ingredient_protien'] . "</td>";
	echo "<td>" . $ingredient['ingredient_sugar'] . "</td>";
	echo "<td>" . $ingredient['ingredient_carbs'] . "</td>";
	echo "<td>" . $ingredient['ingredient_fat'] . "</td>";
	echo '</tr>';
}
echo '</table>';

?>
