<?php 
$urlType = 7;
include "../head/head_add.php" ; 

$sql = "select * from hotel";

$pagination = $funcop->split_page(15, 5, $sql);
$sql = $pagination[0];
$list = $lg->select_arr2($sql);
$pagination_page = $pagination[1];
include "../head/head.php" ; 
?>

<style>
.pagination{width:1200px;margin:0px auto; text-align:right; margin-top:20px;}
.pagination span{display:inline-block;padding:5px 10px;height:30px; background:#fff; margin:5px;}
.pagination span:hover{background:#FFD719;}
</style>
<div class="container">
	<div class="car-banner" style="background: url(/Theme/Simple/images/hotel.jpg) no-repeat center top;"></div>
	
	</div><!--pagemc-->
    
    <div class="car-list">
    	<div class="pagemc">
		<?php 
			for($i=0;$i<count($list);$i++){
		?>
			<div class="one">
				<div class="clearfix">
					<a class="pic" href="hoteldetail.php?id=<?php echo $list[$i]['id']; ?>">
						<img src="<?php echo IMG_DIR.$list[$i]['img_path']; ?>" width="210" alt=""></a>
					<div class="center"><a class="title" href="hoteldetail.php?id=<?php echo $list[$i]['id']; ?>">C<?php echo $list[$i]['title']; ?></a><span class="disb adr">所在城市：<?php echo $list[$i]['city']; ?></span>
					<span class="disb adr">地址：<?php echo $list[$i]['address']; ?>人</span></div>
					<div class="right">
						<span class="price mt20 pt20">RMB<strong class="cf90"><?php echo $list[$i]['price']; ?><i>起/天</i></strong></span>
							<a href="hoteldetail.php?id=<?php echo $list[$i]['id']; ?>" class="detail">查看详情</a>
					</div>
				</div><!--clearfix-->
			</div><!--one-->
		<?php }?>						
						
			<div class="pagination">
					
				<?php echo $pagination_page;?>
	
	
			</div>
   	  </div>
    </div><!--hotel-list-->    
</div>
<?php include('../head/foot.php');?>
