<?php
    $curM = isset($_GET['mon']) ? intval($_GET['mon']) : '';
    $m = date('n');
    $month = array_merge( range(1, $m -1), range($m, 12));
//    print_r($month);
    $months = array_map(function($val){
        return $val.'月';
    }, $month);

    $title = '选择出行月份';
    $curMon = $curM ? $curM.'月' : $m.'月';
?>
<div class="sp-wp">
    <div class="selmenu p10">
        <div class="tit sel mtb10"><?php echo $title; ?></div>
        <ul class="item" id="dstion">
            <?php for($i=0; $i < count($months); $i++ ){ 
                ?>
            <li data-month="<?php echo $months[$i]; ?>" class="<?php echo $curMon == $months[$i] ? 'act' : '';?>" >
                <a href="javascript:void(0)"><?php echo $months[$i]; ?></a>
            </li>
            <?php } ?>
        </ul>
    </div>
    <div class="m-lay mt10 bg-w">
        <div class="con mt10 clr-all" id="container">
           
        </div>
    </div>
    <script id="list"  type="text/html">
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
</div>
<script type="text/javascript" charset="utf-8">
    $(function(){
        var cdata = new Cdata('container', '/xcap/getlist.php');
        var curMon = new Date().getMonth()+1;
        var search = window.location.search;
        var curMs = search.substring(1, search.length).split('=');
        var curM;
        if(curMs[0] === 'mon') {
            curM = curMs[1];
        }
        curMon = curM || curMon;
        console.log(curMon)
        cdata.getInfo($('.act'), 5, curMon+'月');
        $('#dstion li').click(function(){
            var mon = $(this).data('month');
            cdata.init().getInfo($(this), 5, mon);
            
        })
      
        $(window).scroll(function(e){
            var doH = $(document).height(),
                scrH = $(document).scrollTop(),
                wH = $(window).height(),
                btmH = 50;
                if(doH - scrH -btmH - wH <= -50) {
                    cdata.getInfo($('.act'), 5, cdata.filter[5]);
                }
        })
    });
</script>