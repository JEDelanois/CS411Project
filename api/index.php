<h1>Get Ingredients</h1>
<a href="ingredients.php">Ingredients API</a>
<p>
<h2>Endpoint Usage:</h2>
http://abujaba2.web.engr.illinois.edu/cs411project/api/ingredients.php?page=1
<h2>Returns</h2>
Dictionary containing the number of the results and an array of dictionaries that contain the results.
</p>
<hr>
<h1>Register User</h1>
<a href="registerUser.php">Register User</a>
<p>
<h2>Endpoint Usage:</h2>
http://abujaba2.web.engr.illinois.edu/cs411project/api/registerUser.php?firstname=David&&lastname=John&&email=david@john.com&&password=123
<h2>Returns:</h2>
On success returns the newely created user. On faliure returns null and an array of errors
</p>
<hr>
<h1>Login User</h1>
<a href="loginUser.php">Login User</a>
<p>
<h2>Endpoint Usage: </h2>
http://abujaba2.web.engr.illinois.edu/cs411project/api/loginUser.php?email=david@john.com&&password=123
<h2>Returns</h2>
On success returns the user. On faliure returns null with an error
</p>
<hr>
<h1>Add Ingredient</h1>
<a href="addIngredient.php">Add Ingredient</a>
<p>
<h2>Endpoint Usage: </h2>
http://abujaba2.web.engr.illinois.edu/cs411project/api/addIngredient.php?name=testIngredient&&protien=100&&carbs=100&&sugar=100&&fat=100&&serving_size=100&&source=32
<h2>Arguments</h2>
name (required): The name of the ingredient<br>
protien (optional): The amount of protien<br>
carbs (optional): The amount of carbs<br>
sugar (optional): The amount of sugar<br>
fat (optional): The amount of fat<br>
serving_size (optional): The serving size of the nutrients<br>
source (optional): The source of the ingredient. If the source is a number it represents the id of the user. String otherwise<br>
<h2>Returns</h2>
On success returns the ingredient. On faliure returns null with an error.
</p>
<h1>Edit User</h1>
<a href="editUser.php">Edit User</a>
<p>
<h2>Endpoint Usage: </h2>
http://abujaba2.web.engr.illinois.edu/cs411project/api/editUser.php?id=12&&firstname=newName&&lastname=newLastName&&new_email=new@email.com
<h2>Arguments</h2>
Either the user id or email should be included otherwise an error will be returned<br>
Optional arguments that can be changed:<br>
firstname, lastname, new_email, dob, weight, height, gender, activity_type, profile_image, password<br>
<h2>Returns</h2>
On success returns the new user information. On faliure returns null with an error.
</p>
<h1>Get User</h1>
<a href="getUser.php">Edit User</a>
<p>
<h2>Endpoint Usage: </h2>
http://abujaba2.web.engr.illinois.edu/cs411project/api/getUser.php?id=12
<h2>Arguments</h2>
Either the user id or email should be included otherwise an error will be returned<br>
<h2>Returns</h2>
On success returns the user information. On faliure returns null with an error.
</p>
<h1>Add to Nutrition Log</h1>
<a href="addNutritionLog.php">Add to Nutrition Log</a>
<h2>Endpoint Usage: </h2>
<p>
http://abujaba2.web.engr.illinois.edu/cs411project/api/addNutritionLog.php?user_id=17&&date=2016-04-14&&time_of_day=morning&&recipe_id=4
<h2>Arguments</h2>
user_id (required): the id of the user<br>
date (required): the day of the meal<br>
time_of_day (optional): the time of the day<br>
either recipe_id or ingredient_id<br>
<h2>Returns</h2>
On success returns the log information that was added. On faliure returns null with an error.
</p>
<h1>Get Nutrition Log</h1>
<a href="getNutritionLog.php">Get Nutrition Log</a>
<p>
http://abujaba2.web.engr.illinois.edu/cs411project/api/getNutritionLog.php?user_id=17&&date=2016-01-01&&time_of_day=night
<h2>Arguments</h2>
user_id (required): the id of the user<br>
date (required): the day of the meal<br>
time_of_day (optional): the time of the day<br>
<h2>Returns</h2>
On success returns the log information. On faliure returns null with an error.
</p>
<h1>add Recipe</h1>
<a href="addRecipe.php">add Recipe</a>
<p>
http://abujaba2.web.engr.illinois.edu/cs411project/api/addRecipe.php?recipe_name&&recipe_author=12
<h2>Arguments</h2>
recipe_name (required): title of the recipe<br>
recipe_prep_time (optional): the preparation time. Format = 1H20M. equivelent to 1 hour and 20 minutes.<br>
recipe_cook_time (optional): the cook time. Format = 1H20M. equivelent to 1 hour and 20 minutes.<br>
recipe_ready_in_time (optional): the ready in time. Format = 1H20M. equivelent to 1 hour and 20 minutes.<br>
recipe_image: (optional): the image of the recipe<br>
recipe_categories (optional): the categories separated by commas<br>
recipe_source (optional): the source of the recipe<br>
recipe_author (optional): if the recipe is entered by an author then this is the user id<br>
recipe_calories (optional): number of calories in the recipe<br>
recipe_fat (optional): amount of fat<br>
recipe_carbs (optional): amount of carbs<br>
recipe_protein (optional): amount of protein<br>
recipe_cholesterol (optional): amount of cholesterol<br>
recipe_sodium (optional): amount of sodium<br>
<h2>Returns</h2>
On success returns the recipe that was added. On faliure returns null with an error.
</p>
<h1>Get Recipe</h1>
<a href="getRecipe.php">add Recipe</a>
<p>
http://abujaba2.web.engr.illinois.edu/cs411project/api/addRecipe.php?recipe_name&&recipe_author=12
<h2>Arguments</h2>
recipe_id (optional): the id of the recipe<br>
limit (optional): limit of the returned records<br>
page (optional): the page of the fetched records<br>
Note: if no arguments are passed then all the the recipes are returned.<br>
<h2>Returns</h2>
On success returns the recipe depending on the arguments. On faliure returns null with an error.
</p>
<h1>Get Number of Elements</h1>
<a href="getNumElements.php">getNumElements</a>
<p>
http://abujaba2.web.engr.illinois.edu/cs411project/api/getNumElements.php?table_name=recipes
<h2>Arguments</h2>
table_name (required): the name of the table you want the count of<br>
<h2>Returns</h2>
On success returns the number of elements in the table. On faliure returns null with an error.
</p>
