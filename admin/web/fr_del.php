<?php
require '../../conf/log.class.php';
if(!isset($_SESSION[USER])){
	header("Location:../login/login.php");exit;
}else{
	$id=intval($_GET["id"]);
	$sql="delete from frlink where id='$id'";
	if($lg->imd($sql)){
		header("Location:frlink.php");
	}else{
		echo $lg->outalert("删除失败");
		echo "<script tyep='text/javascript'>window.history.go(-1)</script>";
	}
}