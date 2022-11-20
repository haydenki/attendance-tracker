<?php
require_once 'requireadmin.inc.php';

if (!isset($_POST["submit"]))
{
	header("location: index.php");
	exit();
}

$username = $_POST["username"];
$email = $_POST["email"];
$password = $_POST["password"];
$password_repeat = $_POST["passwordrepeat"];
$role = $_POST["role"];

//validate CSRF token 
$csrf_token = hash_hmac('sha256', $_SESSION['username'], $_SESSION['key']);
if (!hash_equals($csrf_token, $_POST['csrf']))
{
	die('CSRF token failed.');
}

require_once 'dbh.inc.php';
require_once 'functions.inc.php';


if(empty_input_signup($username, $email, $password, $password_repeat) !== false)
{
	header("location: index.php?error=emptyinput");
	exit();
}

if(invalid_username($username) !== false)
{
	header("location: index.php?error=username");
	exit();
}

if(invalid_email($email) !== false)
{
	header("location: index.php?error=email");
	exit();
}

if(invalid_role($role) !== false)
{
	header("location: index.php?error=invalidrole");
	exit();	
}

if(password_match($password, $password_repeat) !== false)
{
	header("location: index.php?error=pwdmatch");
	exit();
}

if(username_exists($conn, $username, $email) !== false)
{
	header("location: index.php?error=usernametaken");
	exit();
}

create_user($conn, $username, $email, $password, $role);