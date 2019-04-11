<?php 
	$urlType = 7;
	if(!isset($dirNow)){
		$dirNow = '../';
	}
	include($dirNow.'conf/op.class.php');

    $id = intval($_GET['id']);
    $sql = "select * from hotel where id='$id'";
    $info = $lg->select_arr1($sql);
	include "../head/head_d.php";
?>

<script>
        $(function () {
            /*点击字体变颜色*/
            $(".dingwei a").click(function(){
                $(this).addClass("color_glod");
                $(this).siblings().removeClass("color_glod");
            });
        });
</script>
<!-- <script type="text/javascript" src="../detail/lib/index.js"></script> -->
    <input type="hidden" value="436" id="line_id">
		<div class="detiless" style="width: 25%;position: absolute;bottom: 0;height: 430px;padding: 25px 0;z-index: 10; margin:150px 0 0 58%;top:0" >
            <div class="clearfix w-1200" style="margin:50px 0">
               
                <div class="del fl">
                    <p class="fc-fff fs-18" style="width: 400px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="/Theme/Simple/images/zuobiao.png"/>&nbsp;&nbsp;&nbsp;&nbsp;酒店名称:&nbsp;<?php echo $info['title']; ?></p>
                    <p class="fc-fff fs-18" style="width: 400px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="/Theme/Simple/images/taiyang.png"/>&nbsp;&nbsp;&nbsp;所在城市:&nbsp;<?php echo $info['city']; ?>天 <div class="price fc-fff">
                        <span class="fs-30"><img src="/Theme/Simple/images/qian.png"/ style="margin:0 20px 0 44px;"><?php echo $info['price']; ?></span><span style="color:#fff"> 起</span></div>
                    </p>
                </div>
                
            </div>
		</div>
		
        
        <div id="details-line" style="postion:relative; background-color:#f4ffff;height:680px">
			<div id="bei">
                <div id="bei-auto">
                    <div class="swiper-container">
        				<a class="arrow-left" href="#"></a>
        				<a class="arrow-right" href="#"></a>
        				<div class="swiper-wrapper">
                            <div class="swiper-slide" style="background-image:url('<?php echo IMG_DIR.$info['img_path']; ?>');background-size:cover;background-position:center top;"></div>
                        </div>
        				
        			</div>
                </div>
           <div class="reservation">
				<!-- <span class="fc-fff fs-24"><img src="../detail/img/slice/write1.png" alt=""/></span> --><!--选择出团时间-->
				<!-- <span class="select fc-999">
                    <span class="show">
                        <input type="hidden" value="1196">
                         <input type="hidden" value="2018-05-25" class="otime">
                         <?php 
                         if($info['passed'] == 1){?>
                            <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                            <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                            <span style="color:white;">已封团</span>
                        <?php }else{?>
                        <span><?php if(!empty($priceInfo)){ echo $priceInfo[0]['godate']; }?></span>
                        <span>&yen;<?php if(!empty($priceInfo)){ echo $priceInfo[0]['price']; }?>/成人</span>
                        <span>&yen;<?php if(!empty($priceInfo)){ echo $priceInfo[0]['boyprice']; }?>/儿童(余<?php if(!empty($priceInfo)) { echo $priceInfo[0]['leftpeople']; } ?>位)</span>
                        <?php }?>
                    </span>
					<div class="lines">
						<ul>
                        <?php 
                            if($info['passed'] == 1){?>
                                
                            <?php }else{
                            for($i=0;$i<count($priceInfo);$i++){
                        ?>
                            <li class="fc-fff">
                                <input type="hidden" value="1196">
                                <span class="time"><?php echo $priceInfo[$i]['godate']; ?></span>
                                <span class="pri1">&yen;<?php echo $priceInfo[$i]['price'];?>/成人</span>
                                <span class="pri2">&yen;<?php echo $priceInfo[$i]['boyprice'];?>/儿童(余<?php echo $priceInfo[$i]['leftpeople'];?>位)</span>
                            </li>
                        <?php }}?>
                        </ul>
					</div>

				</span> -->
				<a href="javascript:void(0);"  class="btn btn_glod fc-fff" style="background:white; margin-top:-150px;" ><h1 style="font-size: 22px;color: #e8840e;line-height: 40px;">预订电话：<br />028-83918255 / 83960085</h1></a>
			</div>            
            
            </div>
            
            <div style="width:1200px; margin:0 auto;margin-top: -500px;">

            <div class="detiless" style="width: 58.9%; bottom: 0; height: 130px; padding: 25px 0;z-index: 10; margin: 3% 0 0 0;" >
                <div class="clearfix w-1200" style="margin:0 0; width:703px;height:70px;">
                    
                    <div class="del fl" style="width:703px; background-color: #fff;border-radius: 10px">
                        <h1 class="fc-fff fs-30 post2" style="margin:20px 0; border:0px"><span style="color:#929292;font-size:16px;margin: 0 0 0 30px;">HOTEL &nbsp; </span><?php echo $info['title']; ?></h1>
                        <!-- <p class="fc-fff fs-18" style=" color: #000!important; margin: 10px 0;">出发城市:&nbsp;成都</p>
                        <p class="fc-fff fs-18" style=" color: #000!important; margin: 10px 0;">行程天数:&nbsp;15天 <div class="price fc-fff">&yen;
                            <!-- <span class="fs-30">5900.00</span>起</div> -->
                       <!-- </p> -->
                    </div>
                    
                </div>
            </div>
        </div>

		</div>

<script>

    $(function(){

        $(".btn_search_top").click(function(){

            var keyword=$("#inp_keyword_top").val();

            location.href='/Search/index/keyword/'+keyword;

        });

    });

</script>

<script>

    $(function(){

        $(".inner_div i").click(function(e){

            e.stopPropagation();

            location.href=$(this).attr("golink");

        })



    })

</script>


	</body>
	<script>
        $(function () {
            var new_height = $(window).height();
            $('#details-line .swiper-slide').css('height', (new_height - '120') + 'px')
			/*轮播初始化*/
			var mySwiper = new Swiper('.swiper-container',{
			    loop: true,
			    autoplay: 5000,
			    autoplayDisableOnInteraction: false,
			});
			$('.arrow-left').click(function () {
			    mySwiper.swipePrev();
			});
			$('.arrow-right').click(function () {
			    mySwiper.swipeNext();
			});
			/*预定选择框*/
			$("#details-line .reservation .select ul li").click(function(){
                var route_id=$(this).children('input').val();
				var time=$(this).children(".time").text();
				var pri1=$(this).children(".pri1").text();
				var pri2=$(this).children(".pri2").text();
				$("#details-line .reservation .select .show").html("<input type='hidden' value=" + route_id + "><input type='hidden' value=" + time + " class='otime'>" + "<span>" + time + "</span><span>" + pri1 + "</span><span>" + pri2 + "</span>");
			});
			$("#details-line .reservation .select").click(function(){
				$("#details-line .reservation .select ul").toggle();
			});
		    /*滑动到一定位置，4个标题定在顶部*/
			setTimeout(function () {
			    var top = $(".tittop").offset().top;
			    var top1 = $("#product-profile").offset().top - 80;
			    var top2 = $("#stroke-introduced").offset().top - 80
			    var top3 = $("#costs").offset().top-80;
			    var top4 = $("#booking-information").offset().top-80

			    $(window).scroll(function () {
			        if ($(window).scrollTop() >= $("#details-line .title").offset().top) {
			            $("#details-line .title .tittop").css({ "position": "fixed", "top": "0px" })
			        } else {
			            $("#details-line .title .tittop").css({ "position": "static" })
			        };
			        if ($(window).scrollTop() >= $("#details-line #product-profile").offset().top) {
			            $("#details-line #product-profile").css("padding", "160px 0 50px")
			        } else {
			            $("#details-line #product-profile").css("padding", "50px 0")
			        };
			        if ($(window).scrollTop() >= $("#details-line #stroke-introduced").offset().top) {
			            $("#details-line #stroke-introduced").css("padding", "160px 0 50px")
			        } else {
			            $("#details-line #stroke-introduced").css("padding", "50px 0")
			        };
			        if ($(window).scrollTop() >= $("#details-line #costs").offset().top) {
			            $("#details-line #costs").css("padding", "160px 0 0px")
			        } else {
			            $("#details-line #costs").css("padding", "50px 0")
			        };
			        if ($(window).scrollTop() >= $("#details-line #booking-information").offset().top) {
			            $("#details-line #booking-information").css("padding", "160px 0 0px")
			        } else {
			            $("#details-line #booking-information").css("padding", "50px 0")
			        };

			        if ($(this).scrollTop() >= top1 && $(this).scrollTop()<top2) {
			            $(".tittop a").eq(0).css("color", "#afa265").siblings().css("color", "#000");
			        
			        } else if ($(this).scrollTop() >= top2 && $(this).scrollTop() < top3) {
			            $(".tittop a").eq(1).css("color", "#afa265").siblings().css("color", "#000");
			            console.log($(this).scrollTop() + "*****" + top2)

			        } else if ($(this).scrollTop() >= top3 && $(this).scrollTop()<top4) {
			            $(".tittop a").eq(2).css("color", "#afa265").siblings().css("color", "#000");

			        } else {
			            $(".tittop a").eq(3).css("color", "#afa265").siblings().css("color", "#000");

			        }

			    });

			}, 0)
			
			/*点击字体变颜色*/
			$("#details-line .title .tittop a").click(function(){
				$(this).addClass("color_glod");
				$(this).siblings().removeClass("color_glod");
			});
		});

	</script>
<?php include('../head/foot.php');?>