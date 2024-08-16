<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

include_once(G5_THEME_PATH.'/head.sub.php');
include_once(G5_LIB_PATH.'/outlogin.lib.php');
include_once(G5_LIB_PATH.'/visit.lib.php');
include_once(G5_LIB_PATH.'/connect.lib.php');
include_once(G5_LIB_PATH.'/popular.lib.php');
include_once(G5_LIB_PATH.'/latest.lib.php');
include_once(G5_LIB_PATH.'/submenu.lib.php');

add_javascript('<script src="'.G5_THEME_JS_URL.'/owl.carousel.min.js"></script>', 10);
add_stylesheet('<link rel="stylesheet" href="'.G5_THEME_JS_URL.'/owl.carousel.css">', 10);
?>

<header id="hd">
	<div class="container">
    <?php if ((!$bo_table || $w == 's' ) && defined('_INDEX_')) { ?><h1><?php echo $config['cf_title'] ?></h1><?php } ?>

    <div id="skip_to_container"><a href="#container">본문 바로가기</a></div>

    <?php if(defined('_INDEX_')) { // index에서만 실행
        include G5_MOBILE_PATH.'/newwin.inc.php'; // 팝업레이어
    } ?>


    <div id="tnb_wrapper">
    	<div id="tnb">
        	<div class="top_txt hidden-xs"><i class="fas fa-star"></i> 회원가입시 1,000포인트!</div><!--.top_txt-->
            <ul>
                <?php if ($is_member) { ?>
                <?php if ($is_admin) {  ?>
                <li><a href="<?php echo G5_ADMIN_URL ?>/shop_admin/" class="adm"> 관리자</a></li>
                <?php } else { ?>
                <li><a href="<?php echo G5_BBS_URL; ?>/member_confirm.php?url=register_form.php">정보수정</a></li>
                <?php } ?>
                <li><a href="<?php echo G5_BBS_URL; ?>/logout.php?url=shop">로그아웃</a></li>
                <?php } else { ?>
                <li><a href="<?php echo G5_BBS_URL; ?>/login.php?url=<?php echo $urlencode; ?>">로그인</a></li>
                <li><a href="<?php echo G5_BBS_URL ?>/register.php">회원가입</a></li>
                <?php } ?>
                <li><a href="<?php echo G5_SHOP_URL; ?>/mypage.php"> 마이페이지</a></li>
                <li class="hidden-xs"><a href="<?php echo G5_SHOP_URL; ?>/orderinquiry.php"> 주문조회</a></li>
                <li class="hidden-xs"><a href="<?php echo G5_SHOP_URL; ?>/cart.php"> 장바구니</a></li>
                <?php /*?><li><a href="<?php echo G5_BBS_URL; ?>/qalist.php"> 1:1문의</a></li>
                <li><a href="<?php echo G5_SHOP_URL; ?>/faq.php"> FAQ</a></li>
                <li><a href="<?php echo G5_SHOP_URL; ?>/itemuselist.php">상품후기</a></li><?php */?>
            </ul>
        </div><!--#tnb-->
    </div><!--#tnb_wrapper-->
     
       
    <div id="hd_wrapper"> 
        <div id="logo"><a href="<?php echo G5_SHOP_URL; ?>/"><img src="<?php echo G5_IMG_URL ?>/logo.jpg" alt="<?php echo $config['cf_title']; ?>"></a></div>
        <div id="tnb_sch" class="hidden-xs">
            <h3>쇼핑몰 검색</h3>
            
            <form name="frmsearch1" action="<?php echo G5_SHOP_URL; ?>/search.php" onsubmit="return search_submit(this);">
            <label for="sch_str" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
            <input type="text" name="q" value="<?php echo stripslashes(get_text(get_search_string($q))); ?>" id="sch_str" placeholder="찾으시는 상품명을 입력해주세요" required>
           <button type="submit" id="sch_submit"><img src="<?php echo G5_THEME_IMG_URL ?>/sch_btn.png" alt="검색"><span class="sound_only">검색</span></button>
            </form>
            <script>
            function search_submit(f) {
            if (f.q.value.length < 2) {
                alert("검색어는 두글자 이상 입력하십시오.");
                f.q.select();
                f.q.focus();
                return false;
            }
            
            return true;
            }
            </script>
        </div><!--#tnb_sch-->
        <div id="top_cus" class="hidden-xs">
        	<span><i class="fas fa-phone"></i> 전화주문가능 / 친절상담</span>
            051.961.0502
            <p>오전 9시 ~ 오후 6시</p>  
        </div>  
    </div><!--#hd_wrapper-->
  
   
	<!-- 모바일 메뉴/검색버튼 시작{ -->
    <div class="visible-xs">
        <button type="button" id="gnb_open" class="hd_opener"><img src="<?php echo G5_THEME_IMG_URL ?>/ico_gnb.png" alt="메뉴"><span class="sound_only"> 열기</span></button>
        <div id="mgnb" class="hd_div">
            <ul id="mtnb">
                <?php if ($is_member) { ?>
                <?php if ($is_admin) {  ?>
                <li><a href="<?php echo G5_ADMIN_URL ?>/shop_admin/"><i class="fas fa-cog"></i> 관리자</a></li>
                <?php } else { ?>
                <li><a href="<?php echo G5_BBS_URL; ?>/member_confirm.php?url=register_form.php"><i class="fas fa-user"></i> 정보수정</a></li>
                <?php } ?>
                <li><a href="<?php echo G5_BBS_URL; ?>/logout.php?url=shop"><i class="fas fa-unlock"></i> 로그아웃</a></li>
                <?php } else { ?>
                <li><a href="<?php echo G5_BBS_URL; ?>/login.php?url=<?php echo $urlencode; ?>"><i class="fas fa-lock"></i> 로그인</a></li>
                <li><a href="<?php echo G5_BBS_URL ?>/register.php" id="snb_join"><i class="fas fa-user"></i> 회원가입</a></li>
                
                <?php } ?>
            </ul>
            <h2>모바일메인메뉴</h2>
            <ul id="mgnb_1dul">
            <?php
            $sql = " select *
                        from {$g5['menu_table']}
                        where me_mobile_use = '1'
                          and length(me_code) = '2'
                        order by me_order, me_id ";
            $result = sql_query($sql, false);

            for($i=0; $row=sql_fetch_array($result); $i++) {
            ?>
                <li class="mgnb_1dli">
                    <a class="mgnb_1da" href="<?php echo G5_URL.$row['me_link']; ?>" target="_<?php echo $row['me_target']; ?>"><?php echo $row['me_name'] ?><i class="fas fa-angle-right"></i></a>
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
                            echo '<ul class="mgnb_2dul">'.PHP_EOL;
                    ?>
                        <li class="mgnb_2dli"><a href="<?php echo G5_URL.$row2['me_link']; ?>" target="_<?php echo $row2['me_target']; ?>" class="mgnb_2da"><span></span><?php echo $row2['me_name'] ?></a></li><!--2차메뉴-->
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
            <button type="button" id="gnb_close" class="hd_closer"><span class="sound_only">메뉴 </span><i class="fas fa-times"></i> 닫기</button>
        </div>
        
		<button type="button" class="shop_cart">
            <a href="<?php echo G5_SHOP_URL; ?>/cart.php"><img src="<?php echo G5_THEME_IMG_URL ?>/ico_cart.png" alt="장바구니"></a>
        </button>
        
        <button type="button" id="hd_sch_open" class="hd_opener"><img src="<?php echo G5_THEME_IMG_URL ?>/ico_sch.png" alt="검색"><span class="sound_only"> 열기</span></button>

        <div id="hd_sch" class="hd_div">
            <div id="sch_div"> 
                 <form name="frmsearch1" action="<?php echo G5_SHOP_URL; ?>/search.php" onsubmit="return search_submit(this);" >
                     <aside id="hd_sch">
                        <div class="sch_inner">
                            <h2>상품 검색</h2>
                            <label for="sch_str" class="sound_only">상품명<strong class="sound_only"> 필수</strong></label>
                            <input type="text" name="q"  id="sch_str" required class="frm_input " placeholder="찾으시는 상품명을 입력해주세요">
                            <button type="submit" class="btn_submit"><i class="fa fa-lg fa-search" aria-hidden="true"></i><span class="sound_only">검색</span></button>
                        </div>
                    </aside>
                </form>
            </div>
        <button type="button" id="sch_close" class="hd_closer"><span class="sound_only">검색 </span><i class="fas fa-times"></i> 닫기</button>
        </div>

        <script>
        $(function () {
            $(".hd_opener").on("click", function() {
                var $this = $(this);
                var $hd_layer = $this.next(".hd_div");

                if($hd_layer.is(":visible")) {
                    $hd_layer.hide();
                    $this.find("span").text("열기");
                } else {
                    var $hd_layer2 = $(".hd_div:visible");
                    $hd_layer2.prev(".hd_opener").find("span").text("열기");
                    $hd_layer2.hide();

                    $hd_layer.show();
                    $this.find("span").text("닫기");
                }
            });

            $(".hd_closer").on("click", function() {
                var idx = $(".hd_closer").index($(this));
                $(".hd_div:visible").hide();
                $(".hd_opener:eq("+idx+")").find("span").text("열기");
            });
        });
        </script>
	</div>
    <!-- }모바일 메뉴/검색버튼 끝 -->

        
        <nav id="gnb" class="hidden-xs">
            <h2>메인메뉴</h2>
            <div id="menu_wrap">
            <?php include_once(G5_SHOP_SKIN_PATH.'/boxcategory.skin.php'); // 상품분류 ?>
            
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
                    ?>
                    <li class="gnb_1dli" style="z-index:<?php echo $gnb_zindex--; ?>">
                        <a href="<?php echo G5_URL.$row['me_link']; ?>" target="_<?php echo $row['me_target']; ?>" class="gnb_1da"><?php echo $row['me_name'] ?></a>
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
                        ?>
                            <li class="gnb_2dli"><a href="<?php echo G5_URL.$row2['me_link']; ?>" target="_<?php echo $row2['me_target']; ?>" class="gnb_2da"><?php echo $row2['me_name'] ?></a></li>
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
          </div><!--#menu_wrap-->  
        </nav>
    </div><!--//container-->
  
</header>



<div id="tgnb" class="visible-xs">
        
        <h2>모바일메인메뉴</h2>
        <ul id="tgnb_1dul">
        <?php
        $sql = " select *
                    from {$g5['menu_table']}
                    where me_mobile_use = '1'
                      and length(me_code) = '2'
                    order by me_order, me_id ";
        $result = sql_query($sql, false);

        for($i=0; $row=sql_fetch_array($result); $i++) {
        ?>
            <li class="tgnb_1dli">
                <a class="tgnb_1da" href="<?php echo G5_URL.$row['me_link']; ?>" target="_<?php echo $row['me_target']; ?>"><?php echo $row['me_name'] ?></a>
            </li>
        <?php
        }

        if ($i == 0) {  ?>
            <li id="gnb_empty">메뉴 준비 중입니다.<?php if ($is_admin) { ?> <br><a href="<?php echo G5_ADMIN_URL; ?>/menu_list.php">관리자모드 &gt; 환경설정 &gt; 메뉴설정</a>에서 설정하세요.<?php } ?></li>
        <?php } ?>
        </ul>
</div><!--#tgnb-->


	<? if(defined('_INDEX_')) {?>
    <? }else { ?>
	<div id="wrapper">
    
		<div class="container" style="padding:0;">
            <h1 id="container_title">
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
            </h1>
            <div id="aside">
            
                    <?php 
            
                        if(!$is_register || $w){ 
                            //서브메뉴 추가
                            if(!$sm_tid)	$sm_tid = $co_id;
                            if(!$sm_tid)	$sm_tid = $bo_table;
                            if($sm_tid)		
                            echo submenu($sm_tid, 'basic', G5_THEME_PATH); 
                        }
                    ?>
            
            </div>

        </div>

        <div id="container" class="container">
		<?php
        $nav_skin = $skin_dir.'/navigation.skin.php';
        if(!is_file($nav_skin))
            $nav_skin = G5_SHOP_SKIN_PATH.'/navigation.skin.php';
        include $nav_skin;
        ?>        
            

    
    <? } ?> 
