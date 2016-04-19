import MySQLdb as mdb

class UserInfo:
	def __init__(self, userId, cursor):
		select_statement = "SELECT * FROM Users WHERE Users.user_id = " + str(userId) + ";"
		cursor.execute(select_statement)
		atts = cursor.fetchone()

		self.id = atts[0]
		self.firstname = atts[2]
		self.lastname = atts[3]
		self.weight = atts[7]
		self.height = atts[8]
		self.sex = atts[9]
		self.diet_type = atts[10]
	


def get_db():
	db = mdb.connect(host="localhost",user="root",passwd="root",db="CS411_db",unix_socket="/Applications/MAMP/tmp/mysql/mysql.sock")
	return db





def get_macros(userID):

	return 0



cur = get_db().cursor()
temp = UserInfo(46, cur)

print temp.id 
print temp.firstname 
print temp.lastname 
print temp.weight 
print temp.height 
print temp.sex 
print temp.diet_type 


