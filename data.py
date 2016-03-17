import MySQLdb as mdb
from credentials import user
from credentials import password
from credentials import database
from credentials import host
import shlex


db = mdb.connect(host=host(), user=user(), passwd=password(), db=database() )

output = open('output.txt','r')

for i in range(0,100):
	line = output.readline()
	name = line.split(':')[0]
	data_str = "" 
	if '\t' in line:
		data_str = line[line.index('\t'):]
	else:
		continue
		
	data_list = shlex.split(data_str)
	print data_list[3]

	cursor = db.cursor()

	#repalce words with '_' witht he actual name from data base
	#no urls were recorded so they should just be set to their default values right?
	add_statement = 'INSERT INTO _TABLENAME (_PROTEIN, _FAT, _CARB,_SUGAR) VALUES (%s,%s,%s,%s);'
    cur.execute(add_statement, data_list )


  