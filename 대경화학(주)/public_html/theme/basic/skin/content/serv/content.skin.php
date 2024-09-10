<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$content_skin_url.'/style.css">', 0);
?>
<div id="serv">

        <article id="ctt" class="ctt_<?php echo $co_id; ?>">
            <header>
                <h1><?php echo $g5['title']; ?></h1>
            </header>

            <div id="ctt_con">
                <?php echo $str; ?>
            </div>

        </article>
    <!--<div class="inr area_top"></div>-->



    <!--<div class="area_point">
        <div class="inr">
            <h3>
                <span>현대이사몰을 선택 해야하는 이유</span>
                <p>현대이사몰 <strong>특장점 포인트</strong></p>
            </h3>
        <div class="flex">
            <dl><img src="<?/* echo G5_THEME_IMG_URL */?>/sub/serv_icon01.png"><dt>완벽한 포장서비스</dt><dd>장롱, 침대, 쇼파, 냉장고, 각종커버포장</dd></dl>
            <dl><img src="<?/* echo G5_THEME_IMG_URL */?>/sub/serv_icon02.png"><dt>정리정돈 청소 서비스</dt><dd>냉장고, 싱크대, 스팀청소 서비스</dd></dl>
            <dl><img src="<?/* echo G5_THEME_IMG_URL */?>/sub/serv_icon03.png"><dt>작업인원(5톤기준)</dt><dd>남자3명, 여자1명 (1급 전문캑커 배치)</dd></dl>
        </div>
        </div>
    </div>

    <div class="area_conts">
        <div class="inr">
        <h3>
            <span>MOVING SERVICE</span>
            <p><strong>이사서비스</strong> 상세내용</p>
        </h3>
        <div class="flex">
            <dl>
                <dt>포장서비스</dt>
                <dd>침대 매트리스</dd>
                <dd>가구, 가전 : 골게이트 및 커버포장</dd>
                <dd>이불, 의류 : 비닐포장 후 박스포장</dd>
                <dd>냉동, 냉장 식품 : 아이스박스 운반</dd>
                <dd>유리그릇 : 에어캡 포장</dd>
                <dd>포장박스 자채 대여</dd>
            </dl>
            <dl>
                <dt>정리서비스</dt>
                <dd>바닥 보호조치 후 이전 시작</dd>
                <dd>모든 이삿짐의 배치/정리정돈</dd>
                <dd>의류, 이불 정리 및 수납</dd>
                <dd>전자 제품 전원 연결</dd>
                <dd>큰가구/가전제품 배치서비스</dd>
                <dd>액자, 시계 등 부착물 부착</dd>
            </dl>
            <dl>
                <dt>청소서비스</dt>
                <dd>냉장고 내부청소</dd>
                <dd>방, 거실바닥 마무리 청소</dd>
                <dd>쓰레기처리(봉투고객준비)</dd>
            </dl>
            <dl>
                <dt>운송서비스</dt>
                <dd>바닥재를 이용한 이삿짐 보호</dd>
                <dd>탑차량을 이용한 안전하고 정확한 운반서비스</dd>
            </dl>
        </div>
        </div>
    </div>-->
</div>