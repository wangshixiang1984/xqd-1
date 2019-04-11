<?php 
require '../../conf/log.class.php';
if(!isset($_SESSION[USER])){
	header("Location:../login/login.php");exit;
}else{
	$sql="select * from adver";
	$arr_adver=$myop->select_arr2($sql);
	$arrnum=count($arr_adver);
	$arr_topadver = [];
	$arr_gdadver = [];
	$arr_dzxladver = [];
	$arr_xcmwadver = [];
	$arr_hysyadver = [];
	$arr_newadver = [];
	$arr_gywmadver = [];
	$arr_indexAdver = [];
	$arr_dzxladver = [];
	$arr_caradver = [];
	$arr_topAdver_mobile = [];
	for($i=0;$i<$arrnum;$i++){
		switch($arr_adver[$i]["type"]){
			case 0:$arr_topadver[]=$arr_adver[$i];break; //首页
			case 1:$arr_gdadver[]=$arr_adver[$i];break; //自驾线路
			case 2:$arr_dzxladver[]=$arr_adver[$i];break; //游记鉴赏
			case 3:$arr_indexAdver[]=$arr_adver[$i];break; //首页单版
			case 4:$arr_topAdver_mobile[]=$arr_adver[$i];break; //移动
			case 5:$arr_newadver[]=$arr_adver[$i];break; //攻略
			case 6:$arr_hysyadver[]=$arr_adver[$i];break; //行程定制
			case 7:$arr_xcmwadver[]=$arr_adver[$i];break; //团队
			case 8:$arr_caradver[]=$arr_adver[$i];break; //租车
			case 9:$arr_gywmadver[]=$arr_adver[$i];break; //关于我们
		}		
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link type="text/css" rel="stylesheet" href="../../css/common.css" />
<link type="text/css" rel="stylesheet" href="../../css/admin.css" />
<title>广告管理</title>
</head>

<body>

<table class="admin_mhover" style="width:100%;">
	<thead class="admin_th"><tr><td style="width:20%">所属栏目</td><td style="width:60%">广告图片</td><td style="width:20%">操作</td></tr></thead>
		<tbody>
		<tr>
			<td><a href="../../index.php" target="_blank">《首页》</a>焦点广告</td>
			<td>
				<table><tr>
			<?php 

				$num_topadver=count($arr_topadver);
				for($i=0;$i<$num_topadver;$i++){					
			?>
				<td style="overflow:hidden"><img src="<?php echo PATH_IMG.$arr_topadver[$i]["img_path"];?>" /><br/><br />
				<?php echo $arr_topadver[$i]["title"];?><br /><br />
				<?php echo $arr_topadver[$i]["pic_link"];?><br /><br />
				<input type="button" value="删除" onclick="if(!confirm('确定删除吗?')) return true; else window.location.href='del_adver.php?id=<?php echo $arr_topadver[$i]["id"];?>';" />
				</td>
			<?php 
					}
			?>
			</tr></table>
			</td>
		<td><input type="button" name="add_adver" value="添加广告" onclick="window.location.href='add_adver_mobile.php?type=0';" /></td></tr>
		<tr>
			<td><a href="../../index.php" target="_blank">《首页移动端》</a>焦点广告</td>
			<td>
				<table><tr>
				<?php 

					$num_topadver_mobile=count($arr_topAdver_mobile);
					for($i=0;$i<$num_topadver_mobile;$i++){					
				?>
					<td style="overflow:hidden"><img src="<?php echo PATH_IMG.$arr_topAdver_mobile[$i]["img_path"];?>" /><br/><br />
					<?php echo $num_topadver_mobile[$i]["title"];?><br /><br />
					<?php echo $num_topadver_mobile[$i]["pic_link"];?><br /><br />
					<input type="button" value="删除" onclick="if(!confirm('确定删除吗?')) return true; else window.location.href='del_adver.php?id=<?php echo $arr_topAdver_mobile[$i]["id"];?>';" />
					</td>
				<?php 
					}
				?>
			</tr></table>
			</td>
			<td><input type="button" name="add_adver" value="添加广告" onclick="window.location.href='add_adver.php?type=4';" /></td></tr>
		<tr>
			<td><a href="../../index.php" target="_blank">《自驾线路》</a>焦点广告</td>
			<td>
				<table><tr>
			<?php 
				$num_gdadver=count($arr_gdadver);
				for($i=0;$i<$num_gdadver;$i++){
										
			?>
					<td style="overflow:hidden;"><img src="<?php echo PATH_IMG.$arr_gdadver[$i]["img_path"];?>" /> <br />
					<br /><?php echo $arr_gdadver[$i]["title"];?><br /><br />
					<?php echo $arr_gdadver[$i]["pic_link"];?><br /><br />
					<input type="button"  value="删除" onclick="if(!confirm('确定删除吗?')) return true; else window.location.href='del_adver.php?id=<?php echo $arr_gdadver[$i]["id"];?>';" /></td>
				<?php }?>	
				</tr>
				
				</table>
			</td>
		<td><input type="button" name="add_adver" value="添加广告" onclick="window.location.href='add_adver.php?type=1';"/></td></tr>
		<tr>
			<td><a href="../../index.php" target="_blank">《游记鉴赏》</a>焦点广告</td>
			<td>
				<table><tr>
			<?php 
				$num_dzxladver=count($arr_dzxladver);
				for($i=0;$i<$num_dzxladver;$i++){
										
			?>
					<td style="overflow:hidden;"><img src="<?php echo PATH_IMG.$arr_dzxladver[$i]["img_path"];?>" /> <br />
					<br /><?php echo $arr_dzxladver[$i]["title"];?><br /><br />
					<?php echo $arr_dzxladver[$i]["pic_link"];?><br /><br />
					<input type="button"  value="删除" onclick="if(!confirm('确定删除吗?')) return true; else window.location.href='del_adver.php?id=<?php echo $arr_dzxladver[$i]["id"];?>';" /></td>
				<?php }?>	
				</tr>
				
				</table>
			</td>
		<td><input type="button" name="add_adver" value="添加广告" onclick="window.location.href='add_adver.php?type=2';"/></td></tr>
		
		<tr>
			<td>首页单版广告</td>
			<td>
			
				<table><tr>
			<?php 
				
				$num_indexAdver=isset($arr_indexAdver)==false?0:count($arr_indexAdver);
				for($i=0;$i<$num_indexAdver;$i++){
										
			?>
					<td style="overflow:hidden;"><img src="<?php echo PATH_IMG.$arr_indexAdver[$i]["img_path"];?>" /> <br />
					<br /><?php echo $arr_indexAdver[$i]["title"];?><br /><br />
					<?php echo $arr_indexAdver[$i]["pic_link"];?><br /><br />
					<input type="button"  value="删除" onclick="if(!confirm('确定删除吗?')) return true; else window.location.href='del_adver.php?id=<?php echo $arr_indexAdver[$i]["id"];?>';" /></td>
				<?php }?>	
				</tr>
				
				</table>
			
			</td>
			<td><input type="button" value="添加广告" name="add_indexAdver" onclick="window.location.href='add_adver.php?type=3';" /></td>
		</tr>	
		<tr>
			<td>自驾攻略</td>
			<td>
			
				<table><tr>
			<?php 
				
				$num_indexAdver=isset($arr_newadver)==false?0:count($arr_newadver);
				for($i=0;$i<$num_indexAdver;$i++){
										
			?>
					<td style="overflow:hidden;"><img src="<?php echo PATH_IMG.$arr_newadver[$i]["img_path"];?>" /> <br />
					<br /><?php echo $arr_newadver[$i]["title"];?><br /><br />
					<?php echo $arr_newadver[$i]["pic_link"];?><br /><br />
					<input type="button"  value="删除" onclick="if(!confirm('确定删除吗?')) return true; else window.location.href='del_adver.php?id=<?php echo $arr_newadver[$i]["id"];?>';" /></td>
				<?php }?>	
				</tr>
				
				</table>
			
			</td>
			<td><input type="button" value="添加广告" name="add_indexAdver" onclick="window.location.href='add_adver.php?type=5';" /></td>
		</tr>	
		<tr>
			<td>定制线路</td>
			<td>
			
				<table><tr>
			<?php 
				
				$num_indexAdver=isset($arr_hysyadver)==false?0:count($arr_hysyadver);
				for($i=0;$i<$num_indexAdver;$i++){
										
			?>
					<td style="overflow:hidden;"><img src="<?php echo PATH_IMG.$arr_hysyadver[$i]["img_path"];?>" /> <br />
					<br /><?php echo $arr_hysyadver[$i]["title"];?><br /><br />
					<?php echo $arr_hysyadver[$i]["pic_link"];?><br /><br />
					<input type="button"  value="删除" onclick="if(!confirm('确定删除吗?')) return true; else window.location.href='del_adver.php?id=<?php echo $arr_hysyadver[$i]["id"];?>';" /></td>
				<?php }?>	
				</tr>
				
				</table>
			
			</td>
			<td><input type="button" value="添加广告" name="add_indexAdver" onclick="window.location.href='add_adver.php?type=6';" /></td>
		</tr>	
		<tr>
			<td>团队</td>
			<td>
			
				<table><tr>
			<?php 
				
				$num_indexAdver=isset($arr_xcmwadver)==false?0:count($arr_xcmwadver);
				for($i=0;$i<$num_indexAdver;$i++){
										
			?>
					<td style="overflow:hidden;"><img src="<?php echo PATH_IMG.$arr_xcmwadver[$i]["img_path"];?>" /> <br />
					<br /><?php echo $arr_xcmwadver[$i]["title"];?><br /><br />
					<?php echo $arr_xcmwadver[$i]["pic_link"];?><br /><br />
					<input type="button"  value="删除" onclick="if(!confirm('确定删除吗?')) return true; else window.location.href='del_adver.php?id=<?php echo $arr_xcmwadver[$i]["id"];?>';" /></td>
				<?php }?>	
				</tr>
				
				</table>
			
			</td>
			<td><input type="button" value="添加广告" name="add_indexAdver" onclick="window.location.href='add_adver.php?type=7';" /></td>
		</tr>	
		<tr>
			<td>租车</td>
			<td>
			
				<table><tr>
			<?php 
				
				$num_indexAdver=isset($arr_caradver)==false?0:count($arr_caradver);
				for($i=0;$i<$num_indexAdver;$i++){
										
			?>
					<td style="overflow:hidden;"><img src="<?php echo PATH_IMG.$arr_caradver[$i]["img_path"];?>" /> <br />
					<br /><?php echo $arr_caradver[$i]["title"];?><br /><br />
					<?php echo $arr_caradver[$i]["pic_link"];?><br /><br />
					<input type="button"  value="删除" onclick="if(!confirm('确定删除吗?')) return true; else window.location.href='del_adver.php?id=<?php echo $arr_caradver[$i]["id"];?>';" /></td>
				<?php }?>	
				</tr>
				
				</table>
			
			</td>
			<td><input type="button" value="添加广告" name="add_indexAdver" onclick="window.location.href='add_adver.php?type=8';" /></td>
		</tr>	
		<tr>
			<td>关于我们</td>
			<td>
			
				<table><tr>
			<?php 
				
				$num_indexAdver=isset($arr_gywmadver)==false?0:count($arr_gywmadver);
				for($i=0;$i<$num_indexAdver;$i++){
										
			?>
					<td style="overflow:hidden;"><img src="<?php echo PATH_IMG.$arr_gywmadver[$i]["img_path"];?>" /> <br />
					<br /><?php echo $arr_gywmadver[$i]["title"];?><br /><br />
					<?php echo $arr_gywmadver[$i]["pic_link"];?><br /><br />
					<input type="button"  value="删除" onclick="if(!confirm('确定删除吗?')) return true; else window.location.href='del_adver.php?id=<?php echo $arr_gywmadver[$i]["id"];?>';" /></td>
				<?php }?>	
				</tr>
				
				</table>
			
			</td>
			<td><input type="button" value="添加广告" name="add_indexAdver" onclick="window.location.href='add_adver.php?type=9';" /></td>
		</tr>	
		</tbody>
</table>

</body>
</html>
