<?php
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
//add_stylesheet('<link rel="stylesheet" href="'.G5_MSHOP_SKIN_URL.'/style.css">', 0);
?>


<div id="widthdrawal">
	<div class="in">
		<?php if ($is_member) { ?>
		<?php } else { ?>
		<?php } ?>
		
		<div class="top_info">
			<span class="ic_tal"><i class="fas fa-comment-exclamation"></i></span>
			<h2>회원 탈퇴가 완료되었습니다.</h2>
		</div>
	</div>
</div>