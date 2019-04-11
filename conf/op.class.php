<?php
require 'log.class.php';
class op extends opsql{
	private $arrpage;	
	function split_page($pagenum=2,$pagelen=5,$sql, $params = array()){
		$str="";
		$pageall=$this->select_num($sql);//页面数量
		$pagesize=ceil($pageall/$pagenum);
		$pageurl=$_SERVER["PHP_SELF"];
		$pagemax=$pagesize;
		if(!isset($_GET['page'])){
			$pagenow=1;
		}else{
			$pagenow=intval($_GET['page']);
		}//获取当前页，如果没有，则设为1
		$pagev=$pagenum*($pagenow-1);
		$sql1=$sql." limit $pagev,$pagenum";		
		$str.=$pagenow."/".$pagesize;
		$paramstr = '';
		if(is_array($params) && !empty($params)){
			$index = 1;
			foreach ($params as $key => $val){
				$paramstr .= '&'.$key.'='.$val;
			}
		}
		if($pagenow<=1){
			$str.=" <span>第一页</span> <span>上一页</span>";
		}else{
			$str.='<span><a href="'.$pageurl.'?page=1'.$paramstr.'">第一页</a></span> <span><a href="'.$pageurl.'?page='.($pagenow-1).$paramstr.'">上一页</a></span>';
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
			$str.="<span id='current_page'>".$i."</span>";
			}else{
				$str.='<span><a href="'.$pageurl.'?page='.$i.$paramstr.'"> '.$i.' </a></span>';
			}
		}
		
		if($pagenow>=$pagesize){
			$str.='<span>下一页</span> <span>最后一页</span>';
		}else{
			
			$str.='<span><a href="'.$pageurl.'?page='.($pagenow+1).$paramstr.'">下一页</a></span><span><a href="'.$pageurl.'?page='.$pagesize.$paramstr.'">最后一页</a></span>';
		}
		return $this->arrpage=array("sql"=>$sql1,0=>$sql1,"page"=>$str,1=>$str);
	}	
}
$funcop=new op();