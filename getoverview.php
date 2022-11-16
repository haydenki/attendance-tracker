<script>
function refresh() {
const Http = new XMLHttpRequest();
const url=document.location;
Http.open('GET', url);
Http.send();

Http.onreadystatechange = (e) => {
  if (document.body.innerHTML != Http.responseText && Http.responseText != '')
  {
  document.body.innerHTML = Http.responseText
  }
}}

setInterval(refresh, 50);


</script>

<?php
  
// Read the JSON file 
$json = file_get_contents('userlist.json');
  
// Decode the JSON file
$json_data = json_decode($json,true);
 
// Display checked in list
echo "<h1>Checked in:</h1><ul>";

for($x = 0; $x < 2; $x++)
{
	if($json_data["userlist"][$x]["checked_in"] == 1)
	{
		print_r("<li>".$json_data["userlist"][$x]["name"]." - ".$json_data["userlist"][$x]["time_in"]." seconds ago");

	}
}

echo "</ul><br>";

// Display checked out list
echo "<h1>Checked out:</h1><ul>";

for($x = 0; $x < 2; $x++)
{
	if($json_data["userlist"][$x]["checked_in"] == 0)
	{
		print_r("<li>".$json_data["userlist"][$x]["name"]."</li>");
	}
}

echo "</ul><br>";


  
?>