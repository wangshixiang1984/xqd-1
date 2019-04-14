<?php
    // $place = isset($_GET['city']) ? $lg->ckinput($_GET['city']) : '';
    // $sql = 'select distinct(gocity) from xcap where gocity !=""';
    // $menuList = $lg->select_arr2($sql);
    // print_r($menuList);
    // $title = '选择目的地';    
?>
<div class="sp-wp">
    <div class="m-lay mt10 bg-w scroll1">
        <div class="con mt10 clr-all" id="listContainer">
       
        </div>
    </div>
</div>
<script id="list" type="text/html">
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

</script>
<script type="text/javascript" charset="utf-8">
    $(function(){
        var cdata = new Cdata('listContainer', 'getlist.php');
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