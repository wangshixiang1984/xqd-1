<?php
require '../../conf/log.class.php';
if(!isset($_SESSION[USER])){
	header("Location:../login/login.php");exit();
}else{
	header("Content-Type: text/html");
	$id=intval($_GET["id"]);
	$pxnum=intval($_GET["pxnum"]);
	$sql="update xcap set px='$pxnum' where id='$id'";
	if($lg->imd($sql)){
		echo '<script type="text/javascript">alert("设置成功!");</script>';
	}else{
		echo $lg->outalert("设置出错啦!再试试");
	}
}