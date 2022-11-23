<?php
require_once 'inc/requiresession.inc.php';

if(empty($_GET["date"]))
{
	die();
}

$filename = 'logs/'.$_GET["date"].".txt";

if(!file_exists($filename))
{
	echo "No history is available for this date.";
	die();
}
$lines = file($filename);
$count = 0;

for($x=0; $x<sizeof($lines);$x++)
{
	print_r($lines[$x]."<br>");
}
?>