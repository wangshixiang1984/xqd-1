<?php

include('../conf/log.class.php');

$filter = isset($_GET['filter']) ? $_GET['filter'] : '';
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$pageSize = 5;

//所有行程,分页
//默认查询所有
$sql = "select xcap.title, xcap.passed, xcap.id, xcap.img_path, xcap.gotheme, xcap.startplace, xcap.goday, xcap.gocity, xcdate.price, xcdate.gomonth, xcdate.godate, xcdate.minprice from xcap left join xcdate on xcdate.xcapid=xcap.id";
$sql_str = '';
if(empty($filter)){
	
}else{
	foreach($filter as $id => $keyword){
		//按主题
		
		if($id == 2){
			if(!empty($sql_str)){
				$sql_str .= ' and ';
			}
			if(!empty($keyword)){
				$sql_str .= 'gotheme ="'.$keyword.'"';
			}
		}
		//按地区
		if($id == 3){
			if(!empty($keyword)){
				if(!empty($sql_str)){
					$sql_str .= ' and ';
				}
				$sql_str .= 'gocity ="'.$keyword.'"';
			}
		}
		//按行程
		if($id == 4){
			if(!empty($keyword)){
				if(!empty($sql_str)){
					$sql_str .= ' and ';
				}
				if($keyword == '二日游'){
					$sql_str .= 'goday=2';
				}elseif($keyword == '三日游'){
					$sql_str .= 'goday=3';
				}elseif($keyword == '五日游'){
					$sql_str .= 'goday=5';
				}elseif($keyword == '七日游'){
					$sql_str .= 'goday=7';
				}elseif($keyword == '多日游'){
					$sql_str .= 'goday not in (2,3,5,7)';
				}
			}
		}
		//按月份
		if($id == 5){		
			if(!empty($keyword)){			
				if(!empty($sql_str)){
					$sql_str .= ' and ';
				}
				$day = intval($keyword);
				$sql_str .= ' xcdate.gomonth="'.$day.'"';
			}
		}
	}
}

if(!empty($sql_str)){
	$sql .= ' where '.$sql_str.' and xcdate.xcapid>0';
}else{
	$sql .= ' where xcdate.xcapid>0 ';
}
$sql .= ' and xcap.passed!=1 group by xcapid';
$totalNum = $lg->select_num($sql);
$starPage = ($page -1) * $pageSize;

$sql .= ' order by id desc'.' limit '.$starPage.', '.$pageSize ;

$xcap_arr=$lg->select_arr2($sql);

$pages = ceil($totalNum/$pageSize);
$maxPage = $pages > 5 ? 5 : $pages;
//计算分页的起始与结束页
$startPage = 1;
if($maxPage > $pages){
	$endPage = $pages;	
}else{
	$middlePage = ceil($pages/2);
	$endPage = $maxPage;
	if($page > $middlePage){
		$offset = $page - $middlePage;
		$offset = min([$offset, $pages - $maxPage]);
		$startPage += $offset;
		$endPage = $maxPage + $offset;
	}
	if($page < $middlePage){
		$offset =  $middlePage - $page;
		$offset = min([$offset, $startPage- 1]);
		$startPage += $offset;
		$endPage = $maxPage + $offset;
	}
}

$res = [
	'list' =>$xcap_arr, 
	'totalNum' => $totalNum, 
	'pages' => $pages, 
	'maxPages' => $maxPage, 
	'paginationInfo' => [
		'currentPage' => $page, 
		'startPage'=> $startPage, 
		'endPage' => $endPage
	] 
];
exit(json_encode($res, JSON_UNESCAPED_UNICODE));