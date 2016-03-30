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
