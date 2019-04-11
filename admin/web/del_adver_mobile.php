<?php
require '../../conf/log.class.php';
if(!isset($_SESSION[USER])){
	header("Location:../login/login.php");exit;
}else{
	$page="right.php";
	$id=intval($_GET["id"]);
	$sql="delete from adver where id='$id'";
	if($lg->imd($sql)){
		header("Location:right.php");
	}else{
		echo $lg->outalert("删除错误!");
		echo $lg->gopage($page);
	}
	
}
?>