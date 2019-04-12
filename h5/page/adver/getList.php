<?php
$rootDir = $_SERVER['DOCUMENT_ROOT'];
include( $rootDir.'/conf/log.class.php');
$type = isset($_GET['filter']) ? $_GET['filter'] : 1;

$sql = 'select * from adver where type='.$type['1'].' order by id desc ';

$res = $lg->select_arr2($sql);

exit(json_encode(['list' => $res]));

