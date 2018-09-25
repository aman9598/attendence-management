<?php
$mysql_host='localhost';
$mysql_user='root';
$mysql_password='';
$link=mysqli_connect($mysql_host,$mysql_user,$mysql_password,'attendence_system');
if(!$link)
{
	echo "connection error";
}