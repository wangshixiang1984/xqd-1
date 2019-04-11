<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link type="text/css" rel="stylesheet" href="../../css/common.css" />
<link type="text/css" rel="stylesheet" href="../../css/admin.css" />
<script type="text/javascript" src="../../js/ajax.js"></script>
<title>行程安排管理</title>
</head>

<?php
require '../../conf/op.class.php';
if(!isset($_SESSION[USER])){
	header("Location:../login/login.php");exit;
}else{
	$pageid=isset($_GET["id"]) ? $_GET['id'] : 0;
	$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
	$pageid=$pageid == 0 ? 1 : $pageid;
	$page = $page == 0 ? 1 : $page;
	$keyword = isset($_GET['keyword'])? trim($_GET['keyword']) : '';
	$params=array();
	$sql = '';
	//所有行程,分页
	if($pageid == 1){
		$sql = 'select * from xcap';
	}
	//按主题
	if($pageid == 2){
		$sql = 'select * from xcap where gotheme != ""';
		if(!empty($keyword)){
			$sql = 'select * from xcap where gotheme ="'.$keyword.'"';
		}
	}
	//按地区
	if($pageid == 3){
		$sql = 'select * from xcap where gocity != ""';
		if(!empty($keyword)){
			$sql = 'select * from xcap where gocity ="'.$keyword.'"';
		}	
	}
	//按行程
	if($pageid == 4){
		$sql = 'select * from xcap where goday != ""';
		if(!empty($keyword)){
			if($keyword == '三日游'){
				$sql = 'select * from xcap where goday =3';
			}elseif($keyword == '五日游'){
				$sql = 'select * from xcap where goday =5';
			}elseif($keyword == '七日游'){
				$sql = 'select * from xcap where goday =7';
			}else{
				$sql = 'select * from xcap where goday not in (3,5,7)';
			}
		}
	}
	//按月份
	if($pageid == 5){
		$sql = 'select xcap.*,xcdate.godate, xcdate.price, xcdate.gomonth from xcap right join xcdate on xcap.id=xcdate.xcapid where godate != "" group by xcapid ';
		if(!empty($keyword)){
			$day = intval($keyword);
			$sql = 'select xcap.*,xcdate.godate, xcdate.price, xcdate.gomonth as xid from xcap right join xcdate on xcap.id=xcdate.xcapid where gomonth = '.$day .' group by xcapid ';
		}
	}
	$sql .= ' order by id desc';
	$params["id"] = $pageid;
	$pagination = $funcop->split_page(10, 7, $sql, $params);
	$sql = $pagination[0];
	$xcap_arr=$lg->select_arr2($sql);
	// print_r($xcap_arr);exit;
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
	//判断激活标签
	function activTag($pageId, $isPage){
		return $pageId == $isPage ? 'xcap_tag_now' : '';
	}
?>	

<body>
<table style="width:70%; height:35px; background:#aaa;"><tr>
		<td id="<?php echo activTag($pageid, 1); ?>"><a href="man_xcap.php?id=1">所有行程</a></td>
		<td id="<?php echo activTag($pageid, 2); ?>"><a href="man_xcap.php?id=2">按主题</a></td>
		<td id="<?php echo activTag($pageid, 3); ?>"><a href="man_xcap.php?id=3">按地区</a></td>
		<td id="<?php echo activTag($pageid, 4); ?>"><a href="man_xcap.php?id=4">按行程</a></td>
		<td id="<?php echo activTag($pageid, 5); ?>"><a href="man_xcap.php?id=5">按月份</a></td>
</tr></table>
<?php 
//显示子类
function getSql($pageid){
	//按主题
	if($pageid == 2){
		$sql = 'select distinct(gotheme) from xcap';
	}
	//按地区
	if($pageid == 3){
		$sql = 'select distinct(gocity) from xcap';
	}
	return $sql;
}
$typeList=array();
if($pageid == 2 || $pageid == 3){
	$sql = getSql($pageid);
	$typeList = $lg->select_arr2($sql);
}else{
	//按行程
	if($pageid == 4){
		$typeList = array('三日游', '五日游', '七日游', '多日游');
	}
	if($pageid == 5){
		$m = date('n');
		$typeList = array_merge(range($m, 12), range(1, $m -1));
		function typelist($val){
			return $val.'月';
		}
		$typeList = array_map('typelist', $typeList);

	}
}
if($pageid != 1){
?>
<table style="background:#dce8ea; width:70%; margin-bottom:30px; "><tr>
<td>分类：</td>
<?php
if($pageid == 2 || $pageid ==3){
	for($i = 0; $i < count($typeList); $i ++){
		if(!empty($typeList[$i][0])){
?>
<td id="<?php echo activTag($pageid, 1); ?>"><a href="man_xcap.php?id=<?php echo $pageid; ?>&keyword=<?php echo $typeList[$i][0]; ?>" style="color:#444;"><?php echo $typeList[$i][0];  ?></a></td>
<?php }}}else{
	for($i = 0; $i < count($typeList); $i ++){
	?>
	<td id="<?php echo activTag($pageid, 1); ?>"><a href="man_xcap.php?id=<?php echo $pageid; ?>&keyword=<?php echo $typeList[$i]; ?>" style="color:#444;"><?php echo $typeList[$i];  ?></a></td>
<?php }} ?></tr>
</table>
<?php } ?>
<table class="admin_mhover" style="width:100%;">
	<thead class="admin_th"><tr><td style="width:5%">ID</td><td style="width:10%">主题图片</td><td style="width:35%">标题</td><td style="width:35%">操作|<input type="button" value="添加行程" onclick="window.location.href='add_xcap.php'" /></td><td>排序<span style="color:#f00;">(数字越大越靠前)</span></td></tr></thead>
	<tbody>
		<?php
		for($i=0;$i<$xcap_num;$i++){						
		?>
		<tr>
			<td><?php echo $xcap_arr[$i]["id"];?></td>
			<td><img src="<?php echo PATH_IMG.$xcap_arr[$i]["img_path"];?>" /></td>
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
				<input type="button" onclick="window.location.href='set_history.php?id=<?php echo $xcap_arr[$i]["id"];?>&page=<?php echo $page;?>&pageid=<?php echo $pageid;?>&pass=<?php echo $xcap_arr[$i]["passed"] == 1 ? 0 : 1;?>'" value="<?php if( $xcap_arr[$i]['passed'] == 0) {echo '封团';} else {echo '解封';}?>" />
				<input type="button" onclick="window.location.href='add_priceinfo.php?id=<?php echo $xcap_arr[$i]["id"];?>'" value="设置价格日期属性" />
				<input type="button" onclick="window.location.href='add_xcdetail.php?id=<?php echo $xcap_arr[$i]["id"];?>'" value="添加/修改行程介绍" />
			</td>
			<td><input type="text" size=3 name="px" value="<?php echo $xcap_arr[$i]["px"];?>" onchange="process(this.value,<?php echo $xcap_arr[$i]["id"];?>,'out')" /> </td>
		</tr>
		<?php }?>
	</tbody>

</table>
<div id="out"></div>
<div class="next_page"><?php echo $pagination[1]; ?></div>
</body>
</html>

<?php	
}
?>