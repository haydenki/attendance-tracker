<?php

require_once 'inc/requiresession.inc.php';

if(!isset($_GET['id']))
{
	header("location: index.php");
	exit();
}
// Read the JSON file 
$json = file_get_contents('userlist.json');
  
// Decode the JSON file
$json_data = json_decode($json,true);

for($x = 0; $x < sizeof($json_data["userlist"]); $x++)
{
	if($json_data["userlist"][$x]["identifier"] == $_GET['id'])
	{
		$json_data["userlist"][$x]["time_in"] = time();
		$json_data["userlist"][$x]["checked_in"] = 1;
		// For logging purposes
		$studentsname = $json_data["userlist"][$x]["name"];
	}
}

$userDB = fopen("userlist.json", "w"); 
fwrite($userDB, json_encode($json_data));
fclose($userDB);

// Open log file
$date = new DateTime();
$logfilename = 'logs/'.$date->format('Y-m-d').'.txt';
$logfile = fopen($logfilename, "a");

$appstring = "[".$date->format('Y-m-d H:i:s')."] User '<b>".$_SESSION["username"]."</b>' manually signed ".$studentsname." in.\n";
fwrite($logfile, $appstring);

header("location: index.php?action=signed");
exit();