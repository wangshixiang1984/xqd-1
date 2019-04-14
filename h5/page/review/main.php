<?php
    $video_url = $rootDir.'/htmleditor/attached/image/mainpic/video/';
    $sql_a = "select * from adver where type=5 order by id desc limit 0, 1";
    $adv = $lg->select_arr1($sql_a);
?>
<link rel="stylesheet" href="/h5/public/css/video.css">
<style>
    .video-js{
        width: 100%;
    }
    .video-js .vjs-big-play-button{
        top: 50%;
        left: 50%;
        transform: translate3d(-50%, -50%, 0);
        border: 0.04em solid #fff;
        background-color: rgba(43, 51, 63, 0.4);
    }
</style>
<div class="sp-wp">
    <div class="com-adv">
        <img src="<?php echo $imgDir.$adv['img_path'];?>" alt="<?php echo $adv['title'];?>" />
    </div>
    <div class="m-lay us mt10 bg-w" id="container">
       
    </div>
</div>
<script src="/h5/public/js/video.js"></script>

<script id="list" type="text/html">
    {{each data.list data index}}
        <div class="con mt10 clr-all f12 brd-btm pb10">
            <video id='my-video' class='video-js' controls preload='auto' width='100%' height='150'
            poster='/h5/public/images/hpic.png' data-setup='{}'>
                <source src='{{data.lurl}}' type='video/mp4'>
                <p class='vjs-no-js'>
                    浏览器版本太低,不支持HTML5视频,请升级！
                </p>
            </video>
            <p class='tit t-l f14 f-bold fone-ellipsis mt5'>{{data.name}}</p>
        </div>
    {{/each}}
</script>


<script type="text/javascript" charset="utf-8">
    $(function(){
        var cdata = new Cdata('container', './getlist.php');
        cdata.getInfo();
        $(window).scroll(function(e){
            var doH = $(document).height(),
                scrH = $(document).scrollTop(),
                wH = $(window).height(),
                btmH = 50;
                if(doH - scrH -btmH - wH <= -50) {
                    cdata.getInfo();
                }
        })
    });
</script>
