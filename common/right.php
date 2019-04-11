<!----右边内容开始----->
<div class="common_right">
			<!--工作时间模块-->
			<div class="xcap_right_time">
				<div class="xcap_right_time_text">     
				<?php 
				$sql="select * from indextel";
				$kfarr=$lg->select_arr1($sql);
				?>           
                	<div class="xcap_right_time_qq"><div class="f_style fl">客服1: </div><div class="fl"><?php echo qq($kfarr["qq1"],"心启点自驾游");?></div>
               		<div class="f_style fl"> &nbsp;&nbsp;客服2:  </div><div class="fl"><?php echo qq($kfarr["qq2"],"心启点自驾游");?></div> <div class="cb"></div></div>
					<span class="f_style">工作时间：<?php echo $kfarr["worktime"];?></span><br />
					<span class="f_style">联系电话：<?php echo $kfarr["maintel"];?></span><br />
					<span class="f_style">节假日电话：<?php echo $kfarr["tel3"];?></span>
				</div>
			</div>
			<!--工作时间模块结束-->
            <!---热门活动排行--->
            <div class="rmhd_right mt10">
            	<div class="rmhd_right_t">热门活动排行</div>
            	<?php 
            	$sql="select * from xcap where istop=1 and hide!=1 order by px desc,id desc limit 4";
            	$rmtjarr_right=$lg->select_arr2($sql);
            	$rmtjarr_rightlen=count($rmtjarr_right);
            	for($i=0;$i<$rmtjarr_rightlen;$i++){
            	?>
            	<div class="rmhd_right_con">
                	<ul>
                    	<li class="ml20"><div class="fl"><a href="../xcap/xcap.php?id=<?php echo $rmtjarr_right[$i]["id"];?>">
                    	<img src="<?php echo $imgpath_now.$rmtjarr_right[$i]["img_path"];?>" /></a></div>
                    	<div class="rmhd_pm fl"><?php echo $i+1;?></div><div class="cb"></div></li>
                        <li class="pl25"><a href="../xcap/xcap.php?id=<?php echo $rmtjarr_right[$i]["id"];?>"><?php echo $lg->str_long($rmtjarr_right[$i]["title"],0,42);?></a></li>
                        <li class="pl25">出发日期：<?php echo $rmtjarr_right[$i]["gotime"];?></li>
                        <li class="pl25">报名费用：<span class="red_strong"><?php echo $rmtjarr_right[$i]["price"];?>元</span></li>
                    </ul>
            	</div>
            	<?php }?>
                
            </div>
            <!---热门活动排行--->        
</div>
<!----右边内容结束----->
<div class="cb"></div>