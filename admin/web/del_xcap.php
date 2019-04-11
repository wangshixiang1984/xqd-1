<?php
require '../../conf/log.class.php';
if(!isset($_SESSION[USER])){
	header("Location:../login/login.php");exit;
}else{
	$id=intval($_GET["id"]);
	$sql="delete from xcap where id='$id'";
	if($lg->imd($sql)){
		header("Location:man_xcap.php");
	}else{
		echo $lg->outalert("É¾³ý³ö´íÀ²!ÔÙÊÔÊÔ");
		echo $lg->gopage("man_xcap.php");
	}
}