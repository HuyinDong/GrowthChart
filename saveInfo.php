<?php
	include("global.php");
	print_r($_SESSION['email']);
	if(isset($_SESSION['email'])){
	$ktype = $_GET['ktype'];
	$birthday = $_GET['birthday'];
	$gender = $_GET['gender'];
	$weight = $_GET['weight'];
	$weightounce = $_GET['weightounce'];
	$stature = $_GET["stature"];
	$hc = $_GET['hc'];
	$time = strtotime($birthday);
	$birthday = date('Y-m-d',$time);
	
	$email = $_SESSION['email'];

	$sql="select * from users where `email`='".$email."'";
	$query=mysql_query($sql);
	$row=mysql_fetch_array($query);
	$uid = $row['uid'];
    $sql1="INSERT INTO `basic_info`(`ktype`, `birth`, `gender`, `weight`, `weightounce`, `stature`, `hc`, `uid`) VALUES (
	'".$ktype."','".$birthday."','".$gender."','".$weight."','".$weightounce."','".$stature."','".$hc."','".$uid."')";
	$query1=mysql_query($sql1);   
	//echo "<script>alert("the first insert");</script>";
	$lastRun = mysql_insert_id();
	$_SESSION['last'] = $lastRun;
	
	}
?>

