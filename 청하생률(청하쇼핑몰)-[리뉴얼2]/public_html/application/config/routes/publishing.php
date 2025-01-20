<?php
// 퍼블리싱 라우터
// uri : http://dreamforone.kr/~juchungha3/exam
// $route['url경로'] = '컨트롤러명/함수명';
// $route['resetPw'] = 'PublishController/resetPwPage';
$route['event'] = 'PublishController/eventPage';
$route['greet'] = 'PublishController/greetPage';
$route['guide'] = 'PublishController/guidePage';
$route['privacy'] = 'PublishController/privacyPage';
$route['provision'] = 'PublishController/provisionPage';
//관리자
// $route['admIndex'] = 'PublishController/admIndexPage';
// $route['admMember'] = 'PublishController/admMemberPage';
// $route['admMemberForm'] = 'PublishController/admMemberFormPage';
// $route['admGroup'] = 'PublishController/admGroupPage';
$route['admProduct'] = 'PublishController/admProductPage';
$route['admProductForm'] = 'PublishController/admProductFormPage';
// $route['admOrder'] = 'PublishController/admOrderPage';
// $route['admOrderView'] = 'PublishController/admOrderViewPage';
// $route['admMisu'] = 'PublishController/admMisuPage';
// $route['admMisuDetail'] = 'PublishController/admMisuDetailPage';
// $route['admPopup'] = 'PublishController/admPopupPage';
// $route['admPopupForm'] = 'PublishController/admPopupFormPage';
