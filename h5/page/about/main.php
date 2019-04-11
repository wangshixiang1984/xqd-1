<?php
    $sql = "select * from gywm";
    $info = $lg->select_arr1($sql);
?>
<div class="com-adv"> <img src="http://www.xqdzjy.com/htmleditor/attached/image/mainpic/201903284418.jpg" /></div>
<div class="us-wp">
    <?php echo html_entity_decode($info['content']); ?>
</div>    