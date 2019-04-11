<?php
require '../../conf/log.class.php';
if(!isset($_SESSION[USER])){
	header("Location:../login/login.php");exit;
}else{
	$id=intval($_GET["id"]);
	$sql="update xcap set istop=1 where id='$id'";
	if($lg->imd($sql)){
		echo $lg->outalert("设置成功!");		
	}else{
		echo $lg->outalert("设置出错啦!请再试试");
	}
	echo $lg->gopage("man_xcap.php");

}