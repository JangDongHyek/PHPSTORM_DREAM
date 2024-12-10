<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

$dept_css = array(1=>"block", 2=>"none");

if (defined('G5_IS_ADMIN')) {
	add_stylesheet('<link rel="stylesheet" href="'.G5_THEME_CSS_URL.'/all.min.css">', 0);//폰트어썸
    add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/admin.css">', 0);

	// 광역시 공통링크
	$depth_link = "?bo_table={$bo_table}&map_si=";
	
} else {
	add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
	$is_checkbox = false;
}

?>
<!-- 게시판 검색 시작 { -->
<fieldset id="bo_sch">
    <legend>게시물 검색</legend>
    <form name="fsearch" method="get">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <!--<input type="hidden" name="sca" value="<?php echo $sca ?>">-->
    <input type="hidden" name="sop" value="and">
	<input type="hidden" name="map_si" value="<?=$map_si?>">
	<input type="hidden" name="map_gu" value="<?=$map_gu?>">

    <label for="sfl" class="sound_only">검색대상</label>
    <select name="sfl" id="sfl">
        <option value="wr_subject"<?php echo get_selected($sfl, 'wr_subject', true); ?>>이름</option>
        <option value="wr_1"<?php echo get_selected($sfl, 'wr_1'); ?>>상세내용</option>
    </select>
    <label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
    <input type="text" name="stx" value="<?php echo stripslashes($stx) ?>" id="stx" class="frm_input sch_input" size="15" maxlength="20">
    <input type="submit" value="검색" class="btn_submit">
    </form>
</fieldset>
<!-- } 게시판 검색 끝 -->

<? if(defined('G5_IS_ADMIN')) { ?>
<link rel="stylesheet" href="<?php echo $board_skin_url ?>/css/map.css" type="text/css">
<script type="text/javascript" src="<?php echo $board_skin_url ?>/js/tooltip.js"></script>
<script type="text/javascript" src="<?php echo $board_skin_url ?>/js/map.js?v=1.1"></script>

<div id="adm_map">
	<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
    <tbody><tr>
        <td width="310" valign="top" style="padding-left:10">
            <!-- mapArea -->
			<div class="intranetMap">
				<form method="post" id="f_map" name="f_map" action="<?php echo $board_skin_url ?>iframe_member_subalju.php">
					<input type="hidden" name="sendURL" id="sendURL" value="<?php echo $board_skin_url ?>iframe_member_subalju.php">
					<input type="hidden" name="target" id="target" value="iframe_01">
					<input type="hidden" name="jbname" id="jbname" value="">
					<input type="hidden" name="jsname" id="jsname" value="">
					<input type="hidden" name="guname" id="guname" value="">
					<input type="hidden" name="fVn" id="fVn" value="jkey|callroseweb|rcode|ms|sel_gcate|bdate|mcate|ct">
					<input type="hidden" name="fVd" id="fVd" value="|||88||||">
				</form>
				<!-- mapArea -->
				<div class="mapArea m_country">
					<div class="title"><img src="<?php echo $board_skin_url ?>/img/country_title.gif" id="map_title"></div>

					<!-- ImgMap -->
					<div class="ImgMap">
						<img src="<?php echo $board_skin_url ?>/img/country_bg.gif" alt="지도" usemap="#map_country" id="map" style="display:none;">
						<div class="mapbox">
							<img src="<?php echo $board_skin_url ?>/img/kg_on.png?v=200325" class="none" alt="경기" usemap="#map_country" id="map_over" style="display: none;">
						</div>
					</div>
					<!-- //ImgMap -->
					<!--<div class="btnArea none">
						<img src="<?php echo $board_skin_url ?>/img/btn_country.gif" alt="전국지도보기" class="btn_country" data-id="">
						<img src="<?php echo $board_skin_url ?>/img/btn_pre.gif" alt="이전단계" class="btn_pre none" data-pid="" data-id="">
					</div>-->
					<div class="btnArea none" id="btn_map_back" onclick="location.href='?bo_table=<?=$bo_table?>'">
						<img src="<?php echo $board_skin_url ?>/img/btn_country.gif" alt="전국지도보기">
					</div>
				</div>

				<!-- Map 1depth -->
				<map name="map_country" id="map_country" data-depth="1">
					<area href="<?=$depth_link?>강원" alt="강원" data-id="kw" is-last="N" shape="poly" coords="187,15,189,28,203,51,234,95,224,103,196,103,169,89,160,89,154,98,154,83,159,72,143,67,141,51,124,34,123,29,136,32,160,33,186,16">
					<area href="<?=$depth_link?>경기" alt="경기" data-id="kg" is-last="N" shape="poly" coords="120,37,128,43,137,52,137,72,153,76,147,81,150,98,126,116,115,112,109,118,100,111,91,101,97,85,103,81,113,86,122,81,121,66,114,63,102,73,96,69,88,68,88,61,98,59,96,50,104,49,105,37,119,30">
					<area href="<?=$depth_link?>경남" alt="경남" data-id="kn" is-last="N" shape="poly" coords="158,189,147,195,151,216,146,222,150,239,160,240,160,260,167,261,173,254,194,262,205,256,203,244,188,251,189,236,202,231,222,217,214,209,195,206,181,204,172,191,157,188">
					<area href="<?=$depth_link?>경북" alt="경북" data-id="kb" is-last="N" shape="poly" coords="195,109,188,127,176,123,162,137,160,155,163,165,159,180,172,186,181,199,184,180,201,167,211,186,197,202,208,205,220,197,226,189,239,196,247,172,239,176,235,152,241,131,235,101,223,110,195,108">
					<area href="<?=$depth_link?>경북" alt="경북" data-id="kb" shape="circle" coords="259,81,8"><!-- 경상북도 울릉도 -->
					<area href="<?=$depth_link?>광주" alt="광주" data-id="kj" is-last="N" shape="poly" coords="100,229,88,233,83,239,95,251,109,248,114,241,99,229">
					<area href="<?=$depth_link?>대구" alt="대구" data-id="dg" is-last="N" shape="poly" coords="186,186,186,200,194,201,193,193,206,185,201,176">
					<area href="<?=$depth_link?>대전" alt="대전" data-id="dj" is-last="N" shape="poly" coords="127,150,128,162,134,166,141,159,137,146">
					<area href="<?=$depth_link?>부산" alt="부산" data-id="ps" is-last="N" shape="poly" coords="213,243,231,231,231,224,236,219,229,216,213,230,206,232,192,237,192,244,209,236">
					<!--<area href="#" alt="서울" data-id="su" is-last="N" shape="poly" coords="111,82,119,79,119,69,111,67,103,77">-->
					<area href="<?=$depth_link?>서울" alt="서울" data-id="su" is-last="N" shape="poly" coords="111,82,119,79,119,69,111,67,103,77">
					<area href="<?=$depth_link?>세종" alt="세종" data-id="sj" is-last="N" shape="poly" coords="119,133,119,142,128,147,132,140,128,132">
					<area href="<?=$depth_link?>울산" alt="울산" data-id="us" is-last="N" shape="poly" coords="222,214,230,212,237,216,242,215,242,201,227,193,215,204">
					<area href="<?=$depth_link?>인천" alt="인천" data-id="ic" is-last="N" shape="poly" coords="85,61,82,56,69,65,72,73,82,82,92,84,99,80,96,73,85,72,85,61">
					<area href="<?=$depth_link?>인천" alt="인천" data-id="ic" is-last="N" shape="poly" coords="58,97,64,103,67,100,72,103,79,99,87,95,81,91,74,94,64,91,58,97">
					<area href="<?=$depth_link?>전남" alt="전남" data-id="jn" is-last="N" shape="poly" coords="80,223,72,233,56,235,63,244,52,253,51,262,60,275,49,289,54,301,65,296,77,283,96,288,116,292,125,282,139,281,139,266,152,269,158,261,157,246,147,242,143,225,120,227,115,248,95,255,79,239,87,229,103,226,115,238,118,225,105,217">
					<area href="<?=$depth_link?>전북" alt="전북" data-id="jb" is-last="N" shape="poly" coords="87,177,99,179,109,165,114,181,126,172,134,181,150,175,159,183,145,193,147,214,141,221,119,223,104,211,91,216,81,218,81,205,93,196">
					<area href="<?=$depth_link?>제주" alt="제주" data-id="jj" is-last="N" shape="poly" coords="64,326,74,334,90,327,107,323,112,316,103,306,84,310,68,314">
					<area href="<?=$depth_link?>충남" alt="충남" data-id="cn" is-last="N" shape="poly" coords="81,107,68,125,68,134,78,150,88,162,89,172,99,176,108,161,115,165,115,175,126,168,136,176,145,174,142,164,133,171,125,164,124,153,115,142,116,129,126,130,137,130,129,122,123,122,119,117,110,123">
					<area href="<?=$depth_link?>충북" alt="충북" data-id="cb" is-last="N" shape="poly" coords="138,110,151,104,158,106,162,99,166,101,172,98,191,108,186,123,173,117,158,134,154,159,158,166,156,174,148,170,145,161,143,148,135,143,132,134,143,132,130,119">
				</map>

				<!-- Map 2depth 서울 -->
				<map name="map_su" id="map_su" data-depth="2">
					<area href="#" alt="강남구" data-id="su_gangnam" is-last="Y" shape="poly" coords="176,198,181,214,187,231,195,233,201,246,210,248,219,240,230,242,232,256,240,248,247,247,237,232,229,225,217,224,211,219,210,202,196,190,187,190">
					<area href="#" alt="강동구" data-id="su_gangdong" is-last="Y" shape="poly" coords="246,174,245,182,247,187,247,194,250,200,257,203,266,197,267,186,274,183,283,186,285,177,282,167,283,157,277,160,269,164,261,166,253,167">
					<area href="#" alt="강북구" data-id="su_gangbuk" is-last="Y" shape="poly" coords="170,68,177,77,175,87,170,93,185,99,193,105,197,117,189,125,179,126,172,115,163,111,158,105,158,95,153,86,161,85,160,75">
					<area href="#" alt="강서구" data-id="su_gangseo" is-last="Y" shape="poly" coords="11,177,21,160,26,157,28,151,37,149,36,139,40,136,71,158,79,170,88,176,83,183,76,186,74,197,66,198,54,181,47,188,44,182,34,189,29,183,22,183">
					<area href="#" alt="관악구" data-id="su_gwanak" is-last="Y" shape="poly" coords="112,234,108,232,118,229,125,227,137,226,143,238,151,243,157,242,160,252,148,265,141,263,135,270,125,269,120,265,121,257,113,256,108,245">
					<area href="#" alt="광진구" data-id="su_gwangjin" is-last="Y" shape="poly" coords="221,161,219,168,212,187,208,196,214,200,226,200,242,182,243,174,236,175,236,159,229,164">
					<area href="#" alt="구로구" data-id="su_guro" is-last="Y" shape="poly" coords="49,218,46,224,49,231,47,238,48,243,53,242,59,246,65,236,72,233,77,226,81,228,83,231,89,233,96,237,101,232,97,228,95,215,91,206,84,210,77,215,67,215,60,221">
					<area href="#" alt="금천구" data-id="su_geumcheon" is-last="Y" shape="poly" coords="85,235,87,241,91,250,93,258,99,264,105,274,112,273,118,265,118,260,111,259,108,252,105,245,109,235,103,233,96,241">
					<area href="#" alt="노원구" data-id="su_nowon" is-last="Y" shape="poly" coords="206,60,213,60,220,58,222,64,228,67,230,83,222,88,223,95,236,101,237,108,235,118,222,118,214,121,208,120,206,115,200,114,195,106,198,97,204,98,205,83,202,73">
					<area href="#" alt="도봉구" data-id="su_dobong" is-last="Y" shape="poly" coords="172,67,172,61,175,51,181,52,186,56,189,61,196,60,202,63,200,73,202,86,202,94,196,96,194,102,186,97,175,92,179,84,180,77">
					<area href="#" alt="동대문구" data-id="su_dongdaemun" is-last="Y" shape="poly" coords="183,155,190,144,197,142,203,134,211,132,215,141,213,147,218,154,218,163,211,166,198,160">
					<area href="#" alt="동작구" data-id="su_dongjak" is-last="Y" shape="poly" coords="137,203,139,207,146,209,149,212,153,213,158,224,155,228,157,238,151,240,143,233,139,223,133,224,133,223,127,225,119,223,116,227,107,230,101,230,114,221,116,215,121,210,129,203">
					<area href="#" alt="마포구" data-id="su_mapo" is-last="Y" shape="poly" coords="88,147,84,158,76,161,90,175,107,182,114,190,120,186,132,193,134,186,140,178,138,175,128,175,115,167,104,156">
					<area href="#" alt="서대문구" data-id="su_seodaemun" is-last="Y" shape="poly" coords="107,155,113,152,121,148,125,143,131,133,132,136,137,139,140,148,137,158,144,163,141,173,129,173,115,164">
					<area href="#" alt="서초구" data-id="su_seocho" is-last="Y" shape="poly" coords="156,213,166,211,174,199,185,233,193,235,200,248,207,251,213,249,219,243,228,245,230,258,225,263,220,262,221,271,217,281,201,281,190,277,189,261,191,254,189,249,181,258,174,257,168,254,166,248,163,252,162,247,160,240,158,230,161,223">
					<area href="#" alt="성동구" data-id="su_seongdong" is-last="Y" shape="poly" coords="182,158,185,165,176,181,177,186,182,189,189,185,197,187,205,194,211,184,213,176,216,167,211,170,201,166,194,162">
					<area href="#" alt="성북구" data-id="su_seongbuk" is-last="Y" shape="poly" coords="156,113,155,108,171,119,176,128,190,129,200,117,209,124,215,126,213,129,204,130,195,139,189,140,183,150,162,136,154,141,153,138,160,129,157,120">
					<area href="#" alt="송파구" data-id="su_songpa" is-last="Y" shape="poly" coords="213,203,213,215,218,221,232,222,239,230,246,239,250,248,252,238,254,238,256,230,267,221,258,215,255,206,245,199,243,186,236,193,228,202">
					<area href="#" alt="양천구" data-id="su_yangcheon" is-last="Y" shape="poly" coords="48,191,52,198,50,206,50,215,57,217,62,218,66,212,76,213,82,208,89,203,90,196,93,180,91,179,78,189,77,197,72,201,63,199,54,185">
					<area href="#" alt="영등포구" data-id="su_yeongdeungpo" is-last="Y" shape="poly" coords="96,180,95,188,91,203,97,212,100,229,111,220,115,214,126,201,135,199,132,196,121,190,113,193,105,185">
					<area href="#" alt="용산구" data-id="su_yongsan" is-last="Y" shape="poly" coords="143,176,153,174,159,176,164,175,174,181,173,186,180,191,172,197,165,207,156,210,149,209,147,206,142,206,140,204,138,198,135,193,137,186,142,181">
					<area href="#" alt="은평구" data-id="su_eunpyeong" is-last="Y" shape="poly" coords="93,147,100,144,99,136,102,130,101,120,107,114,109,102,116,100,129,92,139,95,145,107,138,113,135,124,130,131,121,144,116,147,105,153">
					<area href="#" alt="종로구" data-id="su_jongno" is-last="Y" shape="poly" coords="133,131,138,125,140,115,148,107,154,115,153,122,157,129,151,136,152,144,161,140,170,145,180,151,180,159,166,156,158,158,151,156,143,159,140,156,143,150,140,139">
					<area href="#" alt="중구" data-id="su_jung" is-last="Y" shape="poly" coords="146,162,146,166,144,174,151,171,158,173,166,173,174,179,179,171,182,165,181,161,177,163,164,160,159,162,151,160">
					<area href="#" alt="중랑구" data-id="su_jungnang" is-last="Y" shape="poly" coords="216,123,218,129,214,132,217,140,217,147,221,152,221,158,230,161,236,154,241,148,240,143,244,138,242,132,241,122,234,121">
					<!-- 주변지역 -->
					<area href="#" alt="광명시" data-id="kg_cwangmyeong_su_near" is-last="Y" shape="poly" coords="22,288,85,245,87,252,89,258,96,267,107,280,121,269,130,274,130,293">
					<area href="#" alt="부천시" data-id="kg_bucheon_su_near" is-last="Y" shape="poly" coords="10,218,20,286,83,242,83,236,79,230,67,240,61,249,50,247,44,243,46,231,42,224,46,215,48,201,46,194">
					<area href="#" alt="인천" data-id="ic_su_near" is-last="Y" shape="poly" coords="11,180,11,213,45,190,43,187,34,193,28,186,18,185">
					<area href="#" alt="인천" data-id="ic_su_near" is-last="Y" shape="poly" coords="10,156,10,173,18,160">
					<area href="#" alt="김포시" data-id="kg_gimpo_su_near" is-last="Y" shape="poly" coords="10,154,19,158,24,156,25,150,34,145,33,138,37,133,41,134,38,116,10,105">
					<area href="#" alt="고양시" data-id="kg_goyang_su_near" is-last="Y" shape="poly" coords="40,115,44,136,72,154,75,159,82,156,85,146,89,143,96,142,97,136,99,127,99,118,105,112,106,100,116,97,128,89,141,93,149,105,155,104,155,98,150,89,151,82,155,81,160,81,156,71,100,36">
					<area href="#" alt="의정부시" data-id="kg_uijeongbu_su_near" is-last="Y" shape="poly" coords="102,34,160,70,168,66,170,61,171,52,176,47,182,49,189,51,190,57,196,56,203,58,210,57,219,55,229,9">
					<area href="#" alt="구리시" data-id="kg_guri_su_near" is-last="Y" shape="poly" coords="231,9,221,56,225,58,225,63,232,64,230,73,234,86,224,91,240,102,239,117,244,123,248,138,246,141,244,149,239,155,239,171,246,171,292,127">
					<area href="#" alt="하남시" data-id="kg_hanam_su_near" is-last="Y" shape="poly" coords="260,163,292,131,293,233,276,229,266,226,272,219,263,215,258,206,269,198,270,188,276,187,285,189,289,180,285,169,286,155,282,152">
					<area href="#" alt="성남시" data-id="kg_seongnam_su_near" is-last="Y" shape="poly" coords="219,284,231,321,293,237,264,229,258,232,255,242,252,251,240,252,232,260,225,269">
					<area href="#" alt="과천시" data-id="kg_gwacheon_su_near" is-last="Y" shape="poly" coords="162,256,148,268,142,268,133,274,133,293,228,323,216,284,203,285,188,281,186,269,186,260,178,263">
				</map>
			</div>
            <!-- //mapArea -->

			<!-- Map 2depth 경기 -->
			<map name="map_kg" id="map_kg" data-depth="2">
				<area href="#" alt="가평군" data-id="kg_gapyeong" is-last="Y" shape="poly" coords="170,109,166,101,176,98,177,89,189,85,186,75,192,73,194,65,202,60,209,67,219,68,221,76,233,81,233,93,215,98,214,109,222,135,220,143,228,154,223,160,209,163,204,145,189,135,183,129,181,119,170,114">
				<area href="#" alt="고양시" data-id="kg_goyang" is-last="Y" shape="poly" coords="64,148,45,138,47,135,60,132,67,133,72,127,88,128,95,123,89,142,102,141,112,136,108,149,97,146,93,147,90,159,77,159">
				<area href="#" alt="과천시" data-id="kg_gwacheon" is-last="Y" shape="poly" coords="115,170,128,178,125,187,126,187,124,191,120,196,115,195,105,197,100,186,109,177">
				<area href="#" alt="광명시" data-id="kg_cwangmyeong" is-last="Y" shape="poly" coords="82,179,81,168,88,169,94,178,92,184,88,191,86,200,84,201,77,195,76,185">
				<area href="#" alt="광주시" data-id="kg_gwangju" is-last="Y" shape="poly" coords="142,212,157,212,169,211,171,218,171,229,183,228,187,218,195,216,203,207,192,198,194,186,190,173,182,169,180,167,176,176,169,179,167,187,159,188,160,193">
				<area href="#" alt="구리시" data-id="kg_guri" is-last="Y" shape="poly" coords="122,148,114,152,116,153,119,158,124,158,128,159,128,165,137,169,141,165,151,157,146,152,144,146,129,146">
				<area href="#" alt="군포시" data-id="kg_gunpo" is-last="Y" shape="poly" coords="84,213,89,218,95,223,98,218,102,207,95,205">
				<area href="#" alt="김포시" data-id="kg_gimpo" is-last="Y" shape="poly" coords="43,114,47,127,43,136,44,140,62,149,75,160,65,157,55,160,41,148,24,159,12,148,14,127,18,117,34,118">
				<area href="#" alt="남양주시" data-id="kg_namyangju" is-last="Y" shape="poly" coords="167,116,179,121,180,130,194,141,186,149,183,158,175,166,175,173,173,175,163,166,159,156,149,154,146,143,128,143,128,138,142,132,152,118,159,122">
				<area href="#" alt="대부도" data-id="kg_daebudo" is-last="Y" shape="poly" coords="21,223,16,232,9,229,2,235,8,244,15,242,29,250,30,242,36,243,42,236,35,230,27,227">
				<area href="#" alt="동두천시" data-id="kg_dongducheon" is-last="Y" shape="poly" coords="121,73,128,74,132,74,135,79,137,83,142,84,144,94,135,99,120,95,112,89,116,80">
				<area href="#" alt="부천시" data-id="kg_bucheon" is-last="Y" shape="poly" coords="79,178,74,185,64,185,58,177,59,169,65,164,72,165,79,169">
				<area href="#" alt="성남시" data-id="kg_seongnam" is-last="Y" shape="poly" coords="122,199,135,216,156,193,152,189,136,182,128,188">
				<area href="#" alt="수원시" data-id="kg_suwon" is-last="Y" shape="poly" coords="101,229,105,226,116,215,123,216,133,225,128,238,122,236,115,239,108,238,101,235">
				<area href="#" alt="시흥시" data-id="kg_siheung" is-last="Y" shape="poly" coords="64,187,69,188,73,187,76,199,85,205,74,206,64,209,57,212,50,218,46,214,45,209,52,204">
				<area href="#" alt="안산시" data-id="kg_ansan" is-last="Y" shape="poly" coords="87,207,81,214,92,225,99,228,99,234,88,232,80,227,70,225,53,220,60,213,79,208">
				<area href="#" alt="안성시" data-id="kg_anseong" is-last="Y" shape="poly" coords="150,271,161,261,179,263,188,267,203,269,200,264,203,259,211,263,215,266,213,273,204,278,201,286,191,288,190,298,181,300,166,311,154,302,141,293,143,287,138,281,137,278,133,271,137,268">
				<area href="#" alt="안양시" data-id="kg_anyang" is-last="Y" shape="poly" coords="98,186,93,185,87,203,89,209,94,203,104,205,105,200,104,200">
				<area href="#" alt="양주시" data-id="kg_yangju" is-last="Y" shape="poly" coords="100,139,102,136,113,132,108,122,113,116,123,118,137,112,137,105,131,100,119,98,111,91,110,85,103,84,100,103,99,103,93,110,98,122,93,140">
				<area href="#" alt="양평군" data-id="kg_yangpyeong" is-last="Y" shape="poly" coords="195,143,181,165,192,170,197,187,208,194,216,187,229,195,254,194,261,205,267,204,276,193,267,176,279,172,283,168,277,161,264,160,248,154,241,146,229,148,229,159,216,166,207,166,204,151">
				<area href="#" alt="여주시" data-id="kg_yeoju" is-last="Y" shape="poly" coords="232,199,218,192,208,197,199,192,195,194,198,200,210,207,226,219,221,243,225,248,237,246,245,255,253,255,264,237,265,208,257,204,249,197">
				<area href="#" alt="연천군" data-id="kg_yeoncheon" is-last="Y" shape="poly" coords="131,15,141,14,149,31,144,36,148,45,147,54,134,56,139,66,134,71,119,70,111,83,105,82,114,68,106,65,96,71,88,68,88,75,81,69,73,74,68,71,79,59,86,59,89,55,86,47,88,42,95,42,101,37,104,21,116,15,124,7,132,2">
				<area href="#" alt="오산시" data-id="kg_osan" is-last="Y" shape="poly" coords="131,259,133,268,137,266,138,262,140,256,125,252,124,244,111,244,115,257">
				<area href="#" alt="용인시" data-id="kg_yongin" is-last="Y" shape="poly" coords="144,237,131,237,135,225,140,215,167,213,171,233,182,230,179,236,186,244,200,255,198,267,178,260,161,257,149,269,139,265,142,254,149,247">
				<area href="#" alt="의왕시" data-id="kg_uiwang" is-last="Y" shape="poly" coords="105,209,109,199,120,198,127,211,136,219,133,223,123,213,115,213,110,217,101,227,98,223">
				<area href="#" alt="의정부시" data-id="kg_uijeongbu" is-last="Y" shape="poly" coords="113,119,122,121,134,117,138,119,144,123,137,132,124,136,117,134,111,124">
				<area href="#" alt="이천시" data-id="kg_icheon" is-last="Y" shape="poly" coords="196,218,205,208,223,220,219,243,224,251,237,249,243,256,239,260,240,266,226,276,216,276,220,267,214,258,209,259,201,252,195,246,187,241,183,234,190,219">
				<area href="#" alt="파주시" data-id="kg_paju" is-last="Y" shape="poly" coords="80,72,75,77,70,76,60,72,57,80,46,78,46,93,42,104,49,125,47,133,59,128,65,130,73,124,87,125,93,119,90,112,95,104,97,97,101,82,111,69,106,68,99,73,94,74,90,71,90,79">
				<area href="#" alt="평택시" data-id="kg_pyeongtaek" is-last="Y" shape="poly" coords="70,289,80,285,86,274,99,275,109,274,112,261,127,261,131,270,133,278,140,288,132,295,123,300,111,300,102,304,89,307,76,295">
				<area href="#" alt="포천시" data-id="kg_pocheon" is-last="Y" shape="poly" coords="151,44,150,56,139,58,143,66,135,74,139,80,145,81,147,95,137,101,141,110,137,116,144,120,150,115,160,118,166,113,162,100,173,94,177,83,185,84,182,75,189,70,193,60,201,57,199,46,175,44,169,39,169,28,168,28,160,37,152,32,147,37">
				<area href="#" alt="하남시" data-id="kg_hanam" is-last="Y" shape="poly" coords="146,164,139,171,138,182,147,185,157,186,165,185,165,179,166,174,163,170,155,158">
				<area href="#" alt="화성시" data-id="kg_hwaseong" is-last="N" shape="poly" coords="59,233,49,230,44,233,44,244,42,255,50,261,60,250,71,252,65,260,60,263,56,275,68,287,77,284,88,270,106,271,112,257,110,249,109,241,124,241,128,249,140,252,146,246,141,239,134,240,122,238,113,241,104,239,97,237,86,233,71,228,67,233">
				<!-- 주변지역 -->
				<area href="#" alt="강원 철원군" data-id="kw_cheorwon_kg_near" is-last="Y" shape="poly" coords="135,3,190,2,170,36,171,26,166,25,158,34,147,24,143,11,134,13">
				<area href="#" alt="강원 화천군" data-id="kw_hwacheon_kg_near" is-last="Y" shape="poly" coords="193,2,209,13,228,24,204,46,193,41,175,40,171,39">
				<area href="#" alt="강원 춘천시" data-id="kw_chuncheon_kg_near" is-last="Y" shape="poly" coords="205,48,229,26,266,41,274,92,219,107,218,100,236,95,235,79,225,73,219,64,210,64,204,59">
				<area href="#" alt="강원 홍천군" data-id="kw_hongcheon_kg_near" is-last="Y" shape="poly" coords="218,110,276,94,292,130,277,139,266,145,253,152,240,142,226,146,223,143,225,133">
				<area href="#" alt="강원 횡성군" data-id="kw_hoengseong_kg_near" is-last="Y" shape="poly" coords="274,158,281,158,286,169,273,177,278,190,298,190,294,132,255,155,263,155">
				<area href="#" alt="강원 원주시" data-id="kw_wonju_kg_near" is-last="Y" shape="poly" coords="279,193,268,209,268,233,295,245,298,193">
				<area href="#" alt="충북 충주시" data-id="cb_chungju_kg_near" is-last="Y" shape="poly" coords="268,236,294,248,272,306,252,259,261,250">
				<area href="#" alt="충북 음성군" data-id="cb_eumseong_kg_near" is-last="Y" shape="poly" coords="213,278,219,279,229,278,241,267,243,258,248,256,270,307,238,316">
				<area href="#" alt="충북 진천군" data-id="cb_jincheon_kg_near" is-last="Y" shape="poly" coords="194,299,193,291,203,289,206,280,211,279,237,317,188,330,181,304">
				<area href="#" alt="충남 천안시" data-id="cn_cheonan_kg_near" is-last="Y" shape="poly" coords="138,295,148,300,166,315,179,303,186,331,140,332,122,319,124,304">
				<area href="#" alt="충남 아산시" data-id="cn_asan_kg_near" is-last="Y" shape="poly" coords="37,317,73,294,77,299,86,308,95,311,101,307,107,306,113,305,122,302,121,318">
				<area href="#" alt="충남 당진시" data-id="cn_dangjin_kg_near" is-last="Y" shape="poly" coords="11,272,53,273,54,278,61,286,71,294,36,316">
			</map>
			<!-- Map 2depth 인천 -->
			<map name="map_ic" id="map_ic" data-depth="2">
				<area href="#" alt="강화군" data-id="ic_ganghwa" is-last="Y" shape="poly" coords="104,37,111,31,138,45,151,56,151,64,159,72,159,84,154,92,160,99,156,106,162,115,154,120,160,129,160,144,153,146,149,149,142,152,133,151,126,155,107,153,95,146,88,137,96,130,92,125,104,118,104,113,97,98,81,92,75,79,84,65,80,55,94,39">
				<area href="#" alt="강화군" data-id="ic_ganghwa" is-last="Y" shape="poly" coords="63,42,49,33,37,39,30,49,26,56,31,67,40,68,48,62,54,60,60,61,69,59,80,48,76,38">
				<area href="#" alt="강화군" data-id="ic_ganghwa" is-last="Y" shape="poly" coords="55,68,70,67,73,72,68,82,72,87,75,92,87,98,87,109,79,116,69,120,66,111,64,104,52,95,48,84">
				<area href="#" alt="강화군" data-id="ic_ganghwa" is-last="Y" shape="poly" coords="8,101,16,106,23,101,14,97">
				<area href="#" alt="강화군" data-id="ic_ganghwa" is-last="Y" shape="poly" coords="22,110,23,105,33,101,41,114,36,118">
				<area href="#" alt="강화군" data-id="ic_ganghwa" is-last="Y" shape="poly" coords="55,135,45,130,42,123,46,118,56,119,58,124,59,133">
				<area href="#" alt="계양구" data-id="ic_gyeyang" is-last="Y" shape="poly" coords="228,145,225,152,226,160,220,164,223,176,241,175,254,174,260,167,269,156,266,152,259,152,254,150,248,155,242,150">
				<area href="#" alt="미추홀구" data-id="ic_michuhol" is-last="Y" shape="poly" coords="209,204,204,218,203,225,200,237,201,237,209,230,224,233,221,220,230,210">
				<area href="#" alt="남동구" data-id="ic_namdong" is-last="Y" shape="poly" coords="230,213,224,222,227,235,216,259,228,261,235,266,242,256,249,250,251,241,256,235,257,227,259,222,255,216,249,212,243,214,237,212">
				<area href="#" alt="동구" data-id="ic_dong" is-last="Y" shape="poly" coords="213,188,203,215,190,211,189,205,197,203,200,196,193,197,188,192,183,184,191,181,198,183">
				<area href="#" alt="부평구" data-id="ic_bupyeong" is-last="Y" shape="poly" coords="223,178,221,188,215,190,211,202,236,210,250,209,247,204,242,196,250,186,251,177">
				<area href="#" alt="서구" data-id="ic_seo" is-last="Y" shape="poly" coords="170,150,175,156,172,163,166,170,172,179,179,176,181,171,183,176,190,178,196,176,206,171,203,178,197,181,218,188,221,176,218,169,218,164,223,159,222,152,228,142,206,128,191,139,185,146,174,146">
				<area href="#" alt="연수구" data-id="ic_yeonsu" is-last="Y" shape="poly" coords="202,239,205,252,214,258,226,234,221,235,214,233,209,232">
				<area href="#" alt="옹진군" data-id="ic_ongjin" is-last="Y" shape="poly" coords="80,168,78,173,80,178,76,186,82,192,92,187,102,184,105,177,97,177,90,179,90,171">
				<area href="#" alt="옹진군" data-id="ic_ongjin" is-last="Y" shape="poly" coords="106,172,108,178,114,177,120,167,110,166,109,168">
				<area href="#" alt="옹진군" data-id="ic_ongjin" is-last="Y" shape="poly" coords="115,183,125,183,132,177,131,170,122,167,118,174">
				<area href="#" alt="옹진군" data-id="ic_ongjin" is-last="Y" shape="poly" coords="77,277,69,278,66,287,74,287">
				<area href="#" alt="옹진군" data-id="ic_ongjin" is-last="Y" shape="poly" coords="89,291,92,301,101,300,106,295,106,287,111,277,105,275,97,279">
				<area href="#" alt="옹진군" data-id="ic_ongjin" is-last="Y" shape="poly" coords="114,285,119,278,128,277,134,286,128,290,120,289">
				<area href="#" alt="옹진군" data-id="ic_ongjin" is-last="Y" shape="poly" coords="158,264,154,270,156,279,160,283,159,294,166,301,176,298,177,292,185,290,195,284,195,276,178,265,171,269">
				<area href="#" alt="중구" data-id="ic_Jung" is-last="Y" shape="poly" coords="118,199,119,206,110,211,96,212,96,222,107,229,114,232,121,238,130,226,144,222,148,214,157,211,161,205,171,204,177,196,168,187,153,176,144,177,140,190,133,196,122,196">
				<area href="#" alt="중구" data-id="ic_Jung" is-last="Y" shape="poly" coords="101,236,101,237,91,242,97,245,105,247,115,255,120,248,114,240,110,235">
				<area href="#" alt="중구" data-id="ic_Jung" is-last="Y" shape="poly" coords="187,212,183,218,187,232,198,234,201,229,201,217">
				<!-- 주변지역 -->
				<area href="#" alt="김포시" data-id="kg_gimpo_ic_near" is-last="Y" shape="poly" coords="174,23,152,54,153,63,161,72,161,86,157,91,162,99,159,106,165,116,157,121,162,125,162,144,169,148,173,144,184,143,189,137,197,135,203,127,209,128,225,138,235,146,244,147,248,152,253,146,258,150,268,150,271,155,293,144,271,55">
				<area href="#" alt="부천시" data-id="kg_bucheon_ic_near" is-last="Y" shape="poly" coords="293,147,271,157,263,166,253,180,251,189,244,195,249,202,253,210,293,210">
				<area href="#" alt="시흥시" data-id="kg_siheung_ic_near" is-last="Y" shape="poly" coords="257,213,262,220,259,230,258,236,253,243,251,253,241,262,260,307,293,213">
			</map>

        </td>
      </tr>
	</tbody>
	</table>
</div>

<? 
} else { 
	$local_arr = array();
	switch ($map_si) {
		case "서울" : $local_arr = $seoul_list; break;
		case "인천" : $local_arr = $ic_list; break;
		case "경기" : $local_arr = $kg_list; break;
	}
?>
<div id="map_btn">
	<? if (in_array($map_si, $depth_local_list)) { ?>
	<!--서울/인천/경기 -->
    <ul class="su">
    	<li><a href="./board.php?bo_table=<?=$bo_table?>"><i class="fal fa-arrow-left"></i> 전국보기</a></li>
		<? foreach ($local_arr as $key=>$gu) { ?>
        <li <? if ($map_gu == $gu) echo "class='on'"; ?>><a href="?bo_table=<?=$bo_table?>&map_si=<?=$map_si?>&map_gu=<?=$gu?>"><?=$gu?></a></li>
		<? } ?>
    </ul>
    <!--//서울/인천/경기 -->
	<? } else { ?>
	<!--전국 -->
	<ul>
		<? foreach ($si_list as $key=>$si) { ?>
        <li <? if ($map_si == $si) echo "class='on'"; ?>><a href="?bo_table=<?=$bo_table?>&map_si=<?=$si?>" ><?=$si?></a></li>
        <? } ?>
		<li <? if ($map_si == "") echo "class='on'"; ?>><a href="?bo_table=<?=$bo_table?>">지역전체</a></li>
    </ul>
    <!--//전국 -->
	<? } ?>
</div>
<? } ?>

<!-- 게시판 목록 시작 { -->
<div id="bo_list" style="width:<?php echo $width; ?>">

    <!-- 게시판 페이지 정보 및 버튼 시작 { -->
    <div class="bo_fx">
        <div id="bo_list_total">
            <span>Total <?php echo number_format($total_count) ?>건</span>
            <?php echo $page ?> 페이지
        </div>
    </div>
    <!-- } 게시판 페이지 정보 및 버튼 끝 -->

    <form name="fboardlist" id="fboardlist" action="./board_list_update.php" onsubmit="return fboardlist_submit(this);" method="post">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="spt" value="<?php echo $spt ?>">
    <input type="hidden" name="sca" value="<?php echo $sca ?>">
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <input type="hidden" name="sw" value="">

	<input type="hidden" name="map_si" value="<?=$map_si?>">
	<input type="hidden" name="map_gu" value="<?=$map_gu?>">

	<div class="tbl_head01 tbl_wrap">
	<?php if ($is_checkbox) { ?>
	<div class="chk">
		<p><input type="checkbox" id="chkall" onclick="if (this.checked) all_checked(true); else all_checked(false);" /> <label for="chkall">현재 페이지 게시물 전체</label></p>
	</div>
	<?php } ?>
	<ul>
	<?php
	for($i=0; $i<count($list); $i++){
		//썸네일 이미지 가져오기
		$thumb = get_list_thumbnail($board['bo_table'], $list[$i]['wr_id'], $board['bo_gallery_width'], $board['bo_gallery_height']);
		
		//본문내용 텍스트만 가져오기
		$str_content = cut_str(strip_tags($list[$i]['wr_1']),150);

		$list[$i]['href'] = './board.php?bo_table='.$bo_table.'&wr_id='.$list[$i]['wr_id'];
		if ($qstr != "") $list[$i]['href'] .= $qstr;
	?>
	<li>
		<?php if ($is_checkbox) { ?>
		<p class="td_chk">
			<label for="chk_wr_id_<?php echo $i ?>" class="sound_only"><?php echo $list[$i]['subject'] ?></label>
			<input type="checkbox" name="chk_wr_id[]" value="<?php echo $list[$i]['wr_id'] ?>" id="chk_wr_id_<?php echo $i ?>" data-i="<?php echo $i ?>">
			<?php if ($is_checkbox) { ?>
			<div style="position:absolute;right:10px;">우선순위 <input type="text" name="wr_orderby[]" id="wr_orderby_<?php echo $i ?>" value="<? if ((int)$list[$i]['wr_orderby'] > 0) echo $list[$i]['wr_orderby']; ?>" class="frm_input" size="10" data-i="<?php echo $i ?>"></div>
			<?php } ?>
		</p>
		<?php } ?>
		<p>
			<a href="<?php echo $list[$i]['href'] ?>">
				<?php if($thumb['src']){ ?>
				<div class="img_area">
				<img src="<?php echo $thumb['src']?>" alt="<?php echo $thumb['alt']?>" width="<?php echo $board['bo_gallery_width']?>" height="<?php echo $board['bo_gallery_height']?>" /></div>
				<?php } else {?>
				<div class="img_area">
				<img src="<?php echo $board_skin_url ?>/img/noimg.gif" alt="noimage"/></div>
				<?php }?>
			</a>
			<div class="txt_area">
			<ul>
				<li class="zine_tit"><a href="<?php echo $list[$i]['href'] ?>"><?php echo $list[$i]['wr_subject']?></a></li>
				<li class="zine_tel"><?php echo $list[$i]['wr_content']?> <a href="tel:<?php echo $list[$i]['wr_content']?>"><i class="fas fa-phone-alt"></i>전화걸기</a></li>
				<li class="zine_con"><?php echo $str_content?></li>
			</ul>
			</div>
		</p>
	</li>
	<?php
	}

	if (count($list) == 0) { echo '<div class="empty_table">게시물이 없습니다.</div>'; } 
	?>
	</ul>
	</div>

    <?php if ($is_checkbox && $write_href) { ?>
    <div class="bo_fx">
        <ul class="btn_bo_user">
            <?php if ($write_href) { ?><li><a href="<?php echo $write_href ?>" class="btn_b02">등록하기</a></li><?php } ?>
        </ul>

		<ul class="btn_bo_adm">
            <?php if ($list_href) { ?>
            <li><a href="<?php echo $list_href ?>" class="btn_b01"> 목록</a></li>
            <?php } ?>

            <?php if ($is_checkbox) { ?>
            <li><input type="submit" name="btn_submit" value="선택삭제" onclick="document.pressed=this.value"></li>
			<li><input type="submit" name="btn_submit" value="선택수정" onclick="document.pressed=this.value"></li>
            <!--<li><input type="submit" name="btn_submit" value="선택복사" onclick="document.pressed=this.value"></li>
            <li><input type="submit" name="btn_submit" value="선택이동" onclick="document.pressed=this.value"></li>-->
            <?php } ?>
        </ul>
    </div>
    <?php } ?>
    </form>

	<!-- 페이지 -->
	<?php 
	if (defined('G5_IS_ADMIN')) {
		$paging_params = get_paging_params($qstr);
		echo get_paging($board['bo_page_rows'], $page, $total_page, '?bo_table='.$bo_table.$paging_params);
	} else {
		echo $write_pages;  
	}
	?>
</div>

<?php if ($is_checkbox) { ?>
<script>
$(function() {
	var map_si = document.fsearch.map_si.value;

	switch (map_si) {
	case "서울" :
		$("#map").attr('src', '../../theme/basic/mobile/skin/board/map/img/su/su_bg.gif');
		applyMap("su", 'map_country', 1); // click 연결
		$("#btn_map_back").show();
		break;

	case "인천" :
		$("#map").attr('src', '../../theme/basic/mobile/skin/board/map/img/ic/ic_bg.gif');
		applyMap("ic", 'map_country', 1); // click 연결
		$("#btn_map_back").show();
		break;
	
	case "경기" :
		$("#map").attr('src', '../../theme/basic/mobile/skin/board/map/img/kg/kg_bg.gif');
		applyMap("kg", 'map_country', 1); // click 연결
		$("#btn_map_back").show();
		break;
	}
	$("#map").show();

	// 우선순위 입력
	$("input[name='wr_orderby[]']").on("keyup", function() {
		var i = $(this).data("i");
		var chk = $("#chk_wr_id_" + i);
		chk.prop("checked", true);

	}).keydown(function() {
		// 엔터키 버블링 막기
		if (event.keyCode === 13) {
			event.preventDefault();
		};
	});
});

// 구 선택
function seltdGu(el, si) {
	var gu = $(el).attr("alt");
	var si2 = "";
	switch (si) {
	case "su" : si2 = "서울"; break;
	case "ic" : si2 = "인천"; break;
	case "kg" : si2 = "경기"; break;
	default : return false;
	}
	location.href = "./board.php?bo_table=" + g5_bo_table + "&map_si="+ si2 +"&map_gu=" + gu;
}

/*
// 리스트 ajax 호출
function getAjaxList(page, si, gu) {
	if (typeof page == "undefined") {
		page = 1;
	}
	if (si == "su") si = '서울';

	var url = "./board_ajax.php?bo_table=" + g5_bo_table + "&page=" + page;
	if (typeof si != "undefined") url += "&map_si=" + si;
	if (typeof gu != "undefined") url += "&map_gu=" + gu;
	console.log(url);

	$.ajax({  
		type : "get",  
		url : url,
		//data : {"page" : page},
		dataType : "html",  
		success : function(html) {
			$("#bo_list").html(html);
		},  
		error : function(xhr,status,error) {
			console.log(error);
		}
	});
}
*/

function all_checked(sw) {
    var f = document.fboardlist;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_wr_id[]")
            f.elements[i].checked = sw;
    }
}

function fboardlist_submit(f) {
    var chk_count = 0;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_wr_id[]" && f.elements[i].checked)
            chk_count++;
    }

    if (!chk_count) {
        alert(document.pressed + "할 게시물을 하나 이상 선택하세요.");
        return false;
    }
	
	/*
    if(document.pressed == "선택복사") {
        select_copy("copy");
        return;
    }

    if(document.pressed == "선택이동") {
        select_copy("move");
        return;
    }
	*/

	if(document.pressed == "선택수정") {
		if (!confirm("우선순위를 수정하시겠습니까?"))
            return false;

		var idx = [];
		var order = [];

		$.each($('input[name="chk_wr_id[]"]:checked'), function(index, item) {
			var wr_id = $(item).val();
			var i = $(item).data('i');
			var wr_orderby = $("#wr_orderby_" + i).val();

			idx.push(wr_id);
			order.push(wr_orderby);
		});

		var idx_str = idx.join(",");
		var order_str = order.join(",");
		var obj = {'bo_table' : g5_bo_table, 'idx_str' : idx_str, "order_str" : order_str};

		$.ajax({  
			type : "post",  
			url : "../ajax.map_update.php",
			data : obj,
			dataType : "json",  
			success : function(json) {  
				if (json.result == 'T') {
					location.reload();
				} else {
					alert('우선순위 변경에 실패하였습니다. 다시 시도해 주세요.');
				}
			},  
			error : function(xhr,status,error) {
				alert('우선순위 변경에 실패하였습니다. 다시 시도해 주세요.');
				//console.log(error);
			}
		});

        return false;
    }

    if(document.pressed == "선택삭제") {
        if (!confirm("선택한 게시물을 정말 삭제하시겠습니까?\n한번 삭제한 자료는 복구할 수 없습니다."))
            return false;

        f.removeAttribute("target");
        f.action = "./board_list_update.php";
    }

    return true;
}

/*
// 선택한 게시물 복사 및 이동
function select_copy(sw) {
    var f = document.fboardlist;

    if (sw == "copy")
        str = "복사";
    else
        str = "이동";

    var sub_win = window.open("", "move", "left=50, top=50, width=500, height=550, scrollbars=1");

    f.sw.value = sw;
    f.target = "move";
    f.action = "./move.php";
    f.submit();
}
*/
</script>
<?php } ?>
<!-- } 게시판 목록 끝 -->
