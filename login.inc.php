<?php 

if (!isset($_POST["submit"]))
{
	header("location: login.php");
	exit();
}

$username = $_POST["username"];
$password = $_POST["password"];

require_once 'dbh.inc.php';
require_once 'functions.inc.php';

if(empty_input_login($username, $password) !== false)
{
	header("location: login.php?error=emptyinput");
	exit();
}

login_user($conn, $username, $password);