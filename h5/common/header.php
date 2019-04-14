<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1, maximum-scale=1,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge,chrome=1">
    <title>首页</title>
    <link rel="stylesheet" href="/h5/public/css/mui.css">
    <link rel="stylesheet" href="/h5/public/css/mui.picker.min.css">
    <link rel="stylesheet" href="/h5/public/css/swiper.css">
    <link rel="stylesheet" href="/h5/public/css/style.css">
    <script src="/h5/public/js/jquery.min.js"></script>
    <script src="/h5/public/js/common.js"></script>
</head>
<body>
<?php
    $rootDir = $_SERVER['DOCUMENT_ROOT'];
    $rootLink = '/h5/page/';
    $imgDir = '/htmleditor/attached/image/mainpic/';
    include($rootDir.'/conf/op.class.php');
?>
<div class="content">
<header>
    <div class="sc-wp">
        <form action="javascript:void(0)" method="POST">
            <i class="iconfont iconlocation l"></i>
            <div class="input"><input type="search" id="serachBox" placeholder="目的地" /></div>
            <i class="iconfont iconico_search r" id="searchBtn"></i>
        </form>
    </div>
    <div class="t-c hw">
        <div class="icon search">
            <div>
                <img src="/h5/public/images/search.png" />
            </div>
            <div>搜索</div>
        </div>

        <a href="/h5" class="icon logo">
            <img src="/h5/public/images/logo.png" />
        </a>

        <div class="icon menu">
            <div><img src="/h5/public/images/menu.png" /></div>
            <div>菜单</div>
        </div>
    </div>
</header>
<nav class="menu" id="menu">
    <div class="tit">
        <i class="fl iconfont iconguanbi" id="clsMenu"></i>
        <a href="/h5/"><i class="fr iconfont iconshouye"></i></a>
    </div>
    <div class="t-c">
        <div class="hpic"><img src="/h5/public/images/hpic.png" /></div>
        <div><span class="mr10">登录</span><span>注册</span></div>
    </div>
    <ul class="item">
        <li>
            <a href="/h5/page/destination/index.php"><i class="mr10 iconfont iconmudedi"></i><span>目的地</span></a>
            <a href="/h5/page/strategy/index.php"><i class="mr10 iconfont iconyouji"></i><span>旅游攻略</span></a>
        </li>
        <li>
            <a href="/h5/page/time/index.php"><i class="mr10 iconfont iconziyouanpai"></i><span>出行时间</span></a>
            <a href="/h5/page/carservice/index.php"><i class="mr10 iconfont iconcheliang"></i><span>租车服务</span></a>
        </li>
        <li>
            <a href="/h5/page/all/"><i class="mr10 iconfont iconjingdian"></i><span>所有行程</span></a>
            <a href="/h5/page/review/"><i class="mr10 iconfont iconziranfengguang"></i><span>精彩回顾</span></a>
        </li>
        <li>
            <a href="/h5/page/recentplan/"><i class="mr10 iconfont iconshehuade"></i><span>近期行程</span></a>
            <a href="/h5/page/pinche/"><i class="mr10 iconfont iconyuding"></i><span>拼车自驾</span></a>
        </li>
        <li>
            <a href="/h5/page/customization/"><i class="mr10 iconfont iconyuding"></i><span>行程定制</span></a>
            <a href="/h5/page/team/"><i class="mr10 iconfont icontuandui"></i><span>团队展示</span></a>
        </li>
        <li>
            <a href="/h5/page/about/"><i class="mr10 iconfont icongaoduande"></i><span>关于心启点</span></a>
        </li>
        
    </ul>
</nav>
<script>
$('#searchBtn').click(function(){
    var keyword = $.trim($('#serachBox').val());
    window.location.href= "/h5/page/search/index.php?keyword="+keyword;
})
</script>