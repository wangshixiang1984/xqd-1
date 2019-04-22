<?php
    include_once '../../common/header.php';
    $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
    if($id == 0){
        exit;
    }
    $sql = "update zjgl set clicktime = clicktime+1 where id = '$id'";
    $lg->imd($sql);
    $sql = "select * from zjgl where id = '$id'";
    $info = $lg->select_arr1($sql);
    $sql = "select * from xcap left join xcdate on xcap.id = xcdate.xcapid where xcap.id='".$info['xcapid']."' group by xcapid";
	$detailInfo = $lg->select_arr1($sql);
?>
<article class="strage-wp p10 bg-w">
    <h1><?php echo $info['title']; ?></h1>
    <p class="clr-all p10 brd-btm pb10">
        <span class="fl">作者：<?php echo $info['befrom']; ?></span>
        <span class="fr">阅读：<?php echo $info['clicktime']; ?></span>
    </p>
    <div class="con mt10">
        <?php echo html_entity_decode($info['content']); ?>
    </div>
</article>
<?php if(!empty($detailInfo)) {?>
<div class="strage-xg mb20 p10 bg-w">
    <h3><?php echo $detailInfo['title'] ?></h3>
    <p class="f12">出发城市：<?php echo $detailInfo['gocity'] ?></p>
    <p class="f12">行程天数：<?php echo $detailInfo['goday'] ?>天</p>
    <p class="f12">￥<b class="price f16"><?php echo $detailInfo['minprice'] ?></b>元/起</p>
    <p><a class="mt20" href="/h5/page/detail/index.php?id=<?php echo $detailInfo['xcapid'] ?>" ><button class="btn btn-solid w100">线路明细</button></a></p>
</div>
<?php } ?>
<?php
include_once '../../common/footer.php';
?>