<?php

function empty_input_signup($username, $email, $password, $password_repeat)
{
	$result;
	if(empty($username) || empty($email) || empty($password) || empty($password_repeat))
	{
		$result = true;
	}
	else
	{
		$result = false;
	}
	return $result;
}

function invalid_username($username)
{
	$result;
	if(!preg_match("/^[a-zA-Z0-9]*$/", $username))
	{
		$result = true;
	}
	else
	{
		$result = false;
	}
	return $result;
}

function invalid_email($email)
{
	$result;
	if(!filter_var($email, FILTER_VALIDATE_EMAIL))
	{
		$result = true;
	}
	else
	{
		$result = false;
	}
	return $result;
}

function invalid_role($role)
{
	$result;
	$valid_roles = array("staff","admin");
	
	if(!in_array($role, $valid_roles))
	{
		$result = true;
	}
	else
	{
		$result = false;
	}
	return $result;
}

function password_match($password, $password_repeat)
{
	$result;
	if($password !== $password_repeat)
	{
		$result = true;
	}
	else
	{
		$result = false;
	}
	return $result;
}

function username_exists($conn, $username, $email)
{
	$sql = "SELECT * FROM users WHERE username = ? OR email = ?;";
	$statement = mysqli_stmt_init($conn);
	
	if(!mysqli_stmt_prepare($statement, $sql))
	{
		header("location: login.php?error=stmtfailed");
		exit();
	}
	
	mysqli_stmt_bind_param($statement, "ss", $username, $email);
	mysqli_stmt_execute($statement);
	
	$result_data = mysqli_stmt_get_result($statement);
	
	if($row = mysqli_fetch_assoc($result_data))
	{
		return $row;
	}
	else
	{
		$result = false;
		return $result;
	}
	
	mysqli_stmt_close($statement);
}

function create_user($conn, $username, $email, $password, $role)
{
	$sql = "INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?);";
	$statement = mysqli_stmt_init($conn);
	
	if(!mysqli_stmt_prepare($statement, $sql))
	{
		header("location: ../login.php?error=stmtfailed");
		exit();
	}
	
	$hashed_password = password_hash($password, PASSWORD_DEFAULT);
	
	mysqli_stmt_bind_param($statement, "ssss", $username, $email, $hashed_password, $role);
	mysqli_stmt_execute($statement);
	mysqli_stmt_close($statement);
	header("location: ../index.php?error=none");
	exit();
}

function empty_input_login($username, $password)
{
	$result;
	if(empty($username) || empty($password))
	{
		$result = true;
	}
	else
	{
		$result = false;
	}
	return $result;
}

function login_user($conn, $username, $password)
{
	$username_exists = username_exists($conn, $username, $username);
	
	if($username_exists === false)
	{
		header("location: ../login.php?error=wronglogin");
		exit();
	}
	
	$password_hashed = $username_exists["password"];
	$check_password = password_verify($password, $password_hashed);;
	
	if($check_password === false)
	{
		header("location: ../login.php?error=wronglogin");
		exit();		
	}
	else if($check_password === true)
	{
		session_start();
		$_SESSION["uid"] = $username_exists["uid"];
		$_SESSION["username"] = $username_exists["username"];
		$_SESSION["role"] = $username_exists["role"];
		header("location: ../index.php");
		exit();	
	}
}







