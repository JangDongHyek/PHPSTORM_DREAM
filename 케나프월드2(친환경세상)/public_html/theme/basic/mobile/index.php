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
			 
			 <button id="copybtn" onclick="copyToClipboard('http://www.케나프.한국');" title="주소 복사">링크복사</button>
			 
			 <img src="<?php echo G5_THEME_IMG_URL ?>/app/main_event01.jpg" style="width:100%;height:auto;"></a>
		</div>
		<div class="swiper-slide">
			 <a href="<?php echo G5_BBS_URL ?>/roulette.game.php"><img src="<?php echo G5_THEME_IMG_URL ?>/app/main_event02.jpg" style="width:100%;height:auto;"></a>
		</div>
		<div class="swiper-slide">
			 <img src="<?php echo G5_THEME_IMG_URL ?>/app/main_bn01.jpg" style="width:100%;height:auto;">
		</div>
		<div class="swiper-slide">
			 <img src="<?php echo G5_THEME_IMG_URL ?>/app/main_bn02.jpg" style="width:100%;height:auto;">
		</div>
		<div class="swiper-slide">
			 <img src="<?php echo G5_THEME_IMG_URL ?>/app/main_bn03.jpg" style="width:100%;height:auto;">
		</div>
		<div class="swiper-slide">
			 <img src="<?php echo G5_THEME_IMG_URL ?>/app/main_bn04.jpg" style="width:100%;height:auto;">
		</div>
        <div class="swiper-slide">
            <img src="<?php echo G5_THEME_IMG_URL ?>/app/main_bn09.jpg" style="width:100%;height:auto;">
        </div>
        <div class="swiper-slide">
            <img src="<?php echo G5_THEME_IMG_URL ?>/app/main_bn10.jpg" style="width:100%;height:auto;">
        </div>
        <div class="swiper-slide">
            <img src="<?php echo G5_THEME_IMG_URL ?>/app/main_bn11.jpg" style="width:100%;height:auto;">
        </div>
        <div class="swiper-slide" style="height: auto">
            <img src="<?php echo G5_THEME_IMG_URL ?>/app/mbanner11.jpg"  style="width:100%;height:100%; object-fit: cover"/>
        </div>
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
<div class="member-point">
	<div>
		<span style="color:#fba638;font-weight:bold;margin-right:4px;">응모권 주식</span><?php echo number_format($member['mb_point'])?>P
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
	<a href="<?php echo G5_THEME_URL ?>/down/케나프소개.pptx" download="<?php echo G5_THEME_URL ?>/down/케나프소개.pptx" target="_blank">
    <img src="<?php echo G5_THEME_IMG_URL ?>/app/mbanner02.jpg" alt="" /><!--케나프소개 --></a>
    <img src="<?php echo G5_THEME_IMG_URL ?>/app/mbanner08.jpg" alt="" />
    <img src="<?php echo G5_THEME_IMG_URL ?>/app/mbanner09.jpg" alt="" />
    <img src="<?php echo G5_THEME_IMG_URL ?>/app/mbanner10.jpg" alt="" />
    <img src="<?php echo G5_THEME_IMG_URL ?>/app/mbanner11.jpg" alt="" />

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
