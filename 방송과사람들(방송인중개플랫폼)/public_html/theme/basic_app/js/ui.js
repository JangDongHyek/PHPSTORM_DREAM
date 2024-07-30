

$(document).ready(function() {
	subHeader();
	lnbFix();
	itemFix();

});



//subHeader
function subHeader(){
	if(($('.area_visual').length > 0)) return;
	$('#hd').attr('data-show','active');
	$('#footer').attr('data-show','active');
}


function lnbFix(){

	if ($(".lnb").length > 0) {
	// cache the element
		var $navBar = $('.lnb .inr');

		// find original navigation bar position
		var navPos = $navBar.offset().top;		

		// on scroll
		$(window).scroll(function() {

			// get scroll position from top of the page
			var scrollPos = $(this).scrollTop();

			// check if scroll position is >= the nav position
			if (scrollPos >= navPos) {
				$navBar.addClass('fixed');
			} else {
				$navBar.removeClass('fixed');
			}
		});
	}
}


function itemFix(){

	if ($(".item_right").length > 0) {
	// cache the element
		var $item = $('.item_right');

		// find original navigation bar position
		var itemPos = $item.offset().top;		

		// on scroll
		$(window).scroll(function() {

			// get scroll position from top of the page
			var scrollPos = $(this).scrollTop();

			// check if scroll position is >= the nav position
			if (scrollPos >= itemPos) {
				$item.addClass('fixed');
			} else {
				$item.removeClass('fixed');
			}
		});
	}
}


// lnb
$(function(){
	var sections = $('section[id^="area_"]')
	  , nav = $('.lnb');
	  //, nav_height = nav.outerHeight();

	$(window).on('scroll', function () {
		cur_pos = $(this).scrollTop();
	  
		sections.each(function() {
			var top = Math.floor($(this).offset().top)
			, bottom = top + $(this).outerHeight();

			if (cur_pos >= top && cur_pos <= bottom) {
				nav.find('a').removeClass('active');
				sections.removeClass('active');

				$(this).addClass('active');
				nav.find('a[href="#'+$(this).attr('id')+'"]').addClass('active');				
			}				
		});		
	});

	nav.find('a').on('click', function () {
		var $el = $(this)
		, id = $el.attr('href');
	  
		$('html, body').animate({
			scrollTop: Math.floor($(id).offset().top)
		}, 500);		
		
		if($(".mob").length > 0){
			var lnbLeft = $(this).offset().left
			$('.lnb > div').animate( { scrollLeft : lnbLeft }, 400 );	
			console.log(lnbLeft)
		}
	   //console.log(cur_pos);
	  return false;
	});
});

function lnbMobLeft(){
	if($(".lnb").length > 0){
		var lnbLeft = $('.lnb ul > li > a.active').offset().left
		$('.lnb > div').animate( { scrollLeft : lnbLeft }, 400 );		
		//console.log(lnbLeft);
	}
}


$(function(){
    var select = new CustomSelectBox('.select_box.v1');
    var select = new CustomSelectBox('.select_box.v2');
});

function CustomSelectBox(selector){
    this.$selectBox = null,
    this.$select = null,
    this.$list = null,
    this.$listLi = null;
    CustomSelectBox.prototype.init = function(selector){
        this.$selectBox = $(selector);
        this.$select = this.$selectBox.find('.box .select');
        this.$list = this.$selectBox.find('.box .list');
        this.$listLi = this.$list.children('li');
    }
    CustomSelectBox.prototype.initEvent = function(e){
        var that = this;
        this.$select.on('click', function(e){
            that.listOn();
        });
        this.$listLi.on('click', function(e){
            that.listSelect($(this));
        });
        $(document).on('click', function(e){
            that.listOff($(e.target));
        });
    }
    CustomSelectBox.prototype.listOn = function(){
        this.$selectBox.toggleClass('on');
        if(this.$selectBox.hasClass('on')){
            this.$list.css('display', 'block');
        }else{
            this.$list.css('display', 'none');
        };
    }
    CustomSelectBox.prototype.listSelect = function($target){
        $target.addClass('selected').siblings('li').removeClass('selected');
        this.$selectBox.removeClass('on');
        this.$select.text($target.text());
        this.$list.css('display', 'none');
        $('#he_category').val($target.text()); // 헬프미-질문하기-카테고리
        $('#co_category').val($target.text()); // 커뮤니티-글쓰기-카테고리
        $('#faq_category').val($target.text()); // 자주묻는질문-글쓰기-카테고리
    }
    CustomSelectBox.prototype.listOff = function($target){
        if(!$target.is(this.$select) && this.$selectBox.hasClass('on')){
            this.$selectBox.removeClass('on');
            this.$list.css('display', 'none');
        };
    }
    this.init(selector);
    this.initEvent();
}


