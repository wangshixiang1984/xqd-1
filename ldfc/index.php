<?php 
$urlType = 5;
include "../head/head_add.php";
include "../head/head.php" ?>
<link  type="text/css" href="../detail/css/wqx.css" rel="stylesheet"/>
<link  type="text/css" href="../detail/css/page.css" rel="stylesheet"/>
<link  type="text/css" href="../detail/css/global.css" rel="stylesheet"/>
<div style="bordor:solid 1px #000;">
        <div class="sub_banner">
        	<a href="#" style="background-image: url(/Theme/Simple/images/ldbg.jpg); background-size: cover; background-position: center top; height: 511px;"><!--<img src="/data/upload/20170427/5901527c1596f.jpg"/>--></a>
        </div>
       
		<div class="pred_display">
			<div class="daren_show" style="width:100%">
                <?php 
                    $sql = "select * from  ld";
                    $list = $lg->select_arr2($sql);
                    for($i = 0; $i < count($list); $i++){
                ?>
                <div class="person_show">
                    <a href="detail.php?id=<?php echo $list[$i]['id'];?>">
                        <div class="img">
                            <img src="<?php echo IMG_DIR.$list[$i]['img_path']; ?>">
                        </div>
                        <div class="person_about">
                            <div class="up">
                                <span><?php echo $list[$i]['name']; ?></span>
                                <em class="set_stars">
                                <img class="star" src="../Theme/Simple/images/star.png" width="25" style="display:inline-block;margin-right:5px">
                                <img class="star" src="../Theme/Simple/images/star.png" width="25" style="display:inline-block;margin-right:5px">
                                <img class="star" src="../Theme/Simple/images/star.png" width="25" style="display:inline-block;margin-right:5px">
                                <img class="star" src="../Theme/Simple/images/star.png" width="25" style="display:inline-block;margin-right:5px">
                                <img class="star" src="../Theme/Simple/images/star.png" width="25" style="display:inline-block;margin-right:5px"></em>
                                <div class="good"><span></span><i>主带线路:<?php echo $list[$i]['area']; ?></i></div>
                            </div>
                            <div class="down_txt">
                                <p><?php echo $list[$i]['des']; ?></p>                            
                            </div>
                        </div>
                    </a>
                </div> 
                <?php }?>                  
			</div>

		</div>
</div>
<?php include('../head/foot.php'); ?>

 