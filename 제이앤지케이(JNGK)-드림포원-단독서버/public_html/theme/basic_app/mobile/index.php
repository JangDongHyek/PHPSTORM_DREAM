<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

include_once(G5_THEME_MOBILE_PATH.'/head.php');

// 로그인 안되어있을 경우 로그인 페이지
if(!$is_member) {
    goto_url(G5_BBS_URL . '/login.php');
}

// 프로/팀장/관리자는 관리자페이지로 이동 ==> head.php가 goto_url 아래에 있으면 접속 시 화면 깨짐
if($member['mb_level'] == 10) {
    goto_url(G5_ADMIN_URL."/center_list.php");
}
else if($member['mb_level'] == 8 || $member['mb_level'] == 9) {
    goto_url(G5_ADMIN_URL."/member_list.php");
}

// get_cookie 확인
if($member['get_ck_mb_id'] != get_cookie('ck_mb_id') || $member['get_ck_auto'] != get_cookie('ck_auto')) {
    $sql = " update g5_member 
             set 
             get_ck_mb_id = '" . get_cookie('ck_mb_id') . "', 
             get_ck_auto = '" . get_cookie('ck_auto') . "', 
             get_ck_datetime = '" . G5_TIME_YMDHIS . "' 
             where mb_id = '{$member['mb_id']}' and use_yn = 'Y' ";
    sql_query($sql);
}
?>

<!--메인이미지-->
<div id="main">
	<div class="slogan">
    	<div class="sl01">JNGK 골프아카데미</div>
    	<div class="sl02">당신의 1:1 골프 레슨</div>
    	<div class="sl03">JNGK와 함께 골프 마스터가 되세요!</div>
        <a class="sl04"  href="<?php echo G5_BBS_URL ?>/lesson_reser.php">레슨예약바로가기</a>
    </div><!--.slogan-->
</div><!--#main-->

<!--메인아이콘-->
<div id="idx_main">
    <div class="idx_box01 idx_box"><a href="<?php echo G5_BBS_URL ?>/lesson_list.php">
    	<img src="<?php echo G5_THEME_IMG_URL ?>/app/micon01.png" alt="레슨정보" />
        <p>Lesson info</p>
        <div class="btit">레슨정보</div>
       </a>
    </div><!--.idx_box01-->
    <div class="idx_box02 idx_box"><a href="<?php echo G5_BBS_URL ?>/lesson_reser.php">
    	<img src="<?php echo G5_THEME_IMG_URL ?>/app/micon02.png" alt="레슨예약" />
        <p>Reservation</p>
        <div class="btit">레슨예약</div>
       </a>
    </div><!--.idx_box02-->
    <div class="idx_box03 idx_box">
    <a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=event2">
    	<img src="<?php echo G5_THEME_IMG_URL ?>/app/micon03.png" alt="제휴 이벤트" />
        <p>Event</p>
        <div class="btit">제휴 이벤트</div>
        </a>
    </div><!--.idx_box03-->
    <?php /*?><div class="idx_box03 idx_box"><a href="<?php echo G5_BBS_URL ?>/lesson_confirm.php">
    	<img src="<?php echo G5_THEME_IMG_URL ?>/app/micon03.png" alt="레슨예약확인" />
        <p>My Lesson</p>
        <div class="btit">레슨예약확인</div>
        </a>
    </div><?php */?>
    <div class="idx_box04 idx_box"><a href="<?php echo G5_BBS_URL ?>/family_site.php">
    	<img src="<?php echo G5_THEME_IMG_URL ?>/app/micon04.png" alt="패밀리사이트" />
        <p>Family Site</p>
        <div class="btit">아카데미 지점현황</div>
        </a>
    </div><!--.idx_box04-->
</div><!--#idx_main-->

<!--이벤트추출-->
<div id="idx_mbox">
    <div class="idxs_t">JNGK EVENT</div>
    <a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=event" class="btn_idxs">더보기</a>
    <div class="idx_scroll">
    	<?php echo latest('theme/gallery', 'event', 4, 30); ?>
    </div><!--.idx_scroll-->
</div><!--#idx_mbox-->

<div style="width:100%; height:1px; background:#eee;"></div>

<!--유튜부영상 추출-->
<div id="idx_mbox">
    <div class="idxs_t">JNGK 홍보영상</div>
    <a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=video" class="btn_idxs">더보기</a>
    <div class="idx_scroll">
    	<?php echo latest('theme/gallery_video', 'video', 4, 30); ?>
    </div><!--.idx_scroll-->
</div><!--#idx_mbox-->

<?php
include_once(G5_PATH.'/tail.php');
?>
