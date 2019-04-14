
<script src="/h5/public/js/mui.js"></script>
<?php 
      $sql_a = "select * from adver where type=6 order by id desc limit 0, 1";
      $adv = $lg->select_arr1($sql_a);
        
?>
<style>
.mui-toast-container{
    top: 30%;
}
</style>
<div class="bg-w">
    <div class="com-adv">
        <img src="<?php echo $imgDir.$adv['img_path'];?>" alt="<?php echo $adv['title'];?>" />
    </div>
    <form action="javascript:void(0)" id="diyform" method="post">
        <div class="form-wp">
            <div class="f-bold">定制流程</div>
            <div class="mt5 mb20 brd-btm pb10">填写询单 > 定制行程 > 确认行程及费用 > 签合同付款 > 开始自驾之旅</div>
            <div>
                <span>出发城市：</span>
                <span><input type="text" class="form-control go-city" name="go-city" placeholder="请填写出发城市"></span></div>
            <div><span>出行日期：</span>
            <span><input type="text" class="form-control sel-date" name="sel-date" placeholder="请选择日期"></span></div>
            <div><span>出行人数：</span>
            <span><input type="text" class="form-control sel-pep" name="sel-pep" placeholder="请选择人数"></span></div>
            <div>
                <span>出行天数：</span><span><input type="text" name="sel-day" class="form-control mb5 sel-day" placeholder="请选择天数"></span>
            </div>
            <div>
                <p>
                    <div class="mui-input-row mui-radio">
                        <input name="radio1" type="radio" checked value="可根据行程安排增减1-2天">
                        <label class="t-r ptb5">可根据行程安排增减1-2天</label>
                    </div>
                </p>
                <p>
                    <div class="mui-input-row mui-radio">
                        <input name="radio1" type="radio" value="天数固定，不能更改">
                        <label class="t-r ptb5">天数固定，不能更改</label>
                    </div>
                </p>
            </div>
            <div class="mt10"><span>目的地：</span>
            <span><input type="text" class="form-control" name="desti" placeholder="请输入目的地"></span></div>
            <div><span>出行预算：</span>
            <span><input type="text" name="price" class="form-control"></span></div>
            <div><span>定制要求：</span>
            <span><textarea class="f14 need" placholder="请在这里补充你的需求或要求"></textarea></span></div>
            <div><span>联系人：</span>
            <span><input type="text" class="form-control" name="lxr" placeholder="请输入联系人"></span></div>
            <div><span>联系电话：</span>
            <span><input type="text" class="form-control" name="tel" placeholder="请输入手机号"></span></div>
            <div><span>回复时间：</span>
            <span><input type="text" class="form-control sel-reply" name="reptime" placeholder="请选择回复时间" value="随时"></span></div>
            <div><span>验证码：</span>
            <span><input type="text" class="form-control w-100 mr10" name="randcode"><img src="/conf/randcode.php?id=<?php echo rand(0,1000);?>"  id="randpic" onclick="javascript:refreshcode(this.id)" style="width: 1rem; height:auto;" /></span></div>
            <div class="t-c"><button class="btn btn-solid w50 mtb20 ptb10 subBtn">提交</button></div>
        </div>
    </form>
</div>
<script src="/h5/public/js/mui.js"></script>
<script src="/h5/public/js/mui.picker.min.js"></script>
<script>
    mui.init();
    mui.ready(function() {
        // 选择出行日期
        var bgDate = new Date().toLocaleString().split(' ')[0];
        bgDates = bgDate.split('/');
        // console.log(bgDates)
        var dtPicker = new mui.DtPicker({
            type:'date',
            beginDate: new Date(bgDates[0],bgDates[1] - 1, bgDates[2]),
            endDate: new Date('2050','11')
        }); 
        var date = document.querySelector('.sel-date');
        date.addEventListener('tap', function(e) {
            dtPicker.show(function(items) {
                date.setAttribute('value', items.value)
            })
        }, false);

        // 选择出行人数
        var data = [];
        for(i = 1; i < 100; i++) {
            data.push({value: i, text: i+ '人'});
        }
        var pepPicker = new mui.PopPicker();
        pepPicker.setData(data);
        var pep = document.querySelector('.sel-pep');
        pep.addEventListener('tap', function(e) {
            pepPicker.show(function(items) {
                pep.setAttribute('value', items[0].text)
            })
        }, false);
        // 选择出行天数
        var data = [];
        for(i = 1; i < 30; i++) {
            data.push({value: i, text: i+ '天'});
        }
        var dayPicker = new mui.PopPicker();
        dayPicker.setData(data);
        var day = document.querySelector('.sel-day');
        day.addEventListener('tap', function(e) {
            dayPicker.show(function(items) {
                day.setAttribute('value', items[0].text)
            })
        }, false);
        // 选择回复时间
        var data = [
            {value: '随时', text: '随时'},
            {value: '工作时间', text: '工作时间'},
            {value: '非工作时间', text: '非工作时间'}
        ];
        var repPicker = new mui.PopPicker();
        repPicker.setData(data);
        var reply = document.querySelector('.sel-reply');
        reply.addEventListener('tap', function(e) {
            repPicker.show(function(items) {
                reply.setAttribute('value', items[0].text)
            })
        }, false);
        
    })
    $(function(){
       
        //表单验证
        function isNull(val, text) {
            if(val.length <= 0)
            {
                mui.toast(text+'不能为空', {duration: 'short',type:'div'});
                return false;
            } 
            return true;
        }
        function isTel(val) {
            var reg = /^1[2345789]\d{9}$/;
            if(val.length <= 0)
            {
                mui.toast('手机号不能为空', {duration: 'short',type:'div'});
                return false;
            } 
            if(!reg.test(val)) {
                mui.toast('手机号输入有误', {duration: 'short',type:'div'});
                return false;
            }
            return true;
        }
        function trim(val) {
            return $.trim(val);
        }
        $('.subBtn').click(function(e){
            var city = trim($('.go-city').val());
            var date = trim($('.sel-date').val());
            var day = trim($('.sel-day').val());
            var pep = trim($('.sel-pep').val());
            var xcmod = trim($('input[name=radio1]').val());
            var desti = trim($('input[name=desti]').val());
            var tel = trim($('input[name=tel]').val());
            var lxr = trim($('input[name=lxr]').val());
            var xcmod = trim($('input[name=price]').val());
            var need = trim($('.need').val());
            var reptime = trim($('input[name=reptime]').val());
            var randcode = trim($('input[name=randcode]').val());
            if(!isNull(city, '出发城市不能为空')) return;
            if(!isNull(date, '请选择出发日期')) return;
            if(!isNull(day, '请选择行程天数')) return;
            if(!isNull(pep, '请选择出行人数')) return;
            if(!isNull(desti, '目的地不能为空')) return;
            if(!isNull(tel, '请填写联系电话')) return;
            if(!isTel(tel)) return;
            if(!isNull(lxr, '请填写联系人')) return;
            if(!isNull(tel, '请填写联系电话')) return;
            var formdata = $('#diyform').serialize();
            formdata += '&need=' + encodeURIComponent(need);
            // console.log(formdata)
            // return;
            var _this = $(this);
            $(this).attr('disabled', true);
            $.ajax({
                type:"post",
                data:formdata,
                url: "./add_xldz.php",
                dataType:"json",
                success:function(data){
                    if(data.code !== 0) {
                        mui.toast(data.msg);
                        setTimeout(function(){
                            _this.attr('disabled', false);
                        }, 2500)
                        return;
                    } else {
                        mui.toast(data.msg);
                        setTimeout(function(){
                            window.location.reload();
                        }, 2500)
                    }
                }
            })
        })
        

    })

</script>
<script>
function refreshcode(id){
		 document.getElementById(id).src="/conf/randcode.php?id="+Math.random(1) * 100000;
		return;
	}
</script>
