<?php
/**
 * 헤더 헬퍼
 */
// 기본 헤더
if (!function_exists('getMallPageSettings')) {
    function getMallPageSettings($pid = ''): array
    {
        $header_type = 1;       // 헤더타입
        $footer_type = 1;       // 푸터타입
        $header_name = "";      // 상단페이지명
        $lnb_type = 0;      // 좌측메뉴 디자인
        $sub_type = 0;   //  상단메뉴명 디자인

        switch ($pid) {
            case "index" :
                $header_name = "전체 프로젝트 진행 현황";
                break;
            case "login" :
                $header_type = 0;
                $footer_type = 0;
                $header_name = "로그인";
                break;
            case "sign_up" :
                $header_type = 0;
                $footer_type = 0;
                $header_name = "서비스 가입";
                break;
            case "find_pw" :
                $header_type = 0;
                $footer_type = 0;
                $header_name = "아이디/비밀번호 찾기";
                break;
            case "mypage" :
                $header_name = "내 정보 관리";
                break;
            case "project" :
                $header_name = "프로젝트 관리";
                break;
            case "public_project" :
                $header_name = "회사 공개 프로젝트";
                break;
            case "employee" :
                $header_name = "직원 관리";
                break;
            case "overall" :
                $sub_type = 1;
                $header_name = "종합공정";
                break;
            case "schedule" :
                $sub_type = 1;
                $lnb_type = 1;
                $header_name = "계획공정표";
                break;
            case "schedule_weekly" :
                $sub_type = 1;
                $lnb_type = 1;
                $header_name = "주간공정표";
                break;
            case "week_task" :
                $sub_type = 1;
                $lnb_type = 1;
                $header_name = "금주작업";
                break;
            case "payment" :
                $sub_type = 1;
                $header_name = "기성관리";
                break;
            case "record" :
                $sub_type = 1;
                $lnb_type = 1;
                $header_name = "내역관리";
                break;
            case "invoice" :
                $sub_type = 1;
                $lnb_type = 1;
                $header_name = "내역관리";
                break;
            case "price_list" :
                $sub_type = 1;
                $lnb_type = 1;
                $header_name = "내역관리";
                break;
            case "account" :
                $sub_type = 1;
                $header_name = "담당자 계정관리";
                break;
            case "filebox" :
                $sub_type = 1;
                $header_name = "전체 파일함";
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
}

// 관리자 헤더
if (!function_exists('getAdmPageSettings')) {
    function getAdmPageSettings($pid = ''): array
    {
        $header_type = 1;       // 헤더타입
        $footer_type = 1;       // 푸터타입
        $header_name = "";      // 상단페이지명
        $lnb_type = 0;      // 좌측메뉴 디자인
        $sub_type = 0;   //  상단메뉴명 디자인

        switch ($pid) {
            case "adm_index" :
                $header_name = "관리 홈";
                break;
            case "adm_info" :
                $header_name = "관리자 정보";
                break;
            case "adm_member" :
                $header_name = "서비스 이용자 관리";
                break;
            case "adm_member_form" :
                $header_name = "서비스 이용자 관리";
                break;
            case "adm_faq" :
                $header_name = "자주 묻는 질문";
                break;
            case "adm_faq_form" :
                $header_name = "자주 묻는 질문";
                break;
            case "adm_qna" :
                $header_name = "1:1 문의";
                break;
            case "adm_qna_view" :
                $header_name = "1:1 문의";
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
}