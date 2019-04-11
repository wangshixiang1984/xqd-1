<?php
require '../../conf/op.class.php';
if(!isset($_SESSION[USER])){
	header("Location:../login/login.php");exit;
}else{
	$pageid=isset($_GET["id"]) ? intval($_GET["id"]) : 0;
	$pageid=$pageid==0?1:$pageid;
	$sql="select * from car";
	$pagination = $funcop->split_page(15, 5, $sql);
	$xcap_arr=$lg->select_arr2($pagination[0]);
	$pagination_page = $pagination[1];
	$xcap_num=count($xcap_arr);
	if(isset($_POST["set_px"])){
		$pxnum=$_POST["px"];
		$id=$_POST["idnum"];
		$sql="update car set px='$pxnum' where id='$id'";
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
<title>租车管理</title>
</head>

<body>

<table class="admin_mhover" style="width:100%;">
	<thead class="admin_th"><tr>
		<td style="width:5%">车型号</td>
		<td style="width:5%">品牌</td>
		<td style="width:5%">类型</td>
		<td style="width:10%">配置</td>
		<td style="width:5%">可乘人数</td>
		<td style="width:10%">车图片</td>
		<td style="width:5%">租车价格</td>
		<td style="width:15%">取车地址</td>
		<td style="width:15%">还车地址</td>
		<td style="width:20%">操作|<input type="button" value="添加租车信息" onclick="window.location.href='add_car.php'" /></td>
		<td>排序<span style="color:#f00;">(数字越大越靠前)</span></td></tr></thead>
	<tbody>
		<?php
		
		for($i=0;$i<$xcap_num;$i++){			
			
		?>
		<tr>
			<td><?php echo $xcap_arr[$i]["title"];?></td>
			<td><a href="#" target="_blank"><?php echo $xcap_arr[$i]["brand"];?></a></td>
			<td><a href="#" target="_blank"><?php echo $xcap_arr[$i]["typed"];?></a></td>
			<td><a href="#" target="_blank"><?php echo $xcap_arr[$i]["peizhi"];?></a></td>
			<td><a href="#" target="_blank"><?php echo $xcap_arr[$i]["peopleseat"];?></a></td>
			<td><img src="<?php echo PATH_IMG.$xcap_arr[$i]["img_path"];?>" /></td>
			<td><a href="#" target="_blank"><?php echo $xcap_arr[$i]["price"];?></a></td>
			<td><a href="#" target="_blank"><?php echo $xcap_arr[$i]["getaddress"];?></a></td>
			<td><a href="#" target="_blank"><?php echo $xcap_arr[$i]["backaddress"];?></a></td>
			<td>
				<input type="button" value="修改" onclick="window.location.href='modify_car.php?id=<?php echo $xcap_arr[$i]["id"];?>'" />
				<input type="button" value="删除"  onclick="if(!confirm('确定删除吗?')) return true; else window.location.href='del_car.php?id=<?php echo $xcap_arr[$i]["id"];?>';" />
		<?php 
		
			// <?php if($xcap_arr[$i]["hide"]==0) {
			// 	$hide="隐藏"; 
			// 	$hidenum=1;
			// }else{
			// 	$hide="显示";
			// 	$hidenum=0;
			// }?>
				<!-- <input type="button" value="<?php echo $hide;?>" onclick="window.location.href='set_hide.php?id=<?php echo $xcap_arr[$i]["id"]."&hidenum=".$hidenum;?>'" />
				<input type="button" onclick="window.location.href='set_history.php?id=<?php echo $xcap_arr[$i]["id"];?>&pageid=<?php echo $pageid;?>'" value="设置过期" /> -->
			</td>
			<td><input type="text" size=3 name="px" value="<?php echo $xcap_arr[$i]["px"];?>" onchange="process(this.value,<?php echo $xcap_arr[$i]["id"];?>,'out')" /> </td>
		</tr>
		<?php }
		
		?>
	
	</tbody>

</table>
<div id="out"></div>
<div class="next_page"><?Php echo $pagination_page; ?></div>
</body>
</html>

<?php	
}
?>