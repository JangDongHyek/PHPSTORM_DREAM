<?
include_once ("../common.php");

$type = trim($_POST['type']);
$mb_name = trim($_POST['mb_name']);
$use_date = trim($_POST['use_date']);
$mb_hp = trim($_POST['mb_hp']);
$use_name = trim($_POST['use_name']);
$mb_company = trim($_POST['mb_company']);

//$userNm = trim($_POST['userNm']);
//$authkey = trim($_POST['authkey']);
$userKey = trim($_POST['userKey']);
//$ezMilUse = trim($_POST['ezMilUse']);
//$isReserveUse = trim($_POST['isReserveUse']);
//$cspCd = trim($_POST['cspCd']);
//$clientCd = trim($_POST['clientCd']);

$is_agree = isset($_POST['is_agree']) ? trim($_POST['is_agree']) : '';

if($type == "현대이지웰" && !$userKey) {
    die(json_encode(array("code"=>"-1","msg"=>"복지몰에서 들어와주세요.")));
}


if(empty($mb_name)){
    die(json_encode(array("code"=>"-1","msg"=>"신청자 이름을 확인해주세요.")));
}
if(empty($use_date)){
    die(json_encode(array("code"=>"-1","msg"=>"이용날짜를 확인해주세요.")));
}
if(empty($mb_hp)){
    die(json_encode(array("code"=>"-1","msg"=>"연락처를 확인해주세요.")));
}
if(empty($use_name)){
    die(json_encode(array("code"=>"-1","msg"=>"이용자 이름을 확인해주세요.")));
}
if(empty($mb_company)){
    die(json_encode(array("code"=>"-1","msg"=>"고객사를 확인해주세요.")));
}

$sql = "insert into `v5_sangjo_sub` set `type` = '$type',`mb_name` = '$mb_name', `mb_hp` = '$mb_hp', `use_name` = '$use_name', `use_date` = '$use_date', `mb_company` = '$mb_company', `userKey` = '$userKey'";
sql_query($sql);

die(json_encode(array("code"=>"200","msg"=>"신청이 완료되었습니다.")));
?>