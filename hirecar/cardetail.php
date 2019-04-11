<?php 
$urlType = 6;
include "../head/head_add.php";

$id = intval($_GET['id']);
$sql = "select * from car where id='$id'";
$info = $lg->select_arr1($sql);
include "../head/head.php";
?>

<script src="/Front/js/json2.js"></script>
<script src="/Front/js/jedate.js"></script>
<link rel="stylesheet" type="text/css" href="/Front/css/colorbox.css">
<link rel="stylesheet" type="text/css" href="/Front/css/jedate.css">
<script type="text/javascript" src="/Front/js/jquery.colorbox.js"></script>

<style>
body { background:white;}
input, textarea { border:1px #ccc solid; }
</style>
<div class="container carDetail" >
	<div class="car-banner car-banner1"></div>
	<div class="pagemc">
		<div class="carDesc">
			
			<div class="carInfo">
				<h1><?php echo $info['title']; ?></h1><h2>配置：<?php echo $info['peizhi']; ?></h2>
				<div class="hr" style="height:70px;"></div>
				<div class="caradr">
				<img src="<?php echo IMG_DIR.$info['img_path']; ?>" width="240" />
				<span>
					汽车品牌：<b><?php echo $info['brand']; ?></b>
					<br />
					汽车类型：<b><?php echo $info['typed']; ?></b> 
					<br />
					取车门店：<b><?php echo $info['getaddress']; ?></b>
					<br />
					还车门店：<b><?php echo $info['backaddress']; ?></b>
				</span>
				<div style="clear:both"></div>
				</div>
			</div>

			<div class="orderInfo" style="margin-bottom:20px;">
				<div class="title"> 租车人信息</div>
				<!-- <div class="drivers">
					<table width="60%">
						<tr><td align="right">姓名：</td><td><input id="contact" maxlength="10" autocomplete="off" /></td><td align="right">手机号：</td><td><input id="mobile" maxlength="11" autocomplete="off" /></td></tr>
						<tr><td></td><td></td><td></td><td>&nbsp;</td></tr>
						<tr>
							<td align="right">证件类型：</td>
							<td><select id="certype" style="width:157px;"><option value="1">身份证</option><option value="2">驾驶证</option></select></td>
							<td align="right">证件号：</td>
							<td><input id="cercode" maxlength="18" autocomplete="off" /></td>
						</tr>
					</table>
				</div> -->
				<div  style="height:20px;"></div>
				<div class="note">
					<p>预订说明：</p>
					<p>
					<?php echo $info['content'];?>
					</p>
				</div>
							</div>

		</div>

		<div class="priceInfo">
			<div class="priceitem">
				<div class="title">订单费用</div>
				<div class="feeitem"><span>租赁费用：</span><b id="fullfee">￥<?php echo $info['price']; ?>/天</b></div>
				<!-- <div class="feeitem"><span>手续费用：</span><b>￥0</b></div>
				<div class="feeitem"><span>保险费用：</span><b>￥0</b></div>
				<div class="feeitem"><span>活动优惠：</span><b id="disfee">￥0</b></div> -->
				<div class="totalfee"><span>订单合计金额：</span><money id="totalcost">￥<?php echo $info['price']; ?></money></div>
			</div>
			<!-- <div class="noteinfo"><input type="checkbox" id="noteinfo" checked value="1" /> 我已阅读并同意<a class="iframe" href="/car/protocol" style="text-decoration:underline">租车须知</a></div> -->
			<a class="book">租赁电话：133-5084-1118</a>
		</div>
		
	</div>
</div>
<?php include('../head/foot.php'); ?>

