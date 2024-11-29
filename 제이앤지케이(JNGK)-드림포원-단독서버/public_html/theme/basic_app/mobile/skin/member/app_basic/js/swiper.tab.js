$(window).on('scroll', function(){
    var scTop = $(window).scrollTop();
    var hTop = $('.top_gnb_wrap').height();
    if(scTop >= hTop){
        $('.top_gnb_wrap').addClass('on');
        $('#container').css('padding-top', '28px');
    }else{
        $('.top_gnb_wrap').removeClass('on');
        $('#container').css('padding-top', 0);
    }
});

// 스와이프 메뉴
var main_swiper = new Swiper('.main-swiper', {
    autoHeight: true,
    threshold: 80,
    onInit: function(swiper){
    },
    onSlideChangeStart: function(swiper){
        $('.top_gnb_wrap a').removeClass('on');
        $('.top_gnb_wrap a').eq(swiper.activeIndex).addClass('on');
        $('html,body').scrollTop(0);
    }
});
$('.top_gnb_wrap a').on('click', function(){
    var gNum = $('.top_gnb_wrap a').index(this);
    main_swiper.slideTo( gNum );
    $('.top_gnb_wrap a').removeClass('on');
    $(this).addClass('on');
    $('html,body').scrollTop(0);
    return false;
});

