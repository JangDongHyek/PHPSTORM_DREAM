<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code


/**
 * 부산한약품 API KEY
 */
// 이노페이 (비과세 MID)
// 테스트키
//const IPAY_MID = 'testpay01m';
//const IPAY_KEY = 'Ma29gyAFhvv/+e4/AHpV6pISQIvSKziLIbrNoXPbRS5nfTx2DOs8OJve+NzwyoaQ8p9Uy1AN4S1I0Um5v7oNUg==';

// 실키
const IPAY_MID = 'pgchungh2m';
const IPAY_KEY = 'H4W1lg4brxhtsGYW21we6ycSXvqs5VsZVmuXzuvJ2YcDt5TZwXpyzf7B4VkezeQCyhI7GAagarYHOPpaZqke5A==';



/**
 * 부산한약품 상수
 */
define("CSS_VER", time());
define("JS_VER", time());

define("IS_PRIVATE", ($_SERVER['REMOTE_ADDR'] == "183.103.22.103"));
//const PROJECT_URL = 'https://dreamforone.kr/~juchungha3';
const PROJECT_URL = 'https://dreamforone.kr/~dyprofile_mall';
// const PROJECT_URL = 'https://chungha.co.kr';
const ASSETS_URL = PROJECT_URL . '/assets';
const ADM_URL = PROJECT_URL . '/adm';
const ASSETS_PATH = FCPATH . 'assets/';
const MODAL_PATH = VIEWPATH . "modal/";

// 업로드 폴더명
const UPLOAD_FOLDERS = [
	'CLINIC' => ASSETS_PATH . 'uploads/clinic/',		// 회원가입
	'PRODUCT' => ASSETS_PATH . 'uploads/product/',      // 상품
	'BOARD' => ASSETS_PATH . 'uploads/cs/',     		// 고객센터
    'POPUP' => ASSETS_PATH . 'uploads/popup/',         // 팝업

	// 'INQUIRY' => ROOTPATH . 'public/uploads/inquiry/',     // 한의원 요청문의
	// 'NOTICE' => ROOTPATH . 'public/uploads/notice/',       // 공지사항
	//
	// 'DOSAGE' => ROOTPATH . 'public/uploads/dosage/',       // 복용법
	// 'CS'     => ROOTPATH . 'public/uploads/cs/',           // cs 게시판
];

// 상품 카테고리
const PRODUCT_CATEGORY = ['CA01' => '한방약재',];


/**
 * 결제
 */
// 결제수단 - 전체
const PAYMENT_METHODS = [
	'CARD' => '카드결제',
	'CASH' => '현금결제',
	//'VBANK' => '가상계좌',
	// 'POINT' => '포인트결제',
	//'CREDIT' => '월말결제', // 외상결제
];
// 결제수단 (결제시 결제가능한 수단)
const ENABLE_PAYMENT_METHODS = [
	'CARD' => '카드결제',
	'CASH' => '현금결제',
	//'VBANK' => '가상계좌',
];
// 입금계좌안내
const ACCOUNT_LIST_PRODUCT = [
	'계산서' => ['number' => '국민은행 135701-04-245744', 'name' => '(주)청하생률'],
	'현금영수증' => ['number' => '국민은행 135701-04-245744', 'name' => '(주)청하생률'],
	'미발행' => ['number' => '국민은행 135701-04-245744', 'name' => '(주)청하생률'],
];
// 현금결제시 영수증 발행목록
const CASH_ISSUE_TYPE = [
	'1' => '세금계산서',
	'2' => '현금영수증',
	'3' => '미발행',
];
// 현금영수증 발급구분
const CASH_RECEIPT_TYPE = [
	'1' => '개인 소득공제',
	'2' => '사업자 지출증빙',
];


/**
 * 주문
 */
// 주문서 상태
const ORDER_RECIPE_STATUS = [
	'R' => '주문접수',
	'I' => '입금완료',
	'DI' => '배송중',
	'DC' => '배송완료',
	'C' => '주문취소',
];

// 주문서 결제상태
const ORDER_PAY_STATUS = [
	'R' => '입금대기',
	'Y' => '결제완료',
	'C' => '주문취소',
];

// 택배사 코드
const COURIER_CODE = [
    '04' => "CJ대한통운",
    '05' => "한진택배",
    '08' => "롯데택배",
    '01' => "우체국택배",
    '06' => "로젠택배",
    '11' => "일양로지스",
    '20' => "한덱스",
    '22' => "대신택배",
    '23' => "경동택배",
    '32' => "합동택배",
    '46' => "CU 편의점택배",
    '24' => "GS Postbox 택배",
    '16' => "한의사랑택배",
    '17' => "천일택배",
    '18' => "건영택배",
    '40' => "굿투럭",
    '43' => "애니트랙",
    '44' => "SLX택배",
    '45' => "우리택배(구호남택배)",
    '47' => "우리한방택배",
    '53' => "농협택배",
    '54' => "홈픽택배",
    '71' => "IK물류",
    '72' => "성훈물류",
    '74' => "용마로지스",
    '75' => "원더스퀵",
    '79' => "로지스밸리택배",
    '82' => "컬리넥스트마일",
    '85' => "풀앳홈",
    '86' => "삼성전자물류",
    '88' => "큐런택배",
    '89' => "두발히어로",
    '90' => "위니아딤채",
    '92' => "지니고 당일배송",
    '94' => "오늘의픽업",
    '96' => "로지스밸리",
    '101' => "한샘서비스원 택배",
    '103' => "NDEX KOREA",
    '104' => "도도플렉스(dodoflex)",
    '107' => "LG전자(판토스)",
    '110' => "부릉",
    '112' => "1004홈",
    '113' => "썬더히어로",
    '116' => "(주)팀프레시",
    '118' => "롯데칠성",
    '119' => "핑퐁",
    '120' => "발렉스 특수물류",
    '123' => "엔티엘피스",
    '125' => "GTS로지스",
    '127' => "로지스팟",
    '129' => "홈픽 오늘도착",
    '130' => "로지스파트너",
    '131' => "딜리래빗",
    '132' => "지오피",
    '134' => "에이치케이홀딩스",
    '135' => "HTNS",
    '136' => "케이제이티",
    '137' => "더바오",
    '138' => "라스트마일",
    '139' => "오늘회 러쉬",
    '142' => "탱고앤고",
    '143' => "투데이",
    '145' => "현대글로비스",
    '148' => "ARGO",
    '151' => "자이언트",
    '155' => "HY",
    '156' => "유피로지스",
    '157' => "우진인터로지스",
    '159' => "삼다수 가정배송",
    '160' => "와이드테크",
    '163' => "위니온로지스",
    '167' => "딜리박스",
    '168' => "이스트라"
];

// 상품문의
const QNA_STATUS = [
    '0' => '접수완료',
    '1' => '처리중',
    '2' => '처리완료'
];
