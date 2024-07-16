<link rel="stylesheet" href="<?php echo G5_PLUGIN_URL;?>/hash/style.css">


<div id="hash_wrap" style="z-index:9999">
	<div class="hd_wrap">
        <div id="hd_title">
			<div class="bacK">
				<img class="hash-close" src="<?php echo G5_THEME_IMG_URL ?>/common/icon_close.png" onclick="history.back();">
			</div>
        </div><!--//hd_title-->

        <div id="hd_tnb">
            <? 
			if ($is_member) { 
				if(file_exists(G5_DATA_PATH."/member/".$member[mb_photo])&&$member[mb_photo]){
					$mb_photo=G5_DATA_URL."/member/".$member[mb_photo];
				}else{
					$mb_photo=G5_THEME_URL."/img/no_image.jpg";
				}
			?>
			<div class="mb">
				<a href="<?=G5_BBS_URL?>/register_form.php?w=u&mb_id=<?=$member['mb_id']?>">
					<div class="photo"><img src="<?=$mb_photo?>" class="noimg"></div>
				</a>
				<div class="info">
					<p><?=$member["mb_name"]?>&nbsp;<span><?=$grade_list[$member['mb_level']]?></span><a href="<?php echo G5_BBS_URL ?>/logout.php" class="btn">로그아웃</a></p>
					<p class="mileage">
						<a href="<?=G5_BBS_URL?>/register_form.php?w=u&mb_id=<?=$member['mb_id']?>"><i class="fas fa-pen-square"></i>&nbsp;정보수정</a>
					</p>
				</div>
			</div>

            <? } else { ?>
			<div class="login">
			<!--<img src="<?php echo G5_IMG_URL ?>/logo.png" alt="<?php echo $config['cf_title']; ?>"> -->
			<a href="<?php echo G5_BBS_URL ?>/login.php"><span style="font-weight:500; color:#000000;">로그인</span>로그인이 필요합니다.</a> <a href="<?php echo G5_BBS_URL ?>/register_lang.php" class="btn">회원가입</a>
			</div>
            <?php } ?>
        </div>
    </div>

    <div class="scroll">
        <nav id="navtoggle">
        	<ul>
                <? 
				if ($is_member) {
				?>
                <li class="mgnb_1dli"><a href="<?php echo G5_BBS_URL ?>/mypage.php" class="mgnb_1da">마이페이지</a></li>
                <? } else { ?>
                <?	
				} // end is_member 
				?>
				<li class="mgnb_1dli"><a href="<?php echo G5_URL ?>" class="mgnb_1da">홈으로</a></li>			    
            	<li class="mgnb_1dli"><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=event" class="mgnb_1da">이벤트</a></li>
            	<li class="mgnb_1dli"><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=notice" class="mgnb_1da">공지사항</a></li>
                <li class="mgnb_1dli"><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=provision" class="mgnb_1da">서비스 이용약관</a></li>
                <li class="mgnb_1dli"><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=privacy" class="mgnb_1da">개인정보처리방침</a></li>
                <? 
				if ($is_member) {
				?>
                <li class="mgnb_1dli"><a href="<?php echo G5_BBS_URL; ?>/mission.php" class="mgnb_1da"><i class="fal fa-layer-group"></i>&nbsp;미션<span class="badge">7</span></a></li>
                <li class="mgnb_1dli"><a href="<?php echo G5_BBS_URL ?>/coworker.php" class="mgnb_1da btn_busi"><i class="fas fa-address-card"></i>&nbsp;비즈니스 회원 신청</a></li>
                <? } else { ?>
                <?	
				} // end is_member 
				?>
            </ul>
        </nav>
    </div><!--//scroll-->

    <div id="ft_copy">
        <!--<div id="ft_company">
            <a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=company">회사소개</a>
            <a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=privacy">개인정보취급방침</a>
            <a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=provision">서비스이용약관</a>
        </div>-->
        <p>Copyright &copy; <b><?php echo $config['cf_title']; ?></b> All rights reserved.</p>
    </div>
    
</div><!--//hash_wrap-->