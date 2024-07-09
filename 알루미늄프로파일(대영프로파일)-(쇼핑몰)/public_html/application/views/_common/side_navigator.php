<?php
$CI =& get_instance();
$member = $CI->session->userdata('member');
?>
<div class="hash hash-fade" id="snb">
	<div id="navtoggle">
		<div class="header">
			<a onclick="toggleSideNav(true)" class="close">
				<i class="fa-regular fa-close"></i>
			</a>
			<div class="hd_search">
				<form autocomplete="off" onsubmit="return mallCommonSearch(this)">
				<input type="search" name="hstx" placeholder="원하시는 제품을 검색하세요" value="<?=$_GET['hstx']?>">
				<button type="submit"><i class="fa-regular fa-magnifying-glass"></i></button>
				</form>
			</div>

			<div class="tnb">
				<?if(empty($member)){?>
				<a href="<?=PROJECT_URL?>/login"><i class="fa-light fa-power-off"></i> 로그인</a>
				<a href="<?=PROJECT_URL?>/signUp"><i class="fa-light fa-pen-to-square"></i> 회원가입</a>
				<a href="<?=PROJECT_URL?>/cart"><i class="fa-light fa-cart-shopping"></i> 장바구니</a>
				<a href="<?=PROJECT_URL?>/board"><i class="fa-light fa-headphones"></i> 고객센터</a>

				<?}else{?>
				<a href="<?=PROJECT_URL?>/logout"><i class="fa-light fa-power-off"></i> 로그아웃</a>
				<a href="<?=PROJECT_URL?>/cart"><i class="fa-light fa-cart-shopping"></i> 장바구니</a>
				<a href="<?=PROJECT_URL?>/order"><i class="fa-light fa-truck-fast"></i> 주문배송조회</a>
				<a href="<?=PROJECT_URL?>/board"><i class="fa-light fa-headphones"></i> 고객센터</a>
				<?}?>
			</div>

		</div>
		<div class="category">
			<div id="accordion-example" data-collapse="accordion">
				<div id="gnb" class="hd_div">
					<ul id="gnb_1dul">
                        <li class="gnb_1dli"><a href="<?=PROJECT_URL?>/greet" class="gnb_1da ">회사소개</a></li>
                        <li class="gnb_1dli">
                            <a href="<?=PROJECT_URL?>/medicinal"  class="gnb_1da new">제품소개</a>
                            <ul class="gnb_2dul">
                                <li class="gnb_2dli"><a href="<?=PROJECT_URL?>/medicinal" class="gnb_2da">20시리즈 프로파일</a></li>
                                <li class="gnb_2dli"><a href="<?=PROJECT_URL?>/medicinal" class="gnb_2da">30/60시리즈 프로파일</a></li>
                                <li class="gnb_2dli"><a href="<?=PROJECT_URL?>/medicinal" class="gnb_2da">35시리즈 프로파일</a></li>
                                <li class="gnb_2dli"><a href="<?=PROJECT_URL?>/medicinal" class="gnb_2da">40/80시리즈 프로파일</a></li>
                                <li class="gnb_2dli"><a href="<?=PROJECT_URL?>/medicinal" class="gnb_2da">45/90시리즈 프로파일</a></li>
                                <li class="gnb_2dli"><a href="<?=PROJECT_URL?>/medicinal" class="gnb_2da">50시리즈 프로파일</a></li>
                                <li class="gnb_2dli"><a href="<?=PROJECT_URL?>/medicinal" class="gnb_2da">도어 및 그 외 프로파일</a></li>
                                <li class="gnb_2dli"><a href="<?=PROJECT_URL?>/medicinal" class="gnb_2da">앵글</a></li>
                                <li class="gnb_2dli"><a href="<?=PROJECT_URL?>/medicinal" class="gnb_2da">덕트</a></li>
                                <li class="gnb_2dli"><a href="<?=PROJECT_URL?>/medicinal" class="gnb_2da">컨베이어 프레임</a></li>
                                <li class="gnb_2dli"><a href="<?=PROJECT_URL?>/medicinal" class="gnb_2da">캐스터</a></li>
                                <li class="gnb_2dli"><a href="<?=PROJECT_URL?>/medicinal" class="gnb_2da">우레탄 바퀴</a></li>
                                <li class="gnb_2dli"><a href="<?=PROJECT_URL?>/medicinal" class="gnb_2da">조절좌</a></li>
                                <li class="gnb_2dli"><a href="<?=PROJECT_URL?>/medicinal" class="gnb_2da">각종 볼트</a></li>
                                <li class="gnb_2dli"><a href="<?=PROJECT_URL?>/medicinal" class="gnb_2da">고객맞춤 결제</a></li>
                            </ul>

                        </li>
                        <li class="gnb_1dli"><a href="<?=PROJECT_URL?>/board/?cate=review" class="gnb_1da ">구매후기</a></li>
                        <li class="gnb_1dli"><a href="<?=PROJECT_URL?>/board/?cate=notice" class="gnb_1da ">공지사항</a></li>
                        <li class="gnb_1dli"><a href="<?=PROJECT_URL?>/order" class="gnb_1da ">마이페이지</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="bg bg-fade" onclick="toggleSideNav(true)"></div>
</div>

<script>
    $(document).ready(function() {
        // 모바일 트리메뉴 .gnb .d1 h3를 클릭
        $("#navtoggle .gnb_1dli .gnb_1da").click(function(e){
            var subMenu = $(this).siblings("ul.gnb_2dul");
            if(subMenu.length > 0) {
                var dp = subMenu.css("display");
                if(dp=="none"){
                    $("#navtoggle .gnb_1dli .gnb_1da").removeClass("on");
                    $(this).addClass("on");
                    $("#navtoggle .gnb_1dli ul.gnb_2dul").slideUp(500);
                    subMenu.slideDown(500);
                } else if(dp=="block"){
                    $(this).removeClass("on");
                    subMenu.slideUp(500);
                }
                e.preventDefault(); // Prevent default action only if there is a submenu
            }
        });
    });

    // 전체보기 on/off
    const toggleSideNav = (isClose) => {
        const snb = document.querySelector('#snb');
        if (isClose === true) {
            snb.classList.remove('transform-fade');
        } else {
            snb.classList.add('transform-fade');
        }
    }

</script>
