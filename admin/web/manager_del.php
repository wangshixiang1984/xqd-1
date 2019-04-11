<?php
require '../../conf/log.class.php';
if(!isset($_SESSION[USER])){
	header("Location:../login/login.php");exit;
}else{
	$id=intval($_GET["id"]);
	$sql="delete from admin where id='$id'";
	if($lg->imd($sql)){
		header("Location:manager.php");
	}else{
		echo $lg->outalert("删除出错啦!");
		echo $lg->gopage("manager.php");
	}
}