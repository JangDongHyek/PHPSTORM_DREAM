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


<div id="Warp" class="<? if(defined('_INDEX_')) { ?>mainVer<?} else if($bo_table){?>bderVer<?} else {?>subVer<?}?>">
	<div class="headerWrap">
		<header class="w1200">
			<h1 data-aos="fade-right"><a href="<?php echo G5_URL ?>/" title="범아렌터카에 오신것을 환영합니다">
				<? if(defined('_INDEX_')) { ?>
				<img src="<?php echo G5_THEME_IMG_URL ?>/common/new_logo.png" alt="범어렌트카" id="mainLogo">
				<?} else {?>
				<img src="<?php echo G5_THEME_IMG_URL ?>/common/new_logo_b.png" alt="범어렌트카" id="subLogo">
				<?}?>
			</a></h1>
			<div class="ulWrap">
				<ul  data-aos="fade-left">
					<li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=rent_new">신차장기 렌트서비스</a></li>
					<li><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=rent_old">무심사 중고차렌트</a></li>
					<li><a href="<?php echo G5_BBS_URL ?>/rent_pay.php">단기대여 서비스</a></li>
					<li><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=customer">고객센터</a></li>
					<li>
						<?php if(!$is_admin){?>
						<a href="<?php echo G5_BBS_URL?>/reserve_search.php">예약확인</a>
						<?php }else{?>
						<a href="<?php echo G5_BBS_URL?>/board.php?bo_table=reserve">예약목록</a>
						<?php }?>
					</li>
					<li class="admBtn">
						<?php if(!$is_admin){?>
						<!-- <a href="<?php echo G5_BBS_URL?>/login.php" class="admB">관리자</a> -->
						<?php }else{?>
						<a href="<?php echo G5_BBS_URL?>/logout.php" class="admB st2">로그아웃</a>
						<?php }?>
					</li>

				</ul>
			</div>
		</header>
	</div>


<? if(defined('_INDEX_')) { ?>
<?} else {?>

	<div id="subWrap">
		<div class="subVisual bg_<? if($bo_table){ ?><? echo $bo_table ?><?} else {?><? echo $co_id ?><? } ?>">
			<div class="w1200">
				<?php 
						
					if(!$sm_tid)	$sm_tid = $co_id;
					if(!$sm_tid)	$sm_tid = $bo_table;
			
					if($sm_tid)		
					echo submenu($sm_tid, 'basic', G5_THEME_PATH); 
				?>
					
				<!-- <div class="topBtnbox">
					<a href="<?php echo G5_BBS_URL ?>/content.php?co_id=rent_new" class="br6 <? if ($co_id == 'rent_new' ) { ?>on<? } ?>" >신차 <br>장기 렌트</a>
					<a href="<?php echo G5_BBS_URL ?>/content.php?co_id=rent_old" class="br6 <? if ($co_id == 'rent_old'  ||  $bo_table == 'rent_old_sch') { ?>on<? } ?>">무심사 <br>중고차 렌트</a>
					<a href="<?php echo G5_BBS_URL ?>/rent_pay.php" class="br6 <? if ($co_id == 'rent_pay' || $co_id == 'rent_acc') { ?>on<? } ?>">단기대여 <br>서비스</a>
				</div> -->
				

			</div>
		</div>
		<!-- /subVisual -->

			<? if($bo_table){ ?>
				<div class="w1200 bdVer">
			
			<? } ?>

	
		<?}?>