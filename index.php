<?php
  
// Load user DB
$json = file_get_contents('userlist.json');
  
// Decode the JSON file
$json_data = json_decode($json,true);
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="panel.css"
</head>
<body>

<h2>Library Management Panel</h2>
<p>Welcome, <b>Admin</b>!</p>

<div class="tab">
  <button class="tablinks" onclick="openCity(event, 'Overview')">Overview</button>
  <button class="tablinks" onclick="openCity(event, 'History')">History</button>
  <button class="tablinks" onclick="openCity(event, 'Logout')">Logout</button>
</div>

<div id="Overview" class="tabcontent">
  <?php
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
</div>

<div id="History" class="tabcontent">
  <p>History view is not available yet.</p> 
</div>

<div id="Logout" class="tabcontent">
  <h3>Logout</h3>
  <p></p>
</div>

<script>
function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}
</script>

<script>
function refresh() {
const Http = new XMLHttpRequest();
const url="getoverview.php";
Http.open('GET', url);
Http.send();

Http.onreadystatechange = (e) => {
  if (document.body.innerHTML != Http.responseText && Http.responseText != '')
  {
  document.getElementById("Overview").innerHTML = Http.responseText
  }
}}

setInterval(refresh, 50);


</script>



</body>
</html> 
