<?php 
	session_start();
	
	if(isset($_SESSION["uid"]))
	{
		require_once 'panel.php';
	}
	else
	{
		require_once 'login.php';
	}