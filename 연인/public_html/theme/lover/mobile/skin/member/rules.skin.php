<?php
// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>


    <div class="c_area">
        <h3><img src="<?php echo G5_THEME_IMG_URL; ?>/mobile/channel_t.png" alt="신중하게 찾아주는 당신의인연"></h3>
        <p>아래 신청하기를 누르시면<br />연인 대표 카카오채널 창으로 연결됩니다.<br />"인연에서 연인으로"</p>
        <div class="t_margin20"><a class="btn_counsel" href="<?=$config['cf_kakao_pf']?>">1:1 상담신청 하기</a></div>
    </div>




