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

$uri = $_SERVER['REQUEST_URI'];
?>

<style>
    /*#tnb_sch .sch_word {
        background: #fff;
        height: 200px;
        width: 400px;
        position: absolute;
        top: 50px;
        border: 1px solid black;
        z-index: 6;
        display: none;
    }

    .sch_word div {
        color: black;
        font-size: 1.3em;
        margin: 5px;
    }*/

    /* 자동 완성 */
    .ui-autocomplete {
        width: 280px !important;
        top: 73px !important;
    }
    .ui-autocomplete .ui-menu-item {
        font-size: 1.2em !important;
        margin: 5px 5px 5px 5px !important;
        height: 30px !important;
    }
</style>

<!-- 상단 시작 { -->
    <?php
    if(defined('_INDEX_')) { // index에서만 실행
        include G5_BBS_PATH.'/newwin.inc.php'; // 팝업레이어
    }
    ?>

<div id="hd">
    <h1 id="hd_h1"><?php echo $g5['title'] ?></h1>
    <div id="skip_to_container"><a href="#container">본문 바로가기</a></div>


    <? if(defined('_INDEX_')) /*인덱스*/{?> 
        <div id="hd_wrapper">

            <!--뒤로가기-->
            <div class="moback"><a href="javascript:history.back();"><i class="fal fa-angle-left"></i></a></div>
            <div id="logo">
                <a href="<?php echo G5_URL ?>/index.php"><img src="<?php echo G5_THEME_IMG_URL ?>/common/logo.png" alt="로고"></a>
            </div>
            <!--검색-->
            <div class="mosearch"><a href="javascript::"><i class="fal fa-search"></i></a></div>
            
            <!--모바일 검색-->
            <div id="tnb_msch">
            <h3>검색</h3>
            <form name="frmsearch1" id="form1" action="<?php echo G5_BBS_URL ?>/search.php" onsubmit="return search_submit(this);">
                <label for="sch_str" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
                <select name="option">
                    <option <?php echo get_selected($_GET['option'], "talent"); ?> value="talent">재능</option>
<!--                    <option --><?php //echo get_selected($_GET['option'], "video_lecture"); ?><!-- value="video_lecture">지식재능강의</option>-->
<!--                    <option --><?php //echo get_selected($_GET['option'], "competition"); ?><!-- value="competition">공모전</option>-->
                </select>
                <input type="text" name="stx" value="<?php echo stripslashes(get_text(get_search_string($stx))); ?>" id="sch_str1" placeholder="검색어를 입력하세요." required onclick="input_word('1');">
                <button type="submit" id="sch_submit"><i class="fal fa-search"></i><span class="sound_only">검색</span></button>
                <div class="mosearch_close"><i class="fal fa-times-square"></i></div>
            </form>
            </div><!--#tnb_msch-->
            <!--//모바일 검색-->

            <div id="r_area">
                <!--검색영역(메인)-->
                <div id="tnb_sch">
                    <h3>검색</h3>
                    <form name="frmsearch1" id="form2" action="<?php echo G5_BBS_URL ?>/search.php" onsubmit="return search_submit(this);" autocomplete="off">
                        <label for="sch_str" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
                        <select name="option">
                                <option <?php echo get_selected($_GET['option'], "talent"); ?> value="talent">재능거래</option>
                                <option>캠페인</option>
                                <option>공모전</option>
                                <option>마켓</option>
                                <option>구인구직</option>
                        </select>
                        <input type="text" name="stx" value="<?php echo stripslashes(get_text(get_search_string($stx))); ?>" id="sch_str2" placeholder="검색어를 입력하세요." required onclick="input_word('2');">
                        <button type="submit" id="sch_submit"><img src="<?php echo G5_THEME_IMG_URL ?>/common/sch_btn02.png" alt="검색"><span class="sound_only">검색</span></button>
                    </form>
                </div><!--#tnb_sch-->
                <!--로그인영역-->
                <ul id="tnb">
                    <!--<li><a href="javascript:swal('준비중입니다.');">전문인 등록</a></li>-->
                    <?php if ($is_member) {  ?>
                        <?php if ($is_admin) {  ?>
                            <li><a href="<?php echo G5_ADMIN_URL ?>" title="관리자" class="line"><i class="fas fa-cog"></i> 관리자</a></li>
                        <?php }  ?>
                            <li class="male-auto">
                                <a href="" title="알림" class="line"><i class="fa-solid fa-bell"></i></a>
                                <span class="no_read_badge none" onclick="">0</span>
                            </li>
                            <li>
                                <a href="<?php echo G5_BBS_URL ?>/message.php" title="채팅" class="line"><i class="fa-solid fa-comments"></i></a>
                                <?php
                                // 전체 읽지 않은 메세지 수
                                $no_read_badge = sql_fetch("select count(*) as cnt from chat_message_log where user_id='{$member['mb_id']}' and read_status='0'")['cnt']; // 메세지 로그
                                ?>
                                <span class="no_read_badge <?php if($no_read_badge==0) { echo 'none'; }?>" onclick="chatting();"><?=$no_read_badge?></span>
                            </li>
                            <li>
                                <a href="<?php echo G5_BBS_URL ?>/cart.php" title="카트" class="line"><i class="fa-solid fa-cart-shopping"></i></a>
                                <span class="no_read_badge none" onclick="">0</span>
                            </li>
                            <li>|</li>
                            <li><a href="<?php echo G5_BBS_URL ?>/my_campaign.php" title="마이페이지" class="line txt_color">마이페이지</a></li>
                            <li><a href="javascript:logout();" title="로그아웃" class="line">로그아웃</a></li>
                    <?php } else /*$is_member*/{  ?>
                        <li><a href="<?php echo G5_URL ?>/new_campaign.php" title="" class="join us">협업제안</a></li>
                        <li><a href="<?php echo G5_BBS_URL ?>/login.php" title="로그인" class="line">로그인</a></li>
                        <li><a href="<?php echo G5_BBS_URL ?>/register_new.php" title="회원가입" class="join">회원가입</a></li>
                    <?php }  ?>
                </ul>
            </div><!--r_area-->

            <div class="nav_open">
                <a href="#hash-menu" id="hash_menu" data-role="button" data-url="<?php echo G5_PLUGIN_URL;?>/hash/" data-ref="1" data-animation="right">
                    <span></span><span></span><span></span>
                </a>
            </div>
        </div><!--#hd_wrapper-->
    <?php }else /*서브*/ { ?>
        <div id="hd_wrapper">
            <div id="slogo">
                <a href="<?php echo G5_URL ?>/index.php"><img src="<?php echo G5_THEME_IMG_URL ?>/common/logo.png" alt="로고"></a>
            </div>

            <!--뒤로가기--> <!--모바일-->
            <div class="moback">
            <?php
/*            if(strpos($_SERVER['REQUEST_URI'], 'chat_room.php') !== false) {
            */?><!--
            <a href="<?/*=G5_BBS_URL*/?>/chat_list.php"><i class="fal fa-angle-left"></i></a>
            <?php
/*            } else { */?>
            <a href="javascript:history.back();"><i class="fal fa-angle-left"></i></a>
            --><?php /*} */?>
            <a href="javascript:history.back();"><i class="fal fa-angle-left"></i></a>
            </div>
            <div id="motitle">
                <?php if($bo_table) {?>
                    <?php echo $board['bo_subject']; ?>
                <?php }else { ?>
                    <?php echo $g5['title'] ?>
                <?php } ?>
            </div>
            <?php if(strpos($_SERVER['PHP_SELF'], 'chat_room.php') !== false || strpos($_SERVER['PHP_SELF'], 'chat_list.php') !== false || strpos($_SERVER['PHP_SELF'], 'chat_room_detail.php') !== false) {} else { ?>
            <!--검색-->
            <div class="mosearch"><a href="javascript::"><i class="fal fa-search"></i></a></div>
            
            <!--모바일 검색-->
            <div id="tnb_msch">
            <h3>검색</h3>
            <form name="frmsearch1" id="form3" action="<?php echo G5_BBS_URL ?>/search.php" onsubmit="return search_submit(this);">
                <label for="sch_str" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
                <select name="option">
                    <option <?php echo get_selected($_GET['option'], "talent"); ?> value="talent">재능</option>
<!--                    <option --><?php //echo get_selected($_GET['option'], "video_lecture"); ?><!-- value="video_lecture">지식재능강의</option>-->
<!--                    <option --><?php //echo get_selected($_GET['option'], "competition"); ?><!-- value="competition">공모전</option>-->
                </select>
                <input type="text" name="stx" value="<?php echo stripslashes(get_text(get_search_string($stx))); ?>" id="sch_str3" placeholder="검색어를 입력하세요." required onclick="input_word('3');">
                <button type="submit" id="sch_submit"><i class="fal fa-search"></i><span class="sound_only">검색</span></button>
                <div class="mosearch_close"><i class="fal fa-times-square"></i></div>
            </form>
            </div><!--#tnb_msch-->
            <!--//모바일 검색-->
            <?php } ?>

			<?php if(strpos($_SERVER['PHP_SELF'], 'chat_room.php') !== false) {?>
			<a href="javascript:chatRoomDetail();" class="hd_per_more visible-xs">전문가 상세보기</a>
            <!--<a href="<?/*=G5_BBS_URL*/?>/chat_list.php" class="hd_per_more">리스트</a>-->
            <?php } ?>

            <div id="r_area">
                <!--검색영역(재능리스트)-->
                <div id="tnb_sch">
                    <h3>검색</h3>
                    <form name="frmsearch1" id="form4" action="<?php echo G5_BBS_URL ?>/search.php" onsubmit="return search_submit(this);" autocomplete="off">
                        <label for="sch_str" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
                        <select name="option">
                            <option <?php echo get_selected($_GET['option'], "talent"); ?> value="talent">재능</option>
<!--                            <option --><?php //echo get_selected($_GET['option'], "video_lecture"); ?><!-- value="video_lecture">지식재능강의</option>-->
<!--                            <option --><?php //echo get_selected($_GET['option'], "competition"); ?><!-- value="competition">공모전</option>-->
                        </select>
                        <input type="text" name="stx" value="<?php echo stripslashes(get_text(get_search_string($stx))); ?>" id="sch_str4" placeholder="검색어를 입력하세요." required onclick="input_word('4');">
                        <button type="submit" id="sch_submit"><img src="<?php echo G5_THEME_IMG_URL ?>/common/sch_btn02.png" alt="검색"><span class="sound_only">검색</span></button>
                    </form>
                    <div class="sch_word" id="sch_word4"></div>
                </div><!--#tnb_sch-->
                <!--로그인영역-->
                <ul id="tnb">
                    <?php if ($is_member) {  ?>
                        <?php if ($is_admin) {  ?>
                        <li><a href="<?php echo G5_ADMIN_URL ?>" title="관리자" class="line"><i class="fas fa-cog"></i> 관리자</a></li>
                        <?php }  ?>
                            <li class="male-auto">
                                <a href="" title="알림" class="line"><i class="fa-solid fa-bell"></i></a>
                                <span class="no_read_badge none" onclick="">0</span>
                            </li>
                            <li>
                                <a href="<?php echo G5_BBS_URL ?>/message.php" title="채팅" class="line"><i class="fa-solid fa-comments"></i></a>
                                <?php
                                // 전체 읽지 않은 메세지 수
                                $no_read_badge = sql_fetch("select count(*) as cnt from chat_message_log where user_id='{$member['mb_id']}' and read_status='0'")['cnt']; // 메세지 로그
                                ?>
                                <span class="no_read_badge <?php if($no_read_badge==0) { echo 'none'; }?>" onclick="chatting();"><?=$no_read_badge?></span>
                            </li>
                            <li>
                                <a href="<?php echo G5_BBS_URL ?>/cart.php" title="카트" class="line"><i class="fa-solid fa-cart-shopping"></i></a>
                                <span class="no_read_badge none" onclick="">0</span>
                            </li>
                            <li>|</li>
                            <li><a href="<?php echo G5_BBS_URL ?>/my_campaign.php" title="마이페이지" class="line txt_color">마이페이지</a></li>
                            <li><a href="javascript:logout();" title="로그아웃" class="line">로그아웃</a></li>

                    <?php } else /*$is_member*/{  ?>
                            <li><a href="<?php echo G5_URL ?>/new_campaign.php" title="" class="join us">협업제안</a></li>
                            <li><a href="<?php echo G5_BBS_URL ?>/login.php" title="로그인" class="line">로그인</a></li>
                            <li><a href="<?php echo G5_BBS_URL ?>/register_new.php" title="회원가입" class="join">회원가입</a></li>
                    <?php }  ?>
                </ul>
            </div><!--r_area-->

            <div class="nav_open">
                <a href="#hash-menu" id="hash_menu" data-role="button" data-url="<?php echo G5_PLUGIN_URL;?>/hash/" data-ref="1" data-animation="right">
                    <span></span><span></span><span></span>
                </a>
            </div>
        </div>
    <?php } ?>

</div>
<!-- } 상단 끝 -->



<!-- 콘텐츠 시작 { -->
<div id="wrapper">

    <!--카테고리-->
    <? if(defined('_INDEX_')) {?>
    <?php }else { ?>
       
        <div id="nav_area">
		 <?php if(strpos($_SERVER['PHP_SELF'], 'chat_list.php') !== false || strpos($_SERVER['PHP_SELF'], 'chat_room.php') !== false || strpos($_SERVER['PHP_SELF'], 'chat_room_detail.php') !== false) {} else { ?>
            <?php if ($pid=="new_service" || $sub_id=="mypage" || $sub_id=="pro_step01" || $sub_id=="pro_step02" || $sub_id=="pro_step03" || $sub_id=="market_cart" || $sub_id=="my_item"  ||$sub_id=="my_campaign" ||$sub_id=="my_market" ||$sub_id=="my_compete" ||$sub_id=="my_jobs" || $sub_id=="my_withdraw" || $sub_id=="my_income" || $sub_id=="my_cash" || $sub_id=="my_order" || $sub_id=="my_inquiry" || $sub_id=="my_service" || $sub_id=="my_contest" || $sub_id=="my_review" || $sub_id=="my_mileage" || $sub_id=="my_purchase" || $sub_id=="my_ad_request" || $sub_id=="my_ad_list" || $sub_id=="my_leave" || $sub_id=="register" || $sub_id=="register_form" || $sub_id=="register_expert_form01" || $sub_id=="register_expert_form02" || $sub_id=="register_expert_form03" || $sub_id=="register_contest" || $co_id=="provision" || $co_id=="privacy"|| $sub_id=="chat_ver"){ //마이페이지,재능등록 일때 상단 gnb 숨김 ?>
            <? } else  { ?>
            <nav id="gnb">
                <!--전체메뉴-->
                <!--<div class="wmenu"><i class="fal fa-bars"></i></div>-->
                <h2>메인메뉴</h2>
                <ul id="gnb_1dul">
					<li class="gnb_1dli all_menu">
						<a href="#Link" class="gnb_1da">전체메뉴</a>
						<ul class="gnb_2dul">

                            <li class="gnb_2dlit">
                                <a class="gnb_2da">재능거래</a>
                            </li>
							<li class="gnb_2dli">
								<a href="<?php echo G5_BBS_URL ?>/category_list.php?category=디자인" class="gnb_2da">디자인</a>
								<div class="gnb_2dli_list" style="display:none">
									<ul class="gnb_2dul ver02" style="">
										<li class="gnb_2dli"><a href="<?php echo G5_BBS_URL ?>/category_list.php?category=디자인&amp;category2=패키지" target="_self" class="gnb_2da">패키지</a></li>
										<li class="gnb_2dli"><a href="<?php echo G5_BBS_URL ?>/category_list.php?category=디자인&amp;category2=일러스트, 캐리커쳐" target="_self" class="gnb_2da">일러스트, 캐리커쳐</a></li>
										<li class="gnb_2dli"><a href="<?php echo G5_BBS_URL ?>/category_list.php?category=디자인&amp;category2=블로그, SNS, 썸네일" target="_self" class="gnb_2da">블로그, SNS, 썸네일</a></li>
										<li class="gnb_2dli"><a href="<?php echo G5_BBS_URL ?>/category_list.php?category=디자인&amp;category2=인쇄, 홍보물" target="_self" class="gnb_2da">인쇄, 홍보물</a></li>
										<li class="gnb_2dli"><a href="<?php echo G5_BBS_URL ?>/category_list.php?category=디자인&amp;category2=상세, 이벤트페이지" target="_self" class="gnb_2da">상세, 이벤트페이지</a></li>
										<li class="gnb_2dli"><a href="<?php echo G5_BBS_URL ?>/category_list.php?category=디자인&amp;category2=로고 브랜딩" target="_self" class="gnb_2da">로고 브랜딩</a></li>
									</ul>
								</div>
							</li>
							<li class="gnb_2dli">
								<a href="<?php echo G5_BBS_URL ?>/category_list.php?category=IT/프로그램" class="gnb_2da">IT/프로그램</a>
								<div class="gnb_2dli_list" style="display:none">
								<ul class="gnb_2dul ver02">
									<li class="gnb_2dli"><a href="<?php echo G5_BBS_URL ?>/category_list.php?category=IT/프로그램&amp;category2=교육" target="_self" class="gnb_2da">교육</a></li>
									<li class="gnb_2dli"><a href="<?php echo G5_BBS_URL ?>/category_list.php?category=IT/프로그램&amp;category2=데이터분석, 리포트" target="_self" class="gnb_2da">데이터분석, 리포트</a></li>
									<li class="gnb_2dli"><a href="<?php echo G5_BBS_URL ?>/category_list.php?category=IT/프로그램&amp;category2=프로그램 개발" target="_self" class="gnb_2da">프로그램 개발</a></li>
									<li class="gnb_2dli"><a href="<?php echo G5_BBS_URL ?>/category_list.php?category=IT/프로그램&amp;category2=모바일앱" target="_self" class="gnb_2da">모바일앱</a></li>
									<li class="gnb_2dli"><a href="<?php echo G5_BBS_URL ?>/category_list.php?category=IT/프로그램&amp;category2=쇼핑몰, 커머스" target="_self" class="gnb_2da">쇼핑몰, 커머스</a></li>
									<li class="gnb_2dli"><a href="<?php echo G5_BBS_URL ?>/category_list.php?category=IT/프로그램&amp;category2=웹사이트 개발" target="_self" class="gnb_2da">웹사이트 개발</a></li>
								</ul>
								</div>
							</li>
							<li class="gnb_2dli">
								<a href="<?php echo G5_BBS_URL ?>/category_list.php?category=마케팅" class="gnb_2da">마케팅</a>
								<div class="gnb_2dli_list" style="display:none">
									<ul class="gnb_2dul ver02">
										<li class="gnb_2dli"><a href="<?php echo G5_BBS_URL ?>/category_list.php?category=마케팅&amp;category2=키워드, 배너광고" target="_self" class="gnb_2da">키워드, 배너광고</a></li>
										<li class="gnb_2dli"><a href="<?php echo G5_BBS_URL ?>/category_list.php?category=마케팅&amp;category2=체험단, 기자단" target="_self" class="gnb_2da">체험단, 기자단</a></li>
										<li class="gnb_2dli"><a href="<?php echo G5_BBS_URL ?>/category_list.php?category=마케팅&amp;category2=쇼핑몰, 스토어" target="_self" class="gnb_2da">쇼핑몰, 스토어</a></li>
										<li class="gnb_2dli"><a href="<?php echo G5_BBS_URL ?>/category_list.php?category=마케팅&amp;category2=SNS마케팅" target="_self" class="gnb_2da">SNS마케팅</a></li>
										<li class="gnb_2dli"><a href="<?php echo G5_BBS_URL ?>/category_list.php?category=마케팅&amp;category2=블로그, 카페" target="_self" class="gnb_2da">블로그, 카페</a></li>
									</ul>
								</div>

							</li>
							<li class="gnb_2dli">
								<a href="<?php echo G5_BBS_URL ?>/category_list.php?category=영상/음향/사진" class="gnb_2da">영상/음향/사진</a>
								<div class="gnb_2dli_list" style="display:none">
									<ul class="gnb_2dul ver02">
										<li class="gnb_2dli"><a href="<?php echo G5_BBS_URL ?>/category_list.php?category=영상/음향/사진&amp;category2=영상" target="_self" class="gnb_2da">영상</a></li>
										<li class="gnb_2dli"><a href="<?php echo G5_BBS_URL ?>/category_list.php?category=영상/음향/사진&amp;category2=모델, MC" target="_self" class="gnb_2da">모델, MC</a></li>
										<li class="gnb_2dli"><a href="<?php echo G5_BBS_URL ?>/category_list.php?category=영상/음향/사진&amp;category2=음악, 사운드" target="_self" class="gnb_2da">음악, 사운드</a></li>
										<li class="gnb_2dli"><a href="<?php echo G5_BBS_URL ?>/category_list.php?category=영상/음향/사진&amp;category2=더빙, 녹음" target="_self" class="gnb_2da">더빙, 녹음</a></li>
										<li class="gnb_2dli"><a href="<?php echo G5_BBS_URL ?>/category_list.php?category=영상/음향/사진&amp;category2=사진 촬영" target="_self" class="gnb_2da">사진 촬영</a></li>
										<li class="gnb_2dli"><a href="<?php echo G5_BBS_URL ?>/category_list.php?category=영상/음향/사진&amp;category2=영상촬영, 편집" target="_self" class="gnb_2da">영상촬영, 편집</a></li>
									</ul>
								</div>
							</li>
							<li class="gnb_2dli">
								<a href="<?php echo G5_BBS_URL ?>/category_list.php?category=문화예술" class="gnb_2da">문화예술</a>
								<div class="gnb_2dli_list" style="display:none">
									<ul class="gnb_2dul ver02">
										<li class="gnb_2dli"><a href="<?php echo G5_BBS_URL ?>/category_list.php?category=문화예술&amp;category2=스텝" target="_self" class="gnb_2da">스텝</a></li>
										<li class="gnb_2dli"><a href="<?php echo G5_BBS_URL ?>/category_list.php?category=문화예술&amp;category2=장비대여" target="_self" class="gnb_2da">장비대여</a></li>
										<li class="gnb_2dli"><a href="<?php echo G5_BBS_URL ?>/category_list.php?category=문화예술&amp;category2=뷰티/미용" target="_self" class="gnb_2da">뷰티/미용</a></li>
										<li class="gnb_2dli"><a href="<?php echo G5_BBS_URL ?>/category_list.php?category=문화예술&amp;category2=기타" target="_self" class="gnb_2da">기타</a></li>
										<li class="gnb_2dli"><a href="<?php echo G5_BBS_URL ?>/category_list.php?category=문화예술&amp;category2=스텝/출연" target="_self" class="gnb_2da">스텝/출연</a></li>
									</ul>
								</div>
							</li>

                                <li class="gnb_2dli gnb_2dlit">
                                    <a href="<?php echo G5_BBS_URL ?>/campaign_list.php" class="gnb_2da">체험단</a>
                                    <div class="gnb_2dli_list" style="display:none">
                                        <ul class="gnb_2dul ver02">
                                            <li class="gnb_2dli"><a href="<?php echo G5_BBS_URL ?>/campaign_list.php?menu=sns" target="_self" class="gnb_2da">SNS</a></li>
                                            <li class="gnb_2dli"><a href="<?php echo G5_BBS_URL ?>/campaign_list.php?menu=design" target="_self" class="gnb_2da">디자인</a></li>
                                            <li class="gnb_2dli"><a href="<?php echo G5_BBS_URL ?>/campaign_list.php?menu=exp" target="_self" class="gnb_2da">체험단</a></li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="gnb_2dlit">
                                    <a href="<?php echo G5_BBS_URL ?>/compete_list.php" class="gnb_2da">공모전</a>
                                </li>
                                <li class="gnb_2dlit">
                                    <a href="<?php echo G5_BBS_URL ?>/market_list.php" class="gnb_2da">마켓</a>
                                </li>
                                <li class="gnb_2dlit">
                                    <a href="<?php echo G5_BBS_URL ?>/job_list.php" class="gnb_2da">구인구직</a>
                                </li>
						</ul>
					</li>
                        <li class="gnb_1dli">
                            <a href="<?php echo G5_BBS_URL ?>/campaign_list.php?menu=exp" target="_self" class="gnb_1da <?php if($sub_id == 'campagin_list'){ echo "head_on"; } ?>">체험단<span></span></a>
                            <ul class="gnb_2dul" style="display: none;">
                                <li class="gnb_2dli"><a href="<?php echo G5_BBS_URL ?>/campaign_list.php?category=sns" target="_self" class="gnb_2da">SNS</a></li>
                                <li class="gnb_2dli"><a href="<?php echo G5_BBS_URL ?>/campaign_list.php?category=design" target="_self" class="gnb_2da">디자인</a></li>
                                <li class="gnb_2dli"><a href="<?php echo G5_BBS_URL ?>/campaign_list.php?category=exp" target="_self" class="gnb_2da">체험단</a></li>
                            </ul>
                        </li>
                        <li class="gnb_1dli">
                            <a href="<?php echo G5_BBS_URL ?>/category_list.php?category=디자인" target="_self" class="gnb_1da <?php if(strpos( urldecode($uri), 'category='.$p_code[$i]['name']) == true){ echo "head_on"; } ?> ">재능거래<span></span></a>
                            <ul class="gnb_2dul" style="display: none;">
                                <li class="gnb_2dli"><a href="<?php echo G5_BBS_URL ?>/category_list.php?category=디자인" target="_self" class="gnb_2da">디자인</a></li>
                                <li class="gnb_2dli"><a href="<?php echo G5_BBS_URL ?>/category_list.php?category=IT/프로그램" target="_self" class="gnb_2da">IT/프로그램</a></li>
                                <li class="gnb_2dli"><a href="<?php echo G5_BBS_URL ?>/category_list.php?category=마케팅" target="_self" class="gnb_2da">마케팅</a></li>
                                <li class="gnb_2dli"><a href="<?php echo G5_BBS_URL ?>/category_list.php?category=영상/음향/사진" target="_self" class="gnb_2da">영상/음향/사진</a></li>
                                <li class="gnb_2dli"><a href="<?php echo G5_BBS_URL ?>/category_list.php?category=문화예술" target="_self" class="gnb_2da">문화예술</a></li>
                            </ul>
                        </li>
                        <li class="gnb_1dli">
                            <a href="<?php echo G5_BBS_URL ?>/compete_list.php" target="_self" class="gnb_1da <?php if($pid == 'compete_list'||$pid == 'compete_view'){ echo "head_on"; } ?>">공모전<span></span></a>
                        </li>
                        <li class="gnb_1dli">
                            <a href="<?php echo G5_BBS_URL ?>/market_list.php" target="_self" class="gnb_1da <?php if($pid == 'market_list'||$pid == 'market_view'){ echo "head_on"; } ?>">마켓<span></span></a>
                        </li>
                        <li class="gnb_1dli">
                            <a href="<?php echo G5_BBS_URL ?>/job_list.php" target="_self" class="gnb_1da <?php if($pid == 'job_list'||$pid == 'job_view'){ echo "head_on"; } ?>">구인구직<span></span></a>
                        </li>
                        <li class="gnb_1dli">
                            <a href="<?php echo G5_URL ?>/new_campaign.php" target="_self" class="gnb_1da txt_blue2 txt_bold">협업제안<span></span></a>
                        </li>
                    <?php  /*{?>
                        <?php
                        $p_code = common_code('ctg','code_ctg','json');


                        $row['me_link'] = '/bbs/category_list.php';
                        $gnb_zindex = 999; // gnb_1dli z-index 값 설정용

                        for ($i = 0; $i < count($p_code); $i++) {
                            $code = common_code($p_code[$i]['idx'],'code_p_idx','json');
    //                        $code3 = common_code($code[0]['idx'],'code_p_idx','json');
    //                        $first_code3 =$code3[0]['name'];
                            ?>
                        <li class="gnb_1dli" style="z-index:<?php echo $gnb_zindex--; ?>">
                            <a href="<?php echo G5_URL.$row['me_link'].'?category='.$p_code[$i]['name']; ?>" target="_self" class="gnb_1da
                                <?php if(strpos( urldecode($uri), 'category='.$p_code[$i]['name']) == true){ echo "head_on"; } ?> "><?php echo $p_code[$i]['name'] ?><span></span></a>
                            <?php
                            for ($k=0; $k < count($code); $k++) {
                                $code3 = common_code($code[$k]['idx'],'code_p_idx','json');
                                if($k == 0)
                                    echo '<ul class="gnb_2dul">'.PHP_EOL;
                                ?>
                            <li class="gnb_2dli"><a href="<?php echo G5_URL.$row['me_link'].'?category='.$p_code[$i]['name'].'&category2='.$code[$k]['name'] ?>" target="_self" class="gnb_2da"><?php echo $code[$k]['name'] ?></a></li>
                            <?php
                            }

                            if($k > 0)
                                echo '</ul>'.PHP_EOL;
                            ?>
                        </li>
                        <?php } if ($i == 0) {  ?>
                        <li id="gnb_empty">메뉴 준비 중입니다.<?php if ($is_admin) { ?> <br><a href="<?php echo G5_ADMIN_URL; ?>/menu_list.php">관리자모드 &gt; 환경설정 &gt; 메뉴설정</a>에서 설정하실 수 있습니다.<?php } ?></li>
                        <?php } ?>
                        <!--<li class="gnb_1dli"><a href="<?php echo G5_BBS_URL; ?>/board.php?bo_table=video_lecture" class="gnb_1da <?php if(strpos($uri, 'bo_table=video_lecture') == true){ echo "head_on"; } ?>">지식재능강의&nbsp;&nbsp;<i class="fas fa-microphone-alt"></i></a></li>
                        <li class="gnb_1dli"><a href="<?php echo G5_BBS_URL; ?>/contest_list.php" class="gnb_1da <?php if(strpos($uri, 'contest_list.php') == true){ echo "head_on"; } ?>">공모전&nbsp;&nbsp;<i class="fas fa-trophy-alt"></i></a></li>-->
                    <?php */?>
                </ul>
            </nav>
            <?php } ?>
         <?php } ?>
        </div><!--#nav_area-->
    <?php } ?>

    <!--서브 상단, contest_list는 2차 카테고리만 있어서 뺐음-->
    <?php if($sub_id=="category_list"||$sub_id == "campagin_list"||$sub_id == "market_list"||$sub_id == "compete_list"||$sub_id == "job_list"){ //아이템 리스트/뷰 ?>
        <?php
        // 1차 카테고리별 2차 카테고리 선택박스
        $category_key = '1';
        if(!empty($_GET['category'])) {
            $category = $_GET['category'];
            $category2 = $_GET['category2'];
            $category3 = $_GET['category3'];
            if (isset($category3) && $category3 != "") {
                $category3_name = '<li style = "margin-left : -5px" >></li>' . $_GET['category3'];
            }

            $p_code = common_code($category,'code_name','json','and code_p_idx = 0');
            $category_key = $p_code[0]['idx'];

            $code = common_code($category_key,'code_p_idx','json');

            //category3 없을 경우 임의로 넣어줌
            if (empty($category3)){
//                                        //카테고리2 이름 넣어서 idx찾기
//                                        $code3 = common_code($category2,'code_name','json','and code_p_idx = '.$category_key );
//                                        //찾은 idx == code_p_idx 찾기
//                                        $code3 = common_code( $code3[0]['idx'],'code_p_idx','json');
//                                        //첫번째꺼 도출
//                                        $category3 = $code3[0]['name'];
                $category3 = "";
            }
            if (empty($category2)){
                $category2 = "전체";
            }
        }
        if ($sub_id == "campagin_list"){
            $category = "캠페인";
            $category2 = $g5['title'];
        }
        if ($sub_id == "market_list"){
            $category = "마켓";
            $category2 = "목록";
        }
        if ($sub_id == "compete_list"){
            $category = "공모전";
            $category2 = "목록";
        }
        if ($sub_id == "job_list"){
            $category = "구인구직";
            $category2 = "목록";
        }
        ?>
        <header id="menu_category">
            <div class="inArea clearfix">
                <div class="col-md-6">
                    <ul>
                        <li>
                            <select id="cate" onchange="category_filter(this.options[this.selectedIndex].text)">
                                <option>인기 순</option>
                                <option>신규등록 순</option>
                              <!--<option>추천 순</option>-->
                              <option>평점 순</option>
                              <option>응답 순</option>
                            </select>
                        </li>
                        <?php if($sub_id=="category_list"){ //모바일 카테고리 ?>
                        <li>
                            <select id="cate" onchange="category2_change(this.options[this.selectedIndex].text)">
                                <option value=""<?php echo get_selected($_GET['category2'],'') ?> >전체</option>
                                <?php
                                $code = common_code($category_key,'code_p_idx','json');
                                for ($i = 0; $i < count($code); $i++){ ?>
                                    <option value="<?php echo $code[$i]['idx'] ?>"<?php echo get_selected($_GET['category2'],$code[$i]['name']) ?> ><?=$code[$i]['name']?></option>
                                <?php } ?>
                            </select> 
                        </li>
                        <?php } elseif($sub_id=="campagin_list"){ //모바일 카테고리 ?>
                        <li>
                            <select id="cate" onchange="">
                                <option value="">전체</option>
                                <option value="">SNS</option>
                                <option value="">디자인</option>
                                <option value="">체험단</option>
                            </select>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
                <div class="col-md-6 text-right location">
                    <ul>
                        <li><i class="fal fa-home"></i><a href="<?=G5_URL?>">잡고 홈</a></li>
                        <li>></li>
                        <?php if($sub_id=="category_list"){ //기존 ?>
                            <li><a href="<?=G5_BBS_URL?>/category_list.php?category=<?=$category?>"><?=$category?></a></li>
                            <li>></li>
                            <li><a href="<?=G5_BBS_URL?>/category_list.php?category=<?=$category?>&category2=<?=$category2?>"><?=$category2?></a></li>
                            <li class="current"><a href="<?=G5_BBS_URL?>/category_list.php?category=<?=$category?>&category2=<?=$category2?>&category3=<?=$category3?>"><?=$category3_name?></a></li>
                        <?php } else { ?>

                            <li><?=$category?></li>
                            <li>></li>
                            <li><?=$category2?></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </header>
    <? } else { //일반페이지 일때?>
    <?php } ?>


    <? if(defined('_INDEX_')){?>
    <!--메인컨테이너 부분-->
    <div id="container_index">

    <!--서브컨테이너 부분-->
    <? }else if($bo_table == "" || $co_id == ""){ ?>

        <!--서브상단비주얼-->
        <? if($co_id == "greet01" || $co_id == "greet02") {  ?>
            <div id="svisual">
                <div class="s_text">
                    <h3>test</h3>
                    <span><?php echo $config['cf_title']; ?></span>
                </div><!--.s_text-->
            </div><!--svisual-->
        <? } else if ($co_id == "prog01" || $co_id == "prog02" || $co_id == "prog03") { ?>
            <div id="svisual">
                <div class="s_text">
                    <h3>test</h3>
                    <span><?php echo $config['cf_title']; ?></span>
                </div><!--.s_text-->
            </div><!--svisual-->
        <? } else if ($co_id== "viet01" || $co_id == "viet02") { ?>
            <div id="svisual">
                <div class="s_text">
                    <h3>test</h3>
                    <span><?php echo $config['cf_title']; ?></span>
                </div><!--.s_text-->
            </div><!--svisual-->
        <? } else if ($co_id == "mem01" || $co_id == "mem02" || $bo_table == "mem03") { ?>
            <div id="svisual">
                <div class="s_text">
                    <h3>test</h3>
                    <span><?php echo $config['cf_title']; ?></span>
                </div><!--.s_text-->
            </div><!--svisual-->
        <? } else  { ?>
            <div id="svisual" class="hide">
                <div class="s_text">
                    <h3>test</h3>
                    <span><?php echo $config['cf_title']; ?></span>
                </div><!--.s_text-->
            </div><!--svisual-->
        <? } ?>

        <!--서브메뉴-->
        <?php

        if(!$sm_tid)	$sm_tid = $co_id;
        if(!$sm_tid)	$sm_tid = $bo_table;

        if($sm_tid)
            echo submenu($sm_tid, 'basic', G5_THEME_PATH);
        ?>

        <div id="container">
            <? if($bo_table || $co_id){ ?>
            <!-- 서브 게시판 및 내용관리 부분 -->
            <div id="scont_wrap">
                <? }else { ?>
                <!-- 그외 검사결과창 및 회원가입 -->
                <div id="scont_wrap2" <?php if(strpos($_SERVER['PHP_SELF'], 'chat_room.php') !== false) { ?> class="c_ver_2"<? } ?>>
                    <? } ?>

                    <div id="scont">
                        <?php if($pid=="new_service" ||$sub_id=="category_list" || $sub_id=="item_view"  || $sub_id=="register_form" || $sub_id=="search_page" || $sub_id=="market_cart" || $sub_id=="my_item" ||$sub_id=="my_campaign" ||$sub_id=="my_market" ||$sub_id=="my_compete" ||$sub_id=="my_jobs" ||
                            $sub_id=="my_withdraw" || $sub_id=="my_income" || $sub_id=="my_cash" || $sub_id=="my_order" || $sub_id=="my_inquiry" || $sub_id=="my_service" || $sub_id=="my_contest" || $sub_id=="my_review" || $sub_id=="my_mileage" || $sub_id=="my_purchase" || $sub_id=="my_ad_request" || $sub_id=="my_ad_list" || $sub_id=="my_leave" || $sub_id=="search_result" || $sub_id=="contest_list" || $sub_id=="contest" || $sub_id=="register_contest" || $sub_id=="mypage" || $sub_id=="contest" || $bo_table=="video_lecture" || $sub_id=="campagin_list" || $sub_id=="campagin_view"|| $sub_id=="compete_list" || $sub_id=="compete_view"|| $sub_id=="market_list" || $sub_id=="market_view"|| $sub_id=="job_list" || $sub_id=="job_view"){ //아이템 리스트?>
                        <? } else { //일반페이지 일때?>
                            <!--서브타이틀-->
                            <div id="sub_title">
                                <div class="container_title">
                                    <?php if($bo_table) {?>
                                        <?php echo $board['bo_subject']; ?>
                                    <?php }else { ?>
                                        <?php echo $g5['title'] ?>
                                    <?php } ?>
                                </div>
                                <!--메뉴로케이션-->
                                <?php

                                if(!$is_register || $w){
                                    if(!$sm_tid)	$sm_tid = $co_id;
                                    if(!$sm_tid)	$sm_tid = $bo_table;
                                    if($sm_tid)
                                        echo submenu($sm_tid, 'location', G5_THEME_PATH);
                                }
                                ?>
                            </div><!--#sub_title-->
                            <!--서브타이틀-->
                        <?php } ?>
                        <? } ?>

<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script><!--페이스북로그인-->
<script>

	$(document).ready(function(){ // 모바일 검색창 토글
	  $(".mosearch").click(function(){
		//$("#tnb_msch").toggle();
		$("#tnb_msch").fadeIn();
		//$("#tnb_msch").animate({right:'0px'});
	  });
		$(".mosearch_close").click(function(){
		$("#tnb_msch").fadeOut();	
		//$("#tnb_msch").animate({right:'-100%'});
		//$("#tnb_msch").attr("style", "display:none");
	  });
        // 마이페이지 tab js
        <?php
        $uri = $_SERVER['REQUEST_URI'];
        $tab = $_GET['tab'];
        if ($tab == "" ) $tab = 1 ;
        if(strpos($uri, 'my_') == true || strpos($uri, 'mypage.php') == true){ ?>
         $('#tab<?=$tab?>').addClass('on');
         $("[id^='tab-content']").css('display','none');
         $('#tab-content<?=$tab?>').css('display','block');
        <?php } ?>


    });

    //세번째 카테고리 자동셋팅 때문에 했는데.. 필요없어짐.. 그래도 혹시몰라 남겨뒀음.
    function category2_change(val) {

        location.href="<?=$_SERVER['PHP_SELF']?>?category=<?=$category?>&category2=" + val;

    }

    function search_submit(f) {
        if (f.stx.value.length < 2) {
            alert("검색어는 두글자 이상 입력하십시오.");
            f.stx.select();
            f.stx.focus();
            return false;
        }

        // 검색어 DB 저장
        search_word(f);

        return true;
    }

    // 검색어 DB 저장
    function search_word(f) {
        $.ajax({
            url: g5_bbs_url + "/ajax.search_word.php",
            data: { category : f.option.value, stx : f.stx.value },
            type: 'POST',
            async: false,
            success: function (data) {
            },
        });
    }

    // 검색어 입력 시 인기 검색어 출력
    function input_word(num) {
        $('#sch_str'+num).keyup();
        var f = $('#form'+num)[0];
        
        //자동완성안함
        return false;

        $('#sch_str'+num).autocomplete({
            source : function(request, response) { // 자동 완성 대상
                $.ajax({
                    type: 'POST',
                    url: g5_bbs_url + "/ajax.search_word.php",
                    dataType: 'json',
                    data: {
                        option : 'autocomplete',
                        category : f.option.value,
                        stx : f.stx.value,
                    },
                    success: function(data) {
                        response(
                            $.map(data, function(item) {
                                return {
                                    label: item.search_word, // UI에 보여지는 글자
                                    word : item.search_word,
                                    category : item.search_category,
                                }
                            })
                        )
                    }
                });
            },
            select : function(event, ui) { // 아이템 선택 시
                f.stx.value = ui.item.word;
                f.option.value = ui.item.category;
                $('#form'+num).submit();
            },
            focus : function(event, ui) { // 포커스
                $('#sch_str'+num).val(ui.item.word);
                return false; // 한글 에러 잡는 용도로 사용
            },
        });

        /*// 자동 완성 닫혀 있을 때 폼 클릭 시 자동 완성 보여줌
        if($('#ui-id-1').css("display") == "none") {
            var e = jQuery.Event( "keypress", { keyCode: 38 } );
            $('#sch_str'+num).trigger(e);
        }*/
    }

    // 검색어 입력 폼 포커스
    /*function focus_input(num) {
        var f = $('#form'+num)[0]; // 폼 정보
        $('#sch_word'+num).attr('style', 'display:block;'); // 인기 검색어 영역

        // 인기 검색어 출력
        $.ajax({
            url: g5_bbs_url + "/ajax.search_word.php",
            data: { category : f.option.value, option : 'autocomplete' },
            type: 'POST',
            dataType: 'json',
            success: function (data) {
                console.log(data);
                var html = '<div><인기 검색어></div>';
                for(var i=0; i<data.length; i++) {
                    html += '<div>'+(i+1)+'. '+data[i].search_word+'</div>';
                }
                $('#sch_word'+num).html(html);
            },
        });
    }*/

    // 검색어 입력 폼 포커스 아웃
    /*function blur_input(num) {
        $('#sch_word'+num).attr('style', 'display:none;');
    }*/

    $(function(){
        // FB.init 호출 (FB에서 여러 가지 로그인에 관한 상태를 설정하고 체크할 수 있는 메서드가 들어있음)
        window.fbAsyncInit = function () {
            if ('<?=$member['mb_sns']?>' == 'facebook') {
                FB.init({
                    appId: <?=$app_id?>, // 내 앱 ID를 입력한다.
                    cookie: true,
                    xfbml: true,
                    version: 'v11.0'
                });
                FB.AppEvents.logPageView();


            }
        }
    });

    // 로그아웃 (페이스북 사이트에서 로그인 필요, 잡고 재로그인 시 다시 페이스북 로그인하기 위하여)
    function logout() {
        if('<?=$member['mb_sns']?>' == 'facebook') { // 페이스북 사이트 로그아웃
            FB.getLoginStatus(function(response) {
                if(response.status === 'connected') {
                    FB.logout(function(response) {
                        if('<?=$android?>') {
                            window.Android.setLogout();
                        }
                        location.href="<?php echo G5_BBS_URL ?>/logout.php";
                    });
                }
            });
        }
        else {
            location.href="<?php echo G5_BBS_URL ?>/logout.php";
        }
    }

    // 사용자의 토큰이 변경되었을 경우 업데이트
    function fcmKey(token){
        <?php if ($is_member && $android){ ?>
        if ('<?=$member['token']?>' != token ) {
            $.ajax({
                url: g5_bbs_url + "/ajax.fcm_update.php",
                type: "POST",
                data: {
                    "token": token
                },
                // dataType: "json",
                success: function (data) {
                    // alert(data);
                }
            });
        }
        <?php } ?>
    }

    // 채팅
    function chatting() {
        if('<?=$mobile?>') { // 모바일 웹 또는 안드로이드 접속 시
            location.href = g5_bbs_url + '/chat_list.php';
        } else {
            location.href = g5_bbs_url + '/message.php';
        }
    }
</script>

<!-- autocomplete -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<!-- autocomplete -->