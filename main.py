# Python program to read
# json file
  
  
import json
  
# Load userlist from disk 
f = open('C:\xampp\htdocs\userlist.json')
data = json.load(f)

# Checks if user is present in DB
def userExists(id):
    for student in data["userlist"]:
        if(student["identifier"] == barcode):
            return 1
    return 0

# Runs everytime student scans their barcode
def checkIn(id):
    for student in data["userlist"]:
        if(student["identifier"] == int(barcode)):
            if(student["checked_in"] == 0):
                student["checked_in"] = 1
            else:
                student["checked_in"] = 0


# Saves JSON dict stored in memory to disk
def save():
    savefile = open('userlist.json', 'w')
    json.dump(data, savefile)

# Input loop
while True:
    barcode = input(">")
    checkIn(id)
    save()
