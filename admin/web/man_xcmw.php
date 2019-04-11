<?php
require '../../conf/log.class.php';
if(!isset($_SESSION[USER])){
	header("Location:../login/login.php");exit;
}else{
	$sql="select * from xcmw order by time desc";
	$hysy_arr=$lg->select_arr2($sql);
	$hysy_num=count($hysy_arr);
	
?>	
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link type="text/css" rel="stylesheet" href="../../css/common.css" />
<link type="text/css" rel="stylesheet" href="../../css/admin.css" />
<title>行程安排管理</title>
</head>

<body>
<table class="admin_mhover" style="width:100%;">
	<thead class="admin_th"><tr><td style="width:10%">主题图片</td><td style="width:60%">标题</td><td style="width:20%">操作|<input type="button" value="添加文章" onclick="window.location.href='add_xcmw.php'" /></td></tr></thead>
	<tbody>
		<?php 
		for($i=0;$i<$hysy_num;$i++){
		?>
		<tr>
			<td><img src="<?php echo PATH_IMG.$hysy_arr[$i]["img_path"];?>" /></td>
			<td><div  style="height:30px;"><a href="../../xcmw/xcmw.php?id=<?php echo $hysy_arr[$i]["id"];?>" target="_blank"><?php echo $hysy_arr[$i]["title"];?></a></div><div><?php echo $hysy_arr[$i]["des"];?></div></td>
			<td>
				<input type="button" value="修改" onclick="window.location.href='modify_xcmw.php?id=<?php echo $hysy_arr[$i]["id"];?>'" />
				<input type="button" value="删除"  onclick="if(!confirm('确定删除吗?')) return true; else window.location.href='del_xcmw.php?id=<?php echo $hysy_arr[$i]["id"];?>';" />
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