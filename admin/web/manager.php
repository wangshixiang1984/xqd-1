<?php
require '../../conf/log.class.php';
if(!isset($_SESSION[USER])){
	header("Location:../login/login.php");exit;
}else{
	$username=$_SESSION[USER];
	$sql="select * from admin where username='$username'";
	$manager=$lg->select_arr1($sql);
	if($manager["type"]==2){
		$strout=$lg->outalert("你无权进行此操作");
		$strout.="<script type='text/javascript'>window.history.go(-1);";
	}else{
		if($manager["type"]==1){	
			$sql="select * from admin where type!=0";
		}else{
			$sql="select * from admin";
		}
	}
	$manager_a=$lg->select_arr2($sql);
	$num_a=$lg->select_num($sql);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link type="text/css" rel="stylesheet" href="../../css/common.css" />
<link type="text/css" rel="stylesheet" href="../../css/admin.css" />
<?php echo $strout;?>
<title>账户管理</title>
</head>

<body>
<table class="admin_mhover">
	
	<thead class="admin_th">
		
		<tr><td class="w200">账户名称</td><td class="w100">密码</td><td>操作/<input type="button" value="添加管理员" onclick="window.location.href='manager_add.php'" /></td></tr>
	</thead>
	
	<tbody>
		<?php 
			for($i=0;$i<$num_a;$i++){
				
			
		?>
		<tr>
			<td><?php echo $manager_a[$i]["username"];?></td>
			<td><?php echo $manager_a[$i]["userpsw"];?></td>
			<td>
				<?php 
					if($_SESSION[USER]=="admin"){
						if($manager_a[$i]["username"]!="admin"){
				?>
						<input type="button" value="删除" onclick="if(confirm('你确定删除吗')) window.location.href='manager_del.php?id=<?php echo $manager_a[$i]["id"];?>'; else return false;" />
				<?php }}else{
					if($_SESSION[USER]==ADMIN_USER_NAME){
						if($manager_a[$i]["username"]!="zlszjy"){
				?>
						<input type="button" value="删除" onclick="if(confirm('你确定删除吗')) window.location.href='manager_del.php?id=<?php echo $manager_a[$i]["id"];?>'; else return false;" />
				<?php }}}?>
			</td>
		</tr>
		<?php }?>
	</tbody>

</table>
</body>
</html>