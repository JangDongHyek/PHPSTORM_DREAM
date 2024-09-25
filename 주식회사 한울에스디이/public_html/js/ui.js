$(document).ready(function () {

    $(".sidebar-dropdown > a").click(function() {
        $(".sidebar-submenu").slideUp(200);
        if (
            $(this)
                .parent()
                .hasClass("active")
        ) {
            $(".sidebar-dropdown").removeClass("active");
            $(this)
                .parent()
                .removeClass("active");
        } else {
            $(".sidebar-dropdown").removeClass("active");
            $(this)
                .next(".sidebar-submenu")
                .slideDown(200);
            $(this)
                .parent()
                .addClass("active");
        }
    });

    $("#close-sidebar").click(function() {
        $(".page-wrapper").removeClass("toggled");
    });
    $("#show-sidebar").click(function() {
        $(".page-wrapper").addClass("toggled");
    });

    //사이드바 
    var w = $(window).width();
    if(w < 950){
        $(".page-wrapper").removeClass("toggled");
    }


    //탭메뉴

    $('ul.tabs li').click(function(){
        var tab_id = $(this).attr('data-tab');

        $('ul.tabs li').removeClass('current');
        $('.tab-content').removeClass('current');

        $(this).addClass('current');
        $("#"+tab_id).addClass('current');
    })

});


//기본 bar그래프
document.addEventListener('DOMContentLoaded', function() {
    // 모든 .bar 요소를 선택
    const bars = document.querySelectorAll('.bar');

    bars.forEach(bar => {
    // data-percent 속성에서 퍼센트 값 가져오기
    const percent = bar.getAttribute('data-percent');

    // 퍼센트 값을 바의 너비로 설정
    bar.style.width = `${percent}%`;

    // .percent 요소는 bar 요소의 형제 요소로 설정
    const percentElement = bar.parentElement.nextElementSibling;
    if (percentElement && percentElement.classList.contains('percent')) {
    percentElement.textContent = `${percent}%`;
}
});
});
