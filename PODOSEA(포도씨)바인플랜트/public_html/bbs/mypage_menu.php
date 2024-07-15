<!-- 마이페이지에만 나오는 메뉴 -->
<div id="mypage_menu" class="basic">
	<h3>마이메뉴</h3>
	<ul class="menu_list">
		<!--<li><a href="<?php echo G5_BBS_URL ?>/mypage.php">마이홈</a></li>-->
        <li><a href="<?php echo G5_BBS_URL ?>/mypage_help.php">헬프미</a></li>
		<li><a href="<?php echo G5_BBS_URL ?>/mypage_community.php">커뮤니티</a></li>
		<li class="general_noshow"><a href="<?php echo G5_BBS_URL ?>/mypage_career.php">커리어</a></li>
		<!--<li><a href="<?php /*echo G5_BBS_URL */?>/mypage_inquiry.php">나의문의</a></li>-->
		<li><a href="<?php echo G5_BBS_URL ?>/mypage_bunker.php">벙커관리</a></li>
        <li><a href="<?php echo G5_BBS_URL ?>/mypage_friend.php">나의친구</a></li>
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
            <!--<li><a href="<?php /*echo G5_BBS_URL */?>/mypage_seller.php">판매자 신청</a></li>-->
        <?php } ?>
	</ul>
</div>
