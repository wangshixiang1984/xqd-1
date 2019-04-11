<?php
require '../../conf/op.class.php';
if(!isset($_SESSION[USER])){
	header("Location:../login/login.php");exit;
}
$sql="select * from qas order by id desc";
$splitpagearr=$funcop->split_page(10,7,$sql);
$sql=$splitpagearr["sql"];
$splitpage=$splitpagearr["page"];
$dzxlarr=@$lg->select_arr2($sql);
$dzxlnum=@$lg->select_num($sql);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link type="text/css" rel="stylesheet" href="../../css/common.css" />
<link type="text/css" rel="stylesheet" href="../../css/admin.css" />

<script src="../../js/jquery.min.js"></script>
<title>问答管理</title>
</head>

<body>
<table class="admin_mhover" style="width:100%;">
<thead><tr><td width="30%">问题</td><td width="50%">回答</td><td width="10%">回答者</td><td>时间</td></tr></thead>
	<tbody>
		<?php 
		for($i=0;$i<$dzxlnum;$i++){			
		?>
		<tr>
			<td><?php echo $dzxlarr[$i]["ask"];?></td>
			<td><textarea name="answer" cols="60" id="answer<?php echo $dzxlarr[$i]["id"];?>"><?php echo $dzxlarr[$i]["answer"];?></textarea><input type="text" id="answerer<?php echo $dzxlarr[$i]["id"];?>" value="<?php echo $dzxlarr[$i]["answerer"];?>" /><input type="hidden" id="aid<?php echo $dzxlarr[$i]["id"];?>" value="<?php echo $dzxlarr[$i]["id"];?>" /><input type="button" value="提交回答" id="<?php echo $dzxlarr[$i]["id"];?>" onclick="ch(this.id)" /></td>
			<td><?php echo $dzxlarr[$i]["answerer"];?></td>
			<td><?php echo $dzxlarr[$i]["time"];?></td>
			<td><input type="checkbox" name="checks[]" value="<?php echo $dzxlarr[$i]["id"];?>" onclick="selectall('checks[]','alldel')" /></td>
		</tr>
		
		<?php }?>
		<tr><td colspan="8">全选  <input type="checkbox" id="alldel" onclick="checkAll('checks[]',this.id)" /> <input type="button" id="delbtn" value="批量删除"  /></td></tr>
	</tbody>
</table>
<div class="next_page"><?php echo $splitpage;?></div>
<script type="text/javascript">  
        //复选框全选  
        function checkAll(formvalue,allname) {  
            var roomids = document.getElementsByName(formvalue);
            var selectall=document.getElementById(allname);  
            if(selectall.checked==true){
            for (var j = 0; j < roomids.length; j++) {  
                if (roomids.item(j).checked == false) {  
                    roomids.item(j).checked = true;  
                }  
            }}else {
            	for (var j = 0; j < roomids.length; j++) {  
                    if (roomids.item(j).checked == true) {  
                        roomids.item(j).checked = false;  
                    }  
                }	
            }
        }  
//全选选 中
	function selectall(formvalue,allname){
		var roomids = document.getElementsByName(formvalue);
		var selectall=document.getElementById(allname);
		var a=0;
		for(var i=0;i<roomids.length;i++){
			if(roomids.item(i).checked==true) a++;
		}
		if(a>0) selectall.checked=true;else selectall.checked=false;
	}

 </script> 
 <script>
	function arr_select(formvalue){
		var roomids = document.getElementsByName(formvalue);
		var arrs=new Array();
		var j=0;
		for(var i=0;i<roomids.length;i++){
			if(roomids.item(i).checked==true){
				j++;
			arrs[j]=roomids.item(i).value;
			}
		}
		return arrs;
	}
	$("#delbtn").click(function(){
		var arrs=new Array();
		arrs=arr_select("checks[]");
		$.getJSON("del_answer.php",{"p_arr[]":arrs},function(json){
			var data=eval(json);
			alert(data.info);
			window.location.href="man_qas.php";
		});
})
 </script>
 <script>

	function ch(sid){	
			var answer=$('#answer'+sid).val();
			var answerer=$('#answerer'+sid).val();		
				$.post('add_answer.php',{answer:answer,answerer:answerer,id:sid},function(data){
						alert(data.info);
					},'json');
	}

 </script>
</body>
</html>