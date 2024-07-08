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
</div><!--//wrapper-->

<!-- } 콘텐츠 끝 -->

<hr>



<!-- 하단 시작 { -->
	<div id="ft_menu" class="col-md-12 hidden-xs">
    	<ul class="container">
        	<li><a href="<?php echo G5_URL ?>/bbs/content.php?co_id=greet01">회사소개</a></li>
            <li><a href="<?php echo G5_URL ?>/bbs/content.php?co_id=clean01">서비스소개</a></li>
            <li><a href="<?php echo G5_URL ?>/bbs/board.php?bo_table=case">시공사례</a></li>
        	<?php if ($is_member) {  ?>
            <?php if ($is_admin) {  ?>
            <li><a href="<?php echo G5_BBS_URL ?>/logout.php">로그아웃</a></li>
            <li class="last"><a href="<?php echo G5_ADMIN_URL ?>"><b>관리자</b></a></li>
            <?php }  ?>
            <?php } else {  ?>
            <li class="last"><a href="<?php echo G5_BBS_URL ?>/login.php">로그인</a></li>
            <?php }  ?>
        </ul>
    </div><!--foot_menu-->
	<div id="footer" class="col-xs-12 col-md-12">
    	<div class="container">
            <!-- address -->
			<address>
            	<h1><?php echo $config['cf_title']; ?></h1>
				<p><span><strong><?php echo $config['cf_1_subj']; ?></strong> <?php echo $config['cf_1']; ?></span> <span><strong><?php echo $config['cf_2_subj']; ?></strong> <?php echo $config['cf_2']; ?></span><span><strong><?php echo $config['cf_3_subj']; ?></strong> <?php echo $config['cf_3']; ?></span></p>
				<p><span><strong><?php echo $config['cf_4_subj']; ?></strong> <?php echo $config['cf_4']; ?></span> <span><strong><?php echo $config['cf_5_subj']; ?></strong> <?php echo $config['cf_5']; ?></span> <span><strong><?php echo $config['cf_6_subj']; ?></strong> <?php echo $config['cf_6']; ?></span><span><strong><?php echo $config['cf_7_subj']; ?></strong> <?php echo $config['cf_7']; ?></span> <span><strong><?php echo $config['cf_8_subj']; ?></strong> <?php echo $config['cf_8']; ?></span></p>
                <p><span><strong><?php echo $config['cf_9_subj']; ?></strong> <?php echo $config['cf_9']; ?></span> <span><strong><?php echo $config['cf_10_subj']; ?></strong> <?php echo $config['cf_10']; ?></span></p>
				<p class="co">COPYRIGHT(c) 2017 <strong>SNCLEAN</strong> ALL RIGHTS RESERVED</p>
			</address>	
			<!-- //address -->
        </div>
	</div><!--footer--> 
    
<!--스크롤시 나타나는 상하단버튼-->
<div id="gobtn">
	<a href="#hd" class="goHd"><span></span>브라우저 최상단으로 이동합니다</a><!--
	<a href="#footer" class="goFt"><span></span>브라우저 최하단으로 이동합니다</a>-->
</div>


<script>
$(function() {
    // 폰트 리사이즈 쿠키있으면 실행
    font_resize("container", get_cookie("ck_font_resize_rmv_class"), get_cookie("ck_font_resize_add_class"));
});
</script>

<?php
include_once(G5_PATH."/tail.sub.php");
?>