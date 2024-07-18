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
    	

        <div class="container">
			<div id="topm col-sm-6 col-xs-7">
        <ul id="tnb">
            <li><a href="<?php echo G5_URL ?>" class="home">메인</a></li>
            <?php if ($is_member) {  ?>
                <?php if ($member['mb_level']=="10") {  ?>
                <li><a href="<?php echo G5_ADMIN_URL ?>">관리자</a></li>
                <?php }else{  ?>
                <li><a href="<?php echo G5_BBS_URL ?>/member_confirm.php?url=<?php echo G5_BBS_URL ?>/register_form.php">정보수정</a></li>
                <?php }?>
                <li><a href="<?php echo G5_BBS_URL ?>/logout.php">로그아웃</a></li>
            <?php } else {  ?>
                <li><a href="<?php echo G5_BBS_URL ?>/login.php">로그인</a></li>
                <li><a href="<?php echo G5_BBS_URL ?>/register_form.php">회원가입</a></li>
            <?php }  ?>
        </ul>
    </div><!--top_m-->
                <div id="logo" class="col-md-12 col-xs-12">
                    <a href="<?php echo G5_URL ?>"><img src="<?php echo G5_THEME_IMG_URL ?>/logo.jpg" alt="<?php echo $config['cf_title']; ?>"></a>
                </div><!--//logo-->
			        </div>
		
        <div class="container-fluid gnb_bg">
            <div class="row">
    
                <nav id="gnb" class="col-md-12 col-xs-12">
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
            
                            ?>
                        </li>
                        <?php
                        }
            
                        if ($i == 0) {  ?>
                            <li id="gnb_empty">메뉴 준비 중입니다.<?php if ($is_admin) { ?> <br><a href="<?php echo G5_ADMIN_URL; ?>/menu_list.php">관리자모드 &gt; 환경설정 &gt; 메뉴설정</a>에서 설정하실 수 있습니다.<?php } ?></li>
                        <?php } ?>
            			</ul>
            	</nav>

            </div>
        </div>
    </div><!--//hd_wrapper-->
    
</div>
<!-- } 상단 끝 -->


<hr>

<!-- 콘텐츠 시작 { -->
	
	<? if(defined('_INDEX_')) {?>
    <!-- 인텍스부분 -->
    
	<? }else if($bo_table == "" || $co_id == ""){ ?>
    <!-- 서브 내용페이지 { -->
    <div id="subvisual">
    	<div class="slogan">
        	<?php /*?><img src="<?php echo G5_THEME_IMG_URL ?>/sub/s_title.png" alt=""><?php */?>
        </div>
    </div>
	<div id="wrapper">
        <div class="container">
        	<div class="row">
			<?
				if(0<strpos($_SERVER['PHP_SELF'],"register_form")){
					$class="col-sm-12";
				}else{
					$class="col-sm-9";
				}
			?>
            <div id="aside" class="col-sm-3" style="display:<?php echo 0<strpos($_SERVER['PHP_SELF'],"register_form")?"none":"";?>">
            <?php 
    
                if(!$is_register || $w){ 
                    //서브메뉴 추가
                    if(!$sm_tid)	$sm_tid = $co_id;
                    if(!$sm_tid)	$sm_tid = $bo_table;
                    if($sm_tid){		
						echo submenu($sm_tid, 'basic', G5_THEME_PATH); 
					}
                }
            ?>
            </div>
            <div id="container" class="<?=$class?>" style="width:<?php echo 0<strpos($_SERVER['PHP_SELF'],"register_form")?"100%":"";?>">
                <div id="container_title">
                 <?php if($bo_table) {?>
                        <?php echo $board['bo_subject']; ?>
                 <?php }else { ?>
                        <?php echo $g5['title'] ?>
                 <?php } ?>
                    <!--메뉴로케이션 시작 {-->
                    <?php 
            
                        if(!$is_register || $w){ 
                            //서브메뉴 추가
                            if(!$sm_tid)	$sm_tid = $co_id;
                            if(!$sm_tid)	$sm_tid = $bo_table;
                            if($sm_tid)		
                            echo submenu($sm_tid, 'location', G5_THEME_PATH); 
                        }
                    ?>
                    <!--} 메뉴로케이션 끝-->
                </div><!--//container_title"-->
    <!-- } 서브 내용페이지 -->
    <? } ?> 
