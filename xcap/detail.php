<?php 
$urlType = 2;
$urlType = isset($_GET['type']) ? intval($_GET['type']) : $urlType;
    if(!isset($dirNow)){
        $dirNow = '../';
    }
    include($dirNow.'conf/op.class.php');
    $id = intval($_GET['id']);
    $sql = "select * from xcap where id='$id'";
    $info = $lg->select_arr1($sql);
    $priceInfo = $lg->select_arr2("select * from xcdate where xcapid='$id'");
    $xcdetail = $lg->select_arr2("select * from xcdes where xcapid='$id' order by whichday asc");
    include "../head/head_d.php";
    $prices = [];    
    foreach($priceInfo as $k => $val){
        array_push($prices, $val['price']);
    }
    $minprice = 0;
    if(!empty($prices)){
        $minprice = min($prices);
    }
   
   
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

    <input type="hidden" value="436" id="line_id">
		<div class="detiless" style="width: 25%;position: absolute;bottom: 0;height: 430px;padding: 25px 0;z-index: 10; margin:150px 0 0 58%;top:0" >
            <div class="clearfix w-1200" style="margin:50px 0">
                <div class="der fl" style="height:105px; color:white;">
                    <?php echo $info['des']; ?>
                </div>
                <div class="del fl">
                    <p class="fc-fff fs-18" style="width: 400px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="/Theme/Simple/images/zuobiao.png"/>&nbsp;&nbsp;&nbsp;&nbsp;出发城市:&nbsp;<?php echo $info['startplace']; ?></p>
                    <p class="fc-fff fs-18" style="width: 400px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="/Theme/Simple/images/licheng.png"/>&nbsp;&nbsp;&nbsp;&nbsp;行程里程:&nbsp;<?php echo $info['mile']; ?></p>
                    <p class="fc-fff fs-18" style="width: 400px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="/Theme/Simple/images/taiyang.png"/>&nbsp;&nbsp;&nbsp;行程天数:&nbsp;<?php echo $info['goday']; ?>天 <div class="price fc-fff">
                        <span class="fs-30"><img src="/Theme/Simple/images/qian.png"/ style="margin:0 20px 0 44px;">
                            <?php if($info['gotheme'] == "AA制自驾"){?>
                                费用  AA
                            <?php }else{
                                if($info['passed'] == 1){echo 0;}else{ echo $minprice; }?>
                                </span><span style="color:#fff"> &nbsp;起
                            <?php }?>
                        </span></div>
                    </p>
                </div>
                
            </div>
		</div>
		
        
        <div id="details-line" style="postion:relative; background-color:#f4ffff;height:680px;">
			<div id="bei">
                <div id="bei-auto">
                    <div class="swiper-container">
        				<a class="arrow-left" href="#"></a>
        				<a class="arrow-right" href="#"></a>
        				<div class="swiper-wrapper">
                            <div class="swiper-slide" style="background-image:url('<?php echo IMG_DIR.$info['img_path']; ?>');background-size:100%;background-position:center top;"></div>
                        </div>
        				
        			</div>
                </div>
           <div class="reservation">
				<!-- <span class="fc-fff fs-24"><img src="../detail/img/slice/write1.png" alt=""/></span> --><!--选择出团时间-->
				<span class="select fc-999" style="margin-right:11px;">
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
                        <span><?php if($info['gotheme'] == 'AA制自驾'){
                            echo '预估消费：'.intval($priceInfo[0]['price'])."/人"; }else{if(!empty($priceInfo)){ echo '&yen;'.$priceInfo[0]['price']; }?>/成人<?php }?></span>
                        <span><?php 
                        if($info['gotheme'] == 'AA制自驾'){
                            echo '预收活动费：'.intval($priceInfo[0]['boyprice'])."/人"; }else{
                                if(!empty($priceInfo)){ echo '&yen;'.$priceInfo[0]['boyprice']; }?>/儿童(余<?php if(!empty($priceInfo)) { echo $priceInfo[0]['leftpeople']; } ?>位)
                            <?php } ?>    
                            </span>
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
                                <span class="pri1"><?php if($info['gotheme'] == 'AA制自驾'){
                                    echo '预估消费：'.intval($priceInfo[0]['price'])."/人"; }else{echo '&yen;'.$priceInfo[$i]['price'];?>/成人<?php } ?></span>
                                <span class="pri2"><?php if($info['gotheme'] == 'AA制自驾'){
                                    echo '预收活动费：'.intval($priceInfo[0]['boyprice'])."/人"; }else{
                                    echo $priceInfo[$i]['boyprice'];?>/儿童(余<?php echo '&yen;'.$priceInfo[$i]['leftpeople'];?>位)<?php }?>
                                    </span>
                            </li>
                        <?php }}?>
                        </ul>
					</div>

				</span>
				<a href="javascript:void(0);"  class="btn btn_glod fc-fff" style="background:white;" ><h1 style="font-size: 22px;color: #e8840e;line-height: 40px;">预订电话：<br />028-83918255 / 83966588</h1></a>
			</div>            </div>
            
            <div style="width:1200px; margin:0 auto;margin-top: -500px;">

            <div class="detiless" style="width: 58.9%; bottom: 0; height: 130px; padding: 25px 0;z-index: 10; margin: 3% 0 0 0;" >
                <div class="clearfix w-1200" style="margin:0 0; width:703px;height:70px;">
                    
                    <div class="del fl" style="width:703px; background-color: #fff;border-radius: 10px">
                        <h1 class="fc-fff fs-30 post2" style="margin:20px 0; border:0px"><span style="color:#929292;font-size:16px;margin: 0 0 0 30px;">ROUTE </span><?php echo $info['title']; ?></h1>
                        <!-- <p class="fc-fff fs-18" style=" color: #000!important; margin: 10px 0;">出发城市:&nbsp;成都</p>
                        <p class="fc-fff fs-18" style=" color: #000!important; margin: 10px 0;">行程天数:&nbsp;15天 <div class="price fc-fff">&yen;
                            <span class="fs-30">5900.00</span>起</div> -->
                       <!-- </p> -->
                    </div>
                    
                </div>
            </div>
        </div>

			<div class="title">
				<div class="tittop">
					<a href="#product-profile" class="pro color_glod" style="border-left: 1px solid #b83c92;">产品概要</a>
					<a href="#stroke-introduced" class="str">行程介绍</a>
					<a href="#costs" class="cos">费用说明</a>
					<a href="#booking-information" class="boo">预订须知</a>
				</div>
			</div>
            <div id="bian"> 
			<div id="product-profile" >
				<h1 class="border_glod" style="border-bottom: 3px dashed #a60174; position: absolute; top: -30px;left: 250px;"><img src="/Theme/Simple/images/write2.png"/></h1>
				<!-- <h2 class="fs-18 fc-ccc">Product overview</h2> -->
				<div class="w-1200">
                    <?php echo html_entity_decode($info['content_desc']); ?>
                </div>
			</div>
            </div>
            <div id="bian" >
			<div id="stroke-introduced">
				<h1 class="border_glod" style="border-bottom: 3px dashed #a60174;position: absolute; top: -43px;left: 250px;"><img src="/Theme/Simple/images/write3.png"/></h1>
				<!-- <h2 class="fs-24 fc-ccc">Product overview</h2> -->
                <?php 
                for($i=0;$i<count($xcdetail); $i++){
                    if(!empty($xcdetail[$i]['daypic'])){
                        $pics = explode(',', $xcdetail[$i]['daypic']);
                    }
                    
                ?>
                <div class="day w-1200">
                        <h3 class="border_glod"><?php echo $xcdetail[$i]['daytitle']; ?></h3>
                        
                        <div class="main"><?php echo $xcdetail[$i]['daydes']; ?></div>
                        
                        <div  class="click_look">
                            <ul class="clearfix">
                                <?php
                                for($j=0;$j<count($pics); $j++){
                                ?>
                                <li class="fl">
                                        <div style="width:100%;padding-top:66.66666%;position:relative;">
                                            <a href="<?php echo IMG_DIR.$pics[$j]; ?>">
                                                <img src="<?php echo IMG_DIR.$pics[$j]; ?>" width="293" height="220" alt="" />
                                            </a>
                                        </div>
                                    </li>
                                <?php }?>
                              </ul>
                        </div>
                        <p class="line">
                            <span style="margin-left: 35px;">用餐:</span>
                            <span><?php echo $xcdetail[$i]['dinner']; ?></span>                             
                        </p>
                        <p class="line line1">
                            <span style="margin-left: 35px;">住宿:</span>
                            <span><?php echo $xcdetail[$i]['hotel']; ?></span>                             
                        </p>                        
                    </div>
                <?php }?>
			</div>
            </div>
            <div id="bian">
			<div id="costs" style="padding: 160px 0px 0px;">
				<h1 class="border_glod" style="border-bottom: 3px dashed #a60174;position: absolute; top: -31px;left: 250px;;"><img src="/Theme/Simple/images/write4.png"/></h1>
				<!-- <h2 class="fs-18 fc-ccc">Expense explanation</h2> -->
				<div class="w-1200">
                    <?php echo html_entity_decode($info['content_fee']); ?>
                </div>
			</div>
            </div>
            <div id="bian">
			<div id="booking-information" style="padding: 160px 0px 0px;">
				<h1 class="border_glod" style="border-bottom: 3px dashed #a60174; position: absolute; top: -43px;left: 250px;"><img src="/Theme/Simple/images/write99.png"/></h1>
				<!-- <h2 class="fs-18 fc-ccc">Booking notes</h2> -->
				<div class="w-1200"><?php echo html_entity_decode($info['content_needknow']); ?></div>
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