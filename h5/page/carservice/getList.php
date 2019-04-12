<?php
$rootDir = $_SERVER['DOCUMENT_ROOT'];
include( $rootDir.'/conf/log.class.php');
$filter = isset($_GET['filter']) ? $_GET['filter'] : '';
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

$starPage = ($page -1) * PAGESIZE;

// $type = $lg->ckinput(isset($_GET['type']) ? $_GET['type'] : 'short');
$type = $filter['1'];
$sql = "select * from car";

if($type == 'short'){
	$sql .= ' where days < 7 ';
}else if($type == 'week'){
	$sql .= ' where days >= 7 and days <= 14 ';
}else{
	$sql .= ' where days > 27 ';
}
$sql .= ' order by id desc';
$sql .= ' limit '.$starPage.', '.PAGESIZE ;

$res = $lg->select_arr2($sql);

exit(json_encode(['list' => $res]));