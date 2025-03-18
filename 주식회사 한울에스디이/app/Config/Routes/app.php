<?php
/**
 * 일반 라우터
 */
/** @var $routes */

// 로그인
$routes->get("login", "app\PublishController::login");
$routes->get("test", "app\PublishController::test");
$routes->get("/" ,function() {
    return redirect()->to('app/index');
});

$routes->get("logout", "api\UserController::logout");

// 회원가입
$routes->get("signUp", "app\PublishController::signUp");
// 회원가입
$routes->get("findPw", "app\PublishController::findPw");

$routes->group('app', static function ($routes) {
    // 메인
    $routes->get('',function() {
        return redirect()->to('app/index');
    });
    $routes->get('index', 'app\PublishController::index');
    // 내정보 관리
    $routes->get('mypage', 'app\PublishController::mypage');
    // FAQ
    $routes->get('faq', 'app\PublishController::faq');
    // 1:1문의
    $routes->get('qna', 'app\PublishController::qna');
    // 1:1문의 > 상세
    $routes->get('qnaView', 'app\PublishController::qnaView');
    // 1:1문의 > 등록
    $routes->get('qnaForm', 'app\PublishController::qnaForm');
    
    // 프로젝트 관리
    $routes->get('project', 'app\PublishController::project');
    // 회사 공개 프로젝트
    $routes->get('publicProject', 'app\PublishController::publicProject');
    // 직원 관리
    $routes->get('employee', 'app\PublishController::employee');


    // 종합공정
    $routes->get('overall', 'app\PublishController::overall');
    // 작업관리 > 계획공정표
    $routes->get('schedule', 'app\PublishController::schedule');
    // 작업관리 > 계획공정표
    $routes->get('scheduleTest', 'app\PublishController::scheduleTest');
    // 작업관리 > 주간공정표
    $routes->get('scheduleWeekly', 'app\PublishController::scheduleWeekly');
    // 작업관리 > 금주작업
    $routes->get('weekTask', 'app\PublishController::weekTask');
    $routes->get('taskForm', 'app\PublishController::taskForm');
    // 구역관리
    $routes->get('zone', 'app\PublishController::zone');
    // 기성관리
    $routes->get('payment', 'app\PublishController::payment');
    // 내역관리 > 수량산출서
    $routes->get('record', 'app\PublishController::record');
    // 내역관리 > 내역서
    $routes->get('invoice', 'app\PublishController::invoice');
    // 내역관리 > 단가목록표
    $routes->get('priceAll', 'app\PublishController::priceAll');
    $routes->get('priceList', 'app\PublishController::priceList');
    // 계정관리
    $routes->get('account', 'app\PublishController::account');
    // 파일함
    $routes->get('filebox', 'app\PublishController::filebox');

    //테스트
    $routes->get('test', 'app\TestController::test');

    //로그아웃
    $routes->get("logout", "api\UserController::logout");
});