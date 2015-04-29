<?php
	include("global.php");
	print_r($_SESSION['email']);
	if(isset($_SESSION['email'])){
	$bmi = $_GET['bmi'];
	$bmi_per = $_GET['bmi_per'];
	$hc_per = $_GET['hc_per'];
	$wfa_per = $_GET['wfa_per'];
	$lfa_per = $_GET['lfa_per'];
	
	$rid= $_SESSION['last'];
    print_r($rid);
	//echo "<script>alert("the second inserts");</script>";
	$sql1="INSERT INTO `record`(`bmi`, `bmi_per`, `hc_per`, `wfa_per`, `lfa_per`, `recordDate`, `bid`) VALUES (
	'".$bmi."','".$bmi_per."','".$hc_per."','".$wfa_per."','".$lfa_per."', now() , '".$rid."')";
	echo $sql1;
	$query1=mysql_query($sql1);      

	}
?>
