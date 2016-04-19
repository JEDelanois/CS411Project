import MySQLdb as mdb
#from credentials import user
#from credentials import password
#from credentials import database
#from credentials import host
import shlex


# db = mdb.connect(host=host(), user=user(), passwd=password(), db=database() )
db = mdb.connect(host="localhost",user="root",passwd="root",db="CS411_db",unix_socket="/Applications/MAMP/tmp/mysql/mysql.sock")
# db = mdb.connect(host="localhost",user="root",passwd="root",db="cs411project")
# db= _mysql.connect(host="localhost",user="joebob", passwd="moonpie",db="thangs")
cursor = db.cursor()

output = open('output.txt','r')
i = 0
while output is not None:
	line = output.readline()
	line = line.replace("\xc2\xa0", "")
	if line == "":
		continue
	name = line.split(':')[0]
	data_str = "" 
	if '\t' in line:
		data_str = line[line.index('\t'):]
	else:
		continue
		
	data_list = shlex.split(data_str)
	data_list.pop() #remove source for now
	data_list.append(name)



	#repalce words with '_' witht he actual name from data base
	#no urls were recorded so they should just be set to their default values right?
	# add_statement = 'INSERT INTO _TABLENAME (_PROTEIN, _FAT, _CARB, _SUGAR, _name) VALUES (%s,%s,%s,%s);'
  	add_statement = "INSERT INTO Ingredients (ingredient_protien, ingredient_fat, ingredient_carbs, ingredient_sugar, ingredient_name) VALUES (%s,%s,%s,%s,%s);"
#        add_statement = "INSERT INTO `Ingredients`(`ingredient_name`, `ingredient_protien`, `ingredient_sugar`, `ingredient_carbs`, `ingredient_fat`) VALUES (%s,%s,%s,%s,%s)" # % (data_list[4], data_list[0], data_list[3], data_list[2], data_list[1])

 	cursor.execute(add_statement, data_list )
 	
 	i = i + 1
 	if (i % 100) == 0:
 		print i

cursor.close()
db.close()


  
