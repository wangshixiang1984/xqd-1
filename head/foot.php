
<link href="/css/kefu.css" rel="stylesheet" type="text/css">
<div id="for_kefu_block" >
  <div class="kefu_block" id="kefu_block">
    <div class="kefu_box">
      <div class="kefu_title"><a class="kefu_close" href="javascript:void(0)"><img src="/Theme/Simple/images/kf_top.png" width="183" height="31"></a></div>
      <div class="kefu_con">
        <div class="kefu_tel"></div>
        <div class="kefu1">
          <div class="kefu_con_title">
            <ul class="jszcfwul">
              <li class="kefu_con_title_li1"><img src="/Theme/Simple/images/kf_line2.png" width="14" height="14"></li>
              <li class="kefu_con_title_li2">咨询服务</li>
              <div style="clear:both"></div>
            </ul>
          </div>
          <div class="kefu_con_con1">
			<?php 
				$sql = "select * from indextel";
				$info = $lg->select_arr1($sql);
			?>
            <ul>
              <li class="neititle">
                <div class="uline">旅游顾问</div>
              </li>
              <li> <a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $info['qq1'] ?>&site=qq&menu=yes"><img border="0" src="http://wpa.qq.com/pa?p=2:<?php echo $info['qq1'] ?>:51" alt="点击这里给我发消息" title="点击这里给我发消息"></a> </li>
              <li> <a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $info['qq2'] ?>&site=qq&menu=yes"><img border="0" src="http://wpa.qq.com/pa?p=2:<?php echo $info['qq2'] ?>:51" alt="点击这里给我发消息" title="点击这里给我发消息"></a> </li>
              <li> <a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $info['qq3'] ?>&site=qq&menu=yes"><img border="0" src="http://wpa.qq.com/pa?p=2:<?php echo $info['qq3'] ?>:51" alt="点击这里给我发消息" title="点击这里给我发消息"></a> </li>
              <li> <a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $info['qq4'] ?>&site=qq&menu=yes"><img border="0" src="http://wpa.qq.com/pa?p=2:<?php echo $info['qq4'] ?>:51" alt="点击这里给我发消息" title="点击这里给我发消息"></a> </li>
              <div style="clear:both"></div>
              <li class="neititle">
                <div class="uline">线路定制</div>
              </li>
              <li> <a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $info['qq5'] ?>&site=qq&menu=yes"><img border="0" src="http://wpa.qq.com/pa?p=2:<?php echo $info['qq5'] ?>:51" alt="点击这里给我发消息" title="点击这里给我发消息"></a> </li>
              <div style="clear:both"></div>
            </ul>
          </div>
        </div>
        
        <script type="text/javascript">
					$(document).ready(function() {
						$(".kefu_con_title").click(function(){
							$(this).siblings(".kefu_con_con").toggle();
							var obj  =$(this).find("li:first");
							var src = obj.find("img").attr("src");
							if(obj.attr("class")=="kefu_con_title_li1"){
								obj.html("<img src='"+ src.replace("kf_line2","kf_line1") +"'>")
								obj.addClass("abcdefg");
								return true;
								}
								else{
									obj.html("<img src='"+ src.replace("kf_line1","kf_line2") +"'>")
									obj.removeClass("abcdefg");
									return true;
									}
							})
            		});
            	</script>
      </div>
      <div class="kefu_tt"><a href="#"><img src="/Theme/Simple/images/kf_foot.png" /></a></div>
    </div>
  </div>
  <div class="kefu_flag"><img src="/Theme/Simple/images/kefu_flag.gif" /></div>
</div>
<script language="javascript">
var OnlineTop = 300;
//var OnlinePosition = left;
var animate = 0;
var OnlineTopC = OnlineTop + "px";
var $OnlineBox = $("#for_kefu_block");

$(document).ready(function(){
	$OnlineBox.css('display','block');
	$OnlineBox.css('top',OnlineTopC);
});
FollowDiv = {
	follow : function(){
		$('#for_kefu_block').css('position','absolute');
		$(window).scroll(function(){
			var f_top = $(window).scrollTop() + OnlineTop;
			$('#for_kefu_block').css( 'top' , f_top );
		});
	}
}
$(".kefu_flag").hide();
$(".kefu_block").show();
$(".kefu_close").click(function(){
	$(".kefu_block").hide();
	$(".kefu_flag").show();
	
})
$(".kefu_flag").click(function(){
	$(this).hide();
	$(".kefu_block").show();
	
})
</script>

<script src="/Front/js/base_d.js"></script>
<script src="/Front/js/publicFunctions.js"></script>
<script src="/plugin/lazyload/jquery.lazyload.min.js"></script>
<script type="text/javascript" src="/plugin/sweetalert/sweetalert.min.js"></script>
<script src="/Theme/Simple/js/jquery.scrollLoading-min.js"></script>
<script src="/Theme/Simple/js/wow.min.js"></script>
<script src="/Theme/Simple/js/jquery.waypoints.min.js"></script>
<script src="/Theme/Simple/js/common.js"></script>
<script src="/Theme/Simple/js/swiper.js"></script>
<script src="/plugin/swiper/swiper.jquery.min.js"></script>
<!-- <script src="/js/iepng.js"></script> -->
<script>
$(function(){
	var wow = new WOW({
		animateClass: 'animated',
		offset: 100,
		callback: function(box) { }
	});
	wow.init();
});

var mySwiper = new Swiper ('.swiper-containers', {
	loop: true, 
	autoplay : 3000, 
	speed : 1400,
	effect : 'fade',
	paginationClickable :true,  
	// 如果需要分页器
	pagination: '.swiper-pagination',
	paginationClickable: true,
	paginationBulletRender: function (index, className) {
		return '<span class="' + className + '">' + (index + 1) + '</span>';
	}
});

$(".swiper-pagination").eq(1).remove();
</script>
<div class="do-footer">
	<div class="do-area" id="footer_23509_0">
		<div class="do-area-bg">
			<div class="do-area-bg-conter"><div class="bgcolor"></div></div>
		</div>
		<div id="footer_0" class="do-row do-row-one">
		<div class="do-row ">
		<div class="do-col-12">
		<div class="do-panelcol">
			<div class="do-block do-hr do-3b94t">
				<div class="do-element-line default ">
					<div class="do-element-line-content">
						
					</div>
				</div>
			</div>
			<div class="do-block do-text do-3b94r">
				<div class="do-element-text">
					<div class="do-element-text-content do-html">
						<div class="do-html-content"><p style="text-align: center;color:rgb(119, 126, 128)">Powered by 心启点自驾 © 2012-2018 网站备案:蜀ICP备13018648号-6 <a href="/about">【联系我们】</a></p></div>
					</div>
				</div>
			</div>
			<div class="do-block do-space do-3b94q">
				<div class="do-element-space" style="padding-top:2%;"></div>
			</div>
		</div>
		</div>
	</div>
</div></div></div></div>

<link rel="stylesheet" type="text/css" href="/Widget/Contact/css/multiple_xqd.css">
<script type="text/javascript" charset="utf-8">
$(function() {
	$("img.lazy").lazyload({
		effect : "fadeIn"
	});
	function goMobile() {
    if(/Android|webOS|iPhone|iPod|BlackBerry/i.test(navigator.userAgent)) {
        window.location.href = "/h5";
    } 
	}
	// goMobile();
});

var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "https://hm.baidu.com/hm.js?7fc804a7fef5cf414af71502bc3360e7";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
</script>
<script language="Javascript"> 
document.oncontextmenu=new Function("event.returnValue=false"); 
document.onselectstart=new Function("event.returnValue=false"); 
</script> 
</body>
</html>

