﻿<?php
require '../../conf/log.class.php';
if(!isset($_SESSION[USER])){
	header("Location:../login/login.php");exit;
}else{
	$str_prompt=$str_error="";
	$id = isset($_GET['id']) ? $_GET['id'] : 0;
	$sql = "select * from car where id='$id'";
	$info = $lg->select_arr1($sql);

	if(isset($_POST["submit"])){
		$id = isset($_GET['id']) ? $_GET['id'] : 0;
		$xcap_title=$lg->ckinput($_POST["title"]);
		$xcap_typed=$_POST["typed"];
		$xcap_keyword=$lg->ckinput($_POST["keyword"]);
		$xcap_des=$lg->ckinput($_POST["des"]);
		$xcap_keypic=$_POST["picfile"];
		$xcap_author=$lg->ckinput($_POST["author"]);
		$xcap_price=$lg->ckinput($_POST["price"]);
		$brand=$lg->ckinput($_POST["brand"]);
		$getaddress=$lg->ckinput($_POST["getaddress"]);
		$backaddress=$lg->ckinput($_POST["backaddress"]);
		$peizhi=$lg->ckinput($_POST["peizhi"]);
		$peopleseat=$lg->ckinput($_POST["peopleseat"]);
		$days=$lg->ckinput($_POST["days"]);
		$xcap_time=date("Y-m-d h:i:s");
		$orderinfo=$lg->ckinput($_POST["orderinfo"]);
		$sql="update car set title='$xcap_title',typed='$xcap_typed',keyword='$xcap_keyword',des='$xcap_des',img_path='$xcap_keypic'
		,author='$xcap_author',price='$xcap_price',brand='$brand',getaddress='$getaddress',backaddress='$backaddress',days='$days',
		peizhi='$peizhi',content='$orderinfo' where id='$id'";
		
		if(!empty($xcap_keypic)){
		if($lg->imd($sql)){
			$str_prompt=$lg->outalert("发布成功!");			
		}else{
			$str_prompt=$lg->outalert("发布出错啦!再试试");
		}
		}else{
			$str_error=$lg->outalert("主图不能为空");
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
<title>租车修改</title>
<?php echo $str_prompt; echo $str_error;?>
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
						document.getElementById("spic").innerHTML='<img src="'+data.msg+'"  />';
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
		<tr><td style="width:2%;"></td><td style="width:10%"></td><td><div style="text-align:right"><a href="man_xcap.php">往上一级</a></div></td></tr>
		<tr>
			<td ></td>
			<td >型号：</td>
			<td><input type="text" name="title" id="title" style="width:300px; height:25px;" value="<?php echo $info['title'];?>" /></td>
		</tr>
		
		<tr>
			<td ></td>
			<td >标签：</td>
			<td><input type="text" name="keyword" style="width:300px; height:25px;" value="<?php echo $info['keyword'];?>" /></td>
		</tr>
		<tr>
			<td ></td>
			<td >描述：</td>
			<td><textarea name="des" cols="40" rows="2" ><?php echo $info['des'];?></textarea></td>
		</tr>		
		<tr>
			<td></td>
			<td >作者：</td>
			<td><input type="text" name="author" style=" height:25px;" value="<?php echo $info['author'];?>"/></td>
		</tr>
		<tr>
			<td></td>
			<td >价格：</td>
			<td><input type="text" name="price"  style="height:25px;" value="<?php echo $info['price'];?>" /><span style="color:#f00; font-size:12px;"></span></td>
		</tr>
		<tr>
			<td></td>
			<td >出租天数：</td>
			<td><input type="text" name="days"  style="height:25px;" value="<?php echo $info['days'];?>" /><span style="color:#f00; font-size:12px;"></span></td>
		</tr>
		<tr>
			<td></td>
			<td >品牌：</td>
			<td><input type="text" name="brand"  style="height:25px;" value="<?php echo $info['brand'];?>"/><span style="color:#f00; font-size:12px;">丰田</span></td>
		</tr>
		<tr>
			<td></td>
			<td>类型：</td>
			<td><input type="text" name="typed"  style="height:25px;" value="<?php echo $info['typed'];?>" /><span style="color:#f00; font-size:12px;">经济型</span></td>
		</tr>
		<tr>
			<td></td>
			<td>配置：</td>
			<td><input type="text" name="peizhi"  style="height:25px;" value="<?php echo $info['peizhi'];?>" /></td>
		</tr>
		<tr>
			<td></td>
			<td>可乘人数：</td>
			<td><input type="text" name="peopleseat"  style="height:25px;" value="<?php echo $info['peopleseat'];?>" /></td>
		</tr>
		<tr>
			<td></td>
			<td>取车地点：</td>
			<td><input type="text" name="getaddress" value="<?php echo $info['getaddress'];?>"  style="height:25px;" /></td>
		</tr>
		<tr>
			<td></td>
			<td>还车地点：</td>
			<td><input type="text" name="backaddress" value="<?php echo $info['backaddress'];?>"  style="height:25px;" /></td>
		</tr>	
		<!-- <tr>
			<td></td>
			<td >主图尺寸：</td>
			<td><select name="size">
			<option value="0">小图</option>
			<option value="1">大图</option>
			</select></td>
		</tr> -->
		<tr>
			<td></td>
			<td >主图：</td>
			<td><input type="file" name="keypic" id="keypic" onchange="return ajaxFileUpload();"/>
				<img id="loading" src="loading.gif" style="display:none;" />			
				<span id="spic"><img src="<?php echo PATH_IMG.$info['img_path'];?>" /></span>
				<input id="picfile" name="picfile" style="visibility:hidden;" value="<?php echo $info['img_path'];?>" />
				</td>
		</tr>
		<tr>
			<td></td>
			<td >预订说明：</td>
			<td><textarea  name="orderinfo" style="width:500px; height:100px;"><?php echo $info['content'];?></textarea></td>
		</tr>
		<tr><td colspan="3" style="text-align:center">
				<input type="submit" name="submit" id="submit" value="发布" style="width:100px; height:40px; text-align:center;" />
			</td>
		</tr>
		<tr><td></td><td></td><td style="height:20px; font-size:12px;">成都慧萌咨询技术支持 &nbsp;&nbsp;  心启点自驾俱乐部版权所有</td></tr>
	</tbody>
</table>
</form>
</body>
</html>
<?php }?>	
