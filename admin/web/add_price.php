<?php
require '../../conf/log.class.php';
if($_POST){
	$type = $_POST['type'];
	if($type == 'add'){
		$price = $_POST['price'];
		$boyprice = $_POST['boyprice'];
		$date = $_POST['godate'];
		$leftPeople = $_POST['leftpeople'];
		$xcapid = intval($_POST['xcapid']);
		$minprice = intval($_POST['minprice']);
	}else{
	
		$id = intval($_POST['id']);
	}
	if(isset($date)){
		$gomonth = date('n', strtotime($date));
	}
	if($type == 'add'){
		//添加
		$sql = "insert into xcdate (godate, gomonth, xcapid, leftpeople, price, boyprice, minprice) values 
		('$date', '$gomonth', '$xcapid', '$leftPeople', '$price', '$boyprice', '$minprice')";
	}
	if($type == 'delete'){
		//删除
		$sql = "delete from xcdate where id='$id'";
	}
	
	$num = $lg->imd($sql);
	if($num){
		exit(json_encode(['code' => 0]));
	}else{
		exit(json_encode(['code' => 1]));
	}
	
}