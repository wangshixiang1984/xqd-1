<?php
$rootDir = $_SERVER['DOCUMENT_ROOT'];
include( $rootDir.'/conf/log.class.php');
// $type = isset($_GET['filter']) ? $_GET['filter'] : 1;

// $sql = 'select gocity, citypic, id from xcap  where citypic  != "" group by citypic';
$sql = 'select distinct gocity, citypic from xcap where citypic !="" and gocity !=""';

$res = $lg->select_arr2($sql);

exit(json_encode(['list' => $res]));

