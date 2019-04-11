<?php
require '../../conf/log.class.php';
if(!isset($_SESSION[USER])){
	header("Location:../login/login.php");exit;
}else{

	$id = intval($_GET['id']);
	$res = $lg->select_arr2("select * from xcdate where xcapid = $id");
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link type="text/css" rel="stylesheet" href="../../css/common.css" />
<link type="text/css" rel="stylesheet" href="../../css/admin.css" />
<script language="javascript" type="text/javascript" src="../../js/jquery.min.js"></script>
<script language="javascript" type="text/javascript" src="../../js/layer.js"></script>
<title>行程安排添加</title>

<style type="text/css">
#spic img{width:80px; height:60px;}
.pricelist li{height:20px; border-bottom:1px solid #ddd;}
.delprice a:hover{color:#abb;}
</style>
</head>
<body>
<form name="form1" method="post" id="formi" enctype="multipart/form-data">
<table  style="width:100%; postion:absolute; color:#000; font-size:14px;">
	<tbody>
		<tr><td style="width:2%;"></td><td style="width:10%"></td><td><div style="text-align:right"><a href="man_xcap.php">返回</a></div></td></tr>
		<tr>
			<td></td>
			<td >已添加发团日期及价格信息：</td>
			<td><ul class="pricelist">
				<?php
				for($i = 0; $i < count($res); $i++){?>
				<li>日期：<?php echo $res[$i]['godate']?> &nbsp;&nbsp;&nbsp;&nbsp;
				成人价：<?php echo $res[$i]['price']?> &nbsp;&nbsp;&nbsp;&nbsp;
				儿童价：<?php echo $res[$i]['boyprice']?>&nbsp;&nbsp;&nbsp;&nbsp;
				最低价：<?php echo $res[$i]['minprice']?>&nbsp;&nbsp;&nbsp;&nbsp;
				余位：<?php echo $res[$i]['leftpeople']?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span><a href="#" data-id="<?php echo $res[$i]['id']; ?>" class="delprice">删除</a></span></li>
				<?php }?></ul></td>
		</tr>
		<tr>
			<td></td>
			<td >行程价格：</td>
			<td><input type="number" name="price" id="price" style="height:25px;" /><span id="pricemsg" style="color:#f00; font-size:12px;">*</span></td>
		</tr>
		<tr>
			<td></td>
			<td >儿童价格：</td>
			<td><input type="number" name="boyprice" id="boyprice" style="height:25px;" /></td>
		</tr>
		<tr>
			<td></td>
			<td >行程最低价格：</td>
			<td><input type="number" name="minprice" id="minprice" style="height:25px;" /> <span style="color:#f00; font-size:12px;">(行程显示多少元起，用这个价格)</span></td>
		</tr>
		<tr>
			<td></td>
			<td >发团日期：</td>
			<td style="postion:relative;"><input type="text" name="godate" class='ECalendar' id="godate" value="" style="height:25px;width:40%;" /> <span style="color:#f00; font-size:12px;">(多个发团日期用英文,逗号隔开，格式：2017-11-02，2017-11-10)</span></td>
			<!-- <div id='schedule-box' class="boxshaw"></div> -->
		</tr>
		<tr>
			<td></td>
			<td >余位：</td>
			<td><input type="text" name="leftpeople" id="leftpeople" style="height:25px;" /> 人</td>
		</tr>
		<tr><td></td>
		<td style="text-align:center" >
				
			</td><td><input type="button" name="submit" id="submit" value="添加一组信息" style="width:100px; height:40px; text-align:center;" /></td>
		</tr>
		<tr><td></td><td></td><td style="height:20px; font-size:12px;">成都慧萌咨询技术支持 &nbsp;&nbsp;  心启点自驾俱乐部版权所有</td></tr>
	</tbody>
</table>
</form>
<script>
$(function(){

	$('#submit').click(function(){
		var params = $('#formi').serialize();
		$.ajax({
			type : 'post',
			url : 'add_price.php',
			data : params+'&type=add&xcapid=<?php echo $id ?>',
			dataType : 'json',
			success : function(res){
				if(res.code == 0){
					location.href="add_priceinfo.php?id=<?php echo $id ?>";
				}
			}
		});
	});

	//删除
	$('.delprice').click(function(){
		var self = $(this);
		layer.alert('确定删除吗?',{
			'btn':['确定', '取消'],
			yes : function(){
				var id = self.data('id');
				$.post('add_price.php', {id:id, type:'delete'}, function(res){
					if(res.code == 0){
						location.href="add_priceinfo.php?id=<?php echo $id ?>";
					}
				}, 'json');
			}
		});
		
	});
})

</script>
</body>
</html>
<?php }?>	
