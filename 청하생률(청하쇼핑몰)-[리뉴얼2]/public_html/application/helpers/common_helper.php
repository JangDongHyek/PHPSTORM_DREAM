<?php
/**
 * 공통함수
 */

// 헤더명 (다른 view끼리 헤더명 공유)
function getMallHeaderName($pid): string
{
	$headerName = '';
	switch ($pid) {
		case "index" :
			$headerName = "(주)청하생률";
			break;
		case "login" :
			$headerName = "로그인";
			break;
		case "find_account" :
			$headerName = "아이디/비밀번호 찾기";
			break;
		case "reset_pw" :
			$headerName = "비밀번호 재설정";
			break;
		case "signup" :
			$headerName = "회원가입";
			break;
		case "mypage" :
			$headerName = "내정보수정";
			break;
		case "event" :
			$headerName = "기획전";
			break;
		case "product_list" :
			$headerName = "제품리스트";
			break;
		case "product_view" :
			$headerName = "제품상세보기";
			break;
		case "cart" :
			$headerName = "장바구니";
			break;
		case "order_sheet" :
			$headerName = "주문서";
			break;
		case "order" :
			$headerName = "주문배송조회";
			break;
		case "order_view" :
			$headerName = "주문상세";
			break;
		case "board_list" :
		case "board_view" :
		case "board_form" :
			$headerName = "고객센터";
			break;
		case "greet" :
			$headerName = "회사소개";
			break;
		case "guide" :
			$headerName = "이용안내";
			break;
		case "privacy" :
			$headerName = "개인정보취급(처리)방침";
			break;
		case "provision" :
			$headerName = "서비스 이용약관";
			break;
	}

	return $headerName;
}

// 관리자 여부 체크
function isAdminCheck($level): bool
{
	return (int)$level == 10;
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
    $paging['totalCount'] = number_format($totalCount);
    $paging['listRows'] = $listRows;
    $paging['listBlockRows'] = $listBlockRows;
    $paging['totalPage'] = ceil($totalCount / $paging['listRows']); // 전체 페이지
    if ($page > $paging['totalPage'] && $paging['totalPage'] != 0) $page = $paging['totalPage'];

    $paging['page'] = $page;
    $paging['listNo'] = $totalCount - ($paging['listRows'] * ($page - 1)); // 목록번호 (내림차순)
    if ($listNoOrder == 'asc') $paging['listNo'] = 1 + ($paging['listRows'] * ($page - 1)); // 목록번호 (오름차순)
    $paging['formRecord'] = ($page - 1) * $paging['listRows']; // LIMIT QUERY 시작열

    $paging['totalBlock'] = ceil($paging['totalPage'] / $paging['listBlockRows']); // 전체 블록
    $paging['currentBlock'] = ceil($paging['page'] / $paging['listBlockRows']); // 현재 블록
    $paging['startPage'] = ($paging['currentBlock'] * $paging['listBlockRows']) - ($paging['listBlockRows'] - 1); // 현재 블록 시작 페이지
    $paging['endPage'] = ($paging['totalPage'] <= $page) ? $paging['totalPage'] : ($paging['currentBlock'] * $paging['listBlockRows']); // 현재 블록 끝 페이지

    return $paging;
}

/**
 * 날짜 형식 포맷
 * @param $data : 2023.04.19 00:00:00
 * @return string: 23.04.19
 */
function replaceDateFormat($data, $length = 8, $offset = 2): string
{
    return str_replace('-', '.', substr($data, $offset, $length));
}

// 상품(약속처방) 썸네일
function getProductThumbnail($fileNameList = ""): string
{
	if (!$fileNameList) return "/img/common/noimg.jpg";

	$expFileNames = explode(",", $fileNameList);
	$path = UPLOAD_FOLDERS['PRODUCT'];

	foreach ($expFileNames as $fileName) {
		if (!$fileName) continue;
		$filePath = $path . $fileName;
		if (file_exists($filePath)) {
			return uploadFileRemoveServerPath($filePath);
			break;
		}
	}
	return "/img/common/noimg.jpg";
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

/**
 * 소수점 뒤 0 제거
 * @param $num: 입력 데이터 (1.70)
 * @param $decimals: 소수점 자리수
 * @return string: 1.7
 */
function numberFormatClean(float $num, int $decimals = 0): string
{
	$newNumber = number_format($num, $decimals);
	return rtrim(rtrim($newNumber, 0), '.');
}

/**
 * 관리자페이지 검색필터 선택시 active 클래스 리턴
 * @param $getName: 파라미터명
 * @param $compareValue: 비교값
 * @param string $className: 리턴 클래스명 (string)
 */
function getParamMatches($getName, $compareValue, string $className = "active"): string
{
	return ((String)$_GET[$getName] == (String)$compareValue) ? $className : "";
}

// 숫자만 추출
function extractNumbers($value, $isNegative = false): int
{
	$pattern = $isNegative? '/[^-\d]/' : '/\D/';
	return (int)preg_replace($pattern, '', $value);
}

// 한글초성추출 (ㄱ-ㅎ)
function getFirstConsonant($str): string
{
	$cho = array("ㄱ", "ㄲ", "ㄴ", "ㄷ", "ㄸ", "ㄹ", "ㅁ", "ㅂ", "ㅃ", "ㅅ", "ㅆ", "ㅇ", "ㅈ", "ㅉ", "ㅊ", "ㅋ", "ㅌ", "ㅍ", "ㅎ");
	$result = "";
	if (in_array($str, $cho)) {
		$result = $str;
	} else {
		for ($i = 0; $i < mb_strlen($str, 'UTF-8'); $i++) {
			$char = mb_substr($str, $i, 1, 'UTF-8');
			$code = uniord($char) - 44032;
			if ($code > -1 && $code < 11172) {
				$result .= $cho[floor($code / 588)];
			}
		}
	}
	// 쌍자음 -> 단일자음으로 변경
	switch ($result) {
		case "ㄲ" : $result = "ㄱ"; break;
		case "ㄸ" : $result = "ㄷ"; break;
		case "ㅃ" : $result = "ㅂ"; break;
		case "ㅆ" : $result = "ㅅ"; break;
		case "ㅉ" : $result = "ㅈ"; break;
	}
	return $result;
}
function uniord($c): string
{
	$ord0 = ord($c{0});
	if ($ord0 >= 0 && $ord0 <= 127) {
		return $ord0;
	}
	$ord1 = ord($c{1});
	if ($ord0 >= 192 && $ord0 <= 223) {
		return ($ord0 - 192) * 64 + ($ord1 - 128);
	}
	$ord2 = ord($c{2});
	if ($ord0 >= 224) {
		return ($ord0 - 224) * 4096 + ($ord1 - 128) * 64 + ($ord2 - 128);
	}
	return ''; // 유효하지 않은 유니코드 문자일 경우 빈 문자열 반환
}

// 랜덤문자열
function getRandomString($length=6, $type=''): string
{
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	if ($type === 'int') $characters = '0123456789';
	$randomString = '';
	for ($i = 0; $i < $length; $i++) {
		$randomString .= $characters[rand(0, strlen($characters) - 1)];
	}
	return $randomString;
}

// 업로드파일 서버경로 -> url 변경 (ex. /img/file-name.jpg)
function uploadFileRemoveServerPath($str): string
{
	return str_replace(ASSETS_PATH, '', $str);
}

// 주문번호 생성
function createOrderNo(): string
{
	return date('ymd-Hi-s', time()) . getRandomString(3, 'int');
}

// 미수거래 등록시 거래명
// ex. 외상거래 [주문번호: 230628-0908-26437]
// ex. 일반거래 [주문번호: 230628-0908-26437]
function generateMisuTransTitle($payMethod, $ordNo): string
{
	$title = ($payMethod == 'CREDIT')? '외상거래' : '일반거래';
	return "{$title} [주문번호: {$ordNo}]";
}

// 문자열 포함여부
function isWordInString(string $string, string $findWord): bool
{
    if (empty($string)) return false;
    return strpos($string, $findWord) !== false;
}

// 기준시간으로부터 몇시간이 지났는지 확인 ($datetime = Y-m-d H:i:s)
function getPassedHours($datetime): int
{
	$postDateTime = new DateTime($datetime);
	$currentDateTime = new DateTime();
	$interval = $currentDateTime->diff($postDateTime);

	// 일수를 시간으로 변환하고, 시간과 분을 추가하여 총 시간 계산
	// (분은 버림으로 계산함)
	return $interval->days * 24 + $interval->h + floor($interval->i / 60);
}

// 메일발송 (호스트메카 중계서비스)
function itforoneMailer($to = "", $toName = "", $subject = "", $content = ""): bool
{
	$data = array();
	$data['from'] = "no-reply@dreamforone.com";
	$data['from_name'] = "청하생률";
	$data['to'] = $to;
	$data['to_name'] = $toName;
	$data['subject'] = $subject;
	$data['content'] = $content;

	$api_server = "http://itforone.co.kr/~itforone/mail_send.php";
	$post_json = Curl_Postfields_Create($data); //json_encode($data, JSON_UNESCAPED_UNICODE);

	$opts = array(
		CURLOPT_URL => $api_server,
		CURLOPT_HEADER => true,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_CUSTOMREQUEST => "POST",
		CURLOPT_POST => true,
		CURLOPT_POSTFIELDS => $post_json,	//http_build_query($post_data),
		//CURLOPT_POSTFIELDSIZE => 1000,
		CURLOPT_TIMEOUT => 3,
	);

	// 응답요청
	$curl_session = curl_init();
	curl_setopt_array($curl_session, $opts);
	$curl_response = curl_exec($curl_session);
	//$resMessage = (curl_error($curl_session))? null : $curl_response;
	//print_r($curl_response);

	$body = null;
	$resultData = false;

	if (curl_error($curl_session)) {
		log_message('error', "메일발송실패<1>" . json_encode($curl_session, JSON_UNESCAPED_UNICODE));

	} else {
		$header_size = curl_getinfo($curl_session, CURLINFO_HEADER_SIZE);
		//$header = substr($curl_response, 0, $header_size);
		$body = substr($curl_response, $header_size);

		//print_r($header);
		//print_r($body); // string타입
		// print_r(json_decode($body)); // array변환

		$res = json_decode($body, true);

		if ($res['curl_result']['code'] == "S00") {
			$resultData = true;
			log_message('error', "메일발송성공" . $body);
		} else {
			log_message('error', "메일발송실패<2>" . $body);
		}
	}

	return $resultData;
}
function Curl_Postfields_Create($input, $prefix = '') {
	if(!is_array($input)) {
		return $input;
	}

	$output = array();
	foreach($input as $key => $value) {
		$final_key = $prefix ? $prefix[$key] : $key;
		if(is_array($value)) {
			$output += Curl_Postfields_Create($value, $final_key);
		} else {
			$output[$final_key] = $value;
		}
	}
	return $output;
}

// 상품명 추출
function getOrderProductName($name = ""): string
{
    $recipeNameArr = explode("|", $name);
    $nameCnt = count($recipeNameArr);
    $recipeName = $recipeNameArr[0];
    if ($nameCnt > 1) $recipeName .= "<em> 외 " . ($nameCnt-1) . "개</em>";

    return $recipeName;
}

// 관리자 주문배송관리 검색 파라미터
function getOrderListParam($get): array
{
    return [
        'page' => $get['page'] ?? 1,
        'sfl' => $get['sfl'] ?? 'name',
        'stx' => $get['stx'] ?? '',
        'sdt' => $get['sdt'] ?? '',
        'edt' => $get['edt'] ?? '',
        'groupIdxList' => $get['groupIdxList'] ?? '',
        'status' => $get['status'] ?? '',
        'method' => $get['method'] ?? '',
        'excel' => $get['excel'] ?? '',
    ];
}