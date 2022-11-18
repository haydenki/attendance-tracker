<?php
	if(!isset($_SESSION))
	{
		session_start();
	}
	
	if(!isset($_SESSION["uid"]))
	{
		header("location: index.php");
		exit();
	}