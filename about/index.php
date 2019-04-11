<?php 
$urlType = 9;
include "../head/head_add.php";
$sql = "select * from gywm";
$info = $lg->select_arr1($sql);
include "../head/head.php";
?>

<div class="do-section fp-auto-height do-banner" data-fullname="BANNER">
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
					<p style="text-align: left; line-height: 1;"><span style="color: rgb(255, 255, 255); font-size: 26px;">关于我们</span></p>
					<p style="text-align: left; line-height: 1;"><span style="color: rgb(255, 255, 255);">About us</span></p>
				</div>
			</div>
		</div>
	</div>
	<div class="do-block do-space do-3b97u">
		<div class="do-element-space pc" style="padding-top:5%;"></div>
		<div class="do-element-space phone" style="padding-top:7.142857142857142%;"></div>
	</div>
	</div></div></div></div></div></div>
	<div class="do-body">
		<div class="do-section do-area" id="area_23510_0" data-fullname="">
			<div class="do-area-bg "><div class="do-area-bg-conter"><div class="bgcolor"></div></div></div>
			<div id="area_0" class="do-row do-row-one ">
			<div class="do-row ">
			<div class="do-col-12">
			<div class="do-panelcol">
			<div class="do-block do-space do-3b98j">
				<div class="do-element-space pc" style="padding-top:10%;"></div>
				<div class="do-element-space phone" style="padding-top:7.8%;"></div>
			</div>
			<div class="do-block do-rows">
				<div class="do-row">
				<div class="do-col-12">
				<div class="do-panelcol">
				<div class="do-block do-text do-3b98i">
				<div class="do-element-text">
				<div class="do-element-text-content do-html">
				<div class="do-html-content">
					<div style="width:100%; text-align:center;">
					<div class="do-html-content">
						<p style="text-align: left; line-height: 1;"><span style="color: rgb(0, 0, 0); font-size: 26px;">为什么选择我们？</span></p>
						<p><span style="color: rgb(0, 0, 0);">WHY CHOOSE US?</span></p>
					</div>
					<object id="video" width="480" height="250" border="0" classid="clsid:CFCDAA03-8BE4-11cf-B84B-0020AFBBCCFA">
						<param name="ShowDisplay" value="0">
						<param name="ShowControls" value="1">
						<param name="AutoStart" value="1">
						<param name="AutoRewind" value="0">
						<param name="PlayCount" value="0">
						<param name="Appearance" value="0">
						<param name="BorderStyle" value="0">
						<param name="MovieWindowHeight" value="240">
						<param name="MovieWindowWidth" value="320">
						<param name="心启点自驾俱乐部2015年照片合集！" value="企业宣传视频">
						<embed width="480" height="250" border="0" showdisplay="0" allowfullscreen="true" showcontrols="1" playcount="0" moviewindowheight="240" moviewindowwidth="320" filename="心启点自驾俱乐部2015年照片合集！" src="http://player.youku.com/player.php/sid/XMTQzMTAxODg4NA==/v.swf">
                    </object>
					</div>
						<?php echo html_entity_decode($info['content']); ?>
				</div></div></div></div></div></div></div>
				<div class="do-block do-space do-3b98d">
					<div class="do-element-space pc" style="padding-top:12%;"></div>
					<div class="do-element-space phone" style="padding-top:8.200000000000001%;"></div>
				</div>
			</div>
		</div>
	</div>
</div></div></div>
<script>
$("body").addClass("bgwhite");
</script>
<?php include('../head/foot.php');?>