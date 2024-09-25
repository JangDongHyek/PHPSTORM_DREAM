<?php
/**
 * 관리자 라우터
 */
/** @var $routes */

//$routes->group('adm', ['filter' => 'admincheck'], static function ($routes) { // 관리자 권한 필터 추가
$routes->group('adm', static function ($routes) {
    // 메인
    $routes->get('/', 'adm\APublishController::index');
    // 관리자 정보
    $routes->get('admInfo', 'adm\APublishController::admInfo');
    // 서비스 이용자 관리
    $routes->get('member', 'adm\APublishController::member');
    // 서비스 이용자 관리 > 등록
    $routes->get('memberForm', 'adm\APublishController::memberForm');
    // 자주 묻는 질문
    $routes->get('faq', 'adm\APublishController::faq');
    // 자주 묻는 질문 > 등록
    $routes->get('faqForm', 'adm\APublishController::faqForm');
    // 1:1 문의
    $routes->get('qna', 'adm\APublishController::qna');
    // 1:1 문의 > 등록
    $routes->get('qnaView', 'adm\APublishController::qnaView');


});