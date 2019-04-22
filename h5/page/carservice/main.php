<?php
    $title = '选择目的地';
?>
<div class="sp-wp1">
    <div class="selmenu p10">
        <!-- <div class="tit sel mtb10"><?php echo $title; ?></div> -->
        <ul class="item" id="dstion">
            <li class="act"  data-type="short">
                <a href="javascript:void(0)"><?php echo '短租(7天内)' ?></a>
            </li>
            <li class="" data-type="week">
                <a href="javascript:void(0)"><?php echo '周租(7-14天含)' ?></a>
            </li>
            <li class="" data-type="month">
                <a href="javascript:void(0)"><?php echo '月租(27-40天)' ?></a>
            </li>
        </ul>
    </div>
    <div class="m-lay mt10 bg-w">
        <div class="con mt10 clr-all" id="container">
            
        </div>
    </div>
</div>

<script id="list" type="text/html">
    {{each data.list data index}}
        <div class="row mt10 yj brd-btm">
            <div class="m-mod">
                <div class="m-item">
                    <img src="<?php echo $imgDir?>{{data.img_path}}" />
                </div>
            </div>
            <div class="m-mod f12">
                <p class="f14 f-bold fone-ellipsis">{{data.brand}}</p>
                <p>配置： {{data.peizhi}}</p>
                <p>可乘人数：{{data.peopleseat}}人</p>
                <p>价格：RMB {{data.price}}起/天</p>
                <p class="mt5"><a href="./detail.php?id={{data.id}}"><button class="btn btn-solid">查看详情</button></a></p>
            </div>
        </div>
    {{/each}}
</script>


<script type="text/javascript" charset="utf-8">
    $(function(){
        var cdata = new Cdata('container', './getlist.php');
        cdata.getInfo($('.act'), 1, 'short');
        $('#dstion li').click(function(){
            var type = $(this).data('type');
            cdata.init().getInfo($(this), 1, type);
        })
      
        $(window).scroll(function(e){
            var doH = $(document).height(),
                scrH = $(document).scrollTop(),
                wH = $(window).height(),
                btmH = 50;
                if(doH - scrH -btmH - wH <= -50) {
                    cdata.getInfo($('.act'), 1, cdata.filter[1]);
                }
        })
    });
</script>