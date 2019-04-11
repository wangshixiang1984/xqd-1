<?php
require '../../conf/log.class.php';
if(!isset($_SESSION[USER])){
	header("Location:../login/login.php");exit;
}else{

	
	$sql="select * from zjzx order by time desc";
	$zjzx_arr=$lg->select_arr2($sql);
	$zjzx_num=count($zjzx_arr);
	
	
?>	
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link type="text/css" rel="stylesheet" href="../../css/common.css" />
<link type="text/css" rel="stylesheet" href="../../css/admin.css" />

<title>资讯管理</title>
</head>

<body>
<table style="width:100%;">
	<thead class="admin_th"><tr><td style="width:40%">标题</td><td style="width:20%">日期</td><td>作者</td><td style="width:30%">操作|<input type="button" value="添加自驾资讯" onclick="window.location.href='add_zjzx.php'" /></td></tr></thead>
	<tbody class="admin_mhover">
		<?php 
		for($i=0;$i<$zjzx_num;$i++){
		?>
		<tr>
			<td><?php echo $zjzx_arr[$i]["title"];?></td>
			<td><?php echo $zjzx_arr[$i]["time"];?></td>
			<td><?php echo $zjzx_arr[$i]["author"];?></td>
			<td><a href="modify_zjzx.php?id=<?php echo $zjzx_arr[$i]["id"];?>">修改</a> | <a href="del_zjzx.php?id=<?php echo $zjzx_arr[$i]["id"]?>">删除</a>
		</td></tr>
		<?php }?>

	</tbody>

</table>
</body>
</html>

<?php	
}
?>