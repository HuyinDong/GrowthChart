<?php
include("global.php");
	
	$sql="select * from users where `email`='".$_GET['email']."'";
	$query=mysql_query($sql);
	$row=mysql_fetch_array($query);
 	if(is_null($row['email'])){	
	$sql1="insert into users (`email`) values ('".$_GET['email']."')";
	$query1=mysql_query($sql1);
	}	
	$_SESSION['email'] = $_GET['email'];
	
?>
