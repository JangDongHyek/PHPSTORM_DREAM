<?php

include_once("./_common.php");
$filename = "".$config['cf_title']."_서비스관리_".date('Ymd',strtotime(G5_TIME_YMD));

header( "Content-type: application/vnd.ms-excel" );
header( "Content-type: application/vnd.ms-excel; charset=utf-8");
header( "Content-Disposition: attachment; filename = ".$filename.".xls" );
header( "Content-Description: PHP4 Generated Data" );

$user_type = $_REQUEST["user_type"];
$old = $_REQUEST["old"];
if(!empty($user_type)) {
    if($user_type == 'basic') {
        $sql_common .= " and mb_level = 2 ";
    } else if($user_type == 'secret') {
        $sql_common .= " and secret_member = 'Y' ";
    } else if($user_type == 'no_basic') {
        $sql_common .= " and mb_join_type = '장애인' ";

    }
}


$sql =  "select * from g5_member2_old where mb_level != '10' {$sql_common} order by mb_datetime desc";
$result = sql_query($sql);


// 테이블 상단 만들기
$EXCEL_STR = "
  <table>
    <colgroup>
        <col width=\"3%\">
        <col width=\"3%\">
        <col width=\"5%\">
        <col width=\"5%\">
        <col width=\"10%\">
        <col width=\"10%\">
        <col width=\"4%\">
        <col width=\"8%\">
        <col width=\"4%\">
        <col width=\"7%\">
        <col width=\"5%\">
        <col width=\"5%\">
        <col width=\"7%\">
        <col width=\"5%\">
        <col width=\"5%\">
    </colgroup>
    <thead>
	<tr>
        <th>No.</th>
        <th>보기</th>
		<th>아이디</a></th>
		<th>닉네임</th>
		<th>이름</a></th>
		<th>나이</th>
        <th>성별</th>
		<th>휴대폰</th>
        <th>지역</th>
		<th>가입일</th>
        <th>상태</th>

        
    
        
        ";
$no = 1;
while($row = sql_fetch_array($result)) {
    $mb_nick = $row['mb_nick'];
    $mb_id = $row['mb_id'];
    $mb = get_member($mb_id);
    $text = "";
    if ($row['mb_level'] == 2 && $row['mb_approval'] == 'Y') {
        if ($row['show_yn'] == 'Y') {
            $text = "공개";
        } else if ($row['show_yn'] == 'Y') {
            $text = "비공개";
        }
    } else if ($row['mb_level'] == 1) {
        $text = "탈퇴";
    }
    if($row['mb_approval'] == 'Y') { $state = '승인'; } else if($row['mb_approval_request'] == 'Y') { $state = '심사 요청'; }


    // 생년월일로 나이 계산
    if ($row['mb_birth']) {
        $birthyear_mb = substr($row['mb_birth'], 0, 4);
        $nowyear_mb = date("Y");
        $age_mb = $nowyear_mb - $birthyear_mb + 1;
    } else {
        $age_mb = "-";
    }





    $EXCEL_STR .= "
    <tr>
        <td>" . $no . "</td>
        <td>" . $text . "</td>
		<td>" . $mb_id . "</td>
		<td>" . $mb_nick . "</td>
		<td>" . get_text($row['mb_name']) . "</td>
		<td>" . $age_mb . "</td>
        <td>" . $row['mb_sex'] . "</td>
        <td>" . $row['mb_hp'] . "</td>
        <td>" . $row['mb_live_si'] . "</td>
		<td>" . substr($row['mb_datetime'], 0, 10) . "</td>
        <td>" . $state . "</td>
        
    </tr>";
    $no++;

}

$EXCEL_STR .= "</table>";

echo "<meta content=\"application/vnd.ms-excel; charset=UTF-8\" name=\"Content-type\"> ";
echo $EXCEL_STR;
?>

