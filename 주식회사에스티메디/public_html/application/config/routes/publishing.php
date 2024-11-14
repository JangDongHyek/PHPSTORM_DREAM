<?php
// 퍼블리싱 라우터
// uri : http://dreamforone.kr/~busandrugCi3/exam
// $route['url경로'] = '컨트롤러명/함수명';
// $route['resetPw'] = 'PublishController/resetPwPage';
$route['2'] = 'PublishController/index2Page';
$route['result'] = 'PublishController/resultPage';
$route['event'] = 'PublishController/eventPage';
$route['guide'] = 'PublishController/guidePage';
$route['privacy'] = 'PublishController/privacyPage';
$route['provision'] = 'PublishController/provisionPage';
$route['estimate'] = 'PublishController/estimate';
$route['estimateInput'] = 'PublishController/indexNoOrder';
$route['estimateView'] = 'PublishController/estimateView';
$route['estimatePrint'] = 'PublishController/estimatePrint';
// 약재 목록 리뉴얼 241014
$route['medicinal2'] = 'PublishController/medicinalList2';

//관리자
$route['admProduct'] = 'PublishController/admProductPage';
$route['admProductForm'] = 'PublishController/admProductFormPage';

