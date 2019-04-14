<?php
require '../../conf/log.class.php';
if(!isset($_SESSION[USER])){
	header("Location:../login/login.php");exit;
}else{
	$sql="select * from video order by is_top desc,time desc";
	$video_arr=$lg->select_arr2($sql);
	$video_num=count($video_arr);
	$str_prompt = $str_gopage = '';
	if(isset($_POST["video_submit"])){
		// $video_url=$_POST["url"];
		$video_local_url = $_POST['video'];
		$video_time=date("Y-m-d h:i:s",time());
		$bz=$_POST["bz"];
		$pic = $_POST['vpic'];
		echo $sql="insert into video (lurl,time,name,pic) values('$video_local_url','$video_time','$bz', '$pic')";
		if($lg->imd($sql)){
			$str_prompt=$lg->outalert("添加视频成功!");
			$str_gopage=$lg->gopage("man_video.php");
		}else{
			$str_prompt=$lg->outalert("添加视频失败");
		}		
	}
	
?>	
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<link type="text/css" rel="stylesheet" href="../../css/common.css" />
<link type="text/css" rel="stylesheet" href="../../css/admin.css" />
<link type="text/css" rel="stylesheet" href="../../css/zy.media.min.css" />
<script language="javascript" type="text/javascript" src="../../js/jquery.min.js"></script>

<!-- <script language="javascript" type="text/javascript" src="../../js/ajaxfileupload.js"></script> -->
<title>视频管理</title>
<?php echo $str_prompt; echo $str_gopage;?>
</head>

<body>
			
<script type="text/javascript">
function ajaxFileUpload()
{
	var processNum = $('#upload');
	
	upload();
	function upload(){
        var file = document.getElementById('keypic').files[0];
		var form = new FormData();
		form.append('keypic',file);
		$.ajax({
			url: 'doajaxfileupload.php',//上传地址
			async: true,//异步
			type: 'post',//post方式
			data: form,//FormData数据
			processData: false,//不处理数据流 !important
			contentType: false,//不设置http头 !important
			dataType: 'json',
			xhr:function(){//获取上传进度            
					myXhr = $.ajaxSettings.xhr();
					if(myXhr.upload){
						myXhr.upload.addEventListener('progress',function(e){//监听progress事件
						var loaded = e.loaded;//已上传
							var total = e.total;//总大小
							var percent = Math.floor(100*loaded/total);//百分比
							processNum.attr('disabled',true).val(percent+"%");//数显进度
							// processBar.css("width",percent+"px");//图显进度}, false);
					})
					return myXhr;
				}
			},
			success: function(data){//上传成功回调
				var txt = '继续上传';
				if(data.err) {
					alert(data.err)
					txt = '重新上传';
				}
				$('#video').val(data.filename);
				processNum.attr('disabled',false).val(txt);//数显进度
			}
		})
    }

	return false;
}
function ajaxPicUpload()
{

		var file = document.getElementById('mpic').files[0];
		var form = new FormData();
		form.append('mpic',file);
		$.ajax({
			url: 'doajaxfileupload.php?inputname=mpic',//上传地址
			async: true,//异步
			type: 'post',//post方式
			data: form,//FormData数据
			processData: false,//不处理数据流 !important
			contentType: false,//不设置http头 !important
			dataType: 'json',
		
			success: function(data){//上传成功回调
				document.getElementById("spic").innerHTML='<img src="' + data.msg + '" />';
				document.getElementById("vpic").value=data.filename;
			}
		})

	return false;
}
</script>
<style>
.zy_media{z-index: 999999999}
</style>
<form name="from_video" method="post">
<table class="admin_mhover" style="width:100%;">	
	<tbody>
	<tr>
		<td style="width:20%">视频标题：<input type="text" name="bz" value="" /></td>
		<!-- <td style="width:20%">
		外部视频地址：<input type="text" name="url" value="" style="width:200px;" /><span>(第三方平台视频地址)</span></td> -->
		<td style="width:10%">
		视频封面图：<input type="file" name="mpic"  id="mpic" onchange="ajaxPicUpload()" value="" />
		<input type="hidden" name="vpic" id="vpic">
			<span id="spic"></span>
	</td>
		<td style="width:45%">
		添加视频文件：<input type="file" name="keypic" id="keypic" /> 
		<input type="hidden" id="video" value="" name="video" />
		<input type="button" onclick="ajaxFileUpload();" id="upload" style=" min-width:80px;" value="上传" /></td>
		<td style="width:25%"> <input type="submit" name="video_submit" value="添加视频" /></td>
	</tr>
	<tr>
		<td colspan="4" style="height:50px;text-align:center;">视频列表</td>
	</tr>
	<tr>
		<td>标题</td>
		<td>视频封面图</td>
		<td>本站视频地址</td>
		<td>操作</td>
	</tr>
	<?php 
	for($i=0;$i<$video_num;$i++){
		if($video_arr[$i]["is_top"]) $is_index="已在首页"; else $is_index="首页显示";
	?>
	<tr>
		<td style="width:20%"><?php echo $video_arr[$i]["name"]?></td>
		<td style="width:20%"><img src='<?php echo PATH_IMG.$video_arr[$i]["pic"]?>' /> </td>
		<td>
			<div class="zy_media" style="width: 200px; height: 150px;">
			<video  data-config='{"mediaTitle": "<?php echo $video_arr[$i]["name"]?>"}'>
        	<source src="<?php echo "/htmleditor/attached/video/".$video_arr[$i]['lurl'] ?>" type="video/mp4">
      	  	您的浏览器不支持HTML5视频
   	 		</video></div></td>
		<td style="width:30%"> 
		<input type="button" name="del_video" value="删除" onclick="if(confirm('你确定删除吗?'))window.location.href='del_video.php?id=<?php echo $video_arr[$i]["id"];?>'; else return false;" />
		<!-- <input type="button" name="set_index" value="<?php echo $is_index;?>" onclick="window.location.href='set_video.php?id=<?php echo $video_arr[$i]["id"];?>'" /> -->
		</td>
	</tr>
	<?php }?>
	</tbody>

</table>
</form>
<script language="javascript" type="text/javascript" src="../../js/zy.media.min.js"></script>
<script>
	
zymedia('video',{autoplay: false});
</script>

</body>
</html>

<?php	
}
?>