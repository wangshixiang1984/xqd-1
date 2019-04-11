<?php
require '../../conf/log.class.php';
if(!isset($_SESSION[USER])){
	header("Location:../login/login.php");exit;
}else{
	$id=intval($_GET["id"]);
	$sql="select * from jdjs where id='$id'";
	$hysy_arr1=$lg->select_arr1($sql);
	
	if(isset($_POST["submit"])){
		$hysy_title=$lg->ckinput($_POST["title"]);
		$hysy_befrom=$_POST["befrom"];
		$hysy_keyword=$lg->ckinput($_POST["keyword"]);
		$hysy_des=$lg->ckinput($_POST["des"]);		
		$hysy_author=$lg->ckinput($_POST["author"]);
		$hysy_content=$_POST["content"];
		$hysy_typeimg=$_POST["hysy_typeimg"];
		$hysy_keypic=$_POST["picfile"];
		if(empty($hysy_keypic)) $hysy_keypic=$hysy_arr1["img_path"];
		$sql="update jdjs set title='$hysy_title',befrom='$hysy_befrom',keyword='$hysy_keyword',des='$hysy_des',img_path='$hysy_keypic'
		,author='$hysy_author',content='$hysy_content',type='$hysy_typeimg' where id='$id'";
		
		if($lg->imd($sql)){
			echo $str_prompt=$lg->outalert("修改成功!");
			echo $lg->gopage("man_zjxz.php");		
		}else{
			$str_prompt=$lg->outalert("修改出错啦!再试试");
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
<script charset="utf-8" src="../../htmleditor/kindeditor-min.js"></script>
<script charset="utf-8" src="../../htmleditor/lang/zh_CN.js"></script>
<title>景点介绍修改</title>
<?php echo $str_prompt; ?>
<script>
	var editor;
	KindEditor.ready(function(K) {
		editor = K.create('textarea[name="content"]', {
			allowFileManager : true
		});

	});
</script>
		
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
<script type="text/javascript">

		$(document).ready(function(){

			$('#title').blur(function(){
				var inputval=$('#title').val();
				if(inputval.length==0 || inputval==''){
					$('#pmsgt').css("display","none");
					$('#pmsgt').html(" <img src='../../bgimage/error.png'/> 标题不能为空");
					$('#pmsgt').css({"color":"#ff0000","font-size":"12px"});
					$('#pmsgt').fadeIn("slow");
					return;
				}else{
					$('#pmsgt').html("");
				}
				
			});

			
			$('#gotime').blur(function(){
				var inputval=$('#gotime').val();
				if(inputval.length==0 || inputval==''){
					$('#gotimemsg').css("display","none");
					$('#gotimemsg').html(" <img src='../../bgimage/error.png'/> 行程日期不能为空");
					$('#gotimemsg').css({"color":"#ff0000","font-size":"12px"});
					$('#gotimemsg').fadeIn("slow");
				}else{
					$('#gotimemsg').html("");
				}
				
			});

			$('#price').blur(function(){
				var inputval=$('#price').val();
				var reg=/^[0-9]*$/;
				if(inputval.length==0 || inputval==''){
					$('#pricemsg').css("display","none");
					$('#pricemsg').html(" <img src='../../bgimage/error.png'/> 价格不能为空");
					$('#pricemsg').fadeIn("slow");
				}
				else if(!inputval.match(reg)){
					$('#pricemsg').css("display","none");
					$('#pricemsg').html(" <img src='../../bgimage/error.png'/> 价格必须为数字");
					$('#pricemsg').css({"color":"#ff0000","font-size":"12px"});
					$('#pricemsg').fadeIn("slow");
				}else{
					$('#pricemsg').html("");
				}
				
			});
			
			$('#submit').click(function(){
				if(
						$.trim($('#pmsgt').text())=="" && 
						$.trim($('#pricemsg').text())=="" &&
						$.trim($('#gotimemsg').text())=="" &&
						$('#spic').html()!=""
						){
					$('#subimt').submit();
				}else{
					return false;
					}
				});
				
			});
</script>
<style type="text/css">
#spic img{width:80px; height:60px;}
</style>
</head>
<body>
<form name="form1" method="post" enctype="multipart/form-data">
<table  style="width:100%;">
	<tbody>
		<tr>
			<td style="width:6%;"></td>
			<td style="width:1050px">
			<div style="text-align:right"><a href="man_zjxz.php">往上一级</a></div>
			<br /><br />
				标题：<input type="text" name="title" id="title" style="width:300px; height:25px;" value="<?php echo $hysy_arr1["title"];?>" /><span id="pmsgt" style="color:#f00; font-size:12px;"></span> <br /><br />
				来源：<input type="text" name="befrom" style="width:300px; height:25px;" value="<?php echo $hysy_arr1["befrom"];?>" /> <br /><br />
				标签：<input type="text" name="keyword" style="width:300px; height:25px;" value="<?php echo $hysy_arr1["keyword"];?>" /> <br /><br />
				描述：<textarea name="des" cols="40" rows="2" ><?php echo $hysy_arr1["des"];?></textarea> <br /><br />
				作者：<input type="text" name="author" style=" height:25px;" value="<?php echo $hysy_arr1["author"];?>"/> <br /><br />
				主图：<input type="file" name="keypic" id="keypic" onchange="return ajaxFileUpload();"/>
				<img id="loading" src="loading.gif" style="display:none;" />			
				<span id="spic"><img src="<?php echo PATH_IMG.$hysy_arr1["img_path"];?>" /></span>
				<textarea id="picfile" name="picfile" style="visibility:hidden;"></textarea>
				<br /><br />
				<?php $hysy_arr1["type"]==0?$select1='selected="selected"':$select2='selected="selected"';?>
				选择图片显示类型：<select name="hysy_typeimg">
					<option value="0" <?php echo $select1;?>>小尺寸</option>
					<option value="1" <?php echo $select2;?>>大尺寸</option>
				</select>
				<br /><br />
				<textarea  name="content" style="width:1000px; height:500px;"><?php echo $hysy_arr1["content"];?></textarea>
				<br />
				<br />
				<input type="submit" name="submit" id="submit" value="修改" style="width:100px; height:40px; text-align:center;" />
			</td>
			<td style=""></td></tr>
		<tr><td></td><td style="height:20px; font-size:12px;">成都慧萌咨询技术支持 &nbsp;&nbsp;  心启点自驾俱乐部版权所有</td><td></td></tr>
	</tbody>
</table>
</form>
</body>
</html>
<?php }?>	
