<?php
require '../../conf/log.class.php';
if(!isset($_SESSION[USER])){
	header("Location:../login/login.php");exit;
}else{

	$type = $_POST['type'];
	$response = [];
	if($type == 'add'){
		$id = isset($_POST['xcapid']) ? intval($_POST['xcapid']) : 0;
		$title = $_POST['title'];
		$xcdes = $_POST['xcdes'];
		$xcpics = $_POST['xcpics'];
		$xcdinner = $_POST['xcdinner'];
		$xchotel = $_POST['xchotel'];
		$whichday = intval($_POST['days']);
		$res = $lg->imd("insert into xcdes (daytitle, daydes, daypic, dinner, whichday, hotel, xcapid) values 
		('$title', '$xcdes', '$xcpics', '$xcdinner', '$whichday', '$xchotel', '$id')");
		if($res){
			$response = ['code' => 0, 'data' => $res];
		}else{
			$response = ['code' => 1, 'data' => '添加遇到问题！请重试'];
		}
	}
	if($type == 'update'){
		$desid = isset($_POST['desid']) ? intval($_POST['desid']) : 0;
		$title = $_POST['title'];
		$xcdes = $_POST['xcdes'];
		$xcpics = $_POST['xcpics'];
		$xcdinner = $_POST['xcdinner'];
		$xchotel = $_POST['xchotel'];
		$whichday = intval($_POST['days']);
		$res = $lg->imd("update xcdes set daytitle='$title', daydes='$xcdes', daypic='$xcpics', dinner='$xcdinner',
		hotel='$xchotel', whichday='$whichday' where id='$desid'");
		if($res){
			$response = ['code' => 0, 'data' => $res];
		}else{
			$response = ['code' => 1, 'data' => '添加遇到问题！请重试'];
		}

	}
	if($type == 'delete'){
		$desid = isset($_POST['desid']) ? intval($_POST['desid']) : 0;
		$res = $lg->imd("delete from xcdes where id='$desid'");
		if($res){
			$response = ['code' => 0, 'data' => $res];
		}else{
			$response = ['code' => 1, 'data' => '添加遇到问题！请重试'];
		}
	}
	exit(json_encode($response, JSON_UNESCAPED_UNICODE));
}
