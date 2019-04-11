<?php
require '../../conf/log.class.php';
if(!isset($_SESSION[USER])){
	header("Location:../login/login.php");exit;
}else{
	$sql="select * from xshd order by id desc";
	$hysy_arr=$lg->select_arr2($sql);
	$hysy_num=count($hysy_arr);
	
?>	
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link type="text/css" rel="stylesheet" href="../../css/common.css" />
<link type="text/css" rel="stylesheet" href="../../css/admin.css" />
<title>线上活动管理</title>
</head>

<body>
<table class="admin_mhover" style="width:100%;">
	<thead class="admin_th"><tr><td style="width:60%">标题</td><td style="width:40%">操作|<input type="button" value="发布活动" onclick="window.location.href='add_xshd.php'" /></td></tr></thead>
	<tbody>
		<?php 
		for($i=0;$i<$hysy_num;$i++){
		?>
		<tr>
			
			<td><a href="../../gywm/hdgg.php?id=<?php echo $hysy_arr[$i]['id'];?>" target="_blank"><?php echo $hysy_arr[$i]["title"];?></td>
			<td>
				<input type="button" value="修改" onclick="window.location.href='modify_xshd.php?id=<?php echo $hysy_arr[$i]["id"];?>'" />
				<input type="button" value="删除"  onclick="if(!confirm('确定删除吗?')) return true; else window.location.href='del_xshd.php?id=<?php echo $hysy_arr[$i]["id"];?>';" />
				<?php if($hysy_arr[$i]["istop"]==0){?>
				<input type="button" value="置顶" onclick="window.location.href='settop_xshd.php?id=<?php echo $hysy_arr[$i]["id"]."&top=1";?>'"/>
				<?php }else{?>
				<input type="button" value="取消置顶" onclick="window.location.href='settop_xshd.php?id=<?php echo $hysy_arr[$i]["id"]."&top=0";?>'"/>
				<?php }?>
			</td>
		</tr>
		<?php }?>
	</tbody>

</table>
</body>
</html>

<?php	
}
?>