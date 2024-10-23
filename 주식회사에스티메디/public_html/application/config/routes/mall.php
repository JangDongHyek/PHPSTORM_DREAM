<?php
/**
 * 쇼핑몰 라우터
 */

// 메인
$route['index'] = 'MallMainController/index';

// 로그인
$route['login'] = 'MallAccountController/login';
// 로그아웃
$route['logout'] = 'MallAccountController/logout';
// 회원가입
$route['signUp'] = 'MallAccountController/signUp';
// 아이디,비밀번호찾기
$route['findAccount'] = 'MallAccountController/findAccount';
// 비밀번호 재설정
$route['resetPw'] = 'MallAccountController/resetPw';
// 내정보수정
$route['mypage'] = 'MallAccountController/myPage';

// 약재 목록
$route['medicinal'] = 'MallMedicinalController/medicinalList';
// 약재 목록 리뉴얼 241014
$route['medicinal2'] = 'MallMedicinalController/medicinalList2';
// 약재 목록
$route['medicinalSearch'] = 'MallMedicinalController/medicinalSearch';
// 동일성분 약품 목록
$route['medicinal_cons'] = 'MallMedicinalController/medicinalList_cons';
// 최근주문 상품목록
$route['medicinal_recent'] = 'MallMedicinalController/medicinalList_recent';

// 한방약재 상세
$route['medicinal/(:num)'] = 'MallMedicinalController/medicinalView/$1';

// 상품(기획전,건강환) 목록
$route['product'] = 'MallProductController/productList';
// 상품 상세
$route['product/(:num)'] = 'MallProductController/productView/$1';

// 장바구니
$route['cart'] = 'MallCartController/cart';

// 주문서
$route['orderSheet'] = 'MallOrderController/orderSheet';
// 주문배송조회
$route['order'] = 'MallOrderController/orderList';
// 주문배송조회 상세
$route['order/(:num)'] = 'MallOrderController/orderView/$1';

// 결제성공
$route['paymentSuccess'] = 'CommonPaymentController/paymentSuccess';
// 결제실패
$route['paymentFailed'] = 'CommonPaymentController/paymentFailed';

// 고객센터 목록
$route['board'] = 'MallBoardController/boardListPage';
// 고객센터 상세
$route['board/(:num)'] = 'MallBoardController/boardViewPage/$1';
// 고객센터 등록/수정
$route['boardForm'] = 'MallBoardController/boardFormPage';
$route['boardForm/(:num)'] = 'MallBoardController/boardFormPage/$1';

