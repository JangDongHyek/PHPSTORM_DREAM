<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/tail.php');
    return;
}
?>
            </div><!--//container-->
    	</div><!--//row(부트)-->
    </div><!--//container(부트)-->
    
    <!--창업문의 하단에 들어가는 문구-->
	<? if($bo_table == "fran03"){ ?>
    <!--div class="fran03_txt">* 대표번호는 주문번호이니 가맹문의는 홈페이지내 창업문의 게시판에 글을 남겨주시면 순차적으로 담당자가 확인 후 연락드립니다.</div-->
    <? } ?>
    
</div><!--//wrapper-->

<!-- } 콘텐츠 끝 -->

<hr>

<!-- 하단 시작 { -->
	<div id="sns">
    	<!--a href=""><img src="<?php echo G5_THEME_IMG_URL ?>/common/ft_sns01.png" alt="페이스북"></a-->
    	<a href="https://www.instagram.com/60chicken/" target="_blank"><img src="<?php echo G5_THEME_IMG_URL ?>/common/ft_sns02.png" alt="인스타그램"></a>
    	<a href="https://blog.naver.com/60gye" target="_blank"><img src="<?php echo G5_THEME_IMG_URL ?>/common/ft_sns03.png" alt="네이버블로그"></a>
    	<!--a href=""><img src="<?php echo G5_THEME_IMG_URL ?>/common/ft_sns04.png" alt="카카오스토리"></a-->
		<a href="https://www.youtube.com/channel/UCXNmso1xB-gKWIqne25hfIA" target="_blank"><img src="<?php echo G5_THEME_IMG_URL ?>/common/ft_sns05.png" alt="유튜브"></a>
    </div>
	<div id="ft_menu" class="col-sm-12 hidden-xs">
    	<div class="container">
            <ul class="fs col-sm-9">
                <!--li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=company">소개</a></li>
                <li><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=faq">자주하는 질문</a></li-->
                <?php if ($is_member) {  ?>
                <?php if ($is_admin) {  ?>
                <li><a href="<?php echo G5_BBS_URL ?>/logout.php">로그아웃</a></li>
                <li><a href="<?php echo G5_ADMIN_URL ?>"><b>관리자</b></a></li>
                <?php }  ?>
                <?php } else {  ?>
                <li><a href="<?php echo G5_BBS_URL ?>/login.php">관리자</a></li>
                <?php }  ?>
                <li class="hidden-xs">
                <a href="javascript:;" onClick="window.open('<?php echo G5_THEME_URL ?>/origin.php','popup','resizable=no,width=500,height=705,scrollbars=no')">원산지</a></li>
                <li class="hidden-xs">
                <a href="javascript:;" onClick="window.open('<?php echo G5_THEME_URL ?>/al.php','popup2','resizable=no,width=740,height=850,scrollbars=no,left=700')">알레르기 성분</a></li>
                <li class="last hidden-xs">
                    <a href="javascript:;" onClick="window.open('<?php echo G5_THEME_URL ?>/agree.php','popup3','resizable=no,width=740,height=850,scrollbars=no,left=700')">개인정보처리방침</a></li>
            </ul>
            <div class="fs col-sm-3">
                <!--<select name="select" onchange="if(this.value) {window.open(value,'_blank')}" style="font:9pt;">
                    <option selected>리빙캐슬 지점안내</option>
                    <option>--------------------------------</option>
                    <option value="http://dhr.goldcastle1roomtel.com/">골드캐슬원룸텔 대학로점</option>
                </select> -->
            </div>
        </div>
    </div><!--foot_menu-->
	<div id="footer" class="col-xs-12 col-md-12">
    	<div class="container">
            <!-- address -->
			<address class="col-sm-12 col-xs-12">
            	<h1><img src="<?php echo G5_IMG_URL ?>/logo-g.png" alt="<?php echo $config['cf_title']; ?>"></h1>
				
				<p><span><strong><?php echo $config['cf_1_subj']; ?></strong> <?php echo $config['cf_1']; ?></span>
				<span><strong><?php echo $config['cf_2_subj']; ?></strong> <?php echo $config['cf_2']; ?></span>
				<span><strong><?php echo $config['cf_3_subj']; ?></strong> <?php echo $config['cf_3']; ?></span>
				<span><strong><?php echo $config['cf_4_subj']; ?></strong> <?php echo $config['cf_4']; ?></span></p>
                <p><span><strong><?php echo $config['cf_5_subj']; ?></strong> <?php echo $config['cf_5']; ?></span>
				<span><strong><?php echo $config['cf_6_subj']; ?></strong> <?php echo $config['cf_6']; ?></span>
                <span><strong><?php echo $config['cf_7_subj']; ?></strong> <?php echo $config['cf_7']; ?></span></p>
                <p><span><strong><?php echo $config['cf_8_subj']; ?></strong> <?php echo $config['cf_8']; ?></span></p>
                <p><span><strong><?php echo $config['cf_9_subj']; ?></strong> <?php echo $config['cf_9']; ?></span>
				<span><strong><?php echo $config['cf_10_subj']; ?></strong> <?php echo $config['cf_10']; ?></span></p>
                

				<p class="co">COPYRIGHT(c) 2017 <strong>60CHICHKEN</strong> ALL RIGHTS RESERVED</p>
			</address>	
            <div class="tel col-sm-6 hidden-xs text-rihgt">
            	<!--i class="fa fa-phone-square"></i> 1566-3366>
                <p>대표번호는 주문번호이니 가맹문의는 홈페이지내 <br />
                '창업문의' 게시판에 글을 남겨주시기 바랍니다.
                </p-->
            </div>
			<!-- //address -->
        </div>
	</div><!--footer--> 
    
</div><!--wrap--> 
   
<!--스크롤시 나타나는 상하단버튼-->
<div id="gobtn">
	<a href="#hd" class="goHd"><span></span>브라우저 최상단으로 이동합니다</a>
	<a href="#footer" class="goFt"><span></span>브라우저 최하단으로 이동합니다</a>
</div>

<?php
//24-06-14 업체 요청으로 인한 구글에널리틱스 중지 및 새로운버전으로 삽입
//    if ($config['cf_analytics']) {
//        echo $config['cf_analytics'];
//    }
?>

<script>
$(function() {
    // 폰트 리사이즈 쿠키있으면 실행
    font_resize("container", get_cookie("ck_font_resize_rmv_class"), get_cookie("ck_font_resize_add_class"));
});
</script>

<?php
include_once(G5_PATH."/tail.sub.php");
?>