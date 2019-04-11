<?php
require '../../conf/config.inc.php';
if(!isset($_SESSION[USER])){
	header("Location:../login/login.php");exit;
}else{
	unset($_SESSION[USER]);
	session_destroy();
	header("Location:../login/login.php");exit;
}
?>