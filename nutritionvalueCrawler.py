import requests
from bs4 import BeautifulSoup

def InitFile(outfile):
	outfile.write("Food Name:\t\tProtein Fat Carb Sugar")
	outfile.write("\n")
	outfile.write("\n")


#url of one of the A-Z pages on nutrionvalue
#url_list = list of urls that this gather page will add to
def GatherPage(url, url_list):
	source_code = requests.get(url)
	plain_text = source_code.text
	


	print plain_text
	#get soup object
	soup = BeautifulSoup(plain_text,"html.parser")
	print soup.prettify()
	for url_table in soup.find_all("td"):
		print url_table.name
	
	


#url - full url of specific http://www.nutritionvalue.org/
#		page you want to crawl
#file - open file that can be written to
def CrawlPage(url, outfile):
	#eror checking
	if isinstance(outfile, file): 
		if outfile.closed:
			print "File variable passed to CrawlPageis closed"
			return
	else:
		print "File variable passed to CrawlPage is not a file object"
		return


	source_code = requests.get(url)
	plain_text = source_code.text


	if plain_text == "":
		print "The website " + url + "has returned a blank html probably due to making too many requests need to change IP address"
		return False

	#get soup object
	soup = BeautifulSoup(plain_text,"html.parser")

	#html tag in the soup odc
	html = soup.html
	#set default values
	protein = "0"
	fat = "0"
	carb = "0"
	sugar = "0"

	#every nutrient table
	for child in html.find_all("table", {'class':"nutrient"}): 
		#for every row int the table
		for c in child.find_all("td"):
			#get nutrients
			if c.text == 'Protein':
				protein = c.next_sibling.text.replace('g','')

			elif c.text == 'Fat':
				fat =  c.next_sibling.text.replace('g','')

			elif c.text == 'Carbohydrate':
				carb = c.next_sibling.text.replace('g','')

			elif c.text == 'Sugars':
				sugar = c.next_sibling.text.replace('g','')


	
	outfile.write((soup.h1.text + ":\t\t" + protein +  " " +  fat +  " " + carb +  " " + sugar).encode('utf-8').strip())

	outfile.write("\n")
	return True

