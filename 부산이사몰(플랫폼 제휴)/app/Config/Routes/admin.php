<?php
/**
 * 관리자 라우터
 * @var RouteCollection $routes
 */

$routes->group('adm', ['filter' => 'admincheck'], static function ($routes) { // ['filter' => 'admincheck']
    // 메인
    $routes->get('/', 'adm\APublishController::index');

    //회원 관리
    $routes->get('member', 'adm\AMemberController::member');

    //회원 상세/등록
    $routes->get('memberForm/(:num)?', 'adm\AMemberController::memberForm/$1');
    $routes->get('memberForm', 'adm\AMemberController::memberForm');


    //광고신청 관리
    $routes->get('ad', 'adm\AAdvertsController::ad');
    //광고 변경 및 결제
    $routes->get('adForm', 'adm\AAdvertsController::adForm');
    //광고 결제 내역
    $routes->get('adPayment', 'adm\APaymentController::adPayment');


    //이사업체 관리
    $routes->get('company', 'adm\ACompanyController::company');
    //이사업체 등록
    $routes->get('companyForm/(:num)', 'adm\ACompanyController::companyForm/$1');

    //전화 연결 통계
    $routes->get('callStat', 'adm\ACompanyController::callStat');

    //이사 홈서비스 관리
    $routes->get('service', 'adm\APublishController::service');
    //이사 홈서비스 등록
    $routes->get('serviceForm', 'adm\APublishController::serviceForm');

    //견적신청관리
    $routes->get('estimate', 'adm\AEstimateController::estimate');

    //광고 배너 관리
    $routes->get('banner', 'adm\APublishController::banner');
    //광고 배너 등록
    $routes->get('bannerForm', 'adm\APublishController::bannerForm');

    //문자서비스
    $routes->get('smsService', 'adm\ASmsController::smsService');
    //연락처관리
    $routes->get('phoneBook', 'adm\ASmsController::phoneBook');

    // cs게시판 등록/수정
    $routes->get('csForm','adm\ABoardController::csForm');

    // cs게시판 목록
    $routes->get('cs','adm\ABoardController::cs');

    // cs게시판 상세
    $routes->get('csView','adm\ABoardController::csView');

});