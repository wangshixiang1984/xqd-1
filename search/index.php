<?php 
$urlType = '';
include "../head/head_add.php";
$keyword = $lg->ckinput($_GET['w']);
$sql = 'select xcap.title, xcap.passed, xcap.id, xcap.img_path, xcap.startplace, xcap.goday, xcap.gocity, xcdate.price, xcdate.gomonth, xcdate.godate, xcdate.minprice from xcap left join xcdate on xcdate.xcapid=xcap.id where xcap.passed!=1 and xcap.title like "%'.$keyword.'%" group by xcapid';
$pagination = $funcop->split_page(10, 5, $sql, ['w' => $keyword]);
$totalNum = $lg->select_num($sql);
$list = $lg->select_arr2($pagination[0]);
$pagination_page = $pagination[1];
include "../head/head.php";
?>
<style>
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
	<div class="search-result">
    	<div class="result-menu">
            <div class="pagemc">
            	<ul>
                	<li style="line-height:40px;"><a class="current">自驾路线</a></li>
                    <!--<li><a href="search-car.html">租车服务</a></li>
                    <li><a href="search-leader.html">达人风采</a></li>
                    <li><a href="search-diy.html">私人订制</a></li>
                    <li><a href="search-hotel.html">酒店</a></li>-->
                </ul>
            </div><!--pagemc-->
        </div>
        <p>为您找到“ <?php echo $keyword;?>“ 相关结果约 <b><?php echo $totalNum; ?></b> 个。</p>
    </div><!--search-result-->
    
    <div class="routelist">
    	<div class="pagemc">
            <?php 
            for($i=0;$i<count($list); $i++){
            ?>
            <div class="one">
                <a class="toDetail" href="/xcap/detail.php?id=<?php echo $list[$i]['id']; ?>" target="_blank">
                <img class="pdt lazy noC3" src="<?php echo IMG_DIR.$list[$i]['img_path']; ?>" data-original="<?php echo IMG_DIR.$list[$i]['img_path']; ?>" width="320" height="180" alt="" /> 
                <h2><?php echo $list[$i]['title']; ?> </h2>
                
                <strong style="display:block;height:130px;line-height:40px;">
                行程天数：<?php echo $list[$i]['goday']; ?>天<br>
                出发地：<?php echo $list[$i]['startplace']; ?><br>
                行程日期:<?php if($list[$i]['passed'] == 1){echo '已封团';}else{echo $list[$i]['godate'];} ?></strong>
                <em class="price"><b><?php if($list[$i]['passed'] == 1){echo 0;}else{echo $list[$i]['minprice'];} ?></b> 元 / 起</em></a>
            </div>
            <?php
            }?>
        <div class="pagination">
					
                <?php echo $pagination_page;?>
	
			</div>
   
         </div><!--pagemc-->   
    </div><!--routelist-->  
</div>
<!--container-->


<?php include('../head/foot.php'); ?>