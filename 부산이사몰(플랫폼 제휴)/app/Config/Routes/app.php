<?php
/**
 * 앱 라우터
 * @var RouteCollection $routes
 */

$routes->get("logout", "_common\AccountController::logout");
// 메인
$routes->get("/", "app\HomeController::index");
/*$routes->get("/text", "app\HomeController::text");*/

// 로그인
$routes->get("login", "_common\AccountController::login", ['filter' => 'logoutcheck']);

// 회원가입
$routes->get("signUp", "_common\AccountController::signUp", ['filter' => 'logoutcheck']);

// 로그아웃
$routes->get("logout", "_common\AccountController::logout");

// 비밀번호찾기
$routes->get("findPw", "_common\AccountController::findPw");

// 이용약관
$routes->get("provision", "app\PublishController::provision");
// 개인정보처리방침
$routes->get("privacy", "app\PublishController::privacy");

// 접근권한 없음
$routes->get("accessDenied", "_common\ErrorController::accessDenied");


// 이사업체 목록
//$routes->get("company/(:alpha)", "app\CompanyController::company/$1");
$routes->get("company", "app\CompanyController::company");
// 이사업체 상세
$routes->get("companyView", "app\CompanyController::companyView");

// 홈서비스 목록
$routes->get("service", "app\PublishController::service");
// 홈서비스 상세
$routes->get("serviceView", "app\PublishController::serviceView");


// 기본게시판
$routes->get("board", "app\BoardController::board");
// 기본게시판 등록
$routes->get("boardForm", "app\BoardController::boardForm", ['filter' => 'logincheck']);
// 기본게시판 상세
$routes->get("boardView", "app\BoardController::boardView");

// FAQ게시판
$routes->get("faq", "app\BoardController::faq");
// FAQ게시판 등록
$routes->get("faqForm", "app\BoardController::faqForm");

// 광고문의
$routes->get("adGuide", "app\AdvertsController::adGuide", ['filter' => 'logincheck']);
// 광고가입 신청
$routes->get("adForm", "app\AdvertsController::adForm", ['filter' => 'logincheck']);


// 정보 관리
$routes->get("mypage", "app\MypageController::mypage",['filter' => 'logincheck'] );

// 일반회원 > 이사견적 신청
$routes->get("estimateForm", "app\EstimateController::estimateForm", ['filter' => 'logincheck']);
// 일반회원 > 나의 이사견적
$routes->get("estimateMy", "app\MypageController::estimateMy", ['filter' => 'logincheck']);
// 일반회원 > 관심 업체
$routes->get("wish", "app\PublishController::wish");


// 사업자 > 광고 정보
$routes->get("ad", "app\MypageController::ad",['filter' => 'logincheck']);
// 사업자 > 결제내역
$routes->get("adPayment", "app\MypageController::adPayment",['filter' => 'logincheck']);

// 사업자 > 전화연결 통계 서비스
$routes->get("callStat", "app\MypageController::callStat",['filter' => 'logincheck']);
// 사업자 > 이사견적 열람
$routes->get("estimate", "app\EstimateController::estimate",['filter' => 'logincheck']);


// 이사 계약시 유의사항
$routes->get("guideline", "app\PublishController::guideline");
// 이사전 체크리스트
$routes->get("checklist", "app\PublishController::checklist");
// 서비스 진행과정
$routes->get("process", "app\PublishController::process");
