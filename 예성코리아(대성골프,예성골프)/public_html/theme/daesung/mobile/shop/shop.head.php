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

<?php /*?>
<div id="top_popup"><a href="<?php echo G5_BBS_URL ?>/register_intro.php">
    <div>지금 회원가입 하시고, 무료배송의 기회를 잡으세요. </div></a>
    <button type="button" class="top_close"><span class="sound_only">닫기 </span><i class="fal fa-times"></i></button>
    
</div>

<script>
$(function () {
    $(".top_close").on("click", function() {
        var idx = $(".top_close").index($(this));
        $("#top_popup:visible").hide();
		$(".hd_opener:eq("+idx+")").find("span").text("열기");
    });
});
</script><?php */?>




<header id="hd">
	<!--
	<div id="hd_tnb">
		<div class="inr">
			<ul class="list">
				<?php if ($is_member) { ?>
				<?php if ($is_admin) {  ?>
				<?php /*?><li><a href="<?php echo G5_ADMIN_URL ?>/shop_admin/"> 관리자</a></li><?php */?>
				<?php } else { ?>
				<?php } ?>
				<li><a href="<?php echo G5_URL; ?>/adm"> 관리자</a></li>
				<li><a href="<?php echo G5_BBS_URL; ?>/logout.php?url=shop"> 로그아웃</a></li>
				<li><a href="<?php echo G5_BBS_URL; ?>/member_confirm.php?url=register_form.php"> 정보수정</a></li>
				<?php } else { ?>
				<li><a href="<?php echo G5_BBS_URL; ?>/login.php">로그인</a></li>
				<li><a href="<?php echo G5_BBS_URL ?>/register_form.php" id="snb_join"> 회원가입</a></li>
				
				<?php } ?>
				<li><a href="<?php echo G5_SHOP_URL; ?>/cart.php"> 장바구니</a></li>
			</ul>
		</div>
	</div>
	-->
	<div class="container">
    <?php if ((!$bo_table || $w == 's' ) && defined('_INDEX_')) { ?><h1><?php echo $config['cf_title'] ?></h1><?php } ?>

    <div id="skip_to_container"><a href="#container">본문 바로가기</a></div>

    <?php if(defined('_INDEX_')) { // index에서만 실행
        include G5_MOBILE_PATH.'/newwin.inc.php'; // 팝업레이어
    } ?>


    <div id="hd_wrapper">       
        <div class="inr">
            <a class="back_btn" onclick='history.back();'><i class="fa-light fa-arrow-left"></i></a>

            <div id="logo"><a href="<?php echo G5_SHOP_URL; ?>/"><img src="<?php echo G5_THEME_IMG_URL ?>/common/logo.png" alt="<?php echo $config['cf_title']; ?>" /></a></div>
			
                <div id="tnb_sch">
                    <h3>쇼핑몰 검색</h3>
						<form name="frmsearch1" action="<?php echo G5_SHOP_URL; ?>/search.php" onsubmit="return search_submit(this);">
                    
                    <label for="sch_str" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
                    <input type="text" name="q" value="<?php echo stripslashes(get_text(get_search_string($q))); ?>" id="sch_str" placeholder="검색어를 입력하세요!" required>
                   <?php /*?> <input name="q" type="text" required="required" id="sch_str"  onfocus="this.style.backgroundImage = 'url(none)'" /><?php */?>
                   
                   
                   
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
                </div>
				<!--#tnb_sch-->
				
				<div id="top_menu">
                <ul>

                    <li><a href="<?php echo G5_SHOP_URL; ?>/mypage.php" class="ico_myp"><i class="fa-light fa-user"></i><p>마이페이지</p></a></li>
                    <li><a href="<?php echo G5_SHOP_URL; ?>/orderinquiry.php" class="ico_deli"><i class="fa-light fa-truck-fast"></i><p>배송조회</p></a></li>
                    <li><a href="<?php echo G5_SHOP_URL; ?>/cart.php" class="ico_bask"><i class="fa-light fa-cart-shopping"></i><p>장바구니</p></a></li>
                    
                </ul>
            </div>
			<!--#top_menu-->
        </div>
    </div><!--#hd_wrapper-->
        

	<!-- 모바일 메뉴/검색버튼 시작{ -->
    <div class="msearch">
        <button type="button" id="gnb_open" class="hd_opener" style="display:none;"><i class="fal fa-bars"></i><span class="sound_only"> 열기</span></button>

        <div id="mgnb" class="hd_div">
			<!--로그인/로그아웃-->
            


			<!--고객센터-->
            <h2>모바일메인메뉴</h2>
             <ul id="mgnb_1dul">
             	<li class="mgnb_1dli">
                 <a class="mgnb_1da" href="<?php echo G5_BBS_URL; ?>/board.php?bo_table=notice">공지사항<i class="fas fa-angle-right"></i></a>
                </li>
             	<li class="mgnb_1dli">
                 <a class="mgnb_1da" href="<?php echo G5_BBS_URL; ?>/faq.php">자주하는 질문<i class="fas fa-angle-right"></i></a>
                </li>
             	<li class="mgnb_1dli">
                 <a class="mgnb_1da" href="<?php echo G5_BBS_URL; ?>/qalist.php">1:1문의<i class="fas fa-angle-right"></i></a>
                </li>
             </ul>
            
            
            
            
            
           <?php /*?> <ul id="mgnb_1dul">
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
                        <li class="mgnb_2dli">
							<a href="<?php echo G5_URL.$row2['me_link']; ?>" target="_<?php echo $row2['me_target']; ?>" class="mgnb_2da"><span></span><?php echo $row2['me_name'] ?></a>
						</li><!--2차메뉴-->
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
            </ul><?php */?>
            <button type="button" id="gnb_close" class="hd_closer"><span class="sound_only">닫기</span><i class="fas fa-times"></i></button>
        </div>
        
		<button type="button" class="shop_cart">
            <a href="<?php echo G5_SHOP_URL; ?>/cart.php"><i class="fal fa-shopping-cart"></i><span class="sound_only"> 장바구니</span></a>
        </button>
        
        <button type="button" id="hd_sch_open" class="hd_opener"><i class="fal fa-search"></i><span class="sound_only"> 검색</span></button>

        <div id="hd_sch" class="hd_div">
            <div id="sch_div"> 
                 <form name="frmsearch1" action="<?php echo G5_SHOP_URL; ?>/search.php" onsubmit="return search_submit(this);" >
                     <aside id="hd_sch">
                        <div class="sch_inner">
                            <h2>상품 검색</h2>
                            <label for="sch_str" class="sound_only">상품명<strong class="sound_only"> 필수</strong></label>
                            <input type="text" name="q"  id="sch_str" required class="frm_input " placeholder="찾으시는 상품명을 입력해주세요">
                            <button type="submit" class="btn_submit02"><i class="fa fa-search" aria-hidden="true"></i><span class="sound_only">검색</span></button>
                        </div>
                    </aside>
                </form>
            </div>
        <button type="button" id="sch_close" class="hd_closer"><span class="sound_only">검색닫기</span><i class="fal fa-times"></i> </button>
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



        <!--<div class="nav_open">
    <a href="#hash-menu" id="hash_menu" data-role="button" data-url="<?php echo G5_PLUGIN_URL;?>/hash/" data-ref="1" data-animation="left">
        <i class="fal fa-bars"></i>
    </a>
</div>모바일메뉴버튼-->

        
<!-- }pc상단메뉴 -->        
<nav id="gnb">
        <h2>메인메뉴</h2>

        <div id="gnb_wrap">
			<div id="all_category"><?php include_once(G5_THEME_MSHOP_PATH.'/category.php') ?></div>
        	<?php /*?><div><?php include_once(G5_THEME_MSHOP_PATH.'/category.php') ?></div><?php */?>
        
            <ul id="gnb_1dul">

                <!-- <li class="gnb_1dli gnb_mnal"><button type="button" class="gnb_menu_btn"><i class="fa fa-bars" aria-hidden="true"></i><span class="sound_only">전체메뉴열기</span></button></li> 
                    < ?php
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
                        < ?php
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
                        < ?php
                        }
        
                        if($k > 0)
                            echo '</ul>'.PHP_EOL;
                        ?>
                    </li>
                    < ?php
                    }
        
                    if ($i == 0) {  ?>
                        <li id="gnb_empty">메뉴 준비 중입니다.<?php if ($is_admin) { ?> <br><a href="<?php echo G5_ADMIN_URL; ?>/menu_list.php">관리자모드 &gt; 환경설정 &gt; 메뉴설정</a>에서 설정하실 수 있습니다.<?php } ?></li>
                    < ?php } ?-->
            <li class="gnb_1dli nav_open"><a href="#hash-menu" id="hash_menu" class="gnb_1da" data-role="button" data-url="<?php echo G5_PLUGIN_URL;?>/hash/" data-ref="1" data-animation="left"><i class="fal fa-bars"></i> 카테고리</a></li><!--모바일메뉴버튼-->
                <li class="gnb_1dli"><a href="<?php echo G5_URL ?>/shop/listtype.php?type=4" class="gnb_1da">인기상품</a></li>
                <li class="gnb_1dli"><a href="<?php echo G5_URL ?>/shop/listtype.php?type=2" class="gnb_1da">추천상품</a></li>
                <li class="gnb_1dli"><a href="<?php echo G5_URL ?>/shop/listtype.php?type=3" class="gnb_1da">신상품</a></li>
                <div class="ct_top_wrap">
                    <?php
                    $mshop_ca_href = G5_SHOP_URL.'/list.php?ca_id=';
                    $mshop_ca_res1 = sql_query(get_mshop_category('', 2));
                    for($i=0; $mshop_ca_row1=sql_fetch_array($mshop_ca_res1); $i++) {
                        if($i == 0)
                            echo '<ul class="cate">'.PHP_EOL;
                        ?>
                        <li class="cate_li_1">
                        <a href="<?php echo $mshop_ca_href.$mshop_ca_row1['ca_id']; ?>" class="cate_li_1_a"><?php echo get_text($mshop_ca_row1['ca_name']); ?></a>
                        <?php
                        $mshop_ca_res2 = sql_query(get_mshop_category($mshop_ca_row1['ca_id'], 4));

                        for($j=0; $mshop_ca_row2=sql_fetch_array($mshop_ca_res2); $j++) {
                            if($j == 0)
                                echo '<ul class="sub_cate sub_cate1">'.PHP_EOL;
                            ?>
                            <li class="cate_li_2">
                            <a href="<?php echo $mshop_ca_href.$mshop_ca_row2['ca_id']; ?>"><?php echo get_text($mshop_ca_row2['ca_name']); ?></a>
                            <?php
                            $mshop_ca_res3 = sql_query(get_mshop_category($mshop_ca_row2['ca_id'], 6));
                            for($k=0; $mshop_ca_row3=sql_fetch_array($mshop_ca_res3); $k++) {
                                if($k == 0)
                                    echo '<ul class="sub_cate2">'.PHP_EOL;
                                ?>
                                <li class="cate_li_3">
                                    <a href="<?php echo $mshop_ca_href.$mshop_ca_row3['ca_id']; ?>"><?php echo get_text($mshop_ca_row3['ca_name']); ?></a>
                                </li>

                            <?php }
                            if($k > 0)
                                echo '</ul>'.PHP_EOL;
                            ?>
                            </li>
                            <?php
                        }

                        if($j > 0)
                            echo '</ul>'.PHP_EOL;
                        ?>
                        </li>
                        <?php
                    }


                    ?>
                </div>
			 
			 </ul>

			<ul id="nav_menu">
				<li><a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=company">BRAND</a></li>
				<li><a href="<?php echo G5_BBS_URL; ?>/board.php?bo_table=notice">NOTICE</a></li>
				<li><a href="<?php echo G5_BBS_URL; ?>/board.php?bo_table=qa">Q&amp;A</a></li>
				<!--li><a href="<?php echo G5_SHOP_URL; ?>/list.php?ca_id=c0"  style="font-weight:600">개인결제</a></li-->
			</ul>

			<div id="top_right">
				<ul id="mtnb">
					<?php if ($is_member) { ?>
					<?php if ($is_admin) {  ?>
					<?php /*?><li><a href="<?php echo G5_ADMIN_URL ?>/shop_admin/"> 관리자</a></li><?php */?>
					<?php } else { ?>
					<?php } ?>
					<li><a href="<?php echo G5_URL; ?>/adm"> ADMIN</a></li>
					<li><a href="<?php echo G5_BBS_URL; ?>/logout.php?url=shop"> LOGOUT</a></li>
					<?php } else { ?>
					<li><a href="<?php echo G5_BBS_URL; ?>/login.php">LOGIN</a></li>
					<li><a href="<?php echo G5_BBS_URL ?>/register_form.php" id="snb_join"> SIGN UP</a></li>
					<?php } ?>
				</ul>
			</div>
        </div>
    </nav><!--pc메인메뉴-->         
        
        
        
        
    </div><!--//container-->
  
</header>



<div id="tgnb" class="">
        
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
            <!--<li class="tgnb_1dli">
                <div class="dropdown">
                  <button id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    고객센터
                    <span class="caret"></span>
                  </button>
                  <dl class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                      <dd><a href="<?php echo G5_BBS_URL; ?>/board.php?bo_table=notice">공지사항</a></dd>
                      <dd><a href="<?php echo G5_BBS_URL; ?>/faq.php">자주하는 질문</a></dd>
                      <dd><a href="<?php echo G5_BBS_URL; ?>/qalist.php">1:1문의 게시판</a></dd>
                  </dl>
                </div>
            </li>-->
        </ul>
</div><!--#tgnb-->


	<? if(defined('_INDEX_')) {?>
    <? }else { ?>
	<div id="wrapper">
    
		<div class="inr" style="padding:0;">
			<?php if($noneTop=="ok"  || $it_id ) {?>
			<?php }else { ?>		
			<?php if($_GET[ca_id]){
				$ca_id1=substr($_GET['ca_id'],0,2);
				if(4<=strlen($_GET[ca_id])){
					$ca_id2=substr($_GET['ca_id'],0,4);
				}
				if(strlen($_GET[ca_id])=="6"){
					$ca_id3=substr($_GET['ca_id'],0,6);
				}

				$caRow1=sql_fetch("select ca_id,ca_name from {$g5['g5_shop_category_table']} where ca_id='$ca_id1'");
				$caRow2=sql_fetch("select ca_id,ca_name from {$g5['g5_shop_category_table']} where ca_id='$ca_id2'");
				$caRow3=sql_fetch("select ca_id,ca_name from {$g5['g5_shop_category_table']} where ca_id='$ca_id3'");
			
			?>
			<!--상품로케이션 시작 {-->
				<ul id="shop_location">
					<li><a href="<?php echo G5_THEME_SHOP_URL; ?>">HOME</a></li>
					<li><a href="<?php echo G5_SHOP_URL; ?>/list.php?ca_id=<?php echo $ca_id1?>" class="<?php echo strlen($_GET[ca_id])=="2"?"current":"";?>"><?php echo $caRow1[ca_name]?></a></li>
					<?php
						if($ca_id2!=""){?>
					<li><a href="<?php echo G5_SHOP_URL; ?>/list.php?ca_id=<?php echo $ca_id2?>" class="<?php echo strlen($_GET[ca_id])=="4"?"current":"";?>"><?php echo $caRow2[ca_name]?></a></li>
					<?php }?>
					<?php
						if($ca_id3!=""){?>
					<li><a href="<?php echo G5_SHOP_URL; ?>/list.php?ca_id=<?php echo $ca_id3?>" class="<?php echo strlen($_GET[ca_id])=="6"?"current":"";?>"><?php echo $caRow3[ca_name]?></a></li>
					<?php }?>
<!--					<li><a class="current" href="<?php echo G5_SHOP_URL; ?>/list.php?ca_id=102010">침대</a></li>-->
				</ul>
			<?php }?>
			<!--//상품로케이션 시작 {-->

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
			
			<?php } ?>
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

        <div id="container" class="inr">

           
    
    <? } ?> 
    
    <div class="todayview">
    <?php include(G5_SHOP_SKIN_PATH.'/boxtodayview.skin.php'); // 오늘 본 상품 ?>
	</div>