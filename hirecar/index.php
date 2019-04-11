<?php 
$urlType = 6;
include "../head/head_add.php";

$sql = "select * from car";
$type = $lg->ckinput(isset($_GET['type']) ? $_GET['type'] : 'short');
if($type == 'short'){
	$sql .= ' where days < 7 ';
}else if($type == 'week'){
	$sql .= ' where days >= 7 and days <= 14 ';
}else{
	$sql .= ' where days > 27 ';
}
$pagination = $funcop->split_page(15, 5, $sql, ['type' => $type]);
$sql = $pagination[0];
$list = $lg->select_arr2($sql);
$pagination_page = $pagination[1];
include "../head/head.php" ; 
?>

	<link rel="stylesheet" type="text/css" href="./线路详情_files/jedate.css">
<script src="./线路详情_files/hotel-book.js.下载"></script>
<script src="./线路详情_files/json2.js.下载"></script>
<script src="./线路详情_files/jedate.min.js.下载"></script>

<div class="container">
	<div class="car-banner" style="background: url(/Theme/Simple/images/hirecar.jpg) no-repeat center top;"></div>
	<div class="pagemc">
		<div class="car-search mt20 clearfix">
			<a href="./index.php?type=short" <?php if($type =='short'){?> class="cur" <?php }?>>短租(7天内)</a>
			<a href="./index.php?type=week"<?php if($type =='week'){?> class="cur" <?php }?>>周租（7——14天(含)）</a>
			<a href="./index.php?type=month"<?php if($type =='month'){?> class="cur" <?php }?>>月租（27——40天）</a>
		</div><!--hotel-search-->
	</div><!--pagemc-->
    
    <div class="car-list">
    	<div class="pagemc">
		<?php 
			for($i=0;$i<count($list);$i++){
		?>
			<div class="one">
				<div class="clearfix">
					<a class="pic" href="cardetail.php?id=<?php echo $list[$i]['id']; ?>">
						<img src="<?php echo IMG_DIR.$list[$i]['img_path']; ?>" width="210" alt=""></a>
					<div class="center"><a class="title" href="cardetail.php?id=<?php echo $list[$i]['id']; ?>"><?php echo $list[$i]['title']; ?></a><span class="disb adr">配置：<?php echo $list[$i]['peizhi']; ?></span>
					<span class="disb adr">可乘人数：<?php echo $list[$i]['peopleseat']; ?>人</span></div>
					<div class="right">
						<span class="price mt20 pt20">RMB<strong class="cf90"><?php echo $list[$i]['price']; ?><i>起/天</i></strong></span>
							<a href="cardetail.php?id=<?php echo $list[$i]['id']; ?>" class="detail">查看详情</a>
					</div>
				</div><!--clearfix-->
			</div><!--one-->
		<?php }?>						
						
			<div class="pages textRight pt20">
					
		<a class="disabled">&lt; 上一页</a>
	
		<a class="current">1</a>
		
		<a class="disabled">下一页 &gt;</a>
	
	
			</div>
   	  </div>
    </div><!--hotel-list-->    
</div>
<?php include('../head/foot.php');?>