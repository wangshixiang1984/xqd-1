<?php
require '../../conf/log.class.php';
if(!isset($_SESSION[USER])){
	header("Location:../login/login.php");exit;
}else{
	$id=intval($_GET["id"]);
	$sql="delete from video where id='$id'";
	if($lg->imd($sql)){
		header("Location:man_video.php");
	}else{
		echo $lg->outalert("删除出错啦!再试试");
		echo $lg->gopage("man_video.php");
	}
}