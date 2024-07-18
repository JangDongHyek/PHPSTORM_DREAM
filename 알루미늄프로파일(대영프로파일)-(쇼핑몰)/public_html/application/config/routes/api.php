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


//카테고리 등록
$route['api/category/postData']['post'] = 'CategoryController/postData';
//카테고리 수정
$route['api/category/putData']['post'] = 'CategoryController/putData';
//카테고리 리스트
$route['api/category/getsData']['post'] = 'CategoryController/getsData';
//카테고리 상세
$route['api/category/getData']['post'] = 'CategoryController/getData';
//카테고리 삭제
$route['api/category/deleteData']['post'] = 'CategoryController/deleteData';

//상품 api 가져오기
$route['api/product/getData']['post'] = 'AdmProductController/getData';
$route['api/product/getData2']['post'] = 'AdmProductController/getData2';

//상품 추가옵션
$route['api/addOption/getData']['post'] = 'AddOptionController/getData';
$route['api/addOption/postData']['post'] = 'AddOptionController/postData';
$route['api/addOption/putData']['post'] = 'AddOptionController/putData';
$route['api/addOption/deleteData']['post'] = 'AddOptionController/deleteData';
//상품 필수옵션
$route['api/essentialOption/getData']['post'] = 'EssentialOptionController/getData';
$route['api/essentialOption/postData']['post'] = 'EssentialOptionController/postData';
$route['api/essentialOption/putData']['post'] = 'EssentialOptionController/putData';
$route['api/essentialOption/deleteData']['post'] = 'EssentialOptionController/deleteData';
//상품 관련상품
$route['api/relatedProduct/getData']['post'] = 'RelatedProductController/getData';
$route['api/relatedProduct/getProduct']['post'] = 'RelatedProductController/getProduct';
$route['api/relatedProduct/postData']['post'] = 'RelatedProductController/postData';
$route['api/relatedProduct/putData']['post'] = 'RelatedProductController/putData';
$route['api/relatedProduct/deleteData']['post'] = 'RelatedProductController/deleteData';