<?php
$keyword = isset($_GET['keyword']) ? $lg->ckinput($_GET['keyword']) : '';
?>
<div class="sp-wp"  id="container">
   
</div>

<script id="list" type="text/html">
<div class="selmenu p10">
        <div class="tit sel mtb10">为您找到<b class="red">{{data.total}}</b>条记录</div>
    </div>
    <div class="m-lay mt10 bg-w scroll1">
        <div class="con mt10 clr-all">
            {{each data.list data index}}
            <a href="<?php echo $rootLink.'detail/index.php?id='; ?>{{data.id}}" class="row mt10 yj brd-btm">
                <div class="m-mod">
                    <div class="m-item">
                        <img src="<?php echo $imgDir?>{{data.img_path}}" />
                    </div>
                </div>
                <div class="m-mod f12">
                    <p class="f14 f-bold fone-ellipsis">{{@data.title}}</p>
                    <p>行程天数：{{data.goday}}天</p>
                    <p>出发地：{{data.startplace}}</p>
                    <p>行程日期：:{{if data.passed == 1}}已封团{{else}}{{data.godate}}{{/if}}</p>
                    <p>费用：{{if data.gotheme == "AA制自驾"}}AA{{else}}{{if data.passed == 1}}0{{else}}<span class="price f16">{{data.minprice}}</span>{{/if}} 元 / 起{{/if}}<span class="price f16">7900.00</span>元/起</p>
                </div>
            </a>
            {{/each}}

        </div>
    </div>
   
</script>
<script type="text/javascript" charset="utf-8">
    $(function(){
        var cdata = new Cdata('container', './getSearch.php?keyword=<?php echo $keyword ?>');
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
