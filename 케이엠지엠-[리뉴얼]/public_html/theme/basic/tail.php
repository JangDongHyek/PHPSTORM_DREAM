<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/tail.php');
    return;
}
?>

            </div> <!--#scont-->
        </div> <!--#scont_wrap-->
	<? if(defined('_INDEX_')) {?>
    <!--메인컨테이너 부분-->
    </div><!--#container_index-->
    <? }else if($bo_table == "" || $co_id == ""){ ?>
    <!--서브컨테이너 부분-->
    </div><!--#container-->
	<? } ?> 
</div>

<!-- } 콘텐츠 끝 -->

<hr>



	<div id="footer">
        <div class="foot_menu">
        	<ul class="fm">
                <li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=greet01">회사소개</a></li> 
                <li><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=shop">지점안내</a></li>  
                <li><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=notice">공지사항</a></li>   
                <li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=greet02">약도</a></li>              
            </ul>
            <ul class="tnb cf">
                <!--<li><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=qna"><button data-toggle="tooltip" data-placement="bottom" title="온라인 상담"><i class="far fa-pen-square"></i></button></a></li>
                <li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=greet04"><button data-toggle="tooltip" data-placement="bottom" title="찾아오시는 길"><i class="far fa-map-marker-alt"></i></button></a></li>-->
                <?php if ($is_member) {  ?>
                <?php if ($is_admin) {  ?>
                <!--<li><a href="<?php echo G5_ADMIN_URL ?>" class="admin"><b>관리자</b></a></li>-->
                <?php }  ?>
                <li><a href="<?php echo G5_BBS_URL ?>/logout.php"><button data-toggle="tooltip" data-placement="bottom" title="로그아웃"><i class="fas fa-lock-open-alt"></i></button></a></li>
                <?php } else {  ?>
                <li><a href="<?php echo G5_BBS_URL ?>/login.php"><button data-toggle="tooltip" data-placement="bottom" title="관리자"><i class="fas fa-lock-alt"></i></button></a></li>
                <?php }  ?>
            </ul>
        </div>
    	<div class="footer_in cf">
			<address>
            	<h1><?php echo $config['cf_title']; ?></h1> 
				<p>
                <span><strong><?php echo $config['cf_1_subj']; ?></strong> <?php echo $config['cf_1']; ?></span>
                <span><strong><?php echo $config['cf_2_subj']; ?></strong> <?php echo $config['cf_2']; ?></span>
                <span><strong><?php echo $config['cf_3_subj']; ?></strong> <?php echo $config['cf_3']; ?></span>
                </p>
                <p>
                <span><strong><?php echo $config['cf_4_subj']; ?></strong> <?php echo $config['cf_4']; ?></span>
                <span><strong><?php echo $config['cf_5_subj']; ?></strong> <?php echo $config['cf_5']; ?></span>
                <span><strong><?php echo $config['cf_6_subj']; ?></strong> <?php echo $config['cf_6']; ?></span>
                <span><strong><?php echo $config['cf_7_subj']; ?></strong> <?php echo $config['cf_7']; ?></span>
                <span><strong><?php echo $config['cf_8_subj']; ?></strong> <?php echo $config['cf_8']; ?></span>
                </p>
                <p class="co">COPYRIGHT(c) 2020 <strong><?php echo $config['cf_title']; ?></strong> ALL RIGHTS RESERVED.</p>
			</address>
        </div><!--.footer_in-->
	</div><!--#footer--> 

    
<!--스크롤시 나타나는 상하단버튼-->
<div id="gobtn">
	<a href="#hd" class="goHd"><span></span>브라우저 최상단으로 이동합니다</a>
	<a href="#footer" class="goFt"><span></span>브라우저 최하단으로 이동합니다</a>
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