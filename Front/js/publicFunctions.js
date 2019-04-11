//检测IE版本
function FuckInternetExplorer() {
	var browser = navigator.appName;
	var b_version = navigator.appVersion;
	var version = b_version.split(";");
	 if (version.length > 1) {
		  var trim_Version = parseInt(version[1].replace(/[ ]/g, "").replace(/MSIE/g, ""));
		  if (trim_Version < 7) {
			  //window.location.href="http://www.luplan.com/index/lower"
		  }
	  }
	  else{
	  return true;
	  }
}

 FuckInternetExplorer();
//验证
function check(type,obj){	 	
	 if(type=="isNull"){
		 if(obj.val()==""){
			 obj.addClass("wrong")	
			 return 1;		 
		 }
		 else{
			 obj.removeClass("wrong")	
			 return 0; 
		 }
		 
	 }// if(type=="inNull")
	 
	 if(type=="isCn"){
		 if(/^[\u4e00-\u9fa5]+$/.test(obj.val())){
			 obj.removeClass("wrong")	
			 return 0;		 
		 }
		 else{
			 obj.addClass("wrong")	
			 return 1; 
		 }
		 
	 }// if(type=="inNull")
	 
	 if(type=='isMail'){
		if(/^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/.test(obj.val())) {
			 obj.removeClass("wrong")	
			 return 0;			 
		 }
		 else{
			 obj.addClass("wrong")	
			 return 1; 
		 }
	 }//if(type=='isMail')
	 
	 if(type=="isInt"){
		 if(/^[1-9]\d*$/.test(obj.val())) {
			 obj.removeClass("wrong")	
			 return 0;			 
		 }
		 else{
			 obj.addClass("wrong")	
			 return 1; 
		 }		 
	 }//if(type=="isInt")
	 
	 if(type=="isMobile"){
		 if(/^(0|86|17951)?(13[0-9]|15[012356789]|17[0678]|18[0-9]|14[57])[0-9]{8}$/.test(obj.val())) {
			 obj.removeClass("wrong")	
			 return 0;			 
		 }
		 else{
			 obj.addClass("wrong")	
			 return 1; 
		 }		 
	 }//if(type=="isMobile")
	 
	 if(type=="isChecked"){
		 if(obj.attr('checked')) {
			 return 0;			 
		 }
		 else{
			 return 1; 
		 }		 
	 }//if(type=="isChecked")
	 
}//function check(type,obj)
//计算位置
function pageX(elem)   
  {  
	  return elem.offsetParent ? elem.offsetLeft + pageX(elem.offsetParent) : elem.offsetLeft;  
  }  
		
  function pageY(elem)   
  {  
		  return elem.offsetParent ? elem.offsetTop + pageY(elem.offsetParent) : elem.offsetTop;  
  } 
//object显示时运行回调函数
function whileDisplay(obj,addnum,callback,elsefn){
	$(window).scroll(function(){
	var toTop=pageY(obj[0]);
	var now=$(window).scrollTop();
	    if(now>=toTop+addnum){
		 if(callback && callback instanceof Function){ //判断是否传参，以及参数类型
		  callback();
		  }//if
		}
		else{
		  if(elsefn && elsefn instanceof Function){ //判断是否传参，以及参数类型
		  elsefn();
		  }//if
		}
	 });//window.scroll(function()
};//function whileDisplay
	
//到达页面指定位置
function moveTo(target){
  if(target=="top"){
	$('body,html').animate({scrollTop:0},500);
  }
  else{
	if($(''+target+'')) {
		var object=$(''+target+'');
		$('body,html').animate({scrollTop:object.offset().top-40},500);
	}	  
  }
}

//浮动
function b(){
	h = $(window).height();
	t = $(document).scrollTop();
	if(t > h){
		$('.floatBox .move').show();
	}else{
		$('.floatBox .move').hide();
	}
}
$(document).ready(function(e) {
	b();
	$('.floatBox .code').hover(function(){
			$('#code_img').show();
		},function(){
			$('#code_img').hide();
	});
	$('.floatBox .tel').hover(function(){
			$('#tel_hover').show();
		},function(){
			$('#tel_hover').hide();
	});
	$('.floatBox .online').hover(function(){
			$('#online_hover').show();
		},function(){
			$('#online_hover').hide();
	});
});

$(window).scroll(function(e){
	b();		
})

//字数限制
function LimitTextArea(field,maxlimit){ 
    if (field.value.length > maxlimit){ 
     field.value = field.value.substring(0, maxlimit);     
	 swal("操作提示", "您输入的内容已超出字数限制!", "warning");   
    }
	else{
	  if($("#inputed b").length>=1){
		$("#inputed b").text(field.value.length);  
	  }
	}
}   

  //弹出层背景模糊
function openBox(target){
	var e=window.event || event;
	if(e.stopPropagation){
	 e.stopPropagation();
	}
	else{
	 e.cancelBubble = true;
	} 
	if($(''+target+'').length>0){
		var box=$(''+target+'');
		var zindex=box.find(".zindex");
		var objs=$(".header,.ucleft,.ucright,.footer");
		box.show();
		objs.addClass("blur");
		
		zindex.css({"margin-top":(0-zindex.height()/2),"margin-left":(0-zindex.width()/2)})
		zindex.click(function(event){
		  var e=window.event || event;
		  if(e.stopPropagation){
		   e.stopPropagation();
		  }else{
		   e.cancelBubble = true;
		  }
		 });
		 document.onclick = function(){	 
		  closeBox(zindex)
		 };
	}//if
}//function openBox(target)
//关闭弹出层
function closeBox(target){	
	var objs=$(".header,.ucleft,.ucright,.footer");
	objs.removeClass('blur');
	$(target).parents(".openBox").hide();
}
//重新计算弹出层尺寸
function resizeBox(target){
		var box=target.parents('.openBox');
		var zindex=box.find(".zindex");
		zindex.css({"margin-top":(0-zindex.height()/2),"margin-left":(0-zindex.width()/2)})
}//function resizeBox(target)

//页面加载后再执行
$(document).ready(function(e) {
  //重置输入框	
  if($(".needReset").length>=1){
   var inputs=$(".needReset");
   inputs.each(function(index, element) {
	  var value=$(this).val();
	  $(this).focus(function(){
		  if($(this).val()==value){
		  $(this).val("");
		  }
	  });
	  $(this).blur(function(){
		  if($(this).val()==""){
		  $(this).val(value);
		  }
	  });
  });	
  }//if($(".needReset"))
  
  //多行文本超出显示处理
  if($('.text-overflow').length>=1){
	$(".text-overflow").each(function(i){
	  var divH = $(this).height();
	  var $p = $(this).find(".conText");
	  while ($p.outerHeight() > divH) {
		  $p.text($p.text().replace(/(\s)*([a-zA-Z0-9]+|\W)(\.\.\.)?$/, "..."));
	  };
    });  
  }//if($('text-overflow').length>=1)
  
  //多行文本超出显示处理
  if($("span.usercenter").length>=1){
  var userBtn=$("span.usercenter");
	if(userBtn.hasClass("loged")){
	  userBtn.mouseenter(function(){
	   $(".userCtrl").stop(true,true).slideDown();	
	  });
	  userBtn.mouseleave(function(){
	   $(".userCtrl").delay(500).stop(true,true).slideUp();	
	  })	
	}//if(userBtn.hasClass("loged"))
	else{
	  userBtn.click(function(){
		window.location.href=userBtn.data("tolog");
	  })	
	}
  }// if($("span.usercenter").length>=1)
  
  //单个选中切换
  $(".switchSingle").click(function(){
   var i=$(this).find("i");
   var checkbox=$(this).find("input");	
   if(checkbox.attr("checked")){
	  checkbox.attr("checked", false);
	  i.removeClass("fa-check-square-o").addClass("fa-square-o");
   }
   else{
	  checkbox.attr("checked", true) ;
	  i.removeClass("fa-square-o").addClass("fa-check-square-o");
   }
  })// $("#switch").click(function()
  
  //单个选中切换2
  $("#switch").click(function(){
   var i=$(this).find("i");
   var checkbox=$(this).find("input");	
   if(checkbox.attr("checked")){
	  checkbox.attr("checked", false);
	  i.removeClass("fa-toggle-on").addClass("fa-toggle-off").css("color","#787878");
   }
   else{
	  checkbox.attr("checked", true) ;
	  i.removeClass("fa-toggle-off").addClass("fa-toggle-on").css("color","#ff6600");
   }
  })// $("#switch").click(function()
  //多个选中切换
  $("span.radio").click(function(){   
   $(this).siblings("span").find("i").removeClass("fa-dot-circle-o").addClass("fa-circle-o");
   $(this).siblings("span").removeClass("current").find("input").attr("checked", false) ;	
   $(this).addClass("current").find("input").attr("checked", true) ;
   $(this).find("i").removeClass("fa-circle-o").addClass("fa-dot-circle-o");
  })
  
  //悬浮框关闭
  $("#floatBox a.close").click(function(){
	  $(this).parent().remove();
  })//$("#floatBox a.close").click(function()
  
  //导航
  var links=$(".header li");
  var nav=$("#second-nav");
  var navUl=$("#second-nav ul");
  navUl.each(function(index, element) {
	 var left=138+(161*index)+90-($(this).find("li").length*75);
	 //console.log(138+(130*index)+65+'-'+($(this).find("li").length*75)+'='+left);
	 $(this).css("left",left)
  	 $(this).find("li").each(function(index, element) {
        $(this).addClass("l"+parseInt(index+1))
    });  
  });
  links.each(function(index, element) {
    	$(this).mouseenter(function(){
			navUl.hide();
			nav.stop(true,true).css({"opacity":"0"});			
			if(index==0||index==1||index==5){
				navUl.hide();
			}
			else{
				nav.show().animate({"opacity":"1"})
				navUl.eq(index).show();	
			}
		})
		nav.mouseleave(function(){
			navUl.eq(index).hide();
			nav.animate({"opacity":"0"})
		})
		
  });//links.each(function(index, element) 
  
});//$(document).ready(function(e)