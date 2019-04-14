<?php 
$rootDir = $_SERVER['DOCUMENT_ROOT'];
include( $rootDir.'/conf/log.class.php');
$sql = "select * from xcap where gotheme like '%拼车%' ";
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$starPage = ($page -1) * PAGESIZE;
$sql .= ' limit '.$starPage.', '.PAGESIZE ;
$themes = $lg->select_arr2($sql);
exit(json_encode(['list' => $themes]));