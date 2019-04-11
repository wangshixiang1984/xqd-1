var __suc = "操作成功";
var __fail = "操作失败";

String.prototype.trim = function () {
	return this .replace(/^\s\s*/, '' ).replace(/\s\s*$/, '' );
}

var base = {
	
	isEmail:function(email){
				var rex=/^[\w-]+(\.[\w]+)*@([\w-]+\.)+[a-zA-z]{2,7}$/;
				if(!email.match(rex))
					return false;
				return true;
			},

	isMobile:function(mobile){
				var rex=/^(1[0-9]|1[0-9]|1[0-9])\d{9}$/;
				if(!mobile.match(rex))
					return false;
				return true;
			},

	isPassword:function(password){
				if(password.length < 6 || password.length > 20)
					return false;
				return true;
			},
	isAccount:function(account){
				var rex = /^[0-9]{6,8}$/;
				if(!account.match(rex))
					return false;
				return true;
			},
	isInt:function(data){
				var rex = /^[0-9]{1,20}$/;
				if(!data.match(rex))
					return false;
				return true;
			},
	isFloat:function(data){
				return !isNaN(data);
			},
	isBint:function(data){
				var rex = /^[1-9]{1,20}$/;
				if(!data.match(rex))
					return false;
				return true;
			},
	between:function(data,min,max){
				if(data.length < min)
					return false;
				if(max != 0 && data.length > max)
					return false;
				return true;
			},
	parseJson:function(data){
				var error = {}
				try
				{
					var json = eval('(' + data + ')');
					return json;
				}
				catch (e)
				{
					return error;
				}
			},
	filter:function(data){
				return true;
			},
	include:function(data){
				$('head').append($("<script type='text/javascript' src='"+data+"'>"));
			},
	localtime:function(nS){
				return new Date(parseInt(nS) * 1000).toLocaleString().replace(/年|月/g, "-").replace(/日/g, " ");
			},
	nickname:function(data){
				var re=/^([\u4E00-\u9FA5]|[\uFE30-\uFFA0]|[a-z]|[0-9]|[_])*$/gi;
				return re.test(data);
			}

}