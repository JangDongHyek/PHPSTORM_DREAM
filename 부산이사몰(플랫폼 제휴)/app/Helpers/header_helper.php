<?php
/**
 * 헤더 헬퍼
 */
// 앱 헤더
function getAppPageSettings($pid = ''): array
{
    $header_type = 1;       // 헤더타입
    $footer_type = 1;       // 푸터타입
    $header_name = "";      // 상단페이지명
    $lnb_type = 0;      // 좌측메뉴 디자인
    $sub_type = 1;   //  상단메뉴명 디자인

    switch ($pid) {
        case "app_index" :
            $header_name = "부산이사몰";
            $sub_type = 0;
            break;
        case "app_login" :
            $header_type = 0;
            $footer_type = 0;
            $header_name = "로그인";
            break;
        case "app_sign_up" :
            $header_type = 0;
            $footer_type = 0;
            $header_name = "신규 회원가입";
            break;
        case "app_find_pw" :
            $header_type = 0;
            $footer_type = 0;
            $header_name = "아이디/비밀번호 찾기";
            break;
        case "app_provision" :
            $header_name = "사이트 이용약관";
            break;
        case "app_privacy" :
            $header_name = "개인정보처리방침";
            break;
        case "app_company" :
            $header_name = "이사업체 목록";
            break;
        case "app_company_view" :
            $header_name = "이사업체 상세";
            break;
        case "app_service" :
            $header_name = "홈서비스 목록";
            break;
        case "app_service_view" :
            $header_name = "홈서비스 상세";
            break;

        case "app_board" :
            $header_name = "게시판";
            break;
        case "app_board_form" :
            $header_name = "게시판 글쓰기";
            break;
        case "app_board_view" :
            $header_name = "게시판 상세";
            break;
        case "app_faq" :
            $header_name = "FAQ";
            break;
        case "app_faq_form" :
            $header_name = "FAQ 글쓰기";
            break;

        case "app_ad_guide" :
            $header_name = "광고 문의";
            $sub_type = 0;
            break;

        case "app_ad_form" :
            $header_name = "광고 가입 신청";
            $sub_type = 0;
            break;

        case "app_mypage" :
            $header_name = "정보 관리";
            $lnb_type = 1;
            break;

        case "app_estimate_form" :
            $header_name = "이사견적 신청";
            $lnb_type = 1;
            break;

        case "app_estimate_my" :
            $header_name = "나의 이사견적";
            $lnb_type = 1;
            break;

        case "app_wish" :
            $header_name = "관심 업체";
            $lnb_type = 1;
            break;

        case "app_ad" :
            $header_name = "광고 정보";
            $lnb_type = 1;
            break;

        case "app_ad_payment" :
            $header_name = "결제 내역";
            $lnb_type = 1;
            break;

        case "app_call_stat" :
            $header_name = "전화연결 통계";
            $lnb_type = 1;
            break;

        case "app_estimate" :
            $header_name = "이사견적 열람";
            $lnb_type = 1;
            break;

        case "app_guideline" :
            $header_name = "이사 계약시 유의사항";
            break;

        case "app_checklist" :
            $header_name = "이사전 체크리스트";
            break;

        case "app_process" :
            $header_name = "서비스 진행과정";
            break; 
    }

    return [
        'header_type' => $header_type,
        'footer_type' => $footer_type,
        'header_name' => $header_name,
        'lnb_type' => $lnb_type,
        'sub_type' => $sub_type,
    ];
}

// 관리자 헤더
function getAdmPageSettings($pid = ''): array
{
    $header_type = 0;       // 헤더타입
    $footer_type = 0;       // 푸터타입
    $header_name = "";      // 상단페이지명
    $lnb_type = 0;      // 좌측메뉴 디자인
    $sub_type = 0;   //  상단메뉴명 디자인

    switch ($pid) {
        case 'adm_index' :
            $header_name = "관리자 메인";
            break;
        case 'adm_member' :
            $header_name = "회원 관리";
            break;
        case 'adm_member_form' :
            $header_name = "회원 등록";
            break;

        case 'adm_ad' :
            $header_name = "광고 신청 관리";
            break;

        case 'adm_ad_form' :
            $header_name = "광고 변경 및 결제";
            break;

        case 'adm_ad_payment' :
            $header_name = "결제 내역";
            break;

        case 'adm_company' :
            $header_name = "광고 현황 관리";
            break;
        case 'adm_company_form' :
            $header_name = "광고 현황 관리";
            break;

        case 'adm_service' :
            $header_name = "이사 홈서비스 관리";
            break;
        case 'adm_serviceform' :
            $header_name = "이사 홈서비스 관리";
            break;

        case 'adm_estimate' :
            $header_name = "견적신청 관리";
            break;

        case 'adm_banner' :
            $header_name = "광고배너 관리";
            break;

        case 'adm_banner_form' :
            $header_name = "광고배너 관리";
            break;

        case 'adm_callStat' :
            $header_name = "안심번호 통계";
            break;
        case 'adm_cs':
            $header_name = "CS 게시판";
            break;
        case 'adm_sms_service':
            $header_name = "문자 서비스";
            break;
        case 'adm_phone_book':
            $header_name = "연락처 관리";
            break;

    }

    return [
        'header_type' => $header_type,
        'footer_type' => $footer_type,
        'header_name' => $header_name,
        'lnb_type' => $lnb_type,
        'sub_type' => $sub_type,
    ];
}
