<?php
require '../../conf/log.class.php';
if(!isset($_SESSION[USER])){
	header("Location:../login/login.php");exit;
}
$answer=$_POST["answer"];
$answerer=$_POST["answerer"];
$id=$_POST["id"];
$time=date("Y-m-d H:i:s",time());
$sql="update qas set answer='$answer',answerer='$answerer',time='$time' where id='$id'";
if($lg->imd($sql)){
	$info=array("info"=>"回答成功");	
}else{
	$info=array("info"=>"回答异常，请重试");
}
echo json_encode($info);