<?php
include('../conf/log.class.php');
if($_SERVER['REQUEST_METHOD'] == 'POST'){
	//出发城市
	$startplace = $lg->ckinput($_POST['departure']); 
	//出行日期
	$yeard = $lg->ckinput($_POST['yeard']);
	$monthd = $lg->ckinput($_POST['monthd']);
	$dayd = $lg->ckinput($_POST['dayd']);
	//人数
	$man = $lg->ckinput($_POST['person']); 
	//出行天数
	$playday = $lg->ckinput($_POST['days']); 
	//天数确认
	$daysconfirm = $lg->ckinput($_POST['daysconfirm']);
	//目的地
	$endplace = $lg->ckinput($_POST['dest']); 
	//出行预算
	$money = $lg->ckinput($_POST['budget']); 
	//定制要求
	$content = $lg->ckinput($_POST['content']); 
	//联系人
	$user = $lg->ckinput($_POST['name']); 
	//电话
	$tel = $lg->ckinput($_POST['mobile']); 
	//性别
	$sex = $lg->ckinput($_POST['sex']); 
	//回复时间
	$replytime = $lg->ckinput($_POST['replytime']); 
	//验证码
	$code = $lg->ckinput($_POST['code']);
	
	$ckcode = $_SESSION[CKCODE];
	$response = [];
	if(strtolower($ckcode) == strtolower($code)){
		$sql = "insert into dzxl (startplace, yeard, monthd, dayd, man, playday, daysconfirm, endplace, money, content, user, tel, sex, reply) 
		values ('$startplace', '$yeard', '$monthd', '$dayd', '$man', '$playday', '$daysconfirm', '$endplace', '$money', 
		'$content', '$user', '$tel', '$sex', '$replytime')";
		$res = $lg->imd($sql);
		if($res){
			$response['data'] = $res;
			$response['code'] = 0;
		}else{
			$response['code'] = -1;
			$response['msg'] = '添加出现失误，请重新填定试试！';
		}
	}else{
		$response['code'] = -1;
		$response['msg'] = '验证码错误';
		$response['inf'] = [$code, $ckcode];
	}
	exit(json_encode($response, JSON_UNESCAPED_UNICODE));
}