<link rel="stylesheet" href="<?php echo G5_PLUGIN_URL;?>/hash/style.css">

<div id="hash_wrap" style="z-index:9999">
	<div class="hd_wrap">
        <div id="hd_title">

			<div class="back" onclick="history.back();">
                <span></span>
                <span></span>
			</div>
        </div><!--//hd_title-->

        <div id="hd_tnb">
            <?
			if ($is_member) {
			?>
			<div class="mb">
				<div class="photo">
                <?php echo getProfileImg($member['mb_id'], $member['mb_category']); ?>
				</div>
				<div class="info">
					<div class="id"><?=getNickOrId($member['mb_id'])?>
                        <?php if($member['mb_category'] == '일반') { ?>
                        <a href="<?=G5_BBS_URL?>/register_form.php?w=u&mb_id=<?=$member['mb_id']?>"></a>
                        <?php } else { ?>
                        <a href="<?=G5_BBS_URL?>/register_company_form.php?w=u&mb_id=<?=$member['mb_id']?>"></a>
                        <?php } ?>
                    </div>
					<div class="grade">
                        <?php if(!$is_admin && $member['mb_category'] == '기업') { ?><i class="lv<?=array_search($member['mb_grade'], $member_grade)?>"><?=$member['mb_grade']?></i><?php } ?>
                        <?php if(!$is_admin && $member['mb_category'] == '일반') { ?><i class="lv<?=array_search($member['mb_grade'], $member_grade)?>"><?=$member['mb_grade']?></i><?php } ?>
                    </div>
					<div class="btn_logout"><a href="<?php echo G5_BBS_URL ?>/logout.php" class="btn">로그아웃</a></div>
				</div>
				<!--
					<p class="mileage">
						<!--<a href="<?/*=G5_BBS_URL*/?>/register_form.php?w=u&mb_id=<?/*=$member['mb_id']*/?>"><i class="fas fa-pen-square"></i>&nbsp;정보수정</a>-->
                        <!--<a href="javascript:void(0);"><i class="fas fa-pen-square"></i>&nbsp;정보수정</a>
						<a href="<?php echo G5_BBS_URL ?>/logout.php" class="btn">로그아웃</a>
					</p>
					-->
			    </div>
            <? } else { ?>
			 <div>
				 <div class="login_field">
					  <p>로그인 하시고, <br>PODOSEA의 다양한 혜택을 받으세요!</p>
					  <ul>
						  <li><a href="<?=G5_BBS_URL?>/login.php">로그인</a></li>
						  <li><a href="<?=G5_BBS_URL?>/register.php" class="btn_mem">회원가입</a></li>
					  </ul>
				 </div>
			</div>
            <?php } ?>
        </div>
    </div>

    <div class="scroll">
        <?
		  if ($is_member) {
		?>
        <? } else { ?>

        <? } ?>
        <nav id="navtoggle" class="in">
        	<ul>
                <?
				if ($is_member) {
				?>
				<li class="mgnb_1dli store_noshow"><a href="<?php echo G5_BBS_URL ?>/chat_list.php" class="mgnb_1da">채팅 <i class="arrow"></i></a></li>
                <!--<li class="mgnb_1dli"><a href="<?php /*echo G5_BBS_URL */?>/company_list.php" class="mgnb_1da">기업의뢰 <i class="arrow"></i></a></li>-->
                <li class="mgnb_1dli general_noshow"><a href="<?php echo G5_BBS_URL ?>/company_search.php" class="mgnb_1da">기업검색 <i class="arrow"></i></a></li>
                <li class="mgnb_1dli general_noshow"><a href="<?php echo G5_BBS_URL ?>/career.php" class="mgnb_1da">커리어 <i class="arrow"></i></a></li>
                <li class="mgnb_1dli"><a href="<?php echo G5_BBS_URL ?>/help_list.php" class="mgnb_1da">헬프미 <i class="arrow"></i></a></li>
                <li class="mgnb_1dli"><a href="<?php echo G5_BBS_URL ?>/community.php" class="mgnb_1da">커뮤니티 <i class="arrow"></i></a></li>
                <?php if($reference_test) { ?>
                <li class="mgnb_1dli"><a href="<?php echo G5_BBS_URL ?>/shop.php" class="mgnb_1da">자료실 <i class="arrow"></i></a></li>
                <?php } ?>
                <li class="mgnb_1dli store_noshow"><a href="<?php echo G5_BBS_URL ?>/bunker.php" class="mgnb_1da">벙커링 스테이션 <i class="arrow"></i></a></li>
                <?
				} // end is_member
				?>
            </ul>
        </nav>
    </div><!--//scroll-->

    <div id="ft_copy">
		<ul class="list_link">
			<li><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=notice">공지사항</a></li>
			<li><a href="<?php echo G5_BBS_URL ?>/cscenter.php">고객센터</a></li>
		</ul>
        <div id="ft_company">
			<a href="<?php echo G5_BBS_URL ?>/introduce.php">포도씨소개</a></li>
			<a href="<?php echo G5_BBS_URL ?>/movie.php">소개영상</a></li>
            <a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=privacy">개인정보취급방침</a>
            <a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=provision">서비스이용약관</a>
        </div>
        <p>Copyright &copy; <b><?php echo $config['cf_title']; ?></b> All rights reserved.</p>
    </div>

</div><!--//hash_wrap-->
