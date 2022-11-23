<?php
	if(!isset($_SESSION))
	{
		session_start();
	}
	
	if($_SESSION["role"] != "admin")
	{
		die("Insufficient permissions.");
	}