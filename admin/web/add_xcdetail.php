<?php
require '../../conf/log.class.php';
if(!isset($_SESSION[USER])){
	header("Location:../login/login.php");exit;
}else{

	$id = intval($_GET['id']);
	$desid = isset($_GET['desid']) ? $_GET['desid'] : 0;
	$res = $lg->select_arr2("select * from xcdes where xcapid = $id");
	if($desid > 0){
		$content = $lg->select_arr1("select * from xcdes where id='$desid'");
		$contentPics = [];
		if(!empty($content['daypic'])){
			$contentPics = explode(',', $content['daypic']);
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
<script language="javascript" type="text/javascript" src="../../js/layer.js"></script>
<script language="javascript" type="text/javascript" src="./js/pekeUpload.min.js"></script>
<title>行程安排添加</title>

<style type="text/css">
#spic img{width:80px; height:60px;}
.pricelist li{border-bottom:1px solid #ddd;}
.delprice a:hover{color:#abb;}
.descontent{border:solid 1px #999;width:100%; }
.descontent tr th{background:#eee;border-right:solid 1px #aaa;}
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
			<td>
						<table class="descontent">
							<tr><th width="8%">第几天</th><th width="15%">标题</th><th>行程介绍</th><th width="8%">用餐情况</th><th width="8%">住宿情况</th><th width="10%">配图</th><th width="10%">操作</th></tr>
							<?php
							for($i = 0; $i < count($res); $i++){
								$pics = [];
								if(!empty($res[$i]['daypic'])){
									$pics = explode(',', $res[$i]['daypic']);
								}
							?>
							<tr>
								<td><?php echo $res[$i]['whichday']?></td>
								<td><?php echo $res[$i]['daytitle']?></td>
								<td><?php echo $res[$i]['daydes']?></td>
								<td><?php echo $res[$i]['dinner']?></td>
								<td><?php echo $res[$i]['hotel']?></td>
								<td><?php for($j=0;$j<count($pics);$j++){ ?><img src="<?php echo PATH_IMG.$pics[$j];?>" width="80px" /> <?php }?></td>
								<td><a href="#" data-desid="<?php echo $res[$i]['id']; ?>" data-id="<?php echo $id; ?>" class="updatexcdes">修改</a>
								<a href="#" data-id="<?php echo $res[$i]['id']; ?>" class="delxcdes">删除</a></td>
							</tr>
							<?php }?>
						</table>
				</td>
		</tr>
		<tr>
			<td></td>
			<td >第几天：</td>
			<td><input type="number" name="days" id="days" style="height:25px;" value="<?php echo $desid > 0 ? $content['whichday'] : ''; ?>" /><span  style="color:#f00; font-size:12px;">例：1, 必填</span></td>
		</tr>
		<tr>
			<td></td>
			<td >行程标题：</td>
			<td><input type="text" name="title" id="title" style="height:25px;" value="<?php echo $desid > 0 ? $content['daytitle'] : ''; ?>"  /><span  style="color:#f00; font-size:12px;">例：第一天：成都－康定</span></td>
		</tr>
		<tr>
			<td></td>
			<td >行程介绍：</td>
			<td><textarea name="xcdes" cols="60" rows="5" id="xcdes"><?php echo $desid > 0 ? $content['daydes'] : ''; ?></textarea></td>
		</tr>
		<tr>
			<td></td>
			<td >行程配图：</td>
			<td style="postion:relative;">
				<input type="file" name="file" id="file" /> 
				<?php 
				if($desid > 0 ){
				for($j=0; $j<count($contentPics); $j++){?>
				<span id="daypicshow" style="display:block"><span><img src="<?php echo PATH_IMG.$contentPics[$j]; ?>" width="80px" /><br />  <br /> <a data-src="<?php echo $contentPics[$j]; ?>" onclick="deletePic(this)">删除</a></span></span>
				<?php }}?>
			</td>
			<input type="hidden" value="<?php echo $desid > 0 ? $content['daypic'] : ''; ?>" name="xcpics" id="xcpics" />
		</tr>
		<tr>
			<td></td>
			<td >用餐情况：</td>
			<td><input type="text" name="xcdinner" id="xcdinner" style="height:25px;"  value="<?php echo $desid > 0 ? $content['dinner']:''; ?>"  /><span  style="color:#f00; font-size:12px;">例：用餐：晚餐</span></td>
		</tr>
		<tr>
			<td></td>
			<td >住宿情况：</td>
			<td><input type="text" name="xchotel" id="xchotel" style="height:25px;"  value="<?php echo $desid > 0 ? $content['hotel']:''; ?>"  /><span  style="color:#f00; font-size:12px;">例：用餐：晚餐</span></td>
		</tr>
		<tr><td></td>
		<td style="text-align:center" >
		<?php
		if($desid >0){
			?>
			</td><td><input type="button" name="submit" id="submit" data-desid="<?php echo $desid; ?>" data-id=<?php echo $id; ?> data-type="update" value="修改行程介绍" style="width:100px; height:40px; text-align:center;" /></td>
		<?php }else{
			?>
			</td><td><input type="button" name="submit" id="submit" data-type="add" value="添加行程介绍" style="width:100px; height:40px; text-align:center;" /></td>
		<?php }?>
		</tr>
		<tr><td></td><td></td><td style="height:20px; font-size:12px;">成都慧萌咨询技术支持 &nbsp;&nbsp;  心启点自驾俱乐部版权所有</td></tr>
	</tbody>
</table>
</form>
<script>
function deletePic(obj){
	if(typeof obj !== 'undefined'){
		var self = $(obj);
		var src = self.data('src'),
		srcs = $('#xcpics').val();
		srcs = srcs.replace(','+src, '').replace(src+',', '').replace(src);
		$('#xcpics').val(srcs);
		self.parent().remove();
	}
}
$(function(){

	$('#file').pekeUpload({
		btnText:'选择配图',
		url:'upload.php',
		delfiletext:'删除这张',
		onFileSuccess:function(file, data){
			var picstr = $('#xcpics').val();
			if(picstr == ''){
				picstr = data.src;
			}else{
				picstr += ',' + data.src;
			}
			$('#xcpics').val(picstr);
		},
		onFileError:function(file, error){
			layer.msg(error);
		}
	});


	$('#submit').click(function(){
		var params = $('#formi').serialize();
		var doType = $(this).data('type');
		var content = '发布成功';
		if(doType == 'update'){
			content = '修改成功';
		}
		$.ajax({
			type : 'post',
			url : 'add_xcdetail_con.php',
			data : params+'&type='+doType+'&xcapid=<?php echo $id ?>&desid=<?php echo $desid; ?>',
			dataType : 'json',
			success : function(res){
				if(res.code == 0){
					layer.open({
						content:content,
						btn : ['确定'],
						yes:function(){
							location.href="add_xcdetail.php?id=<?php echo $id ?>";
						}
					});
				}
			}
		});
	});

	//删除
	$('.delxcdes').click(function(){
		var self = $(this);
		layer.alert('确定删除吗?',{
			'btn':['确定', '取消'],
			yes : function(){
				var id = self.data('id');
				$.post('add_xcdetail_con.php', {desid:id, type:'delete'}, function(res){
					if(res.code == 0){
						location.href="add_xcdetail.php?id=<?php echo $id ?>";
					}
				}, 'json');
			}
		});
		
	});

	//修改
	$('.updatexcdes').click(function(){
		var self = $(this);
		var desid = self.data('desid'),
			id = self.data('id');

		location.href="add_xcdetail.php?desid="+desid+"&id="+id;
	});
})

</script>
</body>
</html>
<?php }?>	
