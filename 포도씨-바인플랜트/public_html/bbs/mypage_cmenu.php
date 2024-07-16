<div id="mypage_menu" class="company">
	<h3>마이메뉴</h3>
	<ul class="menu_list">
		<!--<li><a href="<?php echo G5_BBS_URL ?>/mypage_company.php">마이홈</a></li>-->
		<li><a href="<?php echo G5_BBS_URL ?>/mypage_chelp.php">헬프미</a></li>
		<li><a href="<?php echo G5_BBS_URL ?>/mypage_ccommunity.php">커뮤니티</a></li>
		<li><a href="<?php echo G5_BBS_URL ?>/mypage_career_corp.php">커리어</a></li>
		<li><a href="<?php echo G5_BBS_URL ?>/mypage_company01.php">나의의뢰</a></li>
		<li><a href="<?php echo G5_BBS_URL ?>/mypage_inquiry_corp.php">받은문의</a></li>
        <!--<li><a href="<?php /*echo G5_BBS_URL */?>/mypage_inquiry.php">나의문의</a></li>-->
		<li><a href="<?php echo G5_BBS_URL ?>/mypage_bunker.php">벙커관리</a></li>
		<li><a href="<?php echo G5_BBS_URL ?>/mypage_interest_corp.php">관심기업</a></li>
        <?php
        if($member['mb_category'] == '일반') { $path = 'profile_update01.php'; }
        else {$path = 'profile_company_update01.php'; }
        ?>
        <li><a href="<?php echo G5_BBS_URL ?>/<?=$path?>">프로필관리</a></li>
        <?php
        if($member['mb_category'] == '일반') { $path2 = 'register_form.php?w=u'; }
        else {$path2 = 'register_company_form.php?w=u'; }
        ?>
        <li><a href="<?php echo G5_BBS_URL ?>/<?=$path2?>">나의정보</a></li>
        <?php if($reference_test) { ?>
            <li><a href="<?php echo G5_BBS_URL ?>/mypage_shop.php">자료실</a></li>
            <?php if($seller) { ?>
            <li><a href="<?php echo G5_BBS_URL ?>/mypage_pay.php">판매대금관리</a></li>
            <?php } ?>
        <?php } ?>
    </ul>
</div>
