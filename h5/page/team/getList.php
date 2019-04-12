<?php
$rootDir = $_SERVER['DOCUMENT_ROOT'];
include( $rootDir.'/conf/log.class.php');
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

$starPage = ($page -1) * PAGESIZE;
$sql = "select * from  ld";
$sql .= ' limit '.$starPage.', '.PAGESIZE ;
$info = $lg->select_arr2($sql);
exit(json_encode(['list' => $info]));