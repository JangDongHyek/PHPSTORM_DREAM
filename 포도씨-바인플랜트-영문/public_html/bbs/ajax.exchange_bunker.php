<?php
include_once("./_common.php");

/**
 마이페이지 - 벙커관리 - 환전벙커 입력 시 환전될 금액 계산 (ajax)
 환전계산 : 환전할 벙커 x 15 x 등급별 환전율 (70~90%)
 3등항해사 : 70% // 2등항해사 : 75% // 1등항해사 : 80% // 선장 : 85% (엑스퍼트 환전율 +5%)
 예) 2등항해사 (엑스퍼트)가 2만 벙커 환전시 = 20000 x 15 x 80% = 24만원 (환전금액)
**/

if($member['mb_grade'] == '3등항해사') {
    if($member['mb_1'] == 'expert') { $percent = 75; }
    else { $percent = 70; }
}
else if($member['mb_grade'] == '2등항해사') {
    if($member['mb_1'] == 'expert') { $percent = 80; }
    else { $percent = 75; }
}
else if($member['mb_grade'] == '1등항해사') {
    if($member['mb_1'] == 'expert') { $percent = 85; }
    else { $percent = 80; }
}
else if($member['mb_grade'] == '선장') {
    if($member['mb_1'] == 'expert') { $percent = 90; }
    else { $percent = 85; }
}

echo $exchange = floor(($bunker*$percent/100) * 15);