<?php
require '../../conf/log.class.php';
if(!isset($_SESSION[USER])){
	header("Location:../login/login.php");exit;
}else{
	$id=intval($_GET["id"]);
	$pageid=intval($_GET["pageid"]);
	$sql="update xcap set passed=0 where id='$id'";
	if($lg->imd($sql)){
		header("Location:man_history.php?pageid='{$pageid}'");
	}else{
		echo $lg->outalert("设置历史线路出错啦!再试试");
		echo $lg->gopage("man_history.php?pageid='{$pageid}'");
	}
}