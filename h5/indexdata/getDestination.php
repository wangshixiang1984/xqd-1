<?php
$rootDir = $_SERVER['DOCUMENT_ROOT'];
include( $rootDir.'/conf/log.class.php');
// $type = isset($_GET['filter']) ? $_GET['filter'] : 1;

$sql = 'select distinct citypic, gocity from xcap where citypic !="" order by id desc ';

$res = $lg->select_arr2($sql);

exit(json_encode(['list' => $res]));

