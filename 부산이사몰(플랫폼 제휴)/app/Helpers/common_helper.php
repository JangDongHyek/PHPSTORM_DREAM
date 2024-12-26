<?php
/**
 * 공통함수 헬퍼
 */

// 관리자 여부 체크
function isAdminCheck(): bool
{
    return (session()->has('member') && session()->get('member')['mb_level'] == 10);
}

// lets080 체크
function isLets080(): bool
{
    return (session()->has('member') && session()->get('member')['mb_id'] == 'lets080');
}

// 회원 여부
function isMember(): bool
{
    return (session()->has('member') && session()->get('member')['mb_level'] >= 2);
}

/**
 * 페이징
 * @param $page : 현재 페이지
 * @param $totalCount : 전체 수
 * @param $listRows : 한페이지 노출 수
 * @param $listBlockRows : 한블록 수 (1,2,...10)
 * @return array: 페이징 정보
 */
function getPaging($page, $totalCount, int $listRows = 20, int $listBlockRows = 10, $listNoOrder = 'desc'): array
{
    if (empty($page)) $page = 1;

    $paging = array();
    $paging['totalCount'] = extractNumbers(number_format($totalCount));
    $paging['listRows'] = empty($listRows) ? 20 : $listRows;
    $paging['listBlockRows'] = $listBlockRows;
    $paging['totalPage'] = ceil($totalCount / $paging['listRows']); // 전체 페이지
    if ($page > $paging['totalPage'] && $paging['totalPage'] != 0) $page = $paging['totalPage'];

    $paging['page'] = $page;
    $paging['listNo'] = $totalCount - ($paging['listRows'] * ($page - 1)); // 목록번호 (내림차순)
    // if ($listNoOrder == 'asc') $paging['listNo'] = 1 + ($paging['listRows'] * ($page - 1)); // 목록번호 (오름차순)
    $paging['listNoAsc'] = $paging['listNoAsc'] = 1 + ($paging['listRows'] * ($page - 1)); // 목록번호 (오름차순)
    $paging['formRecord'] = ($page - 1) * $paging['listRows']; // LIMIT QUERY 시작열

    $paging['totalBlock'] = ceil($paging['totalPage'] / $paging['listBlockRows']); // 전체 블록
    $paging['currentBlock'] = ceil($paging['page'] / $paging['listBlockRows']); // 현재 블록
    $paging['startPage'] = ($paging['currentBlock'] * $paging['listBlockRows']) - ($paging['listBlockRows'] - 1); // 현재 블록 시작 페이지
    $paging['endPage'] = ($paging['totalPage'] <= $page) ? $paging['totalPage'] : ($paging['currentBlock'] * $paging['listBlockRows']); // 현재 블록 끝 페이지

    return $paging;
}

// 숫자만 추출
function extractNumbers($value, $isNegative = false, $isInt = true)
{
    $pattern = $isNegative ? '/[^-\d]/' : '/\D/';
    return ($isInt) ? (int)preg_replace($pattern, '', $value) :
        preg_replace($pattern, '', $value);
}

// 한글초성추출 (ㄱ-ㅎ)
function getFirstConsonant($str): string
{
    $cho = array("ㄱ", "ㄲ", "ㄴ", "ㄷ", "ㄸ", "ㄹ", "ㅁ", "ㅂ", "ㅃ", "ㅅ", "ㅆ", "ㅇ", "ㅈ", "ㅉ", "ㅊ", "ㅋ", "ㅌ", "ㅍ", "ㅎ");
    $result = "";
    if (in_array($str, $cho)) { // 엑셀데이터 때문에 추가 (예)약재명: ㄱ첩약
        $result = $str;
    } else {
        for ($i = 0; $i < mb_strlen($str, 'UTF-8'); $i++) {
            $code = mb_ord(mb_substr($str, $i, 1, 'UTF-8'), 'UTF-8') - 44032;
            if ($code > -1 && $code < 11172) $result .= $cho[floor($code / 588)];
        }
    }

    return $result;
}

// 랜덤문자열
function getRandomString($length = 6, $type = ''): string
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    if ($type === 'int') $characters = '0123456789';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}

// 문자열 공백제거
function removeWhitespace($str): string
{
    return preg_replace("/\s+/", "", (string)$str);
}

// 문자열 포함여부
function isWordInString(string $string, string $findWord): bool
{
    if (empty($string)) return false;
    return strpos($string, $findWord) !== false;
}

// get 파라미터
function getQueryString($excludeParam = array()): string
{
    $arr_query = [];
    // $sfl = ""; // sfl은 stx 값이 존재할때 추가

    foreach ($_GET as $key => $val) {
        if (in_array($key, $excludeParam) || $val == "") continue;
        // if ($key == 'sfl') {
        //     $sfl = $val;
        //     continue;
        // }
        // if ($key == 'stx' && $val) {
        //     $arr_query[] = $key . "=" . $val;
        //     $arr_query[] = "sfl=".$sfl;
        //     continue;
        // }
        $arr_query[] = $key . "=" . $val;
    }

    return implode("&", $arr_query);
}

// 휴대폰번호, 대표전화 하이픈 생성
function addHyphenContact($value)
{
    if (!$value) {
        return '';
    }

    $formatted = preg_replace('/[^0-9]/', '', $value);

    if (strlen($formatted) > 11) {
        // 82로 시작 시 010으로 변경
        if (substr($formatted, 0, 2) == '82') {
            $formatted = '0' . substr($formatted, 2, 2) . substr($formatted, 4, 4) . substr($formatted, 4, 4);
        } else {
            return substr($value, 0, 13);
        }
    }

    $result = [];
    $restNumber = "";

    if (strpos($formatted, "02") === 0) {
        $result[] = substr($formatted, 0, 2);
        $restNumber = substr($formatted, 2);
    } elseif (strpos($formatted, "1") === 0) {
        $restNumber = $formatted;
    } else {
        $result[] = substr($formatted, 0, 3);
        $restNumber = substr($formatted, 3);
    }

    if (strlen($restNumber) === 7) {
        $result[] = substr($restNumber, 0, 3);
        $result[] = substr($restNumber, 3);
    } else {
        $result[] = substr($restNumber, 0, 4);
        $result[] = substr($restNumber, 4);
    }

    return implode("-", array_filter($result));
}

// 휴대폰번호, 대표전화 하이픈 생성
function addHyphenContact050($value)
{
    if (!$value) {
        return '';
    }

    $formatted = preg_replace('/[^0-9]/', '', $value);

    if (strlen($formatted) > 11) {
        // 82로 시작 시 010으로 변경
        if (substr($formatted, 0, 2) == '82') {
            $formatted = '0' . substr($formatted, 2, 2) . substr($formatted, 4, 4) . substr($formatted, 4, 4);
        } else {
            return substr($value, 0, 14);
        }
    }

    $result = [];
    $restNumber = "";

    if (strpos($formatted, "02") === 0) {
        $result[] = substr($formatted, 0, 2);
        $restNumber = substr($formatted, 2);
    } elseif (strpos($formatted, "1") === 0) {
        $restNumber = $formatted;
    } else {
        $result[] = substr($formatted, 0, 3);
        $restNumber = substr($formatted, 3);
    }

    if (strlen($restNumber) === 7) {
        $result[] = substr($restNumber, 0, 4);
        $result[] = substr($restNumber, 4);
    } else {
        $result[] = substr($restNumber, 0, 4);
        $result[] = substr($restNumber, 4);
    }

    return implode("-", array_filter($result));
}

// 사업자 번호에 하이픈을 추가하는 함수
function formatBusinessNumber($number): string
{

    if (strlen($number) !== 10) {
        return '-';
    }

    return substr($number, 0, 3) . '-' . substr($number, 3, 2) . '-' . substr($number, 5, 5);

    //return $formattedNumber;
}


// JSON 문자열 여부 체크
function isJsonString($string): bool
{
    json_decode($string);
    return (json_last_error() == JSON_ERROR_NONE);
}

/**
 * 날짜 형식 포맷
 * @param $data : 2023.04.19 00:00:00
 * @return string: 23.04.19
 */
function replaceDateFormat($data, $offset = 2, $length = 8): string
{
    return str_replace('-', '.', substr($data, $offset, $length));
}

// 커스텀 로그 저장  (/writable/logs/folder-yyyy-mm/)
if (!function_exists('write_server_log')) {
    function write_server_log($logData = array(), $folder = '', $filename = 'log')
    {
        $year = date('Y');
        $month = date('m');
        $logFilePath = WRITEPATH . "logs/";
        $logFilePath .= ($folder != '') ? "{$folder}-{$year}-{$month}/" : "{$year}-{$month}/";

        if (!file_exists($logFilePath)) {
            mkdir($logFilePath, 0777, true);
        }

        $logFileName = $logFilePath . $filename . "-" . date('ymd') . ".log";

        // 배열을 JSON 문자열로 변환합니다.
        $logDataJson = "==========================================\n";
        $logDataJson .= date("Y-m-d H:i:s") . "\n";
        $logDataJson .= json_encode($logData, JSON_UNESCAPED_UNICODE); // JSON_PRETTY_PRINT

        // 파일에 데이터를 추가합니다. 파일이 없으면 생성하고, 데이터가 있으면 추가합니다.
        file_put_contents($logFileName, $logDataJson . PHP_EOL, FILE_APPEND);
    }
}

// 지역(시/구) 조회
function getSiGuData($si = '', $isAll = false): array
{
    $jsonPath = ROOTPATH . 'public_html/data/sigu.json';
    $jsonData = json_decode(file_get_contents($jsonPath), true);

    if (!empty($si)) { // 구
        $list = $jsonData[$si];
        asort($list);

    } else {
        if (!$isAll) $list = array_keys($jsonData); // 시
        else $list = $jsonData; // 시,구 전체
    }

    return $list ?? [];
}

// 아이디 뷰
function getIdView($id = '', $snsType = ''): string
{
    return SNS_TYPE[$snsType] ?? $id;
}

// 바이트 계산 (한글 2byte 처리)
function getStringByte($str = ''): int
{
    $totalLength = 0;
    $length = mb_strlen($str, 'UTF-8');

    for ($i = 0; $i < $length; $i++) {
        $char = mb_substr($str, $i, 1, 'UTF-8');
        if (strlen($char) >= 3) {
            $totalLength += 2;
        } else {
            $totalLength += strlen($char);
        }
    }

    return $totalLength;
}

if (!function_exists('mask_card_number')) {
    /**
     * 카드 번호를 마스킹하여 반환합니다.
     *
     * @param string $cardNumber 마스킹할 카드 번호 (예: "6556322266520157")
     * @return string 마스킹된 카드 번호 (예: "6556-****-****-****")
     */
    function mask_card_number(string $cardNumber): string
    {
        // 카드 번호에서 숫자만 추출
        $cleanNumber = preg_replace('/\D/', '', $cardNumber);

        // 카드 번호 길이 확인 (일반적으로 16자리)
        if (strlen($cleanNumber) !== 16) {
            // 필요에 따라 예외를 던지거나 기본 마스킹을 적용할 수 있습니다.
            // 여기서는 입력을 그대로 반환합니다.
            return $cardNumber;
        }

        // 첫 4자리 유지, 나머지 12자리는 마스킹
        $firstFour = substr($cleanNumber, 0, 4);
        $maskedSection = str_repeat('*', 12);

        // 포맷팅: "6556-****-****-****"
        return sprintf('%s-%s-%s-%s',
            $firstFour,
            substr($maskedSection, 0, 4),
            substr($maskedSection, 4, 4),
            substr($maskedSection, 8, 4)
        );
    }
}

// 소설 로그인  런텀 아이디
function generateRandomId($length = 12)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomId = '';

    for ($i = 0; $i < $length; $i++) {
        $randomId .= $characters[random_int(0, $charactersLength - 1)];
    }

    return $randomId;
}

function formatPhoneNumber($phone) {
    // +82를 0으로 대체
    $phone = str_replace("+82", "0", $phone);

    // 공백 제거
    $phone = str_replace(" ", "", $phone);

    // 전화번호가 0으로 시작하고 10으로 이어지며, 4자리 숫자 두 개가 있는지 확인
    if (preg_match('/^0(10)(\d{4})(\d{4})$/', $phone, $matches)) {
        // 포맷팅하여 반환
        return '010-' . $matches[2] . '-' . $matches[3];
    }

    // 잘못된 형식일 경우 원래 전화번호 반환
    return $phone;
}

// 전화번호로 그외 n명
function format_to_num($to_num) {
    $to_num_array = explode(',', $to_num);
    if (count($to_num_array) > 1) {
        return $to_num_array[0] . ' 외 ' . (count($to_num_array) - 1) . '명';
    } else {
        return $to_num;
    }
}

// 이름으로 그외 n명
function format_to_name($to_name) {
    $to_name_array = explode(',', $to_name);
    if (count($to_name_array) > 1) {
        return $to_name_array[0] . ' 외 ' . (count($to_name_array) - 1) . '명';
    } else {
        return $to_name;
    }
}
