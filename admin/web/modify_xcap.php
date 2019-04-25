<?php
require '../../conf/log.class.php';
if(!isset($_SESSION[USER])){
	header("Location:../login/login.php");exit;
}else{
	$id=intval($_GET["id"]);
	$sql="select * from xcap where id='$id'";
	$xcap_arr1=$lg->select_arr1($sql);
	$sql = "select godate from xcdate where xcapid='$id'";
	$xcap_dates = $lg->select_arr2($sql);	
	$datesNum = count($xcap_dates);	
	$date = '';
	if(!empty($xcap_dates)){
		for($i = 0; $i < count($xcap_dates); $i++){
			// if(!isset($xcap_dates[$i])) {continue;}
			$date .= $xcap_dates[$i]['godate'];
			 if($i + 1 < count($xcap_dates)){
				 $date .= ',';
			 }
		}
	}
	$xcap_arr1["godate"] = $date;
	$str_info = $str_go = $str_prompt = '';
	if(isset($_POST["submit"])){
		$xcap_title=$lg->ckinput($_POST["title"]);
		$startplace = $_POST["startplace"];
		$mile=$_POST["mile"];
		$xcap_theme=$lg->ckinput($_POST["theme"]);
		$xcap_newtheme = $lg->ckinput(trim($_POST['newtheme']));
		//优先取输入框的主题
		if( $xcap_theme != $xcap_newtheme){
			if($xcap_newtheme != $xcap_arr1['gotheme']){
				$xcap_theme = $xcap_newtheme;
			}
		}
		
		$xcap_gocity =  $lg->ckinput(trim($_POST['area']));
		$xcap_newgocity =  $lg->ckinput(trim($_POST['newarea']));
		//优先取输入框的地区
		if( $xcap_gocity != $xcap_newgocity){
			if($xcap_newgocity != $xcap_arr1['gocity']){
				$xcap_gocity = $xcap_newgocity;
			}
		}	
		// $xcap_godate =$_POST['godate'];

		//日期单独写入库
		// $xcap_godates = explode(',', $xcap_godate);
		
		$xcap_keyword=$lg->ckinput($_POST["keyword"]);
		$xcap_des=$lg->ckinput($_POST["des"]);
		$xcap_keypic=$_POST["picfile"];
		$xcap_citypic=$_POST["citypicfile"];
		$xcap_author=$lg->ckinput($_POST["author"]);
		// $xcap_price=$lg->ckinput($_POST["price"]);
		// $xcap_boyprice=$lg->ckinput($_POST["boyprice"]);
		$xcap_goday=intval($_POST["goday"]);
		// $xcap_content=$lg->ckinput($_POST["content"]);
		$xcap_content_desc=$lg->ckinput($_POST["content_desc"]);
		$xcap_content_needknow=$lg->ckinput($_POST["content_needknow"]);
		$xcap_content_fee=$lg->ckinput($_POST["content_fee"]);

		if(empty($xcap_keypic)) $xcap_keypic=$xcap_arr1["img_path"];
		if(empty($xcap_citypic)) $xcap_citypic=$xcap_arr1["citypic"];

	    $sql="update xcap set title='$xcap_title',keyword='$xcap_keyword',des='$xcap_des',img_path='$xcap_keypic',
		author='$xcap_author', goday='$xcap_goday',gotheme='$xcap_theme', gocity='$xcap_gocity', startplace='$startplace', content_desc='$xcap_content_desc', 
		content_needknow='$xcap_content_needknow',citypic='$xcap_citypic', content_fee='$xcap_content_fee', mile='$mile' where id='$id'";
		$sqlImg = '';
		if($xcap_citypic != $xcap_arr1["citypic"]) {
			$sqlImg = "update xcap set citypic='$xcap_citypic' where gocity='$xcap_gocity'";
			if(!$lg->imd($sqlImg)) {
				$str_info=$lg->outalert("地区图片修改失败!");		
				exit();
			}
		}
		// $id = $xcap_arr1['id'];
		// $sqldate = "update xcdate (godate, gomonth, xcapid) values";
		// $newDatesNum = count($xcap_godates);
		// if($newDatesNum < $datesNum){
		// 	//删除
		// }
		// if($newDatesNum == $datesNum){
		// 	//修改
		// }
		// if($newDatesNum > $datesNum){
		// 	//增加
		// }
		// foreach($xcap_godates as $key => $date){
		// 	$sqldate .= '("' . $date. '","' . date('n', strtotime($date)) .'","' . $id .'")';
		// 	if($key+1 < count($xcap_godates)){
		// 		$sqldate .= ', ';
		// 	}
		// }

	
		if($lg->imd($sql)){
			$str_info=$lg->outalert("修改成功!");			
			$str_go=$lg->gopage("man_xcap.php");		
		}else{
			$str_prompt=$lg->outalert("修改出错啦!再试试");
		}
		
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
<script charset="utf-8" src="../../htmleditor/kindeditor-min.js"></script>
<script charset="utf-8" src="../../htmleditor/lang/zh_CN.js"></script>
<script charset="utf-8" src="/js/Ecalendar.jquery.min.js"></script>
<title>行程安排修改</title>
<?php echo $str_info.$str_go; echo $str_prompt; ?>

<style type="text/css">
#spic img,
#cpic img
{width:80px; height:60px;}
</style>
</head>
<body>
<form name="form1" method="post" enctype="multipart/form-data">
<table style="width:100%;  color:#000; font-size:14px;">
	<tbody>
			<tr><td style="width:2%;"></td><td style="width:10%"></td><td><div style="text-align:right"><a href="man_xcap.php">往上一级</a></div></td></tr>
		<tr>
			<td ></td>
			<td >标题：</td>
			<td><input type="text" name="title" id="title" style="width:300px; height:25px;" value="<?php echo $xcap_arr1["title"];?>" /><span id="pmsgt" style="color:#f00; font-size:12px;"></span></td>
		</tr>
		
		<tr>
			<td ></td>
			<td >标签：</td>
			<td><input type="text" name="keyword" style="width:300px; height:25px;" value="<?php echo $xcap_arr1["keyword"];?>" /></td>
		</tr>
		<tr>
			<td ></td>
			<td >描述：</td>
			<td><textarea name="des" cols="40" rows="2" ><?php echo $xcap_arr1["des"];?></textarea></td>
		</tr>		
		<tr>
			<td></td>
			<td >作者：</td>
			<td><input type="text" name="author" style=" height:25px;" value="<?php echo $xcap_arr1["author"];?>" /></td>
		</tr>
		<tr>
			<td></td>
			<td >出发地：</td>
			<td><input type="text" name="startplace" style=" height:25px;" value="<?php echo $xcap_arr1["startplace"];?>" /></td>
		</tr>
		<tr>
			<td></td>
			<td >行程里程：</td>
			<td><input type="text" name="mile" style=" height:25px;" value="<?php echo $xcap_arr1["mile"];?>" /></td>
		</tr>
		<!-- 主题 -->
		<tr>
			<td ></td>
			<td >主题：</td>
			<td>从已有选择：<select name="theme" id="theme" style="width:120px;">
				<?php 
				$sql = 'select distinct(gotheme) from xcap where gotheme !=""';
				$themes = $lg->select_arr2($sql);
				for($i = 0; $i < count($themes); $i++){
				?>
						<option value="<?php echo $themes[$i]['gotheme']; ?>" <?php if($themes[$i][0] == $xcap_arr1['gotheme']) {?>selected="selected"<?php }?>><?php echo $themes[$i]['gotheme']; ?></option>
				<?php }?>
				</select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				修改主题 ：<input type = "text" name="newtheme" value="<?php echo $xcap_arr1['gotheme'];?>" /> 
				<button id="delTheme">删除此主题</button>
			</td>
		</tr>
		<!-- 地区 -->
		<tr>
			<td ></td>
			<td >地区：</td>
			<td>从已有选择：<select name="area" id="area" style="width:120px;">
				<?php 
				$sql = 'select distinct(gocity) from xcap where gocity != ""';
				$themes = $lg->select_arr2($sql);
				for($i = 0; $i < count($themes); $i++){
				?>
						<option value="<?php echo $themes[$i][0];  ?>" <?php if($themes[$i][0] == $xcap_arr1['gocity']) {?>selected="selected"<?php }?> ><?php echo $themes[$i][0]; ?></option>
				<?php }?>
				</select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;修改地区 ：<input type = "text" name="newarea" value="<?php echo $xcap_arr1['gocity'];?>" /> 
				<button id="delArea">删除此地区</button>
			</td>
		</tr>	
		<tr>
			<td></td>
			<td >地区图片</td>
			<td>
				<input type="file" name="citypic" id="citypic" onchange="return ajaxFileUpload('citypic');"/>
				<img id="loading" src="loading.gif" style="display:none;" />			
				<span id="cpic"><img src="<?php echo PATH_IMG.$xcap_arr1["citypic"];?>" /></span>
				<input type="hidden" value="<?php echo $xcap_arr1["citypic"];?>" id="citypicfile" name="citypicfile" />
				</td>
		</tr>		
		<!-- <tr>
			<td></td>
			<td >行程价格：</td>
			<td><input type="text" name="price" id="price" style="height:25px;" value="<?php echo $xcap_arr1["price"];?>" /><span id="pricemsg" style="color:#f00; font-size:12px;"></span></td>
		</tr>
		<tr>
			<td></td>
			<td >儿童价格：</td>
			<td><input type="text" name="boyprice" id="boyprice" style="height:25px;" value="<?php echo $xcap_arr1["boyprice"];?>" /></td>
		</tr>
		<tr>
				<td></td>
				<td >发团日期：</td>
				<td style="postion:relative;"><input type="text" name="godate" value="<?php echo $xcap_arr1["godate"];?>" id="godate" style="height:25px; width:40%;" /> <span style="color:#f00; font-size:12px;">(多个发团日期用英文,逗号隔开，格式：2017-11-02，2017-11-10)</span></td>
		</tr> -->
		<tr>
			<td></td>
			<td>行程天数：</td>
			<td><input type="text" name="goday" id="goday" style="height:25px;" value="<?php echo $xcap_arr1["goday"];?>" /> </td>
		</tr>
		
		<!-- <tr>
			<td></td>
			<td >主图尺寸：</td>
			<?php $xcap_arr1["size"]==0?$selected1='selected="selected"': $selected2='selected="selected"';?>
			<td><select name="size">
			<option value="0" <?php echo $selected1;?>>小图</option>
			<option value="1" <?php echo $selected2;?>>大图</option>
			</select></td>
		</tr> -->
		
		<tr>
			<td></td>
			<td >主图：</td>
			<td><input type="file" name="keypic" id="keypic" onchange="return ajaxFileUpload('keypic');"/>
				<img id="loading" src="loading.gif" style="display:none;" />			
				<span id="spic"><img src="<?php echo PATH_IMG.$xcap_arr1["img_path"];?>" /></span>
				<input id="picfile" name="picfile" style="visibility:hidden;" />
				</td>
		</tr>
		
		<tr>
			<td></td>
			<td >行程概要：</td>
			<td><textarea  name="content_desc" style="width:1000px; height:200px;"><?php echo $xcap_arr1["content_desc"];?></textarea></td>
		</tr>
		
		<tr>
			<td></td>
			<td >费用：</td>
			<td><textarea  name="content_fee" style="width:1000px; height:200px;"><?php echo $xcap_arr1["content_fee"];?></textarea></td>
		</tr>
		<tr>
			<td></td>
			<td >预订须知：</td>
			<td><textarea  name="content_needknow" style="width:1000px; height:200px;"><?php echo $xcap_arr1["content_needknow"];?></textarea></td>
		</tr>
		
		<tr><td colspan="3" style="text-align:center">
				<input type="submit" name="submit" id="submit" value="确认修改" style="width:100px; height:40px; text-align:center;" />
			</td>
		</tr>
		<tr><td></td><td></td><td style="height:20px; font-size:12px;">成都慧萌咨询技术支持 &nbsp;&nbsp;  心启点自驾俱乐部版权所有</td></tr>
	</tbody>
</table>
</form>
<script>
	KindEditor.ready(function(K) {
		var editor = K.create('textarea[name="content"]', {
			allowFileManager : true
		});
		var editor_desc = K.create('textarea[name="content_desc"]', {
			allowFileManager : true
		});
		var editor_fee = K.create('textarea[name="content_fee"]', {
			allowFileManager : true
		});
		var editor_needknow = K.create('textarea[name="content_needknow"]', {
			allowFileManager : true
		});

	});
</script>
		
<script type="text/javascript">
function ajaxFileUpload(type)
{
	// $("#loading")
	// .ajaxStart(function(){
	// 	$(this).show();
	// })
	// .ajaxComplete(function(){
	// 	$(this).hide();
	// });

	$.ajaxFileUpload
	(
		{
			url:'doajaxfileupload.php' + '?inputname=' + type,
			secureuri:false,
			fileElementId: type,
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
						if(type === 'keypic') {	
							document.getElementById("spic").innerHTML='<span><img src="' + data.msg + '" />';
							document.getElementById("picfile").value=data.filename;
						} else {
							document.getElementById("cpic").innerHTML='<span><img src="' + data.msg + '" />';
							document.getElementById("citypicfile").value=data.filename;
						}
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
<script type="text/javascript">

		$(document).ready(function(){

			$('#title').blur(function(){
				var inputval=$('#title').val();
				if(inputval.length==0 || inputval==''){
					$('#pmsgt').css("display","none");
					$('#pmsgt').html(" <img src='../../bgimage/error.png'/> 标题不能为空");
					$('#pmsgt').css({"color":"#ff0000","font-size":"12px"});
					$('#pmsgt').fadeIn("slow");
					return;
				}else{
					$('#pmsgt').html("");
				}
				
			});

			
			$('#gotime').blur(function(){
				var inputval=$('#gotime').val();
				if(inputval.length==0 || inputval==''){
					$('#gotimemsg').css("display","none");
					$('#gotimemsg').html(" <img src='../../bgimage/error.png'/> 行程日期不能为空");
					$('#gotimemsg').css({"color":"#ff0000","font-size":"12px"});
					$('#gotimemsg').fadeIn("slow");
				}else{
					$('#gotimemsg').html("");
				}
				
			});

			$('#price').blur(function(){
				var inputval=$('#price').val();
				var reg=/^[0-9]*$/;
				if(inputval.length==0 || inputval==''){
					$('#pricemsg').css("display","none");
					$('#pricemsg').html(" <img src='../../bgimage/error.png'/> 价格不能为空");
					$('#pricemsg').fadeIn("slow");
				}
				else if(!inputval.match(reg)){
					$('#pricemsg').css("display","none");
					$('#pricemsg').html(" <img src='../../bgimage/error.png'/> 价格必须为数字");
					$('#pricemsg').css({"color":"#ff0000","font-size":"12px"});
					$('#pricemsg').fadeIn("slow");
				}else{
					$('#pricemsg').html("");
				}
				
			});
			
			$('#submit').click(function(){
				if(
						$.trim($('#pmsgt').text())=="" && 
						$.trim($('#pricemsg').text())=="" &&
						$.trim($('#gotimemsg').text())=="" &&
						$('#spic').html()!=""
						){
					$('#subimt').submit();
				}else{
					return false;
					}
			});
			// 删除主题和地区
			$('#delArea').click( function() {
				if(!confirm('你确定删除此地区吗？')) return;
				var area = $.trim($('#area').val());
				$.get('del_tharea.php?type=area&name='+area, function(res){
					if(res.code != 0) {
						alert('删除出错！')
						return;
					} else {
						alert('删除成功');
						window.location.href="modify_xcap.php?id=<?php echo $id; ?>";
					}
				}, 'json')
			})
			$('#delTheme').click( function() {
				if(!confirm('你确定删除此主题吗？')) return;
				var theme = $.trim($('#theme').val());
				$.get('del_tharea.php?type=theme&name='+theme, function(res){
					if(res.code != 0) {
						alert('删除出错！')
						return;
					} else {
						alert('删除成功');
						window.location.href="modify_xcap.php?id=<?php echo $id; ?>";
					}				
				}, 'json')
			})
		});
</script>
<script>
// $(function(){
// 	$("#godate").ECalendar({
// 		type:"date",
// 		skin:"#233",
// 		offset:[0,2]
// 	});
// });
</script>
</body>
</html>
<?php }?>	
