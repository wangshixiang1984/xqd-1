<?php 
$urlType = 8;
include "../head/head_add.php";
$sql = "select xcap.*, xcdate.godate, xcdate.minprice from xcap left join xcdate on xcap.id = xcdate.xcapid where istop = 1 and hide != 1 order by xcap.id desc ";
$pagiantion = $funcop->split_page(10, 5, $sql);
$list = $lg->select_arr2($pagiantion[0]);
$totalNum = $lg->select_num($sql);
include "../head/head.php";
?>

<style>
.routeSelect ul li a.current{ background: #66B0DF; }
.fr-view strong { font-weight: normal; }
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
					<p style="text-align: left; line-height: 1;"><span style="color: rgb(255, 255, 255); font-size: 26px;">精美路线</span></p>
					<p style="text-align: left; line-height: 1;"><span style="color: rgb(255, 255, 255);">Beauty Line</span></p>
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

<div class="container">
	<div class="pagemc">
        <div class="routeSelect" style="width:100%;">
		<p class="result" id="resultcontainer"></p>
			<span>匹配结果 <?php echo $totalNum ?> 条</span>
       </div><!--routeSelect-->
   </div><!--pagemc-->
    
    	<div class="routelist">
			<div class="pagemc" >	
			<!--列表  -->
			<div id="listContainer">
            <?php 
                    for($i=0;$i<count($list); $i++){
                ?>
				<div class="one">
					<a class="toDetail" href="../xcap/detail.php?id=<?php echo $list[$i]['id'] ?>" target="_blank">
					<img class="pdt lazy noC3" src="<?php echo IMG_DIR.$list[$i]['img_path'] ?>" data-original="<?php echo IMG_DIR.$list[$i]['img_path'] ?>" width="320" height="180" alt="" /> 
					<h2><?php echo $list[$i]['title'] ?></h2>
					<dl class="clearfix"></dl>
					<strong>
					行程天数：<?php echo $list[$i]['goday']; ?>天<br>
					出发地：<?php echo $list[$i]['gocity']; ?><br>
					行程日期:<?php echo $list[$i]['godate']; ?></strong>
					<em class="price"><b><?php echo $list[$i]['minprice'] ?></b> 元 / 起</em></a>
				</div>
				<?php }?>
				<div class="pages textRight pt20 pagination">
                        <?php echo $pagiantion[1]; ?>
			    </div>
            </div>
			<!-- 分页 -->
   
		</div><!--pagemc-->   
                
    </div><!--routelist-->    
</div>

</div>

<?php include('../head/foot.php'); ?>