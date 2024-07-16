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
					<div class="btn_logout"><a href="<?php echo G5_BBS_URL ?>/logout.php" class="btn">Logout</a></div>
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
					  <p>Log in and enjoy <br>the many benefits of PODOSEA!</p>
					  <ul>
						  <li><a href="<?=G5_BBS_URL?>/login.php">Login</a></li>
						  <li><a href="<?=G5_BBS_URL?>/register.php" class="btn_mem">Join</a></li>
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
				<li class="mgnb_1dli"><a href="<?php echo G5_BBS_URL ?>/chat_list.php" class="mgnb_1da">Chat <i class="arrow"></i></a></li>
                <li class="mgnb_1dli"><a href="<?php echo G5_BBS_URL ?>/company_list.php" class="mgnb_1da">Corporate RFQ <i class="arrow"></i></a></li>
                <li class="mgnb_1dli"><a href="<?php echo G5_BBS_URL ?>/company_search.php" class="mgnb_1da">Search for company <i class="arrow"></i></a></li>
				<li class="mgnb_1dli company_noshow"><a href="<?php echo G5_BBS_URL ?>/help_list.php" class="mgnb_1da">Help Me <i class="arrow"></i></a></li>
                <li class="mgnb_1dli company_noshow"><a href="<?php echo G5_BBS_URL ?>/community.php" class="mgnb_1da">Community <i class="arrow"></i></a></li>
                <li class="mgnb_1dli company_noshow"><a href="<?php echo G5_BBS_URL ?>/bunker.php" class="mgnb_1da">Bunker Station <i class="arrow"></i></a></li>
                <?
				} // end is_member
				?>
            </ul>
        </nav>
    </div><!--//scroll-->

    <div id="ft_copy">
		<ul class="list_link">
			<li><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=notice">Notice</a></li>
			<li><a href="<?php echo G5_BBS_URL ?>/cscenter.php">CS Center</a></li>
		</ul>
        <div id="ft_company">
			<a href="<?php echo G5_BBS_URL ?>/introduce.php">Introduce</a></li>
			<a href="<?php echo G5_BBS_URL ?>/movie.php">Video</a></li>
            <a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=privacy">Privacy Policy</a>
            <a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=provision">Terms of Service</a>
        </div>
        <p>Copyright &copy; <b><?php echo $config['cf_title']; ?></b> All rights reserved.</p>
    </div>

</div><!--//hash_wrap-->
