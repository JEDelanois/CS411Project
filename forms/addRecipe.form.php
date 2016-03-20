<form method="POST" action="">
    <div id="recipeNameGroup">
        <label for="recipeNameTextField" id="recipeNameLabel">Recipe name:</label>
        <input type="text" name="recipeNameTextField" id="recipeNameTextField">
    </div>

    <div id="numIngredientsGroup">
        <label for="numIngredientsTextField" id="numIngredientsLabel">Number of Ingredients</label>
        <input type="number" name="Quantity" min="1" max="20">
    </div>

    Ingredients<br>
    <input type="text" name="Ingredients">
    <br>
    Preparation<br>
        <textarea name="prep" rows="30" cols="30"></textarea>
        <br>
    Cook<br>
        <textarea name="cook" rows="30" cols="30"></textarea>
        <br>
    <input type="submit" value="Submit">
</form> 

