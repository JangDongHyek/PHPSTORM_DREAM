<?php
/**
 * 에이전시 라우터
 */
// 인덱스
//$route['agency'] = 'PublishController/agencyIndexPage';
//$route['agency/index'] = 'PublishController/agencyIndexPage';
//$route['agency'] = 'AgencyMemberController/agencyMember';
//$route['agency/index'] = 'AgencyMemberController/agencyMember';

//$route['agency'] = 'AgencyMemberController/agencyIndexPage';
// 회원관리 등록/수정 폼

$route['agency'] = 'AgencyMemberController/agencyMember';
$route['agency/agencyMemberForm'] = 'AgencyMemberController/AgencyMemberForm';
$route['agency/agencyMemberForm/(:num)']['get'] = 'AgencyMemberController/AgencyMemberForm/$1';
$route['agency/postSearchMember'] = 'AgencyMemberController/postSearchMember';
$route['agency/postConnectMember'] = 'AgencyMemberController/postConnectMember';
$route['agency/getAgencyMember'] = 'AgencyMemberController/getAgencyMember';
$route['agency/account'] = 'AgencyMemberController/agencyAccount';
//$route['agency/list'] = 'PublishController/agencyList';
$route['agency/list'] = 'AgencyMemberController/agencyConnectMember';

$route['agency/setAgencyFee'] = 'AdmProductController/setAgencyFee';
$route['agency/getAgencyFee'] = 'AdmProductController/getAgencyFee';
