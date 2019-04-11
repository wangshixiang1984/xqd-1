<?php
require '../../conf/log.class.php';
if(!isset($_SESSION[USER])){
	header("Location:../login/login.php");exit;
}
$id=intval($_GET["id"]);
$sql="select * from dzxl where id='$id'";
$arr=$lg->select_arr1($sql);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link type="text/css" rel="stylesheet" href="../../css/common.css" />
<link type="text/css" rel="stylesheet" href="../../css/admin.css" />

<script src="../../js/jquery.min.js"></script>
<title>定制线路管理</title>
</head>

<body>
<style>
.admin_dzxl tr td:hover{background:#eee;}
</style>
<div style="height:40px; text-align:right; margin-right:100px; line-height:40px;"><a href="man_dzxl.php">返回上一级</a></div>
<table class="admin_dzxl" style="width:100%;">
<tr>
	<td style="width:15%; background:#e0e0e0;">姓名</td><td style="width:30%;"><?php echo $arr["user"];?></td>
	<td style="width:15%; background:#e0e0e0;">性别</td><td style="width:30%;"><?php echo $arr["sex"];?></td>
</tr>
<tr>
	<td style="width:15%; background:#eee;">电话</td><td style="width:30%;"><?php echo $arr["tel"];?></td>
	<td style="width:15%; background:#eee;">出行天数</td><td style="width:30%;"><?php echo $arr["playday"]; echo '，&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$arr["daysconfirm"];?></td>
</tr>
<tr>
	<td style="width:15%; background:#e0e0e0;">出发地</td><td style="width:30%;"><?php echo $arr["startplace"];?></td>
	<td style="width:15%; background:#e0e0e0;">目的地</td><td style="width:30%;"><?php echo $arr["endplace"];?></td>
</tr>
<tr>
	<td style="width:15%; background:#eee;">出发日期</td><td style="width:30%;">年：<?php echo $arr["yeard"];?> ，月：<?php echo $arr["monthd"];?> ，日：<?php echo $arr["dayd"];?></td>
	<td style="width:15%; background:#eee;">出行预算</td><td style="width:30%;"><?php echo $arr["money"];?></td>
</tr>
<tr>
	<td style="width:15%; background:#e0e0e0;">出行人数</td><td style="width:30%;"><?php echo $arr["man"];?></td>
	<td style="width:15%; background:#e0e0e0;">成人/儿童</td><td style="width:30%;"><?php echo $arr["adult"]."/".$arr["child"];?></td>
</tr>
<tr>
	<td style="width:15%; background:#eee;">护照签发地</td><td colspan="3"><?php echo $arr["pass"];?></td>	
</tr>
<tr>
	<td style="width:15%; background:#e0e0e0;">住宿标准</td><td style="width:30%;"><?php echo $arr["hotel"];?></td>
	<td style="width:15%; background:#e0e0e0;">用餐标准</td><td style="width:30%;"><?php echo $arr["eat"]."/".$arr["child"];?></td>
</tr>
<tr>
	<td style="width:15%; background:#eee;">领队要求</td><td colspan="3"><?php echo $arr["leader"];?></td>	
</tr>
<tr>
	<td style="width:15%; background:#e0e0e0;">回复时间</td><td style="width:30%;"><?php echo $arr["time"];?></td>
	<td style="width:15%; background:#e0e0e0;">优先回复</td><td style="width:30%;"><?php echo $arr["reply"];?></td>
</tr>
<tr>
	<td style="width:15%; background:#eee;">定制需求</td><td colspan="3"><?php echo $arr["content"];?></td>	
</tr>
</table>
</body>
</html>