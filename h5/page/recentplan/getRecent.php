<?php
$rootDir = $_SERVER['DOCUMENT_ROOT'];
include( $rootDir.'/conf/log.class.php');
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$pageSize = 5;
// $totalNum = $lg->select_num($sql);
$starPage = ($page -1) * $pageSize;
$sql = 'select xcap.id, xcap.passed, xcap.gotime,	xcap.goday, xcap.title, xcap.img_path, xcap.gocity,xcdate.price,xcdate.godate from xcap left join xcdate on xcap.id=xcdate.xcapid where hide != 1 and istop != 1 group by xcdate.xcapid order by xcap.px desc';
$sql .= ' limit '.$starPage.', '.$pageSize ;
$info = $lg->select_arr2($sql);
exit(json_encode(['list' => $info]));