<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/tail.php');
    return;
}
?>

</div><!--//wrapper-->

<!-- } 콘텐츠 끝 -->



<!-- 하단 시작 { -->
	<div id="footer" class="web">
        <div class="menu">
            <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=provision">서비스 이용약관</a>
            <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=privacy">개인정보처리방침</a>
        </div>
        <div class="copy">
            <span>사업장 주소 : 충청북도 청주시 상당로 249 , 206호</span>
            <span>사업자등록번호 : 771-18-01862</span>
            <span>대표자명 : 김민자</span>
            <span>대표번호 : 070-4006-7583</span>
        <p>COPYRIGHT(c)2022 LONG-RUN . ALL RIGHTS RESERVED.</p>
        </div>
        
	</div><!--footer-->



<script>
$(function() {
    // 폰트 리사이즈 쿠키있으면 실행
    font_resize("container", get_cookie("ck_font_resize_rmv_class"), get_cookie("ck_font_resize_add_class"));
});
</script>

<?php
include_once(G5_PATH."/tail.sub.php");
?>