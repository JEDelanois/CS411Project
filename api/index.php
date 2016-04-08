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
