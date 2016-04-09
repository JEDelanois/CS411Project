import requests
import shlex



output = open('output.txt','r')

while output is not None:
	line = output.readline()
	line = line.replace("\xc2\xa0", "")
	name = line.split(':')[0]
	data_str = "" 
	if '\t' in line:
		data_str = line[line.index('\t'):]
	else:
		continue
		
	data_list = shlex.split(data_str)
	data_list.append(name)


	url = "http://abujaba2.web.engr.illinois.edu/cs411project/api/addIngredient.php?name="+ data_list[5] +"&&protien="+ data_list[0] + "&&carbs=" + data_list[2] + "&&sugar=" + data_list[3] + "&&fat=" + data_list[1] + "&&serving_size=100&&source=" + data_list[4]
	retval = requests.get(url, headers={'User-Agent':'test'})

	print retval


