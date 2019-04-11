<?php
require '../../conf/log.class.php';
if(!isset($_SESSION[USER])){
	header("Location:../login/login.php");exit;
}else{
	$username=$_SESSION[USER];
	if(isset($_POST["submit"])){
	$psw=$lg->ckinput(trim($_POST["psw"]));
	$psw1=$lg->ckinput(trim($_POST["psw1"]));
	if($psw==$psw1 && !empty($psw) && !empty($psw1)){
		$sql="update admin set userpsw='$psw' where username='$username'";
		if($lg->imd($sql)){
			$suc_fal=$lg->outalert("修改成功");
		}else{
			$suc_fal=$lg->outalert("修改失败");
		}
	}else{
		$error=$lg->outalert("两次密码不一致或不能为空");
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
<?php echo $suc_fal; echo $error;?>
<title>密码管理</title>
</head>

<body>
<fieldset style="margin:100px 0px 0px 200px; width:400px; padding:20px;">
<form name="form1" method="post">
新密码：<input type="password" name="psw" /><br /><br />
确认新密码：<input type="password" name="psw1" /><br /><br />
<input type="submit" name="submit" value=" 修  改  " />

</form>
</fieldset>
</body>
</html>
