<?php
/**
 * 관리자 POST API
 */

// 회원관리
// 등록/수정
$route['apiAdmin/registerMember']['post'] = 'AdmMemberController/postRegisterMember';
$route['apiAdmin/registerMember2']['post'] = 'AgencyMemberController/postRegisterMember';

//회원삭제
$route['apiAdmin/deleteMember']['post'] = 'AdmMemberController/postDeleteMember';

// 조회
// $route['apiAdmin/memberInfo/(:num)']['get'] = 'AdmMemberController/getMemberInfo/$1';
// 승인/승인취소
$route['apiAdmin/updateAuthMember']['post'] = 'AdmMemberController/postUpdateAuthMember';
//에이전시 업데이트
$route['apiAdmin/updateAgencyMember']['post'] = 'AgencyMemberController/postUpdateAgency';
// 미수업체 등록/해제
$route['apiAdmin/updateMisuMember']['post'] = 'AdmMemberController/postUpdateMisuMember';

// 관리자 정보수정
$route['apiAdmin/updateAdmInfo']['post'] = 'AdmMemberController/postUpdateAdminInfo';
// 회원 보험가적용 업데이트
$route['apiAdmin/updateMemberINSU']['post'] = 'AdmMemberController/postUpdateMemberINSU';


// 그룹관리
// 등록/수정
$route['apiAdmin/registerMemberGroup']['post'] = 'AdmMemberGroupController/postRegisterMemberGroup';
// 조회
$route['apiAdmin/memberGroupInfo/(:num)']['get'] = 'AdmMemberGroupController/getMemberGroupInfo/$1';
// 삭제
$route['apiAdmin/deleteMemberGroup']['post'] = 'AdmMemberGroupController/postDeleteMemberGroup';

// 상품관리
// 등록/수정
$route['apiAdmin/registerProduct']['post'] = 'AdmProductController/postRegisterProduct';
//상품번호 중복체크
$route['apiAdmin/postPRODUCT_CD']['post'] = 'AdmProductController/postPRODUCT_CD';
// 목록 일괄수정
$route['apiAdmin/updateProductList']['post'] = 'AdmProductController/postUpdateProductList';
// 삭제
$route['apiAdmin/deleteProduct']['post'] = 'AdmProductController/postDeleteProduct';
// 가져오기
$route['apiAdmin/getProductInfo']['post'] = 'AdmProductController/getProductInfo';
// 기본배송비설정
$route['apiAdmin/updateDeliveryFee']['post'] = 'AdmProductController/postUpdateDeliveryFee';

//API관련
// api access Token설정
$route['apiAdmin/updateApiAccessToken']['post'] = 'AdmProductController/postUpdateApiAccessToken';
// api Use Token설정
$route['apiAdmin/updateApiUseToken']['post'] = 'AdmProductController/postUpdateApiUseToken';
// api 상품목록불러오기
$route['apiAdmin/GetApiProductList']['post'] = 'AdmProductController/postGetApiProductList';
$route['apiAdmin/GetApiProductList']['get'] = 'AdmProductController/postGetApiProductList';


// 주문배송관리
// 배송정보수정
$route['apiAdmin/updateOrderRecipient']['post'] = 'AdmOrderController/postUpdateOrderRecipient';
// 목록 일괄수정
$route['apiAdmin/updateOrderList']['post'] = 'AdmOrderController/postUpdateOrderList';

// 미수관리
// 거래 등록/수정
$route['apiAdmin/registerMisu']['post'] = 'AdmMisuController/postRegisterMisu';
// 거래 조회
$route['apiAdmin/misuInfo/(:num)']['get'] = 'AdmMisuController/getMisuInfo/$1';
// 거래 삭제
$route['apiAdmin/deleteMisu']['post'] = 'AdmMisuController/postDeleteMisu';

// 팝업관리
// 등록/수정
$route['apiAdmin/registerPopup']['post'] = 'AdmPopupController/postRegisterPopup';
// 삭제
$route['apiAdmin/deletePopup']['post'] = 'AdmPopupController/postDeletePopup';