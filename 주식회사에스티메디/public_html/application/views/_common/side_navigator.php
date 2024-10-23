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
						<li class="gnb_1dli">
							<a href="<?=PROJECT_URL?>/medicinal/"  class="gnb_1da <?php if ($pid == 'index2') { echo 'new';} ?> ">의약품</a>
							<ul class="gnb_2dul">
								<li class="gnb_2dli"><a href="<?=PROJECT_URL?>/medicinal/" class="gnb_2da">의약품</a></li>
							</ul>
						</li>
						<li class="gnb_1dli">
							<a href="#" class="gnb_1da ">기획전</a>
							<ul class="gnb_2dul">
								<li class="gnb_2dli"><a href="#" onclick="showAlert('서비스 오픈 예정이에요!')" class="gnb_2da <?php if ($pid == 'event') { echo 'new';} ?>">기획전</a></li>
							</ul>
						</li>
						<li class="gnb_1dli">
							<a href=""  class="gnb_1da ">소모품</a>
							<ul class="gnb_2dul">
								<li class="gnb_2dli"><a href="#" onclick="showAlert('서비스 오픈 예정이에요!')"class="gnb_2da">소모품</a></li>
							</ul>
						</li>
						<li class="gnb_1dli">
							<a href=""  class="gnb_1da ">기구·기기</a>
							<ul class="gnb_2dul">
								<li class="gnb_2dli"><a href="#" onclick="showAlert('서비스 오픈 예정이에요!')"  class="gnb_2da">의료기구</a></li>
								<li class="gnb_2dli"><a href="#" onclick="showAlert('서비스 오픈 예정이에요!')" class="gnb_2da">의료준기구</a></li>
								<li class="gnb_2dli"><a href="#" onclick="showAlert('서비스 오픈 예정이에요!')" class="gnb_2da">의료기기</a></li>
							</ul>
						</li>
						<li class="gnb_1dli">
							<a href=""  class="gnb_1da ">그외</a>
							<ul class="gnb_2dul">
								<li class="gnb_2dli"><a href="#" onclick="showAlert('서비스 오픈 예정이에요!')" class="gnb_2da">위생재료</a></li>
								<li class="gnb_2dli"><a href="#" onclick="showAlert('서비스 오픈 예정이에요!')" class="gnb_2da">소독재료</a></li>
							</ul>
						</li>
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
		$("#navtoggle .gnb_1dli .gnb_1da").click(function(){
			var dp = $(this).siblings("ul.gnb_2dul").css("display");
			if(dp=="none"){
				$("#navtoggle .gnb_1dli .gnb_1da").removeClass("on");
				$(this).addClass("on");
				$("#navtoggle .gnb_1dli ul.gnb_2dul").slideUp(500);
				$(this).siblings("ul.gnb_2dul").slideDown(500);
			}
			if(dp=="block"){
				$("#navtoggle .gnb_1dli .gnb_1da").removeClass("on");
				$("#navtoggle .gnb_1dli ul.gnb_2dul").slideUp(500);
			}
			return false;
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
