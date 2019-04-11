<?php
    $sql = 'select distinct(gocity) from xcap where gocity !=""';
    $menuList = $lg->select_arr2($sql);
    // print_r($menuList);
    $title = '选择目的地';
?>
<script src='/js/template-web.js'></script>
<div class="sp-wp">
    <div class="selmenu p10">
        <div class="tit sel mtb10"><?php echo $title; ?></div>
        <ul class="item">
            <li class="act" onclick="getInfo(this, 3)">
                <a href="javascript:void(0)"><?php echo '全部' ?></a>
            </li>
            <?php for($i=0; $i < count($menuList); $i++ ){ ?>
            <li onclick="getInfo(this, 3, '<?php echo $menuList[$i]['gocity'];?>')">
                <a href="javascript:void(0)"><?php echo $menuList[$i]['gocity']; ?></a>
            </li>
            <?php } ?>
        </ul>
    </div>
    <div class="m-lay mt10 bg-w scroll1">
        <div class="con mt10 clr-all" id="listContainer">
       
        </div>
    </div>
</div>
<script id="list" type="text/html">
    <!-- {{if list.totalNum}} -->
        {{each list.list data index}}
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
    <!-- {{else}}
        <div class="t-c">没有更多数据了！</div>
    {{/if}} -->
</script>
<script type="text/javascript" charset="utf-8">
   
    //获取分类
    var filter = {'3':''};
    var page;
    var infoObj = {
        data:null,
        isLoading: false,
        isEnd: false,
        refresh: true,
        curPage: 0
    };
    var loading = '<div class="loading" style="text-align:center;padding:10px;">加载中...</div>';
    var nomore = '<div class="t-c p10">没有更多数据了！</div>';
    // 获取信息
    function getInfo(obj, id, keyword){
        var self = $(obj);
        if(self.hasClass('act')) {
            infoObj.curPage++;
        } else {
            self.addClass('act').siblings().removeClass('act');
            infoObj.refresh = true;
            infoObj.curPage = 1;
            infoObj.isEnd = false;
        }
        if(infoObj.isLoading || infoObj.isEnd) return;
      
        if(typeof keyword !== 'undefined'){
            filter[id] = keyword;	
        }else{
            filter[id] = '';
        }
        
        var param = {filter : filter};
        param['page'] = infoObj.curPage;
        
        infoObj.isLoading = true;
        if(infoObj.refresh) {
            $('#listContainer').html(loading);
        } else {
            $('#listContainer').append(loading);
        }
        $.get('/xcap/getlist.php', param, function(res){
            setTimeout(() => {
                if(infoObj.refresh) {
                    infoObj.data = res;
                    infoObj.refresh = false;
                } else {
                    combine(infoObj.data.list, res.list)
                }
                infoObj.isLoading = false;
                $('.loading').remove();
                render('list', 'listContainer');
                if(res.list.length <= 0) {
                    infoObj.isEnd = true;
                    $('#listContainer').append(nomore);
                } 
            }, 1000);
           
        }, 'json');
    }
   
    //获取所有
    function getListAll(){
        $.get('/xcap/getlist.php', {filter:''}, function(res){
            if(infoObj.refresh) {
                infoObj.data = res;
                infoObj.list = res.list;
                infoObj.curPage = 1;
            } else {
                combine(infoObj.data.list, res.list)
            }
          
            infoObj.refresh = false;
            render('list', 'listContainer');
        }, 'json');
    }
    $(function(){
        getInfo($('.act'), 3);
        // getListAll();
        // 上拉加载
        // var isLoading = false;
        $(window).scroll(function(e){
            // return;
            var doH = $(document).height(),
                scrH = $(document).scrollTop(),
                wH = $(window).height(),
                btmH = 50;
                if(doH - scrH -btmH - wH <= -50) {
                    getInfo($('.act'), 3, filter[3]);
                }

        })
    });
    function combine(arr1,arr2) {
        for(i = 0; i < arr2.length; i++) {
            arr1.push(arr2[i]);
        }
        return arr1;
    }
    function render(id, container){
        // console.log(infoObj)
        var html = template(id, {list: infoObj.data});
        
        $('#'+container).html(html);
    }
    console.log(infoObj)
</script>