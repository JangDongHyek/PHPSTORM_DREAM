<nav id="navtoggle">
    <div class="hd_title">
        <button type="button" onclick="closeLeftMenu()"class="btn_close">
        <img src="<?php echo G5_THEME_IMG_URL ?>/common/hd_close.png"><span class="sound_only">닫기</span>
        </button>
    </div>
    <div class="scroll">
     <ul>
        <li>
            <ul id="hd_tnb" class="cf">
                <?php if ($is_member) { ?>
                <div class="mb_box">
                    <?php /*?><div class="mb_photo"><img src="<?php echo G5_THEME_IMG_URL ?>/app/wing_mb_noimg.png"></div><?php */?>
                    <div class="mb_info">
                        <p><strong><?php echo $member['mb_nick'] ?></strong> 님</p>
                        <a href="<?php echo G5_BBS_URL ?>/member_confirm.php?url=<?php echo G5_BBS_URL ?>/register_form.php" class="btn">프로필수정</a>
                        <a href="<?php echo G5_BBS_URL ?>/logout.php" class="btn">로그아웃</a>
                    </div>
                </div>
                <?php } else { ?>
                <a href="<?php echo G5_BBS_URL ?>/login.php">로그인 후, 이용해주세요</a><br />
                <a href="<?php echo G5_BBS_URL ?>/login.php" class="btn">로그인</a>
                <a href="<?php echo G5_BBS_URL ?>/register_form.php" class="btn">회원가입</a>
                <?php } ?>
            </ul>
          <!--메뉴-->
            <div id="gnb">
                <ul id="gnb_1dul">
                    <li class="gnb_1dli"><a class="gnb_1da" href="<?php echo G5_URL ?>/app/menu_info.php">메뉴안내</a></li>
                    <li class="gnb_1dli"><a class="gnb_1da" href="<?php echo G5_BBS_URL ?>/">주문하기</a></li>
					<?php if ($is_member) {  ?>
                    <li class="gnb_1dli"><a class="gnb_1da" href="<?php echo G5_BBS_URL ?>/">주문내역</a></li>
                    <?php }  ?>
                </ul>
                <ul id="gnb_1dul">
                    <li class="gnb_1dli"><a class="gnb_1da" href="<?php echo G5_BBS_URL ?>/">식단표</a></li>
                    <li class="gnb_1dli"><a class="gnb_1da" href="<?php echo G5_BBS_URL ?>/">공지사항</a></li>
                </ul>
                <ul id="gnb_1dul">
                    <li class="gnb_1dli"><a class="gnb_1da" href="<?php echo G5_BBS_URL ?>">어플문의사항</a></li>
                    <li class="gnb_1dli"><a class="gnb_1da" href="<?php echo G5_BBS_URL ?>">환경설정</a></li>
                </ul>
            </div>
          <!--//메뉴-->
        </li>
     </ul>
    <div id="ft_copy">
    	<div class="cus">
        	<p><?php echo $config['cf_title']; ?> 고객센터</p>
            <div class="call">051-746-9987</div>
            <div class="call">010-4906-6196</div>
            <span>평일 : 10:00~18:00</span>
        </div>
        <div id="ft_company">
        	부산광역시 해운대구 좌동 순환로 395 한라프라자 4층<br />
            사업자등록번호 : 330-79-00246</p>
            <a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=privacy">개인정보취급처리방침</a>
            <a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=provision">서비스이용약관</a>
        </div>
        (C)<b>JUNDOSIRAk</b>  All RIGHT RESERVED.<br>
    </div>
    </div>
</nav>
<div onclick="closeLeftMenu()" class="navbg"></div>