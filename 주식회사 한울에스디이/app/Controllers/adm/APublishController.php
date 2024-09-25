<?php

namespace App\Controllers\adm;

use App\Controllers\BaseController;

class APublishController extends BaseController
{
    /**
     * 관리자페이지
     * 퍼블리싱 컨트롤러
     *
     */

    // 관리자 인덱스
    public function index() {

        $data = [
            'pid' => 'adm_index',
            'isAdmPage' => true,
        ];

        return render('adm/index', $data);
    }

    // 관리자정보
    public function admInfo() {

        $data = [
            'pid' => 'adm_info',
            'isAdmPage' => true,
        ];

        return render('adm/adm_info', $data);
    }

    // 서비스 이용자 관리
    public function member() {

        $data = [
            'pid' => 'adm_member',
            'isAdmPage' => true,
        ];

        return render('adm/member', $data);
    }

    // 서비스 이용자 관리
    public function memberForm() {

        $data = [
            'pid' => 'adm_member_form',
            'isAdmPage' => true,
        ];

        return render('adm/member_form', $data);
    }

    // 자주 묻는 질문
    public function faq() {

        $data = [
            'pid' => 'adm_faq',
            'isAdmPage' => true,
        ];

        return render('adm/faq', $data);
    }

    // 자주 묻는 질문 > 등록
    public function faqForm() {

        $data = [
            'pid' => 'adm_faq_form',
            'isAdmPage' => true,
        ];

        return render('adm/faq_form', $data);
    }

    // 1:1 문의
    public function qna() {

        $data = [
            'pid' => 'adm_qna',
            'isAdmPage' => true,
        ];

        return render('adm/qna', $data);
    }

    // 1:1 문의 > 등록
    public function qnaView() {

        $data = [
            'pid' => 'adm_qna_view',
            'isAdmPage' => true,
        ];

        return render('adm/qna_view', $data);
    }



}