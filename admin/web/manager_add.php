<?php
require '../../conf/log.class.php';
if(!isset($_SESSION[USER])){
	header("Location:../login/login.php");exit;
}else{
	if($_POST["submit"]){
		$username=trim($lg->ckinput($_POST["username"]));
		$userpsw=trim($lg->ckinput($_POST["userpsw"]));	
		$sql="select * from admin";
		$arr_admin=$lg->select_arr2($sql);
		$admin_num=count($arr_admin);
		for($i=0;$i<$admin_num;$i++){
			if($arr_admin[$i]["username"]==$username) {$is_switch=0; break;} else $is_switch=1;
		}
		if($is_switch){
		if(!empty($username)&&!empty($userpsw)){
		$sql="insert into admin(username,userpsw) values('$username','$userpsw')";
		if($lg->imd($sql)){
			$sus_fal=$lg->outalert("添加成功");
			$sus_go=$lg->gopage("manager.php");
		}else{
			$sus_fal=$lg->outalert("添加失败");
		}
		}else{
			$sus_fal=$lg->outalert("用户名或密码不能为空");
		}
		}else{
			$sus_fal=$lg->outalert("用户名已经存在");
		}
	}
	
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<script language="javascript" type="text/javascript" src="../../js/jquery.js"></script>
<script language="javascript" type="text/javascript" src="../../js/ajaxfileupload.js"></script>
<script charset="utf-8" src="../../htmleditor/kindeditor-min.js"></script>
<script charset="utf-8" src="../../htmleditor/lang/zh_CN.js"></script>
<?php echo $sus_fal; echo $sus_go;?>
</head>
<body>
<form name="form1" method="post">
<fieldset style="width:400px; margin-left:200px; padding:20px;">
用户名：<input type="text" name="username" /><br /><br />
密码：<input type="text" name="userpsw" /><br /><br />
<input type="submit" name="submit" value="添加管理员" />
</fieldset>
</form>
</body>
</html>