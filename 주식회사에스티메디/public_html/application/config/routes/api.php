<?php
/**
 * POST API
 */

// 회원가입
$route['api/signUp']['post'] = 'MallAccountController/postSignUp';
// 로그인
$route['api/signIn']['post'] = 'MallAccountController/postLogin';
// 아이디 찾기
$route['api/findId']['post'] = 'MallAccountController/postFindId';
// 비밀번호 찾기
$route['api/findPw']['post'] = 'MallAccountController/postFindPw';

// 주문서 작성 (결제전 임시저장)
$route['api/addProductOrder']['post'] = 'MallOrderController/postAddProductOrder';

// 상품 정보
$route['api/getProductInfo/(:num)']['get'] = 'MallMedicinalController/getProductInfo/$1';
// 상품정보 제품코드로
$route['api/getProductInfoPRODUCT_CD/(:num)']['get'] = 'MallMedicinalController/getProductInfoPRODUCT_CD/$1';

// 주문상품 정보 보내기 WC
$route['api/postApiOrder/(:num)']['get'] = 'MallMedicinalController/postApiOrder/$1';
$route['api/postApiOrder']['post'] = 'MallMedicinalController/postApiOrder';

// 주문정보 확인 WC
$route['api/postApiOrderCheck/(:num)']['get'] = 'MallMedicinalController/postApiOrderCheck/$1';
$route['api/getProductInfoAPIPRODUCT_CD']['post'] = 'MallMedicinalController/getProductInfoAPIPRODUCT_CD';
$route['api/getProductInfoAPIPRODUCT_CD/(:num)']['get'] = 'MallMedicinalController/getProductInfoAPIPRODUCT_CD/$1';
$route['api/postApiOrderCheck']['post'] = 'MallMedicinalController/postApiOrderCheck';

// 상품 상품후기/상품문의 목록
$route['api/getProductBoardList']['get'] = 'MallMedicinalController/getProductBoardList';

//후기 게시물등록후 리스트 wc
$route['api/getProductBoardList2']['get'] = 'MallMedicinalController/getProductBoardList2';

// 상품 상품후기/상품문의 상세
$route['api/getProductBoardInfo/(:any)/(:num)']['get'] = 'MallMedicinalController/getProductBoardInfo/$1/$2';

// 추가배송비 wc
$route['api/addSendCost2']['post'] = 'MallCartController/postSendCost2';

// 상품 장바구니 등록
$route['api/addCart']['post'] = 'MallCartController/postAddCart';
// 상품 장바구니 수량 업데이트
$route['api/updateCartOption']['post'] = 'MallCartController/postUpdateCartOption';
// 상품 장바구니 삭제
$route['api/deleteCart']['post'] = 'MallCartController/postDeleteCart';

// 이노페이 결제요청 결과
$route['api/returnIPay']['get'] = 'CommonPaymentController/responseInnoPay';

// 게시글 등록
$route['api/registerBoard']['post'] = 'MallBoardController/postRegisterBoard';
// 게시글 삭제
$route['api/deleteBoard']['post'] = 'MallBoardController/postDeleteBoard';
// 게시판 코멘트 등록/수정
$route['api/registerComment']['post'] = 'MallBoardController/postRegisterBoardComment';
// 게시판 코멘트 삭제
$route['api/deleteComment']['post'] = 'MallBoardController/postDeleteBoardComment';


$route['api/bs_comparative']['post'] = 'BsComparativeController/method';
$route['api/bs_product']['post'] = 'BsProductController/method';