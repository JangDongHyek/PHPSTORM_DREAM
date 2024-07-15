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

if(strpos($_SERVER['PHP_SELF'], '/mypage') !== false) {
    loginCheck($member['mb_id'], $member['mb_category']);
}

// 마이페이지 경로
$mypage = $member['mb_category'] == '일반' ? 'mypage.php' : 'mypage_company.php';

// 등급포인트 - 출석 포인트 적립 1NM / 하루 1번 (대상아이디, 적립기준, 포인트, 내용, 연관아이디, 연관테이블, 연관idx)
$attd_cnt = sql_fetch(" select count(*) as cnt from g5_member_point where mb_id = '{$member['mb_id']}' and category = '출석' and date_format(now(), '%Y-%m-%d') = date_format(wr_datetime, '%Y-%m-%d') ")['cnt'];
if(empty($attd_cnt) && !empty($member['mb_id'])) { // 중복 적립 여부 확인 후 적립
    gradePointInsert($member['mb_id'], '적립', '출석', '1', '출석');
}

//if(!empty($member['mb_intercept_date'])) {
//    alert('이용이 정지된 회원입니다.', G5_BBS_URL.'/logout.php');
//}
?>

<!-- 신고하기 모달 -->
<div id="basic_modal">
    <!-- Modal -->
    <div class="modal fade review" id="reportModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false" style="z-index:10000">
        <div class="modal-dialog" style="z-index:100000">
            <div class="modal-content">
				<div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span></span><span></span></button>
                    <h4 class="modal-title" id="appModalLabel">신고하기</h4>
                </div>
                <div class="modal-body">
					<div id="star_rating">
						<h3>신고유형을 선택해 주세요</h3>
					</div>
					<div class="area_check">
                        <input type="hidden" id="report_id">
                        <input type="hidden" id="report_rel_table">
                        <input type="hidden" id="report_rel_idx">
						<ul class="check_list">
							<li>
								<input type="checkbox" name="report" value="1" id="report01" onclick="checkOnlyOne(this);">
								<label for="report01">
									<span></span>
									<em>비매너 사용자</em>
								</label>
							</li>
							<li>
								<input type="checkbox" name="report" value="2" id="report02" onclick="checkOnlyOne(this);">
								<label for="report02">
									<span></span>
									<em>답변 채택 or 거래 분쟁</em>
								</label>
							</li>
							<li>
								<input type="checkbox" name="report" value="3" id="report03" onclick="checkOnlyOne(this);">
								<label for="report03">
									<span></span>
									<em>광고성, 도배성 글</em>
								</label>
							</li>
							<li>
								<input type="checkbox" name="report" value="4" id="report04" onclick="checkOnlyOne(this);">
								<label for="report04">
									<span></span>
									<em>거짓 프로필 or 기업 정보 게시</em>
								</label>
							</li>
							<li>
								<input type="checkbox" name="report" value="5" id="report05" onclick="checkOnlyOne(this);">
								<label for="report05">
									<span></span>
									<em>기타 (직접 입력)</em>
								</label>
								<textarea id="report_contents" placeholder="신고사유를 입력해 주세요"></textarea>
							</li>
						</ul>
					</div>
					<ul class="madal_btn">
						<li data-dismiss="modal">취소</li>
						<li class="ok" onclick="reportAction();">신고하기</li>
					</ul>
                </div>
            </div>
        </div>
    </div>
</div><!--basic_modal-->
<!-- 신고하기 모달팝업 -->

<header id="hd">
    <h1 id="hd_h1"><?php echo $g5['title'] ?></h1>

    <div class="to_content"><a href="#container">본문 바로가기</a></div>

    <?php
    if(defined('_INDEX_')) { // index에서만 실행
        include G5_MOBILE_PATH.'/newwin.inc.php'; // 팝업레이어
    } ?>

	<?php if(defined('_INDEX_')) { ?>
    <div id="hd_wrapper" <?php if(defined('_INDEX_')){ echo "class='idx wow fadeInDown animated'"; } ?> data-wow-delay="0.5s" data-wow-duration="0.3s">

        <div class="logo">
            <a href="<?php echo G5_URL ?>/index.php">
                <img src="<?php echo G5_THEME_IMG_URL ?>/app/logo.svg" alt="<?php echo $config['cf_title']; ?>">
            </a>
        </div><!--.logo-->

        <!--index 상단 메뉴-->
        <div id="nav" class="hidden-xs">
        	<div class="menu">
                <ul class="gnb">
                    <!--<li class="company"><a href="<?php /*echo G5_BBS_URL */?>/company_list.php">기업의뢰</a></li>-->
                    <li class="general_noshow"><a href="<?php echo G5_BBS_URL ?>/company_search.php">기업검색</a></li>
					<li class="general_noshow"><a href="<?php echo G5_BBS_URL ?>/career.php">커리어</a></li>
                    <li><a href="<?php echo G5_BBS_URL ?>/help_list.php">헬프미</a></li>
                    <li><a href="<?php echo G5_BBS_URL ?>/community.php">커뮤니티</a></li>
                    <?php if($reference_test) { ?>
                    <li><a href="<?php echo G5_BBS_URL ?>/shop.php">자료실</a></li>
                    <?php } ?>
                    <li class="bunker"><a href="<?php echo G5_BBS_URL ?>/bunker.php">벙커링 스테이션</a></li>
                </ul>
            </div><!--.menu-->
        </div><!--#nav-->

		<div class="left_menu">
            <?php ?>
			<div class="hd_sch">
				<a href=""><img src="<?php echo G5_THEME_IMG_URL ?>/app/icon_sch.svg"></a>
			</div>
			<div class="menu">
				<a href="#hash-menu" id="hash_menu" data-role="button" data-url="<?php echo G5_PLUGIN_URL;?>/hash/" data-ref="1" data-animation="left"><?php ?>
				<!--<a onclick="swal('준비 중입니다');return false;">-->
					<span class="hd_open2"></span>
					<span class="hd_open2"></span>
					<span class="hd_open2"></span>
				</a>
			</div>
        </div><!--.left_menu-->

	 <div class="area_uill">
			<ul class="utill_list">

				<?php if($is_admin) { ?>
				<li><a href="<?php echo G5_ADMIN_URL?>">관리자</a></li>
				<?php } ?>
				<?php if ($is_member) { ?>
				<li class="store_noshow">
					<a href="<?php echo G5_BBS_URL ?>/chat_list.php">
						<!-- 채팅 왔을때만 나타나게-->
						<i class="alarm" style="display: none;"></i>채팅
					</a>
				</li>
                <?php if(!$is_admin) { ?>
				<li><a href="<?php echo G5_BBS_URL ?>/<?=$mypage?>">마이페이지</a></li>
                <?php } ?>
                <li>
					<div class="area_photo">
                    <?php echo getProfileImg($member['mb_id'], $member['mb_category']); ?>
					</div>
					<ul class="list_info">
                        <?php if(!$is_admin) { ?>
                        <?php if($member['mb_category'] == '일반') { ?>
                        <li><a href="<?php echo G5_BBS_URL ?>/register_form.php?w=u&mb_id=<?=$member['mb_id']?>">정보수정</a></li>
                        <li><a href="<?php echo G5_BBS_URL ?>/profile_update01.php">프로필관리</a></li>
                        <?php } else { ?>
                        <li><a href="<?php echo G5_BBS_URL ?>/register_company_form.php?w=u&mb_id=<?=$member['mb_id']?>">정보수정</a></li>
                        <li><a href="<?php echo G5_BBS_URL ?>/profile_company_update01.php">프로필관리</a></li>
                        <?php } ?>
                        <?php } ?>
						<li><a href="<?=G5_BBS_URL?>/logout.php">로그아웃</a></li>
					</ul>
				</li>
				<?php } else { ?>
				<li><a href="<?php echo G5_BBS_URL ?>/login.php">로그인</a></li>
				<li class="join"><a href="<?php echo G5_BBS_URL ?>/register.php">회원가입</a></li>
				<?php } ?>
			</ul>
		</div><!--.gnb-->
    </div><!--#hd_wrapper-->

	<?php } else { ?>
	<div id="hd_wrapper">
		<div id="hd_back" class="hd_icon">
            <?php
            $href_data = "";
            if(strpos($_SERVER['PHP_SELF'], 'chat_list') !== false) { // 채팅리스트에서 뒤로가기 시 index로
                $href_data = G5_URL;
            }
            else {
                $href_data = "javascript:history.back();";
            }
            ?>
            <a href="<?=$href_data?>">
				<img src="<?php echo G5_THEME_IMG_URL ?>/app/icon_back.svg"><span class="sound_only">뒤로</span>
            </a>
			<div id="title"><?php echo $g5['title'] ?></div>
        </div>


        <div class="logo sub">
            <a href="<?php echo G5_URL ?>/index.php">
                <img src="<?php echo G5_THEME_IMG_URL ?>/app/logo.svg" alt="<?php echo $config['cf_title']; ?>">
            </a>
        </div><!--.logo-->

        <div id="nav" class="hidden-xs">
        	<div class="menu">
                <ul class="gnb">
                    <!--<li class="company"><a href="<?php /*echo G5_BBS_URL */?>/company_list.php">기업의뢰</a></li>-->
                    <li class="general_noshow"><a href="<?php echo G5_BBS_URL ?>/company_search.php">기업검색</a></li>
					<li class="general_noshow"><a href="<?php echo G5_BBS_URL ?>/career.php">커리어</a></li>
                    <li><a href="<?php echo G5_BBS_URL ?>/help_list.php">헬프미</a></li>
                    <li><a href="<?php echo G5_BBS_URL ?>/community.php">커뮤니티</a></li>
                    <?php if($reference_test || $member['mb_id'] == 'test01') { ?>
                    <li><a href="<?php echo G5_BBS_URL ?>/shop.php">자료실</a></li>
                    <?php } ?>
                    <li class="bunker"><a href="<?php echo G5_BBS_URL ?>/bunker.php">벙커링 스테이션</a></li>
                </ul>
            </div><!--.menu-->
        </div><!--#nav-->

		<div class="left_menu">
            <?php ?>
			<div class="hd_sch">
				<a href=""><img src="<?php echo G5_THEME_IMG_URL ?>/app/icon_sch.svg"></a>
			</div>
			<div class="menu">
				<a href="#hash-menu" id="hash_menu" data-role="button" data-url="<?php echo G5_PLUGIN_URL;?>/hash/" data-ref="1" data-animation="left"><?php ?>
				<!--<a onclick="swal('준비 중입니다');return false;">-->
					<span class="hd_open2"></span>
					<span class="hd_open2"></span>
					<span class="hd_open2"></span>
				</a>
			</div>
        </div><!--.left_menu-->

	 <div class="area_uill">
			<ul class="utill_list">

				<?php if($is_admin) { ?>
				<li><a href="<?php echo G5_ADMIN_URL?>">관리자</a></li>
				<?php } ?>
				<?php if ($is_member) { ?>
				<li class="store_noshow">
                    <a href="<?php echo G5_BBS_URL ?>/chat_list.php"><i class="alarm" style="display: none;"></i>채팅</a>
                    <!--<span class="badge">0</span>-->
                </li>
                <?php if(!$is_admin) { ?>
                <li><a href="<?php echo G5_BBS_URL ?>/<?=$mypage?>">마이페이지</a></li>
                <?php } ?>
				<li>
					<div class="area_photo">
                    <?php echo getProfileImg($member['mb_id'], $member['mb_category']); ?>
					</div>
					<ul class="list_info">
                        <?php if(!$is_admin) { ?>
                        <?php if($member['mb_category'] == '일반') { ?>
                        <li><a href="<?php echo G5_BBS_URL ?>/register_form.php?w=u&mb_id=<?=$member['mb_id']?>">정보수정</a></li>
                        <li><a href="<?php echo G5_BBS_URL ?>/profile_update01.php">프로필관리</a></li>
                        <?php } else { ?>
                        <li><a href="<?php echo G5_BBS_URL ?>/register_company_form.php?w=u&mb_id=<?=$member['mb_id']?>">정보수정</a></li>
                        <li><a href="<?php echo G5_BBS_URL ?>/profile_company_update01.php">프로필관리</a></li>
                        <?php } ?>
                        <?php } ?>
						<li><a href="<?=G5_BBS_URL?>/logout.php">로그아웃</a></li>
					</ul>
				</li>
				<?php } else { ?>
				<li><a href="<?php echo G5_BBS_URL ?>/login.php">로그인</a></li>
				<li class="join"><a href="<?php echo G5_BBS_URL ?>/register.php">회원가입</a></li>
				<?php } ?>
			</ul>
		</div><!--.gnb-->
    </div><!--#hd_wrapper-->
	 <?php } ?>

</header>


<div id="area_search" class="sch">
	<div class="area_top">
		<a href="" class="btn_close"><img src="<?php echo G5_THEME_IMG_URL ?>/app/icon_back.svg"></a>
		<div class="box_sch">
			 <input type="text" id="full_search" placeholder="검색어를 입력해주세요." name="full_search" value="<?=$full_search?>">
			 <button type="button" onclick="fullSearch();"></button>
		</div>
	</div>
    <div class="area_bottom">
        <ul class="tab_menu">
            <!--<li class="active" rel="tab01"><span>기업의뢰</span></li>-->
            <li rel="tab02" class="general_noshow active"><span>기업검색</span></li>
            <li rel="tab03" class="general_noshow"><span>커리어</span></li>
            <li rel="tab04"><span>헬프미</span></li>
            <li rel="tab05"><span>커뮤니티</span></li>
        </ul>
        <div class="list_wrap">
            <!--ajax.full_search.php-->
            <div class="tab_container v2 full_sch">
                <div id="tab01" class="tab_box">
                    <div id="help_list">
                        <div class="nodata">
                            <p>검색 결과가 없습니다.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div id="full_paging"></div>
        </div>
    </div>
</div>

<div id="area_search" class="filter">
	<div class="area_top">
		<a href="" class="btn_close"><img src="<?php echo G5_THEME_IMG_URL ?>/app/icon_back.svg"></a>
		<div class="box_sch"><h2>검색 필터</h2></div>
	</div>
	<div class="area_bottom">
		<!-- 헬프미 -->
		<div class="option_list help">
			<div class="box_cate">
				<h3>정렬</h3>
				<ul>
					<li class="active">인기순</li>
					<li>최신순</li>
					<li>벙커순</li>
				</ul>
			</div>
			<div class="box_cate">
				<h3>기간</h3>
				<ul>
					<li class="active">전체</li>
					<li>1일</li>
					<li>1주일</li>
					<li>1개월</li>
				</ul>
			</div>
			<div class="box_cate">
				<h3>카테고리</h3>
				<ul>
					<li class="active">전체</li>
					<li>선박 운항, 항해</li>
					<li>선박 기관, 정비</li>
					<li>조선</li>
					<li>플랜트</li>
					<li>수산</li>
					<li>해운</li>
					<li>항만,물류</li>
					<li>기타</li>
					<li>고민 Q&A</li>
				</ul>
			</div>
		</div>

		<!-- 커뮤니티 -->
		<div class="option_list comu">
			<div class="box_cate">
				<h3>정렬</h3>
				<ul>
					<li class="active">인기순</li>
					<li>최신순</li>
				</ul>
			</div>
			<div class="box_cate">
				<h3>카테고리</h3>
				<ul>
					<li class="active">전체</li>
					<li>꿀팁</li>
					<li>일상 이런저런</li>
					<li>회사/현장 이야기</li>
					<li>해양뉴스</li>
				</ul>
			</div>
		</div>

		<!-- 기업의뢰 -->
		<div class="option_list company">
			<div class="box_cate">
				<h3>정렬</h3>
				<ul>
					<li class="active">인기순</li>
					<li>최신순</li>
				</ul>
			</div>
			<div class="box_cate">
				<h3>기간</h3>
				<ul>
					<li class="active">전체</li>
					<li>1일</li>
					<li>1주일</li>
					<li>1개월</li>
				</ul>
			</div>
			<div class="box_cate ci_type">
				<h3>의뢰유형</h3>
				<ul>
					<li class="active">전체</li>
					<li>서비스</li>
					<li>부품</li>
					<li>선용품</li>
					<li>기타</li>
				</ul>
			</div>
			<!-- //기업의뢰 의뢰유형-->

			<!-- 기업의뢰 카테고리-->
			<div class="box_cate v2 ci_category">
				<h3>카테고리</h3>
				<ul>
					<li class="active"><span>전체</span></li>
					<li><span>Engine</span></li>
					<li><span>Auxiliary Machinery</span></li>
					<li><span>Valve, Filter/Strainer, Pipe Fittings</span></li>
					<li><span>Propulsion System And Rudder System</span></li>
					<li><span>HVAC, Refrigeration System</span></li>
					<li><span>Electrical Equipment and Automation</span></li>
					<li><span>Communication and Navigation Equipment</span></li>
					<li><span>Deck Machinery & Cargo Hold Hatch Cover</span></li>
					<li><span>Fire Fighting/Life-Saving and Personal Safety/Protection</span></li>
					<li><span>Measuring Meter/Instrument/Special Tool</span></li>
					<li><span>Galley Equipment/Laundry Equipment/Sanitory Unit</span></li>
					<li><span>Ship Chandler</span></li>
					<li><span>New Building & Conversion</span></li>
					<li><span>Maintenance & Repair Services</span></li>
					<li><span>Other Service & Products</span></li>
				</ul>
			</div>
		</div>

	</div>
	<ul class="area_btn">
		<li><button type="button" class="btn_reset">초기화</button></li>
		<li><button type="button" class="btn_filter">필터적용</button></li>
	</ul>

</div>

<?php
// 익스플로러 방어 (사용된 스크립트 미지원으로 인한 익스플로러 접근금지 처리)
$is_IE = false;
if (strpos($_SERVER['HTTP_USER_AGENT'], "MSIE") || strpos($_SERVER['HTTP_USER_AGENT'], "Trident")) $is_IE = true;
?>

<div id="layer_wrap" style="<?=($is_IE)? "display:block;" : ""; ?>">
	<div class="layerPop">
		<div class="layer_cont">
			<h2>
				접속하신 브라우저는 지원하지 않습니다.<br>
				Chrome 또는 Microsoft Edge를 사용해 주세요.
			</h2>
			<ul class="">
				<li>
					<a href="https://www.google.co.kr/chrome/?brand=QCDH&gclsrc=aw.ds&gclid=Cj0KCQjwvO2IBhCzARIsALw3ASrnKtD3Tc5vwbXTdK9VFZ8L9O6iPsOW5bV-lKXvBB1gI94pojLb4LoaAjfjEALw_wcB" target="_blank">
						<span>Chrome</span>
					</a>
				</li>
				<li>
					<a href="https://www.microsoft.com/ko-kr/edge" target="_blank">
						<span>Microsoft Edge</span>
					</a>
				</li>
			</ul>
		</div>
	</div>
	<div class="pop_bg"></div>
</div>

<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script> <!--페이스북로그인-->
<script type="text/javascript">
	function closeWin(no) {
		document.getElementById("layer_wrap").style.display = "none";
	}

    /*// 페이스북 로그인 초기화
    window.fbAsyncInit = function () {
        FB.init({
            appId: '<?=$face_app_id?>',
            cookie: true,
            xfbml: true,
            version: 'v10.0'
        });

        FB.AppEvents.logPageView();
    };

	// 로그아웃
	function logout() {
	    // 페이스북은 사이트 로그아웃
        FB.getLoginStatus(function(response) {
            console.log(response);
            if(response.status === 'connected') {
                FB.logout(function(response) {
                    location.href = "<?php echo G5_BBS_URL ?>/logout.php";
                });
            }
        });
        location.href = "<?php echo G5_BBS_URL ?>/logout.php";
    }*/
</script>

<!--채팅JS-->
<script src="<?=G5_JS_URL?>/socket2.io.js" ></script> <!--socket2가 최신버전-->
<script src="<?=G5_JS_URL?>/chat.js?v=3<?=G5_JS_VER?>"></script>
<script>
$(function(){
    // 채팅
    chatLogin('<?=$member['mb_id']?>'); // 서버 연결
    chatBadge('<?=$member['mb_id']?>'); // 채팅 수신 여부 표시

	$('.area_uill .utill_list > li .area_photo').on('click',function(){
		$(this).toggleClass('active');
		$('.area_uill .utill_list > li .list_info').toggleClass('active');
		return false;
	});

	// 통합 검색 메뉴 선택
	$('.area_bottom .tab_menu > li').on('click', function() {
	    var temp = $(this)[0].innerText;
	    fullSearch(temp, 's');
    });

    if(!'<?=$private?>') { // 드림포원 외
        // 개발자도구(f12) 방지
        $(document).bind('keydown',function(e) {
            if ( e.keyCode == 123 /* F12 */) {
                e.preventDefault(); e.returnValue = false;
            }
        });

        // 우클릭 방지
        $(document).on("contextmenu",function(e) {
            return false;
        });
    }
});

// 통합검색
function fullSearch(temp, mode) {
    if(temp == undefined) {
        $('.area_bottom .tab_menu li').each(function() {
            if($(this).hasClass('active')) {
                temp = $(this)[0].innerText;
            }
        });
    }
    if(mode != 's') {
        if($('#full_search').val() == '') {
            swal('검색어를 입력해 주세요.');
            return false;
        }
    }
    $.ajax({
        url: g5_bbs_url+'/ajax.full_search.php',
        type: 'POST',
        dataType: 'html',
        data: {search: $('#full_search').val(), category: temp},
        success: function(data) {
          if(data) {
              $('.full_sch').html(data);

              if($.trim($('#full_search').val()).length != 0) {
                  $(".full_sch li .sch").highlight($('#full_search').val()); // 검색어 있을 시 하이라이트
              }

              // 페이징 처리 -- 하단에 페이지 표시
              ajaxGetPaging('full');
          }
        },
    });
}

// 페이징 처리 -- 페이지 클릭 시 동작 이벤트
function get_page(page) {
    fullSearch(page);
}
</script>


<div id="wrapper">
	<? if(defined('_INDEX_')) {?>
        <div id="idx_container">
	<? }else { ?>
    <!--서브메뉴-->

    <?php if($_SERVER['QUERY_STRING'] == 'co_id=company') { ?>
        <div id="container_wrap">
    <?php } else { ?>
        <div id="container">
    <?php } ?>

          <div class="sub_title"><?php echo $g5['title'] ?></div>

    <?php } ?>

