<?php
require '../../conf/log.class.php';
if(!isset($_SESSION[USER])){
	header("Location:../login/login.php");exit;
}else{
	$id=intval($_GET["id"]);
	$imgpath="../../images/";
	$sql="select * from cs_kpic where id='$id'";
	$arrpic=$lg->select_arr1($sql);	
	if(isset($_POST["submit"])){
		$pic=trim($_POST["picfile"]);
		if(empty($pic)){
			$errorpic="你没有选择图片";
		}else{
			$sql="update cs_kpic set pic='$pic' where id='$id'";
			if($lg->imd($sql)){
				$strout=$lg->outalert("修改成功");
			}else{
				$strout=$lg->outalert("修改失败");
			}
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
<script language="javascript" type="text/javascript" src="../../js/jquery.js"></script>
<script language="javascript" type="text/javascript" src="../../js/ajaxfileupload.js"></script>
<title>无标题文档</title>
<?php echo $strout?>
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
<fieldset style="width:500px; margin-left:200px; margin-top:50px; padding:20px;">
<form name="form1" method="post" enctype="multipart/form-data">
游戏主图：<input type="file" name="keypic" id="keypic" /><img id="loading" src="loading.gif" style="display:none;" /> 
<button class="button" id="buttonUpload" onclick="return ajaxFileUpload();">上传</button>
 <?php echo $errorpic;?> &nbsp;&nbsp;<input type="submit" name="submit" value="修改" /><br/>
<span id="spic"><img src="<?php echo $imgpath.$arrpic["pic"];?>" width="80" height="60" /></span><textarea id="picfile" name="picfile" style="visibility:hidden;"></textarea>
<p style="font-size:12px; color:#f00">首页显示的主图，只需传一次，传第二次会改变上一次的结果</p>
<br/>
</form>
</fieldset>
</body>
</html>