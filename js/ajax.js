var ajax=creatXMLHTTP();
function creatXMLHTTP(){
	var ajax;
	if(window.ActiveXObject){
		try{
			ajax=new ActiveXObject("MSXML2.XMLHTTP");
			}catch(e){
				ajax=false;
			}
		
	}else{
		try{
			ajax=new XMLHttpRequest();
		}catch(e){
			ajax=false;
		}
		
	}
	if(!ajax){
		alert("ajax1 wrong");
	}else{
		return ajax;
	}
	

}

function process(p,id,outid){
	msg=document.getElementById(outid);
	if(ajax.readyState==4 || ajax.readyState==0){
		url="xcap_px.php?pxnum="+p+"&id="+id;
		ajax.open("get",url,true);
		ajax.onreadystatechange=hresponse;
		ajax.send(null);
	}else{
		setTimeout('process()',1000);
	}
}

function hresponse(){
	if(ajax.readyState==4){
		if(ajax.status==200){
		xmldoc=ajax.responseText;		
		msg.innerHTML=xmldoc;
		setTimeout("process()",1000)
	}else{
		alert("something wrong!"+ajax.statusText);
	}
}
}





