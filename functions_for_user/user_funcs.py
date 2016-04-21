import MySQLdb as mdb
import datetime
from random import randint

class UserInfo:
	def __init__(self, userId, cursor):
		select_statement = "SELECT * FROM Users WHERE Users.user_id = " + str(userId) + ";"
		cursor.execute(select_statement)
		atts = cursor.fetchone()
		
		self.id = atts[0]
		self.firstname = atts[2]
		self.lastname = atts[3]
		self.age = float(datetime.datetime.now().year) - float(atts[6].year)
		self.weight = atts[7]
		self.targetweight = atts[8]
		self.height = atts[9]
		self.sex = atts[10]
		


def get_db():
	db = mdb.connect(host="localhost",user="root",passwd="root",db="CS411_db",unix_socket="/Applications/MAMP/tmp/mysql/mysql.sock")
	return db




def get_target_macros(userID):
	db = get_db()
	cur = db.cursor()
	user = UserInfo(userID, cur)

	protein = 0
	fat = 0
	carb = 0

	if user.targetweight > user.weight:
		protein = user.targetweight 
		fat = (user.targetweight / 2) - 2.5
		carb = (user.targetweight * 2.5) - 3

	elif user.targetweight < user.weight:
		protein = user.targetweight
		fat = (user.targetweight / 2) - 2.5
		carb = user.targetweight

	else: #else jsut maintain
		protein = user.targetweight
		fat = (user.targetweight / 2) - 2.5
		carb = (user.targetweight * 1.5) - 2


	cur.close()
	db.close()
	return [protein, fat, carb]

def get_bodycomp(userID):
	db = get_db()
	cur = db.cursor()
	user = UserInfo(userID, cur)

	g = 0
	if user.sex == "male":
		g = 1

	bmi = (user.weight / (user.height * user.height)) * 703
	bfp = (1.2 * bmi) + (0.24 * user.age) - (10.8 * g) - 5.4
	

	cur.close()
	db.close()
	return [bmi, bfp]



def get_macro_day_total(userID, date): #date must be a datetime 
	db = get_db()
	cur = db.cursor()
	user = UserInfo(userID, cur)

	date = date.replace(hour=0, minute=0, second=0, microsecond=0) 
	tomorrow = date.replace(day=(date.day+1),hour=0, minute=0, second=0, microsecond=0) 

	ing_statement = "SELECT ingredient_id, ingredient_amount FROM NutritionLog WHERE (user_id = " + str(userID) + ") "
	ing_statement = ing_statement + "AND (log_date >= '" + str(date) + "') "
	ing_statement = ing_statement + "AND (log_date < '" + str(tomorrow) + "') "
	ing_statement = ing_statement + "AND (ingredient_id IS NOT NULL );"

	cur.execute(ing_statement)
	if cur.rowcount != 0:
		ing_ids = cur.fetchall() #get all ingreienedt ids eate


	rec_statement = "SELECT recipe_id FROM NutritionLog WHERE (user_id = " + str(userID) + ") "
	rec_statement = rec_statement + "AND (log_date >= '" + str(date) + "') "
	rec_statement = rec_statement + "AND (log_date < '" + str(tomorrow) + "') "
	rec_statement = rec_statement  + "AND (recipe_id IS NOT NULL );"

	cur.execute(rec_statement)
	if cur.rowcount != 0:
		rec_ids = cur.fetchall() # get all recipy ids eaten

	

	ingds = list() # get data for all ingriendens eaten
	#entry format in ingreinents[protein, fat, carb, servingsize, amount eaten, id]
	for row in ing_ids:
		ID = row[0]
		amount = row[1]
		statement = "SELECT ingredient_protien, ingredient_fat, ingredient_carbs, ingredient_serving_size FROM Ingredients WHERE (ingredient_id = " + str(ID) + ");"
		cur.execute(statement)
		temp = list(cur.fetchone())
		temp.append(amount)
		temp.append(ID)
	
		ingds.append(temp) # add all data to list of all ingriedents eaten


	recs = list() #get all recipies eaten recs[protein, fat, carb, id]
	for row in rec_ids:
		ID = row[0] 
		statement = "SELECT recipe_protein, recipe_fat, recipe_carbs  FROM Recipes WHERE (recipe_id = " + str(ID) + ");"
		cur.execute(statement)
		temp = list(cur.fetchone())
		temp.append(ID)
		recs.append(temp)


	protein = float(0)
	fat = float(0)
	carb = float(0)

	#add up all food
	for row in ingds:
		protein = protein + ((row[4]/row[3])*row[0])
		fat = fat + ((row[4]/row[3])*row[1])
		carb = carb + ((row[4]/row[3])*row[2])


	for row in recs:
		protein = protein + row[0]
		fat = fat + row[1]
		carb = carb + row[2]


	cur.close()
	db.close()

	return [protein, fat, carb]


def suggest_rec_by_macros(userID):
	macros = get_target_macros(userID)
	consumed = get_macro_day_total(userID, datetime.datetime.now())
	remain = list()
	remain.append(macros[0] - consumed[0])
	remain.append(macros[1] - consumed[1])
	remain.append(macros[2] - consumed[2])


	return suggest_rec_by_value(1, remain[0],1, remain[1], 2, remain[2])


#check for empty sql returns in prev function
#add calorie thing maybe
#add
def suggest_rec_by_value(min_p, max_p, min_f, max_f, min_c, max_c):
	db = get_db()
	cur = db.cursor()

	statement = "SELECT recipe_id FROM Recipes WHERE (recipe_fat <= %s ) AND (recipe_carbs <= %s) AND (recipe_protein <= %s) AND (recipe_fat  >= %s) AND (recipe_carbs >= %s ) AND (recipe_protein >= %s);"

	cur.execute(statement, [max_f, max_c, max_p, min_f, min_c, min_p])
	if cur.rowcount == 0:
		return None 
	
	results = cur.fetchall()

	cur.close()
	db.close()

	recRow = results[randint( 0, (len(results) - 1))]

	return recRow[0]



#tests
cur = get_db().cursor()
temp = UserInfo(46, cur)

#print suggest_rec_by_macros(temp.id)
#date = datetime.datetime.now()
#date = date.replace(year=1,month=1,day=1,hour=0, minute=0, second=0, microsecond=0)

#get_macro_day_total(temp.id, date)

#suggest_rec_by_value(20, 100, 10, 100, 10, 100)


