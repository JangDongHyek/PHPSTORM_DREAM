<?php

namespace App\Controllers\adm;

use App\Controllers\BaseController;

use App\Libraries\Jl;
use App\Libraries\JlModel;

class APublishController extends BaseController
{
    /**
     * 관리자페이지
     * 퍼블리싱 컨트롤러
     *
     */

    public $models = [];
    public $jl;
    public $jl_response = array("message" => ""); // BaseController 내 response 란 객체가 존재해 변수명 변경

    public function __construct() {
        $this->jl = new Jl();
        $this->models['user'] = new JlModel(array("table" => "user"));
        $this->models['board'] = new JlModel(array("table" => "board"));
    }

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
        //관리자를 제외한 모든 유저 카운트 조회
        $this->models['user']->where('level','0',"AND NOT");
        $all_users = $this->models['user']->count();


        $obj = $this->request->getGet();
        $page = $obj['page'] ? $obj['page'] : 1;
        $limit = 10;
        $this->models['user']->where('level','0',"AND NOT");
        if($obj['search_key1'] && $obj['search_value1']) $this->models['user']->where($obj['search_key1'],$obj['search_value1']);
        if($obj['search_key2'] && $obj['search_value2']) $this->models['user']->like($obj['search_key2'],$obj['search_value2']);
        $users = $this->models['user']->get(array(
            "page" => $page,
            "limit" => $limit
        ));

        $data = [
            'pid' => 'adm_member',
            'isAdmPage' => true,
            'jl' => $this->jl,
            "all_users" => $all_users,
            "users" => $users,
            "page" => $page
        ];

        return render('adm/member', $data);
    }

    // 서비스 이용자 관리
    public function memberForm() {
        //관리자를 제외한 모든 유저 카운트 조회
        $this->models['user']->where('level','0',"AND NOT");
        $all_users = $this->models['user']->count();

        $data = [
            'pid' => 'adm_member_form',
            'isAdmPage' => true,
            "all_users" => $all_users,
            "jl" => $this->jl,
        ];

        return render('adm/member_form', $data);
    }

    // 자주 묻는 질문
    public function faq() {

        $data = [
            'pid' => 'adm_faq',
            'isAdmPage' => true,
            "jl" => $this->jl
        ];

        return render('adm/faq', $data);
    }

    // 자주 묻는 질문 > 등록
    public function faqForm() {

        $data = [
            'pid' => 'adm_faq_form',
            'isAdmPage' => true,
            "jl" => $this->jl
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