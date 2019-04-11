<?php 
$urlType = 8;
include "../head/head_add.php";
$sql = "select * from zjgl order by id desc";
$pagination = $funcop->split_page(16, 5, $sql);
$list = $lg->select_arr2($pagination[0]);
$paginationPage = $pagination[1];
include "../head/head.php";
?>

<!-- <link rel="stylesheet" href="/Theme/Classic/css/animate.css">
<link rel="stylesheet" href="/Theme/Classic/css/live_11.css"> -->

<!-- <script src="/Theme/Classic/js/my_js.js"></script> -->
<style>
.playBox{position: relative;}
.play{position: absolute;width: 100px;height: 100px;left: 50%;margin-left: -50px;top:231px}
.pagination{width:1200px;margin:0px auto; text-align:right;}
.pagination span{display:inline-block;padding:5px 10px;height:30px; background:#fff; margin:5px;}
.pagination span:hover{background:#FFD719;}
</style>

<div class="do-section fp-auto-height do-banner">
	<div class="do-area" id="banner_23510_0" style="background-image: url('/Theme/Simple/images/bg1.jpg');background-attachment:fixed">
	<div class="do-area-bg ">
		<div class="do-area-bg-conter"><div class="bgcolor"></div></div>
	</div>
	<div id="banner_0" class="do-row do-row-one">
	<div class="do-row ">
	<div class="do-col-12">
	<div class="do-panelcol">
	<div class="do-block do-space do-3b97x">
		<div class="do-element-space" style="padding-top:7.142857142857142%;"></div>
	</div>
	<div class="do-block do-space do-3b97w">
		<div class="do-element-space pc" style="padding-top:5%;"></div>
		<div class="do-element-space phone" style="padding-top:5%;"></div>
	</div>
	<div class="do-block do-text do-3b97v">
		<div class="do-element-text">
			<div class="do-element-text-content do-html">
				<div class="do-html-content">
					<p style="text-align: left; line-height: 1;"><span style="color: rgb(255, 255, 255); font-size: 26px;">游记鉴赏</span></p>
					<p style="text-align: left; line-height: 1;"><span style="color: rgb(255, 255, 255);">Travel Notes</span></p>
				</div>
			</div>
		</div>
	</div>
	<div class="do-block do-space do-3b97u">
		<div class="do-element-space pc" style="padding-top:5%;"></div>
		<div class="do-element-space phone" style="padding-top:7.142857142857142%;"></div>
	</div>
	</div>
</div></div></div></div></div>

<div class="my_hx ">
	<!-- <div class="top pagemc" style="display:none">
		<h3>热门标签</h3>
		<p><a href="/activity?tag=4">西藏</a><a href="/activity?tag=5">亲子</a><a href="/activity?tag=6">摄影</a><a href="/activity?tag=7">人文</a></p>
	</div> -->
	<div class="con pagemc" id="con">
		<?php 
		for($i=0;$i < count($list); $i++){
		?>
		<a href="./article.php?id=<?php echo $list[$i]['id']; ?>" style="height:auto;">
			<img src="<?php echo IMG_DIR.$list[$i]['img_path']; ?>" class="lazy" alt="" width="280" height="150">
			<!-- <p class="tip">印记</p> -->
			<div class="text">
				<h4><?php echo $list[$i]['title']; ?></h4>
				<p class="b"><span class="fl">作者：<?php echo $list[$i]['author']; ?></span>
				<span class="fr">浏览：<?php echo $list[$i]['clicktime']; ?></span></p>
			</div>
		</a>
		<?php }?>
	</div>
	<div class='pagination'><?php echo $paginationPage ?></div>
	<!--<a class="more"><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;&nbsp;加载更多...</a>-->
</div>


<script>
$(function(){
	$(".my_hx .more").click(function(){
		$(".my_hx .con").css("height","auto");
		$(".my_hx .con .in").addClass("animated zoomIn");
		$(this).hide();
	});

	$("body").removeClass("bgwhite").css("backgroundColor","#eee");

	$("li.cur").hover(function(){
		$(this).children(".play").show()
	});

});
</script>

<?php include('../head/foot.php');?>

