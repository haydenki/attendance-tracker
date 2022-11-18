<?php

if (!isset($_POST["submit"]))
{
	header("location: login.php");
	exit();
}

$username = $_POST["username"];
$email = $_POST["email"];
$password = $_POST["password"];
$password_repeat = $_POST["passwordrepeat"];

require_once 'dbh.inc.php';
require_once 'functions.inc.php';

if(empty_input_signup($username, $email, $password, $password_repeat) !== false)
{
	header("location: login.php?error=emptyinput");
	exit();
}

if(invalid_username($username) !== false)
{
	header("location: login.php?error=username");
	exit();
}

if(invalid_email($email) !== false)
{
	header("location: login.php?error=email");
	exit();
}

if(password_match($password, $password_repeat) !== false)
{
	header("location: login.php?error=pwdmatch");
	exit();
}

if(username_exists($conn, $username, $email) !== false)
{
	header("location: login.php?error=usernametaken");
	exit();
}

create_user($conn, $username, $email, $password);