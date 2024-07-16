<div id="mypage_menu" class="company">
	<h3>MY MENU</h3>
	<ul class="menu_list">
		<!--<li><a href="<?php echo G5_BBS_URL ?>/mypage_company.php">마이홈</a></li>-->
		<!--<li><a href="<?php /*echo G5_BBS_URL */?>/mypage_chelp.php">Help Me</a></li>
		<li><a href="<?php /*echo G5_BBS_URL */?>/mypage_ccommunity.php">Community</a></li>-->
		<li><a href="<?php echo G5_BBS_URL ?>/mypage_company01.php">My RFQs</a></li>
		<li><a href="<?php echo G5_BBS_URL ?>/mypage_inquiry_corp.php">Received Inquiry</a></li>
		<!--<li><a href="<?php /*echo G5_BBS_URL */?>/mypage_bunker.php">Manage Bunkers</a></li>-->
		<li><a href="<?php echo G5_BBS_URL ?>/mypage_interest_corp.php">Companies of Interest</a></li>
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
