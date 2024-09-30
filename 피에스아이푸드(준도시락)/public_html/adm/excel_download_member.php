<?php
include_once("./_common.php");
/**
 * 회원관리 엑셀다운로드
 */

header( "Content-type: application/vnd.ms-excel; charset=utf-8");
header( "Content-Disposition: attachment; filename = ".$cate."회원관리.xls" );     //filename = 저장되는 파일명을 설정합니다.
header( "Content-Description: PHP4 Generated Data" );

$sql_common = " from g5_member ";
$sql_search = " where 1=1 and mb_level = 2 ";
$sql_order = " order by mb_datetime desc ";

if($stx) {
    $sql_search .= " and {$sfl} like '%{$stx}%' ";
}

$sql = " select * {$sql_common} {$sql_search} {$sql_order} ";
$result = sql_query($sql);

$_excel = "
<table border='1'>
<tr>
    <td>No.</td>
    <td>아이디</td>
    <td>업체명&현장명</td>
    <td>휴대번호</td>
    <td>주문배송지</td>
    <td>명세서수신이메일</td>
    <td>결제방법</td>
    <td>SNS가입</td>
    <td>가입일</td>
</tr>
";

$no = 1;
while ($row = sql_fetch_array($result)) {
    $sns = '';
    if($row['sns'] == 'naver') {
        $sns = '네이버';
    } else if($row['sns'] == 'kakao') {
        $sns = '카카오';
    }

    // 주문배송지
    $addr = empty($row['mb_zip1']) ? "" : "[".$row['mb_zip1']."] ".$row['mb_addr1'];

    $_excel .= "
    <tr>
       <td>".$no."</td>
       <td>".$row['mb_id']."</td>
       <td>".$row['mb_name']."</td>
       <td>".$row['mb_hp']."</td>
       <td>".$addr."</td>
       <td>".$row['send_email']."</td>
       <td>".$row['payment']."</td>
       <td>".$sns."</td>
       <td>". substr($row['mb_datetime'],0,10)."</td>
    </tr>
    ";

    $no++;
}
$_excel .= "</table>";

echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>";
echo $_excel;
?>
