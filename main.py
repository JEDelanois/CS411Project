from nutritionvalueCrawler import CrawlPage
from nutritionvalueCrawler import InitFile
from nutritionvalueCrawler import GatherPage

#nutritionvalue_init = "http://nutritiondata.self.com/facts/breakfast-cereals/7987/2"
url = "http://www.nutritionvalue.org/Avocados%2C_Florida%2C_raw_nutritional_value.html"

pageurl = "http://www.nutritionvalue.org/foods_start_with_A.html"
url_list = list() # list of all urls to search



GatherPage(pageurl, url_list)


#output txt that has data
f = open('output.txt', 'w')




InitFile(f)
CrawlPage(url, f)


f.close()