<?php 
$urlType = 3;
include "../head/head_add.php";
include '../head/head.php'; ?>

<div class="container">
	<div class="hotel-banner" style="background: url(../Theme/Simple/images/diy-banner.jpg) no-repeat center top;"></div>
	<div class="pagemc" style="margin-top:-150px;">
		<form method="post" id="diyform">
    	<div class="diy-page">
   	    <img src="../Theme/Simple/images/diy-step.png" width="1200" height="124" alt=""/>
        <div class="route-book-row clearfix">
            <ul class="list">
				<li><strong class="title">出发城市：</strong><span class="text"><input id="departure" type="text" class="text" name="departure" value="成都" /></span></li>
				<li><strong class="title">出行日期：</strong><span class="text">
					<select id="yeard" name="yeard">
						<?Php 
						$startYear = 2017;
							for($i=0; $i < 50; $i++){
								$startYear++;
						?>
						<option value="<?php echo $startYear;?>"><?php echo $startYear;?>年</option>
						<?php }?>
					</select> 
					<select id="monthd" name="monthd" style="width:150px;">
					<option value="不确定">不确定</option>
											<option value="1月">1 月</option>
												<option value="2月">2 月</option>
												<option value="3月">3 月</option>
												<option value="4月">4 月</option>
												<option value="5月">5 月</option>
												<option value="6月">6 月</option>
												<option value="7月">7 月</option>
												<option value="8月">8 月</option>
												<option value="9月">9 月</option>
												<option value="10月">10 月</option>
												<option value="11月">11 月</option>
												<option value="12月">12 月</option>
											</select>
					<select id="dayd" name="dayd">
						<option value="不确定">不确定</option>
												<option value="1日">1 日</option>
												<option value="2日">2 日</option>
												<option value="3日">3 日</option>
												<option value="4日">4 日</option>
												<option value="5日">5 日</option>
												<option value="6日">6 日</option>
												<option value="7日">7 日</option>
												<option value="8日">8 日</option>
												<option value="9日">9 日</option>
												<option value="10日">10 日</option>
												<option value="11日">11 日</option>
												<option value="12日">12 日</option	>
												<option value="13日">13 日</option>
												<option value="14日">14 日</option>
												<option value="15日">15 日</option>
												<option value="16日">16 日</option>
												<option value="17日">17 日</option>
												<option value="18日">18 日</option>
												<option value="19日">19 日</option>
												<option value="20日">20 日</option>
												<option value="21日">21 日</option>
												<option value="22日">22 日</option>
												<option value="23日">23 日</option>
												<option value="24日">24 日</option>
												<option value="25日">25 日</option>
												<option value="26日">26 日</option>
												<option value="27日">27 日</option>
												<option value="28日">28 日</option>
												<option value="29日">29 日</option>
												<option value="30日">30 日</option>
												<option value="31日">31 日</option>
											</select>
					<i class="fa fa-info-circle pr5 pl15 cf90"></i>注：若不确定日期，可选择日期/月份不确定。</span>
				</li>
				<li><strong class="title">出行人数：</strong>
				<span class="text"><a class="minus"><i class="fa fa-minus"></i></a><input id="person" style="width:100px" name="person" type="text" class="numtext" value="0" readonly><a class="plus"><i class="fa fa-plus"></i></a> 人左右
				</span></li>
				
				<li><strong class="title">出行天数：</strong>
				<span class="text"><a class="minus"><i class="fa fa-minus"></i></a><input id="days" style="width:100px" name="days" type="text" class="numtext" value="0" readonly><a class="plus"><i class="fa fa-plus"></i></a> 天左右
				<p>
					
					<input name="daysconfirm" type="radio" id="enable" value="可根据行程安排增减1-2天"> <label for="enable">可根据行程安排增减1-2天</label>&nbsp;&nbsp;&nbsp;&nbsp;
					<input name="daysconfirm" type="radio" id="disable" value="天数确定，不能更改" checked> <label for="disable">天数确定，不能更改</label>
				</p>
				</span></li>
				
				<li><strong class="title">目的地：</strong><span class="text"><input type="text" id="dest" name="dest" class="text" placeholder="请输入您想去的目的地" /></span></li>
				<li><strong class="title">出行预算：</strong><span class="text"><input class="text" name="budget" id="budget" type="number"  style="width:100px;"> 元/人</span></li>
				<li><strong class="title">定制要求：</strong><span class="text"><textarea id="content" placeholder="您可以在这里补充您的要求和需求" name="content"></textarea></span></li>
				<li class="line"></li>
              
				<li><strong class="title">联系人：</strong><span class="text"><input id="name" name="name" class="text" type="text" style="width:250px;"></span><input type="radio" name="sex" value="先生" checked/>&nbsp;&nbsp;先生&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="sex" value="女士"/>&nbsp;&nbsp;女士</li>
				<li><strong class="title">联系电话：</strong><span class="text"><input type="text" id="mobile" name="mobile" class="text" placeholder="请输入您的手机号码，以便客服回访" /></li>
				<!-- <li><strong class="title">常用邮箱：</strong><span class="text"><input id="email" name="email" class="text" type="text" style="width:250px;"></li> -->
				<li><strong class="title">回复时间：</strong><span class="text"><input type="radio" name="replytime" value="随时" checked/>随时&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" value="工作时间" name="replytime"/>工作时间&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="replytime" value="非工作时间" />非工作时间</span></li>
				<li><strong class="title">验证码：</strong><span class="text"><input id="code" type="text" class="text" name="code" placeholder="验证码" style="width:100px"/><img src="../../conf/randcode.php?id=<?php echo rand(0,1000);?>" width="80" height="30" style="cursor:pointer;" id="randpic" onclick="javascript:refreshcode(this.id)"></span></li>
				<li><strong class="title"></strong><span class="text"><a id="bookBtn" class="subBtn">提交</a></span></li>
			</ul>
		</div>
		</div><!--diy-page-->
		</form>
	</div>
</div>
<!--container-->
<script>
	// $('#bookBtn').click(function () {
	// 	var params = $('#diyform').serialize();
	// 	$.post('add_xldz.php', params, function(res){
	// 		if(res.code == 0){
	// 			layer.open({
	// 				content:'定制成功，保持联系方式畅通，工作人员稍后将与您联系！',
	// 				btn:['确定'],
	// 				yes:function () {
	// 					loation.reload();
	// 				}
	// 			});
	// 		}
	// 	});
	// });
</script>
<?php include('../head/foot.php');?>
<script src="../js/log.js"></script>
<script src="/Front/js/dzy.js"></script>

</body>
</html>

