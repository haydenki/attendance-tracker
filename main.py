import json
import threading
import time
import datetime
import requests
  
# Load userlist from disk 
f = open(r"C:\xampp\htdocs\userlist.json")
data = json.load(f)

# Checks if user is present in DB
def userExists(id):
    for student in data["userlist"]:
        if(student["identifier"] == barcode):
            return 1
    return 0

# Runs everytime student scans their barcode
def checkIn(id):
    # Load master key
    master_key_file = open("MASTERKEY","r")
    master_key = master_key_file.read().replace("\n","")
    URL = "http://localhost/studentsignin.php"
    r = requests.post(URL, data={"uid":id, "key":master_key})
    print(r.text)


# Saves JSON dict stored in memory to disk
def save():
    savefile = open(r"C:\xampp\htdocs\userlist.json", 'w')
    json.dump(data, savefile)

# Input loop
while True:
    barcode = input(">")
    checkIn(barcode)
