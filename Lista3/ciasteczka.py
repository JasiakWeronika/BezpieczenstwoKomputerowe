import json
from selenium import webdriver

print("Znalezione strony: ")
with open('dane.json') as f:
    dane = json.load(f)
    for idx, ent in enumerate(dane):
        if not ent["_source"]["layers"]:
            continue
        print idx,":", ent["_source"]["layers"]["http.host"][0].encode("ascii","replace")
    id = input('Wybierz numer ID strony:')
    host = dane[id]["_source"]["layers"]["http.host"][0].encode("ascii","replace")
    suroweCiasteczka = dane[id]["_source"]["layers"]["http.cookie"][0].encode("ascii","replace")
    ciasteczka = suroweCiasteczka.split("; ")
    driver = webdriver.Chrome(executable_path='/home/weronika/Pulpit/Lista3/chromedriver')
    driver.get("http://"+host+"/")
    for cookie in ciasteczka:
        splited = cookie.split("=")
        driver.add_cookie({'name':splited[0], 'value':splited[1], 'path':'/'})
    print("Odswiez okno przegladarki, ktore sie wlasnie pojawilo!")
