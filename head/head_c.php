<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<meta name="renderer" content="webkit">
<!--<meta name="viewport" content="width=device-width,initial-scale=1, minimum-scale=1.0, maximum-scale=1, user-scalable=no, minimal-ui">-->
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<?php
	$sql = "select * from seo where type={$urlType}";
	$seo = $lg->select_arr1($sql);
	if(isset($info) && isset($info['title']) && isset($info['keyword']) && isset($info['des'])){
		$seo = $info;
	}
?>
<title><?php echo $seo['title'] ?></title>
<meta content="<?php echo $seo['keyword'] ?>" name="Keywords" />
<meta name="apple-mobile-web-app-capable" content="yes">
<meta content="<?php echo $seo['des'] ?>" name="Description" />
<meta name="robots" content="all">
<!--[if lt IE 9]><style>.wow {visibility: visible;}</style><![endif]-->



<style>*,*:before,*:after { -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;}</style>
<link href="/Theme/xqd/css/css.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../detail/js/jquery.1.11.3.min.js"></script>
<link href="/Theme/xqd/css/css.css" rel="stylesheet" type="text/css">
<link  type="text/css" href="../detail/css/swiper.min.css" rel="stylesheet">
<link href="../detail/css/jquery.lightbox-0.5.css" rel="stylesheet" />
<link  type="text/css" href="../detail/css/my_css.css" rel="stylesheet"/>
<link  type="text/css" href="../detail/css/ql.css" rel="stylesheet"/>
<link  type="text/css" href="../detail/css/zxd.css" rel="stylesheet"/>



<script type="text/javascript" src="../detail/js/swiper.min.js"></script>
<script type="text/javascript" src="../detail/js/jquery.lightbox-0.5.js" ></script>
<script type="text/javascript" src="../detail/js/con_js.6.23.js"></script>

<style>
.searchb a{ display:block; width:30px; height:30px; border-radius:5px; margin:15px 0 0 0; background:#03283F; text-align:center;  transition:all .2s ease-in 0s;-webkit-transition:all .2s ease-in 0s;-moz-transition:all .2s ease-in 0s; }
.searchb a:hover { background:#137BBB; }
.routeDesc { width:100%; }
.routeDesc .right .price { display:inline; }
.detail-nav-normal ul li { width: 240px; height:60px; }
.route-book-row ul.list li span.text a.minus, .route-book-row ul.list li span.text a.plus { height: 36px; padding-top: 3px; }
.routeDesc .right a.btn { line-height: 28px; }
.route-book-row ul.list li strong.title { font-weight:normal; }
.bookComplete div.textCenter { padding: 60px 0 30px; }
.bookComplete div.textCenter a.toPay { background: #f48400; }
.bookComplete div.textCenter a { display: inline-block; width: 160px; height: 40px; line-height: 40px; text-align: center; background: #ab843a; border-radius: 4px; margin: 0 7px; font-size: 16px; color: white; }
</style>
</head>
<script>
//点击搜索按钮
var now_show = 0;
function tosearch(obj){
	if(now_show == 0){
		$('#sfo').slideDown(); $(obj).css('background','#137BBB'); now_show = 1;
	}else{
		$('#sfo').slideUp(); $(obj).css('background','#03283F');  now_show = 0;
	}
}
</script>
<script src="/Front/js/jquery.min.js"></script>
<body do-page-width="" class="fr-element fr-view do-page-23509">
<div class="do-container">
	<div class="do-section fp-auto-height do-header" do-header-fixed="" data-fullname="TOP">
		<div class="do-area" id="header_23509_0">
			<div class="do-area-bg">
				<div class="do-area-bg-conter"><div class="bgcolor"></div></div>
			</div>
			<div d="header_0" class="do-row do-row-one" style="width:1200px">
				<div class="do-row ">
					<div class="do-col-12">
						<div class="do-panelcol">
							<div class="do-block do-space do-3b94o">
								<div class="do-element-space" style="padding-top:1.0999999999999999%;"></div>
							</div>
							<div class="do-block do-text do-3b94l">
								<div class="do-element-text">
									<div class="do-element-text-content do-html">
										<div class="do-html-content">
											<p style="float:left;">出发城市：
													<a href="http://www.xqdzjy.com" class="othernav currentnav">成都</a> 
													<a href="#" class="othernav">重庆</a> 
												</p>
											<p style="text-align: right;color:white;"><img class="fr-dii" src="/Theme/Simple/images/phone.png" style="width: 16px; ">
											&nbsp; 18908221119 / 17360090952 / 座机：028-83918255 / 传真：028-83966588   &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
													<a href="javascript:void(0)">登录</a> &nbsp;/ &nbsp; <a href="javascript:void(0)">注册</a>
												</p>
									</div>
									</div>
								</div>
							</div>
							<div class="do-block do-space do-3b94k">
								<div class="do-element-space" style="padding-top:0.8999999999999999%;"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="do-area" style="background:#FAF3F3;">
			<div class="do-area-bg">
				<div class="do-area-bg-conter"><div class="bgcolor"></div></div>
			</div>
			<div d="header_1" class="do-row do-row-one" style="width:1200px">
				<div class="do-row ">
					<div class="do-col-12">
						<div class="do-panelcol">
							<div class="do-block do-rows">
								<div class="do-row">
									<div class="do-col-2">
										<div class="do-panelcol">
											<div class="do-block do-logo do-3b94m">
												<div do-logo="" class="do-logo">
													<div class="z-logo align-left size6"><a href="/" title=""><img src="/Theme/Simple/images/logo.png" alt="" style="height:45px;"></a></div>
												</div>
											</div>
										</div>
									</div>
									<div class="do-col-10">
										<div class="do-panelcol">
											<div class="do-block do-nav do-3b94n">
												<div class="z-nav align-center">
													<div class="z-nav-bar">
														<div class="z-nav-container">
															<ul class="z-nav-conter clearfix">
                                                                <li <?php echo  $urlType == 1? 'class="active"' : ''; ?>><a href="/"><span>首页</span></a></li>
                                                                <li <?php echo  $urlType == 2? 'class="active"' : ''; ?>><a href="/xcap"><span>自驾线路</span></a></li>
																<li <?php echo  $urlType == 10? 'class="active"' : ''; ?>><a href="/xcap/combine.php"><span>拼车自驾</span></a></li>
                                                                <li <?php echo  $urlType == 11? 'class="active"' : ''; ?>><a href="/xcap/driveaa.php"><span>AA制自驾</span></a></li>
                                                                <li <?php echo  $urlType == 3? 'class="active"' : ''; ?>><a href="/dzxl"><span>行程定制</span></a></li>
                                                                <li <?php echo  $urlType == 4? 'class="active"' : ''; ?>><a href="/hysymore"><span>游记鉴赏</span></a></li>
																<li <?php echo  $urlType == 5? 'class="active"' : ''; ?>><a href="/ldfc"><span>达人</span></a></li>
																<li <?php echo  $urlType == 6? 'class="active"' : ''; ?>><a href="/hirecar"><span>租车</span></a></li>
																<li <?php echo  $urlType == 7? 'class="active"' : ''; ?>><a href="/hotel"><span>酒店</span></a></li>
																<li <?php echo  $urlType == 8? 'class="active"' : ''; ?>><a href="/zjgl"><span>自驾攻略</span></a></li>
                                                                <li <?php echo  $urlType == 9? 'class="active"' : ''; ?>><a href="/about"><span>关于我们</span></a></li>
															</ul>
															<div class="searchb">
															<a href="javascript:void(0)" onclick="tosearch(this)"><img src="/Theme/xqd/images/search_s.png" width="20" /></a>
															<div id="sfo" style="position:absolute; right:0px; top:55px; border:1px solid #DDD9D8; background:#fff; width:300px; text-align:left; height:40px; padding-left:11px; border-radius:5px; display:none;">
																<img src="/theme/Simple/images/arrow_topsearch.png" style="position:absolute; right:3px; top:-9px;" />
																<form action="/search/" id="searchform" method="get">
																<input name="w" placeholder="目的地.." style="border:0px; height:35px; width:230px;">
																<a style="border-radius:10px; display:inline; padding:3px 10px 5px 10px; color:white; font-size:14px;" onclick="$('#searchform').submit()">搜索</a>
																</form>
															</div>
															
															</div>
															
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>