<?php
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>
<script>
$(function() {
	$(".ft_fix_area").hide();
});
</script>

<div class="c_area">
      <h3><img src="<?php echo G5_THEME_IMG_URL; ?>/mobile/channel_t.png" alt="신중하게 찾아주는 당신의인연"></h3>
      <p style="word-break: keep-all;">
		아래 링크를 클릭, 카카오채널 친구추가 후 채팅에 재가입요청 (ex:재가입/홍길동/26/서울)을 해주시면 관리자 출근 후 재가입을 도와드리겠습니다. 감사합니다♥
		<br>(중복소개방지 및 정보보호를 위해 재가입은 관리자가 도와드리고 있습니다.)
	  </p>
      <div class="t_margin20"><a class="btn_counsel" href="<?=$config['cf_kakao_pf']?>">1:1 상담신청 하기</a></div>
</div>