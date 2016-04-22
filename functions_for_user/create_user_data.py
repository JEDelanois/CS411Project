from user_funcs import UserInfo
from user_funcs import get_db
from user_funcs import get_target_macros
from user_funcs import get_bodycomp
from user_funcs import get_macro_day_total
from user_funcs import suggest_rec_by_macros
from user_funcs import suggest_rec_by_value
from user_funcs import datetime

#datetime.datetime.now()


#create


users = list() #list of user ids that will be genteratesd
total_days = 7 #total number of days users will have entries for 
start_date = datetime.datetime.now()
start_date = start_date.replace(day=(start_date.day - total_days),hour=0, minute=0, second=0, microsecond=0)

db = get_db()
cur = db.cursor()
cur.execute("SELECT user_id FROM USERS")
q = cur.fetchall()
for row in q:
	users.append(row[0]) #get all user ids


cur.execute("TRUNCATE NutritionLog;"); #clear the database
for userID in users: #for all the users
	print userID
	temp_date = start_date


	for i in range(0,total_days):#for all the days you need to make up
		meals = 0
		while(1): # until you need to break
			rec_id = suggest_rec_by_macros(userID, temp_date)
			
			if rec_id == None: #if you cant fit in any more food that day then quit
				break

			#add food to nutrition log
			statement = "INSERT INTO NutritionLog ( log_id, user_id, recipe_id, log_date, log_time_of_the_day, log_added_date) VALUES ( %s, %s, %s, %s, %s, %s);"
			data = ['1', userID , rec_id, temp_date , 'NULL', temp_date]
			cur.execute(statement, data )
			db.commit()
			meals = meals + 1
		print 	"	" + str(temp_date) + " meals: " + str(meals)
		temp_date = temp_date.replace(day=(temp_date.day + 1),hour=0, minute=0, second=0, microsecond=0)











cur.close()
db.close()