<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

$is_intro = get_session("intro");

if(!$is_intro && !$is_member)
	goto_url(G5_THEME_URL."/mobile/intro.php");

if(!$is_member)
	goto_url(G5_BBS_URL."/login.php");

include_once(G5_THEME_MOBILE_PATH.'/head.php');
include_once(G5_LIB_PATH.'/thumbnail.lib.php');
?>
<style>
body{background:#EE2D24;}
</style>
<div id="m_wrap" class="container">	

    <div id="main_ad">
		<?php 
		$result = sql_query(" select * from g5_write_business where wr_is_comment = 0 and mb_id = '{$member['mb_id']}' order by wr_datetime desc limit 0, 1"); 
		for($i=0; $i<$row=sql_fetch_array($result); $i++){
			$bus_url = "";
			if($row){
				$bus_url = G5_BBS_URL."/board.php?bo_table=business&wr_id=".$row['wr_id'];
				 $thumb = get_list_thumbnail("business", $row['wr_id'], 200, 150);
				if($thumb['src']) $img_url = $thumb['src'];
			}else{
				$bus_url = G5_BBS_URL."/board.php?bo_table=business";
				$img_url = G5_THEME_IMG_URL."/no_image.png";
			}
			?>
			<a href="<?php echo $bus_url;?>" class="row">
				<div class="col-xs-5 img">
					<img src="<?php echo $img_url;?>" alt=""/>
				</div>
				<div class="col-xs-7 txt">
					<?php echo $row['wr_content'];?>
				</div>
			</a>
		<?php 
		} 
		if($i==0){
		?>
		<a href="<?php echo G5_BBS_URL;?>/mybusiness.php?bo_table=business" class="row">
			정보등록을 해주세요.
		</a>
		<?php } ?>
        <ul class="btn-set">
        	<li><a href=""><i class="fas fa-h-square"></i> 홈페이지</a></li>
        	<li><a href=""><i class="fab fa-blogger"></i> 블로그</a></li>
		</ul>
    </div>
	<?/*
	<!--탑배너시작-->
	<div class="topban">
        <div class="row">
            <a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=coupon">
                <h2>쿠폰행사<!--<img src="http://www.dreamforone.com/~ddcheon/theme/basic/img/mobile/b_title01.png"> --></h2>
            </a>
        	<ul>
				<?php 
                $result = sql_query(" select * from g5_write_coupon where wr_is_comment = 0 order by wr_main desc, wr_datetime desc limit 0, 3"); 
                for($i=0; $i<$row=sql_fetch_array($result); $i++){
					$cou_url = "";
					if($row){
						$cou_url = G5_BBS_URL."/board.php?bo_table=coupon&wr_id=".$row['wr_id'];
						 $thumb = get_list_thumbnail("coupon", $row['wr_id'], 250, 250);
						if($thumb['src']) $img_url = $thumb['src'];
					}else{
						$cou_url = G5_BBS_URL."/board.php?bo_table=coupon";
						$img_url = G5_THEME_IMG_URL."/no_image.png";
					}
					?>
            	<li class="col-xs-4">
				   <div class="tban s1">
						<div class="txt">
							<a href="<?php echo $cou_url;?>">
								<div class="board_bg1" style="background: #0F1637 url(<?php echo $img_url;?>) no-repeat 100% 50%/cover;"></div>
								<p><?php echo $row['wr_subject'];?></p>
							</a>
						</div>
					</div>
                </li>
				<?php } ?>
            </ul>
        </div>
        <div class="row">
            <a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=sale">
                <h2>할인행사<!--<img src="http://www.dreamforone.com/~ddcheon/theme/basic/img/mobile/b_title02.png"> --></h2>
            </a>
        	<ul>
				<?php 
				$result = sql_query(" select * from g5_write_sale where wr_is_comment = 0 order by wr_main desc, wr_datetime desc limit 0, 3"); 
				for($i=0; $i<$row=sql_fetch_array($result); $i++){
					$sal_url = "";
					if($row){
						$sal_url = G5_BBS_URL."/board.php?bo_table=sale&wr_id=".$row['wr_id'];
						 $thumb = get_list_thumbnail("sale", $row['wr_id'], 250, 250);
						if($thumb['src']) $img_url = $thumb['src'];
					}else{
						$img_url = G5_BBS_URL."/board.php?bo_table=sale";
						$img_url = G5_THEME_IMG_URL."/no_image.png";
					}
				?>
            	<li class="col-xs-4">
				   <div class="tban s1">
						<div class="txt">
							<a href="<?php echo $sal_url;?>">
								<div class="board_bg1" style="background: #0F1637 url(<?php echo $img_url;?>) no-repeat 100% 50%/cover;"></div>
								<p><?php echo $row['wr_subject'];?></p>
							</a>
						</div>
					</div>
                </li>
				<?php } ?>
            </ul>
        </div>
        <div class="row">
            <a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=plus">
                <h2>덤+ 행사<!--<img src="http://www.dreamforone.com/~ddcheon/theme/basic/img/mobile/b_title03.png"> --></h2>
            </a>
        	<ul>
				<?php 
				$result = sql_query(" select * from g5_write_plus where wr_is_comment = 0 order by wr_main desc, wr_datetime desc limit 0, 3"); 
				for($i=0; $i<$row=sql_fetch_array($result); $i++){
					$plu_url = "";
					if($row){
						$plu_url = G5_BBS_URL."/board.php?bo_table=plus&wr_id=".$row['wr_id'];
						 $thumb = get_list_thumbnail("plus", $row['wr_id'], 250, 250);
						if($thumb['src']) $img_url = $thumb['src'];
					}else{
						$plu_url = G5_BBS_URL."/board.php?bo_table=plus";
						$img_url = G5_THEME_IMG_URL."/no_image.png";
					}
				?>
            	<li class="col-xs-4">
				   <div class="tban s1">
						<div class="txt">
							<a href="<?php echo $plu_url;?>">
								<div class="board_bg1" style="background: #0F1637 url(<?php echo $img_url;?>) no-repeat 100% 50%/cover;"></div>
								<p><?php echo $row['wr_subject'];?></p>
							</a>
						</div>
					</div>
                </li>
				<?php } ?>
            </ul>
        </div>
    </div><!--.topban.row-->
	*/?>
    <!--탑배너끝-->
</div><!--m_wrap-->

<!--메인탭-->
<div id="ca_tabs" style="background:#EE2D24;">
	<div id="swiper-jtabs" class="swiper-container">
		<dl class="swiper-wrapper">
			<?php 
			$result = sql_query("select ca_code, ca_name from g5_category where char_length(ca_code) = '2' order by ca_order asc");
			while($row = sql_fetch_array($result)){
				$ca[] = $row;
			}

			for($i=0; $i<count($ca); $i++){
				if($i == 0) 
					$onff = "on";
				else
					$onff = "";
			?>
			<dd class="swiper-slide <?php echo $onff;?>"><?php echo $ca[$i]['ca_name'];?></dd>
			<?php } ?>
		</dl>
	</div>
	
	<div id="swiper-tab" class="swiper-container">
		<dl class="swiper-wrapper">
			<?php for($i=0; $i<count($ca); $i++){ ?>
			<dd class="swiper-slide">
				<ul class="row">
					<?php 
					$sql = "select * from g5_write_business where wr_is_comment = 0 and ca_name = '{$ca[$i]['ca_name']}' order by wr_datetime desc limit 0, 12";
					$result = sql_query($sql);

					for($j=0; $j<$row=sql_fetch_array($result); $j++){ 
					
						$thumb = get_list_thumbnail("business", $row['wr_id'], 600, 350);

						if($thumb['src']) 
							$img_content = '<img src="'.$thumb['src'].'" alt="'.$thumb['alt'].'" style="width:100%;height:auto;">';
						else
							$img_content = "";
					?>
					<li class="col-xs-4">
						<p class="p-img">
							<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=business&wr_id=<?php echo $row['wr_id'];?>">
								<?php echo $img_content;?>
								<span><?php echo $row['wr_subject'];?></span>
							</a>
						</p>
					</li>
					<?php } ?>
					<?php if($j == 0){ ?>
					<li class="col-xs-12 slide_empty">
						등록된 <?php echo $ca[$i]['ca_name'];?>가 없습니다.
					</li>
					<?php } ?>
				</ul>
			</dd>
			<?php } ?>
		</dl>
	</div>
    <!--이미지 롤링-->
    <div id="rolling_mtab" class="swiper-container" style="height:auto;">
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
    </div>
    <!--이미지 롤링-->
    <div class="latest-bbs">
        <?php echo latest('theme/basic', 'notice', 5, 25);?>
    </div>
</div> 
<!--메인탭-->
 
<div class="idx-slg-text">
<h3>줄광고</h3>
할인이벤트! 매출돌파구 찾아~~<br>
우리동네 맛집이 여기에~~<br>
멋쟁이는 이곳에~~ 헤어디자인<br>
요리의 삼대천왕맛의 진수~~<br>
주말가족여행 낭만의 해운대에서~~
</div>
  
<!-- Swiper JS -->
<script>
$(document).ready(function (){
	var swiper = new Swiper('#rolling_mtab', {
		pagination: '.swiper-pagination',
		nextButton: '.swiper-button-next',
		prevButton: '.swiper-button-prev',
		speed: 500,
		spaceBetween: 0,
		autoplay: 1000,
		autuHeight: true,
		lazy: true,
		loop:true
	});	      

	var swiperTab = new Swiper('#swiper-jtabs', {
		slidesPerView: 5,
		autoHeight: "auto",
		lazy:true
	});	      

	var swiperContent = new Swiper('#swiper-tab', {
		autoHeight: "auto",
		lazy:true
	});

	swiperContent.on('transitionStart', function (e) {
		var idx = parseInt(e.activeIndex);
		var i = idx - 1;
		tabsOn(swiperTab, idx, i, 300);
	});

	$("#swiper-jtabs dd").click(function (){
		var idx = parseInt($("#swiper-jtabs dd").index(this));
		var i = idx;
		tabsOn(swiperContent, idx, i, 300);
	});
	
	// Tabs move
	function tabsOn(tab, idx, i, speed){
		var tm = 0;
		$("#swiper-jtabs dd").removeClass("on");
		$("#swiper-jtabs dd").eq(idx).addClass("on");
		
		tab.slideTo(i, speed);
	}
});
</script>
<!--//이미지 롤링-->	

 

<?php
include_once(G5_THEME_MOBILE_PATH.'/tail.php');
?>