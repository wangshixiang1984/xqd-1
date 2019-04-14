
<script src="./public/js/swiper.js"></script>
<style>
.index-bullet-active{
    background: #ee13fc;
    opacity: 1;
}
</style>
<div class="swiper-container" id="swiper1">
    <div class="swiper-wrapper" id="container">
        
    </div>
    <!-- 如果需要分页器 -->
    <div class="swiper-pagination"></div>
</div>



<!-- 目的地 -->
<div class="m-lay relative">
    <ul class="cate" id="place">
      
    </ul>
    <i class="iconfont iconxiayibu rit"></i>
</div>


<!-- 热门推荐 -->
<div class="m-lay">
    <div class='tit'>
        <div class="fl"><i></i><h3>热门推荐</h3></div>
    </div>
    <div class="p10 bg-w relative mt10">
        <div class="con bg-w swiper-container" id="swiper2">
            <div class="swiper-wrapper" id="hotplace">

            </div>
        </div>
        <div class="nav swiper-pagination" id="nav-page"></div>
    </div>
</div>
<!-- 近期行程 -->
<div class="m-lay mt30 bg-w">
    <div class='tit jqxc'>
        <div class="fl"><i></i><h3>近期行程</h3></div>
        <a href="/h5/page/recentplan/" class="fr f12">更多行程 >></a>
    </div>
    <div class="con mt10 clr-all" id="recentplace">
       
    </div>
</div>
<!-- 出行时间 -->
<div class="m-lay mt10 bg-w">
    <div class='tit cxsj'>
        <div class="fl"><i></i><h3>出行时间</h3></div>
    </div>
    <div class="con mt10 clr-all">
        <ul class="month mt10">
            <li><a href="/h5/page/time/index.php?mon=1"><img src="./public/images/m1.png" /></a></li>
            <li><a href="/h5/page/time/index.php?mon=2"><img src="./public/images/m2.png" /></a></li>
            <li><a href="/h5/page/time/index.php?mon=3"><img src="./public/images/m3.png" /></a></li>
            <li><a href="/h5/page/time/index.php?mon=4"><img src="./public/images/m4.png" /></a></li>
            <li><a href="/h5/page/time/index.php?mon=5"><img src="./public/images/m5.png" /></a></li>
            <li><a href="/h5/page/time/index.php?mon=6"><img src="./public/images/m6.png" /></a></li>
           
        </ul>
        <ul class="month mt10">
            <li><a href="/h5/page/time/index.php?mon=7"><img src="./public/images/m7.png" /></a></li>
            <li><a href="/h5/page/time/index.php?mon=8"><img src="./public/images/m8.png" /></a></li>
            <li><a href="/h5/page/time/index.php?mon=9"><img src="./public/images/m9.png" /></a></li>
            <li><a href="/h5/page/time/index.php?mon=10"><img src="./public/images/m10.png" /></a></li>
            <li><a href="/h5/page/time/index.php?mon=11"><img src="./public/images/m11.png" /></a></li>
            <li><a href="/h5/page/time/index.php?mon=12"><img src="./public/images/m12.png" /></a></li>
        </ul>
    </div>
</div>
<!-- 游记攻略 -->
<div class="m-lay mt10 bg-w">
    <div class='tit yjgl'>
        <div class="fl"><i></i><h3>攻略●游记</h3></div>
        <a href="/h5/page/strategy/" class="fr f12">更多攻略 >></a>
    </div>
    <div class="con mt10 clr-all" id="strategy">
       
    </div>
</div>
<!-- 关于我们 -->
<div class="m-lay us mt10 bg-w" id="aboutus">
   
</div>

<!-- 首页广告模板 -->
<script id="adver" type="text/html">
    {{each data.list data index}}
        <div class="swiper-slide">
            <a href="{{data.pic_link}}"><img src="<?php echo $imgDir;?>{{data.img_path}}" /></a>
        </div>
    {{/each}}
</script>
<!-- 首页目的地列表 -->
<script id="destination" type="text/html">
    {{each data.list data index}}
        <li>
            <div class="m-item">
                <a href="/h5/page/destination/index.php?city={{data.gocity}}"><img src="<?php echo $imgDir; ?>{{data.citypic}}" /></a>
            </div>
        </li>
    {{/each}}
</script>
<!-- 热门推荐 -->
<script id="hot" type="text/html">
    {{each data.list data index}}
        <div class="stc swiper-slide">
            <a href="/h5/page/detail/index.php?id={{data.id}}">
                <div class="lpic"><img src="<?php echo $imgDir;?>{{data.img_path}}" /></div>
                <p class='tit t-l'>{{@data.title}}</p>
            </a>
            <div class="date mt10">出发日期：{{data.godate}}</div>
            <div class="pri mt10"><span class="f14">￥{{data.price}}</span> /人起</div>
        </div>
    {{/each}}
</script>
<!-- 近期行程 -->
<script id="recent" type="text/html">
    {{each data.list data index}}
        <div class="m-mod">
            <a href="/h5/page/detail/index.php?id={{data.id}}" class="m-item">
                <img src="<?php echo $imgDir;?>{{data.img_path}}" />
            </a>
            <p class="f14 f-bold fone-ellipsis mt5">{{@data.title}}</p>
            <p class="f12">出团时间：{{data.godate}}</p>
            <p class="f12">￥<span class="red">{{data.price}}</span> /人起</p>
        </div>
    {{/each}}
</script>
<!-- 攻略 -->
<script id="stra" type="text/html">
    {{each data.list data index}}
        <div class="row mt10 yj">
            <div class="m-mod">
                <a href="/h5/page/strategy/detail.php?id={{data.id}}" class="m-item">
                    <img src="<?php echo $imgDir;?>{{data.img_path}}" />
                </a>
            </div>
            <div class="m-mod">
                <p class="f14 f-bold t-c fone-ellipsis">{{@data.title}}</p>
                <p class="f12 des f4-ellipsis">
                    {{@data.des}}    
                </p>
            </div>
        </div>
    {{/each}}
</script>
<!-- 关于我们 -->
<script id="about" type="text/html">
    <div class='tit us'>
        <div class="fl"><i></i><div class="tpic"><img src="./public/images/at.png" /></div></div>
    </div>
    <div class="con mt10 clr-all">
        <a href="/h5/page/about/">
            <div class="lpic"><img src="<?php echo $imgDir;?>{{data.list.pic}}" /></div>
            <p class='tit t-l f14 f-bold f3-ellipsis mt5'>{{@data.list.title}}</p>
        </a>
    </div>
</script>


<script type="text/javascript" charset="utf-8">
    $(function(){
        // 广告数据
        (function(){
            var cdata = new Cdata('container', './page/adver/getList.php',{
                hideText: true,
                callback: function() {
                    var mySwiper1 = new Swiper ('#swiper1', {
                            loop: true, // 循环模式选项
                            // 如果需要分页器
                            pagination: {
                            el: '.swiper-pagination',
                            bulletActiveClass: 'index-bullet-active',
                        }
                    })   
                }
            });
            cdata.setId('adver').getInfo(null, 1, 4);
        })();
        // 目的地
        (function(){
            var cdata1 = new Cdata('place', './indexdata/getDestination.php',{
                hideText: true
            });
            cdata1.setId('destination').getInfo();
        })();
        // 热门推荐
        (function(){
            var cdata2 = new Cdata('hotplace', './indexdata/getHot.php',{
                hideText: true,
                callback: function() {
                    var mySwiper2 = new Swiper ('#swiper2', {
                        loop: true, // 循环模式选项
                        // 如果需要分页器
                        pagination: {
                            el: '#nav-page',
                            // type: 'custom',
                            // bulletElement: 'li',
                            clickable :true,
                            bulletClass : 'bullet',
                            bulletActiveClass: 'active',
                            renderBullet: function (index, className) {
                                return '<li class="' + className + '">' + (index + 1) + '</li>';
                            }
                        }
                    })  
                }
            });
            cdata2.setId('hot').getInfo();
        })();
        // 近期行程
        (function(){
            var cdata3 = new Cdata('recentplace', './page/recentplan/getRecent.php',{
                hideText: true,
            });
            cdata3.setId('recent').getInfo();
        })();
        // 攻略
        (function(){
            var cdata4 = new Cdata('strategy', './page/strategy/getList.php',{
                hideText: true,
            });
            cdata4.setId('stra').getInfo();
        })();
        // 关于我们
        (function(){
            var cdata5 = new Cdata('aboutus', './indexdata/about.php',{
                hideText: true,
            });
            cdata5.setId('about').getInfo();
        })();
    });
</script>
<script>

     
  
  
</script>

