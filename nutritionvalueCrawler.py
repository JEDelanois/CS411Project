import requests
import time
from bs4 import BeautifulSoup
from urlparse import urljoin

def InitFile(outfile):
	outfile.write("Food Name:\t\tProtein Fat Carb Sugar url")
	outfile.write("\n")
	outfile.write("\n")


def CrawlNutrionValue(outfile, database):
	InitFile(outfile)
	GatherPages("http://www.nutritionvalue.org/",outfile)





def GatherPages(base_url, outfile):
	
	#array that holds the max pages for the coresponding letter
	max_pages = dict()
	for i in range(0,26):
		max_pages[i] = 0 #initialize to zero

	print "Gathering maximum number of pages for every letter..."
	for i in range(0,26): #for all letters
		#go to url and gab max mages for that letter
		cur_letter = chr(ord('A') + i)
		temp_url = urljoin(base_url, "/foods_start_with_" + cur_letter + "_page_1.html")
		

		source_code = requests.get(temp_url, headers={'User-Agent':'test'})
		plain_text = source_code.text
		
		time.sleep(2)
		#get soup object
		soup = BeautifulSoup(plain_text,"html.parser")

		#grab max pages
		for table in soup.find_all("th", {'class':"left results"}):
			for link in table.find_all("a"):
				max_pages[i] = int(link.text)
				
	
	for i in range(0,26): #for all letters
		#go to url and gab max mages for that letter
		cur_letter = chr(ord('A') + i)

		for p in range(1, max_pages[i] + 1): #for all of the pages gather that page
			print "Craling letter " + cur_letter + " page " + str(p) + "..."
			GatherFoodOnPage(urljoin(base_url, "/foods_start_with_" + cur_letter + "_page_"+ str(p) +".html"),outfile)
			time.sleep(2)


	#now have the max pages for everyindex






#url of one of the A-Z pages on nutrionvalue
#url_list = list of urls that this gather page will add to
def GatherFoodOnPage(url, outfile):
	source_code = requests.get(url, headers={'User-Agent':'test'})
	plain_text = source_code.text
	
	#get soup object
	soup = BeautifulSoup(plain_text,"html.parser")
	
	for url_table in soup.find_all("td", {'class':"results left"} ):
		CrawlPage(urljoin(url, url_table.a['href']), outfile)
	
	


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


	source_code = requests.get(url, headers={'User-Agent':'test'})
	plain_text = source_code.text


	if plain_text == "":
		print "The website " + url + "has returned a blank html probably due to making too many requests"
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



	if soup.h1 is not None: 
		outfile.write((soup.h1.text + ":\t" + protein +  " " +  fat +  " " + carb +  " " + sugar + " ").encode('utf-8').strip())
		outfile.write("\n")

	return True

