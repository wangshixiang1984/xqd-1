// JavaScript Document
var isgoing = 0;
$(document).ready(function(e) {
    var g = /^[1-9]*[0-9][0-9]*$/;
 
	var nownum="";
	$(".minus").click(function(){
	nownum=parseInt($(this).next().val());
	if(g.test(nownum)&&nownum>0){
		nownum=parseInt(nownum)-1;
		$(this).next().val(nownum);
	}
	else{
		$(this).next().val("0");
	}
	return false;	
	})//$(".minus").click(function()
	
	$(".plus").click(function(){
	nownum=$(this).prev().val();
	if(g.test(nownum)){
		nownum=parseInt(nownum)+1;
		$(this).prev().val(nownum);
	}
	else{
		$(this).prev().val("0");
	}
	return false;	
	})//$(".plus").click(function()
	
	$("#notarget").click(function(){
		if($(this).prop('checked')){
		 $("#dest").val("没有确定的目的地，请帮我安排")
		}
		else{
		 $("#dest").val("");	
		}
	})

	$(".subBtn").click(function(){
		if(isgoing != 0) return;
		
		var text="";
		//在这里加上各种校验信息		
		if(check("isNull",$("#departure"))){
		 text+="出发城市、"
		}
		if(check("isNull",$("#yeard"))){
		 text+="出发年份、"			
		}
		
        if(check("isNull",$("#monthd"))){
		 text+="出发月份、"		 
		}
		if(check("isNull",$("#dayd"))){
		 text+="出发日期、"		 
		}
		if(check("isInt",$("#person"))){
		 text+="出行人数、"		 
		}
		if(check("isInt",$("#days"))){
		 text+="出行天数、"		 
		}
		if(check("isNull",$("#dest"))){
		 text+="目的地、"		 
		}
		if(check("isNull",$("#budget"))){
		 text+="出行预算、"		 
		}
		if(check("isNull",$("#name"))){
		 text+="联系人、"		 
		}
		if(check("isMobile",$("#mobile"))){
		 text+="联系电话、"		 
		}
		if(check("isNull",$("#code"))){
		 text+="验证码、"		 
		}
		if(text!=''){	
			swal("输入错误!",text+"等不能为空或输入错误，请仔细核对！", "error");
			return;
		}

		$(".subBtn").text("请求正在进行....");
		isgoing = 1;
		var formdata = $('#diyform').serialize();
		$.ajax({
			type:"post",
			data:formdata,
			url: "/dzxl/add_xldz.php",
			dataType:"json",
			success:function(data){
				$(".subBtn").text("确定,立即提交");
				isgoing = 0;
				if(data.code == 0){
					sweetAlert({
					  title: "提交成功!",
					  text: "恭喜您定制成功，保持联系方式畅通，工作人员稍后将与您联系！",
					  type: "success"
					}, function(){
					  location.reload();
					});
					return;
				}
				swal("操作提示",data.msg, "warning");
				return;
			},
			error:function(xhr,desc,exceptionobj){}
		});
		
	})
	
	
	
	var wait=60; 
	function time(o) { 
			if (wait == 0) { 
				o.removeAttribute("disabled");           
				o.value="重新获取验证码";
				wait = 60;
			} else { 
				o.setAttribute("disabled", true);
				o.value=wait+"秒后可以重新发送";
				wait--; 
				setTimeout(function() { 
					time(o) 
				}, 
				1000) 
			} 
		} 

	$("#getVcode").click(function(){
		
		var mobile = $("#mobile").val().trim();
		
		if(check("isNull",$("#mobile"))){
			swal("操作提示", "手机号码必须填写!", "warning"); $("#mobile").focus(); return;
		}
		if(check("isMobile",$("#mobile"))){
		   swal("格式错误", "你的手机号码格式错误，请认真核对!", "error"); $("#mobile").focus(); return;		 
		}

		
	});
});

