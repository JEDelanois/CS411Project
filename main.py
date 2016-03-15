from nutritionvalueCrawler import CrawlPage
from nutritionvalueCrawler import InitFile
from nutritionvalueCrawler import GatherPage

#nutritionvalue_init = "http://nutritiondata.self.com/facts/breakfast-cereals/7987/2"
url = "http://www.nutritionvalue.org/Avocados%2C_Florida%2C_raw_nutritional_value.html"

page_url = "http://www.nutritionvalue.org/foods_start_with_A.html"
url_list = list() # list of all urls to search



GatherPage(page_url, url_list)


#output txt that has data
f = open('output.txt', 'w')




InitFile(f)


l = list()
l.append("http://www.nutritionvalue.org/Fat%2C_chicken_nutritional_value.html")
l.append("http://www.nutritionvalue.org/Chicken_spread_nutritional_value.html")
l.append("http://www.nutritionvalue.org/Chicken%2C_meatless_nutritional_value.html")
l.append("http://www.nutritionvalue.org/Gravy%2C_dry%2C_chicken_nutritional_value.html")
l.append("http://www.nutritionvalue.org/Chicken%2C_raw%2C_ground_nutritional_value.html")
l.append("http://www.nutritionvalue.org/KFC%2C_Popcorn_Chicken_nutritional_value.html")
l.append("http://www.nutritionvalue.org/Frankfurter%2C_chicken_nutritional_value.html")
l.append("http://www.nutritionvalue.org/Chicken%2C_boiled%2C_feet_nutritional_value.html")
l.append("http://www.nutritionvalue.org/Bologna%2C_pork%2C_chicken_nutritional_value.html")
l.append("http://www.nutritionvalue.org/DENNY%27S%2C_chicken_strips_nutritional_value.html")
l.append("http://www.nutritionvalue.org/WENDY%27S%2C_Chicken_Nuggets_nutritional_value.html")
l.append("http://www.nutritionvalue.org/Chicken%2C_no_broth%2C_canned_nutritional_value.html")
l.append("http://www.nutritionvalue.org/SWANSON%2C_Chicken_A_La_King_nutritional_value.html")
l.append("http://www.nutritionvalue.org/Gravy%2C_chicken%2C_CAMPBELL%27S_nutritional_value.html")
l.append("http://www.nutritionvalue.org/Bratwurst%2C_cooked%2C_chicken_nutritional_value.html")
l.append("http://www.nutritionvalue.org/KFC%2C_Crispy_Chicken_Strips_nutritional_value.html")
l.append("http://www.nutritionvalue.org/Fast_foods%2C_chicken_tenders_nutritional_value.html")
l.append("http://www.nutritionvalue.org/BURGER_KING%2C_Chicken_Strips_nutritional_value.html")
l.append("http://www.nutritionvalue.org/Pate%2C_canned%2C_chicken_liver_nutritional_value.html")
l.append("http://www.nutritionvalue.org/Bologna%2C_beef%2C_pork%2C_chicken_nutritional_value.html")
l.append("http://www.nutritionvalue.org/McDONALD%27S%2C_Chicken_McNUGGETS_nutritional_value.html")
l.append("http://www.nutritionvalue.org/Chicken%2C_raw%2C_giblets%2C_capons_nutritional_value.html")
l.append("http://www.nutritionvalue.org/Chicken_patty%2C_cooked%2C_frozen_nutritional_value.html")
l.append("http://www.nutritionvalue.org/CHICK-FIL-A%2C_chicken_sandwich_nutritional_value.html")
l.append("http://www.nutritionvalue.org/Soup%2C_mix%2C_dry%2C_chicken_noodle_nutritional_value.html")
l.append("http://www.nutritionvalue.org/SWANSON%2C_Chicken_and_Dumplings_nutritional_value.html")
l.append("http://www.nutritionvalue.org/McDONALD%27S%2C_McCHICKEN_Sandwich_nutritional_value.html")
l.append("http://www.nutritionvalue.org/Chicken%2C_raw%2C_giblets%2C_stewing_nutritional_value.html")




for u in l:
	CrawlPage(u, f)


f.close()