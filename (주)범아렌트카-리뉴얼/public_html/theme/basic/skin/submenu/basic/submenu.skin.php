<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
add_stylesheet('<link rel="stylesheet" href="'.G5_THEME_URL.'/skin/submenu/'.$skin_dir.'/style.css">', 0);
?>
<div class="topTitBox"  >
	<h2 ><?php echo $title['sm_name'] ?></h2>
	<ul class="snaviList" data-aos="flip-up" data-aos-delay="100" >
		 <?php for($i=0; $i<$sub=sql_fetch_array($result); $i++){ ?>
			<li><a href="<?php echo G5_URL.$sub['sm_link']?>" <?php if($sm_tid == $sub['sm_tid']){ echo "class='on'"; } ?>><?php echo $sub['sm_name'];?></a></li>
		<?php } ?>	
		<?php if ($sm_tid == "rent_new" || $sm_tid == "rent_old" || $sm_tid == "rent_pay" || $sm_tid=="rent_old_sch" || $sm_tid=="rent_acc"){ 
			if($sm_tid=="rent_new"){
				$param="&ca_name=신차 장기렌트";
			}else if($sm_tid=="rent_old" || $sm_tid=="rent_old_sch"){
				$param="&ca_name=무심사 중고차렌트";
			}else if($sm_tid=="rent_pay"){
				$param="&ca_name=단기대여 서비스";
			}
			
		?>
		<li><a href="<?php echo G5_BBS_URL ?>/write.php?bo_table=reserve<?=$param?>" <?php if($sm_tid == $sub['sm_tid']){ echo "class='on'"; } ?>>예약하기</a></li>
		<?php } ?>	
	</ul>
</div>
