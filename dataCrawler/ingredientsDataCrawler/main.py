from nutritionvalueCrawler import CrawlPage
from nutritionvalueCrawler import InitFile
from nutritionvalueCrawler import GatherFoodOnPage
from nutritionvalueCrawler import CrawlNutrionValue
#import MySQLdb as mdb
#from credentials import user
#from credentials import password
#from credentials import database
#from credentials import host


f = open('output.txt', 'w')
db = 1# mdb.connect(host=host(), user=user(), passwd=password(), db=database() );

CrawlNutrionValue(f, db)




f.close()