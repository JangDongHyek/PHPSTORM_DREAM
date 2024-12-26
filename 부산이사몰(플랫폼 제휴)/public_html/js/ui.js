$(document).ready(function () {

    //상하단바로가기 버튼
    $('#gobtn .gohd').on('click', function (e) {
        e.preventDefault();
        $('html, body').animate({scrollTop: 0}, '300');
    });

    // 페이지 스크롤 시 Go 버튼의 투명도 조절
    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            $('.gohd').addClass('header_scroll');
        } else {
            $('.gohd').removeClass('header_scroll');
        }
    });

    //상단 고정
    $(document).ready(function () {
        var header = $("header#hd");
        var headerOffset = header.offset().top;

        $(window).scroll(function () {
            var scrollPos = $(window).scrollTop();

            if (scrollPos > headerOffset) {
                header.addClass("fixed");
            } else {
                header.removeClass("fixed");
            }
        });
    });


    //상단메뉴
    $('#gnb .depth1 > li').hover(
        function () {
            $(this).find('.depth2-wrapper').stop(true, true).slideDown(200);
        },
        function () {
            $(this).find('.depth2-wrapper').stop(true, true).slideUp(200);
        }
    );

    //메인 배너
    var swiper = new Swiper(".mainSwiper", {
        slidesPerView: 1,
        spaceBetween: 0,
        loop: true,
        autoplay: {
            delay: 4000,
            disableOnInteraction: false,
        },
        pagination: {
            el: ".swiper-pagination",
            type: "fraction",
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    });


    //관리자 사이드바
    $(".sidebar-dropdown > a").click(function () {
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

    $("#close-sidebar").click(function () {
        $(".page-wrapper").removeClass("toggled");
    });
    $("#show-sidebar").click(function () {
        $(".page-wrapper").addClass("toggled");
    });

    //사이드바
    var w = $(window).width();
    if (w < 950) {
        $(".page-wrapper").removeClass("toggled");
    }


    //찜하기
    if (document.getElementById('heartIcon')) {
        document.getElementById('heartIcon').addEventListener('click', function () {
            this.classList.toggle('active');
        });
    }

    //서비스 더보기
    if (document.querySelector('button[name="btnToggle"]')) {
        document.querySelector('button[name="btnToggle"]').addEventListener('click', function () {
            const details = document.querySelector('.details');
            const button = this;

            // Toggle the 'expanded' class
            if (details.classList.contains('expanded')) {
                details.classList.remove('expanded');
                button.innerHTML = '서비스 자세히 보기 <i class="fa-light fa-angle-down"></i>';
                details.style.height = '600px';
            } else {
                details.classList.add('expanded');
                button.innerHTML = '서비스 접기 <i class="fa-light fa-angle-up"></i>';
                details.style.height = details.scrollHeight + 'px';
            }
        });
    }


});

