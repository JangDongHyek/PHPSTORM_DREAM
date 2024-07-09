<?php
/**
 * 관리자 라우터
 */
// 인덱스
$route['adm'] = 'PublishController/admIndexPage';
$route['adm/index'] = 'PublishController/admIndexPage';

// 회원관리 목록
$route['adm/member'] = 'AdmMemberController/admMember';
// 회원관리 등록/수정 폼
$route['adm/memberForm'] = 'AdmMemberController/admMemberForm';
$route['adm/memberForm/(:num)']['get'] = 'AdmMemberController/admMemberForm/$1';

// 그룹관리 목록
$route['adm/memberGroup'] = 'AdmMemberGroupController/admMemberGroup';

// 카테고리관리 목록
$route['adm/category'] = 'AdmCategoryController/admCategory';
// 카테고리관리 등록
$route['adm/categoryForm'] = 'AdmCategoryController/admCategoryForm';

// 상품관리 목록
$route['adm/product'] = 'AdmProductController/admProduct';
// 상품관리 등록
$route['adm/productForm'] = 'AdmProductController/admProductForm';
$route['adm/productForm/(:num)']['get'] = 'AdmProductController/admProductForm/$1';

// 주문배송관리 목록
$route['adm/order'] = 'AdmOrderController/admOrder';
// 주문배송관리 상세
$route['adm/order/(:num)'] = 'AdmOrderController/admOrderView/$1';

// 미수관리 목록
$route['adm/misu'] = 'AdmMisuController/admMisuPage';
$route['adm/misu/(:num)']['get'] = 'AdmMisuController/admMisuDetailPage/$1';

//팝업관리 목록
$route['adm/popup'] = 'AdmPopupController/admPopup';
$route['adm/popupForm'] = 'AdmPopupController/admPopupForm';
$route['adm/popupForm/(:num)'] = 'AdmPopupController/admPopupForm/$1';