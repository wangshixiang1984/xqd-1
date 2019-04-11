<?php 
$urlType = 8;
include "../head/head_add.php";
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if($id == 0){
	exit;
}
$sql = "update zjgl set clicktime = clicktime+1 where id = '$id'";
$lg->imd($sql);
$sql = "select * from zjgl where id = '$id'";
$info = $lg->select_arr1($sql);
include "../head/head.php";
?>
<script src="/plugin/dropdown/jquery.dropdown.js"></script>
<script src="/plugin/dropdown/modernizr.custom.63321.js"></script>
<link rel="stylesheet" href="/Front/css/animate.css">
<link rel="stylesheet" href="/detail/css/swiper.min.css">
<link rel="stylesheet" type="text/css" href="/plugin/dropdown/style1_1.css" />
<div class="my_det pagemc" style="margin-bottom:20px;">
	<div class="top">
		<h2><?php echo $info['title']; ?></h2>
		<div class="zh">作者：<?php echo $info['befrom']; ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;组织方：<?php echo $info['author']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;阅读：<?php echo $info['clicktime']; ?></div>
		<p class="pro"><?php echo $info['des']; ?>​</p>
	</div>
    <div class="con">
      <div class="con_l fl">
        <div class="text contexts">
			<?php echo html_entity_decode($info['content']); ?>
		</div>
    </div>
	<?php 
	$sql = "select * from xcap left join xcdate on xcap.id = xcdate.xcapid where xcap.id='".$info['xcapid']."' group by xcapid";
	$detailInfo = $lg->select_arr1($sql);
	$sql = "select * from xcdate where xcapid={$info['xcapid']}";
	$pricelist = $lg->select_arr2($sql);
	$sql = "select * from xcdes where xcapid='".$info['xcapid']."' order by whichday asc";
	$daysInfo = $lg->select_arr2($sql);

	?>
	<div class="con_r fl">
		<div class="con_rtop">
			<h4><a href="../xcap/detail.php?id=<?php echo $detailInfo['xcapid'] ?>"><?php echo $detailInfo['title'] ?></a></h4>
			<p>出发城市：<?php echo $detailInfo['gocity'] ?></p>
			<p>行程天数：<?php echo $detailInfo['goday'] ?>天</p>
		</div>
        <div class="date">
          	<!--
			  <ul>
			  <?php
				for($i=0;$i<count($daysInfo);$i++){
			  ?>
			<li>
				<a class="ptitle"><i class="cur"></i>day<?php echo $i+1; ?><span><?php echo $daysInfo[$i]['daytitle'] ?></span></a>
				<div class="date_con" style="display: block;">
					<p>概况：<?php echo $daysInfo[$i]['daydes'] ?></p>
						
					<p>晚餐：<?php echo $daysInfo[$i]['dinner'] ?></p>
				</div>
            </li>
			<?php }?>
		</ul>
		-->
		</div>
		
		<div class="dp">
			
		<div class="cd-dropdown">
			<select id="cd-dropdown" name="cd-dropdown" class="cd-select"><!--无团期时在select标签添加disable<option>暂无团期，请选择其它路线</option>-->
				<?php 
					if($detailInfo['passed'] == 1){
				?>
				<option value="" selected>该线路已封团</option>
				<?php }else{
					print_r($pricelist);
					for($i=0;$i<count($pricelist);$i++){
				?>
					<option value="" selected>
						成人：￥<?php echo $pricelist[$i]['price']; ?> 儿童：￥<?php echo $pricelist[$i]['boyprice']; ?> 余位：<?php echo $pricelist[$i]['leftpeople']; ?>
					</option>
				<?php }}?>
			</select>

		</div>
          <p><span><?php echo $detailInfo['minprice'] ?></span>元/起</p>
        </div>
        <a id="toBook" class="btn" href="/xcap/detail.php?id=<?php echo $detailInfo['xcapid'] ?>" >线路明细</a>
      </div>
    </div>
</div>

<!--footer-->
<script>
$(function(){
	$("body").css("background-color","#fff");

	$(".con_r .date li a").click(function(){
		$(this).siblings(".date_con").slideToggle();
		$(this).children("i").toggleClass("cur");
		// $(this).parent("li").siblings().find(".date_con").slideUp();
	});

	$(".contexts img").css("width","100%").css("height","auto");
	$(".contexts table").css("width","100%");

	$( '#cd-dropdown' ).dropdown( {
	  gutter : 5
	} );
});



// $("#toBook").addClass("disable").css("background","#ccc");

</script>
<?php include('../head/foot.php');?>

