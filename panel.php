<?php
require_once 'requiresession.inc.php'; 
 
// Load user DB
$json = file_get_contents('userlist.json');
  
// Decode the JSON file
$json_data = json_decode($json,true);
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="panel.css">
</head>
<body>

<h2>Library Management Panel</h2>
<?php echo '<p>Welcome, <b>'.$_SESSION["username"].'</b>!</p>' ?>

<div class="tab">
  <button class="tablinks" onclick="openCity(event, 'Overview')">Overview</button>
  <button class="tablinks" onclick="openCity(event, 'History')">History</button>
  <?php
  if($_SESSION["role"] == "admin")
  {
	echo "<button class='tablinks' onclick='openCity(event, \"Add User\")'>Add User</button>";
  }
  ?>
  <a href="logout.inc.php"><button class="tablinks" onclick="">Logout</button></a>
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
	Viewing history for:
	<input id="historyDate" type="date"></input> 
	<hr>
	<div id="history"></div>
</div>

<div id="Add User" class="tabcontent">
	<h2>Add new user</h2>
	<form action="signup.inc.php" method="post">
	<input type="text" name="username" placeholder="Username..."><br><br>
	<input type="text" name="email" placeholder="E-mail..."><br><br>
	<input type="password" name="password" placeholder="Password..."><br><br>
	<input type="password" name="passwordrepeat" placeholder="Repeat Password..."><br><br>
	Role: <select name="role">
		<option value="staff">Staff</option>
		<option value="admin">Admin</option>
	</select><br><br>
	<button type="submit" name="submit">Add User</button>
	</form>
	
	<?php
		if(isset($_GET["error"]))
		{
			if($_GET["error"] == "emptyinput")
			{
				echo "<p style='color:red'><b>Fill in all fields!</b></p>";
			}
			else if($_GET["error"] == "username")
			{
				echo "<p style='color:red'><b>Invalid username - only alphanumeric characters allowed.</b></p>";
			}
			else if($_GET["error"] == "email")
			{
				echo "<p style='color:red'><b>Please enter a valid e-mail address.</b></p>";
			}
			else if($_GET["error"] == "invalidrole")
			{
				echo "<p style='color:red'><b>Invalid role.</b></p>";
			}
			else if($_GET["error"] == "pwdmatch")
			{
				echo "<p style='color:red'><b>Passwords don't match!</b></p>";
			}
			else if($_GET["error"] == "usernametaken")
			{
				echo "<p style='color:red'><b>Username is taken.</b></p>";
			}
			else if($_GET["error"] == "stmtfailed")
			{
				echo "<p style='color:red'><b>Internal server error - something went wrong.</b></p>";
			}
			else if($_GET["error"] == "none")
			{
				echo "<p style='color:green'><b>User successfully added!</b></p>";
			}
		}
	?>
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
function refreshOverview() {
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

setInterval(refreshOverview, 1000);

function refreshHistory() {
const Http = new XMLHttpRequest();
const url="gethistory.php?date=" + document.getElementById("historyDate").value;
Http.open('GET', url);
Http.send();

Http.onreadystatechange = (e) => {
  if (document.body.innerHTML != Http.responseText && Http.responseText != '')
  {
  document.getElementById("history").innerHTML = Http.responseText
  }
}}

setInterval(refreshHistory, 50);
</script>

<?php
if(isset($_GET["error"]))
{
	echo "<script>openCity(event, 'Add User')</script>";
}
?>

</body>
</html> 
