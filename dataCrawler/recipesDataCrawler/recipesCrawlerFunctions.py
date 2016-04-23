import requests
from bs4 import BeautifulSoup
import sys
reload(sys)
sys.setdefaultencoding('utf-8')

def spider(max_pages):
    page = 1
    stack = []
    while page <= max_pages:
        baseURL = "http://allrecipes.com"
        url = baseURL + "/?page=" + str(page)
        code = requests.get(url)
        plainText = code.text
        soup = BeautifulSoup(plainText, "html.parser")
        for link in soup.findAll('article', {'class': 'grid-col--fixed-tiles'}):
            if link != None:
                a = link.a
                if(a != None and a['href'][:7] == '/recipe'):
                    # single = baseURL + a['href'].encode('ascii', 'ignore')
                    singlePage(single)
        page += 1

def singlePage(singleUrl):
    baseURL = "http://abujaba2.web.engr.illinois.edu/cs411project/"
    baseURL += "api/addRecipe.php"
    print(singleUrl)
    code = requests.get(singleUrl)
    plainText = code.text
    soup = BeautifulSoup(plainText, "html.parser")
    if(soup == None):
        print("none")
        return None
    title = getRecipeTitle(soup)
    if(title == None):
        return None
    # print("Title: " + str(title))
    url = baseURL + '?recipe_name=' + title

    prepTime = soup.find('time', {'itemprop': 'prepTime'})
    if(prepTime != None):
        prepTime = getTime(prepTime['datetime'])
        # print("preparation time: " + str(prepTime[0]) + " hours " + str(prepTime[1]) + " minutes")
        url += '&&recipe_prep_time=' + str(prepTime[0]) + str("H") + str(prepTime[1]) + str("M")

    cookTime = soup.find('time', {'itemprop': 'cookTime'})
    if(cookTime != None):
        cookTime = getTime(cookTime['datetime'])
        # print("cook time: " + str(cookTime[0]) + " hours " + str(cookTime[1]) + " minutes")
        url += '&&recipe_cook_time=' + str(cookTime[0]) + str("H") + str(cookTime[1]) + str("M")

    readyInTime = soup.find('time', {'itemprop': 'totalTime'})
    if(readyInTime != None):
        readyInTime = getTime(readyInTime['datetime'])
        # print('ready in: ' + str(readyInTime[0]) + " hours " + str(readyInTime[1]) + " minutes")
        url += '&&recipe_ready_in_time=' + str(readyInTime[0]) + str("H") + str(readyInTime[1]) + str("M")

    ingredients = getIngredients(soup)
    if ingredients:
        # print("ingredients: " + str(ingredients))
        count = 1
        for ingr in ingredients:
            if(ingr):
                url += "&&ingredient" + str(count) + "=" + ingr
                count += 1

    directions = getDirections(soup)
    if directions:
        # print("Directions: " + str(directions))
        count = 1
        for direc in directions:
            if(direc):
                url += "&&direction" + str(count) + "=" + direc
                count += 1

    nutrients = getNutrients(soup)
    if nutrients:
        # print("Nutrients" + str(nutrients))
        # Nutrients{u'fatContent': u'5.9', u'calories': u'164', u'sodiumContent': u'1226', u'carbohydrateContent': u'2.7', u'cholesterolContent': u'230', u'proteinContent': u'25.1'}

        if("fatContent" in nutrients):
            url += "&&recipe_fat=" + str(nutrients["fatContent"])
        if("calories" in nutrients):
            url += "&&recipe_calories=" + str(nutrients["calories"])
        if("sodiumContent" in nutrients):
            url += "&&recipe_sodium=" + str(nutrients["sodiumContent"])
        if("carbohydrateContent" in nutrients):
            url += "&&recipe_carbs=" + str(nutrients["carbohydrateContent"])
        if("cholesterolContent" in nutrients):
            url += "&&recipe_cholesterol=" + str(nutrients["cholesterolContent"])
        if("proteinContent" in nutrients):
            url += "&&recipe_protein=" + str(nutrients["proteinContent"])

    image = getImageURL(soup)
    if image:
        # print("Image url: " + str(image))
        url += "&&recipe_image=" + str(image)

    categories = getCategories(soup)
    if categories:
        # print("Categories: " + str(categories))
        if(len(categories) > 0):
            url += "&&recipe_categories="
            for categ in categories:
                if(categ != None):
                    url += str(categ) + ","
            url = url[:-1]

    url += "&&recipe_source=" + str(singleUrl)
    print("final url: " + str(url))
    r = requests.get(url)
    print("status code: " + str(r.status_code))
    print("headers: " + str(r.headers['content-type']))
    print(r.json())

def getRecipeTitle(fullText):
    if(fullText == None):
        return None
    title = fullText.find('h1', {'class': 'recipe-summary__h1'})
    if title:
        return title.string
    return None

def getImageURL(fullText):
    if(fullText == None):
        return None
    img = fullText.find('img', {'class': 'rec-photo'})
    if(img == None):
        return None
    return img['src']

def getIngredients(fullText):
    if(fullText == None):
        return None
    allIngredients = fullText.findAll('ul', {'class': 'checklist'})
    if(allIngredients == None):
        return None
    ing = []
    for ingredients in allIngredients:
        li = ingredients.findAll('li')
        if(li != None):
            for i in li:
                if(i.span.string != "Add all ingredients to list"):
                    ing.append(i.span.string)
    return ing

def getTime(time):
    time = time[2:]
    hours = None
    minutes = None
    if(time.count('H') > 0):
        currTime = time.split('H')
        hours = currTime[0]
        if(currTime[1].count('M') > 0):
            minutes = currTime[1].split('M')
            minutes = minutes[0]
    elif(time.count('M') > 0):
        currTime = time.split('M')
        minutes = currTime[0]

    retTime = [0, 0]
    if(hours):
        retTime[0] = int(hours)
    if(minutes):
        retTime[1] = int(minutes)
    return (retTime)

def getDirections(fullText):
    if(fullText == None):
        return None
    allDirections = fullText.find('ol', {'class': 'recipe-directions__list'})
    if(allDirections == None):
        return None
    directionsList = allDirections.findAll('li')
    if(directionsList == None):
        return None
    counter = 1
    directions = []
    for li in directionsList:
        directions.append(li.span.string)
        counter += 1
    return directions

def getNutrients(fullText):
    if(fullText == None):
        return None
    allNutrients = fullText.findAll('ul', {'class': 'nutrientLine'})
    if(allNutrients == None):
        return None
    retNutrients = {}
    for nutrients in allNutrients:
        currentNutrient = nutrients.find('li', {'class': 'nutrientLine__item--amount'})
        if(currentNutrient != None):
            retNutrients[currentNutrient['itemprop']] = currentNutrient.span.string
    return retNutrients

def getCategories(fullText):
    if(fullText == None):
        return None
    allCategories = fullText.find('ul', {'class': 'breadcrumbs breadcrumbs'})
    if(allCategories == None):
        return None
    categories = []
    allCategories = allCategories.findAll('li')
    for categoryList in allCategories:
        currCategory = categoryList.find('a').find('span')
        categoryString = currCategory.string.strip()
        if(categoryString != "Home" and categoryString != 'Recipes'):
            categories.append(categoryString)
    return categories


# spider(10)
# singlePage("http://allrecipes.com/recipe/246589/ultimate-coconut-cake/?internalSource=rotd&referringContentType=home%20page")
# singlePage("http://allrecipes.com/recipe/7852/easter-cake/?internalSource=staff%20pick&referringId=1&referringContentType=recipe%20hub")
# singlePage("http://allrecipes.com/recipe/166160/juicy-thanksgiving-turkey/")
# singlePage("http://allrecipes.com/Recipe/Spicy-Grilled-Shrimp/")
