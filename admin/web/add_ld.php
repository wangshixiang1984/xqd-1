<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
require '../../conf/log.class.php';
if(!isset($_SESSION[USER])){
	header("Location:../login/login.php");exit;
}else{
	$str_prompt=$str_error='';
	if(isset($_POST["submit"])){
		$xcap_name=$lg->ckinput($_POST["name"]);
		$xcap_befrom=$_POST["befrom"];
		$xcap_sex=$_POST["sex"];
		$xcap_renqi=$_POST["renqi"];
		$xcap_year=$_POST["year"];
		$xcap_area=$_POST["area"];
		$xcap_keyword=$lg->ckinput($_POST["keyword"]);
		$xcap_des=$lg->ckinput($_POST["des"]);
		$xcap_keypic=$_POST["picfile"];		
		$xcap_time=date("Y-m-d h:i:s");
		$xcap_content=$lg->ckinput($_POST["content"]);
		$leadedxl=$_POST["leadedxl"];
		$sql="insert into ld (name,sex,befrom,renqi,year,area,keyword,des,img_path,time,content,leadedxl) 
		values('$xcap_name','$xcap_sex','$xcap_befrom','$xcap_renqi','$xcap_year','$xcap_area','$xcap_keyword','$xcap_des',
		'$xcap_keypic','$xcap_time','$xcap_content', '$leadedxl')";
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


<link type="text/css" rel="stylesheet" href="../../css/common.css" />
<link type="text/css" rel="stylesheet" href="../../css/admin.css" />
<script language="javascript" type="text/javascript" src="../../js/jquery.min.js"></script>
<script language="javascript" type="text/javascript" src="../../js/ajaxfileupload.js"></script>
<script charset="utf-8" src="../../htmleditor/kindeditor-min.js"></script>
<script charset="utf-8" src="../../htmleditor/lang/zh_CN.js"></script>
<title>领队添加</title>
<?php echo $str_prompt; echo $str_error;?>
<script>
	KindEditor.ready(function(K) {
		var editor = K.create('textarea[name="content"]', {
			allowFileManager : true
		});

	});
	// KindEditor.ready(function(K) {
	// 	var editor = K.create('textarea[name="leadedxl"]', {
	// 		allowFileManager : true
	// 	});

	// });
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
						document.getElementById("spic").innerHTML='<span><img src="' + data.msg + '" />';
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
			<div style="text-align:right"><a href="man_ld.php">往上一级</a></div>
			<br /><br />
				领队姓名：<input type="text" name="name" id="title" style="width:300px; height:25px;" /><span id="pmsgt" style="color:#f00; font-size:12px;">*</span> <br /><br />
				领队姓别：男 <input type="radio" name="sex" value="1" checked="checked" /> 女 </label><input type="radio" value="2" name="sex" /> <br /><br />
				领队人气：<input type="text" name="renqi" style="width:300px; height:25px;" /><br /><br />
				带团时间：<input type="text" name="year" style="width:300px; height:25px;" /><br /><br />
				熟悉区域：<input type="text" name="area" style="width:300px; height:25px;" /><br /><br />
				来源：<input type="text" name="befrom" style="width:300px; height:25px;" /> <br /><br />
				标签：<input type="text" name="keyword" style="width:300px; height:25px;" /> <br /><br />
				描述：<textarea name="des" cols="40" rows="2" ></textarea> <br /><br />						
				曾带线路：<textarea  name="leadedxl" style="width:400px; height:60px;"></textarea> (例：23,30,31)<br /><br />
				领队靓照：<input type="file" name="keypic" id="keypic" onchange="return ajaxFileUpload();"/>
				<img id="loading" src="loading.gif" style="display:none;" />			
				<span id="spic"></span>
				<textarea id="picfile" name="picfile" style="visibility:hidden;"></textarea>
				<br /><br />
				达人详情：<textarea  name="content" style="width:1000px; height:500px;"></textarea><br /><br />
				<br />
				<br />
				<input type="submit" name="submit" id="submit" value="发布" style="width:100px; height:40px; text-align:center;" />
			</td>
			<td style=""></td></tr>
		<tr><td></td><td style="height:20px; font-size:12px;">成都慧萌咨询技术支持 &nbsp;&nbsp;  心启点自驾俱乐部版权所有</td><td></td></tr>
	</tbody>
</table>
</form>
</body>
</html>
<?php }?>	
