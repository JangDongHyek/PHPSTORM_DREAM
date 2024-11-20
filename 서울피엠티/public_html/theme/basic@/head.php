<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/head.php');
    return;
}

include_once(G5_THEME_PATH.'/head.sub.php');
include_once(G5_LIB_PATH.'/latest.lib.php');
include_once(G5_LIB_PATH.'/outlogin.lib.php');
include_once(G5_LIB_PATH.'/poll.lib.php');
include_once(G5_LIB_PATH.'/visit.lib.php');
include_once(G5_LIB_PATH.'/connect.lib.php');
include_once(G5_LIB_PATH.'/popular.lib.php');
include_once(G5_LIB_PATH.'/submenu.lib.php');
?>

<!-- 상단 시작 { -->
<div id="hd">
    <h1 id="hd_h1"><?php echo $g5['title'] ?></h1>

    <div id="skip_to_container"><a href="#container">본문 바로가기</a></div>

    <?php
    if(defined('_INDEX_')) { // index에서만 실행
        include G5_BBS_PATH.'/newwin.inc.php'; // 팝업레이어
    }
    ?>

    <div id="hd_wrapper">

        <div id="logo">
            <a href="<?php echo G5_URL ?>"><img src="<?php echo G5_THEME_IMG_URL ?>/logo.gif" alt="<?php echo $config['cf_title']; ?>"></a>
        </div><!--#logo-->

        <ul id="tnb">
            <li><a href="<?php echo G5_URL ?>">HOME</a></li>
            <li><a href="<?php echo G5_BBS_URL ?>/faq.php">FAQ</a></li>
            <li><a href="<?php echo G5_BBS_URL ?>/qalist.php">1:1문의</a></li>
            <?php if ($is_member) {  ?>
            <?php if ($is_admin) {  ?>
            <li><a href="<?php echo G5_ADMIN_URL ?>" target="_blank"><b>관리자</b></a></li>
            <?php }  ?>
			<li><a href="<?php echo G5_BBS_URL ?>/member_confirm.php?url=<?php echo G5_BBS_URL ?>/register_form.php">정보수정</a></li>
            <li><a href="<?php echo G5_BBS_URL ?>/logout.php">로그아웃</a></li>
            <?php } else {  ?>
			<li><a href="<?php echo G5_BBS_URL ?>/register.php">회원가입</a></li>
            <li class="login"><a href="<?php echo G5_BBS_URL ?>/login.php">관리자로그인</a></li>
            <?php }  ?>
        </ul>

    <hr>

    <nav id="gnb">
        <h2>메인메뉴</h2>
        <ul id="gnb_1dul">
            <?php
            $sql = " select *
                        from {$g5['menu_table']}
                        where me_use = '1'
                          and length(me_code) = '2'
                        order by me_order, me_id ";
            $result = sql_query($sql, false);
            $gnb_zindex = 999; // gnb_1dli z-index 값 설정용

            for ($i=0; $row=sql_fetch_array($result); $i++) {
				
				if($row['me_course'])
					$menu['href'] = G5_URL.$row['me_link'];
				else 
					$menu['href'] = $row['me_link']
            ?>
            <li class="gnb_1dli" style="z-index:<?php echo $gnb_zindex--; ?>">
                <a href="<?php echo $menu['href']; ?>" target="_<?php echo $row['me_target']; ?>" class="gnb_1da"><?php echo $row['me_name'] ?></a>
                <?php
                $sql2 = " select *
                            from {$g5['menu_table']}
                            where me_use = '1'
                              and length(me_code) = '4'
                              and substring(me_code, 1, 2) = '{$row['me_code']}'
                            order by me_order, me_id ";
                $result2 = sql_query($sql2);

                for ($k=0; $row2=sql_fetch_array($result2); $k++) {
                    if($k == 0)
                        echo '<ul class="gnb_2dul">'.PHP_EOL;
					if($row2['me_course'])
						$menu['href'] = G5_URL.$row2['me_link'];
					else 
						$menu['href'] = $row2['me_link']
				?>
                    <li class="gnb_2dli"><a href="<?php echo $menu['href']; ?>" target="_<?php echo $row2['me_target']; ?>" class="gnb_2da"><?php echo $row2['me_name'] ?></a></li>
                <?php
                }

                if($k > 0)
                    echo '</ul>'.PHP_EOL;
                ?>
            </li>
            <?php
            }

            if ($i == 0) {  ?>
                <li id="gnb_empty">메뉴 준비 중입니다.<?php if ($is_admin) { ?> <br><a href="<?php echo G5_ADMIN_URL; ?>/menu_list.php">관리자모드 &gt; 환경설정 &gt; 메뉴설정</a>에서 설정하실 수 있습니다.<?php } ?></li>
            <?php } ?>
        </ul>
    </nav>
    </div><!--#hd_wrapper-->
    
</div>
<!-- } 상단 끝 -->

<hr>

<!-- 콘텐츠 시작 { -->
<div id="wrapper">

<? if(defined('_INDEX_')) {?>
  <div id="container_index"></div>
	<? }else if($bo_table == "" || $co_id == ""){ ?>
	<!--서브비쥬얼-->
	<div id="svisual" style="background:url(<?php echo G5_THEME_IMG_URL?>/svisual.jpg) no-repeat center top;"></div>
	<div id="container">
		<?php 
			//서브메뉴 추가
			if(!$sm_tid)	$sm_tid = $co_id;
			if(!$sm_tid)	$sm_tid = $bo_table;

			if($sm_tid)		
			echo submenu($sm_tid, 'basic', G5_THEME_PATH); 
		?>
		<!--서브내용 부분-->
		<div id="scont_wrap">
			<div id="scont">
				<!--서브타이틀-->
				<div id="sub_title">
					<div class="p_info">
						<ul>
							<li><a href="<?php echo G5_URL ?>"><img src="<?php echo G5_THEME_IMG_URL; ?>/icon_home.gif" />&nbsp;HOME</a></li>
							<li>&nbsp;&nbsp;|&nbsp;&nbsp;</li>
							<li class="pt"> 
								<?php if($bo_table) {?>
								<?php echo $board['bo_subject']; ?>
								<?php }else { ?>
								<?php echo $g5['title'] ?>
								<?php } ?>
							</li>
						</ul>
					</div><!--.p_info-->
				<div class="container_title">
					<?php if($bo_table) {?>
						<?php echo $board['bo_subject']; ?>
					<?php }else { ?>
						<?php echo $g5['title'] ?>
					<?php } ?>
				</div>
			</div><!--#sub_title-->
			<!--서브타이틀-->
		<? } ?> 
