<?php
require '../../conf/log.class.php';
if(!isset($_SESSION[USER])){
	header("Location:../login/login.php");exit;
}else{
	$id=intval($_GET["id"]);
	$sql="select * from video where is_top=1";	
	if($arr=$lg->select_arr1($sql)) $is_topid=$arr["id"]; else $is_topid=false;
	$sql_set="update video set is_top=1 where id='$id'";
	if($is_topid){
		$sql="update video set is_top=0 where id='$is_topid'";
		if(!$lg->imd($sql)){
			echo $lg->outalert("出错啦！");
		}		
	}
	
	if($lg->imd($sql_set)){
		echo $lg->outalert("设置成功！");
		echo $lg->gopage("man_video.php");
	}else{
		echo $lg->outalert("设置出错啦！");
		echo $lg->gopage("man_video.php");
	}
	
}