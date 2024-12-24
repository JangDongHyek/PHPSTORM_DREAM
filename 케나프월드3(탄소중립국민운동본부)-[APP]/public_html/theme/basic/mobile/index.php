<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

//안드로이드 앱이 아닐 경우
if(!strpos(".".$_SERVER['HTTP_USER_AGENT'],"Wecash")){
	if(!get_cookie("mobile_app") && !strpos($_SERVER['HTTP_USER_AGENT'], "Windows")){		
	//	goto_url(G5_URL."/install.php");
	}

	$is_intro = get_session("intro");

	if(!$is_intro && !$is_member)
		goto_url(G5_THEME_URL."/mobile/intro.php");

	if(!$is_member)
		goto_url(G5_THEME_URL."/mobile/intro.php");

}else{
	if(!$is_member){
		goto_url(G5_THEME_URL."/mobile/intro.php");
	}else{
//		goto_url(G5_URL."?mobile_app=1");
	}
}

include_once(G5_THEME_MOBILE_PATH.'/head.php');
include_once(G5_LIB_PATH.'/thumbnail.lib.php');
?>

<!--이미지 롤링-->
<?php /*?><div id="rolling_mtab" class="swiper-container" style="height:auto;">
	<div class="swiper-wrapper">
		<?php 
		$result = sql_query("select * from g5_write_banner order by wr_orderby desc");
		while($row = sql_fetch_array($result)){ 
			
		?>
		<div class="swiper-slide">
		
			<?php if($row['wr_link1']){ ?>
			<a href="<?php echo $row['wr_link1'];?>">
			<?php } ?>
			<?php
			 $thumb = get_list_thumbnail("banner", $row['wr_id'], 600, 250);

			if($thumb['src']) {
				$img_content = '<img src="'.$thumb['src'].'" alt="'.$thumb['alt'].'" style="width:100%;height:auto;">';
			}

			echo $img_content;
			?>
			<?php if($row['wr_link1']) echo "</a>"; ?>
		</div>

		<?php } ?>
	</div>
	<!-- Add Pagination -->
	<div class="swiper-pagination"></div>
</div><?php */?>


<!--이미지 롤링-->
<div id="rolling_mtab" class="swiper-container" style="height:auto;">
	<div class="swiper-wrapper">
		<div class="swiper-slide">
			 <a href="<?php echo G5_BBS_URL ?>/lotto.game.php">
			 
<!--			 <button id="copybtn" onclick="copyToClipboard('http://www.케나프.한국');" title="주소 복사">링크복사</button>-->
			 
			 <img src="<?php echo G5_THEME_IMG_URL ?>/app/main_event01.jpg" style="width:100%;height:auto;"></a>
		</div>
		<div class="swiper-slide">
			 <a href="<?php echo G5_BBS_URL ?>/roulette.game.php"><img src="<?php echo G5_THEME_IMG_URL ?>/app/main_event02.jpg" style="width:100%;height:auto;"></a>
		</div>
		<div class="swiper-slide">
			 <img src="<?php echo G5_THEME_IMG_URL ?>/app2/main_bn01.jpg" style="width:100%;height:auto;">
		</div>
		<div class="swiper-slide">
			 <img src="<?php echo G5_THEME_IMG_URL ?>/app2/main_bn02.jpg" style="width:100%;height:auto;">
		</div>
		<div class="swiper-slide">
			 <img src="<?php echo G5_THEME_IMG_URL ?>/app2/main_bn03.jpg" style="width:100%;height:auto;">
		</div>
		<div class="swiper-slide">
			 <img src="<?php echo G5_THEME_IMG_URL ?>/app2/main_bn04.jpg" style="width:100%;height:auto;">
		</div>
		<div class="swiper-slide">
			 <img src="<?php echo G5_THEME_IMG_URL ?>/app2/main_bn05.jpg" style="width:100%;height:auto;">
		</div>
		<div class="swiper-slide">
			 <img src="<?php echo G5_THEME_IMG_URL ?>/app2/main_bn06.jpg" style="width:100%;height:auto;">
		</div>
		<div class="swiper-slide">
			 <img src="<?php echo G5_THEME_IMG_URL ?>/app2/main_bn07.jpg" style="width:100%;height:auto;">
		</div>
		<div class="swiper-slide">
			 <img src="<?php echo G5_THEME_IMG_URL ?>/app2/main_bn08.jpg" style="width:100%;height:auto;">
		</div>
        <div class="swiper-slide">
            <img src="<?php echo G5_THEME_IMG_URL ?>/app2/main_bn09.jpg" style="width:100%;height:auto;">
        </div>
        <div class="swiper-slide">
            <img src="<?php echo G5_THEME_IMG_URL ?>/app2/main_bn10.jpg" style="width:100%;height:auto;">
        </div>
<!--
        <div class="swiper-slide" style="height: auto">
            <img src="<?php echo G5_THEME_IMG_URL ?>/app/mbanner11.jpg"  style="width:100%;height:100%; object-fit: cover"/>
        </div>
-->
		<!--<div class="swiper-slide">
			 <img src="<?php /*echo G5_THEME_IMG_URL */?>/app/main_bn05.jpg" style="width:100%;height:auto;">
		</div>
		<div class="swiper-slide">
			 <img src="<?php /*echo G5_THEME_IMG_URL */?>/app/main_bn06.jpg" style="width:100%;height:auto;">
		</div>
		<div class="swiper-slide">
			 <img src="<?php /*echo G5_THEME_IMG_URL */?>/app/main_bn07.jpg" style="width:100%;height:auto;">
		</div>
		<div class="swiper-slide">
			 <img src="<?php /*echo G5_THEME_IMG_URL */?>/app/main_bn08.jpg" style="width:100%;height:auto;">
		</div>-->
	</div>
	<!-- Add Pagination -->
	<div class="swiper-pagination"></div>
</div>
<!--
<ul class="commu_wrap">
    <li>
        <a href="https://cafe.naver.com/czerokenaf" target="_blank">
           <div class="ic"><img src="<?php echo G5_THEME_IMG_URL ?>/common/ic_cafe.png" alt="카페"></div>
            <p>카페</p>
        </a>
    </li>
    <li>
        <a onclick='ready_modal()'>
           <div class="ic"><img src="<?php echo G5_THEME_IMG_URL ?>/common/ic_blog.png" alt="블로그"></div>
            <p>블로그</p>
        </a>
    </li>
    <li>
        <a onclick='ready_modal()'>
           <div class="ic"><img src="<?php echo G5_THEME_IMG_URL ?>/common/ic_news.png" alt="뉴스"></div>
            <p>뉴스</p>
        </a>
    </li>
</ul>
-->
<div class="member-point">
	<div>
		<span style="color:#fba638;font-weight:bold;margin-right:4px;">SP</span><?php echo number_format($member['mb_point'])?>P
	</div>
	<div>
		<span style="color:#2b8fd5;font-weight:bold;margin-right:4px;">LP</span><?php echo number_format($member['mb_point_l'])?>P
	</div>
	<div>
			<?php		  
				$sql="select sum(point) as point from g5_movie_view_point where mb_id='$member[mb_id]'";
				$mRow=sql_fetch($sql);
			?>
			<span style="color:#2b8fd5;font-weight:bold;margin-right:4px;">MP</span><?php echo number_format($mRow['point'])?>P
	</div>		
		
</div>

<!-- 로또 당첨자 확인 -->
<ul class="winner">
	<li>
	<h2><span><strong>로또 <?=$prevTurn?>회차</strong> 당첨자</span></h2>
      <!-- Swiper -->
      <div id="updown">
      <div class="swiper-container">
        <div class="swiper-wrapper">
        <?
            $sql="select * from g5_lotto where turn='$prevTurn' and rank < 7 order by rank asc limit 0,10";
            $result=sql_query($sql);
            while($row=sql_fetch_array($result)){
                $sql="select * from g5_member where mb_id='$row[mb_id]'";
                $row2=sql_fetch($sql);
                $mb_name=str_replace(mb_substr($row2[mb_name],1,1),"*",$row2[mb_name]);
        ?>
          <div class="swiper-slide"><?=$mb_name?> / <strong><?=$row[rank]?></strong>등</div>
        <? }?>
      </div>
      </div>
      </div>
    </li>
    <li>
	<h2><span><strong>룰렛이벤트</strong> 당첨자</span></h2>
      <!-- Swiper -->
      <div id="updown">
      <div class="swiper-container">
        <div class="swiper-wrapper">
			<?
				$firstDate=strtotime(date("Y-m-d 00:00:00")." -1 day");
				$lastDate=strtotime(date("Y-m-d 23:59:59"));
				$sql="select * from g5_roulette where 0 < ro_rank and ro_rank < 6 and regdate between $firstDate and $lastDate group by ro_no  order by regdate desc limit 0,100";
				$result=sql_query($sql);
				while($row=sql_fetch_array($result)){

					$sql="select * from g5_member where mb_id='$row[mb_id]'";
					$row2=sql_fetch($sql);
					$mb_name=str_replace(mb_substr($row2[mb_name],1,1),"*",$row2[mb_name]);

					$sql="select roulette{$row[ro_rank]}point as rank_point from g5_roulette_config";
					$row3=sql_fetch($sql);
			?>
			<div class="swiper-slide"><?=$mb_name?> / <strong><?=$row[ro_rank]?></strong>등 / <?=$row3[rank_point]?>P</div>
			<? }?>
      </div>
      </div>
      </div>
    </li>
</ul>

<!-- Initialize Swiper -->
<script>
var swiper = new Swiper('#updown .swiper-container', {
  direction: 'vertical',
  slidesPerView: 3,
  spaceBetween: 0,
  centeredSlides: true,
  loop : true,
  loopedSlides: 6,
  loopFillGroupWithBlank: true,
  autoplay: 5000,
  pagination: {
    el: '.swiper-pagination',
    clickable: true,
  },
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },
});
</script>
<!-- 로또 당첨자 확인 -->

<div id="mbanner">
    <!--케나프소개 -->
<!--
    <div class="sec sec01">
        <h3>지상 최고의 미래환경식물 케나프</h3>
        <p>케나프 모종 나누기 캠페인</p>
    </div>
    <div class="sec sec02">
        <img src="<?php echo G5_THEME_IMG_URL ?>/app2/main_sec02.jpg" alt="" />
        <img src="<?php echo G5_THEME_IMG_URL ?>/app2/main_sec03.jpg" alt="" />
        <img src="<?php echo G5_THEME_IMG_URL ?>/app2/main_sec05.jpg" alt="" />
        <img src="<?php echo G5_THEME_IMG_URL ?>/app2/main_sec04.jpg" alt="" />
    </div>
-->
    <div class="sec">
        <img src="<?php echo G5_THEME_IMG_URL ?>/app2/main_sec01_01.JPG" alt="" />
    </div>
    <div class="sec">
        <img src="<?php echo G5_THEME_IMG_URL ?>/app2/main_sec02_01.JPG" alt="" />
    </div>
    <div class="sec sec03">
        <h3>공기정화 식물<br>‘<span class="color-blue">탄소중립실천 케나프</span>’의 가치</h3>
        <dl>
            <dt>탄소중립 NET ZERO 운동</dt>
            <dd>
                기후위기 시대, “2050년 탄소중립 목표 기후동맹”에 가입하는 등 각국은 지금 배출한 이산화탄소 (온실가스)를 흡수하기 위해서 배출한 이산화탄소의 양만큼 나무를 심거나, 친환경 대책을 세움으로써 이산화탄소 총량을 중립 상태로 만들기 위해 다양한 아이디어가 필요한 시점에 도달했다.<br>
                이러한 상황에서 특이할 만 한 <span class="color-red">대안재로써 친환경 작물인“케나프(KENAF)”가 세계적으로 관심의 대상이 되는 것이다.</span>
            </dd>
        </dl>
        <dl>
            <dt>케나프의 특성</dt>
            <dd>
                케나프(KENAF)는 기후위기대응과 경제적, 공익적 가치를 증진 시키는 식물로서 어떤 기후와 토양에 대한 적응력이 뛰어나고 별도의 비료나 농약을 사용하지 않아도 물로만 재배가 가능한 식물 자원으로서, 성장 속도가 빠르고 
                <span class="color-red">이산화 탄소 분해능력이 여타 식물보다 5~10배 높을 뿐 아니라 미세먼지 발생을 억제시키는 능력 또한 가지고 있다.</span><br>
                아울러, 케나프(KENAF)재배 지역의 토질 정화 능력이 좋고 수중의 질소나 인산을 흡수하여  물을 정화 시키는 능력도 뛰어나며 생태적 복원 사업이 필요한 지역에 심으면 소위 땅심이 살아나는 식물로도 알려 져 있다.  뿐만 아니라, 가축사료로도 활용이 가능하며, 케나프 줄기를 태운 재는 질소, 인산, 칼리 등 비료의 3대 요소를 풍부히 함유하고 있어 다른 식물 재배에 친환경 비료로도 사용이 가능하다.
            </dd>
            <img src="<?php echo G5_THEME_IMG_URL ?>/app2/main_sec06.jpg" alt="" />
        </dl>
        <dl>
            <dt>친환경식물</dt>
            <dd>
                케나프는 땅, 공기, 물, 사람을 모두 살리는 유엔이 지정한 공기 정화 식물이고 가장 좋은 반려식물이다. 케나프는 철을 제외한 모든 것을 만들 수 있는 신이 선택한 인류 최고의 식물이다. 케나프는 <span class="color-red">화력 발전소를 대체하고, 태양광을 대체할 수 있는 가장 친환경 식물이다.</span><br>
                케나프는 식용에까지 활용되고 있어 그 활용가치는 무한하다. 케나프의 건조된 잎에는 30%의 천연 단백질을 함유하고 있으며 같은 무게의 우유와 비교하면 칼슘 4배, 철분과 각종 비타민을 포함하고 있다. 최근에는 케나프 분말을 이용한 건강식품도 등장했다. 케나프는 잎과 줄기까지도 사용할 수 있어 그 효능과 기능이 더욱 확대 되고 있다.
            </dd>
        </dl>
        <dl>
            <dt>케나프의 생분해성</dt>
            <dd>
                케나프는 최근 대두되고 있는 플라스틱으로 인한 환경오염의 대체 원료로 주목받고 있다. <br>
                이에 ㈜농업법인 친환경세상은 케나프의 생분해성 기능을 보다 확충하여 <span class="color-red">세계최초로 생분해 1회용기 개발에 성공하여 양산</span>을 앞두고 있다. 
                케나프1회용기는 미생물 분해성이 있어 음식물 쓰레기와 같이 버려도 음식과 같이 썩고, 심지어 퇴비 및 야생동물 먹이로 이용해도 무리가 없다.
            </dd>
        </dl>
        <a href="http://ecofriendlyworld.co.kr/index.php" target="_blank">
             <h6>케나프모종 나눔  후원기업</h6>
             <p>농업회사법인 ㈜친환경세상</p>
             
             <button class="btn-homepage"></button>
        </a>
    </div>
<!--
    <div class="sec sec04">
        <img src="<?php echo G5_THEME_IMG_URL ?>/app2/main_sec05.jpg" alt="" />
        <img src="<?php echo G5_THEME_IMG_URL ?>/app2/main_sec08.jpg" alt="" />
        <img src="<?php echo G5_THEME_IMG_URL ?>/app2/main_sec07.jpg" alt="" />
        <h6>도시의 매연을 빨아들이는 케나프 잎</h6>
    </div>
-->
    <div class="sec">
        <img src="<?php echo G5_THEME_IMG_URL ?>/app2/main_sec04_01.JPG" alt="" />
    </div>
    <div class="sec sec05">
        <h3>
            세계 환경의 날(매년 6월 5일) 기념<br>
            <span class="color-red">탄소킬러</span> <span class="color-green">케나프 모종</span> 
            <span class="color-blue">축제</span> C^-ZERO
        </h3>
<!--
        <div class="img_wrap">
        <img src="<?php echo G5_THEME_IMG_URL ?>/app2/main_sec09.jpg" alt="" />
        <img src="<?php echo G5_THEME_IMG_URL ?>/app2/main_sec10.jpg" alt="" />
        <img src="<?php echo G5_THEME_IMG_URL ?>/app2/main_sec11.jpg" alt="" />
        <img src="<?php echo G5_THEME_IMG_URL ?>/app2/main_sec12.jpg" alt="" />
        <img src="<?php echo G5_THEME_IMG_URL ?>/app2/main_sec13.jpg" alt="" />
        </div>
-->
       <img src="<?php echo G5_THEME_IMG_URL ?>/app2/frame.png" alt="" />
        
        
        <dl>
            <dt class="color-blue">모종키우기 Contest</dt>
            <dd>
                친환경세상㈜은 세계 환경의 날을 맞아 케나프 모종을 무료로 나누어 드리고 있습니다.
                받으신 모종을 잘 기르는것 만으로도 탄소중립을 실천하는 것입니다.<br>
                <br>
                케나프  키우시는 과정은 함께 공유해요~!!<br>
                <br>
                사진을 올려 주신 분들중 일부 선정하여 장학금을 드립니다.<br>
                <strong class="color-red">잘</strong> 길러서 <strong class="color-red">컨테스트</strong>에 출품하여 <strong class="color-red">장학금</strong> 받기에 도전하세요!!
            </dd>
        </dl>
        <a href="https://cafe.naver.com/czerokenaf" target="_blank">바로가기</a>
    </div>
    <div class="sec sec06"><img src="<?php echo G5_THEME_IMG_URL ?>/app2/main_sec14.jpg" alt="" /></div>
    <div class="sec sec07">
        <img src="<?php echo G5_THEME_IMG_URL ?>/app2/main_sec15.jpg" alt="" />
        <div class="text_wrap">
            <p>
        농업회사법인 ㈜친환경세상은 2023년 세계 스카우트잼버리(World Scout Jamboree)가 열렸던 새만금 행사장에서 케나프 시험재배에 성공을 거뒀습니다.<br>
        <br>
        간척지인 새만금 지역의 특성상 토양내 염분으로 인해 다른 식물들은 고사해 버리는 악조건 속에서도 케나프는 무성하게 잘 자라 그 가능성을 인정 받았습니다.<br>
        새만금은 케나프 특구로 거듭 날것입니다. <br>
        탄소중립~ 케나프가 답입니다.<br>
        새만금 케나프 특구 지정 범국민 청원서에 서명 해 주세요^^
        </p>
        <a href="<?php echo G5_BBS_URL ?>/chungwon_form.php" target="_blank">청원서 쓰고<br>포인트 받기</a>
        </div>
    </div>
    <div class="sec sec08"><img src="<?php echo G5_THEME_IMG_URL ?>/app2/main_sec16.jpg" alt="" /></div>
    
<!--240527 응모권내용 삭제
    <img src="<?php echo G5_THEME_IMG_URL ?>/app/mbanner10.jpg" alt="" />
    <img src="<?php echo G5_THEME_IMG_URL ?>/app/mbanner11.jpg" alt="" />
-->

    <?php /*?><a href="<?php echo G5_THEME_URL ?>/down/파사만.pptx" download="<?php echo G5_THEME_URL ?>/down/파사만.pptx" target="_blank">
    <img src="<?php echo G5_THEME_IMG_URL ?>/app/mbanner05.jpg" alt="" /><!--파사만 --></a>
	<a href="<?php echo G5_THEME_URL ?>/down/명품.pptx" download="<?php echo G5_THEME_URL ?>/down/명품.pptx" target="_blank">
    <img src="<?php echo G5_THEME_IMG_URL ?>/app/mbanner07.jpg" alt="" /><!--명품샵 프랜차이즈 --></a>
	<a href="<?php echo G5_THEME_URL ?>/down/뷰티힐링.pptx" download="<?php echo G5_THEME_URL ?>/down/뷰티힐링.pptx" target="_blank">
    <img src="<?php echo G5_THEME_IMG_URL ?>/app/mbanner06.jpg" alt="" /><!--뷰티&힐링프랜차이즈 --></a>
	<a href="" download="<?php echo G5_THEME_URL ?>/down/" target="_blank"><img src="<?php echo G5_THEME_IMG_URL ?>/app/mbanner01.jpg" alt="" /></a>
	<a href="" download="<?php echo G5_THEME_URL ?>/down/" target="_blank"><img src="<?php echo G5_THEME_IMG_URL ?>/app/mbanner03.jpg" alt="" /></a>
	<a href="" download="<?php echo G5_THEME_URL ?>/down/" target="_blank"><img src="<?php echo G5_THEME_IMG_URL ?>/app/mbanner04.jpg" alt="" /></a><?php */?>
</div><!--#mbanner-->

<!--<div id="mall_latest">

	<ul>
    	<li>
        	<img src="<?php echo G5_THEME_IMG_URL ?>/app/mall_list01.jpg">
            <p>한일전기 올크리니 모노륨매트 전기장판</p>
            <strong>97,000P</strong>
        </li>
    	<li>
        	<img src="<?php echo G5_THEME_IMG_URL ?>/app/mall_list02.jpg">
            <p>피플스 대형 찜질매트 M65120-D8</p>
            <strong>52,520P</strong>
        </li>
    	<li>
        	<img src="<?php echo G5_THEME_IMG_URL ?>/app/mall_list03.jpg">
            <p>소조 바른 자세 밴드 SZ-S01</p>
            <strong>36,500P</strong>
        </li>
    	<li>
        	<img src="<?php echo G5_THEME_IMG_URL ?>/app/mall_list04.jpg">
            <p>[3+1 특가] 메디테라피 더마릴렉스 힐링패치 수액 시트 발 바닥 파스</p>
            <strong>59,400P</strong>
        </li>
    	<li>
        	<img src="<?php echo G5_THEME_IMG_URL ?>/app/mall_list05.jpg">
            <p>무선 안마기 목 어깨 마사지기 마사지/진동모드</p>
            <strong>68,000P</strong>
        </li>
    	<li>
        	<img src="<?php echo G5_THEME_IMG_URL ?>/app/mall_list06.jpg">
            <p>발각질제거기 뒤꿈치 굳은살 발바닥 풋케어</p>
            <strong>7,000P</strong>
        </li>
    </ul>


</div>-->


<script>

$(document).ready(function (){
	
	var swiper = new Swiper('#rolling_mtab', {
		pagination: '.swiper-pagination',
		nextButton: '.swiper-button-next',
		prevButton: '.swiper-button-prev',
		speed: 800,
		spaceBetween: 0,
		autoplay: 4000,
		autuHeight: true,
		lazy: true,
		loop:true
	});	      
		
});
	if(<?=$is_member?>){
		window.Android.login('<?=$member['mb_id']?>');
	}
</script>
<?php
include_once(G5_THEME_MOBILE_PATH.'/tail.php');
?>
