<?php
require '../../conf/log.class.php';
if(!isset($_SESSION[USER])){
	header("Location:../login/login.php");exit;
}else{
	$sql="select * from gywm";
	$arr_gywm=$lg->select_arr1($sql);
	$str_prompt = $str_error = '';
	if(isset($_POST["submit"])){
		$content=$lg->ckinput($_POST["content"]);
		$zxtel=$_POST["zxtel"];
		$tstel=$_POST["tstel"];
		$xstel=$_POST["xstel"];
		$cz=$_POST["cz"];
		$qq=$_POST["qq"];
		$email=$_POST["email"];
		$address=$_POST["address"];
		$title=$_POST["title"];
		$pic=$_POST["picfile"];
		$sql="update gywm set content='$content',pic='$pic',title='$title',zxtel='$zxtel',tstel='$tstel',xstel='$xstel',cz='$cz',address='$address',email='$email',qq='$qq' where id=1"; 		
		
		if($lg->imd($sql)){
			$str_prompt=$lg->outalert("发布成功!");	
			echo $lg->gopage('man_gywm.php');
		}else{
			$str_prompt=$lg->outalert("发布出错啦!再试试");
		}

	}
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link type="text/css" rel="stylesheet" href="../../css/common.css" />
<link type="text/css" rel="stylesheet" href="../../css/admin.css" />
<!-- <script language="javascript" type="text/javascript" src="../../js/jquery.js"></script> -->
<script language="javascript" type="text/javascript" src="../../js/jquery.min.js"></script>
<script language="javascript" type="text/javascript" src="../../js/ajaxfileupload.js"></script>
<script charset="utf-8" src="../../htmleditor/kindeditor-min.js"></script>
<script charset="utf-8" src="../../htmleditor/lang/zh_CN.js"></script>
<title>关于我们管理</title>
<?php echo $str_prompt; echo $str_error;?>
<script>
	var editor;
	KindEditor.ready(function(K) {
		editor = K.create('textarea[name="content"]', {
			allowFileManager : true
		});

	});
</script>
		
</head>
<body>
<style type="text/css">
	#spic img{width:80px; height:60px;}
</style>	
<form name="form1" method="post" enctype="multipart/form-data">
<table  style="width:100%;">
	<tbody>
		<tr>
			<td style="width:6%;"></td>
			<td style="width:1050px">
			<div style="text-align:right"><a href="right.php">往上一级</a></div>
			<br /><br />
				首页标题：<input type="text" name="title" style="height:25px;width: 400px;" value="<?php echo $arr_gywm["title"];?>" /><br /><br />
				咨询电话：<input type="text" name="zxtel" style="height:25px;" value="<?php echo $arr_gywm["zxtel"];?>" /><br /><br />
				投诉电话：<input type="text" name="tstel" style="height:25px;" value="<?php echo $arr_gywm["tstel"];?>" /><br /><br />
				销售电话：<input type="text" name="xstel" style="height:25px;" value="<?php echo $arr_gywm["xstel"];?>" /><br /><br />
				传真：<input type="text" name="cz" style="height:25px;" value="<?php echo $arr_gywm["cz"];?>" /><br /><br />
				email：<input type="text" name="email" style="height:25px;" value="<?php echo $arr_gywm["email"];?>" /><br /><br />
				Q Q：<input type="text" name="qq" style="height:25px;" value="<?php echo $arr_gywm["qq"];?>" /><br /><br />
				地址：<input type="text" name="address" style="height:25px;" value="<?php echo $arr_gywm["address"];?>" /><br /><br />
				<input type="file" name="keypic" id="keypic" onchange="return ajaxFileUpload();" />
				<img id="loading" src="loading.gif" style="display:none;" />			
				<span id="spic"><img src="<?php echo PATH_IMG.$arr_gywm['pic'];?>" /></span>
				<textarea id="picfile" name="picfile" style="visibility:hidden;"><?php echo $arr_gywm['pic'];?></textarea>
				<br />
				<br />
				<textarea  name="content" style="width:1000px; height:500px;"><?php echo $arr_gywm["content"];?></textarea>
				<br />
				<br />
				<input type="submit" name="submit" id="submit" value="发布" style="width:100px; height:40px; text-align:center;" />
			</td>
			<td style=""></td></tr>
		<tr><td></td><td style="height:20px; font-size:12px;">成都慧萌咨询技术支持 &nbsp;&nbsp;  心启点自驾俱乐部版权所有</td><td></td></tr>
	</tbody>
</table>
</form>
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
						document.getElementById("spic").innerHTML='<img src="'+data.msg+'" />';
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
</body>
</html>
<?php }?>	
