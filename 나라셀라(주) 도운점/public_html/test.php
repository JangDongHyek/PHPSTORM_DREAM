<?
//phpinfo();
include_once('./_common.php');
//
//
//$mb_hp = "01042529806";
//$send_phone = '025431529';
//$msg = "[naracelllar] 테스트 문자메세지입니다.";
//$result = goMMS($mb_hp, $send_phone, $msg);
$a = getClassInfo(58);

//var_dump($a);

$today = date("Y-m-d");
$event_date = date("Y-m-d", strtotime($a['eventDate']));
echo $today."<br>";
echo $event_date."<br>";

// 날짜 차이 계산
$diff = (strtotime($event_date) - strtotime($today)) / (60 * 60 * 24); // 날짜 차이 일 단위로 계산
echo "Difference: " . $diff . " days<br>";

// 7일 이내인지 확인
if (abs($diff) <= 7) { // 차이가 7일 이하일 때 (음수 양수 모두 고려)
    echo "해당 날짜는 7일 이내입니다.";
} else {
    echo "해당 날짜는 7일 이내가 아닙니다.";
}
?>