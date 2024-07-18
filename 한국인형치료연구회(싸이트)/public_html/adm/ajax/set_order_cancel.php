<?
include_once('../../common.php');
$print = array();

if(!$is_member){
    $print['code'] = "-1";
    $print['msg'] = "잘못된 접근입니다.";
    die(json_encode($print));
}

if($member['mb_level'] < 10){
    $print['code'] = "-2";
    $print['m'] = $member;
    $print['msg'] = "잘못된 접근입니다.";
    die(json_encode($print));
}

$idx = sql_real_escape_string(get_text(trim($_POST['idx'])));

$sql = "select * from `g5_order_list` where `idx` = '$idx'";
$row = sql_fetch($sql);

if(empty($row)){
    $print['code'] = "-3";
    $print['msg'] = "잘못된 접근입니다.";
    die(json_encode($print));
}

$objData = array(
    "mid" => $row['MID'],
    "tid" => $row['TID'],
    "svcCd" => "01",
    "cancelAmt" => $row['sum_cost'],
    "cancelMsg" => "취소",
    "cancelPwd" => $CANCEL_PASSWORD
);
$jsonData = json_encode($objData);

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.innopay.co.kr/api/cancelApi",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => $jsonData,
    CURLOPT_HTTPHEADER => array(
        "Content-Type: application/json; charset=utf-8"
    ),
));

$response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);

if(!$err){
    $sql = "update `g5_order_list` set `state` = '4' where `idx` = '$idx'";
    sql_query($sql);
}

$print['code'] = "200";
$print['msg'] = "정상적으로 취소 되었습니다,";
die(json_encode($print));

?>