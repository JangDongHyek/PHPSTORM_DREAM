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
<script type="text/javascript">

    function mobile_homebutton(title) {
        var page_uri = "http://" + document.domain,
            main_uri = page_uri + "/m/main.html",
            icon_uri = '',
            user_agent = navigator.userAgent.toLowerCase();
        var title = (title.length > 0) ? title : shop_name,
            encode_title = encodeURI(title);

        (function($) {
            $(function() {
                $('link').each(function() {
                    if ($(this).attr('rel') == "apple-touch-icon-precomposed") {
                        icon_uri = page_uri + $(this).attr('href');
                    }
                });
            });
        })(jQuery);

        var call_uri= "intent://addshortcut?url="+main_uri +"&icon="+icon_uri +"&title="+encode_title+"&oq="+encode_title+"&serviceCode=nstore&version=7#Intent;scheme=naversearchapp;action=android.intent.action.VIEW;category=android.intent.category.BROWSABLE;package=com.nhn.android.search;end";
        if (user_agent.match(/ipad|iphone|ipod/g)) {
            alert('아이폰, 아이패드계열은 직접 홈버튼 추가를 사용하셔야 합니다.');
        } else {
            alert(title+'을(를) 홈화면에 추가합니다. 네이버앱이 없는 고객님께서는 네이버앱 설치페이지로 이동됩니다.');
            document.location.href = call_uri;
        }
    }
</script>
<script type="text/javascript"> 

// 접속 핸드폰 정보 

var userAgent = navigator.userAgent.toLowerCase();

var url = "<?php echo G5_URL?>";
var icon = "<?php echo G5_URL?>/img/m_logo02.png";
var title = "영남잔치상";
var serviceCode = "JANCHSANG";
function home_key(){
	document.location.href='naversearchapp://addshortcut?url='+url+'&icon='+icon+'&title='+title+'&serviceCode='+serviceCode+'&version=7';
	//document.write('<object id="bookmark_obj" type="text/html" data="naversearchapp://addshortcut?url='+url+'&icon='+icon+'&title='+title+'&serviceCode='+serviceCode+'&version=7" width="0" height="0"></object>');

}
function addHome(){
	if(userAgent.match('iphone')) { 
		alert("아이폰은 직접 홈추가를 하셔야 합니다.");
	} else if(userAgent.match('ipad')) { 
		alert("아이패드는 직접 홈추가를 하셔야 합니다.");
	} else if(userAgent.match('ipod')) { 
		alert("아이팟은 직접 홈추가를 하셔야 합니다.");
	} else if(userAgent.match('android')) { 
		home_key();
	} 
}


</script>
<header id="hd">
	<div id="super_top">
		<div class="inr">
		<a id="bookmark-this" href="#" class="add_btn">★ 영남잔치상 즐겨찾기를 추가해 주세요!</a>
		<script>
        $('#bookmark-this').click(function(e) {//북마크 JS
            var bookmarkURL = window.location.href;
            var bookmarkTitle = document.title;
            var triggerDefault = false;
        
            if (window.sidebar && window.sidebar.addPanel) {
                // Firefox version < 23
                window.sidebar.addPanel(bookmarkTitle, bookmarkURL, '');
            } else if ((window.sidebar && (navigator.userAgent.toLowerCase().indexOf('firefox') > -1)) || (window.opera && window.print)) {
                // Firefox version >= 23 and Opera Hotlist
                var $this = $(this);
                $this.attr('href', bookmarkURL);
                $this.attr('title', bookmarkTitle);
                $this.attr('rel', 'sidebar');
                $this.off(e);
                triggerDefault = true;
            } else if (window.external && ('AddFavorite' in window.external)) {
                // IE Favorite
                window.external.AddFavorite(bookmarkURL, bookmarkTitle);
            } else {
                // WebKit - Safari/Chrome
                alert((navigator.userAgent.toLowerCase().indexOf('mac') != -1 ? 'Cmd' : 'Ctrl') + '+D 를 누르세요.');
            }
        
            return triggerDefault;
        });
        </script>   
			<ul class="list ver_top">
				<li><a href="<?php echo G5_SHOP_URL; ?>/index.php"> 처음으로</a></li>
				<?php if ($is_member) { ?>
				<?php if ($is_admin) {  ?>
				<?php ?><li><a href="<?php echo G5_URL; ?>/adm" target="_blank">관리자</a></li><?php ?>
				<?php } else { ?>
				<?php } ?>
				<li><a href="<?php echo G5_BBS_URL; ?>/logout.php?url=shop"> 로그아웃</a></li>
				<li><a href="<?php echo G5_BBS_URL; ?>/register_form.php?w=u">정보수정</a></li>
				<?php } else { ?>
				<li><a href="<?php echo G5_BBS_URL; ?>/login.php">로그인</a></li>
				<!--<li><a href="<?php echo G5_BBS_URL ?>/register_form.php" id="snb_join"> 회원가입</a></li>-->
				<?php } ?>
				<li><a href="<?php echo G5_SHOP_URL; ?>/mypage.php"> 마이페이지</a></li>
				<li><a href="<?php echo G5_SHOP_URL; ?>/cart.php"> 장바구니</a></li>
				<li><a href="<?php echo G5_SHOP_URL; ?>/wishlist.php"> 상품보관함</a></li>
				<li><a href="<?php echo G5_SHOP_URL; ?>/list.php?ca_id=e0"> 개인결제창</a></li>
			</ul>
			</div>

	</div>
	<div id="hd_tnb">
		<div class="inr flexBox">
			<h1 class="hd_bnr ver01"><a href="<?php echo G5_SHOP_URL; ?>/"><img src="<?php echo G5_THEME_IMG_URL ?>/common/logo.png" alt="<?php echo $config['cf_title']; ?>" /></a></h1>
            <button type="button" id="gnb_open" class="hd_opener" style="display:none;"><i class="fal fa-bars"></i><span class="sound_only"> 열기</span></button>
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
				<div class="add_sch">
					<span class="tit">인기검색어</span>
					<div class="swiper-container sch_slide">                
						<div class="swiper-button-prev"></div>
						<div class="swiper-button-next"></div>
						<div class="swiper-wrapper">     
							<?php
								$sql="select pp_word, count(*) as cnt from g5_popular a where trim(pp_word) <> '' group by pp_word order by cnt desc limit 0, 10";
								$result=sql_query($sql);
								for($i=0;$row=sql_fetch_array($result);$i++){?>
							
							<div class="swiper-slide">
								<span class="num"><?php echo $i+1?></span> <a href="<?php echo G5_SHOP_URL?>/search.php?q=<?php echo $row[pp_word]?>"><?php echo $row[pp_word]?></a>
							</div>                
							<?php }?>
<!--							<div class="swiper-slide"><a href="#">검색어2</a></div>                
							<div class="swiper-slide"><a href="#">검색어3</a></div>                -->
						</div>                
					</div>
				</div>

			</div><!--#tnb_sch-->
			<div class="hd_bnr ver02">
				<div class="swiper-container hd_bnr_slide">
						<div class="swiper-wrapper">
                            <div class="swiper-slide"><img src="<?php echo G5_THEME_IMG_URL ?>/hd_bnr_slide4.png" alt=""></div>           
							<div class="swiper-slide"><img src="<?php echo G5_THEME_IMG_URL ?>/hd_bnr_slide3.png" alt=""></div>                
							<div class="swiper-slide"><img src="<?php echo G5_THEME_IMG_URL ?>/hd_bnr_slide2.png" alt=""></div>                
							<div class="swiper-slide"><img src="<?php echo G5_THEME_IMG_URL ?>/hd_bnr_slide1.png" alt=""></div>                
						</div>
					<div class="swiper-controller">
						 <div class="swiper-button-prev"><i class="fal fa-angle-up"></i></div>
						<div class="swiper-button-next"><i class="fal fa-angle-down"></i></div> </div>
		               
				</div>
				<!-- /hd_bnr_slide -->
			</div>
			<!-- /hd_bnr -->
		</div>
		<!-- /flexBox -->
	</div>
	<!-- /hd_tnb -->
	<div>
		<?php if ((!$bo_table || $w == 's' ) && defined('_INDEX_')) { ?><h1><?php echo $config['cf_title'] ?></h1><?php } ?>
		<div id="skip_to_container"><a href="#container">본문 바로가기</a></div>
		<?php if(defined('_INDEX_')) { // index에서만 실행
			include G5_MOBILE_PATH.'/newwin.inc.php'; // 팝업레이어
		} ?>


    <div id="hd_wrapper">       
        <div class="inr">                
			

				<!--
				<div id="top_menu">
                <ul>

                    <li><a href="<?php echo G5_SHOP_URL; ?>/mypage.php" class="ico_myp">마이페이지</a></li>
                    <li><a href="<?php echo G5_SHOP_URL; ?>/orderinquiry.php" class="ico_deli">주문배송</a></li>
                    <li><a href="<?php echo G5_SHOP_URL; ?>/cart.php" class="ico_bask">장바구니</a></li>
                    
                </ul>
            </div><!--#top_menu-->
        </div>
    </div><!--#hd_wrapper-->
        

	<!-- 모바일 메뉴/검색버튼 시작{ -->

	<div class="m_top_box ">
    <h1 id="logo"><a href="<?php echo G5_SHOP_URL; ?>/"><img src="<?php echo G5_THEME_IMG_URL ?>/common/logo.png" alt="<?php echo $config['cf_title']; ?>" /></a></h1>
    <div class="msearch">
		  
        

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
        <!--<a href="#none" class="hd_bookmark" onclick="mobile_homebutton('영남잔치상');"><i class="fal fa-bookmark"></i><span class="sound_only"> 즐겨찾기</span></a>
        <button type="button" id="bookmark-this" class="hd_bookmark"><i class="fal fa-bookmark"></i><span class="sound_only"> 즐겨찾기</span></button>-->
		<a href="javascript:;" class="hd_bookmark" onclick="addHome()"><i class="fal fa-bookmark"></i><span class="sound_only"> 홈화면추가</span></a>
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

  
  
<div class="nav_open">
    <a href="#hash-menu" id="hash_menu" data-role="button" data-url="<?php echo G5_PLUGIN_URL;?>/hash/" data-ref="1" data-animation="left">
        <i class="fal fa-bars"></i>
    </a>
</div><!--모바일메뉴버튼-->

        
<!-- }pc상단메뉴 -->        
<nav id="gnb">
<div class="inr">
        <h2>메인메뉴</h2>

        <div id="gnb_wrap">
	
            <ul id="gnb_1dul">
                <!-- <li class="gnb_1dli gnb_mnal"><button type="button" class="gnb_menu_btn"><i class="fa fa-bars" aria-hidden="true"></i><span class="sound_only">전체메뉴열기</span></button></li> -->
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
<!-- 			<li class="gnb_1dli"><a href="<?php echo G5_URL ?>/shop/listtype.php?type=4" class="gnb_1da">인기상품</a></li>
			<li class="gnb_1dli"><a href="<?php echo G5_URL ?>/shop/listtype.php?type=2" class="gnb_1da">추천상품</a></li>
			<li class="gnb_1dli lastVer"><a href="<?php echo G5_URL ?>/shop/listtype.php?type=3" class="gnb_1da">신상품</a></li>
			
			 -->
			 </ul>
        </div>
    </nav><!--pc메인메뉴-->         
        
        
        </div>
        
    </div><!--//container-->
  
</header>


<div class="newContainer inr">

<div id="tgnb" class="" style="display:none">
        
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
    <section class="newSection flexBox subVer">
	<div class="leftBox">
		<div id="left_menu">
			<p class="tit">상품목록</p>

			<?php
				$sql="select * from g5_shop_category where length(ca_id)='2' and ca_id!='e0' order by ca_order asc";
				$result=sql_query($sql);
				
			?>
			<ul>
				<?php
					for($i=0;$row=sql_fetch_array($result);$i++){
				?>
				<li><a href="<?php echo G5_SHOP_URL?>/list.php?ca_id=<?php echo $row[ca_id]?>"><?php echo $row[ca_name]?></a></li>
				<?php }?>
				<!--<li><a href="#Link">명절차례상</a></li>
				<li><a href="#Link">시제음식</a></li>
				<li class="line"><a href="#Link">추가/맞춤음식</a></li>
				<li><a href="#Link">고사음식</a></li>
				<li><a href="#Link">뒷풀이음식</a></li>
				<li><a href="#Link">행사대행</a></li>
				<li class="line"><a href="#Link">행사용품</a></li>
				<li><a href="#Link">이바지음식</a></li>
				<li><a href="#Link">집들이음식</a></li>
				<li><a href="#Link">행사도시락</a></li>
				<li class="line"><a href="#Link">출장뷔페</a></li>-->
			</ul>
		</div>
		<!-- /left_menu -->
		<div class="left_latest">
			<div class="latest_box ver1">
				<a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=gall01" class="tit">고사 행사갤러리</a>
				<?php
				echo latest('theme/gallery', 'gall01', 5, 25);
				?>

			</div>
			<div class="latest_box ver2">
				<a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=gall02" class="tit">잔치음식 갤러리</a>
				<?php
				echo latest('theme/gallery', 'gall02', 5, 25);
				?>

			</div>
            <div class="latest_box ver3">
                <a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=review" class="tit">제사후기 갤러리</a>
                <?php
                echo latest('theme/gallery', 'review', 5, 25);
                ?>

            </div>
			<!--<div class="latest_box ver3">
				
				<a href="<?php /*echo G5_BBS_URL */?>/board.php?bo_table=qa" >
					<p class="tit">온라인 견적의뢰</p>
					<p class="txt">미리 예상금액을 산출하고<br>싶으시면 온라인 문의로<br>견적을 받아보세요</p>
				</a>
			</div>-->
		</div>
		<!-- /left_latest -->
	</div>
	<!-- /leftBox -->

	<div class="sub_cont_box">


		<div<?php if($co_id||$bo_table) {?> class="hd_wrap" <?}?> >
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
				</ul>
			<?php }?>
			<!--//상품로케이션 시작 {-->
			<?php
				if($co_id!="comp2"){
			?>
            <h1 id="container_title">
                <?php if($bo_table) {?>
					<!-- 게시판 별 백그라운드 이미지를 넣으시면 됩니다. -->
						<div class="<?php echo $bo_table?>"><?php echo $board['bo_subject']; ?></div>

                <?php }else { ?>
				
					<?php if($ca_id){
						$ca_id_first=substr($ca_id,0,2);
					?>
						<!-- 카테고리 별 백그라운드 이미지를 넣으시면 됩니다. -->
						<div class="ca_id<?php echo $ca_id_first?>"><?php echo $g5['title'] ?></div>
					<?php }else{
						
					?>
	                    <?php echo $g5['title'] ?>
					<?php }?>
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
			<?php }?>
			
			<?php } ?>
            <div id="aside">
            			

				<?php 
					//if($co_id!="comp2"){
					if(!$is_register || $w){ 
						//서브메뉴 추가
						if(!$sm_tid)	$sm_tid = $co_id;
						if(!$sm_tid)	$sm_tid = $bo_table;
						if($sm_tid)		
						echo submenu($sm_tid, 'basic', G5_THEME_PATH); 
					}
				//}
				?>
            </div>

        </div>

        <div id="new_sub_cont"><!-- id= container -->
			<?php if($co_id=="jesa_info" || $co_id=="gosa_info" || $co_id=="pb_info" || $co_id=="ibaz" ) {?>
				<?php include_once('inc/top_link.php'); ?>
			<?php } ?>
    
    <? } ?> 
    

