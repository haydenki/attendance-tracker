
# Attendance Tracker

An easy solution for keeping track of who comes in and out of the room.
This project uses a simple python script that takes barcode numbers as inputs
and automatically keeps a JSON database tracking who has signed in/out and at what times.
Along with this, is a simple and easy-to-use web interface that
provides a live overview of the data with convenient statistical insights.



## Setup instructions

1.Install XAMPP and an up-to-date version of Python

2.Inside the XAMPP control panel, enable the Apache and MySQL services

3.Navigate to your phpmyadmin panel and create a DB of any name

4.Inside your DB, click on the "SQL" tab. Open the file 'dbsetup.sql'
inside this repository and copy and paste the file contents into the query box. Execute.

5.Open the file 'dbh.inc.php' and fill in your DB credentials

6.Populate the 'userlist.json' file with your list of people

7.After all changes are made, drag all files downloaded from this repository
into the 'htdocs' folder inside your XAMPP installation directory

8.All done! (default credentials are username:'admin', password:'letmein')

## To-do
1.Make UI prettier

2.Add student searching

3. Add password recovery system

4. Add queueing system
