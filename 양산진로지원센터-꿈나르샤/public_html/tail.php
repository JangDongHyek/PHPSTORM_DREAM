<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if(defined('G5_THEME_PATH')) {
    require_once(G5_THEME_PATH.'/tail.php');
    return;
}

if (G5_IS_MOBILE) {
    include_once(G5_MOBILE_PATH.'/tail.php');
    return;
}
?>
            </div> <!--#scont-->
        </div> <!--#scont_wrap-->
    </div>
</div>

<!-- } 콘텐츠 끝 -->

<hr>

<!-- 하단 시작 { -->

</div>




 


<div id="ft">

<div id="bottombanner">
	
          <div><? include 'roll_banner.htm'; ?></div>

 </div>
 
    <div id="ft_copy">
	
	
	

    		<div class="logo"><img src="<?php echo G5_IMG_URL ?>/logo2.gif" /></div>
            양산진로교육지원센터 <br />
            주소 : 경상남도 양산시 양주3길 40-13 (양주초등학교내 창의관 1층)<br />
            전화번호 : 055-785-0151   팩스 : 055-785-0152  E-mail : dreamfly0151@hanmail.net<br />
            COPYRIGHT(C) 2016. <span>양산진로교육지원센터</span>. ALL RIGHTS RESERVED.<br>
            <a href="#hd" id="ft_totop"><img src="<?php echo G5_IMG_URL ?>/btn_top.gif" border="0" /></a>
            <div class="itforone"><a href="http://itforone.co.kr/">유지보수 : IT FOR ONE</a></div>
    </div>
</div>

<!-- } 하단 끝 -->

<script>
$(function() {
    // 폰트 리사이즈 쿠키있으면 실행
    font_resize("container", get_cookie("ck_font_resize_rmv_class"), get_cookie("ck_font_resize_add_class"));
});
</script>

<?php
include_once(G5_PATH."/tail.sub.php");
?>