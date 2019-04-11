<?php
include_once '../../common/header.php';
$id = empty($_GET['id']) ? intval($_GET['id']) : 0;
$info = $lg->select_arr1("select * from ld where id='$id'");

?>
    <div class="ld-con p10">
        <p class="tit">达人详情</p>
        <div class="con f14">
            <?php echo  html_entity_decode($info['content']); ?>
        </div>
        <p class="tit mt20">曾带队线路</p>
        <ul class="xl">
            <?php 
                $sql = "select title, id from xcap where id in(".trim($info['leadedxl'], ',').")";
                $list = $lg->select_arr2($sql);
                for($i=0;$i<count($list);$i++){
            ?>
            <li><a href="/xcap/detail.php?id=<?php echo $list[$i]['id']; ?>"><?php echo $list[$i]['title']; ?></a></li>
            <?php } ?>
        </ul>
    </div>
<?php
include_once '../../common/footer.php';
?>