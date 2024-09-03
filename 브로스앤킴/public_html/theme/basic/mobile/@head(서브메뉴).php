<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

include_once(G5_THEME_PATH.'/head.sub.php');
include_once(G5_LIB_PATH.'/latest.lib.php');
include_once(G5_LIB_PATH.'/outlogin.lib.php');
include_once(G5_LIB_PATH.'/poll.lib.php');
include_once(G5_LIB_PATH.'/visit.lib.php');
include_once(G5_LIB_PATH.'/connect.lib.php');
include_once(G5_LIB_PATH.'/popular.lib.php');
include_once(G5_LIB_PATH.'/submenu.lib.php');
?>

<!--header-->
<header id="hd">
    <h1 id="hd_h1"><?php echo $g5['title'] ?></h1>

    <div class="to_content"><a href="#container">본문 바로가기</a></div>

    <?php
    if(defined('_INDEX_')) { // index에서만 실행
    } ?>

    <div id="hd_wrapper">

        <div id="logo">
            <a href="<?php echo G5_URL ?>"><img src="<?php echo G5_IMG_URL ?>/logo.png" alt="<?php echo $config['cf_title']; ?>"></a>
        </div>

		  <div class="tn sch"><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=comm01"><img src="<?php echo G5_THEME_IMG_URL ?>/mobile/sch.png" /></a></div>
		  <div class="tn nav_open"><img src="<?php echo G5_THEME_IMG_URL ?>/mobile/menu.png" /></div>
          <div id="mask" style="display:none"></div>
          
          
           <nav id="navtoggle">
             <div class="nav_close"><img src="<?php echo G5_THEME_IMG_URL ?>/mobile/icon_close.png" /></div>
			 <ul>
              <li>
                <div id="left_menu">
                <div class="title"><!--<i class="fa fa-th-large"></i> -->전체메뉴 안내</div>
                      <!--메뉴시작-->
                      <div id="accordion-example" data-collapse="accordion">
                        <div id="gnb" class="hd_div">
                                <ul id="gnb_1dul">
                                <?php
                                $sql = " select *
                                            from {$g5['menu_table']}
                                            where me_mobile_use = '1'
                                              and length(me_code) = '2'
                                            order by me_order, me_id ";
                                $result = sql_query($sql, false);
                    
                                for($i=0; $row=sql_fetch_array($result); $i++) {
                                ?>
                                    <li class="gnb_1dli">
                                        <a class="gnb_1da"><?php echo $row['me_name'] ?></a>
                                        <!--1차메뉴-->
                                        <?php
                                        $sql2 = " select *
                                                    from {$g5['menu_table']}
                                                    where me_mobile_use = '1'
                                                      and length(me_code) = '4'
                                                      and substring(me_code, 1, 2) = '{$row['me_code']}'
                                                    order by me_order, me_id ";
                                        $result2 = sql_query($sql2);
                    
                                        for ($k=0; $row2=sql_fetch_array($result2); $k++) {
                                            if($k == 0)
                                                echo '<ul class="gnb_2dul">'.PHP_EOL;
                                        ?>
                                            <li class="gnb_2dli"><a href="<?php echo $row2['me_link']; ?>" target="_<?php echo $row2['me_target']; ?>" class="gnb_2da"><span></span><?php echo $row2['me_name'] ?></a></li><!--2차메뉴-->
                                        <?php
                                        }
                    
                                        if($k > 0)
                                            echo '</ul>'.PHP_EOL;
                                        ?>
                                    </li>
                                <?php
                                }
                    
                                if ($i == 0) {  ?>
                                    <li id="gnb_empty">메뉴 준비 중입니다.<?php if ($is_admin) { ?> <br><a href="<?php echo G5_ADMIN_URL; ?>/menu_list.php">관리자모드 &gt; 환경설정 &gt; 메뉴설정</a>에서 설정하세요.<?php } ?></li>
                                <?php } ?>
                                </ul>
                            </div>
                      </div>
						</div>
                    </li>
		   </ul>
		   </nav>
	</div>          
</header>
<!--//header-->

<div id="wrapper">
<? if(defined('_INDEX_')) {?>  <!--index에 나오지않고-->
<? }else if($bo_table == "" || $co_id == ""){ ?><!-- 내용/게시판에 나와라-->
    <div id="container">
            <!--페이지경로시작-->
              <div class="loction">
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
             </div><!--.loction-->
            <!--페이지경로 끝-->
            <!--서브 2차메뉴 시작
                <p class="snb_area"><a id="menu_img" href="javascript:showMenuList();"></a></p>
                <div class="snb_box" id="menu_list">   
                   <ul class="menu_box" >
                        <?php 
							if(!$is_register || $w){ 
								//서브메뉴 추가
								if(!$sm_tid)	$sm_tid = $co_id;
								if(!$sm_tid)	$sm_tid = $bo_table;
								if($sm_tid)		
								echo submenu($sm_tid, 'basic', G5_THEME_PATH); 
							}
						?>
                   </ul>
                </div>
            <!--서브 2차메뉴 끝-->
    
            <!--서브메뉴 타이틀-->
			<?php if($co_id){?> 
                <div id="container_title"><?php echo $g5['title'] ?></div><!--#container_title-->
            <?php if($bo_table) {?>
            	<div style="display:none"></div>
            <?php } ?>
<?php } ?>
<?php } ?>
