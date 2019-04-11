<?php
require '../../conf/log.class.php';
if(!isset($_SESSION[USER])){
	header("Location:../login/login.php");exit;
}else{
	if(isset($_POST["submit"])){
		$name=$lg->ckinput($_POST["name"]);
		$web=$lg->ckinput($_POST["web"]);
		$sql="insert into frlink(name,link) values('$name','$web')";
		if($lg->imd($sql)){
			$suc_fal=$lg->outalert("添加成功");
		}else{
			$suc_fal=$lg->outalert("添加失败");
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
<?php echo $suc_fal;?>
<title>无标题文档</title>
</head>

<body>
<fieldset style="margin:20px 0px 0px 200px; width:400px; padding:20px;">
<form name="form1" method="post">
网站名称：<input type="text" name="name"  /><br /><br/>
网址：<input type="text" name="web" /><br /><br />
<input type="submit" name="submit" value="添加" />
</form>
</fieldset>
</body>
</html>