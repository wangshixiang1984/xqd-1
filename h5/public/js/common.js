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