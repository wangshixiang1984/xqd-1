<?php
require '../../conf/op.class.php';
if(!isset($_SESSION[USER])){
	header("Location:../login/login.php");exit;
}
$sql="select * from dzxl order by id desc";
$splitpagearr=$funcop->split_page(10,7,$sql);
$sql=$splitpagearr["sql"];
$splitpage=$splitpagearr["page"];
$dzxlarr=$lg->select_arr2($sql);
$dzxlnum=$lg->select_num($sql);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link type="text/css" rel="stylesheet" href="../../css/common.css" />
<link type="text/css" rel="stylesheet" href="../../css/admin.css" />

<script src="../../js/jquery.min.js"></script>
<title>定制线路管理</title>
</head>

<body>
<table class="admin_mhover" style="width:100%;">
	<thead class="admin_th"><tr><td style="width:15%">姓名</td><td style="width:10%">性别</td><td style="width:10%">报名人数</td>
	<td style="width:10%">电话</td><td style="width:10%">出发地</td><td style="width:10%">目的地</td><td>路线定制详情</td><td style="width:20%">操作</td></tr></thead>
	<tbody>
		<?php 
		for($i=0;$i<$dzxlnum;$i++){			
		?>
		<tr>
			<td><?php echo $dzxlarr[$i]["user"];?></td>
			<td><?php echo $dzxlarr[$i]["sex"];?></td>
			<td><?php echo $dzxlarr[$i]["man"];?></td>
			<td><?php echo $dzxlarr[$i]["tel"];?></td>
			<td><?php echo $dzxlarr[$i]["startplace"];?></td>
			<td><?php echo $dzxlarr[$i]["endplace"];?></td>
			<td><a href="dzxl_detail.php?id=<?php echo $dzxlarr[$i]["id"];?>">查看详情</a></td>
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
		$.getJSON("del_dzxl.php",{"p_arr[]":arrs},function(json){
			var data=eval(json);
			alert(data.info);
			window.location.href="man_dzxl.php";
		});
})
 </script>
</body>
</html>