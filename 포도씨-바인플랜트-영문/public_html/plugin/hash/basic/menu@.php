<link rel="stylesheet" href="<?php echo G5_PLUGIN_URL;?>/hash/style.css">


<div id="hash_wrap" style="z-index:9999">
	<div class="hd_wrap">
        <div id="hd_title">
                <div class="bacK">
                    <img class="hash-close" src="<?php echo G5_THEME_IMG_URL ?>/mobile/close.png" onclick="history.back();">
                </div>
        </div><!--//hd_title-->
        <div id="hd_tnb">
            <?php if ($is_member) { ?>
            
                <?php if($member[mb_level]=="3"){ ?>
                <!-- 기사용 -->
                <div class="mb">
                    <a href="<?php echo G5_BBS_URL ?>/member_confirm.php?url=<?php echo G5_BBS_URL ?>/register_form.php">
                    <div class="photo">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/mobile/mb_noimg.png" class="noimg">
                    </div>
                    </a>
                    <div class="info">
                        <p><?=$member["mb_name"]?>&nbsp;<a href="<?php echo G5_BBS_URL ?>/logout.php">로그아웃</a></p>
                        <!-- 자기사 -->
                        <span class="s1"><?=$mb_levelArr[$member[mb_level]]?></span> <span class="s2">패널티 : 없음</span>
                        <!--// 자기사 -->
                        <!-- 보험미확인기사
                        <span class="s2">보험 미확인 기사</span>
                        <!--// 보험미확인기사 -->
                        </div>
                </div>
                <!-- //기사용 -->
                <?php } else { ?>
                <!-- 고객용(일반회원) -->
                <div class="mb">
                    <a href="<?php echo G5_BBS_URL ?>/member_confirm.php?url=<?php echo G5_BBS_URL ?>/register_form.php">
                    <div class="photo">
                        <img src="<?php echo G5_THEME_IMG_URL ?>/mobile/mb_noimg.png" class="noimg">
                    </div>
                    </a>
                    <div class="info">
                        <p><?=$member["mb_name"]?></p>
                        <span>신규회원</span><a href="<?php echo G5_BBS_URL ?>/logout.php" class="btn">로그아웃</a>
                    </div>
                </div>
                <!-- //고객용(일반회원) -->
                <?php } ?>
           
            <?php } else { ?>
            <div class="login">
            <!--<img src="<?php echo G5_IMG_URL ?>/logo.png" alt="<?php echo $config['cf_title']; ?>"> -->
            <a href="<?php echo G5_BBS_URL ?>/login.php"><span style="font-weight:900; color:#000000;">로그인</span> 해주세요</a> <a href="<?php echo G5_BBS_URL ?>/register.php" class="btn">회원가입</a>
            </div>
            <?php } ?>
        </div>
    </div>
    <div class="scroll">
        <nav id="navtoggle">
        	<ul>
				<li class="mgnb_1dli"><a href="<?php echo G5_URL ?>" class="mgnb_1da">홈으로</a></li>
                <?php if($member[mb_level]=="2"){ ?>
            	<!-- 고객용 -->
				<li class="mgnb_1dli"><a href="<?php echo G5_BBS_URL ?>/point.list.php" class="mgnb_1da">포인트적립내역</a></li>
            	<li class="mgnb_1dli"><a href="<?php echo G5_BBS_URL?>/board.php?bo_table=service&my=true" class="mgnb_1da">여정내역</a></li>
				<li class="mgnb_1dli"><a href="<?php echo G5_BBS_URL?>/map_search.php" class="mgnb_1da">즐겨찾기</a></li>
                <!--//고객용 -->
                <?php } else if($member[mb_level]=="3"){ ?>
            	<!-- 기사용 -->
				<li class="mgnb_1dli"><a href="<?php echo G5_BBS_URL?>/service.calculate.php" class="mgnb_1da">정산내역</a></li>
            	<li class="mgnb_1dli"><a href="<?php echo G5_BBS_URL?>/board.php?bo_table=service&my=true" class="mgnb_1da">콜접수내역</a></li>
                <!--//기사용 -->
                <?php } ?>
				<?php /*?><li class="mgnb_1dli"><a href="" class="mgnb_1da">문의하기</a></li><?php */?>
            	<li class="mgnb_1dli"><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=event" class="mgnb_1da">이벤트</a></li>
            	<li class="mgnb_1dli"><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=notice" class="mgnb_1da">공지사항</a></li>
				<? if($member[mb_id]){?>
            	<li class="mgnb_1dli"><a href="<?php echo G5_BBS_URL?>/setting.php" class="mgnb_1da">설정</a></li>
				<? }?>
            </ul>

        </nav>
    
    
    </div><!--//scroll-->
    <div id="ft_copy">
        <div id="ft_company">
            <a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=company">회사소개</a>
            <a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=privacy">개인정보취급방침</a>
            <a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=provision">서비스이용약관</a>
        </div>
        <p>Copyright &copy; <b><?php echo $config['cf_title']; ?></b> All rights reserved.</p>
    </div>
    
</div><!--//hash_wrap-->