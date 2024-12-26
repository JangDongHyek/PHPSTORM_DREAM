<?php

/*
 | --------------------------------------------------------------------
 | App Namespace
 | --------------------------------------------------------------------
 |
 | This defines the default Namespace that is used throughout
 | CodeIgniter to refer to the Application directory. Change
 | this constant to change the namespace that all application
 | classes should use.
 |
 | NOTE: changing this will require manually modifying the
 | existing namespaces of App\* namespaced-classes.
 */
defined('APP_NAMESPACE') || define('APP_NAMESPACE', 'App');

/*
 | --------------------------------------------------------------------------
 | Composer Path
 | --------------------------------------------------------------------------
 |
 | The path that Composer's autoload file is expected to live. By default,
 | the vendor folder is in the Root directory, but you can customize that here.
 */
defined('COMPOSER_PATH') || define('COMPOSER_PATH', ROOTPATH . 'vendor/autoload.php');

/*
 |--------------------------------------------------------------------------
 | Timing Constants
 |--------------------------------------------------------------------------
 |
 | Provide simple ways to work with the myriad of PHP functions that
 | require information to be in seconds.
 */
defined('SECOND') || define('SECOND', 1);
defined('MINUTE') || define('MINUTE', 60);
defined('HOUR')   || define('HOUR', 3600);
defined('DAY')    || define('DAY', 86400);
defined('WEEK')   || define('WEEK', 604800);
defined('MONTH')  || define('MONTH', 2_592_000);
defined('YEAR')   || define('YEAR', 31_536_000);
defined('DECADE') || define('DECADE', 315_360_000);

/*
 | --------------------------------------------------------------------------
 | Exit Status Codes
 | --------------------------------------------------------------------------
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
defined('EXIT_SUCCESS')        || define('EXIT_SUCCESS', 0);        // no errors
defined('EXIT_ERROR')          || define('EXIT_ERROR', 1);          // generic error
defined('EXIT_CONFIG')         || define('EXIT_CONFIG', 3);         // configuration error
defined('EXIT_UNKNOWN_FILE')   || define('EXIT_UNKNOWN_FILE', 4);   // file not found
defined('EXIT_UNKNOWN_CLASS')  || define('EXIT_UNKNOWN_CLASS', 5);  // unknown class
defined('EXIT_UNKNOWN_METHOD') || define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     || define('EXIT_USER_INPUT', 7);     // invalid user input
defined('EXIT_DATABASE')       || define('EXIT_DATABASE', 8);       // database error
defined('EXIT__AUTO_MIN')      || define('EXIT__AUTO_MIN', 9);      // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      || define('EXIT__AUTO_MAX', 125);    // highest automatically-assigned error code

/**
 * @deprecated Use \CodeIgniter\Events\Events::PRIORITY_LOW instead.
 */
define('EVENT_PRIORITY_LOW', 200);

/**
 * @deprecated Use \CodeIgniter\Events\Events::PRIORITY_NORMAL instead.
 */
define('EVENT_PRIORITY_NORMAL', 100);

/**
 * @deprecated Use \CodeIgniter\Events\Events::PRIORITY_HIGH instead.
 */
define('EVENT_PRIORITY_HIGH', 10);

/*
| --------------------------------------------------------------------------
| 부산이사몰 API KEY
| --------------------------------------------------------------------------
 */
// 이노페이 (비과세 MID) - 자동결제시 사용
//const IPAY_AUTO_MID = 'arstest03m'; // 테스트
const IPAY_AUTO_MID = 'pgdreamfom'; // 운영
const IPAY_AUTO_HOST = 'https://api.innopay.co.kr/api';
const IPAY_AUTO_CANCEL_PW = '123456';
const IPAY_AUTO_KEY = 'y9tG9hJtyAzLIxyYXB/hhjKCCqI3gwTY1O2R5GANG5Yxg3X/esKzOHkFZMmLMsj9jwI93VJf8kKOn2ic0MwhMA==';



// 050안심번호
const REST050_BIZ_TOKEN = 'eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOiJrbm4yNDI0IiwiaWF0IjoxNzMxNjU2NjI3fQ.v0vXhfuS6PEX4oceW0-awwlH0jmCOgf7uRbUEHBxu6h9mTppFXqGKWOzVKI0ukinrNkR9l1Pfssysevm-zB8KQ';
//const REST050_BIZ_HOST = 'https://050api-cbt.sejongtelecom.net:8443'; // 개발
const REST050_BIZ_HOST = 'https://050api.sejongtelecom.net:8443'; // 운영

/*
| --------------------------------------------------------------------------
| 부산이사몰 상수
| --------------------------------------------------------------------------
 */
include_once APPPATH . "Config/Constants/keys.php";
define("CSS_VER", time());
define("JS_VER", time());
// define("JS_VER", "1.0.0");

define("IS_PRIVATE", $_SERVER['REMOTE_ADDR'] == "59.19.201.109" || $_SERVER['REMOTE_ADDR'] == '112.160.231.172');

date_default_timezone_set('Asia/Seoul');
define("DATE_TIME", date('Y-m-d H:i:s'));
const LOGIN_TOKEN_KEY = "x-knn24-token";

// 업로드 폴더명
const UPLOAD_FOLDERS = [
    'EDITOR' => [ // 에디터
        'path' => ROOTPATH . 'public_html/uploads/editor/',
        'url' => 'uploads/editor/',
    ],
    'COMPANY' => [ // 업체
        'path' => ROOTPATH . 'public_html/uploads/company/',
        'url' => 'uploads/company/',
    ],
    'BOARD' => [ // 커뮤니티
        'path' => ROOTPATH . 'public_html/uploads/board/',
        'url' => 'uploads/board/',
    ],
    'MMS' => [
        'path' => ROOTPATH . 'public_html/uploads/MMS/',
        'url' => 'uploads/MMS/',
    ]
];

//이사 서비스 종류
const SERVICE_TYPE =[
    '' => '이사서비스',
    'P' => '포장이사',
    'H' => '반포장이사',
    'C' => '일반이사',
    'O' => '원룸이사',
    'L' => '사다리차',
];

// title 정보
const LASTSEGMENT = [
    'faq' => 'FAQ',
    'mypage' => '정보 관리',
];

//승인 상태
const STATE = [
    'N' => '정상',
    'W' => '승인대기',
    'H' => '보류',
    'S' => '탈퇴',
];

//견적신청 승인
const ESTATE = [
    'N' => '미승인',
    'Y' => '승인',
];

//SNS 타입
const SNS_TYPE = [
    'N' => '네이버',
    'K' => '카카오'
];

//멤버 레벨
const MB_LEVEL = [
    '2' => '일반',
    '5' => '사업자',
    '8' => '부동상'
    
];

//이사 업체
const REGION = [
    'bus' => '부산',
    'uls' => '울산',
    'gye' => '경남'
];

//커뮤니티
const BOARD_NAME = [
    'topic' => '새소식안내',
    'tidings' => '부산경남소식',
    'job' => '아서업체구인구직',
    'golf_yard' => '골프마당',
    'info' => '이사관련정보',
    'partner' => '관련업체소개',
    'reviews' => '이사후기',
    'faq' => 'FAQ'
];

//광고가격
const AD_PRICE = [
    'add' => '100000', // 추가
    'basic' => '200000', // 기본
    'main' => '400000', // 메인
    'mainTop' => '400000', // 메인 상단 누출
    'mainBottom' => '400000', // 메인 하단 누출
    'premium' => '100000', // 프라이엄 1개당
];

//전화 가격
const HP_PRICE = [
    'price' => '3300',
];

const CP_TYPE =[
    '1' => '일반',
    '2' => '프리미엄',
    '3' => '메인상단',
    '4' => '메인하단',
];

const SMS_UNIT = [
    'S' => 14.3,
    'L' => 36.3,
    'M' => 110,
];

const SMS_TYPE = [
    'C' => '충전',
    'U' => '사용',
];

const CSDATERANGE = [
    ''=>'전체상태',
    '1'=>'접수완료',
    '2'=>'검토중',
    '3'=>'처리중',
    '4'=>'처리완료'
];


//카드사 코드
const CARD_COMPANIES = [
    '01' => '비씨',
    '02' => '국민',
    '03' => '외환(하나)',
    '04' => '삼성',
    '06' => '신한',
    '07' => '현대',
    '08' => '롯데',
    '11' => '시티',
    '12' => '농협',
    '13' => '수협',
    '14' => '평화',
    '15' => '우리',
    '16' => '하나',
    '20' => '축협(농협)',
    '21' => '광주',
    '22' => '전북',
    '23' => '제주',
    '24' => '산은',
    '25' => '해외비자',
    '26' => '해외마스터',
    '27' => '해외다이너스',
    '28' => '해외 AMX',
    '29' => '해외 JCB',
    '30' => '유니온페이',
    '' => '카드사 없음'
];

// 바로빌 인증키
// const BAROBILL_KEY = 'ECC7F0FE-7089-4D1B-8204-F70EE61FAB56'; // 테스트
const BAROBILL_KEY = '98D43872-6E8F-4BD1-BA03-E0216746D644'; // 운영
// const BAROBILL_SERVER = 'https://testws.baroservice.com/'; // 테스트
const BAROBILL_SERVER = 'https://ws.baroservice.com/';		//실서비스용
const BAROBILL_ID = 'knn2424'; // 부산이사 아이디
const BAROBILL_PW = 'knn2424'; // 부산이사 비밀번호
const BAROBILL_CORP_NUM = '6171286279'; // 해밀 사업자번호
const BAROBILL_SMS = '0519041414'; // SMS 발신번호
const BAROBILL_KAKAO = '@부산이사몰';

function maskEntireString($string) {
    return str_repeat('*', strlen($string));
}