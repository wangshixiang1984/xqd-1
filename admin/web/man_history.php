<?php
require '../../conf/log.class.php';
if(!isset($_SESSION[USER])){
	header("Location:../login/login.php");exit;
}else{
	$pageid=isset($_GET["id"]) ? $_GET['id'] : 0;
	$pageid=$pageid==0?1:$pageid;
	$xcap_tagnow1 = $xcap_tagnow2 = $xcap_tagnow3 = $xcap_tagnow4 = '';
	switch ($pageid){
		case 1:$sql="select * from xcap where passed=1 order by id desc";$xcap_tagnow1="xcap_tag_now";break;
		case 2:$sql="select * from xcap where type=0 and passed=1 order by id desc";$xcap_tagnow2="xcap_tag_now"; break;
		case 3:$sql="select * from xcap where type=1 and passed=1 order by id desc";$xcap_tagnow3="xcap_tag_now"; break;
		case 4:$sql="select * from xcap where type=2 and passed=1 order by id desc";$xcap_tagnow4="xcap_tag_now"; break;
	}
	$xcap_arr=$lg->select_arr2($sql);
	$xcap_num=count($xcap_arr);
	if(isset($_POST["set_px"])){
		$pxnum=$_POST["px"];
		$id=$_POST["idnum"];
		$sql="update xcap set px='$pxnum' where id='$id'";
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
<title>历史线路管理</title>
</head>

<body>
<table class="xcap_tag"><tr>
		<td id="<?php echo $xcap_tagnow1?>"><a href="man_history.php?id=1">所有历史线路</a></td>
		<td id="<?php echo $xcap_tagnow2?>"><a href="man_history.php?id=2">国内历史线路</a></td>
		<td id="<?php echo $xcap_tagnow3?>"><a href="man_history.php?id=3">境外历史线路</a></td>
		<td id="<?php echo $xcap_tagnow4?>"><a href="man_history.php?id=4">落地历史线路</a></td>
</tr></table>
<table class="admin_mhover" style="width:100%;">
	<thead class="admin_th"><tr><td style="width:10%">所属类别</td><td style="width:10%">主题图片</td><td style="width:5%">图片尺寸</td><td style="width:35%">标题</td><td style="width:30%">操作</td></td></tr></thead>
	<tbody>
		<?php
		if($pageid==1){ 
		for($i=0;$i<$xcap_num;$i++){			
			switch ($xcap_arr[$i]["type"]){
				case 0: $xcap_type="国内自驾";break;
				case 1: $xcap_type="境外自驾"; break;
				case 2: $xcap_type="落地自驾"; break;
			}
		?>
		<tr>
			<td><?php echo $xcap_type;?></td>
			<td><img src="<?php echo PATH_IMG.$xcap_arr[$i]["img_path"];?>" /></td>
			<td><?php echo $xcap_arr[$i]["size"]==0?"<span style='color:#f00;'>小图": "<span style='color:#0f0;'>大图</span>";?></td>
			<td><a href="../../sub/xcap.php?id=<?php echo $xcap_arr[$i]["id"];?>" target="_blank"><?php echo $xcap_arr[$i]["title"];?></a></td>
			<td>
				<input type="button" value="修改" onclick="window.location.href='modify_xcap.php?id=<?php echo $xcap_arr[$i]["id"];?>'" />
				<input type="button" value="删除"  onclick="if(!confirm('确定删除吗?')) return true; else window.location.href='del_xcap.php?id=<?php echo $xcap_arr[$i]["id"];?>';" />
		<?php 
		if(!$xcap_arr[$i]["istop"]){
		?>
				<input type="button" value="设置热门推荐" onclick="window.location.href='set_new.php?id=<?php echo $xcap_arr[$i]["id"];?>'" />
			<?php }else{?>
				<input type="button" value="取消热门推荐" onclick="window.location.href='drop_new.php?id=<?php echo $xcap_arr[$i]["id"];?>'" />
			<?php }?>
			<?php if($xcap_arr[$i]["hide"]==0) {
				$hide="隐藏"; 
				$hidenum=1;
			}else{
				$hide="显示";
				$hidenum=0;
			}?>
				<input type="button" value="<?php echo $hide;?>" onclick="window.location.href='set_hide.php?id=<?php echo $xcap_arr[$i]["id"]."&hidenum=".$hidenum;?>'" />
				<input type="button" onclick="window.location.href='pass_history.php?id=<?php echo $xcap_arr[$i]["id"];?>&pageid=<?php echo $pageid;?>'" value="恢复线路" />
			</td>
			
		</tr>
		<?php }
		}else if($pageid==2){
			for($i=0;$i<$xcap_num;$i++){
			?>
			<tr>
			<td>国内自驾</td>
						<td><img src="<?php echo PATH_IMG.$xcap_arr[$i]["img_path"];?>" /></td>
						<td><?php echo $xcap_arr[$i]["size"]==0?"<span style='color:#f00;'>小图": "<span style='color:#0f0;'>大图</span>";?></td>
						<td><a href="../../sub/xcap.php?id=<?php echo $xcap_arr[$i]["id"];?>" target="_blank"><?php echo $xcap_arr[$i]["title"];?></a></td>
						<td>
							<input type="button" value="修改" onclick="window.location.href='modify_xcap.php?id=<?php echo $xcap_arr[$i]["id"];?>'" />
							<input type="button" value="删除"  onclick="if(!confirm('确定删除吗?')) return true; else window.location.href='del_xcap.php?id=<?php echo $xcap_arr[$i]["id"];?>';" />
					<?php 
					if(!$xcap_arr[$i]["istop"]){
					?>
							<input type="button" value="设置热门推荐" onclick="window.location.href='set_new.php?id=<?php echo $xcap_arr[$i]["id"];?>'" />
						<?php }else{?>
							<input type="button" value="取消热门推荐" onclick="window.location.href='drop_new.php?id=<?php echo $xcap_arr[$i]["id"];?>'" />
						<?php }?>
						<?php if($xcap_arr[$i]["hide"]==0) {
							$hide="隐藏"; 
							$hidenum=1;
						}else{
							$hide="显示";
							$hidenum=0;
						}?>
							<input type="button" value="<?php echo $hide;?>" onclick="window.location.href='set_hide.php?id=<?php echo $xcap_arr[$i]["id"]."&hidenum=".$hidenum;?>'" />
							<input type="button" onclick="window.location.href='pass_history.php?id=<?php echo $xcap_arr[$i]["id"];?>&pageid=<?php echo $pageid;?>'" value="恢复线路" />
						
						</td>
						
					</tr>
						
		<?php }}else if($pageid==3){
			for($i=0;$i<$xcap_num;$i++){
			?>
		<tr>
			<td>境外自驾</td>
			<td><img src="<?php echo PATH_IMG.$xcap_arr[$i]["img_path"];?>" /></td>
			<td><?php echo $xcap_arr[$i]["size"]==0?"<span style='color:#f00;'>小图": "<span style='color:#0f0;'>大图</span>";?></td>
			<td><a href="../../sub/xcap.php?id=<?php echo $xcap_arr[$i]["id"];?>" target="_blank"><?php echo $xcap_arr[$i]["title"];?></a></td>
			<td>
				<input type="button" value="修改" onclick="window.location.href='modify_xcap.php?id=<?php echo $xcap_arr[$i]["id"];?>'" />
				<input type="button" value="删除"  onclick="if(!confirm('确定删除吗?')) return true; else window.location.href='del_xcap.php?id=<?php echo $xcap_arr[$i]["id"];?>';" />
		<?php 
		if(!$xcap_arr[$i]["istop"]){
		?>
				<input type="button" value="设置热门推荐" onclick="window.location.href='set_new.php?id=<?php echo $xcap_arr[$i]["id"];?>'" />
			<?php }else{?>
				<input type="button" value="取消热门推荐" onclick="window.location.href='drop_new.php?id=<?php echo $xcap_arr[$i]["id"];?>'" />
			<?php }?>
			<?php if($xcap_arr[$i]["hide"]==0) {
				$hide="隐藏"; 
				$hidenum=1;
			}else{
				$hide="显示";
				$hidenum=0;
			}?>
				<input type="button" value="<?php echo $hide;?>" onclick="window.location.href='set_hide.php?id=<?php echo $xcap_arr[$i]["id"]."&hidenum=".$hidenum;?>'" />
				<input type="button" onclick="window.location.href='pass_history.php?id=<?php echo $xcap_arr[$i]["id"];?>&pageid=<?php echo $pageid;?>'" value="恢复线路" />
			</td>
			
		</tr>
		
		<?php }}else if($pageid==4){
			for($i=0;$i<$xcap_num;$i++){
			?>
		<tr>
			<td>落地自驾</td>
			<td><img src="<?php echo PATH_IMG.$xcap_arr[$i]["img_path"];?>" /></td>
			<td><?php echo $xcap_arr[$i]["size"]==0?"<span style='color:#f00;'>小图": "<span style='color:#0f0;'>大图</span>";?></td>
			<td><a href="../../sub/xcap.php?id=<?php echo $xcap_arr[$i]["id"];?>" target="_blank"><?php echo $xcap_arr[$i]["title"];?></a></td>
			<td>
				<input type="button" value="修改" onclick="window.location.href='modify_xcap.php?id=<?php echo $xcap_arr[$i]["id"];?>'" />
				<input type="button" value="删除"  onclick="if(!confirm('确定删除吗?')) return true; else window.location.href='del_xcap.php?id=<?php echo $xcap_arr[$i]["id"];?>';" />
		<?php 
		if(!$xcap_arr[$i]["istop"]){
		?>
				<input type="button" value="设置热门推荐" onclick="window.location.href='set_new.php?id=<?php echo $xcap_arr[$i]["id"];?>'" />
			<?php }else{?>
				<input type="button" value="取消热门推荐" onclick="window.location.href='drop_new.php?id=<?php echo $xcap_arr[$i]["id"];?>'" />
			<?php }?>
			<?php if($xcap_arr[$i]["hide"]==0) {
				$hide="隐藏"; 
				$hidenum=1;
			}else{
				$hide="显示";
				$hidenum=0;
			}?>
				<input type="button" value="<?php echo $hide;?>" onclick="window.location.href='set_hide.php?id=<?php echo $xcap_arr[$i]["id"]."&hidenum=".$hidenum;?>'" />
				<input type="button" onclick="window.location.href='pass_history.php?id=<?php echo $xcap_arr[$i]["id"];?>&pageid=<?php echo $pageid;?>'" value="恢复线路" />
			</td>
			
			
		</tr>		
		
		<?php }}?>
	</tbody>

</table>
<div id="out"></div>
</body>
</html>

<?php	
}
?>