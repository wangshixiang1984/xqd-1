<?php
// $rootDir = $_SERVER['DOCUMENT_ROOT'];
include('../../../conf/log.class.php');
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$size = isset($_GET['size']) ? intval($_GET['size']) : 0;
$starPage = ($page -1) * PAGESIZE;
$month2 = date('Y-m-d h:i:s', strtotime("-2 month"));

$sql = 'select xcap.id, xcap.passed, xcap.goday, xcap.title, xcap.img_path, xcap.gocity,xcdate.price,xcdate.godate from xcap left join xcdate on xcap.id=xcdate.xcapid where hide != 1 and xcap.time>="'.$month2.'" group by xcdate.xcapid order by xcap.px desc, xcap.id desc';
if($size > 0) {
    $sql .= ' limit 0, '.$size;
} else {
    $sql .= ' limit '.$starPage.', '.PAGESIZE ;
}

$info = $lg->select_arr2($sql);
exit(json_encode(['list' => $info]));