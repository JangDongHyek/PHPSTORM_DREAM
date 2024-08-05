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
<script>
	AOS.init({
	   once: true
	})
</script>
	<? if(defined('_INDEX_')) {?>
		<div id="wrap" class="mainVer">
			<div id="skip_to_container"><a href="#container">본문 바로가기</a></div>
			<div class="headerWrap">
				<header class="whiteVer">  
					<? include_once("inc/header.php") ?>
				</header>
			</div>
	<? }else if ($bo_table){ ?>
		<div id="wrap" class="subVer">
			<div class="headerWrap ">
				<header>  
					<? include ("inc/header.php") ?>
				</header>
			</div>
			<!-- /headerWrap -->
			<div id="container">
				<div id="subTopBox">
				<?php 
						
					if(!$sm_tid)	$sm_tid = $co_id;
					if(!$sm_tid)	$sm_tid = $bo_table;
			
					if($sm_tid)		
					echo submenu($sm_tid, 'basic', G5_THEME_PATH); 
				?>

				</div>
				<!-- /subTopBox -->
				<div id="contWrap">

		<div class="autoW">


	<? }else{ ?>
		
		<div id="wrap" class="subVer">
			<div class="headerWrap ">
				<header>  
					<? include ("inc/header.php") ?>
				</header>
			</div>
			<!-- /headerWrap -->
			<div id="container">
				<div id="subTopBox">
				<?php 
						
					if(!$sm_tid)	$sm_tid = $co_id;
					if(!$sm_tid)	$sm_tid = $bo_table;
			
					if($sm_tid)		
					echo submenu($sm_tid, 'basic', G5_THEME_PATH); 
				?>

				</div>
				<!-- /subTopBox -->
				<div id="contWrap">

	<? }?>




