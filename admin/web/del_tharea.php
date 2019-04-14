<?php
require '../../conf/log.class.php';
if(!isset($_SESSION[USER])){
	header("Location:../login/login.php");exit;
}else{
    $type = isset($_GET['type']) ? $_GET['type'] : '';
    $name = isset($_GET['name']) ? $_GET['name'] : '';

    if(empty($type) || empty($name)) {
        exit(json_encode(["code"=>-1, 'msg' => '参数错误'], JSON_UNESCAPED_UNICODE));
    }
    $field = '';
    if($type === 'area') {
        $field = 'gocity';
    } elseif($type === 'theme') {
        $field = 'gotheme';
    }

    $sql = 'update xcap set '.$field.'="" where '.$field.'="'.$name.'"';
    $total = 0;
    if($total = $lg->imd($sql)) {
        exit(json_encode(["code" => 0, 'msg' => '总共删除'.$total.'条数据'], JSON_UNESCAPED_UNICODE));
    } else {
        exit(json_encode(["code"=>-1, 'msg' => '删除出错！', 'test' => $sql], JSON_UNESCAPED_UNICODE));
    }
}