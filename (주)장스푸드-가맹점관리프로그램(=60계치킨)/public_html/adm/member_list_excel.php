<?php
include_once('./_common.php');
/**
 * 회원관리 엑셀
 */
header( "Content-type: application/vnd.ms-excel; charset=utf-8");
header( "Content-Disposition: attachment; filename = 60chicken_member.xls" ); // 파일명
header( "Content-Description: PHP4 Generated Data" );

$EXCEL_FILE = "
<table border='1'>
    <tr>
       <td>아이디</td>
       <td>매장명</td>
       <td>이름</td>
       <td>회원권한</td>
       <td>회원구분</td>
       <td>휴대폰번호</td>
       <td>사업자등록번호</td>
       <td>계육업체</td>
    </tr>
";

$sql = "SELECT * FROM g5_member where mb_level > 1 and mb_level <= 10 order by mb_no desc";
$rlt = sql_query($sql);

// DB 에 저장된 데이터를 테이블 형태로 저장합니다.
for($i=0; $row=sql_fetch_array($rlt); $i++) {
    // 계육업체
    $ck = sql_fetch("SELECT co_name FROM g5_ck_company WHERE idx = '{$row['mb_4']}'");

    // 회원권한
    if($row['mb_level'] == 2) $right = '점주';
    else if($row['mb_level'] == 3) $right = '임직원';
    else $right = '관리자';

    $EXCEL_FILE .= "
    <tr>
       <td>".$row['mb_id']."</td>
       <td>".$row['mb_2']."</td>
       <td>".$row['mb_name']."</td>
       <td>".$right."</td>
       <td>".$row['mb_1']."</td>
       <td>".$row['mb_hp']."</td>
       <td>".$row['mb_3']."</td>
       <td>".$ck['co_name']."</td>
    </tr>
";
}

$EXCEL_FILE .= "</table>";

// 만든 테이블을 출력해줘야 만들어진 엑셀파일에 데이터가 나타납니다.
echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>";
echo $EXCEL_FILE;
?>
