<? 
/* 최고관리자 권한이 없으면 */
if($member['mb_id'] != 'admin'){    
    header("Location: ".G5_BBS_URL."/logout.php?type=admin");
    exit;
}

?>
<script src="<?=ADMIN_URL?>/assets/admin.js<?=LastFileVer?>"></script>
<link rel="stylesheet" href="<?=G5_THEME_CSS_URL ?>/admin.css<?=LastFileVer?>">

<div class="flex">
	<div id="admleft">
		<div class="logo">
			<p><img src="<?php echo G5_THEME_IMG_URL ?>/common/logo_w.svg" class="icon"></p>
		</div>
		
		<ul class="nav">
			<li class="<?=$subPid == 'index'? 'active' : ''?>"><a href="./">배차관리</a></li>
			<li class="<?=$subPid == 'driver'? 'active' : ''?>"><a href="./driver.php">기사관리</a></li>
			<li class="<?=$subPid == 'company'? 'active' : ''?>"><a href="./company.php">업체관리</a></li>
			<li><a href="<?=G5_URL?>/qna/list.php" target="_blank">접수문의</a></li>
<!--			<li><a href="./car.php">차량관리</a></li>-->
		</ul>
	</div>