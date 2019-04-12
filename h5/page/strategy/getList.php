<?php
$rootDir = $_SERVER['DOCUMENT_ROOT'];
include( $rootDir.'/conf/log.class.php');
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
// $pageSize = 10;
$starPage = ($page -1) * PAGESIZE;

$sql = "select * from zjgl order by id desc";
$sql .= ' limit '.$starPage.', '.PAGESIZE ;

$res=$lg->select_arr2($sql);

exit(json_encode(['list' => $res]));