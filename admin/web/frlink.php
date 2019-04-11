<?php
require '../../conf/config.inc.php';
if(!isset($_SESSION[USER])){
	header("Location:../login/login.php");exit;
}else{
	$sql="select * from frlink";
	$fr=$myop->select_arr2($sql);
	$numfr=$myop->select_num($sql);
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link type="text/css" rel="stylesheet" href="../../css/common.css" />
<link type="text/css" rel="stylesheet" href="../../css/admin.css" />
<title>无标题文档</title>
</head>

<body>
<div style="float:left;">
<table class="admin_mhover">
<thead class="admin_th"><tr><td class="w200">网站名称</td><td class="w200">链接地址</td><td>操作/<input type="button" value="添加友链" onclick="window.location.href='fr_add.php'" /></td></tr></thead>
<tbody>
	<?php 
		for($i=0;$i<$numfr; $i++){
	?>
	<tr>
		<td class="w200"><?php echo $fr[$i]["name"]?></td>
		<td class="w200"><?php echo $fr[$i]["link"]?></td>		
		<td><input type="button" value="修改" onclick="window.location.href='fr_modify.php?id=<?php echo $fr[$i]["id"];?>'" /> | 
		<input type="button" value="删除" onclick="if(confirm('你确定要删除吗')) window.location.href='fr_del.php?id=<?php echo $fr[$i]["id"];?>'; else return false;" /></td></tr>
	<?php 
		}
	?>
</tbody>
</table>
</div>
<div style="float:left; margin-left:50px;">
<table class="admin_mhover">
<thead class="admin_th"><tr><td class="w200">提问</td><td class="w200">回答</td><td>操作/<input type="button" value="添加提问" onclick="window.location.href='faq_add.php'" /></td></tr></thead>
<tbody>
	<?php 
		$sql="select * from faq";
		$faq=$myop->select_arr2($sql);
		$numfaq=$myop->select_num($sql);
		for($i=0;$i<$numfaq; $i++){
	?>
	<tr>
		<td class="w200"><?php echo $faq[$i]["ask"]?></td>
		<td class="w200"><?php echo $faq[$i]["asw"]?></td>		
		<td><input type="button" value="修改" onclick="window.location.href='faq_modify.php?id=<?php echo $faq[$i]["id"];?>'" /> | 
		<input type="button" value="删除" onclick="if(confirm('你确定要删除吗')) window.location.href='faq_del.php?id=<?php echo $faq[$i]["id"];?>'; else return false;" /></td></tr>
	<?php 
		}
	?>
</tbody>
</table>
</div>
<div style="clear:both"></div>
</body>
</html>