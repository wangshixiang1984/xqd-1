<?php include '../../conf/log.class.php';?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php 
if(isset($_POST['btlog'])){
	$username=$lg->ckinput($_POST['username']);
	$userpsw=$lg->ckinput($_POST['userpsw']);
	$code=$_POST['ckcode'];
	$targetpage="../web/main.php";	
	$error=$lg->cklog($username, $userpsw, $code, $targetpage);
	echo $error;
}
?>

<title>心启点自驾游后台管理工作平台</title>
<script language="javascript" src="../../js/log.js"> </script>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	overflow:hidden;
}
.STYLE3 {font-size: 12px; color: #adc9d9; }
-->
</style></head>

<body>
<form name="from1" method="post">
<table width="100%"  height="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td bgcolor="#1075b1">&nbsp;</td>
  </tr>
  <tr>
    <td height="608" background="images/login_03.gif"><table width="847" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td height="318" background="images/login_04.jpg">&nbsp;</td>
      </tr>
      <tr>
        <td height="84"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="381" height="84" background="images/login_06.gif">&nbsp;</td>
            <td width="162" valign="middle" background="images/login_07.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="44" height="24" valign="bottom"><div align="right"><span class="STYLE3">用户</span></div></td>
                <td width="10" valign="bottom">&nbsp;</td>
                <td height="24" colspan="2" valign="bottom">
                  <div align="left">
                    <input type="text" name="username" id="textfield" style="width:100px; height:17px; background-color:#87adbf; border:solid 1px #153966; font-size:12px; color:#283439; ">
                  </div></td>
              </tr>
              <tr>
                <td height="24" valign="bottom"><div align="right"><span class="STYLE3">密码</span></div></td>
                <td width="10" valign="bottom">&nbsp;</td>
                <td height="24" colspan="2" valign="bottom"><input type="password" name="userpsw" id="textfield2" style="width:100px; height:17px; background-color:#87adbf; border:solid 1px #153966; font-size:12px; color:#283439; "></td>
              </tr>
              <tr>
                <td height="24" valign="bottom"><div align="right"><span class="STYLE3">验证码</span></div></td>
                <td width="10" valign="bottom">&nbsp;</td>
                <td width="52" height="24" valign="bottom"><input type="text" name="ckcode" id="textfield3" style="width:50px; height:17px; background-color:#87adbf; border:solid 1px #153966; font-size:12px; color:#283439; "></td>
                <td width="62" valign="bottom"><div align="left"><img src="../../conf/randcode.php?id=<?php echo rand(0,1000);?>" width="55" height="23" style="cursor:pointer;" id="randpic" onclick="javascript:refreshcode(this.id)"></div></td>
              </tr>
              <tr></tr>
            </table></td>
            <td width="26"><img src="images/login_08.gif" width="26" height="84"></td>
            <td width="67" background="images/login_09.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="25"><div align="center"><input type="hidden" value="submit" name="submit" /><input type="submit" value="登  录" width="40" height="18" name="btlog"></div></td>
              </tr>
              <tr>
                <td height="25"><div align="center"><img src="images/cz.gif" width="57" height="20"></div></td>
              </tr>
            </table></td>
            <td width="211" background="images/login_10.gif">&nbsp;</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td height="206" background="images/login_11.gif">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td bgcolor="#152753">&nbsp;</td>
  </tr>
</table>
</form>
</body>
</html>
