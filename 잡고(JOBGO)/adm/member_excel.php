<?php

include_once("./_common.php");
$filename = "[".$config['cf_title']."]회원관리_".date('Ymd',strtotime(G5_TIME_YMD));

header( "Content-type: application/vnd.ms-excel" );
header( "Content-type: application/vnd.ms-excel; charset=utf-8");
header( "Content-Disposition: attachment; filename = ".$filename.".xls" );
header( "Content-Description: PHP4 Generated Data" );

$sfl = $_REQUEST['sfl'];
$stx = $_REQUEST['stx'];
$lv = $_REQUEST['lv'];

$sql_search = " where 1=1 and mb_id!='lets080' ";

if ($lv != "")
    $sql_search .= " and mb_join_division = '{$lv}' ";


if ($stx) {
    $sql_search .= " and ( ";
    switch ($sfl) {
        default :
            $sql_search .= " ({$sfl} like '%{$stx}%') ";
            break;
    }
    $sql_search .= " ) ";
}

$sql =  "select * from g5_member {$sql_search} order by mb_datetime desc ";
$result = sql_query($sql);

// 테이블 상단 만들기
$EXCEL_STR = "
<table border='1'>
<tr>
   <td>번호</td>
   <td>회원구분</td>
   <td>이메일</td>
   <td>닉네임</td>
   <td>이름</td>
   <td>휴대폰</td>
   <td>생년월일</td>
   <td>승인여부</td>
   <td>가입일</td>
   <td>최종접속</td>
</tr>";
$no = 1;
while($row = sql_fetch_array($result)) {

    if ($row['mb_4'] == 'Y'){
        $mb_1 =  '승인';
    }elseif ($row['mb_4'] != 'Y' && $row["mb_join_division"] == '2'){
        $mb_1 = "승인안됨";
    }else{
        $mb_1 = "";
    }

    if ($row['mb_join_division'] == '1'){
        $mb_level =  '일반';
    }else if ($row['mb_join_division'] == '2'){
        $mb_level =  '전문가';
    }


    $EXCEL_STR .= "
   <tr>
       <td>".$no."</td>
       <td>".$mb_level."</td>
       <td>".$row['mb_id']."</td>
       <td>".$row['mb_nick']."</td>
       <td>".$row['mb_name']."</td>
       <td>".hyphen_hp_number($row['mb_hp'])."</td>
       <td>".$row['mb_birthday']."</td>
       <td>".$mb_1."</td>
       <td>".substr($row['mb_datetime'],2,8)."</td>
       <td>".substr($row['mb_today_login'],2,8)."</td>
   </tr>
   ";
    $no ++;
}

$EXCEL_STR .= "</table>";

echo "<meta content=\"application/vnd.ms-excel; charset=UTF-8\" name=\"Content-type\"> ";
echo $EXCEL_STR;
?>

