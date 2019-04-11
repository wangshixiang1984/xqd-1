<?php 
$urlType = 11;
include "../head/head_add.php";
include "../head/head.php";
?>

<style>
.routeSelect ul li a.current{ background: #66B0DF; }
.fr-view strong { font-weight: normal; }
</style>
<script src='../js/template-web.js'></script>
<div class="do-section fp-auto-height do-banner">
	<div class="do-area" id="banner_23510_0" style="background-image: url('/Theme/Simple/images/bg1.jpg');background-attachment:fixed">
	<div class="do-area-bg ">
		<div class="do-area-bg-conter"><div class="bgcolor"></div></div>
	</div>
	<div id="banner_0" class="do-row do-row-one">
	<div class="do-row ">
	<div class="do-col-12">
	<div class="do-panelcol">
	<div class="do-block do-space do-3b97x">
		<div class="do-element-space" style="padding-top:7.142857142857142%;"></div>
	</div>
	<div class="do-block do-space do-3b97w">
		<div class="do-element-space pc" style="padding-top:5%;"></div>
		<div class="do-element-space phone" style="padding-top:5%;"></div>
	</div>
	<div class="do-block do-text do-3b97v">
		<div class="do-element-text">
			<div class="do-element-text-content do-html">
				<div class="do-html-content">
					<p style="text-align: left; line-height: 1;"><span style="color: rgb(255, 255, 255); font-size: 26px;">精美路线</span></p>
					<p style="text-align: left; line-height: 1;"><span style="color: rgb(255, 255, 255);">Beauty Line</span></p>
				</div>
			</div>
		</div>
	</div>
	<div class="do-block do-space do-3b97u">
		<div class="do-element-space pc" style="padding-top:5%;"></div>
		<div class="do-element-space phone" style="padding-top:7.142857142857142%;"></div>
	</div>
	</div>
</div></div></div></div></div>

<div class="container">
	<div class="pagemc">
        <div class="routeSelect" style="width:100%;">
        <ul>
<?php
//显示子类
	//按主题
	$sql = "select distinct(gotheme) from xcap where gotheme !='' ";
	$themes = $lg->select_arr2($sql);
	//按地区
	$sql = 'select distinct(gocity) from xcap where gocity !=""';
	$areas = $lg->select_arr2($sql);

	//按行程
	$xcs = ['二日游', '三日游', '五日游', '七日游', '多日游'];
	//按月份
	$m = date('n');
	$month = array_merge(range($m, 12), range(1, $m -1));
	$months = array_map(function($val){
		return $val.'月';
	}, $month);

?>			
			<li>
			<strong>主题：</strong>
				<a href="#" onclick="getInfo(this,2)" class="current">全部</a>
				<?php for($i=0;$i<count($themes); $i++){?>
				<a href="#theme" onclick="getInfo(this,2, '<?php echo $themes[$i]['gotheme'];?>')" ><?php echo $themes[$i]['gotheme'];?></a>
				<?php }?>
			</li>
			<li><strong>地区：</strong>
				<a href="#" onclick="getInfo(this,3)" class="current">全部</a>
				<?php for($i=0;$i<count($areas); $i++){?>
				<a href="#area" onclick="getInfo(this,3, '<?php echo $areas[$i]['gocity'];?>')"><?php echo $areas[$i]['gocity'];?></a>
				<?php }?>
			</li>
			<li><strong>行程：</strong>
				<a href="#" onclick="getInfo(this,4)" class="current">全部</a>
				<?php for($i=0;$i<count($xcs); $i++){?>
				<a href="#xcap" onclick="getInfo(this,4, '<?php echo $xcs[$i];?>')"><?php echo $xcs[$i];?></a>
				<?php }?>
			</li>
			<li><strong>月份：</strong>
				<a href="#" onclick="getInfo(this,5)" class="current">全部</a>
				<?php for($i=0;$i<count($months); $i++){?>
					<a href="#" onclick="getInfo(this,5, '<?php echo $months[$i];?>')"><?php echo $months[$i];?></a>
				<?php }?>
			</li>
        </ul>
		<p class="result" id="resultcontainer"></p>
		<script id="result" type="text/html">
			<span>匹配结果 {{list.totalNum}} 条</span>
		</script>
       </div><!--routeSelect-->
   </div><!--pagemc-->
    
    	<div class="routelist">
			<div class="pagemc" >	
			<!--列表  -->
			<div id="listContainer"></div>
			<!-- 分页 -->
   
		</div><!--pagemc-->   
		<script id="list" type="text/html">
				{{each list.list data index}}
				<div class="one">
					<a class="toDetail" href="./detail.php?id={{data.id}}{{if data.gotheme == 'AA制自驾'}}&type=11{{else if data.gotheme == '拼车自驾'}}&type=10{{/if}}" target="_blank">
					<img class="pdt lazy noC3" src="<?php echo IMG_DIR?>{{data.img_path}}" data-original="<?php echo IMG_DIR?>{{data.img_path}}" width="320" height="180" alt="" /> 
					<h2>{{#data.title}}</h2>
					<!-- <dl class="clearfix"></dl> -->
					<strong style="display:block;height:130px;line-height:40px;">
					行程天数：{{data.goday}}天<br>
					出发地：{{data.startplace}}<br>
					行程日期:{{if data.passed == 1}}已封团{{else}}{{data.godate}}{{/if}}</strong>
					<em class="price">费用：<b>{{if data.gotheme == "AA制自驾"}}AA{{else}}{{if data.passed == 1}}0{{else}}{{data.minprice}}{{/if}}</b> 元 / 起{{/if}}</em></a>
				</div>
				{{/each}}
				<div class="pages textRight pt20">
				<a class="disabled" onclick="pagination('first')"> 第一页</a>
				<a class="disabled" onclick="pagination('prev')">&lt; 上一页</a>
				<% for(var i=list.paginationInfo.startPage; i <= list.paginationInfo.endPage; i++) { %>
				<a onclick="pagination({{i}})" {{if i == list.paginationInfo.currentPage}} class="current" {{/if}}>{{i}}</a>				
				<% } %>
				<a class="next" onclick="pagination('next')">下一页 &gt;</a>
				<a class="disabled" id="lastPage" data-total={{list.pages}} onclick="pagination('last')">尾 	页</a>
			</div>
		</script>
    </div><!--routelist-->    
</div>

<script type="text/javascript" charset="utf-8">
//获取分类
var filter = {};
var page;
function getInfo(obj, id, keyword){
	if(typeof obj !== 'undefined'){	
		var self = $(obj);
		self.addClass('current').siblings().removeClass('current');
		if(typeof keyword !== 'undefined'){
			filter[id] = keyword;	
		}else{
			filter[id] = '';
		}
	}
	
	var param = {filter : filter};
	if(typeof page !== 'undefined'){
		param['page'] = page;
	}
	$.get('getlist.php', param, function(res){
		render('list', 'listContainer', res);
		render('result', 'resultcontainer', res);
	}, 'json');
}
//分页
function pagination(type){
	var totalNum = $('#lastPage').data('total');
	if(typeof page === 'undefined'){
		page = 1;
	}
	if(type == 'first'){
		page = 1;		
	}
	if(type == 'last'){
		page = totalNum;
	}
	if(type == 'next'){
		if(page >= totalNum){
			page = totalNum;
			return;
		}
		page ++;
	}
	if(type == 'prev'){
		if(page <=1){
			page = 1;
			return;
		}
		page --;
	}
	if(typeof type == 'number'){
		page = type;
	}	
	getInfo();
}
//获取所有
function getListAll(){
	$.get('getlist.php', {filter:''}, function(res){
		render('list', 'listContainer', res);
		render('result', 'resultcontainer', res);
	}, 'json');
}
$(function(){
	getListAll();
});



function render(id, container, data){
	var html = template(id, {list:data});
	$('#'+container).html(html);
}
</script>
</div>

<?php include('../head/foot.php'); ?>