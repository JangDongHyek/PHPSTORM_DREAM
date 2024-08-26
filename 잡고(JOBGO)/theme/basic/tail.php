<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
global $pid;
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

<!-- } 콘텐츠 끝 -->


<?php if ($is_private){?>
    <?php if (!$pid=='market_view'){?>
    <!--모바일 FIX 메뉴-->
    <div id="ft_menu">
        <ul>
            <li>
                <a href="<?php echo G5_URL ?>" class="<? if(defined('_INDEX_')){ echo 'txt_color';}?>">
                    <i class="fa-solid fa-house"></i><br />홈
                </a>
            </li>
            <li>
                <a href="<?php echo G5_URL ?>">
                    <i class="fa-solid fa-icons"></i><br />카테고리
                </a>
            </li>
            <li>
                <a href="<?php echo G5_BBS_URL ?>/pro_step01.php">
                    <i class="fa-solid fa-bell"></i><br />알림
                </a>
            </li>
            <li >
                <a href="<?php echo G5_BBS_URL ?>/message.php" class="<?php if($pid == "message"){ echo 'txt_color';}?>">
                    <i class="fa-sharp fa-solid fa-comments"></i><br />채팅 목록
                </a>
            </li>
            <li>
                <a href="<?php echo G5_BBS_URL ?>/mypage.php" class="<?php if($pid == "my_item"){ echo 'txt_color';}?>">
                    <i class="fa-solid fa-user"></i><br />마이잡고
                </a>
            </li>
        </ul>
    </div>
    <?php } else  /*market_view*/{?>
    <?php }?>
<?php } else  /*$is_private*/{?>
    <!--모바일 FIX 메뉴-->
    <div id="ft_menu">
        <ul>
            <li>
                <a href="<?php echo G5_URL ?>">
                    <img src="<?php echo G5_THEME_IMG_URL ?>/common/ft_menu01<?php if(defined('_INDEX_')){ echo "_on"; } ?>.png" alt=""><br />홈
                </a>
            </li>
            <li>
                <a href="<?php echo G5_URL ?>">
                    <img src="<?php echo G5_THEME_IMG_URL ?>/common/ft_menu02<?php if($sub_id == "category_list"){ echo "_on"; } ?>.png" alt=""><br />카테고리
                </a>
            </li>
            <li>
                <a href="<?php echo G5_BBS_URL ?>/pro_step01.php">
                    <i class="fal fa-plus"></i>
                </a>
            </li>
            <li>
                <a href="<?php echo G5_BBS_URL ?>/my_item.php?tab=3">
                    <img src="<?php echo G5_THEME_IMG_URL ?>/common/ft_menu03<?php if($sub_id == "push_list"){ echo "_on"; } ?>.png" alt=""><br />찜 목록
                </a>
            </li>
            <li>
                <a href="<?php echo G5_BBS_URL ?>/mypage.php">
                    <img src="<?php echo G5_THEME_IMG_URL ?>/common/ft_menu04<?php if($sub_id == "push_list"){ echo "_on"; } ?>.png" alt=""><br />마이잡고
                </a>
            </li>
        </ul>
    </div>
<?php }?>

<div id="cus">
	<div class="in cf">
		<div class="bx telVer">
			<p class="big"><?php echo $config['cf_4']; ?></p>
			<p>평일 10:00 - 18:00</p>
			<p>점심시간 12:00 - 13:00 (주말 제외)</p>
		</div>
		
		<div class="footer_in cf">
			<address>
            	<h2>상호 : <?php echo $config['cf_title']; ?></h2> 
				<p>
                <span><strong><?php echo $config['cf_1_subj']; ?></strong> <?php echo $config['cf_1']; ?></span>
                </p>
                <p>
                <span><strong><?php echo $config['cf_2_subj']; ?></strong> <?php echo $config['cf_2']; ?></span>
                <span><strong><?php echo $config['cf_3_subj']; ?></strong> <?php echo $config['cf_3']; ?></span>
                </p>
                <p>
                <span><strong><?php echo $config['cf_4_subj']; ?></strong> <?php echo $config['cf_4']; ?></span>
                <span><strong><?php echo $config['cf_5_subj']; ?></strong> <?php echo $config['cf_5']; ?></span>
                <span><strong><?php echo $config['cf_6_subj']; ?></strong> <?php echo $config['cf_6']; ?></span>
                <span><strong><?php echo $config['cf_7_subj']; ?></strong> <?php echo $config['cf_7']; ?></span>
                <span><strong><?php echo $config['cf_8_subj']; ?></strong> <?php echo $config['cf_8']; ?></span>
                <span><strong><?php echo $config['cf_9_subj']; ?></strong> <?php echo $config['cf_9']; ?></span>
                </p>
			</address>
        </div><!--.footer_in-->
		<div class="bx snsVer">
			<ul class="sns">
				<li><a href="https://blog.naver.com/jobgo2020" target="_blank" title="잡고 블로그"><img src="<?php echo G5_THEME_IMG_URL; ?>/common/ico_blog.jpg" alt="잡고 블로그" /></a></li>
				<li><a href="https://www.instagram.com/jobgo_2020/" target="_blank" title="잡고 인스타그램"><img src="<?php echo G5_THEME_IMG_URL; ?>/common/ico_insta.jpg" alt="잡고 인스타그램" /></a></li>
				<li><a href="https://pf.kakao.com/_eEWuK/56289082" target="_blank" title="잡고 카카오톡"><img src="<?php echo G5_THEME_IMG_URL; ?>/common/ico_kakao.jpg" alt="잡고 카카오톡" /></a></li>
				<li><a href="https://www.facebook.com/jobgo2020/" target="_blank" title="잡고 페이스북"><img src="<?php echo G5_THEME_IMG_URL; ?>/common/ico_face.jpg" alt="잡고 페이스북" /></a></li>
				<li>
					<a href="https://www.youtube.com/channel/UCYoxyZix4EQHA2E4VdrvGMQ" target="_blank"><img src="<?php echo G5_THEME_IMG_URL; ?>/common/ico_yt.jpg" alt="잡고 유튜브" /></a>
				</li>
			</ul>
		</div> 
		<div class="bx cusVer">
			<dl>
				<dt>잡고 고객센터</dt>
				<dd><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=b_notice">공지사항</a></dd>
				<dd><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=b_faq">자주묻는 질문</a></dd>
				<dd><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=b_use">잡고 이용안내</a></dd>
				<dd><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=b_qna">1:1 문의</a></dd>
			</dl>
			<dl>
				<dt class="sound_only">잡고 이용안내</dt>
				<dd><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=provision">서비스 이용약관</a></dd>
				<dd><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=privacy">개인정보처리방침</a></dd>
			</dl>
		</div>
</div>
    </div><!--cus-->
    
	<div id="footer">
        <div class="co">
		<h1><img src="<?php echo G5_THEME_IMG_URL ?>/common/logo.png" alt="로고"></h1> 
            잡고는 통신판매중개자이며 통신판매 당사자가 아닙니다. 따라서 서비스 관련 문의는 해당 전문가에게 해주시기 바랍니다.
            <p>COPYRIGHT(c) 2020 <?php echo $config['cf_title']; ?> ALL RIGHTS RESERVED.</p>
        </div>
<!-----Comodo SEAL Start---------->
<img src="https://www.ucert.co.kr/image/trustlogo/comodo_secure_113x59_white.png" width="113" height="59" align="absmiddle" border="0" style="cursor:pointer;" Onclick="javascript:window.open('https://www.ucert.co.kr/trustlogo/sseal_comodo.html?sealnum=917eefeed4551d6a&sealid=6ae438d732d97336d7e1d64f94454efb', 'mark', 'scrollbars=no, resizable=no, width=400, height=500');">
<!-----Comodo SEAL End---------->
	</div><!--#footer--> 

    

    
<!--스크롤시 나타나는 상하단버튼-->
<div id="gobtn">
	<a href="#hd" class="goHd"><img src="<?php echo G5_THEME_IMG_URL ?>/common/ar_top.png" alt="상단으로"></a>
	<a href="#footer" class="goFt"><img src="<?php echo G5_THEME_IMG_URL ?>/common/ar_bt.png" alt="하단으로"></a>
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