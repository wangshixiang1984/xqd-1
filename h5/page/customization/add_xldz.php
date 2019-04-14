<?php
$rootDir = $_SERVER['DOCUMENT_ROOT'];
include($rootDir.'/conf/log.class.php');
if($_SERVER['REQUEST_METHOD'] == 'POST'){
	//出发城市
	$startplace = $lg->ckinput($_POST['go-city']); 
	//出行日期
	$date = explode('-', $lg->ckinput($_POST['sel-date']));
	
	$yeard = $date[0];
	$monthd = $date[1] . '月';
	$dayd = $date[2]. '日';
	//人数
	$man = intval($lg->ckinput($_POST['sel-pep'])); 
	//出行天数
	$playday = intval($lg->ckinput($_POST['sel-day'])); 
	//天数确认
	$daysconfirm = $lg->ckinput($_POST['radio1']);
	//目的地
	$endplace = $lg->ckinput($_POST['desti']); 
	//出行预算
	$money = $lg->ckinput($_POST['price']); 
	//定制要求
	$content = $lg->ckinput($_POST['need']); 
	//联系人
	$user = $lg->ckinput($_POST['lxr']); 
	//电话
	$tel = $lg->ckinput($_POST['tel']); 
	//性别
	$sex = '先生/女士'; 
	//回复时间
	$replytime = $lg->ckinput($_POST['reptime']); 
	//验证码
	$code = $lg->ckinput($_POST['randcode']);
	$datetime = date('Y-m-d h:i:s', time());
	$ckcode = $_SESSION[CKCODE];
	$response = [];
	if(strtolower($ckcode) == strtolower($code)){
		$sql = "insert into dzxl (startplace, yeard, monthd, dayd, man, playday, daysconfirm, endplace, money, content, user, tel, reply,sex, datetime) 
		values ('$startplace', '$yeard', '$monthd', '$dayd', '$man', '$playday', '$daysconfirm', '$endplace', '$money', 
		'$content', '$user', '$tel', '$replytime', '$sex', '$datetime')";
		$res = $lg->imd($sql);
		if($res){
			$response['data'] = $res;
			$response['code'] = 0;
			$response['msg'] = '添加成功';
		}else{
			$response['code'] = -1;
			$response['msg'] = '添加出现失误，请重新填定试试！';
			$response['msg1'] = $sql;
		}
	}else{
		$response['code'] = -1;
		$response['msg'] = '验证码错误';
		$response['inf'] = [$code, $ckcode];
	}
	exit(json_encode($response, JSON_UNESCAPED_UNICODE));
}