<?php
function goto_url($url) {
    header("Location: " . $url);
    exit();
}

//인덱스 없음 -> 서비스 이용자관리 페이지로 바로가기
goto_url('./adm/member');
?>
