$(function(){
	var slideArr = [];
	function slide(){
		var slides = $(".do-element-swiper-content,.do-list-swiper");
		slides.each(function(i,v){
			var obj = $(this),
				Id = $(this).attr("id"),
				rows = parseInt(obj.attr("data-rows") || 1),
				phoneRows = parseInt(obj.attr("data-phonerows") || 1),
				initialSlide = parseInt(obj.attr("data-initialSlide") || 0),
				centeredSlides = obj.attr("data-centeredSlides") || false,
				slidesPerColumn = parseInt(obj.attr("data-slidesPerColumn") || 1),
				autoplay = obj.attr("data-autoplay") || false,
				isArrow = obj.attr("data-arrow") || false,
				objParent = obj.parent();

			if(!head.desktop){
				if(obj.attr("data-moff")){
					obj.removeClass("do-list-swiper")
					return;
				}
				rows = phoneRows;
			}

			obj.find(".do-element-media-ul").addClass("swiper-wrapper");
			obj.find(".do-element-media-li").addClass("swiper-slide");
			objParent.addClass("do-swiper");

			if(!objParent.find(".swiper-button-prev").length && !isArrow){
				if((head.browser.ie && head.browser.version <= 8)){
					obj.append('<div class="swiper-pagination"></div>');
					objParent.append('<div class="swiper-button-prev swiper-button-white"></div><div class="swiper-button-next swiper-button-white"></div>');
				}else{
					objParent.append('<div class="swiper-pagination"></div><div class="swiper-button-prev swiper-button-white"></div><div class="swiper-button-next swiper-button-white"></div>');
				}
			}
			if((head.browser.ie && head.browser.version <= 8)){
				var slideObj = {
					slidesPerView : rows,
					pagination: "#"+Id+" .swiper-pagination",
					paginationClickable: true,
					autoplay:autoplay
				    // loop:true
				}
				if(obj.hasClass("do-list-swiper")){
					slideObj.wrapperClass = "do-element-media-ul"
					slideObj.slideClass = "do-element-media-li"
				}

				slideArr[i] = new Swiper("#"+Id, slideObj);
				slideArr[i].rows = rows;
				objParent.find('.swiper-button-prev').on('click', function(e){
				    e.preventDefault()
				    slideArr[i].swipePrev()
			  	})
			  	objParent.find('.swiper-button-next').on('click', function(e){
				    e.preventDefault()
				    slideArr[i].swipeNext()
			  	})
			}else{
				var slideObj = {
					slidesPerView : rows,
					initialSlide:initialSlide,
            		centeredSlides:centeredSlides,
            		slidesPerColumn:slidesPerColumn,
					autoplay:autoplay,
					// loop:true,
					// lazyLoading: true,
					pagination: objParent.find(".swiper-pagination"),
					nextButton: objParent.find('.swiper-button-next'),
	                prevButton: objParent.find('.swiper-button-prev')
	            }

				if(obj.hasClass("do-list-swiper")){
					slideObj.wrapperClass = "do-element-media-ul"
					slideObj.slideClass = "do-element-media-li"
					slideObj.breakpoints = {
			            640: {
			                slidesPerView: parseInt(rows)==1 ? 1 : 2
			            },
			            320: {
			                slidesPerView: 1
			            }
					}
					// slideObj.onSlideChangeStart = function(swiper){
				 //    	console.log(swiper.slides[swiper.activeIndex])
				 //    }
				}
				slideArr[i] = new Swiper(obj,slideObj);
				slideArr[i].rows = rows;
			}
			
		});

		// //图文组件
  //       var swiper = [],isWidth=null;
  //       function doList(dom){
  //           $(".do-swiper").each(function(i,v){
  //           	if($(this).find(".do-list-swiper").length) return;
  //               var swObj = $(this).find(".do-element-media-content");
  //               if(!swObj.find(".swiper-button-prev").length) swObj.append('<div class="swiper-button-prev swiper-button-white"></div><div class="swiper-button-next swiper-button-white"></div>');
  //               swiper[i] = new Swiper(swObj, {
  //                   wrapperClass:'do-element-media-ul',
  //                   slideClass : 'do-element-media-li',
  //                   autoplay:3000,
  //                   // loop:true,
  //                   nextButton: swObj.find('.swiper-button-next'),
  //                   prevButton: swObj.find('.swiper-button-prev'),
  //               });

  //           }).on("touchmove",".do-list-help",function(){
  //               $(this).hide()
  //           })
  //       }
  //       function upSlide(num){
  //       	if(slideArr.length){
  //       		$.each(slideArr,function(i,v){
  //       			if(v.params.wrapperClass == "swiper-wrapper") return;
  //       			var rows = num ? num : v.rows;
  //       			v.params.slidesPerView = rows;
  //               	v.update({updateTranslate:true});
  //       		})
  //       	}
  //       }
  //       $(window).resize(function(){
  //           if(this.innerWidth<640){
  //               if(!isWidth){
  //                   doList();
  //                   upSlide(2);
  //               }
  //               isWidth=true;
  //           }else{
  //               if(isWidth && swiper.length){
  //                   $.each(swiper, function(i, n){
  //                       n.destroy(true,true);
  //                   });
  //                   swiper = [];
  //               }
  //               if(slideArr.length){
  //               	upSlide();
  //               }
  //               isWidth=null;
  //           }
  //       });
  //       if (bIsIphoneOs || bIsAndroid) { 
  //           doList();
  //           upSlide(2);
  //       }
  		// 产品详情
  		if($(".gallery-top").length){
  			var galleryTop = new Swiper('.gallery-top', {
		        nextButton: '.swiper-button-next',
		        prevButton: '.swiper-button-prev',
		        spaceBetween: 20,
		    });
		    var galleryThumbs = new Swiper('.gallery-thumbs', {
		        spaceBetween: 26,
		        centeredSlides: true,
		        slidesPerView: 'auto',
		        touchRatio: 0.2,
		        slideToClickedSlide: true
		    });
		    galleryTop.params.control = galleryThumbs;
		    galleryThumbs.params.control = galleryTop;
  		}
	}

	// head.ready(document, function() {
	// 	if((head.browser.ie && head.browser.version <= 8)){
	// 		head.load(["/Resource/Theme/Simple/js/swiper/idangerous.swiper.min.js","/Resource/Theme/Simple/js/swiper/idangerous.swiper.css"], function() {
	// 		    slide();
	// 		});
	// 	}else{
	// 		head.load("/Resource/Theme/Simple/js/swiper/swiper.min.js", function() {
	// 		    slide();
	// 		    if($(".do-list-swiper").length) upScrollLoading(".do-list-swiper .scrollLoading");
	// 		    if($(".do-element-slide").length) upScrollLoading(".do-element-slide .scrollLoading");
	// 		});
	// 	}
	// });

})
