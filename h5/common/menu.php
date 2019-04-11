<?php
//     $menuList = $menuList || [];
//     $title = $title || '';
//     $menuList = [['name'=> '四川','src' => './index.php']];
// $title = '选择目的地';
?>
<div class="mask"  id="menucom">
    <nav class="menu com">
        <div class="tit">
            <!-- <i class="fl" id="clsMenu"></i> -->
            <i class="fr" id="closeComMenu"></i>
        </div>
        <!-- <div class="t-c">
            <div class="hpic"><img src="/h5/public/images/hpic.png" /></div>
            <div><span class="mr10">登录</span><span>注册</span></div>
        </div> -->
        <div class="tit sel mb10"><?php echo $title; ?></div>
        <ul class="item">
            <?php for($i=0; $i < count($menuList); $i++ ){ ?>
            <li>
                <a href="<?php echo $menuList[$i]['src']; ?>"><?php echo $menuList[$i]['name']; ?></a>
            </li>
            <?php } ?>
        </ul>
    </nav>
</div>