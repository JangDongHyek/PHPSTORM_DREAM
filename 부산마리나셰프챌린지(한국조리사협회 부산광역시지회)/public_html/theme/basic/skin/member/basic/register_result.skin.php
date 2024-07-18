<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>

<!-- 회원가입결과 시작 { -->
<div id="reg_result" class="mbskin">

    <p>
        <strong><?php echo get_text($mb['mb_name']); ?></strong>님의 회원가입을 진심으로 축하합니다.<br>
    </p>
    <p>
        <strong>사이트 관리자의 승인처리가 되고 정상적으로 접속이 가능합니다.</strong><br>
    </p>
    <p>
        회원 탈퇴는 언제든지 가능하며 일정기간이 지난 후, 회원님의 정보는 삭제하고 있습니다.<br>
        감사합니다.
    </p>

    <div class="btn_confirm">
        <a href="<?php echo G5_URL ?>/" class="btn02">메인으로</a>
    </div>

</div>
<!-- } 회원가입결과 끝 -->