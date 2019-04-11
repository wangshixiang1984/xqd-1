<?php
require '../../conf/log.class.php';
if(!isset($_SESSION[USER])){
	header("Location:../login/login.php");exit;
}else{
	$id=intval($_GET["id"]);
	$sql="delete from car where id='$id'";
	if($lg->imd($sql)){
		header("Location:man_car.php");
	}else{
		echo $lg->outalert("删除出错了，请重试！");
		echo $lg->gopage("man_car.php");
	}
}