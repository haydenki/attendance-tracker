<?php
require_once 'inc/requiresession.inc.php';

// Turns "178566 seconds" into "49 hours, 6 minutes"
function pretty_time($n)
{
	$result;
	if($n < 60)
	{
		return $n." seconds ago";
	}
	else if($n > 60 && $n < 3600)
	{
		$minutes = (int)($n / 60);
		$seconds = (int)($n - $minutes*60);
		return $minutes." minutes ago, ".$seconds." seconds ago";
	}
	else if($n > 3600)
	{
		$hours = (int)($n / 3600);
		$minutes = (int)(($n - $hours*3600) / 60);
		$seconds = (int)($n - $hours*3600 - $minutes*60);
		return $hours. " hours ago, ".$minutes." minutes ago, ".$seconds." seconds ago";
	}
}

// Read the JSON file 
$json = file_get_contents('userlist.json');
  
// Decode the JSON file
$json_data = json_decode($json,true);
 
// Display checked in list
echo "<h1>Checked in:</h1><table>";

for($x = 0; $x < sizeof($json_data["userlist"]); $x++)
{
	if($json_data["userlist"][$x]["checked_in"] == 1)
	{
		print_r("<tr>");
		//print_r("<td><img width='64px' height='64px' src='https://t4.ftcdn.net/jpg/00/64/67/63/360_F_64676383_LdbmhiNM6Ypzb3FM4PPuFP9rHe7ri8Ju.jpg'></td>");
		print_r("<td><img width='64px' height='72px' src='img/students/".$json_data["userlist"][$x]["identifier"].".jpeg'></td>");
		print_r("<td><b>".$json_data["userlist"][$x]["name"]."</b> - ".pretty_time((time() - $json_data["userlist"][$x]["time_in"]))." - <a href='signout.php?id=".$json_data["userlist"][$x]["identifier"]."'>Sign out</a>");
		//print_r("<td><a href='#'>Sign out</a></td>");
		print_r("</tr>");
	}
}

echo "</table><br>";

// Display checked out list
echo "<h1>Checked out:</h1><ul>";

for($x = 0; $x < sizeof($json_data["userlist"]); $x++)
{
	if($json_data["userlist"][$x]["checked_in"] == 0)
	{
		print_r("<li>".$json_data["userlist"][$x]["name"]." - <a href='signin.php?id=".$json_data["userlist"][$x]["identifier"]."'>Sign in</a></li>");
	}
}

echo "</ul><br>";


  
?>