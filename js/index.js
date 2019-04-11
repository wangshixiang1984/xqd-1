$(function () {
    var indexSlider = $("#indexSlider").slideJ({
        speed: 400,
        time: 5000,
        autoplay: true,
        playtype: "opacity",
        triggerevent: "click",
        ishasimgtab: true,
        isloop: true
    });
});

(function ($) {
    var $window = $(window);
    $.fn.slideJ = function (options) {
        var defaults = {
            btnprev: "",
            btnnext: "",
            btnprevcss: "",
            btnnextcss: "",
            btnnextevent: null, //点击右键触发 （一般用于多图ajax请求）
            speed: 400,
            time: 4000,
            vertical: false,
            istoptobottom: false,//垂直滚动时，true：从上往下走；false:从下往上走
            playtype: "slide", //slide
            autoplay: true,
            ishasimgtab: false,
            ishovershow: false,//悬浮显示左右按钮
            triggerevent: "click",//缩略图
            lazyshowInfo: null,//触发的延迟加载的dom
            visible: 1,//slide时，可见图片数
            scroll: 1,//slide时，一次滚动图片数
            isloop: false, //图片是否循环展示
            showanimtime: 0,//图片出现时候的展现方式
            threadhold: 200
        }
        var opts = $.extend(defaults, options);
        var self = $(this),
			ullist = self.find("ul").eq(0),
			liitem = ullist.find(".HTSlider-imgitem") || "",
			liitemeq0 = liitem.eq(0),
			liitemeq1 = liitem.eq(1),
			autointerval,
			allimgnum = liitem.length || 0;
        if (liitem.length) liitem.eq(0).css({ "margin-left": "0", "margin-top": "0" })
        if (opts.btnprev) {
            $(opts.btnprev).off();
        }
        if (opts.btnnext) {
            $(opts.btnnext).off()
        }
        if (allimgnum <= opts.visible) { liitem.find("img").attr("islazyshow", "false"); return; }
        var prevcurrentnum = 0,
			currentnum = 0,
			scrollTag = 0,
			allheight = _heightcount(self, false),
			imgwidth = _widthcount(liitemeq0),
			imgheight = _heightcount(liitemeq0, false),
			marginwidth = _csscount(liitemeq1, 'marginLeft'),
			margintop = _csscount(liitemeq1, 'marginTop'),
			marginbottom = _csscount(liitemeq1, 'marginBottom');
        if (opts.istoptobottom) {
            currentnum = allimgnum - opts.visible;
            ullist.css("top", "-" + (currentnum * imgheight + (currentnum) * (margintop - marginbottom)) + "px");
        }
        active = false,
        isprevend = false, //是否最前
        isnextend = false; //是否最末

        var _init = function () {
            switch (opts.playtype) {
                case "opacity":
                    liitem.addClass("z0 pa").eq(0).removeClass("z0").addClass("z2");
                    break;
                case "slide":
                    if (!opts.vertical) {//水平
                        ullist.addClass("pa HTSlider-imglist").css("width", "99999px");
                    } else {//垂直
                        ullist.addClass("pa HTSlider-imglist").css("height", "99999px");
                    }
                    break;
                default:
            }

            if (opts.ishovershow) {
                self.on("mouseover", function () {
                    opts.btnprev.show(); opts.btnnext.show();
                }).on("mouseout", function () {
                    opts.btnprev.hide(); opts.btnnext.hide();
                });
            }

            if (opts.ishasimgtab) _setimgtab();

            if (opts.btnprev) {
                $(opts.btnprev).on("click", function () {
                    return _scrollleft();
                });
            }
            if (opts.btnnext) {
                $(opts.btnnext).on("click", function () {
                    return _scrollright();
                });
            }


            //对于延迟加载是否在可视区域的判定
            if (!_belowthefold(self) && self.is(":visible")) {//可视
                _autoGo()
                if (opts.istoptobottom) {
                    showfirstvisibleimg()
                } else {
                    _scrollto(0);
                }
            } else {//不可视
                if (!self.is(":visible")) {//隐藏
                    if (opts.lazyshowInfo && scrollTag == 0) {
                        _autoGo();
                        (opts["lazyshowInfo"].target).on(opts["lazyshowInfo"].event, extralazyevent)
                    }
                } else {//未隐藏
                    $window.on("scroll", function () {
                        if (scrollTag == 0) {
                            if (!_belowthefold(self)) {
                                scrollTag = 1;
                                _autoGo();
                                showfirstvisibleimg();
                            }
                        }
                    })
                }
            }
        }

        function _autoGo() {
            if (opts.autoplay) {//开始滚动
                _go("first");
                self.mouseover(function () {
                    clearTimeout(autointerval);
                }).mouseout(function () {
                    autointerval = setTimeout(function () { _go() }, opts.time);
                });
            }
        }

        function showfirstvisibleimg() {
            if (!opts.istoptobottom) {
                for (var i = 0; i < opts.visible; i++) {
                    liitem.eq(i).find("img").eq(0).trigger("nowshow").attr("islazyshow", "");
                }
            } else {
                for (var i = allimgnum - 1; i > allimgnum - 1 - opts.visible; i--) {
                    liitem.eq(i).find("img").eq(0).trigger("nowshow").attr("islazyshow", "");
                }
            }
        }

        function extralazyevent() {
            _scrollto(0);
            scrollTag = 1;
            (opts["lazyshowInfo"].target).off(opts["lazyshowInfo"].event, extralazyevent)
        }

        var _go = function (isfirst) {
            if (!isfirst) {
                if (opts.ishasimgtab) {//有缩略图，展示一张图片，一次滚动一次
                    currentnum == allimgnum - 1 ? currentnum = 0 : currentnum++;
                    _imgtabtragger(currentnum);
                } else {
                    if (opts.playtype == "slide") {
                        currentnum = _currentnumright();
                    } else if (opts.playtype == "opacity") {
                        currentnum == allimgnum - 1 ? currentnum = 0 : currentnum++;
                    }
                    //循环到最后一张停止
                    if (opts.isloop) {
                        _scrollto(currentnum);
                    } else {
                        _scrollto(currentnum);
                        if (currentnum + opts.visible == allimgnum) {
                            clearTimeout(autointerval);
                        }
                    }
                }
            }
            autointerval = setTimeout(function () { _go() }, opts.time)
        }

        var _setimgtab = function () {
            var _imgitem = liitem.find("img"),
				len = _imgitem.length,
				tabWidth = self.find(".HTSlider-tab").width(),
				_tabnav = self.find(".HTSlider-tab-nav"),
				imgtab = "";
            _imgitem.each(function () {
                var self = $(this),
					imgname = self.attr("alt") || "",
					smallSrc = self.attr("smallSrc") || "";
                url = self.attr("url") || "";
                imgDescribe = self.attr("imgDescribe") || "";
                imgtab += "<span class=\"inline-block HTSlider-tab-navitem\" title=\"" + imgname + "\"><img src=\"" + smallSrc + "\" alt=\"" + imgname + "\" /><a target=\"_blank\"  href=\"" + url + "\">" + imgDescribe + "</a></span>";
            });

            _tabnav.append(imgtab);
            var firstimgitem = liitem.first().find("img"),
				imgname = firstimgitem.attr("alt"),
				desc = firstimgitem.attr("desc");
            self.find(".HTSlider-tab-navitem").first().addClass("HTSlider-tab-navon");
            _tabnav.css({ "width": "381px", "left": "150px" });
            _tabnav.delegate(".HTSlider-tab-navitem", opts.triggerevent, function () { var _index = $(this).index(); _imgtabtragger(_index); currentnum = _index });
        }

        var _imgtabtragger = function (index) {
            var obj = $(".HTSlider-tab-navitem").eq(index);
            _navonClass = "";
            index < allimgnum ? _navonClass = "HTSlider-tab-navon" : _navonClass = "HTSlider-tab-navon HTSlider-tab-navon1";//不同index tab on的css定制
            obj.addClass(_navonClass).siblings().removeClass("HTSlider-tab-navon HTSlider-tab-navon1");
            obj.find("b").show();
            obj.siblings().find("b").hide();
            _scrollto(index);
        }

        //懒加载，绑定事件
        if (liitem.eq(0).find("img").hasClass("lazy")) {
            $.each(liitem.find("img"), function () {
                var $this = $(this);
                $this.one("nowshow", function () {
                    $this.hide();
                    $("<img />").bind("load", function () {
                        $this.attr("src", $this.attr("data-original"));
                        $this.show();
                    }).attr("src", $this.attr("data-original"));
                })
            })
        }

        var _scrollto = function (num) {
            var $tempimg = liitem.eq(num).find("img");
            if ($tempimg.attr("islazyshow") == "true") {//触发懒加载事件
                for (var i = 0; i < opts.scroll; i++) {
                    var $temp = liitem.eq(i + num).find("img").eq(0);
                    $temp.trigger("nowshow");
                    $tempimg.attr("islazyshow", "");
                }
            }
            if (opts.playtype == "opacity") {
                active = true;
                var _prevtemp = self.find(".z2"),
					_currentnum = _prevtemp.index();
                _prevprevtemp = self.find(".z1"),
                _currenttemp = liitem.eq(num);
                if (_currentnum == num) return;
                _prevtemp.removeClass("z0 z2").addClass("z1");
                _currenttemp.addClass("z2").removeClass("z0 z1").css({ opacity: 0 }).stop().animate({ opacity: 1 }, options.speed, function () { active = false });
                _prevprevtemp.removeClass("z1");
            } else if (opts.playtype == "slide") {
                if (!opts.vertical) { //水平
                    var marginwidthall = (num) * marginwidth;
                    ullist.stop(true).animate({
                        "left": "-" + (num * imgwidth + marginwidthall)
                    }, opts.animateTime);
                } else {//垂直
                    if (opts.showanimtime) {
                        liitem.eq(num).stop().css({ opacity: 0 }).animate({ opacity: 1 }, 3500);
                    }
                    var marginheightall = (num) * (margintop - marginbottom);
                    if (opts.istoptobottom) {
                        ullist.stop(true).animate({
                            "top": "-" + (num * imgheight + marginheightall)
                        }, opts.animateTime);
                    }
                }
            }
        }

        /*图片向左滑动时，取到currentnum的值
			param1: 是否点击向右按钮，true点击；区别是点击向右按钮按钮样式出现变化
		*/
        function _currentnumright(isrightclick) {
            var isrightclick = isrightclick || false;
            if (opts.isloop) {//循环
                if (opts.istoptobottom) {//垂直从上往下走
                    if (currentnum <= 0) {
                        currentnum = allimgnum - opts.visible;
                    } else {
                        currentnum -= opts.scroll
                    }
                } else {
                    if (currentnum + opts.visible >= allimgnum) {
                        currentnum = currentnum + opts.scroll - allimgnum;
                        if (currentnum < 0) currentnum = 0;
                    } else {
                        currentnum += opts.scroll
                    }
                }
            } else {//不循环
                if (currentnum + opts.visible >= allimgnum || currentnum + opts.scroll + opts.visible >= allimgnum) {//走到最右边了
                    if (currentnum + opts.scroll + opts.visible >= allimgnum) { if (isrightclick) { _setnextbtncss1(); _setprevbtncss0(); } }
                    currentnum = currentnum + opts.scroll - allimgnum;
                    if (currentnum <= 0) currentnum = allimgnum - opts.visible;
                } else {
                    if (isrightclick) { _setprevbtncss0() }
                    if (allimgnum % opts.scroll != 0) {//不能整除时候
                        if (allimgnum % opts.scroll + opts.scroll + currentnum == allimgnum) {
                            currentnum = allimgnum - opts.visible;
                            if (isrightclick) { _setnextbtncss1(); }
                        } else {
                            currentnum += opts.scroll;
                        }
                    } else {//可以整除
                        currentnum += opts.scroll;
                        if (currentnum + opts.visible >= allimgnum) {
                            currentnum = currentnum + opts.scroll - allimgnum;
                            if (currentnum <= 0) {
                                currentnum = allimgnum - opts.visible;
                                if (isrightclick) { _setnextbtncss1(); }//到最右边样式变化
                            }
                        }
                    }
                }
            }
            return currentnum;
        }

        function _currentnumleft(isleftclick) {
            if (opts.isloop) {//循环
                if (currentnum + opts.scroll - opts.scroll <= 0) {
                    currentnum = allimgnum - opts.visible;
                }

                else { currentnum = currentnum - opts.scroll }
            } else {
                if (currentnum - opts.scroll <= 0) {//到最前了
                    if (isleftclick) { _setprevbtncss1(); _setnextbtncss0() };
                    currentnum = 0;
                } else { currentnum = currentnum - opts.scroll; if (isleftclick) { _setnextbtncss0() } }
            }
            return currentnum;
        }

        function _csscount(el, prop) {
            return parseInt($.css(el[0], prop)) || 0;
        };

        function _widthcount(el) {
            return parseInt(el.outerWidth()) + _csscount(el, 'marginLeft') + _csscount(el, 'marginRight');
        };
        function _heightcount(el) {
            return parseInt(el.height()) + _csscount(el, 'marginTop') + _csscount(el, 'marginBottom');
        };

        function _setprevbtncss0() {
            if (opts.btnprevcss) { opts.btnprev.css(opts.btnprevcss[0]); }
        }
        function _setprevbtncss1() {//改变后
            if (opts.btnprevcss) { opts.btnprev.css(opts.btnprevcss[1]); }
        }
        function _setnextbtncss0() {
            if (opts.btnnextcss) { opts.btnnext.css(opts.btnnextcss[0]); }
        }
        function _setnextbtncss1() {
            if (opts.btnnextcss) opts.btnnext.css(opts.btnnextcss[1]);
        }

        function _scrollleft() {
            prevcurrentnum = currentnum;
            currentnum = _currentnumleft(true);
            _scrollto(currentnum, prevcurrentnum)
        }
        function _scrollright() {
            prevcurrentnum = currentnum;
            currentnum = _currentnumright(true);
            if (currentnum == prevcurrentnum && opts.btnnextcss.length == 3) {//到最后一轮数据触发
                window.open(opts.btnnextcss[2].url)
            };
            if (opts.btnnextevent) {//点击向右按钮触发事件。一般是ajax事件
                var $arr = [];
                //点击下一页时候，并且最新无图片
                console.log(currentnum)
                console.log(prevcurrentnum)
                console.log(liitem.eq(currentnum).find("img").length)
                if (currentnum > prevcurrentnum && (liitem.eq(currentnum).find("img").length == 0 || liitem.eq(allimgnum-1).find("img").length == 0)) {
                    for (var i = 0; i < opts.visible; i++) {
                        $arr.push(liitem.eq(currentnum + i))
                    }
                    opts.btnnextevent($arr, currentnum / 5 + 1);
                }
            }
            _scrollto(currentnum, prevcurrentnum)
        }
        function _belowthefold(element) {
            fold = (window.innerHeight ? window.innerHeight : $window.height()) + $window.scrollTop();
            return fold <= $(element).offset().top - opts.threadhold;
        }

        _init();

        return this;
    }
})(jQuery);

//加入收藏
function AddFavorite(sURL, sTitle) {   
            sURL = encodeURI(sURL);
			try{    
            window.external.addFavorite(sURL, sTitle);    
        }catch(e) {    
            try{    
                window.sidebar.addPanel(sTitle, sURL, "");    
            }catch (e) {    
                alert("请用快捷键Ctrl+D收藏"); 
  
            }    
        }       
}   