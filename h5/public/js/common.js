$(function(){
    // header 中事件
    //搜索框显示
    $('.hw .search').click(function(){
        !$('.sc-wp').hasClass('d') ? $('.sc-wp').slideDown('100'):$('.sc-wp').slideUp('150');
        $('.sc-wp').hasClass('d') ? $('.sc-wp').removeClass('d') : $('.sc-wp').addClass('d');
    })
    // 菜单显示与隐藏
        //显示
    $('.hw .menu').click(function() {
        $('.content').css({'overflow': 'hidden'})
        $('nav.menu').animate({top: '0'},150)
        
    })
        //隐藏
    $('#clsMenu').click(function() {
        $('.content').css({'overflow': 'auto'})
        $('nav.menu').animate({top: '-100%'},150)
    })
    // footer 中事件
    //打电话
    $('#gotel').click(function() {
        window.location.href="tel:13980001984";
    })
    
    //公共menu 中事件
    $('#closeComMenu').click(function(){
        $('#menucom').fadeOut(200);
    })

})
// options  {callback, showText}
// callback 执行完渲染后的回调
// hideText 是否显示提示，没有更多数据
function Cdata(selector, url, options) {
    //获取分类
    this.filter = {};
    this.url = url;
    this.selector = selector;
    this.scriptId = 'list';
    this.page = 0;
    this.opts = options || {};
    this.infoObj = {
        data:null,
        isLoading: false,
        isEnd: false,
        refresh: true,
        curPage: 0
    };
    this.loading = '<div class="loading t-c p10">加载中...</div>';
    this.nomore = '<div class="t-c p10">没有更多数据了！</div>';
    return this;
}

Cdata.prototype.getInfo = function(obj, id, keyword) {
    var self = $(obj);
    var _this = this;
    if(self.hasClass('act') || typeof obj === 'undefined') {
        this.infoObj.curPage++;
    } else {
        self.addClass('act').siblings().removeClass('act');
        this.infoObj.refresh = true;
        this.infoObj.curPage = 1;
        this.infoObj.isEnd = false;
    }
    if(this.infoObj.isLoading || this.infoObj.isEnd) return;
  
    if(typeof keyword !== 'undefined'){
        this.filter[id] = keyword;	
    }else{
        this.filter[id] = '';
    }
    
    var param = {filter : _this.filter};
    param['page'] = this.infoObj.curPage;
    
    this.infoObj.isLoading = true;
    if(this.infoObj.refresh) {
        $('#'+this.selector).html(this.loading);
    } else {
        $('#'+this.selector).append(this.loading);
    }
    $.get(this.url, param, function(res){
        if(_this.infoObj.refresh) {
            _this.infoObj.data = res;
            _this.infoObj.refresh = false;
        } else {
            _this.combine(_this.infoObj.data.list, res.list)
        }
        _this.infoObj.isLoading = false;
        $('.loading').remove();
        _this.render(_this.scriptId, _this.selector);
        if(res.list.length <= 0) {
            _this.infoObj.isEnd = true;
            !_this.opts.hideText && $('#'+_this.selector).append(_this.nomore);
        } 
       
    }, 'json');
}
//    数组合并
Cdata.prototype.combine = function(arr1,arr2) {
    for(i = 0; i < arr2.length; i++) {
        arr1.push(arr2[i]);
    }
    return arr1;
}
Cdata.prototype.render =  function(id, container){
    var _this = this;
    var html = template(id, {data: _this.infoObj.data});
    $('#'+container).html(html);
    typeof this.opts.callback === 'function' && this.opts.callback();
}
Cdata.prototype.setId = function(id) {
    this.scriptId = id;
    return this;
}
