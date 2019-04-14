<?php
$rootDir = $_SERVER['DOCUMENT_ROOT'];
include( $rootDir.'/conf/log.class.php');
$keyword = isset($_GET['keyword']) ? $lg->ckinput($_GET['keyword']) : '';
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$starPage = ($page -1) * PAGESIZE;
$sql = 'select xcap.title, xcap.passed, xcap.id, xcap.img_path, xcap.startplace, xcap.goday, xcap.gocity, xcdate.price, xcdate.gomonth, xcdate.godate, xcdate.minprice from xcap left join xcdate on xcdate.xcapid=xcap.id where xcap.passed!=1 and xcap.title like "%'.$keyword.'%" group by xcapid';
$totalNum = $lg->select_num($sql);
$sql .= ' limit '.$starPage.', '.PAGESIZE ;

$res=$lg->select_arr2($sql);

exit(json_encode(['list' => $res, 'total' => $totalNum]));