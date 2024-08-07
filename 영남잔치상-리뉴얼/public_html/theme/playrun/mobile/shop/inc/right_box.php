		<!--20230313-->
        <!--<div class="box ver01">
			<p class="tit">주문 및 문의전화 안내</p>
			<div class="tel_box2">
				<p><b>051</b>.528.1405</p>
				<p><b>051</b>.528.1408</p>
				<p class="f">0504.051.4517</p>
			</div>
			<p class="time">AM.10:00 ~ PM.19:00</p>
		</div>//box_01 -->
        
		<!--<div class="box ver02">
			<p class="tit">영남잔치상<span>BLOG</span></p>
			<p class="txt">구매후기 & 포트폴리오<br>데일리 이벤트를 확인하세요</p>
			<a href="https://blog.naver.com/youngnam784" title='영남잔치상 블로그 바로가기' target="_blank"><img src="<?php echo G5_THEME_IMG_URL ?>/right_blog.png" alt=""></a>
		</div>//box_02 -->
        
		<!--<div class="box ver03">
			<a href="<?php echo G5_BBS_URL ?>/content.php?co_id=comp2" title='음식의 특징'>
				<div class="tit">영남잔치상</div>
				<div class="txt">음식의 특징</div>
				<img src="<?php echo G5_THEME_IMG_URL ?>/right_fd_info.png" alt="">
			</a>
		</div>//box_03 -->
        
		<!--<div class="box ver04">
			<ul>
				<li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=jesa_info" class="ico1">제사관련정보</a></li>
				<li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=gosa_info" class="ico2">고사관련정보</a></li>
				<li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=date_ch" class="ico3">음력/양력 변환기</a></li>
				<li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=jibang" class="ico4">지방쓰기</a></li>
				<li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=pb_info" class="ico5">폐백관련정보</a></li>
				<li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=ibaz" class="ico6">이바지관련정보</a></li>
			</ul>
		</div>//ver04 -->
        
		<!--<div class="box ver05">
			<p class="tit">무통장 입금계좌 안내</p>
			<p class="nm">예금주 : 정재영 (영남잔치상)</p>
			<img src="<?php echo G5_THEME_IMG_URL ?>/common/ico_bank1.jpg" alt="">
			<p>927-02-654184</p>
			<img src="<?php echo G5_THEME_IMG_URL ?>/common/ico_bank2.jpg" alt="">
			<p>073-12-127946-9</p>
		</div>//ver05 -->
        
		<!--<div class="box ver06">
			<img src="<?php echo G5_THEME_IMG_URL ?>/common/right_bh_info.jpg" alt="">
			<p><b class="grn2">1억원</b> 음식물 배상책임보험 가입</p>
		</div>//ver06 -->
        
        
        <div id="r_banner">
			<?php if(defined('_INDEX_')) {?>
            <?php } else {  ?>
            <div>
                <img src="<?php echo G5_THEME_IMG_URL ?>/r_banner/01.png" alt="">
            </div>
                <? } ?>
            <div><a href="https://blog.naver.com/youngnam784" title='영남잔치상 블로그 바로가기' target="_blank"><img src="<?php echo G5_THEME_IMG_URL ?>/r_banner/02.png" alt=""></a></div>
            <div><a href="<?php echo G5_BBS_URL ?>/write.php?bo_table=qa"><img src="<?php echo G5_THEME_IMG_URL ?>/r_banner/03.png" alt=""></a></div>
            <div><img src="<?php echo G5_THEME_IMG_URL ?>/r_banner/04.png" alt=""></div>
            <div><img src="<?php echo G5_THEME_IMG_URL ?>/r_banner/05.png" alt=""></div>
            <div><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=comp2" title='음식의 특징'><img src="<?php echo G5_THEME_IMG_URL ?>/r_banner/06.png" alt=""></a></div>
        </div>
        
		<div class="box ver04">
			<ul>
				<li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=jesa_info" class="ico1">제사관련정보</a></li>
				<li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=gosa_info" class="ico2">고사관련정보</a></li>
				<li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=date_ch" class="ico3">음력/양력 변환기</a></li>
				<li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=jibang" class="ico4">지방쓰기</a></li>
				<li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=pb_info" class="ico5">폐백관련정보</a></li>
				<li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=ibaz" class="ico6">이바지관련정보</a></li>
			</ul>
		</div>
        
		<div class="box ver07">
			<p class="tit">최근 본 상품</p>
			
			
			<ul>
				<?php include(G5_SHOP_SKIN_PATH.'/boxtodayview.skin.php'); // 오늘 본 상품 ?>
				<!-- <li>
					<a href="#">
						<div class="img">
							<img src="<?php echo G5_THEME_IMG_URL ?>/common/test01.jpg" alt="">
						</div>
						<div class="txt">
							<p class="tit">영남 알뜰 핵가족상</p>
							<p class="pr">66,000 원</p>
						</div>
					</a>
				</li>
				<li>
					<a href="#">
						<div class="img">
							<img src="<?php echo G5_THEME_IMG_URL ?>/common/test01.jpg" alt="">
						</div>
						<div class="txt">
							<p class="tit">영남 알뜰 핵가족상</p>
							<p class="pr">66,000 원</p>
						</div>
					</a>
				</li>
				<li>
					<a href="#">
						<div class="img">
							<img src="<?php echo G5_THEME_IMG_URL ?>/common/test01.jpg" alt="">
						</div>
						<div class="txt">
							<p class="tit">영남 알뜰 핵가족상</p>
							<p class="pr">66,000 원</p>
						</div>
					</a>
				</li> -->
			</ul>
		</div>
		<!-- /ver07 -->
