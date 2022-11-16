import json
import threading
import time
import datetime
  
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
    for student in data["userlist"]:
        if(student["identifier"] == int(barcode)):
            if(student["checked_in"] == 0):
                student["checked_in"] = 1
                student["time_in"] = int(time.time())
                # Append signin to log file
                logfile = open(r"C:\xampp\htdocs\logs.txt", "a")
                appstring = str("[" + datetime.datetime.now().strftime('%Y-%m-%d %H:%M:%S') + "] " + student["name"] + " signed in.\n")
                logfile.write(appstring)
            else:
                student["checked_in"] = 0
                # Append signout to log file
                logfile = open(r"C:\xampp\htdocs\logs.txt", "a")
                appstring = str("[" + datetime.datetime.now().strftime('%Y-%m-%d %H:%M:%S') + "] " + student["name"] + " signed out.\n")
                logfile.write(appstring)


# Saves JSON dict stored in memory to disk
def save():
    savefile = open(r"C:\xampp\htdocs\userlist.json", 'w')
    json.dump(data, savefile)
    
# Increments the 'time_in' parameter for each user who has
# 'checked_in' set to 1. Used for tracking how long a user has
# been checked in.
def incrementTime():
    while True:
        for student in data["userlist"]:
            if(student["checked_in"] == 1):
                student["time_in"] = student["time_in"] + 1
        time.sleep(1)
        save()

# Input loop
while True:
    barcode = input(">")
    checkIn(id)
    save()
