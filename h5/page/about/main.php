<?php
    $sql = "select * from gywm";
    $info = $lg->select_arr1($sql);
    $sql_a = "select * from adver where type=9 order by id desc limit 0, 1";
    $adv = $lg->select_arr1($sql_a);
?>
<div class="com-adv">
    <img src="<?php echo $imgDir.$adv['img_path'];?>" alt="<?php echo $adv['title'];?>" />
</div>
<div class="us-wp">
    <?php echo html_entity_decode($info['content']); ?>
</div>    