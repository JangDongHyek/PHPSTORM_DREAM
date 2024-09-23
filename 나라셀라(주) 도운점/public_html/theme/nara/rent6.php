<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_THEME_PATH.'/head.php');

$floor = 6;
?>

<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<style>
    div#sub_title {
        display: none;
    }
</style>

<section id="event" class="f6">

    <h1><span>6F DOWOON SPACE</span>대관 안내</h1>

	<div class="notice">
		<?php if( $is_member){ // 회원이라면 아래쪽에 내용 적용으로 노출 할 수 있습니다.?>
            <h6>※ 세부사항은 문의 부탁드립니다.</h6>
		<?php } else { // 로그인회원이 아니라면 아래쪽에 다른것로도 대체 가능합니다. ?>

            <h6>※ 로그인 시 대관 비용 확인이 가능하며 세부사항은 문의 부탁드립니다.</h6>
					<?php } ?>
            <h6><a href="https://www.instagram.com/the_dowoon/"><i class="fab fa-instagram"></i> the_dowoon</a></h6>
	</div>
	
	
<div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff" class="swiper mySwiper2 wow fadeInUp animated" data-wow-delay="0s" data-wow-duration="2s">
	<div class="swiper-wrapper">
		<div class="swiper-slide">
			<img src="<?php echo G5_THEME_IMG_URL ?>/sub/6r-1.jpg">
		</div>
		<div class="swiper-slide">
			<img src="<?php echo G5_THEME_IMG_URL ?>/sub/6r-2.jpg">
		</div>
		<div class="swiper-slide">
			<img src="<?php echo G5_THEME_IMG_URL ?>/sub/6r-3.jpg">
		</div>
		<div class="swiper-slide">
			<img src="<?php echo G5_THEME_IMG_URL ?>/sub/6r-4.jpg">
		</div>
		<div class="swiper-slide">
			<img src="<?php echo G5_THEME_IMG_URL ?>/sub/6r-5.jpg">
		</div>
		<div class="swiper-slide">
			<img src="<?php echo G5_THEME_IMG_URL ?>/sub/6r-6.jpg">
		</div>
		<div class="swiper-slide">
			<img src="<?php echo G5_THEME_IMG_URL ?>/sub/6r-7.jpg">
		</div>
		<div class="swiper-slide">
			<img src="<?php echo G5_THEME_IMG_URL ?>/sub/6r-8.jpg">
		</div>
		<div class="swiper-slide">
			<img src="<?php echo G5_THEME_IMG_URL ?>/sub/6r-9.jpg">
		</div>
		<div class="swiper-slide">
			<img src="<?php echo G5_THEME_IMG_URL ?>/sub/6r-10.jpg">
		</div>
	</div>
	<div class="swiper-button-next"></div>
	<div class="swiper-button-prev"></div>
</div>
<div thumbsslider="" class="swiper mySwiper">
	<div class="swiper-wrapper">
		<div class="swiper-slide">
			<img src="<?php echo G5_THEME_IMG_URL ?>/sub/6r-1.jpg">
		</div>
		<div class="swiper-slide">
			<img src="<?php echo G5_THEME_IMG_URL ?>/sub/6r-2.jpg">
		</div>
		<div class="swiper-slide">
			<img src="<?php echo G5_THEME_IMG_URL ?>/sub/6r-3.jpg">
		</div>
		<div class="swiper-slide">
			<img src="<?php echo G5_THEME_IMG_URL ?>/sub/6r-4.jpg">
		</div>
		<div class="swiper-slide">
			<img src="<?php echo G5_THEME_IMG_URL ?>/sub/6r-5.jpg">
		</div>
		<div class="swiper-slide">
			<img src="<?php echo G5_THEME_IMG_URL ?>/sub/6r-6.jpg">
		</div>
		<div class="swiper-slide">
			<img src="<?php echo G5_THEME_IMG_URL ?>/sub/6r-7.jpg">
		</div>
		<div class="swiper-slide">
			<img src="<?php echo G5_THEME_IMG_URL ?>/sub/6r-8.jpg">
		</div>
		<div class="swiper-slide">
			<img src="<?php echo G5_THEME_IMG_URL ?>/sub/6r-9.jpg">
		</div>
		<div class="swiper-slide">
			<img src="<?php echo G5_THEME_IMG_URL ?>/sub/6r-10.jpg">
		</div>
	</div>
</div>

<script>
var swiper = new Swiper(".mySwiper", {
  loop: true,
  spaceBetween: 10,
  slidesPerView: 4,
  freeMode: true,
  watchSlidesProgress: true,
});
var swiper2 = new Swiper(".mySwiper2", {
  loop: true,
	autoHeight : true,
  spaceBetween: 10,
  navigation: {
	nextEl: ".swiper-button-next",
	prevEl: ".swiper-button-prev",
  },
  thumbs: {
	swiper: swiper,
  },
});
</script>
<?php if( $is_member){ // 회원이라면 아래쪽에 내용 적용으로 노출 할 수 있습니다.?>
    <div class="table-wrap v2">
        <div class="table">
            <table class="eo_table">
                <tbody>
                    <tr>
                        <th colspan="5">
                            <p><strong>대관안내</strong></p>
                        </th>
                    </tr>
                    <tr>
                        <th class="bg1">
                            <p>시간</p>
                        </th>
                        <th class="bg1">
                            <p>금액</p>
                        </th>
                        <th class="bg1">
                            <p>운영시간</p>
                        </th>
                        <th class="bg1">
                            <p>최대 수용인원</p>
                        </th>
                        <th class="bg1">
                            <p>평수</p>
                        </th>
                    </tr>
					
                    <tr>
                        <td>
                            <p>3시간</p>
                        </td>
                        <td>
                            <p>90만원</p>
                        </td>
                        <td rowspan="3">
                            <p>10:00 ~ 22:00</p>
                        </td>
                        <td rowspan="3">
                            <p>12명<br>(좌석기준)</p>
                        </td>
                        <td rowspan="3">
                            <p>42평</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>6시간</p>
                        </td>
                        <td class="bright">
                            <p>180만원</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>12시간</p>
                        </td>
                        <td class="bright">
                            <p>250만원</p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="table-wrap v2">
        <div class="table">
            <table class="eo_table">
				<colgroup>
					<col width="25%">
					<col width="25%">
					<col width="25%">
					<col width="25%">
				</colgroup>
                <tbody>
                    <tr>
						<th colspan="4"><strong>구비물품</strong></th>
                    </tr>
                    <tr>
						<td>글라스 </td>
						<td>12개</td>
						<td>식기</td>
						<td>12인용</td>
                    </tr>
                    <tr>
						<td>테이블(12인용) </td>
						<td>1개</td>
						<td>의자</td>
						<td>12개</td>
                    </tr>
                    <tr>
						<td>50인치 TV </td>
						<td>1개</td>
						<td>갤럭시탭</td>
						<td>1개</td>
                    </tr>
                    <tr>
						<td>스피커</td>
						<td  colspan="3">1개</td>
                    </tr>
                </tbody>
			</table>
		</div>
	</div>
	
					<?php } else { // 로그인회원이 아니라면 아래쪽에 다른것로도 대체 가능합니다. ?>

					<?php } ?>
    <div class="text-wrap">
        <div>
			<h6>공지사항</h6>
			<p>
* 모든 가격은 VAT(10%) 별도입니다. <br>
* 구비 물품 외 사항은 별도 제공되지 않습니다.<br>
* 시간당 대여는 불가능 합니다. (3시간/6시간/12시간 옵션 선택)<br>
* 대관 시간은 공간 이용을 위한 준비 및 마무리 시간까지 포함입니다.<br>
* 세부적인 견적 및 문의 사항은 인스타 @the_dowoon DM or 02-543-1529 문의 바랍니다. 
	</p>
        </div>
        <div>
            <h6>주차 안내</h6>
            <p>주차장이 협소하여 주차가 불가능 하오니 주차가 필요하신 분은<br>
맞은편 선샤인 호텔 or 포포인츠 호텔 주차장을 이용 바랍니다.<br>
(카카오T or 모두의 주차장 어플 주차권 구매)<br>
* 발렛 가능여부 사전 문의 필수	
            </p>
		</div>
    </div>
    <!--text-wrap-->
    <? include_once("inc/rentFooter.php"); ?>

</section>

<?php
include_once(G5_PATH.'/tail.php');
?>