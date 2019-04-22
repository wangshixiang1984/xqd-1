<?php $tels = $lg->select_arr1('select * from gywm');?>

<footer class="footer p10 clr-all">
    <div class="">
        <div class="mod">
            <i id="gotel"><img src="/h5/public/images/phone.png" /></i>
            <div>
                <p>联系电话 / PHONE</p>
                <p><?php echo $tels['xstel'] ?>/<?php echo $tels['zxtel'] ?></p>
            </div>
        </div>
        <div class="mod">
            <i><img src="/h5/public/images/addr.png" /></i>
            <div>
                <p>联系地址 / ADDRESS</p>
                <p><?php echo $tels['address'] ?></p>
            </div>
        </div>
    </div>
    <div class=" qrcode">
        <div class="pic"><img src="/h5/public/images/qrcode.png" /></div>
        <div class="t-c" >微信公众号</div>
    </div>
</footer>
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