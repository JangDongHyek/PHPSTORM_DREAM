<?php
$sub_menu = "200300";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

// 엑셀 다운로드 함수
function array_to_excel($data, $filename){
    header('Content-Type: application/vnd.ms-excel; charset=utf-8');
    header('Content-Disposition: attachment; filename="' . $filename . '.xls"');
    header('Cache-Control: max-age=0');
    $out = fopen('php://output', 'w');
    fputs($out, "\xEF\xBB\xBF"); // UTF-8 with BOM
    fputcsv($out, array_keys($data[0]), "\t");
    foreach ($data as $row) {
        fputcsv($out, $row, "\t");
    }
    fclose($out);
}

$sql_common = " from g5_payment ";
$sql_search = " where 1=1 ";

if ($stx) {
    $sql_search .= " and ( ";
    switch ($sfl) {

        default :
            $sql_search .= " ({$sfl} like '%{$stx}%') ";
            break;
    }
    $sql_search .= " ) ";
}


$sql_order = " order by wr_datetime desc ";

if (!empty($_GET['sdt'])) $sql_search .= "AND DATE(wr_datetime) >= '{$_GET['sdt']}' ";
if (!empty($_GET['edt'])) $sql_search .= "AND DATE(wr_datetime) <= '{$_GET['edt']}' ";

if ($stx) {
    $sql_search .= " and ( ";
    switch ($sfl) {
        default :
            $sql_search .= " ({$sfl} like '{$stx}%') ";
            break;
    }
    $sql_search .= " ) ";
}

$sql_order = " order by wr_datetime desc ";

$sql = " select * {$sql_common} {$sql_search} {$sql_order} ";
$result = sql_query($sql);

// 테이블 출력을 위한 HTML 코드 추가
echo "<table border='1'>";
echo "<tr>";
echo "<th>번호</th>";
echo "<th>회원아이디</th>";
echo "<th>기관명</th>";
echo "<th>품목</th>";
echo "<th>결제금액</th>";
echo "<th>결제종류</th>";
echo "<th>결제방식</th>";
echo "<th>연락처</th>";
echo "<th>이메일</th>";
echo "<th>이메결제일시일</th>";
echo "</tr>";

for ($i=0; $row=sql_fetch_array($result); $i++) {
    // 데이터 가공
    // 테이블 출력을 위한 HTML 코드 추가
    echo "<tr>";

    echo "<td>" . ($i+1) . "</td>";
    echo "<td>" . $row['userId'] . "</td>";
    echo "<td>" . $row['GoodsName'] . "</td>";
    echo "<td>" . $row['BuyerName'] . "</td>";
    echo "<td>" . number_format($row['Amt']) . "</td>";
    echo "<td>" . $row['fn_name'] . "</td>";
    echo "<td>" . $row['payMethod'] . "</td>";
    echo "<td style='mso-number-format:\"@\";'>" . $row['BuyerTel'] . "</td>";
    echo "<td>" . $row['BuyerEmail'] . "</td>";
    echo "<td>" . date('Y-m-d',strtotime($row['wr_datetime'])) . "</td>";
    echo "</tr>";
}

// 테이블 출력을 위한 HTML 코드 추가
echo "</table>";

// 엑셀 다운로드
array_to_excel($data, '결제리스트');
?>

