<?php
    $id = intval($_GET['id']);
    $sql = "select * from xcap where id='$id'";
    $info = $lg->select_arr1($sql);
    $priceInfo = $lg->select_arr2("select * from xcdate where xcapid='$id'");
    $xcdetail = $lg->select_arr2("select * from xcdes where xcapid='$id' order by whichday asc");
    $prices = [];    
    foreach($priceInfo as $k => $val){
        array_push($prices, $val['price']);
    }
    $minprice = 0;
    if(!empty($prices)){
        $minprice = min($prices);
    }
    // print_r($info);
?>
<div class="swiper-container" id="swiper3">
    <div class="swiper-wrapper">

        <div class="swiper-slide">
            <img src="<?php echo $imgDir.$info['img_path']; ?>" />
        </div>
    </div>
    <!-- 如果需要分页器 -->
    <div class="swiper-pagination"></div>
</div>
<div class="p10 bg-w xc-wp">
    <div class="dt-head brd-btm-das">
        <h1 class="mt10"><?php echo $info['title']; ?></h1>
        <!-- <ul class="tag">
            <li>自驾游</li>
            <li>0自费</li>
            <li>纯游玩</li>
            <li>准四星酒店</li>
        </ul> -->
        <p class="p10 ftwo-ellipsis des">
            <?php echo $info['des']; ?>
        </p>
        <div class="row-lr dt-btn mt10">
            <div class="col-l"><b class="f16 f-bold"> 
            <?php if($info['gotheme'] == "AA制自驾"){?>
                        费用  AA
            <?php }else {?>
            <?php if($info['passed'] == 1){
                        echo "已封团";
                    }else{ 
                        echo '￥'.$minprice.'<span class="f12">/人起</span>'; 
            }}?></b></div>
            <div class="col-r"><i></i>报名热线:028-83918255</div>
        </div>
        <div class="dt-mwrap lm">
            <div class="row-lr">
                <div class="col-l">
                    <div><i class="iconfont icondizhi"></i>出发城市：<?php echo $info['startplace']; ?></div>
                    <div><i class="iconfont iconqing"></i>行程里程：<?php echo $info['mile']; ?></div>
                </div>  
                <div class="col-r">
                    <div><i class="iconfont iconshengqian"></i>行程天数：<?php echo $info['goday']; ?>天</div>
                    <div id="date"><i class="iconfont iconriqi"></i>发团日期<i class="iconfont iconxiala ml5" id="dateArrow"></i></div>
                </div>  
            </div>
            
            <div class="lis" id="list">
            <?php for($i=0;$i<count($priceInfo);$i++){?>
                <p >
                <?php echo $priceInfo[$i]['godate']; ?> 
                <?php 
                if($info['gotheme'] == 'AA制自驾'){
                    echo '预估消费：'.intval($priceInfo[0]['price'])."/人"; }
                else{
                    echo '<span class="red">&yen;</span>'.$priceInfo[$i]['price'];?>/成人
                <?php } ?>
                <?php if($info['gotheme'] == 'AA制自驾'){
                    echo '预收活动费：'.intval($priceInfo[0]['boyprice'])."/人"; 
                }else{
                    echo '<span class="red">¥</span>'.$priceInfo[$i]['boyprice'];?>/儿童(余<?php echo '&yen;'.$priceInfo[$i]['leftpeople'];?>位)
                <?php }?>
               </p>
            <?php }?>
            </div>
        </div>
    </div>
    <div class="brd-btm-das ptb20">
        <p class="tit">行程亮点</p>
        <div class="f3-ellipsis h60 mt10" id="des">
        <?php echo html_entity_decode($info['content_desc']); ?>
        </div>
        <div class="btn btn-line purple mtb10">阅读更多<i class="iconfont iconxiala"></i></div>
    </div>
    <div class="ptb20 dt-xc">
        <p class="tit">行程安排</p>
        <?php 
            for($i=0;$i<count($xcdetail); $i++){
                if(!empty($xcdetail[$i]['daypic'])){
                    $pics = explode(',', $xcdetail[$i]['daypic']);
                }
        ?>
            <div class="mod mb10">
                <p class="day">第<?php echo $i+1; ?>天</p>
                <p class="js mtb10"><i class=" mr10"><img src="/h5/public/images/js.png" /></i>行程介绍：<?php echo $xcdetail[$i]['daytitle']; ?></p>
                <div class="mt10">
                    <p class="mb10"><?php echo $xcdetail[$i]['daydes']; ?></p>
                    <?php
                        for($j=0;$j<count($pics); $j++){
                    ?>
                    <div class="pic"><img src="<?php echo $imgDir.$pics[$j]; ?>" /></div>
                    <?php }?>
                </div>
                <p class="js mt10"><i class="mr10"><img src="/h5/public/images/yc.png" /></i>用餐：<?php echo $xcdetail[$i]['dinner']; ?></p>
                <p class="js"><i class="mr10"><img src="/h5/public/images/zs.png" /></i>住宿：<?php echo $xcdetail[$i]['hotel']; ?></p>
            </div>
        <?php } ?>
    </div>
    <div class="dt-fy">
        <p class="tit">费用说明</p>
        <div class="con mt10">
            <?php echo html_entity_decode($info['content_fee']); ?>
            <i></i>
        </div>
    </div>
    <div class="dt-fy mt20 sx brd-btm-das">
        <p class="tit">注意事项</p>
        <div class="con mt10">
            <?php echo html_entity_decode($info['content_needknow']); ?>
        </div>
    </div>
    <div class="m-lay">
        <p class="f16 mtb10">你可能也喜欢</p>
        <ul class="cate like">
            <?php
            $sql = 'select xcap.id, xcap.title, xcap.img_path, xcdate.price from xcap left join xcdate on xcap.id=xcdate.xcapid where hide != 1 group by xcdate.xcapid';
            $total = $lg->select_num($sql);
            $start = rand(0, $total - 10);
            $pageSize = 10;
            $list = $lg->select_arr2($sql.' limit '.$start.', '.$pageSize);
        
            for($i=0; $i<count($list); $i++) {
            ?>
            <li>
                <a href="/h5/page/detail/index.php?id=<?php echo $list[$i]['id']; ?>" class="m-item">
                    <img src="<?php echo $imgDir.$list[$i]['img_path']; ?>" />
                </a>
                <p class="mt5 fone-ellipsis"><?php echo $list[$i]['title']; ?></p>
                <p class="f12">￥<?php echo $list[$i]['price']; ?>/人起</p>
            </li>
            <?php }?>
        </ul>
    </div>
</div>


<script src="/h5/public/js/swiper.js"></script>
<script>
var mySwiper3 = new Swiper ('#swiper3', {
        loop: true, // 循环模式选项
        // 如果需要分页器
        pagination: {
        el: '.swiper-pagination',
        bulletActiveClass: 'index-bullet-active',
        },

    })  

$(function() {
    // 阅读更多 收起
    $('.purple').click(function(e){
        var des = $("#des");
        if(des.hasClass('f3-ellipsis')) {
            $(this).html('收起<i class="iconfont iconshouqi"></i>');
            $("#des").removeClass('f3-ellipsis h60');
        } else {
            $(this).html('阅读更多<i class="iconfont iconxiala"></i>');
            $("#des").addClass('f3-ellipsis h60');
        }
    })
    // 发团日期下拉
    $('#date').click(function(e){
        e.stopPropagation();
        $('#list').toggle();
    })

    $('body').click(function(e) {
        e.stopPropagation();
        if($(e.target).attr('id') != 'date') {
            $('#list').hide();
        }
    })
})      
</script>