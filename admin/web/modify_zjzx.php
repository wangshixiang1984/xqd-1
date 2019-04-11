<?php
require '../../conf/log.class.php';
if(!isset($_SESSION[USER])){
	header("Location:../login/login.php");exit;
}else{
	$id=intval($_GET["id"]);
	$sql="select * from zjzx where id='$id'";
	$hyzx_arr=$lg->select_arr1($sql);
	if(isset($_POST["submit"])){
		$hyzx_title=$lg->ckinput($_POST["title"]);
		$hyzx_befrom=$_POST["befrom"];
		$hyzx_keyword=$lg->ckinput($_POST["keyword"]);
		$hyzx_des=$lg->ckinput($_POST["des"]);	
		$hyzx_author=$lg->ckinput($_POST["author"]);
		$hyzx_time=date("Y-m-d h:i:s",mktime());
		$hyzx_content=$_POST["content"];
		$sql="update zjzx set title='$hyzx_title',befrom='$hyzx_befrom',keyword='$hyzx_keyword',des='$hyzx_des',
		author='$hyzx_author',time='$hyzx_time',content='$hyzx_content' where id='$id'";
		
		if($lg->imd($sql)){
			$str_prompt=$lg->outalert("修改成功!");			
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
<script charset="utf-8" src="../../htmleditor/kindeditor-min.js"></script>
<script charset="utf-8" src="../../htmleditor/lang/zh_CN.js"></script>
<title>行业资讯添加</title>
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

	
			$('#submit').click(function(){
				if(
						$.trim($('#pmsgt').text())==""
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
			<div style="text-align:right"><a href="man_zx.php">往上一级</a></div>
			<br /><br />
				标题：<input type="text" name="title" id="title" style="width:300px; height:25px;" value="<?php echo $hyzx_arr["title"];?>" /><span id="pmsgt" style="color:#f00; font-size:12px;"></span> <br /><br />
				来源：<input type="text" name="befrom" style=" height:25px;"  value="<?php echo $hyzx_arr["befrom"];?>"/> <br /><br />
				作者：<input type="text" name="author" style=" height:25px;"  value="<?php echo $hyzx_arr["author"];?>"/> <br /><br />
				标签：<input type="text" name="keyword" style="width:300px; height:25px;"  value="<?php echo $hyzx_arr["keyword"];?>"/> <br /><br />
				描述：<textarea name="des" cols="40" rows="2" ><?php echo $hyzx_arr["des"];?></textarea> <br /><br />
				<textarea  name="content" style="width:1000px; height:500px;"><?php echo $hyzx_arr["content"];?></textarea>
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
