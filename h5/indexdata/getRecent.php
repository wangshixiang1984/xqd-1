<?php
$rootDir = $_SERVER['DOCUMENT_ROOT'];
include( $rootDir.'/conf/log.class.php');

$list = $lg->select_arr2('select xcap.id, xcap.passed,	xcap.goday, xcap.title, xcap.img_path, xcap.gocity,xcdate.price,xcdate.godate from xcap left join xcdate on xcap.id=xcdate.xcapid where hide != 1 and istop = 1 group by xcdate.xcapid order by xcap.px desc limit 8');
exit(json_encode(['list' => $list]));

