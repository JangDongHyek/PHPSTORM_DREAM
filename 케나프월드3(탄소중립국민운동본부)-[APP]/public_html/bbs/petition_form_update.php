<?php
include_once('./_common.php');
include_once('../adm/insert_stock.php');

//error_reporting(E_ALL);
//ini_set("display_errors", 1);

function write_insert($write_table, $data) {
    // mb_id가 존재하는지 확인합니다.
    if (isset($data['mb_id'])) {
        $mb_id = $data['mb_id'];
        // mb_id를 기준으로 해당 테이블에서 데이터를 검색합니다.
        $check_sql = "SELECT COUNT(*) AS count FROM $write_table WHERE mb_id = '".sql_real_escape_string($mb_id)."'";
        $check_result = sql_query($check_sql);
        $row = sql_fetch_array($check_result);
        if ($row['count'] > 0) {
            // 데이터가 이미 존재하면 false를 반환합니다.
            return false;
        }
    }

    // 그누보드의 내장 함수를 사용하여 SQL 쿼리를 준비합니다.
    // SQL 인젝션을 방지하기 위해 안전하게 데이터를 처리합니다.
    $set = '';
    foreach ($data as $key => $value) {
        if ($set != '') $set .= ', ';
        $set .= "$key = '".sql_real_escape_string($value)."'";
    }

    // INSERT 쿼리를 생성합니다.
    $sql = " INSERT INTO $write_table SET $set ";

    // 쿼리를 실행하고 결과를 반환합니다.
    // 그누보드의 sql_query 함수를 사용합니다.
    $result = sql_query($sql);

    if ($result) {
        // 성공적으로 삽입된 경우, 마지막으로 삽입된 레코드의 ID를 반환합니다.
        return sql_insert_id();
    } else {
        // 삽입에 실패한 경우, false를 반환합니다.
        return false;
    }
}

//$request_origin = "http://canadaw2.itforone.co.kr";
$redirect_url = "";

//FIXME 최초 회원가입 후에 청원서 페이지로 이동하고 청원서 등록버튼 클릭시 해당 페이지 진입

// CORS 헤더 설정 -> 이제 필요없음
//header("Access-Control-Allow-Origin: {$request_origin}");
//header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
//header("Access-Control-Allow-Headers: Content-Type, Authorization");

//1. 청원서 저장
$name = $_POST['mb_name'];
$phone_number = $_POST['mb_hp'];
$year = $_POST['year'];
$month = $_POST['month'];
$day = $_POST['day'];
$birthdate = $year . '-' . $month . '-' . $day;
$organization = $_POST['organization'];
$address = $_POST['address'];
$mb_recommend = $member['mb_recommend'];

// 그누보드 게시판에 데이터 삽입
$write_table = "petition"; // 게시판 테이블 이름
$data = array(
    'name' => $name,
    'mb_hp' => $phone_number,
    'birthdate' => $birthdate,
    'organization' => $organization,
    'address' => $address, //전화번호를 아이디로 쓰는곳이기에 전화번호를 넣음
    'created_at' => G5_TIME_YMDHIS,
    "mb_id" => $phone_number
);

$wr_id = write_insert($write_table, $data);

if ($wr_id) {
    //echo "청원서가 성공적으로 등록되었습니다.";
} else {
    alert('청원서를 이미 작성하셨거나, 등록중 오류가 발생하였습니다. 관리자에게 문의하세요.', G5_BBS_URL.'/login.php');
}

//2-2. 회원 - 로그인으로
//3. 주식 5주 지급
// 추가할 레코드의 데이터를 설정합니다.
$mbId = trim($phone_number); // 사용자 ID
$holdingCount = 5; // 보유 수량
$stockPrice = getStockPrice(); // 주식 가격
$issuanceDate = G5_TIME_YMD; // 발행 날짜
$paymentReason = '회원가입'; // 지급 사유

// 주식 삽입 함수 호출
if (insertStockData($mbId, $holdingCount, $stockPrice, $issuanceDate, $paymentReason, $mb_recommend)) {
    // 성공 처리
    alert('청원서 작성완료. 5000 포인트가 지급되었습니다.', G5_BBS_URL.'/register_result.php');
}else{
    alert('청원서 작성에 실패했습니다. 메인페이지 우측 상단에 청원서 작성을 클릭하여 다시 작성해주세요', G5_BBS_URL.'/login.php');
}
