<?php
  $sql_a = "select * from adver where type=5 order by id desc limit 0, 1";
  $adv = $lg->select_arr1($sql_a);
?>
<div class="sp-wp">
    <div class="com-adv">
        <img src="<?php echo $imgDir.$adv['img_path'];?>" alt="<?php echo $adv['title'];?>" />
    </div>
    <div class="m-lay us mt10 bg-w" id="container">
        
    </div>
</div>
<script id="list" type="text/html">
    {{each data.list data index}}
        <div class="con mt10 clr-all f12 brd-btm pb10">
            <a href="./detail.php?id={{data.id}}">
                <div class="lpic"><img src="<?php echo $imgDir?>{{data.img_path}}" /></div>
                <p class='tit t-l f14 f-bold fone-ellipsis mt5'>{{data.title}}</p>
                <p><span class="fl">作者：{{data.author}}</span><span class="fr">浏览：{{data.clicktime}}</span></p>
            </a>
        </div>
    {{/each}}
</script>
<script type="text/javascript" charset="utf-8">
    $(function(){
        var cdata = new Cdata('container', './getList.php');
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