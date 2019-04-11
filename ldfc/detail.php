<?php
$urlType = 5;
if(!isset($dirNow)){
	include('../conf/op.class.php');
}else{
	include('conf/op.class.php');
}
$id = intval($_GET['id']);
$info = $lg->select_arr1("select * from ld where id='$id'");
include "../head/head_c.php"

?>

		<style>
			#expert .swiper-container {
				width: 100%;
				color: #fff;
				text-align: center;
				position: relative;
			}
			#expert .swiper-slide{
				font-size: 0;
			}
			#expert .swiper-slide img{
				width: 100%;;
			}
			#expert .pagination {
				position: absolute;
				z-index: 20;
				left: 10px;
				bottom: 10px;
			}
			#expert .arrow-left {
				background: url(/Theme/Simple/images/round-left.png) no-repeat left top;
				position: absolute;
				left: 50px;
				top: 50%;
				transform: translateY(-50%);
				-webkit-transform: translateY(-50%);
				-moz-transform: translateY(-50%);
				-ms-transform: translateY(-50%);
				width: 50px;
				height: 50px;
				z-index: 100;
			}
			#expert .arrow-right {
				background: url(/Theme/Simple/images/round-right.png) no-repeat left bottom;
				position: absolute;
				right: 50px;
				top: 50%;
				transform: translateY(-50%);
				-webkit-transform: translateY(-50%);
				-moz-transform: translateY(-50%);
				-ms-transform: translateY(-50%);
				width: 50px;
				height: 50px;
				z-index: 100;
			}
            .fs-18{display:block}
		</style>
	</head>
	<body class="body_pc">
	<div class="header  back_glod  color-fff">
   
</div>
<script>
        $(function () {
            /*点击字体变颜色*/
            $(".dingwei a").click(function(){
                $(this).addClass("color_glod");
                $(this).siblings().removeClass("color_glod");
            });
        });
</script>
<!-- <script type="text/javascript" src="/themes/dxzj/Public/Home/Content/lib/index.js"></script> -->

		<div id="expert">
			<!-- <div class="swiper-container">
				<a class="arrow-left" href="#"></a>
				<a class="arrow-right" href="#"></a>
				<div class="swiper-wrapper">
                    <div class="swiper-slide" style="background-image:url('<?php echo IMG_DIR.$info['img_path'];?>');background-size:cover;background-position:center top;"></div>
                </div>
				<div class="detiless" style="width: 100%;position: absolute;bottom: 0;background-color: rgba(0,0,0,.5);height: 220px;padding: 25px 0;z-index: 10;">
					<div class="clearfix w-1200" style="width:1200px">
						<div class="del fl">
							<span class="fs-36 fc-fff" style="border:0px" ><?php echo $info['name'];?></span>
							<span class="starbox">
								<div class="w-PLstar">
									<input type="hidden" value="5">
								</div>
							</span>
							<p class="fs-14 fc-fff clearfix" style="border:0px"><span class="fl tit"></span><span class="fl main" ><?php echo $info['area'];?></span></p>
						</div>
						<div class="der fl">
							<p class="fc-fff fs-14" style="border:0px"><p>,</p></p>
						</div>
					</div>
				</div>
			</div> -->
			<div class="title">
				<div class="tittop">
					<a href="#product-profile" class="pro fc-afa265 fs-14">达人详情</a>
					<a href="#stroke-introduced" class="str fs-14 fc-000">曾带队路线</a>
					<!-- <a href="#costs" class="cos fs-14 fc-000">TA的游记</a>
					<a href="#booking-information" class="boo fs-14 fc-000">旅客对TA的评价</a> -->
				</div>
			</div>
			<div id="product-profile">
				<h1><img src="/Theme/Simple/images/write5.png"/></h1>
				<h2 class="fs-18 fc-ccc">Talent show details</h2>
				<div class="w-1200">
                    <?php echo  html_entity_decode($info['content']); ?>
                </div>

			</div>
			<div id="stroke-introduced">
				<h1><img src="/Theme/Simple/images/write6.png"/></h1>
				<h2 class="fs-18 fc-ccc" style="display:block;padding:10px 0">Lead line</h2>
				<div class="day w-1200 box" style="text-align:left;">
                   <ul>
				   <?php 
						   $sql = "select title, id from xcap where id in(".trim($info['leadedxl'], ',').")";
						   $list = $lg->select_arr2($sql);
						   for($i=0;$i<count($list);$i++){
					?>
					   <li><a href="/xcap/detail.php?id=<?php echo $list[$i]['id']; ?>"><?php echo $list[$i]['title']; ?></a></li>
					<?php } ?>
				    </ul>
					
				</div>
			</div>
			<!-- <div id="costs">
				<h1><img src="/themes/dxzj/Public/Home/Content/img/slice/write7.png"/></h1>
				<h2 class="fs-18 fc-ccc"style="display:block;padding:10px 0">His/Her travels</h2>
				<div  class="box w-1200">
											<div class="no-data" style="display: block">
							<div></div>
							<p class="fc-ccc fs-14">暂时没有数据</p>
						</div>
					</ul>				</div>
			</div>
			<div id="booking-information">
				<h1><img src="/themes/dxzj/Public/Home/Content/img/slice/write8.png"/></h1>
				<h2 class="fs-18 fc-ccc" style="display:block;padding:10px 0">Passengers for his /her evaluation</h2>
				<div class="box w-1200">

					
					<div class="no-data" style="display: block">
							<div></div>
							<p class="fc-ccc fs-14">暂时没有数据</p>
						</div>
                </div>
			</div> -->
	

<script>

    $(function(){

        $(".inner_div i").click(function(e){

            e.stopPropagation();

            location.href=$(this).attr("golink");

        })

    })

</script>

	<script>
        $(function () {
            $(function () {
                $('#expert .swiper-slide').css('height', ($(window).height() - 60) + 'px')
            })

			/*五星图初始化*/
			var img_url={filled:"/Theme/Simple/images/star.png",empty:"/Theme/Simple/images/star.png"};
			set_stars($(".w-PLstar"),img_url,5,25,"onlyread");
			// /*轮播初始化*/
			var mySwiper = new Swiper('.swiper-container',{
			    loop: true,
			    autoplay: 5000,
			    autoplayDisableOnInteraction: false,
			});
			$('.arrow-left').click(function () {
			    mySwiper.swipePrev();
			})
			$('.arrow-right').click(function () {
			    mySwiper.swipeNext();
			})
			/*预定选择框*/
			$("#expert .reservation .select ul li").click(function(){
				var time=$(this).children(".time").text();
				var pri1=$(this).children(".pri1").text();
				var pri2=$(this).children(".pri2").text();
				$("#expert .reservation .select .show").html("<span>"+time+"</span><span>"+pri1+"</span><span>"+pri2+"</span>");
			});
			$("#expert .reservation .select").click(function(){
				$("#expert .reservation .select ul").toggle();
			});
		    /*滑动到一定位置，4个标题定在顶部*/
			// setTimeout(function () {
            //         var top = $(".tittop").offset().top;
			//     var top1 = $("#product-profile").offset().top-180 ;
			//     var top2 = $("#stroke-introduced").offset().top-80;
			    // var top3 = $("#costs").offset().top-80;
			    // var top4 = $("#booking-information").offset().top-180;

			    // $(window).scroll(function () {
			    //     if ($(window).scrollTop() >= $("#expert .title").offset().top) {
			    //         $("#expert .title .tittop").css({ "position": "fixed", "top": "60px" });
			    //     } else {
			    //         $("#expert .title .tittop").css({ "position": "static" });
			    //     };
			    //     if ($(window).scrollTop() >= $("#expert #product-profile").offset().top) {
			    //         $("#expert #product-profile").css("padding", "160px 0 50px");
			    //     } else {
			    //         $("#expert #product-profile").css("padding", "50px 0");
			    //     };
			    //     if ($(window).scrollTop() >= $("#expert #stroke-introduced").offset().top) {
			    //         $("#expert #stroke-introduced").css("padding", "160px 0 50px");
			    //     } else {
			    //         $("#expert #stroke-introduced").css("padding", "50px 0");
			    //     };
			        // if ($(window).scrollTop() >= $("#expert #costs").offset().top) {
			        //     $("#expert #costs").css("padding", "160px 0 50px");
			        // } else {
			        //     $("#expert #costs").css("padding", "50px 0");
			        // };
			        // if ($(window).scrollTop() >= $("#expert #booking-information").offset().top) {
			        //     $("#expert #booking-information").css("padding", "160px 0 50px");
			        // } else {
			        //     $("#expert #booking-information").css("padding", "50px 0");
			        // };

			        // if ($(this).scrollTop() >= top1 && $(this).scrollTop() < top2) {
			        //     $(".tittop a").eq(0).css("color", "#afa265").siblings().css("color", "#000");

			        // } else if ($(this).scrollTop() >= top2) {
                    //     $(".tittop a").eq(1).css("color", "#afa265").siblings().css("color", "#000");
                    // }

			        // } else if ($(this).scrollTop() >= top3 && $(this).scrollTop() < top4) {
			        //     $(".tittop a").eq(2).css("color", "#afa265").siblings().css("color", "#000");

			        // } else if ($(this).scrollTop() >= top4) {
			        //     $(".tittop a").eq(3).css("color", "#afa265").siblings().css("color", "#000");

			        // }

			    // });





			// }, 0)
			
			/*点击字体变颜色*/
			$("#expert .title .tittop a").click(function(){
				$(this).addClass("fc-afa265");
				$(this).siblings().removeClass("fc-afa265");
			});
		});

	</script>

<?php include('../head/foot.php'); ?>