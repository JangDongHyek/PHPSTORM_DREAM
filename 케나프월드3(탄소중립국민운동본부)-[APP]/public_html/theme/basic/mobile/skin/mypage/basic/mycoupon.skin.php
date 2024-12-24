<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

add_stylesheet('<link rel="stylesheet" href="'.$mypage_skin_url.'/style.css">', 0);
?>
<div class="coup_cotainer" id="coup_cotainer">
	<div class="tbl_wrap02 tbl_head02">
		<div class="coup_title">
		<img src="<?php echo G5_THEME_IMG_URL;?>/mobile/coup_title.png">
		</div>
		<div class="coup_info">
		<img src="<?php echo G5_THEME_IMG_URL;?>/mobile/coup_info.png"> 
		</div>
		<table>
			<tr>
				<?php 
				for($i=0; $i<15; $i++){ 
					if($i != 0 && $i%3 == 0) echo "</tr><tr>";
				?>
				<td class="text-center" style="width:15%; height:51px;">
					<?php if($i < $member['mb_1']){ ?>
					<img src="<?php echo G5_THEME_IMG_URL;?>/stamp.png" alt="" style="width:80px; height:80px;">
					<?php }else{ ?>
					<img src="<?php echo G5_THEME_IMG_URL;?>/coup_<?php echo $i+1;?>.png" alt="" style="width:80px; height:80px;">
					<?php } ?>
				</td>
				<?php } ?>
			</tr>
		</table>
		<div class="coup_phone">
			<img src="<?php echo G5_THEME_IMG_URL;?>/coup_phone.png">
		</div>	
	</div>
</div>

<script>
	$(document).ready(function (){
	$("#coup_cotainer").css("min-height", $(window).height() - 80);
     });	
</script>


