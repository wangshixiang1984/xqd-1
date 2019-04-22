<?php
include_once '../../common/header.php';
$sql_a = "select * from adver where type=8 order by id desc limit 0, 1";
$adv = $lg->select_arr1($sql_a);
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$sql = "select * from car where id=".$id;
$data = $lg->select_arr1($sql);
$tels = $lg->select_arr1('select * from gywm');

?>
<i class="kfu iconfont iconkefu"></i>
<div class="cinfo-wp">
    <div class="com-adv">
        <img src="<?php echo $imgDir.$adv['img_path'];?>" alt="<?php echo $adv['title'];?>" />
    </div>
    <div class="bg-w p10">
        <h1><?php echo $data['brand'] ;?></h1>
        <div class="m-lay bg-w p0">
            <div class="con mt10 clr-all">
                <div class="row mt10 yj">
                    <div class="m-mod">
                        <div class="m-item">
                            <img src="<?php echo $imgDir.$data['img_path'] ;?>" />
                        </div>
                    </div>
                    <div class="m-mod">
                        <p class="f14 f-bold fone-ellipsis">品牌：<?php echo $data['title'] ;?></p>
                        <p class="f12">配置： <?php echo $data['peizhi'] ;?></p>
                        <p class="f12">类型： <?php echo $data['typed'] ;?></p>
                        <p class="f12">可乘人数：<?php echo $data['peopleseat'] ;?></p>
                        <p class="f12">取车门店：<?php echo $data['getaddress'] ;?></p>
                        <p class="f12">还车门店：<?php echo $data['backaddress'] ;?></p>
                    </div>
                </div>
            </div>
        </div>
        <p class="tit">租车信息</p>
        <div class="cinfo">
            <?php echo $data['des'] ;?>
        </div>
        <p class="tit">订单费用</p>
        <div class="cfee">
            <p>租赁费用：<?php echo $data['price'] ;?>元/天</p>
            <p class="hj">合计：￥<?php echo $data['price'] ;?></p>
        </div>
        <div class="t-c"><button class="btn btn-solid mt20 mb10">租赁电话：<?php echo $tels['tstel'] ?> / <?php echo $tels['xstel'] ?></button></div>
    </div>
</div>

<script>
    // 租车客服
    $('.kfu').click(function() {
        window.location.href = "tel:<?php echo $tels['zxtel'] ?>";
    })
</script>
<?php
include_once '../../common/footer.php';
?>

