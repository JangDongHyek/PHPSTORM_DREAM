<?php

include_once('./_common.php');

if (!($w == '' || $w == 'u')) {
    alert('w 값이 제대로 넘어오지 않았습니다.');
}


$mb_id = trim($_POST['mb_id']);

if(!$mb_id)
    alert('회원아이디 값이 없습니다. 올바른 방법으로 이용해 주십시오.');


//추가된 컬럼
$mb_name          = isset($_POST['mb_name'])            ? trim(clean_xss_tags($_POST['mb_name']))          : "";
$agent_name          = isset($_POST['agent_name'])            ? trim(clean_xss_tags($_POST['agent_name']))          : "";
$agent_relation          = isset($_POST['agent_relation'])            ? trim(clean_xss_tags($_POST['agent_relation']))          : "";
$mb_birth          = isset($_POST['mb_birth'])            ? trim(clean_xss_tags($_POST['mb_birth']))          : "";
$mb_tel          = isset($_POST['mb_tel'])            ? trim(clean_xss_tags($_POST['mb_tel']))          : "";
$mb_grade         = isset($_POST['mb_grade'])            ? trim(clean_xss_tags($_POST['mb_grade']))          : "";
$money_total          = isset($_POST['money_total'])            ? trim(clean_xss_tags($_POST['money_total']))          : "";
$money_contract          = isset($_POST['money_contract'])            ? trim(clean_xss_tags($_POST['money_contract']))          : "";
$money_balance          = isset($_POST['money_balance'])            ? trim(clean_xss_tags($_POST['money_balance']))          : "";
$money_gratuity          = isset($_POST['money_gratuity'])            ? trim(clean_xss_tags($_POST['money_gratuity']))          : "";
$money_gratuity_kr          = isset($_POST['money_gratuity_kr'])            ? trim(clean_xss_tags($_POST['money_gratuity_kr']))          : "";
$service_count          = isset($_POST['service_count'])            ? trim(clean_xss_tags($_POST['service_count']))          : "";
$service_month          = isset($_POST['service_month'])            ? trim(clean_xss_tags($_POST['service_month']))          : "";
$service_start_date          = isset($_POST['service_start_date'])            ? trim(clean_xss_tags($_POST['service_start_date']))          : "";
$service_end_date          = isset($_POST['service_end_date'])            ? trim(clean_xss_tags($_POST['service_end_date']))          : "";
$contract_datetime          = isset($_POST['contract_datetime'])            ? trim(clean_xss_tags($_POST['contract_datetime']))          : "";
$contract_manager       = isset($_POST['contract_manager'])            ? trim(clean_xss_tags($_POST['contract_manager']))          : "";
$contract_sign          = isset($_POST['contract_sign'])            ? $_POST['contract_sign']          : "";
$contract_sign_2          = isset($_POST['contract_sign_2'])            ? $_POST['contract_sign_2']          : "";
$contract_sign_3          = isset($_POST['contract_sign_3'])            ? $_POST['contract_sign_3']          : "";

$prepaidAmount1       = isset($_POST['prepaidAmount1'])            ? trim(clean_xss_tags($_POST['prepaidAmount1']))          : "";
$postpaidAmount1       = isset($_POST['postpaidAmount1'])            ? trim(clean_xss_tags($_POST['postpaidAmount1']))          : "";
$basicMatchingCount       = isset($_POST['basicMatchingCount'])            ? trim(clean_xss_tags($_POST['basicMatchingCount']))          : "";
$suggestedMatchingCount       = isset($_POST['suggestedMatchingCount'])            ? trim(clean_xss_tags($_POST['suggestedMatchingCount']))          : "";
$perMatchFeeMatchingCount       = isset($_POST['perMatchFeeMatchingCount'])            ? trim(clean_xss_tags($_POST['perMatchFeeMatchingCount']))          : "";
$matchingPrice1       = isset($_POST['matchingPrice1'])            ? trim(clean_xss_tags($_POST['matchingPrice1']))          : "";
$matchingPrice2       = isset($_POST['matchingPrice2'])            ? trim(clean_xss_tags($_POST['matchingPrice2']))          : "";
$matchingPrice3       = isset($_POST['matchingPrice3'])            ? trim(clean_xss_tags($_POST['matchingPrice3']))          : "";
$contrack_text       = isset($_POST['contrack_text'])            ? trim(clean_xss_tags($_POST['contrack_text']))          : "";


//숫자 이외엔 제거
$money_total        = preg_replace('/[^0-9]/', '', $money_total);
$money_contract        = preg_replace('/[^0-9]/', '', $money_contract);
$money_balance        = preg_replace('/[^0-9]/', '', $money_balance);
$money_gratuity        = preg_replace('/[^0-9]/', '', $money_gratuity);


$prepaidAmount1        = preg_replace('/[^0-9]/', '', $prepaidAmount1);
$postpaidAmount1        = preg_replace('/[^0-9]/', '', $postpaidAmount1);
$basicMatchingCount        = preg_replace('/[^0-9]/', '', $basicMatchingCount);
$suggestedMatchingCount        = preg_replace('/[^0-9]/', '', $suggestedMatchingCount);
$perMatchFeeMatchingCount        = preg_replace('/[^0-9]/', '', $perMatchFeeMatchingCount);
$matchingPrice1        = preg_replace('/[^0-9]/', '', $matchingPrice1);
$matchingPrice2        = preg_replace('/[^0-9]/', '', $matchingPrice2);
$matchingPrice3        = preg_replace('/[^0-9]/', '', $matchingPrice3);

$sql_add = '';
if ($mb_name){ $sql_add .= " , mb_name = '".$mb_name."' "; }
if ($agent_name){ $sql_add .= " , agent_name = '".$agent_name."' "; }
if ($agent_relation){ $sql_add .= " , agent_relation = '".$agent_relation."' "; }
if ($mb_birth){ $sql_add .= " , mb_birth = '".$mb_birth."' "; }
if ($mb_tel){ $sql_add .= " , mb_tel = '".$mb_tel."' "; }
if ($mb_grade){ $sql_add .= " , mb_grade = '".$mb_grade."' "; }
if ($money_total){ $sql_add .= " , money_total = '".$money_total."' "; }
if ($money_contract){ $sql_add .= " , money_contract = '".$money_contract."' "; }
if ($money_balance){ $sql_add .= " , money_balance = '".$money_balance."' "; }
if ($money_gratuity){ $sql_add .= " , money_gratuity = '".$money_gratuity."' "; }
if ($money_gratuity_kr){ $sql_add .= " , money_gratuity_kr = '".$money_gratuity_kr."' "; }
if ($service_count){ $sql_add .= " , service_count = '".$service_count."' "; }
if ($service_month){ $sql_add .= " , service_month = '".$service_month."' "; }
if ($service_start_date){ $sql_add .= " , service_start_date = '".$service_start_date."' "; }
if ($service_end_date){ $sql_add .= " , service_end_date = '".$service_end_date."' "; }
if ($contract_datetime){ $sql_add .= " , contract_datetime = '".$contract_datetime."' "; }
if ($contract_manager){ $sql_add .= " , contract_manager = '".$contract_manager."' "; }
if ($contract_sign){ $sql_add .= " , contract_sign = '".$contract_sign."' "; }
if ($contract_sign_2){ $sql_add .= " , contract_sign_2 = '".$contract_sign_2."' "; }
if ($contract_sign_3){ $sql_add .= " , contract_sign_3 = '".$contract_sign_3."' "; }

if (1){ $sql_add .= " , prepaidAmount1 = '".$prepaidAmount1."' "; }
if (1){ $sql_add .= " , postpaidAmount1 = '".$postpaidAmount1."' "; }
if (1){ $sql_add .= " , basicMatchingCount = '".$basicMatchingCount."' "; }
if (1){ $sql_add .= " , suggestedMatchingCount = '".$suggestedMatchingCount."' "; }
if (1){ $sql_add .= " , perMatchFeeMatchingCount = '".$perMatchFeeMatchingCount."' "; }
if (1){ $sql_add .= " , matchingPrice1 = '".$matchingPrice1."' "; }
if (1){ $sql_add .= " , matchingPrice2 = '".$matchingPrice2."' "; }
if (1){ $sql_add .= " , matchingPrice3 = '".$matchingPrice3."' "; }
if ($contrack_text){ $sql_add .= " , contrack_text = '".$contrack_text."' "; }



if ($w == '') {

    $sql = " insert into g5_member_contract
                set mb_id = '{$mb_id}'
                     {$sql_add}
           ";

    sql_query($sql);

} else if ($w == 'u') {
    if (!trim($_SESSION['ss_mb_id']))
        alert('로그인 되어 있지 않습니다.');

    if (!$is_admin) {
        if (trim($_POST['mb_id']) != $mb_id)
            alert("로그인된 정보와 수정하려는 정보가 틀리므로 수정할 수 없습니다.\\n만약 올바르지 않은 방법을 사용하신다면 바로 중지하여 주십시오.");
    }

    if (!$is_admin){ $sql_add .= " , user_wr_datetime = '".G5_TIME_YMDHIS."' "; }

    $sql = " update g5_member_contract
                set wr_datetime = '".G5_TIME_YMD."'
                    {$sql_add}
              where mb_id = '$mb_id' ";
    sql_query($sql);
}


if ($w == '') {

    //echo '추가!!!!!!!!';
    //var_dump($sql);

    if($is_admin){
        alert('계약서 작성완료',G5_HTTP_BBS_URL.'/contract_form.php?w=u&pop=true&mb_id='.$mb_id);
    }else{
        alert('계약서 작성완료',G5_HTTP_BBS_URL.'/contract_form.php?w=u&mb_id='.$mb_id);
    }
} else if ($w == 'u') {

    if($is_admin){
        alert('계약서 수정이 완료되었습니다.',G5_HTTP_BBS_URL.'/contract_form.php?w=u&pop=true&mb_id='.$mb_id);
    }else{

        if($mb_name){
            //회원이 작성끝나면 알림톡 발송하게
            $kakao_arr = array("member_name"=> $mb_name);
            for($admin_i = 0; $admin_i<count($admin_tel); $admin_i++){
                sendAlimTalk(2,$kakao_arr,$admin_tel[$admin_i]);
            }
        }

        alert('계약서 수정이 완료되었습니다.',G5_HTTP_BBS_URL.'/contract_form.php?w=u&mb_id='.$mb_id);
    }
    //goto_url(G5_HTTP_BBS_URL.'/contract_form.php?w=u&mb_id='.$mb_id);
    //echo '수정!!!!!!!!';
    //var_dump($sql);

}