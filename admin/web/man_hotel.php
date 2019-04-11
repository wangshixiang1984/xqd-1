<?php
require '../../conf/log.class.php';
if(!isset($_SESSION[USER])){
	header("Location:../login/login.php");exit;
}else{
	$pageid=isset($_GET["id"]) ? intval($_GET["id"]) : 0;
	$pageid=$pageid==0?1:$pageid;
	$sql="select * from hotel";
	$xcap_arr=$lg->select_arr2($sql);
	$xcap_num=count($xcap_arr);
	if(isset($_POST["set_px"])){
		$pxnum=$_POST["px"];
		$id=$_POST["idnum"];
		$sql="update hotel set px='$pxnum' where id='$id'";
		if($lg->imd($sql)){
			echo $lg->outalert("设定成功");;
		}else{
			echo $lg->outalert("设定出错啦!再试试");			
		}
	}
?>	
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link type="text/css" rel="stylesheet" href="../../css/common.css" />
<link type="text/css" rel="stylesheet" href="../../css/admin.css" />
<script type="text/javascript" src="../../js/ajax.js"></script>
<title>行程安排管理</title>
</head>

<body>

<table class="admin_mhover" style="width:100%;">
	<thead class="admin_th"><tr><td style="width:10%">酒店名称</td><td style="width:10%">图片</td><td style="width:5%">价格</td><td style="width:5%">地址</td><td style="width:15%">所属城市</td><td style="width:20%">操作|<input type="button" value="添加酒店" onclick="window.location.href='add_hotel.php'" /></td></tr></thead>
	<tbody>
		<?php
		
		for($i=0;$i<$xcap_num;$i++){			
			
		?>
		<tr>
			<td><?php echo $xcap_arr[$i]["title"];?></td>
			<td><img src="<?php echo PATH_IMG.$xcap_arr[$i]["img_path"];?>" /></td>
			<td><?php echo $xcap_arr[$i]["price"];?></td>
			<td><?php echo $xcap_arr[$i]["address"];?></td>
			<td><?php echo $xcap_arr[$i]["city"];?></td>
			<td>
				<input type="button" value="修改" onclick="window.location.href='modify_hotel.php?id=<?php echo $xcap_arr[$i]["id"];?>'" />
				<input type="button" value="删除"  onclick="if(!confirm('确定删除吗?')) return true; else window.location.href='del_hotel.php?id=<?php echo $xcap_arr[$i]["id"];?>';" />
		
				<!-- <input type="button" value="<?php echo $hide;?>" onclick="window.location.href='set_hide.php?id=<?php echo $xcap_arr[$i]["id"]."&hidenum=".$hidenum;?>'" />
				<input type="button" onclick="window.location.href='set_history.php?id=<?php echo $xcap_arr[$i]["id"];?>&pageid=<?php echo $pageid;?>'" value="设置过期" /> -->
			</td>
			<!-- <td><input type="text" size=3 name="px" value="<?php echo $xcap_arr[$i]["px"];?>" onchange="process(this.value,<?php echo $xcap_arr[$i]["id"];?>,'out')" /> </td> -->
		</tr>
		<?php }?>
	
	</tbody>

</table>
<div id="out"></div>
</body>
</html>

<?php	
}
?>