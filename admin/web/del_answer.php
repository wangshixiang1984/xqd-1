<?php
require '../../conf/log.class.php';
if(!isset($_SESSION[USER])){
	header("Location:../login/login.php");exit;
}
$arrs=$_GET["p_arr"];
$str=implode(",",$arrs);
$str=substr($str,1);
$sql="delete from qas where id in({$str})";
if($lg->imd($sql)) $strinfo="删除成功"; else $strinfo="删除异常，请重试";
$arr=array("info"=>$strinfo);
echo json_encode($arr);