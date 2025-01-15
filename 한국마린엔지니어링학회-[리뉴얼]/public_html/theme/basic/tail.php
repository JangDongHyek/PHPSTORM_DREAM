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
                <li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=greet01">학회소개</a></li>
                <li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=mem01">입회안내</a></li>
                <li><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=greet05">임원안내</a></li>
                <li><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=notice">공지사항</a></li>
                <!--<li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=link" class="point">관련링크</a></li> -->             
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
                <div class="r_ban">
                	<a href="http://www.e-jamet.org/" target="_blank">학회지(JAMET) 바로가기</a>
                    <a href="https://mc04.manuscriptcentral.com/jamet" target="_blank">논문투고사이트</a>
                </div>
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