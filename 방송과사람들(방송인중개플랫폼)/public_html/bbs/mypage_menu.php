<!-- 마이페이지에만 나오는 메뉴 -->
<div id="mypage_menu">
	<h3>마이메뉴</h3>
	<ul class="menu_list">
		<li><a href="<?php echo G5_BBS_URL ?>/chat_list.php">문의채팅</a></li>
		<!-- 일반인만 보이는 메뉴-->
		<li class="on"><a href="<?php echo G5_BBS_URL ?>/mypage.php">구매관리</a></li>
        <?php if ($member['mb_level'] > 2){ ?>
		<!-- 의뢰인만 보이는 메뉴-->
		<li><a href="<?php echo G5_BBS_URL ?>/mypage_sale.php">판매관리</a></li>
		<li><a href="<?php echo G5_BBS_URL ?>/mypage_cash.php">캐시관리</a></li>
        <li><a href="<?php echo G5_BBS_URL ?>/mypage_portfolio.php">포토폴리오관리</a></li>
		<li><a href="<?php echo G5_BBS_URL ?>/mypage_item.php">서비스관리</a></li>
        <?php } ?>
		<!--<li><a href="javascript:swal('준비중입니다.');">결제내역</a></li>-->
		<li><a href="<?php echo G5_BBS_URL ?>/mypage_jjim.php">찜한내역</a></li>
        <?php if($_SERVER['REMOTE_ADDR']=="183.103.22.103"){ ?>
        <li><a href="<?php echo G5_BBS_URL ?>/mypage_contest.php">내 프로젝트</a></li>
        <?php }?>
		<li><a href="<?php echo G5_BBS_URL ?>/mypage_profile.php">프로필관리</a></li>
		<!--<li><a href="javascript:swal('준비중입니다.')">설정</a></li>-->
        <li><a href="<?php echo G5_BBS_URL ?>/logout.php">로그아웃</a></li>
	</ul>
</div>