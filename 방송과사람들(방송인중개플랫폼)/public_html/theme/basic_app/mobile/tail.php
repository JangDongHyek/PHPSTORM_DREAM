<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가


?>
    </div>
</div>

<!--스크롤시 나타나는 상하단버튼-->
<div id="gobtn">
	<a href="#hd" class="goHd"><span class="sound_only">브라우저 최상단으로 이동합니다</span></a>
</div>
<script>
$(document).ready(function(){
	$("#gobtn").hide();

	// fade in #back-top
	$(function () {
		$(window).scroll(function () {
			if ($(this).scrollTop() > 50) {
				$('#gobtn').fadeIn();
			} else {
				$('#gobtn').fadeOut();
			}
		});
	});

	   $('.goHd').click(function($e){
	   $('html, body').animate({scrollTop:0}); return false
	 });
});
</script>


<div id="ft_copy">

	<div class="inr">
		<div class="area_cs">
			<h3>고객센터</h3>
			<h4>1234-5678</h4>
			<ul class="cs_info">
				<li>평일 10:00 - 18:00 (주말, 공휴일 제외)</li>
				<li>help@naver.com</li>
			</ul>
		</div>
		<ul class="ft_menu">
			<li>
				<h2>방송과 사람들</h2>
				<!--ul class="ft_mlist">
					<li><a href="">회사소개</a></li>
				</ul-->
			</li>
			<li>
				<h2>서비스 약관</h2>
				<ul class="ft_mlist">
					<li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=privacy">개인정보 처리방침</a></li>
					<li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=provision">서비스 이용약관</a></li>
					<li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=provision">오픈소스 라이센스</a></li>
				</ul>
			</li>
			<li>
				<h2>고객센터</h2>
				<ul class="ft_mlist">
					<li><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=notice">공지사항</a></li>
                    <li><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=faq">자주찾는질문</a></li>
                    <?php if($is_admin) { ?>
                        <li><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=qna">1:1 문의</a></li>
                    <?php } else { ?>
                        <li><a href="<?php echo G5_BBS_URL ?>/write.php?bo_table=qna">1:1 문의</a></li>
                    <?php } ?>
				</ul>
			</li>
		</ul>
        <div class="flex">
            <a href="" target="_blank"><i class="fa-brands fa-apple"></i> App Store</a>
            <a href="" target="_blank"><i class="fa-brands fa-google-play"></i> Google Play</a>
        </div>
		<address>
		<span>방송과사람</span><span>부산시 센텀동로 99</span>
		<span class="tel">전화번호 <a href="tel:031-355-5819">031-355-5819</a></span>
		<span>FAX<a href="tel:031-355-1634">031-355-1634</a></span>
		<span>사업자번호 143-88-00469</span>
		<span>제휴문의 이메일 <!-- master@sunmibakery.co.kr -->bspcompany1@naver.com</span>
		<div class="copy">© 2022 방송과사람 All Rights Reserved.</div>
		</address>
    </div>

</div><!--#ft_copy-->



<div id="ft">
	<?
    $teaa = "aaa";
	$ft_menu = array();
	$ft_menu['home'] = array('name'=>'카테고리', 'url'=>G5_URL.'/index.php', 'on'=>'/app/ft_icon01_on.svg', 'off'=>'/app/ft_icon01.svg');
	$ft_menu['sale'] = array('name'=>'찜목록', 'url'=>G5_BBS_URL.'/help_list.php', 'on'=>'/app/ft_icon02_on.svg', 'off'=>'/app/ft_icon02.svg');
	$ft_menu['buy'] = array('name'=>'홈', 'url'=>G5_URL.'/index.php', 'on'=>'/app/ft_icon03_on.svg', 'off'=>'/app/ft_icon03.svg');
	$ft_menu['career'] = array('name'=>'검색', 'url'=>G5_BBS_URL.'/career.php', 'on'=>'/app/ft_icon04_on.svg', 'off'=>'/app/ft_icon04.svg');
    if($member['mb_category'] == '기업') $my_url = G5_BBS_URL.'/mypage_company.php';
    if($member['mb_category'] == '일반') $my_url = G5_BBS_URL.'/mypage.php';
	$ft_menu['my'] = array('name'=>'마이메뉴', 'url'=>$my_url, 'on'=>'/app/ft_icon05_on.svg', 'off'=>'/app/ft_icon05.svg');
	$ft_menu['my']['url'] = ($is_member)? G5_BBS_URL."/store.php" : G5_BBS_URL."/login.php?url=".G5_BBS_URL."/store.php"; ///register_form.php?w=u


	?>
	<div id="ft_menu">
		
		
    	<ul>
		
			<li><a href="#hash-menu" id="hash_menu" data-role="button" data-url="<?php echo G5_PLUGIN_URL;?>/hash/" data-ref="1" data-animation="left"><img src="<?php echo G5_THEME_IMG_URL; ?>/app/ft_icon01.svg" /><p>메뉴</p></a></li>
        	<li class="<?php if($pid=='mypage_jjim') echo 'on'?>">
                <a href="<?php echo G5_BBS_URL; ?>/mypage_jjim.php">
                    <img src="<?php echo G5_THEME_IMG_URL; ?>/app/ft_icon02.svg" class="icon_off" />
                    <img src="<?php echo G5_THEME_IMG_URL; ?>/app/ft_icon02_on.svg" class="icon_on" />
                    <p>찜 목록</p>
                </a></li>
        	<li class="<?php if(defined('_INDEX_')) echo  'on'?>">
                <a href="<?php echo G5_URL; ?>/index.php">
                    <img src="<?php echo G5_THEME_IMG_URL; ?>/app/ft_icon03.svg" class="icon_off" />
                    <img src="<?php echo G5_THEME_IMG_URL; ?>/app/ft_icon03_on.svg" class="icon_on" />
                    <p>홈</p></a></li>
            <li class="<?php if($pid=='chat') echo 'on'?>">
                <a href="<?php echo G5_BBS_URL; ?>/chat_list.php">
                    <img src="<?php echo G5_THEME_IMG_URL; ?>/app/ft_icon07.svg" class="icon_off" />
                    <img src="<?php echo G5_THEME_IMG_URL; ?>/app/ft_icon07_on.svg" class="icon_on" />
                    <p>채팅</p>
                </a></li>
        	<!--<li><a href="#hash-search" id="hash_search" data-role="button" data-url="<?php /*echo G5_PLUGIN_URL;*/?>/hash/" data-ref="1" data-animation="left"><img src="<?php /*echo G5_THEME_IMG_URL; */?>/app/ft_icon04.svg" /><p>검색</p></a></li>-->
			<?php if ($is_member) {  ?>
            <li class="<?php if($pid=='mypage') echo 'on'?>"><a href="<?php echo G5_BBS_URL; ?>/mypage.php">
                    <img src="<?php echo G5_THEME_IMG_URL; ?>/app/ft_icon05.svg" class="icon_off" />
                    <img src="<?php echo G5_THEME_IMG_URL; ?>/app/ft_icon05_on.svg" class="icon_on" />
                    <p>마이 프로필</p></a></li>
            <?php } else {  ?>
            <li class="<?php if($pid=='mypage') echo 'on'?>"><a href="<?php echo G5_BBS_URL; ?>/login.php">
                    <img src="<?php echo G5_THEME_IMG_URL; ?>/app/ft_icon05.svg" class="icon_off" />
                    <img src="<?php echo G5_THEME_IMG_URL; ?>/app/ft_icon05_on.svg" class="icon_on" />
                    <p>로그인</p></a></li>
            <?php }  ?>
        </ul>
		<!-- class on 추가 
		<ul>			
			<li class="on"><a href="<?php echo G5_URL; ?>/index.php"><img src="<?php echo G5_THEME_IMG_URL; ?>/app/ft_icon01_on.svg" /><p>홈</p></a></li>
			<li class="on"><a href="<?php echo G5_BBS_URL; ?>/sale.php"><img src="<?php echo G5_THEME_IMG_URL; ?>/app/ft_icon03_on.svg" /><p>팝니다</p ></a></li>
        	<li class="on"><a href="<?php echo G5_BBS_URL; ?>/buy.php"><img src="<?php echo G5_THEME_IMG_URL; ?>/app/ft_icon04_on.svg" /><p>삽니다</p></a></li>	
        	<li class="on"><a href="<?php echo G5_BBS_URL; ?>/company.php"><img src="<?php echo G5_THEME_IMG_URL; ?>/app/ft_icon06_on.svg" /><p>협력업체</p></a></li>	
        	<li class="on"><a href="<?php echo G5_BBS_URL; ?>/login.php"><img src="<?php echo G5_THEME_IMG_URL; ?>/app/ft_icon05_on.svg" /><p>마이메뉴</p></a></li>
        </ul>
		 //class on 추가 -->
	
    </div>
</div>

<?php
if(G5_DEVICE_BUTTON_DISPLAY && G5_IS_MOBILE) { ?>
<?php
}

if ($config['cf_analytics']) {
    echo $config['cf_analytics'];
}
?>

<script>
function insert_modal(){

		$("#myModal").modal();

}
$(function() {
    // 폰트 리사이즈 쿠키있으면 실행
    font_resize("container", get_cookie("ck_font_resize_rmv_class"), get_cookie("ck_font_resize_add_class"));
});
</script>

<?php
include_once(G5_BBS_PATH . '/ajax_get_page.php'); // 페이징
include_once(G5_THEME_PATH."/tail.sub.php");
?>