<!-- 마이페이지에만 나오는 메뉴 -->
<div id="mypage_menu" class="basic">
	<h3>MY MENU</h3>
	<ul class="menu_list">
		<!--<li><a href="<?php echo G5_BBS_URL ?>/mypage.php">마이홈</a></li>-->
		<li><a href="<?php echo G5_BBS_URL ?>/mypage_help.php">Help Me</a></li>
        <li><a href="<?php echo G5_BBS_URL ?>/mypage_community.php">Community</a></li>
		<!--<li><a href="<?php /*echo G5_BBS_URL */?>/mypage_inquiry.php">나의문의</a></li>-->
		<li><a href="<?php echo G5_BBS_URL ?>/mypage_bunker.php">Manage Bunkers</a></li>
        <li><a href="<?php echo G5_BBS_URL ?>/mypage_friend.php">My Friends</a></li>
		<?php
        if($member['mb_category'] == '일반') { $path = 'profile_update01.php'; }
        else {$path = 'profile_company_update01.php'; }
        ?>
		<li><a href="<?php echo G5_BBS_URL ?>/<?=$path?>">Manage Profile</a></li>
        <?php
        if($member['mb_category'] == '일반') { $path2 = 'register_form.php?w=u'; }
        else {$path2 = 'register_company_form.php?w=u'; }
        ?>
		<li><a href="<?php echo G5_BBS_URL ?>/<?=$path2?>">My Information</a></li>
	</ul>					
</div>