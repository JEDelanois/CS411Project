from crawler import CrawlPage
from crawler import InitFile

#url = "http://nutritiondata.self.com/facts/breakfast-cereals/7987/2"
url = "http://www.nutritionvalue.org/Avocados%2C_Florida%2C_raw_nutritional_value.html"
f = open('output.txt', 'w')

InitFile(f)
CrawlPage(url, f)
CrawlPage(url, f)
CrawlPage(url, f)
CrawlPage(url, f)

f.close()