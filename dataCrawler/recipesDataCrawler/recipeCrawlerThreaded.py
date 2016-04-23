import threading, Queue, requests
from bs4 import BeautifulSoup
from webCrawler import singlePage

lock = threading.Lock()

q = Queue.Queue(0)
singlePages = Queue.Queue(0)
done = Queue.Queue(0)
def spider():
    page = 1
    baseURL = "http://allrecipes.com"
    while not q.empty():
        print("size of q: " + str(q.qsize()))
        print("size of single page arr: " + str(singlePages.qsize()))
        currLink = q.get(timeout=5)
        done.put(currLink)
        print(currLink)
        if(currLink[21:28] == '/recipe'):
            if not (currLink in singlePages.queue):
                singlePage(currLink)
                singlePages.put(currLink)
        #    if not (currLink in q.queue) and not (currLink in done.queue):
        #        q.put(currLink)
        if((currLink[0] == '/' and len(currLink) > 1) or currLink[:21] == baseURL):
            code = requests.get(currLink)
            plainText = code.text
            soup = BeautifulSoup(plainText, "html.parser")
            links = soup.findAll('a')
            for link in links:
                if(link == None):
                    continue
                link = link.get('href')
                if(link != None and ((len(link) > 1 and link[0] == '/')  or (len(link) > 20 and link[:21] == baseURL))):
        #            if not (link in singlePages.queue):
         #               singlePages.put(link)
                     # if link[0:8] == "/recipes" or link[0:7] == "/recipe": # "/video":
                    if link[0:6] != "/video" and link[0:8] != "/account" and link[0:6] != "/HowTo" and link[0:5] != "/cook":
                        if not (link[:21] == baseURL):
                            link = baseURL + link
                        if not (link in q.queue) and not (link in done.queue):
                            q.put(link)

    return singlePages

baseURL = "http://allrecipes.com"
recipesURL = "http://allrecipes.com/recipes"
for page in range(10):
    q.put(baseURL + "/?page=" + str(page + 1))
    q.put(recipesURL + "/?page=" + str(page + 1))
threads = []
for num in range(0, 50):
    thread = threading.Thread(target=spider)
    thread.start()
    threads.append(thread)


for thread in threads:
    thread.join()

for i in range(singlePages.qsize()):
    element = singlePages.get()
    print("single pages array: " + str(element))








