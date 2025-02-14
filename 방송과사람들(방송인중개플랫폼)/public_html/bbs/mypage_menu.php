<!-- 마이페이지에만 나오는 메뉴 -->
<div id="mypage_menu">
    <?php include('./mypage_banner.php'); ?>
    <h3>마이메뉴</h3>
	<ul class="menu_list">
    <?php if ($member['mb_level'] > 2) /*전문가*/{ ?>
        <li><a href="<?php echo G5_BBS_URL ?>/profile.php?mb_no=<?=$member['mb_no']?>">전문가 정보</a></li>
        <li><a href="<?php echo G5_BBS_URL ?>/mypage_portfolio.php">포토폴리오</a></li>
        <li><a href="<?php echo G5_BBS_URL ?>/mypage_item.php">상품 관리</a></li>
		<li><a href="<?php echo G5_BBS_URL ?>/mypage_cash.php">수익내역</a></li>
        <li><a href="javascript:swal('준비중입니다.');">프로젝트 지원 LIST</a></li>
        <li><a href="javascript:swal('준비중입니다.');">MY등급</a></li>
        <li><a href="javascript:swal('준비중입니다.');">광고신청관리</a></li>
        <li><a href="javascript:swal('준비중입니다.');">리뷰관리</a></li>
        <li><a href="javascript:swal('준비중입니다.');">MY혜택</a></li>
		<li><a href="<?php echo G5_BBS_URL ?>/event_promo.php">이벤트&프로모션</a></li>
		<li><a href="<?php echo G5_BBS_URL ?>/notice_main.php">고객센터</a></li>
    <?php } else /*의뢰인*/ { ?>
        <li class="on"><a href="<?php echo G5_BBS_URL ?>/mypage.php">구매상품목록</a></li>
        <li><a href="<?php echo G5_BBS_URL ?>/mypage_project_my.php">프로젝트 의뢰 LIST</a></li>
        <li><a href="javascript:swal('준비중입니다.');">광고신청관리</a></li>
        <li><a href="javascript:swal('준비중입니다.');">리뷰관리</a></li>
        <li><a href="javascript:swal('준비중입니다.');">MY혜택</a></li>
        <li><a href="<?php echo G5_BBS_URL ?>/event_promo.php">이벤트&프로모션</a></li>
        <li><a href="<?php echo G5_BBS_URL ?>/notice_main.php">고객센터</a></li>
    <?php } ?>

        <?php if($_SERVER['REMOTE_ADDR']=="183.103.22.103"){ ?>
        <?php }?>
        <!--<li><a href="javascript:swal('준비중입니다.');">결제내역</a></li>
        <li><a href="<?php echo G5_BBS_URL ?>/chat_list.php">문의채팅</a></li>
        <li><a href="<?php echo G5_BBS_URL ?>/mypage_jjim.php">찜한서비스</a></li>
        <li><a href="<?php echo G5_BBS_URL ?>/mypage_jjim_portfolio.php">찜한포트폴리오</a></li>
		<li><a href="<?php echo G5_BBS_URL ?>/mypage_sale.php">판매관리</a></li>
		<li><a href="javascript:swal('준비중입니다.')">설정</a></li>-->
        <li><a href="<?php echo G5_BBS_URL ?>/logout.php">로그아웃</a></li>
	</ul>
</div>