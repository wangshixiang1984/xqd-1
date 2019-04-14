<?php
$rootDir = $_SERVER['DOCUMENT_ROOT'];
include( $rootDir.'/conf/log.class.php');

$sql = 'select pic,title from gywm';

$res = $lg->select_arr1($sql);

exit(json_encode(['list' => $res]));

