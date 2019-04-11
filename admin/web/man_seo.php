<?php
require '../../conf/log.class.php';
if(!isset($_SESSION[USER])){
	header("Location:../login/login.php");exit;
}else{
	$sql="select * from seo";
	$arr_seo=$lg->select_arr2($sql);
	$str_prompt=$str_go='';
	if(isset($_POST["indexseo"])){
		$title=$_POST["indextitle"];
		$des=$_POST["indexdes"];
		$kwd=$_POST["indexkwd"];		
		$sql="update seo set title='$title',des='$des',keyword='$kwd' where type=1";
		if($lg->imd($sql)){
			$str_prompt=$lg->outalert("添加成功!");
			$str_go=$lg->gopage("man_seo.php");
		}
	}
	if(isset($_POST["aaseo"])){
		$title=$_POST["aatitle"];
		$des=$_POST["aades"];
		$kwd=$_POST["aakwd"];		
		$sql="update seo set title='$title',des='$des',keyword='$kwd' where type=11";
		if($lg->imd($sql)){
			$str_prompt=$lg->outalert("添加成功!");
			$str_go=$lg->gopage("man_seo.php");
		}
	}
	if(isset($_POST["combineseo"])){
		$title=$_POST["combinetitle"];
		$des=$_POST["combinedes"];
		$kwd=$_POST["combinekwd"];		
		$sql="update seo set title='$title',des='$des',keyword='$kwd' where type=10";
		if($lg->imd($sql)){
			$str_prompt=$lg->outalert("添加成功!");
			$str_go=$lg->gopage("man_seo.php");
		}
	}
	if(isset($_POST["xcapseo"])){
		$title=$_POST["xcaptitle"];
		$des=$_POST["xcapdes"];
		$kwd=$_POST["xcapkwd"];		
		$sql="update seo set title='$title',des='$des',keyword='$kwd' where type=2";
		if($lg->imd($sql)){
			$str_prompt=$lg->outalert("添加成功!");
			$str_go=$lg->gopage("man_seo.php");
		}
	}
	if(isset($_POST["dzxlseo"])){
		$title=$_POST["dzxltitle"];
		$des=$_POST["dzxldes"];
		$kwd=$_POST["dzxlkwd"];
		$sql="update seo set title='$title',des='$des',keyword='$kwd' where type=3";
		if($lg->imd($sql)){
			$str_prompt=$lg->outalert("添加成功!");
			$str_go=$lg->gopage("man_seo.php");
		}
	}	
	if(isset($_POST["hysyseo"])){
		$title=$_POST["hysytitle"];
		$des=$_POST["hysydes"];
		$kwd=$_POST["hysykwd"];		
		$sql="update seo set title='$title',des='$des',keyword='$kwd' where type=4";
		if($lg->imd($sql)){
			$str_prompt=$lg->outalert("添加成功!");
			$str_go=$lg->gopage("man_seo.php");
		}
	}
	if(isset($_POST["xcmwseo"])){
		$title=$_POST["xcmwtitle"];
		$des=$_POST["xcmwdes"];
		$kwd=$_POST["xcmwkwd"];		
		$sql="update seo set title='$title',des='$des',keyword='$kwd' where type=5";
		if($lg->imd($sql)){
			$str_prompt=$lg->outalert("添加成功!");
			$str_go=$lg->gopage("man_seo.php");
		}
	}
	if(isset($_POST["zjyseo"])){
		$title=$_POST["zjytitle"];
		$des=$_POST["zjydes"];
		$kwd=$_POST["zjykwd"];		
		$sql="update seo set title='$title',des='$des',keyword='$kwd' where type=6";
		if($lg->imd($sql)){
			$str_prompt=$lg->outalert("添加成功!");
			$str_go=$lg->gopage("man_seo.php");
		}
	}
	if(isset($_POST["hyxwseo"])){
		$title=$_POST["hyxwtitle"];
		$des=$_POST["hyxwdes"];
		$kwd=$_POST["hyxwkwd"];		
		$sql="update seo set title='$title',des='$des',keyword='$kwd' where type=7";
		if($lg->imd($sql)){
			$str_prompt=$lg->outalert("添加成功!");
			$str_go=$lg->gopage("man_seo.php");
		}
	}
	if(isset($_POST["hotseo"])){
		$title=$_POST["hottitle"];
		$des=$_POST["hotwdes"];
		$kwd=$_POST["hotkwd"];		
		$sql="update seo set title='$title',des='$des',keyword='$kwd' where type=8";
		if($lg->imd($sql)){
			$str_prompt=$lg->outalert("添加成功!");
			$str_go=$lg->gopage("man_seo.php");
		}
	}
	if(isset($_POST["gywmseo"])){
		$title=$_POST["gywmtitle"];
		$des=$_POST["gywmdes"];
		$kwd=$_POST["gywmkwd"];		
		$sql="update seo set title='$title',des='$des',keyword='$kwd' where type=9";
		if($lg->imd($sql)){
			$str_prompt=$lg->outalert("添加成功!");
			$str_go=$lg->gopage("man_seo.php");
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
<title>优化管理</title>
<?php echo $str_prompt; echo $str_go;?>

</head>

<body>

<table class="admin_mhover" style="width:100%;">
<thead style="background:#eee;"><tr><td>栏目</td><td>内容</td></tr></thead>
<tbody>

	<tr>
		<td>首页</td>
		<td>
			<form name="form1" method="post">
			<table>
				<tr><td>标题：</td><td><input type="text" name="indextitle" value="<?php echo $arr_seo[0]["title"];?>" /></td></tr>
				<tr><td>描述：</td><td><textarea name="indexdes"><?php echo $arr_seo[0]["des"];?></textarea></td></tr>
				<tr><td>关键词：</td><td><input type="text" name="indexkwd" value="<?php echo $arr_seo[0]["keyword"];?>" /></td></tr>
				<tr><td colspan="2"><input type="submit" name="indexseo" value=" 提 交 " /></td></tr>
			</table>
			</form>
		</td>
	</tr>
	<tr>
		<td>自驾线路</td>
		<td>
			<form name="form2" method="post">
			<table>
				<tr><td>标题：</td><td><input type="text" name="xcaptitle" value="<?php echo $arr_seo[1]["title"];?>" /></td></tr>
				<tr><td>描述：</td><td><textarea name="xcapdes"><?php echo $arr_seo[1]["des"];?></textarea></td></tr>
				<tr><td>关键词：</td><td><input type="text" name="xcapkwd" value="<?php echo $arr_seo[1]["keyword"];?>" /></td></tr>
				<tr><td colspan="2"><input type="submit" name="xcapseo" value=" 提 交 " /></td></tr>
			</table>
			</form>
		</td>
	</tr>
	<tr>
		<td>AA制自驾</td>
		<td>
			<form name="form9" method="post">
			<table>
				<tr><td>标题：</td><td><input type="text" name="aatitle" value="<?php echo $arr_seo[10]["title"];?>" /></td></tr>
				<tr><td>描述：</td><td><textarea name="aades"><?php echo $arr_seo[10]["des"];?></textarea></td></tr>
				<tr><td>关键词：</td><td><input type="text" name="aakwd" value="<?php echo $arr_seo[10]["keyword"];?>" /></td></tr>
				<tr><td colspan="2"><input type="submit" name="aaseo" value=" 提 交 " /></td></tr>
			</table>
			</form>
		</td>
	</tr>
	<tr>
		<td>拼车自驾</td>
		<td>
			<form name="form10" method="post">
			<table>
				<tr><td>标题：</td><td><input type="text" name="combinetitle" value="<?php echo $arr_seo[9]["title"];?>" /></td></tr>
				<tr><td>描述：</td><td><textarea name="combinedes"><?php echo $arr_seo[9]["des"];?></textarea></td></tr>
				<tr><td>关键词：</td><td><input type="text" name="combinekwd" value="<?php echo $arr_seo[9]["keyword"];?>" /></td></tr>
				<tr><td colspan="2"><input type="submit" name="combineseo" value=" 提 交 " /></td></tr>
			</table>
			</form>
		</td>
	</tr>
	<tr>
		<td>定制线路</td>
		<td>
			<form name="form2" method="post">
			<table>
				<tr><td>标题：</td><td><input type="text" name="dzxltitle" value="<?php echo $arr_seo[2]["title"];?>" /></td></tr>
				<tr><td>描述：</td><td><textarea name="dzxldes"><?php echo $arr_seo[2]["des"];?></textarea></td></tr>
				<tr><td>关键词：</td><td><input type="text" name="dzxlkwd" value="<?php echo $arr_seo[2]["keyword"];?>" /></td></tr>
				<tr><td colspan="2"><input type="submit" name="dzxlseo" value=" 提 交 " /></td></tr>
			</table>
			</form>
		</td>
	</tr>	
	<tr>
		<td>游记鉴赏</td>
		<td>
			<form name="form3" method="post">
			<table>
				<tr><td>标题：</td><td><input type="text" name="hysytitle" value="<?php echo $arr_seo[3]["title"];?>" /></td></tr>
				<tr><td>描述：</td><td><textarea name="hysydes"><?php echo $arr_seo[3]["des"];?></textarea></td></tr>
				<tr><td>关键词：</td><td><input type="text" name="hysykwd" value="<?php echo $arr_seo[3]["keyword"];?>" /></td></tr>
				<tr><td colspan="2"><input type="submit" name="hysyseo" value=" 提 交 " /></td></tr>
			</table>
			</form>
		</td>
	</tr>
	<tr>
		<td>达人</td>
		<td>
			<form name="form4" method="post">
			<table>
				<tr><td>标题：</td><td><input type="text" name="xcmwtitle" value="<?php echo $arr_seo[4]["title"];?>" /></td></tr>
				<tr><td>描述：</td><td><textarea name="xcmwdes"><?php echo $arr_seo[4]["des"];?></textarea></td></tr>
				<tr><td>关键词：</td><td><input type="text" name="xcmwkwd" value="<?php echo $arr_seo[4]["keyword"];?>" /></td></tr>
				<tr><td colspan="2"><input type="submit" name="xcmwseo" value=" 提 交 " /></td></tr>
			</table>
			</form>
		</td>
	</tr>
	<tr>
		<td>租车</td>
		<td>
			<form name="form5" method="post">
			<table>
				<tr><td>标题：</td><td><input type="text" name="zjytitle" value="<?php echo $arr_seo[5]["title"];?>" /></td></tr>
				<tr><td>描述：</td><td><textarea name="zjydes"><?php echo $arr_seo[5]["des"];?></textarea></td></tr>
				<tr><td>关键词：</td><td><input type="text" name="zjykwd" value="<?php echo $arr_seo[5]["keyword"];?>" /></td></tr>
				<tr><td colspan="2"><input type="submit" name="zjyseo" value=" 提 交 " /></td></tr>
			</table>
			</form>
		</td>
	</tr>	
	<tr>
		<td>酒店</td>
		<td>
			<form name="form6" method="post">
			<table>
				<tr><td>标题：</td><td><input type="text" name="hyxwtitle" value="<?php echo $arr_seo[6]["title"];?>" /></td></tr>
				<tr><td>描述：</td><td><textarea name="hyxwdes"><?php echo $arr_seo[6]["des"];?></textarea></td></tr>
				<tr><td>关键词：</td><td><input type="text" name="hyxwkwd" value="<?php echo $arr_seo[6]["keyword"];?>" /></td></tr>
				<tr><td colspan="2"><input type="submit" name="hyxwseo" value=" 提 交 " /></td></tr>
			</table>
			</form>
		</td>
	</tr>
	<tr>
		<td>热门景点</td>
		<td>
			<form name="form6" method="post">
			<table>
				<tr><td>标题：</td><td><input type="text" name="hottitle" value="<?php echo $arr_seo[7]["title"];?>" /></td></tr>
				<tr><td>描述：</td><td><textarea name="hotdes"><?php echo $arr_seo[7]["des"];?></textarea></td></tr>
				<tr><td>关键词：</td><td><input type="text" name="hotkwd" value="<?php echo $arr_seo[7]["keyword"];?>" /></td></tr>
				<tr><td colspan="2"><input type="submit" name="hotseo" value=" 提 交 " /></td></tr>
			</table>
			</form>
		</td>
	</tr>
	<tr>
		<td>关于我们</td>
		<td>
			<form name="form7" method="post">
			<table>
				<tr><td>标题：</td><td><input type="text" name="gywmtitle" value="<?php echo $arr_seo[8]["title"];?>" /></td></tr>
				<tr><td>描述：</td><td><textarea name="gywmdes"><?php echo $arr_seo[8]["des"];?></textarea></td></tr>
				<tr><td>关键词：</td><td><input type="text" name="gywmkwd" value="<?php echo $arr_seo[8]["keyword"];?>" /></td></tr>
				<tr><td colspan="2"><input type="submit" name="gywmseo" value=" 提 交 " /></td></tr>
			</table>
			</form>
		</td>
	</tr>							
	<tr><td><a href="right.php">返回</a></td></tr>

</tbody>

</table>

</body>
</html>
<?php 	
}

?>