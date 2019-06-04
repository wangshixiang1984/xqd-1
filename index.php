
<?php
	// $domain = $_SERVER['SERVER_NAME'];
	// if(strpos($domain, 'm.xqdzjy.com') !== false){
	// 	header("Location:http://www.xqdzjy.com/h5/", TRUE, 301);
	// }
	$urlType = 1;
	$dirNow = '/';
	include "./head/head_add.php";
 	include 'head/head.php';
 ?>	
	

<style>
.swiper-pagination-bullet { width:30px; height:30px; background:#03283F; color:white; font-size:18px; opacity:1; }
.swiper-pagination-bullet-active { opacity: 1; color:black; background:white; }
</style>
<div class="do-section fp-auto-height do-banner">
	<div class="swiper-containers">
		<div class="swiper-wrapper">
				<?php
					$sql = "select * from adver where type=1 order by id desc";
					$info = $lg->select_arr2($sql);
					for($i = 0; $i < count($info); $i ++){
				?>
						<div class="swiper-slide"><a href="<?php echo $info[$i]['pic_link']; ?>" style="display:block;"><img src="<?php echo IMG_DIR.$info[$i]['img_path']; ?>" alt="<?php echo $info[$i]['title']; ?>" width="100%"></a></div>
					<?php } ?>						
					</div>
      <!-- 如果需要分页器 -->
	<div class="swiper-pagination"></div>
	</div>	
</div>

<div class="do-body">
	<div class="do-section do-area" id="area_23509_0" data-fullname="">
		<div class="do-area-bg ">
			<div class="do-area-bg-conter">
				<div class="bgcolor"></div>
			</div>
		</div>
		<div id="area_0" class="do-row do-row-one " style="width:1300px">
		<div class="do-row ">
		<div class="do-col-12">
		<div class="do-panelcol">
		<div class="do-block do-space do-3b95e">
			<div class="do-element-space pc" style="padding-top:3%;"></div>
		</div>

		<div class="do-block do-text do-3b99h" style="display:block">
			<div class="morelink">
				<a href="/xcap">更多行程...</a>
			</div>
			
			<h3 style="text-align: center; line-height: 1;">
				<span style="color: rgb(0, 0, 0); font-size: 26px;">近期出团</span>
				<span><img class="fr-dib" src="/Theme/Simple/images/icon1.png" width="246"></span><br>
			</h3>
		</div>

		<div class="do-block do-list do-3b99g" style="text-align:left">
			<div class="do-element-media x num4 phoneRows2 dz-mdd">
			<div class="do-element-media-content md" id="swiper_3b99g" data-rows="4" data-phonerows="2" data-initialslide="0" data-slidespercolumn="1">
			<ul class="do-element-media-ul x do-content-grid ">
				<?php 
					$info = $lg->select_arr2('select xcap.id, xcap.passed,	xcap.goday, xcap.title, xcap.img_path, xcap.gocity,xcdate.price,xcdate.godate from xcap left join xcdate on xcap.id=xcdate.xcapid where hide != 1 and istop != 1 group by xcdate.xcapid order by xcap.px desc limit 6');
					for($i = 0; $i < count($info); $i ++){
				?>
				<li class="do-element-media-li " data-wow-delay=".0s" style="width:33.3%; height:360px; margin:10px 0 20px 0;">
					<a href="/xcap/detail.php?id=<?php echo $info[$i]['id']; ?>">
					<div class="do-element-media-conter clearfix do-caption-overlay " style=" background-color: #fdf7f7; border-radius:10px;overflow:hidden;">
						<div class="do-media-image-box" style="height:230px;">
							<div class="do-media-image">
								<div class="do-media-image-conter"><img class="scrollLoading loadingEnd" data-src="<?php echo IMG_DIR.$info[$i]['img_path']; ?>" src="<?php echo IMG_DIR.$info[$i]['img_path']; ?>" style="width: 100%; height:230px;">
								</div>
							</div>
						</div>
						<div class="do-html-content">
							<div class="do-title-body">
								<div class="do-title-content do-html-content">
									<div class="do-html-content title"><p style="height:70px;border-bottom:solid 1px #e6e6e6; font-weight:bold; text-align:center;"><?php echo $info[$i]['title']; ?></p></div>
									<div class="do-html-content title">
										<div>出团时间：<?php if($info[$i]['passed'] == 1){ echo '已封团';}else{ echo $info[$i]['godate'];} ?> </div>
										<div class='price'><span>¥ </span><i><?php if($info[$i]['passed'] == 1){ echo '0';}else{echo $info[$i]['price'];} ?></i></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</a>
			</li>
			<?php } ?>
			
			</ul>
			</div>
			</div>
		</div>
		<div class="do-block do-code do-3c9wl">
			<div class="do-element-code">
				<div class="do-element-code-content"></div>
			</div>
		</div>
		</div>
		</div>
		</div>
		</div>
		</div>
		<div class="do-section do-area" id="area_23509_1" data-fullname="">
		<div class="do-area-bg ">
			<div class="do-area-bg-conter"><div class="bgcolor"></div></div>
		</div>
		<div id="area_1" class="do-row do-row-one ">
			<div class="do-row ">
				<div class="do-col-12">
					<div class="do-panelcol">
						<div class="do-block do-space do-3botk">
							<div class="do-element-space pc" style="padding-top:10%;"></div>
							<div class="do-element-space phone" style="padding-top:5%;"></div>
						</div>
						<div class="do-block do-code do-3b99a">
							<div class="do-element-code"><div class="do-element-code-content"></div></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="do-section do-area" id="area_23509_2" data-fullname="" style="background-image: url('/Theme/Simple/images/bg3.jpg');background-attachment:initial">
	<div class="do-area-bg ">
		<div class="do-area-bg-conter"><div class="bgcolor"></div></div>
	</div>
	<div id="area_2" class="do-row do-row-one">
		<div class="do-row ">
			<div class="do-col-12">
			<div class="do-panelcol">
			<div class="do-block do-space do-3b95u">
				<div class="do-element-space pc" style="padding-top:7.000000000000001%;"></div>
				<div class="do-element-space phone" style="padding-top:14.000000000000002%;"></div>
			</div>
			<div class="do-block do-text do-3b99e">
			<div class="do-element-text">
			<div class="do-element-text-content do-html">
			<div class="do-html-content"><h3 style="text-align: center; line-height: 1;">
				<span style="color: rgb(255, 255, 255); font-size: 26px;">热门推荐</span>
				<span style="color: rgb(102, 102, 102);"><img class="fr-dib" src="/Theme/Simple/images/icon2.png" style="width: 246px;"></span><br>
				</h3>
			</div>
			</div>
			</div>
			</div>
			<div class="do-block do-list do-3c4l2">
				<div class="do-element-media x num3 phoneRows1 list1 do-swiper">
					<div class="do-element-media-content md swiper-container do-list-swiper swiper-container-horizontal" data-rows="3" data-phonerows="1" data-initialslide="0" data-slidespercolumn="1">
						<ul class="do-element-media-ul x do-content-grid  swiper-wrapper" style="height:511px;">
						<?php
							$list = $lg->select_arr2('select xcap.id, xcap.passed,	xcap.goday, xcap.title, xcap.startplace, xcap.img_path, xcap.gocity,xcdate.price,xcdate.godate from xcap left join xcdate on xcap.id=xcdate.xcapid where hide != 1 and istop = 1 group by xcapid  order by px desc, xcap.id desc');	
							for ($i = 0; $i < count($list); $i ++){
						?>
						<li class="do-element-media-li  swiper-slide swiper-slide-active" data-wow-delay=".0s" style="width: 341.333333333333px;">
							<div class="do-element-media-conter clearfix do-caption do-bg-white" style="height:487px;">
								<div class="do-media-image-box"  style="height:172px;">
									<div class="do-media-image" style="padding-top:82.01892744479495%;">
										<div class="do-media-image-conter">
											<img class="scrollLoading loadingEnd" data-src="<?php echo IMG_DIR.$list[$i]['img_path'] ?>" src="<?php echo IMG_DIR.$list[$i]['img_path'] ?>" style="margin-top: 0%;width: 100%;height:172px;">
										</div>
									</div>
								</div>
								<div class="do-title do-html-content">
									<div class="do-title-body">
										<div class="do-title-content do-html-content">
											<div class="do-html-content title"><p style="line-height: 1.2; height:55px; overflow:hidden"><span style="color: rgb(51, 51, 51); font-size: 24px;"><?php echo $list[$i]['title'] ?></span></p></div>
											<div class="do-html-content des">
												<p style="line-height: 1;"><span style="color: rgb(102, 102, 102); font-size: 16px;">出发城市：<?php echo $list[$i]['startplace'] ?></span></p>
												<p style="line-height: 1;"><span style="color: rgb(102, 102, 102); font-size: 16px;">行程天数：<?php echo $list[$i]['goday'] ?></span></p>
												<p style="line-height: 1;"><span style="color: rgb(102, 102, 102); font-size: 16px;">出发日期：<?php if($list[$i]['passed'] == 1){ echo '已封团';}else{ echo $list[$i]['godate'];} ?></span></p>
												<p style="line-height: 1;"><br></p>
												<p style="line-height: 1;">
													<span style="color:#fff; font-size: 16px; background:#1c69c3; padding:3px 30px;">￥ <?php if($list[$i]['passed'] == 1){ echo '0';}else{echo $list[$i]['price'];} ?></span> 
													<a href="#" onclick="window.location.href= '/xcap/detail.php?id=<?php echo $list[$i]['id'] ?>'" style="color:#000; border:1px solid #ccc; padding:3px 20px; z-index:20;">详情 >></a>
													<br>
												</p>
											</div>
										</div>
									</div>
								</div>
							</div>
						</li>
						<?php } ?>
						</ul>
					</div>
				
					<div class="swiper-pagination"><span class="swiper-pagination-bullet swiper-pagination-bullet-active"></span></div>
					<div class="swiper-button-prev swiper-button-white swiper-button-disabled"></div>
					<div class="swiper-button-next swiper-button-white swiper-button-disabled"></div>
				</div>
			</div>
			<div class="do-block do-space do-3b95s">
				<div class="do-element-space pc" style="padding-top:10%;"></div>
				<div class="do-element-space phone" style="padding-top:14.000000000000002%;"></div>
			</div>
		</div>
	</div>
	</div>
	</div>
	</div>
	<div class="do-section do-area" id="area_23509_3" data-fullname="">
		<div class="do-area-bg ">
			<div class="do-area-bg-conter">
				<div class="bgcolor"></div>
			</div>
		</div>
		<div id="area_3" class="do-row do-row-one ">
			<div class="do-row ">
			<div class="do-col-12">
			<div class="do-panelcol">
				<div class="do-block do-space do-3b992">
					<div class="do-element-space pc" style="padding-top:10%;"></div>
					<div class="do-element-space phone" style="padding-top:17.1%;"></div>
				</div>
			<div class="do-block do-text do-3b990">
				<div class="do-element-text">
					<div class="do-element-text-content do-html">
						<div class="do-html-content">
							<h3 style="text-align: center; line-height: 1;">
								<span style="color: rgb(0, 0, 0); font-size: 26px;">游记鉴赏</span>
								<span style="color: rgb(102, 102, 102);"><img class="fr-dib" src="/Theme/Simple/images/icon1.png" style="width: 246px;"></span><br>
							</h3>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>
	</div>
	</div>
	<div class="do-section do-area do-area-full" id="area_23509_4" data-fullname="">
		<div class="do-area-bg "><div class="do-area-bg-conter"><div class="bgcolor"></div></div></div>
		<div id="area_4" class="do-row do-row-one ">
		<div class="do-row ">
		<div class="do-col-12">
		<div class="do-panelcol">
		<div class="do-block do-list do-3b995">
		<div class="do-element-media x num4 phoneRows2 ">
		<div class="do-element-media-content sm" id="swiper_3b995" data-rows="4" data-phonerows="2" data-initialslide="0" data-slidespercolumn="1">
		<ul class="do-element-media-ul x do-content-grid ">
		<?php
			$list = $lg->select_arr2('select id,title,img_path from hysy order by id desc');
			$maxlen = count($list) > 16 ? 16 : count($list);
			for($i = 0; $i < $maxlen; $i ++){
		?>
		<li class="do-element-media-li do-img-animation wow fadeInUp" data-wow-delay=".0s" style="visibility: visible; -webkit-animation-delay: 0s;">
			<a href="/hysymore/article.php?id=<?php echo $list[$i]['id']; ?>">
			<div class="do-element-media-conter clearfix do-caption-overlay-hover-cover "><div class="do-media-image-box"><div class="do-media-image"><div class="do-media-image-conter">
				<img class="scrollLoading loadingEnd" alt="KID THINK" data-src="<?php echo IMG_DIR.$list[$i]['img_path']; ?>" src="<?php echo IMG_DIR.$list[$i]['img_path']; ?>" style="margin-left: -5.33854%; margin-top: 0%; width: 100%;"></div></div></div>
				<div class="do-title do-html-content"><div class="do-title-body"><div class="do-title-content do-html-content"><div class="do-html-content title"><p><strong></strong></p></div><div class="do-html-content des"><p style="font-size:14px;"><?php echo $list[$i]['title']; ?></p></div></div></div></div></div>
			</a>
		</li>
		<?php } ?>
		</ul>
		</div>
		</div>
		</div>
		<div class="do-block do-space do-3b98v">
			<div class="do-element-space pc" style="padding-top:6.309148264984227%;"></div>
			<div class="do-element-space phone" style="padding-top:5%;"></div>
		</div>
		</div>
		</div>
		</div>
		</div>
		</div>
		<div class="do-section do-area" id="area_23509_5" data-fullname="" style="background-image: url('/Theme/Simple/images/bg4.jpg');background-attachment:">
		<div class="do-area-bg "><div class="do-area-bg-conter"><div class="bgcolor"></div></div></div>
		<div id="area_5" class="do-row do-row-one ">
		<div class="do-row ">
		<div class="do-col-12">
		<div class="do-panelcol">
		<div class="do-block do-space do-3b98z">
			<div class="do-element-space pc" style="padding-top:11.600000000000001%;"></div>
			<div class="do-element-space phone" style="padding-top:16.400000000000002%;"></div>
		</div>
		<div class="do-block do-text do-3b98u">
			<div class="do-element-text">
				<div class="do-element-text-content do-html">
					<div class="do-html-content"><p><span style="color: rgb(255, 255, 255); font-size: 36px;">世界行程，量身定制</span></p></div>
				</div>
			</div>
		</div>
		<div class="do-block do-text do-3b98q">
		<div class="do-element-text">
		<div class="do-element-text-content do-html">
		<div class="do-html-content">
			<p><span style="font-size: 20px; color: rgb(255, 255, 255);">DIY YOUR OWN LINE</span></p>
			<p><span style="font-size: 20px; color: rgb(255, 255, 255);">&nbsp;WAY TO TRAVEL</span></p>
		</div>
		</div>
		</div>
		</div>
		<div class="do-block do-space do-3b98p">
			<div class="do-element-space pc" style="padding-top:5%;"></div>
			<div class="do-element-space phone" style="padding-top:5%;"></div>
		</div>
		<div class="do-block do-button do-3b98o">
		<div class="do-element-button" style="padding-top:45px;">
		<div class="do-element-button-content">
			<div class="do-middle align-left">
				<div class="do-middle-center"><a href="/dzxl" class="do-btn hollow radius-lg do-bg-white "><h5> 我要定制</h5></a></div>
			</div>
		</div>
		</div>
		</div>
		<div class="do-block do-space do-3b98x">
			<div class="do-element-space pc" style="padding-top:12%;"></div>
			<div class="do-element-space phone" style="padding-top:17.1%;"></div>
		</div>
		</div>
		</div>
		</div>
		</div>
	</div>
</div>

<?php include('./head/foot.php'); ?>