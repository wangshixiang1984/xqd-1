<?php
require '../../conf/log.class.php';
if(!isset($_SESSION[USER])){
	header("Location:../login/login.php");exit;
}else{
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>心启点自驾游管理平台</title>
</head>

<frameset rows="127,*,11" frameborder="no" border="0" framespacing="0">
  <frame src="top.php" name="topFrame" scrolling="no" noresize="noresize" id="topFrame" />
  <frame src="center.html" name="mainFrame" id="mainFrame" />

</frameset>
<noframes><body>
</body>
</noframes></html>
<?php }?>