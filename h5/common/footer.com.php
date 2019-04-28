<?php $tels = $lg->select_arr1('select * from gywm');?>
<div class="totop">
    <i class="iconfont iconshouqi rit"></i>
</div>
<div class="relative footer-wp">
<footer class="footer p10 clr-all relative">
    <div class="mt40">
        <div class="qrcode color3">
            <div class="t-c"><i class="pic "><img src="/h5/public/images/qrcode.png" /></i></div>
            <div class="t-c mt5" >关注微信公众号：CDXQDZJY</div>
            <div class="t-c" >最全面的旅行资讯应有尽有</div>
        </div>
        <div class="t-c mt20 color3">客服热线</div>
        <div class="mod1 w50" style="margin: 0 auto;">
            
                <p  class="mt5">
                    <i style="width: 0.2rem; height: 0.2rem;" id="gotel" phone="<?php echo $tels['xstel']; ?>">
                    <img src="/h5/public/images/zj.png" /></i>
                     座机：
                    <?php echo $tels['xstel']; ?> 
                </p>
                <p  class="mt5">
                    <i style="width: 0.2rem; height: 0.2rem;" id="gotelzx" phone="<?php echo $tels['zxtel']; ?>">
                    <img src="/h5/public/images/tel.png" /></i>
                     手机：
                    <?php echo $tels['zxtel']; ?> 
                </p>
        </div>
        <div class="t-c mt20 color3">商务合作</div>
        <div class="mod1 w50" style="margin: 0 auto;">
            <p  class="mt5">
                <i style="width: 0.2rem; height: 0.2rem;" id="gotelts" phone="<?php echo $tels['tstel']; ?>">
                <img src="/h5/public/images/tel.png" /></i>
                    手机：
                <?php echo $tels['tstel']; ?> 
            </p>
        </div>
        <div class="t-c mt20 color3">联系地址</div>
        <div style="width: 80%; margin: 0 auto;" >
            <div class="mod p0">
            <i style="width: 0.2rem; height: 0.2rem;">
            <img src="/h5/public/images/adr.png" height="0.2rem" /></i>
                <div  class="mt5">
                    <?php echo $tels['address'] ?>
                </div>
            </div>
        </div>
    </div>
</footer>
<div class="copyright t-c">
    <!-- <p>心启点——做你身边的出行专家</p> -->
    <p>成都沙龙心启点汽车俱乐部</p>
    <p>Powered by 心启点自驾 © 2018-2026 </p>
    <p><a href="javascript:void(0)" class="color-white" target="_blank" rel="nofollow"><img src="/h5/public/images/police.png" style="width: auto;height: 14px;">蜀ICP备13018648号-6</a></p>
</div>
<div class="footer-cloud">
    <div class="relative">
        <div class="cloud-mask">
            <img src="/h5/public/images/cloud-mask.png" width="100%">
        </div>
        <div class="move-cloud-1">
            <img src="/h5/public/images/move-cloud-1.png" width="100%">
        </div>
        <div class="move-cloud-2">
            <img src="/h5/public/images/move-cloud-2.png" width="100%">
        </div>
        <div class="move-cloud-3">
            <img src="/h5/public/images/move-cloud-3.png" width="100%">
        </div>
    </div>
</div>
</div>
<script src='/js/template-web.js'></script>
<script>
function goPc() {
    if(!/Android|webOS|iPhone|iPod|BlackBerry/i.test(navigator.userAgent)) {
        window.location.href = "/";
    } 
}
goPc();
</script>
</div>
</body>
</html>