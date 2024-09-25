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