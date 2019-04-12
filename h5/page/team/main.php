<?php
//广告
$sql = 'select * from adver where type = 7 limit 0, 1';
$adv =  $lg->select_arr1($sql);
?>
<div class="">
    <div class="com-adv">
        <img src="<?php echo $imgDir.$adv['img_path'] ?>" />
    </div>
    <div class="lde-wp p10" id="container">
    
        
    </div>
</div>

<script id="list" type="text/html">
    {{each data.list data index}}
        <a href="./detail.php?id={{data.id}}" class="mod">
            <div class="pic">
                <img src="<?php echo $imgDir?>{{data.img_path}}" />
            </div>
            <div class="tit">
                <p>
                    <span class="">{{data.name}}</span>
                    <span class="pl10">
                        <img src="/Theme/Simple/images/star.png" />&nbsp;&nbsp;
                        <img src="/Theme/Simple/images/star.png" />&nbsp;&nbsp;
                        <img src="/Theme/Simple/images/star.png" />&nbsp;&nbsp;
                        <img src="/Theme/Simple/images/star.png" />&nbsp;&nbsp;
                        <img src="/Theme/Simple/images/star.png" />
                    </span>
                </p>
                <p class="mt10">{{data.area}}</p>
            </div>
        </a>
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
