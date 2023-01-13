# woshindex V1.0, by Zafer Akçalı
import urllib.request as req
from urllib.error import URLError, HTTPError
import certifi
import ssl
preText = "https://publons.com/wos-op/api/stats/individual/"
postText = "/"
rid = input("Enter researcherID:")
url = preText+rid+postText
print("ResearcherId:", rid)
try:
    response = req.urlopen(url, context=ssl.create_default_context(cafile=certifi.where()))
except HTTPError as e:
    print ("Author not found")
    exit ()
except URLError as e:
    print ("Connection error")
    exit ()
bytecode = response.read ()
htmlstr = bytecode.decode()
true=1 #true is undefined in Python, which response htmlstr includes
# dic doesn't work, used eval: https://stackoverflow.com/questions/17610732/error-dictionary-update-sequence-element-0-has-length-1-2-is-required-on-dj
ridDict = eval (htmlstr) 
print ("h-index=", int (ridDict ['hIndex']))
print ("sum of times cited=", int (ridDict ['timesCited']))
print ("publications in wos=", int (ridDict ['numPublicationsInWosCc']))
for year, citation in reversed (ridDict ['citationsPerYear'].items()):
    if citation != "0":
        print (f"{citation} citation(s) in year {year}" )
