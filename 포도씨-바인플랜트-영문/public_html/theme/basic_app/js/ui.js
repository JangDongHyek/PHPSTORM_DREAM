
$(document).ready(function() {
	mainSlider();
	productSlider();
	companySlider();
	schTab();
	subHeader();
});


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


//work tab
$(document).ready(function() {
	$("#area_main .tab_content").hide();
	$("#area_main .tab_content:first").show();

	$("#area_main ul.tabs li").click(function () {
		if(!($(this).find('a').length > 0)){
			$("#area_main ul.tabs li").removeClass("active");
			$(this).addClass("active");
			$("#area_main .tab_content").hide()
			var activeTab = $(this).attr("rel");
			$("#" + activeTab).fadeIn()
		}
	});
});

//sch tab
function schTab(){ 
	if(!($('#area_search .area_bottom').length > 0)) return;
	$("#area_search .tab_box").hide();
	$("#area_search .tab_box:first").show();

	$("#area_search ul.tab_menu li").click(function () {
		if(!($(this).find('a').length > 0)){
			$("#area_search ul.tab_menu li").removeClass("active");
			$(this).addClass("active");
			$("#area_search .tab_box").hide()
			var activeTab = $(this).attr("rel");
			$("#" + activeTab).fadeIn()
		}
	});
}

function mainSlider(){ 
	if(!($('#area_main .swiper-wrapper').length > 0)) return;
	 var swiper = new Swiper(".mainSwiper", {
		
		navigation: {
		  nextEl: "#area_main .swiper-button-next",
		  prevEl: "#area_main .swiper-button-prev",
		},
	  });
}
function productSlider(){
	if(!($('#helpme .swiper-container').length > 0)) return;
	var swiper = new Swiper('#helpme .swiper-container', {
		loop:false,
		autoplay: {
		  delay: 5000,
		  disableOnInteraction: false,
		},
		slidesPerView: 1,
		spaceBetween: 0,
		navigation: {
			nextEl: '#helpme .swiper-button-next',
			prevEl: '#helpme .swiper-button-prev',
      },
		breakpoints: {
			1400: {
				slidesPerView: 4,
				spaceBetween: 30,
			},
			950: {
				slidesPerView: 4,
				spaceBetween: 20,
			},
			768: {
				slidesPerView: 3,
				spaceBetween: 20,
			},
			550: {
				slidesPerView: 2,
				spaceBetween: 15,
			},
			400: {
				slidesPerView: 2,
				spaceBetween: 10,
			},
		}
    });
}

function companySlider(){
	if(!($('#helpme.company .swiper-container').length > 0)) return;
	var swiper = new Swiper('#helpme.company .swiper-container', {
		loop:false,
		autoplay: {
		  delay: 3500,
		  disableOnInteraction: false,
		},
		slidesPerView: 1,
		spaceBetween: 0,
		navigation: {
			nextEl: '#helpme.company .swiper-button-next',
			prevEl: '#helpme.company .swiper-button-prev',
      },
		breakpoints: {
			1400: {
				slidesPerView: 4,
				spaceBetween: 30,
			},
			950: {
				slidesPerView: 4,
				spaceBetween: 20,
			},
			768: {
				slidesPerView: 3,
				spaceBetween: 20,
			},
			550: {
				slidesPerView: 2,
				spaceBetween: 15,
			},
			400: {
				slidesPerView: 2,
				spaceBetween: 10,
			},
		}
    });
}


$(function(){
	$('.hd_sch, #area_search.sch .btn_close').on('click',function(){
			$('body').toggleClass('active');
			$('#area_search.sch').toggleClass('active');
			return false;
	});
});

$(function(){
	$('#area_filter, #area_search.filter .btn_close').on('click',function(){
			$(this).toggleClass("active");
			$('#area_search.filter').toggleClass('active');
			return false;
	});
});


//subHeader
function subHeader(){
	if(($('#area_main').length > 0)) return;
	$('#ft_copy').attr('data-show','active');
}
