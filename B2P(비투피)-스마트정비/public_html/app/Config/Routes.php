<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// 로그인 로그아웃
$routes->addRedirect('', 'common/login');
$routes->get('/', 'LoginController::index');
$routes->get('common/login', 'LoginController::index');
$routes->get('common/logout', 'LoginController::logout');
$routes->post('common/login/authenticate', 'LoginController::authenticate');
$routes->cli('queueprocessor/(:any)', 'QueueProcessor::$1');

$routes->get('/api/resve/confirm','UserController::resveConfirm');
$routes->get('/api/maintenance/result','UserController::maintenanceReulst');

// 회원가입
$routes->group('signup', ['namespace' => '\App\Controllers'], static function ($routes) {
    $routes->get('seller', 'RegisterController::seller');
    $routes->get('corpSellerCheck', 'RegisterController::corpSellerCheck');
    $routes->get('selfCerti', 'RegisterController::selfCerti');
    $routes->get('regiAgr', 'RegisterController::regiAgr');
    $routes->get('kcpAgr', 'RegisterController::kcpAgr');
    $routes->get('infoBasic', 'RegisterController::infoBasic');
    $routes->get('infoSale', 'RegisterController::infoSale');
    $routes->get('infoSeller', 'RegisterController::infoSeller');
    $routes->get('infoAccount', 'RegisterController::infoAccount');
    $routes->get('signComp', 'RegisterController::signComp');

    // 회원가입 아작스
    $routes->post('chkCompanyNo', 'RegisterController::chkCompanyNo');
    $routes->post('chkCompanyHp', 'RegisterController::chkCompanyHp');
    $routes->post('chkSellerForm', 'RegisterController::chkSellerForm');
    $routes->post('chkBasicForm', 'RegisterController::chkBasicForm');
    $routes->post('chkMiniShop', 'RegisterController::chkMiniShop');
    $routes->post('chkAgreeForm', 'RegisterController::chkAgreeForm');
    $routes->post('chkDuplicateMbId', 'RegisterController::chkDuplicateMbId');
    $routes->post('chkAccountForm', 'RegisterController::chkAccountForm');
    $routes->post('registerMember', 'RegisterController::registerMember');
});

// 인증관련
$routes->group('auth', ['namespace' => '\App\Controllers'], static function ($routes) {
    // 본인인증
    $routes->get('psAuth', 'PsAuthController::psAuth');
    $routes->get('psAuthSuccess', 'PsAuthController::psAuthSuccess');
    $routes->get('psAuthFail', 'PsAuthController::psAuthFail');

    // 계좌인증
    $routes->post('chkBankAccount', 'PsAuthController::chkBankAccount');
});

// 회원관리
$routes->group('member', ['namespace' => '\App\Controllers' , 'filter' => 'auth::before'], static function ($routes) {
    $routes->get('list', 'MemberController::index');
    $routes->get('member_form', 'MemberController::member_form');
    $routes->post('member_form_update', 'MemberController::member_form_update');
    $routes->get('seller', 'MemberController::member_seller');
    $routes->get('sellerFee', 'MemberController::member_seller_fee');
    $routes->get('sellerView', 'MemberController::member_seller_view');
    $routes->get('sellerGoods', 'MemberController::member_seller_goods');
});

$routes->group('excel', ['namespace' => '\App\Controllers' , 'filter' => 'auth::before'], static function($routes){
    $routes->get('download/(:any)', 'ExcelController::download/$1');
    $routes->post('upload', 'ExcelController::upload');
    $routes->post('upload2', 'ExcelController::upload2');

    $routes->get('exportMemberListToExcel', 'ExcelController::exportMemberListToExcel');
});

// 제품관리
$routes->group('goods', ['namespace' => '\App\Controllers' , 'filter' => 'auth::before'], static function ($routes) {
    $routes->get('upload', 'GoodsController::goodsUpload');
    $routes->get('download', 'GoodsController::goodsDownload');
    $routes->get('/', 'GoodsController::goodsList');
    $routes->get('goods_form', 'GoodsController::goodsForm');
    $routes->get('goods_form2', 'GoodsController::goodsForm2');

    // 제품관리 아작스
    $routes->post('getCategory', 'GoodsController::getCategory');
    $routes->post('getGmAcCategory', 'GoodsController::getGmAcCategory');
    $routes->post('getItemOfficialNotice', 'GoodsController::getItemOfficialNotice');
    $routes->post('getDeliveryCompany', 'GoodsController::getDeliveryCompany');

    $routes->post('setGoods', 'GoodsController::setGoods');
    $routes->post('getGoods', 'GoodsController::getGoods');

    $routes->post('getDeliveryTmplIdList', 'GoodsController::getDeliveryTmplIdList');
    $routes->post('getBrand', 'GoodsController::getBrand');

    $routes->post('setGoodsBatch', 'GoodsController::setGoodsBatch');
});

$routes->group('goods', ['namespace' => '\App\Controllers'], static function ($routes) {
    // 엑셀업로드 후 크론작업
    $routes->get('cronExcelToDB', 'GoodsController::cronExcelToDB');
    $routes->get('cronDBToApi', 'GoodsController::cronDBToApi');
});

// 배송지 관리
$routes->group('delivery', ['namespace' => '\App\Controllers' , 'filter' => 'auth::before'], static function ($routes) {
    // 택배사코드 관리
    $routes->get('deliveryCode', 'DeliveryController::deliCompanyCode');

    // 주소록 관리
    $routes->get('addressList', 'DeliveryController::addressBookList');
    $routes->get('addressForm', 'DeliveryController::addressBookForm');

    // 주소록 관리 아작스
    $routes->post('getAddress', 'DeliveryController::getAddress');
    $routes->post('setAddress', 'DeliveryController::setAddress');

    //출고지관리
    $routes->get('placesList', 'DeliveryController::placesList');
    $routes->get('placesForm', 'DeliveryController::placesForm');

    //출고지관리 아작스
    $routes->post('setPlaces', 'DeliveryController::setPlaces');
    $routes->post('getPlaces', 'DeliveryController::getPlaces');

    //묶음배송비관리
    $routes->get('bundlePolicy', 'DeliveryController::bundlePolicyList');
    $routes->get('bundlePolicyForm', 'DeliveryController::bundlePolicyForm');

    //묶음배송비관리 아작스
    $routes->post('setBundlePolicy','DeliveryController::setBundlePolicy');
    $routes->post('getBundlePolicy','DeliveryController::getBundlePolicy');

    //발송정책 관리
    $routes->get('dispatchPolicy', 'DeliveryController::dispatchPolicyList');
    $routes->get('dispatchPolicyForm', 'DeliveryController::dispatchPolicyForm');

    //발송정책 아작스
    $routes->post('setDispatchPolicy', 'DeliveryController::setDispatchPolicy');
    $routes->get('getDispatchPolicy', 'DeliveryController::getDispatchPolicy');
});


// 관리자
$routes->group('admin', ['namespace' => '\App\Controllers' , 'filter' => 'auth::before'], static function ($routes) {
    $routes->get('manager01_01_list', 'AdminController::manager01_01_list');
    $routes->get('manager01_01_list', 'AdminController::manager01_01_list');
    $routes->get('manager01_01_write', 'AdminController::manager01_01_write');
    $routes->get('manager01_02_list', 'AdminController::manager01_02_list');
    $routes->get('manager01_02_write', 'AdminController::manager01_02_write');
    $routes->get('manager01_03_list', 'AdminController::manager01_03_list');

    // 재고관리
    $routes->get('manager_stock_list', 'AdminController::manager_stock_list');
    $routes->get('manager_stock_write', 'AdminController::manager_stock_write');

    // 판매관리
    $routes->get('sell_list', 'AdminController::sell_list');

    // 배송관리
    $routes->get('ship_list', 'AdminController::ship_list');

    /*
    $routes->get('cancel_list', 'AdminController::cancel_list');*/

    // 예약관리
    $routes->get('reserv', 'AdminController::reserv_list');

    // 정산리스트
    $routes->get('calcul_list', 'AdminController::calcul_list');

    // 공지사항
    $routes->get('notice', 'AdminController::notice_list');
    $routes->get('noticeWrite', 'AdminController::notice_write');

    // Q&A
    $routes->get('qna', 'AdminController::qna_list');
    $routes->get('qnaView', 'AdminController::qna_view');

    // 메시지관리
    $routes->get('msg', 'AdminController::msg_list');
    $routes->get('msgWrite', 'AdminController::msg_write');
    // LMS로그
    $routes->get('lms', 'AdminController::lms_log_list');


});

$routes->group('sticker', ['namespace' => '\App\Controllers' , 'filter' => 'auth::before'], static function ($routes) {
    // 스티커신청
    $routes->get('list', 'StickerController::stickerList');
    $routes->post('setSticker','StickerController::setSticker');
    $routes->post('setStickerShipInfo', 'StickerController::setStickerShipInfo');
    $routes->post('cancelSticker', 'StickerController::cancelSticker');

});



// 주문관리
$routes->group('order', ['namespace' => '\App\Controllers' , 'filter' => 'auth::before'], static function ($routes) {

    /*주문관리 24.06.04*/

    // 입금확인중
    $routes->get('waiting', 'AdminController::waiting_list');
    // 신규주문
    $routes->get('new', 'OrderController::Newlist');
    $routes->get('newExcelDown', 'OrderController::NewlistExcelDown');

    // 발송관리
    $routes->get('send', 'OrderController::Sendlist');
    $routes->get('sendExcelDown', 'OrderController::SendExcelDown');
    
    // 배송중완료
    $routes->get('deliver', 'OrderController::Deliverlist');
    $routes->get('deliverExcelDown', 'OrderController::DeliverExcelDown');

    // 구매결정완료
    $routes->get('confirm', 'OrderController::Confirmlist');
    $routes->get('confirmExcelDown', 'OrderController::ConfirmExcelDown');

    // 발송처리현황
    $routes->get('state', 'AdminController::state_list');


    $routes->get('cancel', 'OrderController::Cancellist');
    $routes->get('cancelExcelDown', 'OrderController::CancelExcelDown');
    // 발주서출력
    //$routes->get('order_print', 'AdminController::order_print');

    // 반품관리
    $routes->get('return', 'OrderController::Returnlist');
    $routes->get('returnExcelDown', 'OrderController::ReturnExcelDown');

    // 교환관리
    $routes->get('exchange', 'OrderController::Exchangelist');
    $routes->get('exchangeExcelDown', 'OrderController::ExchangeExcelDown');

    // 주문통합검색
    $routes->get('search', 'AdminController::order_search');
    
    //주문가져오기
    $routes->post('GetOrder', 'OrderController::GetOrderByIdx');
    $routes->get('GetOrder/(:num)', 'OrderController::GetOrderByIdx/$1');
    $routes->post('GetOrder2', 'OrderController::GetOrderByOrderNo');
    $routes->get('GetOrder2/(:num)', 'OrderController::GetOrderByOrderNo/$1');

    //정산 API 가져오기
    //$routes->get('GetCalc/(:num)', 'CalculateAPIController::checkAPI/$1');
    $routes->post('GetCalc/(:num)', 'OrderController::getCalc/$1');

    //Join주문가져오기
    $routes->post('GetJoinOrder', 'OrderController::GetJoinOrderByIdx');

    //주문가져오기
    $routes->post('OrderDeliProgress', 'OrderController::OrderDeliProgress');
    $routes->get('OrderDeliProgress/(:num)', 'OrderController::OrderDeliProgress/$1');


});

// 정산관리
$routes->group('calculate', ['namespace' => '\App\Controllers' , 'filter' => 'auth::before'], static function ($routes) {

    /*24.07.01*/
    // 옥션판매
    $routes->get('auction', 'CalculateController::auction_list');
    // 지마켓판매
    $routes->get('gmarket', 'CalculateController::gmarket_list');
    // 정산관리
    $routes->get('/', 'AdminController::calculate_view');
    // 정산관리 뷰페이지 관련 API
    $routes->post('/api/getData', 'CalculateAPIController::getData');
});

$routes->post('/api/calculate/getData', 'CalculateAPIController::getData');
$routes->get('/api/calculate/checkAPI', 'CalculateAPIController::checkAPI');

// 제조사
$routes->group('jejo', ['namespace' => '\App\Controllers' , 'filter' => 'auth::before'], static function ($routes) {
    // 정보관리
    $routes->get('member_list', 'JejoController::member_list');
    $routes->get('member_write', 'JejoController::member_write');

    // 제품관리
    $routes->get('manager_product_list', 'JejoController::manager_product_list');
    $routes->get('manager_product_write', 'JejoController::manager_product_write');

    // 재고관리
    $routes->get('manager_stock_list', 'JejoController::manager_stock_list');
    $routes->get('manager_stock_write', 'JejoController::manager_stock_write');

    // 판매관리
    $routes->get('sell_list', 'JejoController::sell_list');

    // 배송관리
    $routes->get('ship_list', 'JejoController::ship_list');

    // 구매변경/취소
    $routes->get('cancel_list', 'JejoController::cancel_list');

    // 공지사항
    $routes->get('notice_list', 'JejoController::notice_list');

    // qna
    $routes->get('qna_list', 'JejoController::qna_list');
    $routes->get('qna_view', 'JejoController::qna_view');
    $routes->get('qna_write', 'JejoController::qna_write');
});

// 정비업체
$routes->group('jungbi', ['namespace' => '\App\Controllers'], static function ($routes) {
    // 정보관리
    $routes->get('member_list', 'JungbiController::member_list');
    $routes->get('member_write', 'JungbiController::member_write');

    // 정산관리
    $routes->get('calcu_list', 'JungbiController::calcu_list');
    // 예약관리
    $routes->get('reserv_list', 'JungbiController::reserv_list');
    $routes->get('reserv_view', 'JungbiController::reserv_view');
    $routes->get('damaged_list', 'JungbiController::damaged_list');


    // 예약관리
    $routes->get('login', 'JungbiController::jungbi_login');
    $routes->get('logout', 'JungbiController::jungbi_logout');
    $routes->post('save_data', 'JungbiController::save_data');

    // 로그인체크
    $routes->post('login_check', 'JungbiController::login_check');

    // qna
    $routes->get('qna_list', 'JungbiController::qna_list');
    $routes->get('qna_view', 'JungbiController::qna_view');
    $routes->get('qna_write', 'JungbiController::qna_write');
});

// user
$routes->group('user', ['namespace' => '\App\Controllers'], static function ($routes) {
    $routes->get('', 'UserController::login');
    $routes->get('login', 'UserController::login');
    $routes->get('logout', 'UserController::logout');
    $routes->get('rvList', 'UserController::rv_list01');
    $routes->get('rvDone', 'UserController::rv_list02');
    $routes->get('rvWrite', 'UserController::rv_write');
    $routes->get('rvConfirm', 'UserController::rv_confirm');

    // 예약관리
    $routes->get('reserv', 'UserController::reserv_list', ['filter' => 'auth']);


    $routes->post('ajax_check_order', 'UserController::ajax_check_order');
    $routes->get('getStore', 'UserController::getStoreByRegionFromDb');
    $routes->get('getStoreFromApi', 'UserController::getStoreFromApi');
    $routes->post('getReservationDataFromApi', 'UserController::getReservationDataFromApi');
    $routes->post('saveReservation', 'UserController::saveReservation');
});

// 관리자
$routes->group('order', ['namespace' => '\App\Controllers' ], static function ($routes) {
    //주문 목록 가져오기
    $routes->get('GetOrder/(:segment)/(:segment)', 'OrderController::GetOrder/$1/$2');

    //정산 목록 가져오기
    $routes->get('GetSettleOrder/(:segment)', 'OrderController::GetSettleOrder/$1');

    //주문취소 목록 가져오기
    $routes->get('GetOrderCancel/(:segment)', 'OrderController::GetOrderCancel/$1');

    //주문반품 목록 가져오기
    $routes->get('GetOrderReturn/(:segment)/(:segment)', 'OrderController::GetOrderReturn/$1/$2');

    //주문교환 목록 가져오기
    $routes->get('GetOrderExchange/(:segment)/(:segment)', 'OrderController::GetOrderExchange/$1/$2');

    //주문확인
    $routes->get('OrderCheck/(:segment)', 'OrderController::OrderCheck/$1');
    $routes->post('OrderCheck', 'OrderController::OrderCheck');

    //취소처리
    $routes->get('OrderCancelCheck/(:segment)', 'OrderController::OrderCancelCheck/$1');
    $routes->post('OrderCancelCheck', 'OrderController::OrderCancelCheck');

    //판매취소
    $routes->get('OrderCancelSoldOut', 'OrderController::OrderCancelSoldOut');
    $routes->post('OrderCancelSoldOut', 'OrderController::OrderCancelSoldOut');

    //반품처리
    $routes->get('OrderReturnCheck/(:segment)', 'OrderController::OrderReturnCheck/$1');
    $routes->post('OrderReturnCheck', 'OrderController::OrderReturnCheck');

    //반품보류
    $routes->get('OrderReturnHold', 'OrderController::OrderReturnHold');
    $routes->post('OrderReturnHold', 'OrderController::OrderReturnHold');

    //판매자 직접 반품 신청
    $routes->get('OrderReturnSelf/(:segment)', 'OrderController::OrderReturnSelf/$1');
    $routes->post('OrderReturnSelf', 'OrderController::OrderReturnSelf');

    //옥션 거래완료 후 환불처리
    $routes->get('OrderAfterRemittanceBySeller/(:segment)', 'OrderController::OrderAfterRemittanceBySeller/$1');
    $routes->post('OrderAfterRemittanceBySeller', 'OrderController::OrderAfterRemittanceBySeller');

    //미수령신고조회
    $routes->get('GetClaimList/(:segment)', 'OrderController::GetClaimList/$1');

    //미수령신고 철회요청
    $routes->get('OrderClaimRelease/(:segment)', 'OrderController::OrderClaimRelease/$1');
    $routes->post('OrderClaimRelease', 'OrderController::OrderClaimRelease');

    //미수령신고조회 크론버전
    $routes->get('GetClaimList_cron', 'OrderController::GetClaimList_cron');

    //반품건 교환전환
    $routes->post('OrderReturnExchange', 'OrderController::OrderReturnExchange');
    $routes->get('OrderReturnExchange', 'OrderController::OrderReturnExchange');

    //반품처리
    $routes->get('OrderReturnCheck/(:segment)', 'OrderController::OrderReturnCheck/$1');
    $routes->post('OrderReturnCheck', 'OrderController::OrderReturnCheck');

    //배송예정일 등록
    $routes->post('OrderShippingExpectedDate', 'OrderController::OrderShippingExpectedDate');

    //발송처리
    $routes->post('OrderSend', 'OrderController::OrderSend');

    // 발주서출력
    $routes->post('OrderPrint', 'OrderController::OrderPrint');

    // 라벨인쇄
    $routes->get('OrderLabelPrint', 'OrderController::OrderLabelPrint');

    //발송정보일괄등록
    $routes->post('OrderSendExcelUpload', 'OrderController::OrderSendExcelUpload');

    //배송정보수정
    $routes->post('OrderDeliEdit', 'OrderController::OrderDeliEdit');

    //교환수거 송장등록
    $routes->post('OrderReturnDeliEdit', 'OrderController::OrderReturnDeliEdit');
    $routes->post('OrderExchangeDeliEdit', 'OrderController::OrderExchangeDeliEdit');

    //교환 수거완료 처리
    $routes->post('OrderExchangeDeliComplete', 'OrderController::OrderExchangeDeliComplete');
    $routes->get('OrderExchangeDeliComplete/(:segment)', 'OrderController::OrderExchangeDeliComplete/$1');

    //교환재발송 송장등록
    $routes->post('OrderExchangeReDeliEdit', 'OrderController::OrderExchangeReDeliEdit');
    $routes->get('OrderExchangeReDeliEdit', 'OrderController::OrderExchangeReDeliEdit');

    //교환재발송 배송완료
    $routes->post('OrderExchangeReDeliComplete', 'OrderController::OrderExchangeReDeliComplete');
    $routes->get('OrderExchangeReDeliComplete/(:segment)', 'OrderController::OrderExchangeReDeliComplete/$1');

    //교환보류
    $routes->post('OrderExchangeHold', 'OrderController::OrderExchangeHold');
    $routes->get('OrderExchangeHold', 'OrderController::OrderExchangeHold');

    //교환보류해제
    $routes->post('OrderExchangeHoldRelease', 'OrderController::OrderExchangeHoldRelease');
    $routes->get('OrderExchangeHoldRelease/(:segment)', 'OrderController::OrderExchangeHoldRelease/$1');

    //배송진행정보
    $routes->post('OrderDeliProgress', 'OrderController::OrderDeliProgress');

    //발송마감일 자동으로 지나면 상태변경
    //$routes->get('OrderSendTransDueDate', 'OrderController::OrderSendTransDueDate');
    
    //배송마감일 지나면 자동으로 구매결정완료 상태변경
    $routes->get('OrderDeliTransDueDate', 'OrderController::OrderDeliTransDueDate');
    
    //$routes->cli('message/(:segment)/(:segment)', 'OrderController::message/$1/$2');
});

// 결제관련
$routes->group('pay', ['namespace' => '\App\Controllers'], static function ($routes) {

    // 결제리스트
    $routes->get('OrderPayList', 'PayController::OrderPayList');

    $routes->get('', 'PayController::PayHub');
    $routes->get('test', 'PayController::Test');
    //배치키 발급받는곳
    $routes->get('OrderKeyMobile', 'PayController::OrderKeyMobile');
    $routes->post('OrderKeyMobile', 'PayController::OrderKeyMobile');
    $routes->get('OrderKeyApproval', 'PayController::OrderKeyApproval');
    $routes->post('OrderKeyApproval', 'PayController::OrderKeyApproval');
    $routes->get('OrderKeyMobilePop', 'PayController::OrderKeyMobilePop');
    $routes->post('OrderKeyMobilePop', 'PayController::OrderKeyMobilePop');
    $routes->get('OrderKeyMobileResult', 'PayController::OrderKeyMobileResult');
    $routes->post('OrderKeyMobileResult', 'PayController::OrderKeyMobileResult');

    //배치키로 결제하는곳
    $routes->get('OrderPay', 'PayController::OrderPay');
    $routes->post('OrderPay', 'PayController::OrderPay');
    $routes->get('OrderPayPop', 'PayController::OrderPayPop');
    $routes->post('OrderPayPop', 'PayController::OrderPayPop');
    $routes->get('OrderPayResult', 'PayController::OrderPayResult');
    $routes->post('OrderPayResult', 'PayController::OrderPayResult');
    $routes->get('OrderPayCancel', 'PayController::OrderPayCancel');
    $routes->post('OrderPayCancel', 'PayController::OrderPayCancel');
    $routes->get('OrderPayCancelPop', 'PayController::OrderPayCancelPop');
    $routes->post('OrderPayCancelPop', 'PayController::OrderPayCancelPop');

    //KCP 가상계좌 받는곳
    $routes->get('OrderVcnt', 'PayController::OrderVcnt');
    $routes->post('OrderVcnt', 'PayController::OrderVcnt');
    $routes->get('OrderVcntPop', 'PayController::OrderVcntPop');
    $routes->post('OrderVcntPop', 'PayController::OrderVcntPop');
    $routes->get('OrderVcntResult', 'PayController::OrderVcntResult');
    $routes->post('OrderVcntResult', 'PayController::OrderVcntResult');
    $routes->get('OrderVcntNoti', 'PayController::OrderVcntNoti');
    $routes->post('OrderVcntNoti', 'PayController::OrderVcntNoti');

    //KCP 가상계좌 취소하는곳
    $routes->get('OrderVcntCancle', 'PayController::OrderVcntCancle');
    $routes->post('OrderVcntCancle', 'PayController::OrderVcntCancle');
    $routes->get('OrderVcntCanclePop', 'PayController::OrderVcntCanclePop');
    $routes->post('OrderVcntCanclePop', 'PayController::OrderVcntCanclePop');
    $routes->get('OrderVcntCancleResult', 'PayController::OrderVcntCancleResult');
    $routes->post('OrderVcntCancleResult', 'PayController::OrderVcntCancleResult');

    //펌뱅킹 잔액확인
    $routes->get('GetFirmBalance', 'PayController::GetFirmBalance');
    $routes->post('GetFirmBalance', 'PayController::GetFirmBalance');
    //펌뱅킹 지급이체(송금)
    $routes->get('GetFirmTransfer', 'PayController::GetFirmTransfer');
    $routes->post('GetFirmTransfer', 'PayController::GetFirmTransfer');

    //매입요청 하는 곳
    $routes->get('OrderPerchase/(:segment)', 'PayController::OrderPerchase/$1');
    $routes->get('OrderPerchase', 'PayController::OrderPerchase');
    $routes->post('OrderPerchase', 'PayController::OrderPerchase');
    $routes->get('OrderPerchaseRequest', 'PayController::OrderPerchaseRequest');
    $routes->post('OrderPerchaseRequest', 'PayController::OrderPerchaseRequest');

    //kcp파일 업로드 하는곳
    $routes->get('OrderPerchaseUp/(:segment)', 'PayController::OrderPerchaseUp/$1');
    $routes->get('OrderPerchaseUp', 'PayController::OrderPerchaseUp');

    //kcp파일 다운로드 하는곳
    $routes->get('OrderPerchaseDown/(:segment)', 'PayController::OrderPerchaseDown/$1');
    $routes->get('OrderPerchaseDown', 'PayController::OrderPerchaseDown');
    
    //kcp파일 매입결과
    $routes->get('OrderPerchaseResult/(:segment)', 'PayController::OrderPerchaseResult/$1');
    $routes->get('OrderPerchaseResult', 'PayController::OrderPerchaseResult');

    //kcp파일리스트 보는곳
    $routes->get('OrderPerchaseKcpList/(:segment)', 'PayController::OrderPerchaseKcpList/$1');
    $routes->get('OrderPerchaseKcpList', 'PayController::OrderPerchaseKcpList');
    
    //주문 결제하는곳
    $routes->get('OrderPayAuto/(:segment)', 'PayController::OrderPayAuto/$1');

});

























//시안
$routes->get('sian/sian1', 'SianController::sian1');
$routes->get('sian/sian2', 'SianController::sian2');
$routes->get('sian/sian3', 'SianController::sian3');
$routes->get('sian/sian4', 'SianController::sian4');
$routes->get('sian/sian5', 'SianController::sian5');
$routes->get('sian/sian6', 'SianController::sian6');
$routes->get('sian/sian7', 'SianController::sian7');
$routes->get('sian/sian8', 'SianController::sian8');
$routes->get('sian/sian9', 'SianController::sian9');
$routes->get('sian/sian10', 'SianController::sian10');
$routes->get('sian/sian11', 'SianController::sian11');
$routes->get('sian/sian12', 'SianController::sian12');
$routes->get('sian/sian13', 'SianController::sian13');
$routes->get('sian/sian14', 'SianController::sian14');
$routes->get('sian/sian15', 'SianController::sian15');
$routes->get('sian/sian16', 'SianController::sian16');
$routes->get('sian/sian17', 'SianController::sian17');
$routes->get('sian/sian18', 'SianController::sian18');
$routes->get('sian/sian19', 'SianController::sian19');
$routes->get('sian/sian20', 'SianController::sian20');
$routes->get('sian/sian21', 'SianController::sian21');
$routes->get('sian/sian22', 'SianController::sian22');
$routes->get('sian/sian23', 'SianController::sian23');
$routes->get('sian/sian24', 'SianController::sian24');
$routes->get('sian/sian25', 'SianController::sian25');
$routes->get('sian/sian26', 'SianController::sian26');
$routes->get('sian/sian27', 'SianController::sian27');
$routes->get('sian/sian28', 'SianController::sian28');
$routes->get('sian/sian29', 'SianController::sian29');
$routes->get('sian/user_sian1', 'SianController::user_sian1');
$routes->get('sian/user_sian2', 'SianController::user_sian2');
$routes->get('sian/user_sian3', 'SianController::user_sian3');
$routes->get('sian/user_sian4', 'SianController::user_sian4');
$routes->get('sian/user_sian5', 'SianController::user_sian5');
$routes->get('sian/user_sian6', 'SianController::user_sian6');

service('auth')->routes($routes);
$routes->get('sian/user_sian7', 'SianController::user_sian7');