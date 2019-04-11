<?php
require '../../conf/log.class.php';
if(!isset($_SESSION[USER])){
	header("Location:../login/login.php");exit;
}else{
	$sql="select * from hdgg";
	$arr_gg=$lg->select_arr1($sql);
	if(isset($_POST["pub_gg"])){
		$content=$_POST["hdgg"];
		$sql="update hdgg set content='$content'";
		if($lg->imd($sql)){
			$str_gginfo=$lg->outalert("公告更新成功!");
		}else{
			$str_gginfo=$lg->outalert("公告更新失败，再试试或联系管理员!");
		}
			$str_ggrefresh=$lg->gopage("man_other.php");
	}
	
	$sql="select * from indextel";
	$arr_tel=$lg->select_arr1($sql);
	if(isset($_POST["pub_tel"])){
		$main_tel=$_POST["tel1"];
		$tel2=$_POST["tel2"];
		$tel3=$_POST["tel3"];
		$qq1=$_POST["qq1"];
		$qq2=$_POST["qq2"];
		$qq3=$_POST["qq3"];
		$qq4=$_POST["qq4"];
		$qq5=$_POST["qq5"];
		$qq6=$_POST["qq6"];
		$worktime=$_POST["worktime"];
		$sql="update indextel set maintel='$main_tel',tel2='$tel2',tel3='$tel3',qq1='$qq1',qq2='$qq2',worktime='$worktime',qq3='$qq3',qq4='$qq4',qq5='$qq5',qq6='$qq6'";
		if($lg->imd($sql)){
			$str_gginfo=$lg->outalert("电话更新成功!");
		}else{
			$str_gginfo=$lg->outalert("电话更新失败，再试试或联系管理员!");
		}
		$str_ggrefresh=$lg->gopage("man_other.php");
		
	}
	
	$sql="select * from weibo";
	$arr_weibo=$lg->select_arr1($sql);
	if(isset($_POST["pub_weibo"])){
		$weibo=$_POST["weibo"];
		$qq1=$_POST["qq1"];
		$qq2=$_POST["qq2"];
		
		$sql="update weibo set weibo='$weibo',qq1='$qq1',qq2='$qq2'";
		if($lg->imd($sql)){
			$str_gginfo=$lg->outalert("更新成功!");
		}else{
			$str_gginfo=$lg->outalert("更新失败，再试试或联系管理员!");
		}
		$str_ggrefresh=$lg->gopage("man_other.php");
		
	}
	
	
	$sql="select * from fr order by id desc";
	$arr_fr=$lg->select_arr2($sql);
	$frnum=count($arr_fr);
	if(isset($_POST["pub_fr"])){
		$frlink=$_POST["frlink"];
		$frname=$_POST["frname"];
		$frlogo=$_POST["picfile"];
		$sql="insert into fr (fr_url,fr_name,fr_logo) values('$frlink','$frname','$frlogo')";
		if($lg->imd($sql)){
			$str_gginfo=$lg->outalert("添加成功!");			
		}else{
			$str_gginfo=$lg->outalert("添加失败，请再试试或联系管理员");
		}
		$str_ggrefresh=$lg->gopage("man_other.php");
		
	}
	
	$sql="select * from copyright";
	$arr_copy=$lg->select_arr1($sql);
	$str_gginfo = $str_ggrefresh = '';
	if(isset($_POST["copy_submit"])){
		$content=$_POST["copy_right"];
		$sql="update copyright set content='$content'";
		if($lg->imd($sql)){
			$str_gginfo=$lg->outalert("发布成功");
		}else{
			$str_gginfo=$lg->outalert("发布错误啦！");
		}
		$str_ggrefresh=$lg->gopage("man_other.php");
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
<title>其它管理</title>
</head>

<body>
<?php echo $str_gginfo; echo $str_ggrefresh;?>
<form name="form_gg" method="post">
<table class="admin_mhover" style="width:100%; background:#f1f1f1;">
	<tbody>
		<tr><td style="width:20%;">活动公告</td><td><textarea name="hdgg" rows="6" cols="70"><?php echo $arr_gg["content"];?></textarea><br /><br /><input type="submit" name="pub_gg" value="发布活动公告"  /></td></tr>
	</tbody>
</table>
</form>
<form name="form_tel" method="post">
<table class="admin_mhover" style="width:100%; background:#f1f1f1;">
	<tbody>
		<tr><td style="width:20%;">首页电话</td><td><font style="color:#f00">电话1（主要联系电话）：</font><input type="text" name="tel1" value="<?php echo $arr_tel["maintel"];?>" /><br /><br />
		电话2：<input type="text" name="tel2" value="<?php echo $arr_tel["tel2"];?>" /> <br /><br />
		电话3(假日电话)：<input type="text" name="tel3" value="<?php echo $arr_tel["tel3"];?>" /> <br /><br />
		qq1：<textarea name="qq1"><?php echo $arr_tel["qq1"];?></textarea><br /><br />
		qq2: <textarea name="qq2"><?php echo $arr_tel["qq2"];?></textarea><br /><br />
		qq3：<textarea name="qq3"><?php echo $arr_tel["qq3"];?></textarea><br /><br />
		qq4: <textarea name="qq4"><?php echo $arr_tel["qq4"];?></textarea><br /><br />
		qq5：<textarea name="qq5"><?php echo $arr_tel["qq5"];?></textarea><br /><br />
		qq6: <textarea name="qq6"><?php echo $arr_tel["qq6"];?></textarea><br /><br />
		工作时间：<textarea name="worktime"><?php echo $arr_tel["worktime"];?></textarea>
		<input type="submit" name="pub_tel" value="更新"  /></td></tr>
	</tbody>
</table>
</form>

<form name="form_weibo" method="post">
<table class="admin_mhover" style="width:100%; background:#f1f1f1;">
	<tbody>
		<tr><td style="width:20%;">微博/QQ：</td><td>
		微博地址：<textarea name="weibo" style="width:300px;" ><?php echo $arr_weibo["weibo"];?></textarea><br /><br />
		QQ群1代码：<textarea name="qq1" style="width:300px;"><?php echo $arr_weibo["qq1"];?></textarea><br /><br />
		QQ群2代码：<textarea name="qq2" style="width:300px;"><?php echo $arr_weibo["qq2"];?></textarea><br /><br />
		<input type="submit" name="pub_weibo" value="更新"  /></td></tr>
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
#spic img{width:60px; height:40px;}
</style>
<form name="form_frlink" method="post">
<table class="admin_mhover" style="width:100%; background:#f1f1f1;">
	<tbody>
		<tr><td style="width:20%;">友情链接：</td><td><div style="float:left; width:40%;">
		地址：(必须带http://)<input type="text" name="frlink" style="width:200px;" /><br /><br />
		名称：<input type="text" name="frname" style="width:200px;" /><br /><br />
		logo：<input type="file" name="keypic" id="keypic" onchange="return ajaxFileUpload();" /> &nbsp;&nbsp;
		<img id="loading" src="loading.gif" style="display:none;" />			
			<span id="spic"></span>
			<textarea id="picfile" name="picfile" style="visibility:hidden;"></textarea><br /><br />
		<input type="submit" name="pub_fr" value="添加"  /></div>
		<div style="float:left; margin-left:40px;">
		<table>
		<tr><td>网站名称</td><td>网站地址</td><td>logo</td><td>操作</td></tr>
		<?php 
		for($i=0;$i<$frnum;$i++){			
		?>
		<tr><td><?php echo $arr_fr[$i]["fr_name"];?></td><td><?php echo $arr_fr[$i]["fr_url"];?></td>
		<td><?php if(empty($arr_fr[$i]["fr_logo"])) echo "无logo图片"; else {?><img src="<?php echo PATH_IMG.$arr_fr[$i]["fr_logo"];?>" width="40px" height="20px" /><?php }?></td>
		<td><input type="button" name="del_fr" value="删除" onclick="if(confirm('你确定要删除吗?')) window.location.href='del_fr.php?id=<?php echo $arr_fr[$i]["id"];?>'; else return false; " /></td></tr>
		<?php }?>
		</table></div><div style="clear:both;"></div>
		</td></tr>
	</tbody>
</table>
</form>

<form name="form_copy" method="post">
<table class="admin_mhover" style="width:100%; background:#f1f1f1;">
	<tbody>
		<tr><td style="width:20%;">版权所有：</td>
		<td style="width:80%"><pre><textarea name="copy_right" cols="70" rows="5"><?php echo $arr_copy["content"];?></textarea></pre><br /><br /><input type="submit" name="copy_submit" value=" 提交 " />
		</td></tr>
	</tbody>
</table>
</form>

<table style="width:100%; height:40px;">
<tr><td>技术支持：慧萌科技   心启点自驾俱乐部 &copy;版权所有</td></tr>
</table>
</body>
</html>

<?php	
}
?>