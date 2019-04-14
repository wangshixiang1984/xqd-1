<?php
require '../../conf/log.class.php';
if(!isset($_SESSION[USER])){
	header("Location:../login/login.php");exit;
}else{
	$str_prompt = $str_error = '';
	if(isset($_POST["submit"])){
		$xcap_title=$lg->ckinput($_POST["title"]);
		// $xcap_size=intval($_POST["size"]);
		$xcap_theme=$lg->ckinput($_POST["theme"]);
		$xcap_newtheme = $lg->ckinput(trim($_POST['newtheme']));
		$xcap_theme = empty($xcap_newtheme) ? $xcap_theme : $xcap_newtheme;
		
		$xcap_gocity =  $lg->ckinput(trim($_POST['area']));
		$xcap_newgocity =  $lg->ckinput(trim($_POST['newarea']));
		$xcap_gocity = empty($xcap_newgocity) ? $xcap_gocity : $xcap_newgocity;
		$xcap_keyword=$lg->ckinput($_POST["keyword"]);
		$xcap_des=$lg->ckinput($_POST["des"]);
		$xcap_keypic=$_POST["picfile"];
		$xcap_citypic=$_POST["citypicfile"];
		$xcap_author=$lg->ckinput($_POST["author"]);
		// $xcap_price=$lg->ckinput($_POST["price"]);
		// $xcap_boyprice=$lg->ckinput($_POST["boyprice"]);
		$startplace=$_POST["startplace"];
		$mile=$_POST["mile"];
		$xcap_goday=$_POST["goday"];
		$xcap_time=date("Y-m-d h:i:s",time());
		// $xcap_content=$lg->ckinput($_POST["content"]);
		$xcap_content_desc=$lg->ckinput($_POST["content_desc"]);
		$xcap_content_needknow=$lg->ckinput($_POST["content_needknow"]);
		$xcap_content_fee=$lg->ckinput($_POST["content_fee"]);

		echo $sql="insert into xcap (title,gotheme,keyword,des,img_path,author,goday,time,
		gocity, content_desc, content_fee, content_needknow, startplace, mile) 
		values('$xcap_title','$xcap_theme','$xcap_keyword','$xcap_des','$xcap_keypic','$xcap_author',
		'$xcap_goday','$xcap_time','$xcap_gocity', 
		'$xcap_content_desc', '$xcap_content_fee', '$xcap_content_needknow', '$startplace', '$mile')";
		if(!empty($xcap_keypic)){
		if($lg->imd($sql)){
			//立即执行查询，得到ID
			// $res = $lg->select_arr1("select id from xcap order by id desc limit 1");
			// $id = $res['id'];
			// $sqldate = "insert into xcdate (godate, gomonth, xcapid) values";
			// foreach($xcap_godates as $key => $date){
			// 	$sqldate .= '("' . $date. '","' . date('n', strtotime($date)) .'","' . $id .'")';
			// 	if($key+1 < count($xcap_godates)){
			// 		$sqldate .= ', ';
			// 	}
			// }
			// if($lg->imd($sqldate)){
			$str_prompt=$lg->outalert("发布成功!");			
			// }else{
			// 	$str_prompt=$lg->outalert("日期写入失败，请在修改里面重新填写日期");
			// }
			
		}else{
			$str_prompt=$lg->outalert("发布出错啦!再试试");
		}
		}else{
			$str_error=$lg->outalert("主图不能为空");
		}
	}
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link type="text/css" rel="stylesheet" href="../../css/common.css" />

<script language="javascript" type="text/javascript" src="../../js/jquery.min.js"></script>
<script language="javascript" type="text/javascript" src="../../js/ajaxfileupload.js"></script>
<script charset="utf-8" src="../../htmleditor/kindeditor-min.js"></script>
<script charset="utf-8" src="../../htmleditor/lang/zh_CN.js"></script>
<script charset="utf-8" src="/js/Ecalendar.jquery.min.js"></script>
<title>行程安排添加</title>
<?php echo $str_prompt; echo $str_error;?>

<style type="text/css">
#spic img,
#cpic img
{width:80px; height:60px;}
</style>
</head>
<body>
<form name="form1" method="post" enctype="multipart/form-data">
<table  style="width:100%; postion:absolute; color:#000; font-size:14px;">
	<tbody>
		<tr><td style="width:2%;"></td><td style="width:10%"></td><td><div style="text-align:right"><a href="man_xcap.php">往上一级</a></div></td></tr>
		<tr>
			<td ></td>
			<td >标题：</td>
			<td><input type="text" name="title" id="title" style="width:300px; height:25px;" /><span id="pmsgt" style="color:#f00; font-size:12px;">*</span></td>
		</tr>
		<!-- <tr>
			<td ></td>
			<td >类别：</td>
			<td><select name="type">
						<option value="0">国内自驾</option>
						<option value="1">境外自驾</option>
						<option value="2">落地自驾</option>
					  </select>
			</td>
		</tr> -->
		
		<tr>
			<td ></td>
			<td >标签：</td>
			<td><input type="text" name="keyword" style="width:300px; height:25px;" /></td>
		</tr>
		<tr>
			<td ></td>
			<td >描述：</td>
			<td><textarea name="des" cols="40" rows="2" ></textarea></td>
		</tr>		
		<tr>
			<td></td>
			<td >作者：</td>
			<td><input type="text" name="author" style=" height:25px;"/></td>
		</tr>
		<tr>
			<td></td>
			<td >出发地：</td>
			<td><input type="text" name="startplace" style=" height:25px;" value="" /></td>
		</tr>
		<tr>
			<td></td>
			<td >行程里程：</td>
			<td><input type="text" name="mile" style=" height:25px;" value="" /></td>
		</tr>
		<!-- 主题 -->
		<tr>
			<td ></td>
			<td >主题：</td>
			<td>从已有选择：<select name="theme" style="width:120px;">
				<?php 
				$sql = 'select distinct(gotheme) from xcap';
				$themes = $lg->select_arr2($sql);
				for($i = 0; $i < count($themes); $i++){
				?>
						<option value="<?php echo $themes[$i]['gotheme']; ?>"><?php echo $themes[$i]['gotheme']; ?></option>
				<?php }?>
				</select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;新增一个主题 ：<input type = "text" name="newtheme" /> 
				</td>
		</tr>
		<!-- 地区 -->
		<tr>
			<td ></td>
			<td >地区：</td>
			<td>从已有选择：<select name="area" style="width:120px;">
				<?php 
				$sql = 'select distinct(gocity) from xcap';
				$themes = $lg->select_arr2($sql);
				for($i = 0; $i < count($themes); $i++){
				?>
						<option value="<?php echo $themes[$i][0]; ?>"><?php echo $themes[$i][0]; ?></option>
				<?php }?>
				</select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;新增一个地区 ：<input type = "text" name="newarea" /> 
			</td>
		</tr>
		<!-- <tr>
			<td></td>
			<td >地区图片</td>
			<td>
				<input type="file" name="citypic" id="citypic" onchange="return ajaxFileUpload('citypic');"/>
				<img id="loading" src="loading.gif" style="display:none;" />			
				<span id="cpic"></span>
				<input type="hidden" id="citypicfile" name="citypicfile" />
				</td>
		</tr>		 -->
		<!-- <tr>
			<td></td>
			<td >行程价格：</td>
			<td><input type="text" name="price" id="price" style="height:25px;" /><span id="pricemsg" style="color:#f00; font-size:12px;">*</span></td>
		</tr>
		<tr>
			<td></td>
			<td >儿童价格：</td>
			<td><input type="text" name="boyprice" id="boyprice" style="height:25px;" /></td>
		</tr>
		<tr>
			<td></td>
			<td >发团日期：</td>
			<td style="postion:relative;"><input type="text" name="godate" class='ECalendar' id="godate" value="" style="height:25px;width:40%;" /> <span style="color:#f00; font-size:12px;">(多个发团日期用英文,逗号隔开，格式：2017-11-02，2017-11-10)</span></td>
			
		</tr> -->
		<tr>
			<td></td>
			<td>行程天数：</td>
			<td><input type="text" name="goday" id="goday" style="height:25px;" /> </td>
		</tr>
		<!-- <tr>
			<td></td>
			<td >主图尺寸：</td>
			<td><select name="size">
			<option value="0">小图</option>
			<option value="1">大图</option>
			</select></td>
		</tr> -->
		<tr>
			<td></td>
			<td >主图：</td>
			<td>
				<input type="file" name="keypic" id="keypic" onchange="return ajaxFileUpload('keypic');"/>
				<img id="loading" src="loading.gif" style="display:none;" />			
				<span id="spic"></span>
				<input type="hidden" id="picfile" name="picfile" />
				</td>
		</tr>
		<!-- <script>
			function up(){
				$("#keypic").pekeUpload();
			}
		</script> -->
		<tr>
			<td></td>
			<td >行程概要：</td>
			<td><textarea  name="content_desc" style="width:1000px; height:200px;"></textarea></td>
		</tr>
		<!-- <tr>
			<td></td>
			<td >行程介绍：</td>
			<td><textarea  name="content" style="width:1000px; height:200px;"></textarea></td>
		</tr> -->
		<tr>
			<td></td>
			<td >费用：</td>
			<td><textarea  name="content_fee" style="width:1000px; height:200px;"></textarea></td>
		</tr>
		<tr>
			<td></td>
			<td >预订须知：</td>
			<td><textarea  name="content_needknow" style="width:1000px; height:200px;"></textarea></td>
		</tr>
		<tr><td colspan="3" style="text-align:center">
				<input type="submit" name="submit" id="submit" value="发布" style="width:100px; height:40px; text-align:center;" />
			</td>
		</tr>
		<tr><td></td><td></td><td style="height:20px; font-size:12px;">成都慧萌咨询技术支持 &nbsp;&nbsp;  心启点自驾俱乐部版权所有</td></tr>
	</tbody>
</table>
</form>
<script>
// $(function(){
// 	$("#godate").ECalendar({
// 		type:"date",
// 		skin:"#233",
// 		offset:[0,2]
// 	});
// });
</script>
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
	var params = '?inputname=' + type;
	// console.log(type || 'keypic')
	$.ajaxFileUpload
	(
		{
			url:'doajaxfileupload.php' + params,
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
				console.log(e);
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
						$('#spic').html()!=""
						){
					$('#subimt').submit();
				}else{
					return false;
					}
				});
				
			});
</script>
</body>
</html>
<?php }?>	
