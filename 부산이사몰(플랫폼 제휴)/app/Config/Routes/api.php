<?php
/**
 * POST API
 * - 공통 api
 * @var RouteCollection $routes
 */

$routes->group('api', function ($routes) {
    // 에러로그 저장
    $routes->post('logError', '_common\ErrorController::saveFrontLogError');

    // 아이디 중복확인
    $routes->post('checkId', '_common\AccountController::postCheckId');

    // 회원가입 처리
    $routes->post('signUp', '_common\AccountController::postSignUp');

    //회원수정 처리
    $routes->post('signUpload', '_common\AccountController::postSignUpload');

    //회원 승인 상태값 변경
    $routes->post('addReport', '_common\AccountController::addReportPost');

    // 일반 로그인
    $routes->post('signIn', '_common\AccountController::postLogin');

    // 지역(시/구) 조회
    $routes->post('searchArea', '_common\AccountController::postSearchArea');

    //업체 등록
    $routes->post('companyUp', '_common\AccountController::postcompanyUp');

    //업체 수정
    $routes->post('companyUpdate', '_common\AccountController::postCompanyUpdate');

    //업체 삭제
    $routes->post('deleteCompany', '_common\AccountController::deleteCompany');

    //이사견적 신청
    $routes->post('estimate', '_common\AccountController::postEstimate');

    //견적신청 관리 승인/취소
    $routes->post('changeAuth', '_common\AccountController::postChangeAuth');

    //이사견적 상태 변경
    $routes->post('estimateAuth', '_common\AccountController::postEstimateAuth');

    //회원정보 수정
    $routes->post('myupload', '_common\AccountController::postMyupload');

    //게시글 등록
    $routes->post('registerBoard', 'app\BoardController::postregisterBoard');

    //게시글 삭제
    $routes->post('boardDel', 'app\BoardController::postBoardDel');

    //이사업체 복사(지영변경)
    $routes->post('companyAddition', 'adm\ACompanyController::postCompanyAddition');

    //게시판 답글 등록
    $routes->post('commentUpload', 'app\BoardController::postCommentUpload');

    //faq 등록
    $routes->post('faqUpload', 'app\BoardController::postFaqUpload');

    //faq 삭제
    $routes->post('faqDelete', 'app\BoardController::postFaqDelete');

    //광고 신청
    $routes->post('advertsUpload', 'app\AdvertsController::postAdvertsUpload');

    //관리자 광고 신청 관리 결제일 변경
    $routes->post('nextPayAtChange', 'adm\AAdvertsController::postNextPayAtChange');

    // 관리자 관고 변경 및 결제
    $routes->post('advertsUpgrade', 'adm\AAdvertsController::postAdvertsUpgrade');

    //관리자 결제 취소
    $routes->post('payRevoke', 'adm\APaymentController::postPayRevoke');

    //카드 확인 결제시 카드가 등록 되어있는지
    $routes->post('cardEnrolment', 'app\MypageController::postCardEnrolment');

    //결제 조회(이사젼적 열람)
    $routes->post('hpOrderByIdx', 'app\MypageController::postHpOrderByIdx');

    //아이디 찾기
    $routes->post('getUserFindId', '_common\AccountController::postGetUserFindId');

    //휴대폰 인증
    $routes->post('getUserFindPass', '_common\AccountController::postGetUserFindPass');

    //비밀번호 찾기
    $routes->post('getAuthenticateUser', '_common\AccountController::postGetAuthenticateUser');

    //비밀번호 변경
    $routes->post('updatePassword', '_common\AccountController::postUpdatePassword');

    // 네아로: 로그인 요청
    $routes->get('snsLogin/naver', '_common\NaverAuthController::naverLogin');

    // 네아로: 콜백
    $routes->get('loginCallback/naver', '_common\NaverAuthController::loginCallback');

    // 네아로: 접속토큰 발급요청 콜백
    $routes->get('tokenCallback/naver', '_common\NaverAuthController::tokenCallback');

    // 결제 정보 수정
    $routes->post('changeCardNum', 'adm\AAdvertsController::postChangeCardNum');

    // 카카오 로그인
    $routes->get('snsLogin/kakao', '_common\KakaoAuthController::kakaoLogin');

    // 카카오 콜백
    $routes->get('loginCallback/kakao', '_common\KakaoAuthController::loginCallback');

    //회원 탈퇴
    $routes->post('userSecession', '_common\AccountController::postUserSecession');

    // 연락처 관리 - > 추가
    $routes->post('contactInsert', 'adm\ASmsController::postContactInsert');

    // 문자 대량전송 or MMS
    $routes->post("baro/sendMessages", "_common\BaroController::postSendMessages");

    // 문자 수신자 내역
    $routes->post('recipientList', "adm\ASmsController::postRecipientList");

    //CS 게시판 삭제
    $routes->post('csDeletUpload', 'adm\ABoardController::postCsDeletUpload');

    //CS 게시판 진행 상태  변경
    $routes->post('changeCsStatus', 'adm\ABoardController::postChangeCsStatus');
});