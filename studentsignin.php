<?php 

// Master key check
$master_key = preg_replace('/\n/','my', file_get_contents("MASTERKEY"));
if($_POST['key'] != $master_key)
{
	echo($_POST['key']."\n\n".$master_key);
	die();
}


// Read the JSON file 
$json = file_get_contents('userlist.json');
  
// Decode the JSON file
$json_data = json_decode($json,true);

// Open log file
$date = new DateTime();
$logfilename = $date->format('Y-m-d').'.txt';
$logfile = fopen($logfilename, "a");

for($x = 0; $x < sizeof($json_data["userlist"]); $x++)
{
	if($json_data["userlist"][$x]["identifier"] == $_POST['uid'])
	{
		if($json_data["userlist"][$x]["checked_in"] == 0)
		{
			$json_data["userlist"][$x]["time_in"] = time();
			$json_data["userlist"][$x]["checked_in"] = 1;
			
			// For logging purposes
			$appstring = "[".$date->format('Y-m-d')."] ".$json_data["userlist"][$x]["name"]." signed in.\n";
			fwrite($logfile, $appstring);
		}
		else
		{
			$json_data["userlist"][$x]["checked_in"] = 0;
			$foundname = $json_data["userlist"][$x]["name"];
			// For logging purposes
			$appstring = "[".$date->format('Y-m-d')."] ".$json_data["userlist"][$x]["name"]." signed out.\n";
			fwrite($logfile, $appstring);
		}
	}
}

fclose($logfile);

 

$userDB = fopen("userlist.json", "w"); 
fwrite($userDB, json_encode($json_data));
fclose($userDB);