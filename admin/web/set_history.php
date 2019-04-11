<?php
require '../../conf/log.class.php';
if(!isset($_SESSION[USER])){
	header("Location:../login/login.php");exit;
}else{
	$id=intval($_GET["id"]);
	$page=intval($_GET["page"]);
	$pageid = intval($_GET["pageid"]);
	$pass = intval($_GET['pass']);
	$sql="update xcap set passed='$pass' where id='$id'";;
	if($lg->imd($sql)){
		header("Location:man_xcap.php?page={$page}&id={$pageid}");
	}else{
		echo $lg->outalert("设置历史线路出错啦!再试试");
		echo $lg->gopage("man_xcap.php?page={$pageid}&id={$pageid}");
	}
}