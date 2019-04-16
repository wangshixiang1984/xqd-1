<?php
require 'config.inc.php';

//类定义开始，主要用于解决输入，登录等常用复合函数


class log extends opsql{
	private $outstr="";//转换用户 输入字符串的输出
	private $logstr="";//用户 登录后的显示字符串
	private $picname="";
	private $locat="";
	private $go_page="";
//------------------------------用户提示框输出提示--------------------------------------
//@$message:要输出提示的文本内容
//@$page:输出后要跳转的页面
	function outalert($message){
		return $this->locat="<script language='javascript'>alert('".$message."');</script>";

	}
	
//------------------------------用户提示框输出提示结束--------------------------------------
//------------------------------页面跳转函数--------------------------------------
//@$page:要跳转的页面
//
	function gopage($page){
		return $this->go_page="<script language='javascript'>window.location.href='".$page."'</script>";

	}
	
//------------------------------用户提示框输出提示结束--------------------------------------
		
//------------------------------用户 转换输入字符串方法 开始--------------------------------------	
//@实现用户输入内容的检测，如果遇到       '"<>   则进行转换成实体代码，防止sql注入	
	function ckinput($str){
		$str1="";
		if(get_magic_quotes_gpc()){
			$str1=stripslashes($str);
			return $this->outstr=htmlentities($str1,ENT_QUOTES,'utf-8');
		}else{
			return $this->outstr=htmlentities($str,ENT_QUOTES,'utf-8');
		}
	}
	
//------------------------------用户 转换输入字符串方法结束--------------------------------------		
//------------------------------用户 登录方法 开始--------------------------------------
//@实现用户输入用户名，密码，及验证码的检测登录,表名及字段名在常量配置文件var.init.php中定义
//@$username:输入登录用户名
//@$psw:输入登录用户密码
//@$ckcode:输入登录的验证码,如果不需要验证码，则直接输入0
//@$targetpage:输入登录成功后跳转的页面 

	function cklog($username,$psw,$ckcode,$targetpage){
		$sql="select * from ".TBNAME." where ".FIELDNAME."='$username'and ".FIELDPSW."='$psw'";
				
			// $rs=$this->select_arr1($sql);
		if(($ckcode==0 && !isset($_SESSION[CKCODE])) || (strtolower($_SESSION[CKCODE])==strtolower($ckcode))){
			$rs=$this->select_arr1($sql);
			$switch=1;
		}else{
			return $this->logstr="<script language='javascript'>
			alert('验证码输入错误!'); </script>";
			$switch=0;
		}
		$switch = 1;
		if($switch==1){			
			if($rs){
				$_SESSION[USER]=$username;
				$_SESSION[CKCODE]="";
				unset($_SESSION[CKCODE]);
				header("Location:{$targetpage}");
				exit();
			}else{
				return $this->logstr="<script language='javascript'>alert('用户名或密码有误!'); </script>";
			}
		}
	}


	
//--------------------------------用户 登录方法结束------------------------------
	
//截取字符串长度函数---------------
function str_long($str,$start=0,$len,$istitle=true){
$tmpstr = ""; 
$strlen = $start + $len; 
for($i = 0; $i < $strlen; $i++) { 
if(ord(substr($str, $i, 1)) > 0xa0) { 
$tmpstr .= substr($str, $i, 3); 
$i=$i+2; 
} else 
$tmpstr .= substr($str, $i, 1); 
}
if($istitle==true){
	return $tmpstr;
}else{
	if(strlen($str)>$strlen) $tmpstr.="...";
	return $tmpstr; 
}
} 
	
	
//--------------------------------生成随机验证码------------------------------
private function cc(){
	$arr1=range('B','C');
	$arr2=range(1,9);
	$arr3=range('B','E');
	
	$arrc=array_merge($arr2,$arr3);
	$len=count($arrc);
	
	$rnum=rand(0,count($arr1)-1);
	$str=$arr1[$rnum];
	$str1 = '';
	$rnum1=rand(0,$len-1);
	
	$str.=$arrc[$rnum1];
	
	$len=count($arr3);
	$rnum=rand(0,$len-1);
	$str1.=$arr3[$rnum];
	$str1.="0";
	
	$str=base_convert($str, 16, 10);
	$str1=base_convert($str1, 16, 10);

	$c=chr($str).chr($str1);
	$c=mb_convert_encoding($c, "gb2312","UCS-2");
	return $c=mb_convert_encoding($c, "utf-8","gb2312");
	
}


private function chekcode($strcode){
	header ('Content-type:image/png');
	$img=imagecreate(80, 22);
	$bgcolor=imagecolorallocate($img, 255, 255, 255);
	$charcolor=imagecolorallocate($img, 0, 0, 0);
	$l_color=imagecolorallocate($img, rand(0,255),rand(0,255),rand(0,255));
	$p_color=imagecolorallocate($img, rand(0,255), rand(0,255), rand(0,255));
	imagefilledrectangle($img, 0, 0, 60, 25, $bgcolor);
	for($i=0;$i<60;$i++){
		imagesetpixel($img, rand(0,80), rand(0,22), $l_color);
		
	}
	for($i=0;$i<5;$i++){
		imageline($img,rand(0,80),rand(0,30),rand(0,80),rand(0,30),$l_color);
	}
	$font = dirname(__FILE__).'/STSONG.TTF';
	for($i=0;$i<iconv_strlen($strcode);$i++){
		$str=iconv_substr($strcode,$i,1,"utf-8");
		imagettftext($img, 14, rand(-5,5), 8+14*$i,13+$i*rand(0,2), $charcolor,$font, $str);
		
	}
	
	imagepng($img);
	imagedestroy($img);
}
public function randcode(){
$c_arr=range('a','z');
$c_arw=range('A','Z');
$c_num=range(0,9);
$c=array_merge($c_arr,$c_arw,$c_num);

$str_hanzi=$this->cc();
$str1 = '';
for($i=0;$i<4;$i++){
	$num=rand(0,(count($c)-1));
	$str1.=$c[$num];
}
$_SESSION[CKCODE]=$str1;
$this->chekcode($str1);
}	

//--------------------------------生成随机验证码结束------------------------------


//================================翻页函数=================================
//@:$pagenum:为每页显示的数量
//@:$pagelen:为显示多少个页数字如：第一页 1 2 3 4 5 最后一页
//@:$sql：为查询的数据：select * from table  即可
//@:结果返回：返回一个一维数组，数组0为：sql的结合结果，数组1为：翻页栏
function split_page($pagenum=5,$pagelen=5,$pagego=0,$sql){
		$pageall=$this->select_num($sql);//页面数量
		$pagesize=ceil($pageall/$pagenum);
		$pageurl=$_SERVER['PHP_SELF'];
		$pagemax=$pagesize;
		if(!isset($_GET['page'])){
			$pagenow=1;
		}else{
			$pagenow=intval($_GET['page']);
		}//获取当前页，如果没有，则设为1
		if($pagego==0){
			$pagev=$pagenum*($pagenow-1);
		}else{
			if($pagego<0) $pagego=1; else if($pagego>$pagesize) $pagego=$pagesize;
			$pagev=$pagenum*($pagego-1);
			$pagenow=$pagego;
		}
		$str = '';
		$sql1=$sql." limit $pagev,$pagenum";
		$str.=$pagenow."/".$pagesize;
		if($pagenow<=1){
			$str.=" 第一页｜上一页";
		}else{
			$str.='<a href="'.$pageurl.'?page=1">第一页</a>｜<a href="'.$pageurl.'?page='.($pagenow-1).'">上一页</a>';
		}
		
		$offset=ceil($pagelen/2)-1;
		$init=1;
		if($pagesize>$pagelen){
		if($pagenow<=$offset){
			$init=1;
			$pagemax=$pagelen;
		}else{
			if($pagenow+$offset>=$pagesize){
				$init=$pagesize-$pagelen+1;
			}else{
				$init=$pagenow-$offset;
				$pagemax=$pagenow+$offset;
			}
		}
	}
		
		for($i=$init;$i<=$pagemax;$i++){
			if($pagenow==$i){
			$str.=$i;
			}else{
				$str.='<a href="'.$pageurl.'?page='.$i.'"> '.$i.' </a>';
			}
		}
		
		if($pagenow>=$pagesize){
			$str.='下一页｜最后一页';
		}else{
			
			$str.='<a href="'.$pageurl.'?page='.($pagenow+1).'">下一页</a><a href="'.$pageurl.'?page='.$pagesize.'">最后一页</a>';
		}
		return $this->arrpage=array($sql1,$str);
	}

//=========================================================================	
/* 上一篇，下一篇方法 
 * 参数：$sql 要查询的sql
 * 参数：$id 当前ID
 * 返回：一个二维数组，$nextprev[0]为下篇，$nextprev[1]为上篇
 * */
function nextprev_page($table,$id){
	$sqlnext="select * from $table where id<$id order by id desc limit 1";
	$nextprev[0]=$this->select_arr1($sqlnext);
	$sqlprev="select * from $table where id>$id order by id limit 1";
	$nextprev[1]=$this->select_arr1($sqlprev);
	unset($sqlnext);
	unset($sqlprev);
	return $nextprev;
}	
/*页面内关键词搜索
 * 参数：
 */
//--------------------------------退出方法------------------------------
function logout($page){
	if($_SESSION[SJSES][USER]){
	$_SESSION[SJSES][USER]="";
	unset($_SESSION[SJSES][USER]);
	session_destroy();
	header("Location:{$page}");
	}
	
}
//--------------------------------退出方法结束------------------------------

}//类定义结束

//--------------------------实例化log类-------------------------------------------	
$lg=new log();

