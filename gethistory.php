<?php

$lines = file('logs.txt');
$count = 0;
 
for($x=0; $x<sizeof($lines);$x++)
{
	print_r($lines[$x]."<br>");
}
?>