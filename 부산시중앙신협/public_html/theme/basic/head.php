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

<?php if ($pid == "qr_span" || $pid == "use_point" || $pid == "use_point_com"){ ?>
<!--상단안나오게-->


<? }else { ?>

<!-- 상단 시작 { -->
<div id="hd" class="
<? if(defined('_INDEX_')) {?>mainVer<? }else if($co_id=="info" || $co_id=="trv_service") { ?>subVer memberVer<? }else if($bo_table || $pid == "order_form" || $pid == "mypage" || $pid == "modify_info" || $pid == "widthdraw" || $pid == "rev_list" || $pid == "point_list" || $pid == "coupon_list" || $pid == "rev_view"  || $pid == "private_order_form"  || $pid == "golf_order_form" || $co_id=="provision") { ?>subVer bordVer<? }else { ?>subVer<? } ?>
">
	
    <h1 id="hd_h1"><?php echo $g5['title'] ?></h1>

    <div id="skip_to_container"><a href="#container">본문 바로가기</a></div>

    <?php
    if(defined('_INDEX_')) { // index에서만 실행
        include G5_BBS_PATH.'/newwin.inc.php'; // 팝업레이어
    }
    ?>

    <div id="hd_wrapper" >
    <div class="nav_open">
        <a href="#hash-menu" id="hash_menu" data-role="button" data-url="<?php echo G5_PLUGIN_URL;?>/hash/" data-ref="1" data-animation="right">
            <span></span><span></span><span></span>
        </a>
    </div><!--모바일메뉴버튼-->


        <div id="logo">
            <a href="<?php echo G5_URL ?>">
			부산시중앙신협 멤버스</a>
        </div><!--#logo-->
        <ul class="login_sec">
            <?php if (!$is_member){ ?>
            <li>
                
                
				<?php if ($bo_table || $pid == "order_form" || $pid == "mypage" || $pid == "modify_info" || $pid == "rev_list" || $pid == "point_list"  || $pid == "coupon_list" || $pid == "rev_view"  || $pid == "private_order_form"){ ?>
				<a href="<?php echo G5_BBS_URL ?>/login.php"  class="ver_b"><img src="<?php echo G5_THEME_IMG_URL ?>/common/ico_login.png">로그인</a>
				<?php }else{ ?>
				<a href="<?php echo G5_BBS_URL ?>/login.php" ><img src="<?php echo G5_THEME_IMG_URL ?>/common/ico_login_w.png">로그인</a>
				<?}?>


            </li>
            <?php }else{ ?>
                <li>
                
				<?php if ($member["mb_level"] <8){  ?>
				<img src="<?php echo G5_THEME_IMG_URL ?>/common/level_0<?=$member["mb_level"]-1?>.svg" alt="<?=$member["mb_level"]?>"><?=$level_arr[$member["mb_level"]-1]?>
				<?php } ?>
				<strong class="level0<?=$member["mb_level"]-1?>"><?=$member["mb_name"]?></strong>님 반갑습니다.

				<?php if ($bo_table || $pid == "order_form" || $pid == "mypage" || $pid == "modify_info" || $pid == "rev_list" || $pid == "point_list"  || $pid == "coupon_list" || $pid == "rev_view"  || $pid == "private_order_form"){ ?>
				<a href="<?php echo G5_BBS_URL ?>/logout.php"  class="ver_b">
				로그아웃</a>
				
				<?php }else{ ?>
				<a href="<?php echo G5_BBS_URL ?>/logout.php" >
				로그아웃</a>
				<?}?>



                </li>
            <?php } ?>
        </ul>
       
    <nav id="gnb" >
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
            ?>
            <li class="gnb_1dli" style="z-index:<?php echo $gnb_zindex--; ?>">
                <a href="<?php echo G5_URL.$row['me_link']; ?>" target="_<?php echo $row['me_target']; ?>" class="gnb_1da"><?php echo $row['me_name'] ?><span></span></a>
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
				<li class="gnb_1dli"><a href="javascript:alert('준비중입니다')"  class="gnb_1da">제휴서비스<span></span></a>
					<ul class="gnb_2dul">
						<li class="gnb_2dli"><a href="javascript:alert('준비중입니다')" class="gnb_2da">제휴서비스</a></li>
					</ul>
				</li>
       <li class="gnb_1dli" id="member_wrap">
        <ul>
            <?php if (!$is_member){ ?>
            <li>
                <a href="<?php echo G5_BBS_URL ?>/login.php">로그인</a>
            </li>
            <li>
                <a href="<?php echo G5_BBS_URL ?>/register.php">회원가입</a>
            </li>
            <?php }else{ ?>
              <li class="level_wrap">
<!--
              임직원:level_06.svg
              vvip:level_04.svg
              vip:level_03.svg
              조합원:level02.svg
              일반:level01.svg
-->
			   <?php if ($member["mb_level"] <8 && $member["mb_level"] != 2 ){  ?>
              	<img src="<?php echo G5_THEME_IMG_URL ?>/common/level_0<?=$member["mb_level"]-1?>.svg" alt="<?=$member["mb_level"]?>"><?=$level_arr[$member["mb_level"]-1]?>
                  <?php } ?>
<!--
              vvip:.level04
              vip:.level03
              조합원:.level02
              일반:.level01
-->
              	<strong class="level0<?=$member["mb_level"]-1?>"><?=$member["mb_name"]?></strong>님 반갑습니다.
              </li>
               <li>
                  <a href="<?php echo G5_BBS_URL ?>/mypage.php">마이페이지</a>
               </li>
                <li>
                    <a href="<?php echo G5_BBS_URL ?>/logout.php">로그아웃</a>
                </li>
            <?php } ?>
        </ul>

       </li>
    </ul>
        

    </nav>
    
    <?php /*?><div class="mobile_home"><a href="<?php echo G5_URL ?>"><i class="fa fa-home" aria-hidden="true"></i></a><span class="sound_only">홈</span></div><?php */?>

    </div><!--#hd_wrapper-->
</div>
<!-- } 상단 끝 -->


<? } ?>


<!-- 콘텐츠 시작 { -->
<? if($co_id=="info" || $co_id=="info2" || $co_id=="info_ex" || $co_id=="trv_service" || $co_id=="priv_center" || $co_id=="golf_center" || $co_id=="cu_center" || $co_id=="golf_center_info" || $co_id=="life_st" || $co_id=="life_st_book" || $co_id=="life_st_cine" || $pid=="private_order_form" || $pid=="golf_order_form"){ ?>
	<!-- 멤버스안내페이지는 안나오게 -->

<? }else if($pid=="qr_span"){ ?>	
<div class="justi_center">
	<section class="bg_box btm_nav_box text-center">
		<div class="autoW">
			<h3 class="link_title ver3" data-aos="fade-down">QR코드 스캔</h3>
			<p>
				스캔하기 버튼을 눌러<br>QR코드를 스캔하세요
			</p>
		</div>
	</section>



<? }else if($pid=="use_point"){ ?>	
<div class="justi_center">
	<section class="bg_box btm_nav_box top_ver qr_ver">
		<div class="autoW">
			<h3 class="link_title flex_wrap" data-aos="fade-down">
				<span>스캔한 <span class="under_point">회원 정보</span></span>
				<a href="./qr_span.php" class="back_qrscan">
					<img src="<?php echo G5_THEME_IMG_URL ?>/common/ic_qr.svg" alt="">
					<p>스캔화면<br>돌아가기</p>
				</a>
			</h3>
		</div>
	</section>

<? }else if($pid=="use_point_com"){ ?>
<div class="justi_center">	
	<section class="bg_box btm_nav_box top_ver qr_ver">
		<div class="autoW">
			<h3 class="link_title flex_wrap" data-aos="fade-down">
				<span>포인트 <span class="under_point">사용 완료</span></span>
				<a href="./qr_span.php" class="back_qrscan">
					<img src="<?php echo G5_THEME_IMG_URL ?>/common/ic_qr.svg" alt="">
					<p>스캔화면<br>돌아가기</p>
				</a>
			</h3>
		</div>
	</section>
	
	
<?} else { ?>
<div id="wrapper">
    <? if(defined('_INDEX_')) {?>
	<!--메인컨테이너 부분-->
    <div id="container_index">
       
       
	<? }else { ?>
    
	<div id="container">
		<? if($bo_table || $co_id){ ?>
        <!-- 서브 게시판 및 내용관리 부분 -->
		<div id="scont_wrap">
		<? }else { ?>
        <!-- 그외 검사결과창 및 회원가입 -->
		<div id="scont_wrap2">
        <? } ?>
        

		<div id="scont">

			<? if($bo_table=="event"){ ?>
			<!-- 이벤트게시판 -->		
			<section class="bg_box btm_nav_box top_ver">
				<div class="autoW">
					<div class="link_title ver2" data-aos="fade-down">NEWS
					<p>부산시중앙신협만의 특별한 소식으로 여러분을 모십니다.</p></div>
				</div>
			</section>

			<? } else if($bo_table=="cucenter"){ ?>
			<!-- 문화센터 -->		
			<section class="bg_box btm_nav_box top_ver">
				<div class="autoW">
					<div class="link_title ver2" data-aos="fade-down">문화센터
					<p>부산시중앙신협만의 특별한 문화센터로 여러분을 모십니다.</p></div>
				</div>
			</section>

			<? } if($bo_table=="news"){ ?>
            <!-- 이벤트게시판 -->
            <section class="bg_box btm_nav_box top_ver">
                <div class="autoW">
                    <div class="link_title ver2" data-aos="fade-down">News
                        <p>부산시중앙신협의 소식을 전합니다.</p></div>
                </div>
            </section>

            <? }else if($pid == "order_form"){ ?>
		<!--      주문서-->
						<section class="bg_box btm_nav_box top_ver">
							<div class="autoW">
								<div class="link_title ver2" data-aos="fade-down">수강결제
								<p>부산시중앙신협만의 특별한 문화센터로 여러분을 모십니다.</p></div>
							</div>

			<? }else if($pid=="mypage"){ ?>
			<!-- 마이페이지 -->		
					<section class="bg_box btm_nav_box top_ver">
						<div class="autoW">
							<div class="link_title ver2" data-aos="fade-down">마이페이지</div>
						</div>
					</section>

			<? }else if($pid=="modify_info"){ ?>	
					<section class="bg_box btm_nav_box top_ver">
						<div class="autoW">
							<div class="link_title ver2" data-aos="fade-down">내 정보 및 수정</div>
						</div>
					</section>


			<? }else if($pid=="widthdraw"){ ?>	
					<section class="bg_box btm_nav_box top_ver">
						<div class="autoW">
							<div class="link_title ver2" data-aos="fade-down">탈퇴 하기</div>
						</div>
					</section>


			<? }else if($pid=="rev_list"){ ?>	
					<section class="bg_box btm_nav_box top_ver">
						<div class="autoW">
							<div class="link_title ver2" data-aos="fade-down">예약현황1</div>
						</div>
					</section>

			<? }else if($pid=="rev_view"){ ?>	
					<section class="bg_box btm_nav_box top_ver">
						<div class="autoW">
							<div class="link_title ver2" data-aos="fade-down">예약현황3</div>
						</div>
					</section>



			<? }else if($pid=="point_list"){ ?>	
					<section class="bg_box btm_nav_box top_ver">
						<div class="autoW">
							<div class="link_title ver2" data-aos="fade-down">포인트 현황</div>
						</div>
					</section>



			<? }else if($pid=="coupon_list"){ ?>	
					<section class="bg_box btm_nav_box top_ver">
						<div class="autoW">
							<div class="link_title ver2" data-aos="fade-down">쿠폰 현황</div>
						</div>
					</section>




			<? }else if($bo_table=="notice"){ ?>
			  <link rel="stylesheet" href="<?=G5_BBS_URL?>/style.css?v=<?=G5_CSS_VER?>">	
					<section class="bg_box btm_nav_box top_ver">
						<div class="autoW">
							<div class="link_title ver2" data-aos="fade-down">공지사항</div>
						</div>
					</section>


						<div class="autoW bdpd">
							<div id="mypage_wrap" class="">
							   <div class="left_menu">
									<ul>
									   <li>
										   <a href="./mypage.php">마이페이지 홈</a>
									   </li>
										<li>
											<a href="./modify_info.php">
												내 정보 및 수정
											</a>
										</li>
										<li>
											<a href="./rev_list.php">
												예약 현황
											</a>
										</li>
										<li>
											<a href="./point_list.php">
												포인트 현황
											</a>
										<li>
											<a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=notice">
												공지사항
											</a>
										</li>
									</ul>
								</div>
								<div class="con_wrap">



		
<!--		서비스이용약관 적용-->
			<? }else if($bo_table || $co_id){ ?>	
					<section class="bg_box btm_nav_box top_ver" style="text-align:left;">
						<div class="autoW">
							<div class="link_title ver2" data-aos="fade-down"><?php echo $g5['title'] ?></div>
							<div class="bdpd">

			<? } ?>

		<? } ?>

		<? if($bo_table=="golf_club"){ ?>
			<div class=" bdpd">
		<? } else if($bo_table){ ?>
			<div class="autoW bdpd">
        <? } ?>


	<? } ?>

    <script>

        ///달력 휴일 미리 담아주기(공공아이피라 느려서 미리 담음)
        var holiday = [];
        function holiday_req_(month) {
            var final_currentMonth = month;
            if (final_currentMonth.toString().length == 1){
                final_currentMonth = "0" + final_currentMonth;
            }
            // 공공아이피. 2년마다 갱신해줘야함.
            var xhr = new XMLHttpRequest();
            var url = 'http://apis.data.go.kr/B090041/openapi/service/SpcdeInfoService/getRestDeInfo'; /*URL*/
            var queryParams = '?' + encodeURIComponent('serviceKey') + '='+'H9zRliq4v5OaNTv0fCijnOdMN7r05Pcb1QowiP9VgmW3Kayc4YO2owHcrgXXJVD7c1EH%2FNcEJLXrfBhLXs%2Fq8w%3D%3D'; /*Service Key*/
            queryParams += '&' + encodeURIComponent('solYear') + '=' + encodeURIComponent(2023); /**/
            //queryParams += '&' + encodeURIComponent('solYear') + '=' + encodeURIComponent(<?//=date("Y",strtotime(G5_TIME_YMD))?>//); /**/

            queryParams += '&' + encodeURIComponent('solMonth') + '=' + encodeURIComponent(final_currentMonth); /**/


            xhr.open('GET', url + queryParams);
            xhr.onreadystatechange = function () {

                if (this.readyState == 4) {
                    var xml = xhr.responseXML;

                    var date = xml.getElementsByTagName("locdate");
                    for (var i = 0; i < date.length; i++) {
                        holiday.push(date[i].childNodes[0].nodeValue);
                    }
                    //calendarInit();
                    sessionStorage.setItem("holiday", JSON.stringify(holiday));
                }
            };

            xhr.send('');
        }
        var i = 1;
        $(document).ready(function () {

            var session_holiday = sessionStorage.getItem("holiday");
            if (session_holiday == "null" || session_holiday == null) {
                for (i = 1; i <= 12; i++) {
                    holiday_req_(i);
                }
            }

        })
    </script>
	
