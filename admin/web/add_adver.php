<?php
require '../../conf/log.class.php';
include '../../conf/imgresize.class.php';
if(!isset($_SESSION[USER])){
	header("Location:../login/login.php");exit;
}else{
	$type=intval($_GET["type"]);
	$str_go=$str_prompt="";
	for($i=0;$i<10;$i++){
		$arr_type[$i]="";
	}
	switch($type){
		case 0: $arr_type[0]='selected="selected"'; break;
		case 1: $arr_type[1]='selected="selected"'; break;
		case 2: $arr_type[2]='selected="selected"'; break;
		case 3: $arr_type[3]='selected="selected"'; break;
		case 4: $arr_type[4]='selected="selected"'; break;
		case 5: $arr_type[5]='selected="selected"'; break;
		case 6: $arr_type[6]='selected="selected"'; break;
		case 7: $arr_type[7]='selected="selected"'; break;
		case 8: $arr_type[8]='selected="selected"'; break;
		case 9: $arr_type[9]='selected="selected"'; break;
		}
	if(isset($_POST["adver_submit"])){
		
		$adver_name=$_POST["picfile"];
		$adver_type=$_POST["adver_type"];
		//如果是首页广告，则生成缩略图
		if($adver_type==0){		
			$img=PATH_IMG.$adver_name;		
			$adver_imglittle=$resizeimg->resizeimg($img,50,50,1,PATH_IMG);
		}
		$adver_title=$_POST["title"];
		$adver_piclink=$_POST["pic_link"];
		$sql="insert into adver (img_path,img_little,type,title,pic_link) values('$adver_name','$adver_imglittle','$adver_type','$adver_title','$adver_piclink')";
		if($lg->imd($sql)){
			$str_prompt=$lg->outalert("添加成功!");
			$str_go=$lg->gopage("add_adver.php?type=".$adver_type);
		}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link type="text/css" rel="stylesheet" href="../../css/common.css" />
<link type="text/css" rel="stylesheet" href="../../css/admin.css" />
<script language="javascript" type="text/javascript" src="../../js/jquery.min.js"></script>
<script language="javascript" type="text/javascript" src="../../js/ajaxfileupload.js"></script>
<title>广告管理</title>
<?php echo $str_prompt; echo $str_go;?>
<script type="text/javascript">
function ajaxFileUpload()
{
	$("#loading")
	.ajaxStart(function(){
		$(this).show();
	})
	.ajaxComplete(function(){
		$(this).hide();
	});

	$.ajaxFileUpload
	(
		{
			url:'doajaxfileupload.php',
			secureuri:false,
			fileElementId:'keypic',
			dataType: 'json',
			success: function (data, status)
			{
				
				if(typeof(data.error) != 'undefined')
				{
					if(data.error != '')
					{
						alert(data.error);
					}else
					{
						document.getElementById("spic").innerHTML=data.msg;
						document.getElementById("picfile").value=data.filename;
					}
				}
			},
			error: function (data, status, e)
			{
				alert(e);
			}
		}
	)
	
	return false;

}

</script>
<style type="text/css">
#spic img{width:80px; height:60px;}
</style>	
</head>

<body>
<form name="form1" method="post" enctype="multipart/form-data">
<table class="admin_mhover" style="width:100%;">
<tbody>

	<tr>
		<td><select name="adver_type">
				<option <?php echo $arr_type[0];?> value="0">首页焦点广告</option>
				<option <?php echo $arr_type[4];?> value="4">首页移动端广告</option>
				<option <?php echo $arr_type[1];?> value="1">自驾线路</option>
				<option <?php echo $arr_type[2];?> value="2">游记攻略</option>
				<option <?php echo $arr_type[3];?> value="3">首页单版广告</option>
				<option <?php echo $arr_type[5];?> value="5">自驾攻略</option>
				<option <?php echo $arr_type[6];?> value="6">线路定制</option>
				<option <?php echo $arr_type[7];?> value="7">团队</option>
				<option <?php echo $arr_type[8];?> value="8">租车</option>
				<option <?php echo $arr_type[9];?> value="9">关于我们</option>
			</select>
			图片标题：<input type="text" name="title"/>
			图片链接：<input type="text" name="pic_link"/>
			<input type="file" name="keypic" id="keypic" onchange="return ajaxFileUpload();" />
			<img id="loading" src="loading.gif" style="display:none;" />			
			<span id="spic"></span>
			<textarea id="picfile" name="picfile" style="visibility:hidden;"></textarea>
			<input type="submit" name="adver_submit" value="提交" />
		
		</td>
	</tr>
	<tr><td><a href="right.php">返回</a></td></tr>

</tbody>

</table>
</form>
</body>
</html>
<?php 	
}

?>