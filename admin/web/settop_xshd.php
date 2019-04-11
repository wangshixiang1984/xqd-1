<?php
require '../../conf/log.class.php';
if(!isset($_SESSION[USER])){
	header("Location:../login/login.php");exit;
}else{
	$topnum=intval($_GET["top"]);
	$id=intval($_GET["id"]);
	$sql="update xshd set istop='$topnum' where id='$id'";
	if($lg->imd($sql)) {
		header("Location:man_xshd.php"); exit();
	}else{
		$strout=$lg->outalert("出错啦,请重新试一下");
		$strout.=$lg->gopage("ma_xshd.php");
		echo $strout;
	}
}
?>