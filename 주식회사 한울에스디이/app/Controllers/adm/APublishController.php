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
        $this->models['board_reply'] = new JlModel(array("table" => "board_reply"));
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
        $session = session();
        $admin = $session->get("admin");

        $data = [
            'pid' => 'adm_info',
            'isAdmPage' => true,
            'jl' => $this->jl,
            'admin' => $admin,
        ];

        return render('adm/adm_info', $data);
    }

    // 서비스 이용자 관리
    public function member() {
        //관리자를 제외한 모든 유저 및 회원의직원 제외 카운트 조회
        $this->models['user']->where('level','0',"AND NOT");
        $this->models['user']->where('parent','jl_null');
        $all_users = $this->models['user']->count();


        $obj = $this->request->getGet();
        $page = $obj['page'] ? $obj['page'] : 1;
        $limit = 10;
        $this->models['user']->where('level','0',"AND NOT");
        $this->models['user']->where('parent','jl_null');
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
        $this->models['user']->where('parent','jl_null');
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
        $obj = $this->request->getGet();

        $page = $obj['page'] ? $obj['page'] : 1;
        $limit = 10;

        $this->models['board']->where("code","faq");

        if($obj['search_key1'] && $obj['search_value1']) $this->models['board']->where($obj['search_key1'],$obj['search_value1']);
        if($obj['search_value2']) {
            $this->models['board']->groupStart();
            $this->models['board']->like('title',$obj['search_value2']);
            $this->models['board']->like('content',$obj['search_value2'],"OR");
            $this->models['board']->groupEnd();
        }

        $board = $this->models['board']->get(array(
            "page" => $page,
            "limit" => $limit,
            "sql" => true,
        ));

        $data = [
            'pid' => 'adm_faq',
            'isAdmPage' => true,
            "jl" => $this->jl,
            "board" => $board,
            "page" => $page,
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
        $obj = $this->request->getGet();

        $page = $obj['page'] ? $obj['page'] : 1;
        $limit = 10;

        $this->models['board']->where("code","qna");

        if($obj['search_key1'] && $obj['search_value1']) $this->models['board']->where($obj['search_key1'],$obj['search_value1']);

        if($obj['search_key2'] && $obj['search_value2']) {
            if($obj['search_key2'] == 'user_id') {
                $this->models["board"]->join("user","user_idx","idx");
                $this->models["board"]->like("user_id",$obj['search_value2'],"AND","user");
            }else {
                $this->models['board']->like($obj['search_key2'],$obj['search_value2']);
            }
        }

        $board = $this->models['board']->get(array(
            "page" => $page,
            "limit" => $limit,
            "sql" => true,
        ));

        foreach ($board['data'] as $index => $data) {
            $this->models['user']->where($this->models['user']->primary, $data['user_idx']);
            $join_data = $this->models['user']->get()['data'][0];

            //Join시 변수명은 무조건 대문자로 진행 데이터 업데이트시 문제발생함 대문자 필드 삭제 처리는 JS에 있음
            $board["data"][$index][strtoupper("user")] = $join_data;
        }


        $data = [
            'pid' => 'adm_qna',
            'isAdmPage' => true,
            "jl" => $this->jl,
            "board" => $board,
            "page" => $page,
        ];

        return render('adm/qna', $data);
    }

    // 1:1 문의 > 등록
    public function qnaView() {
        $session = session();
        $user = $session->get("user");

        $obj = $this->request->getGet();
        $this->models['board']->where($obj);
        $board = $this->models['board']->get()['data'][0];


        if($board) {
            $board['USER'] = $this->models['user']->where('idx',$board['user_idx'])->get()['data'][0];
            $board['REPLY'] = $this->models['board_reply']->where('board_idx',$board['idx'])->orderBy("insert_date","ASC")->get();

            foreach ($board['REPLY']['data'] as $index => $data) {
                $this->models['user']->where($this->models['user']->primary, $data['user_idx']);
                $join_data = $this->models['user']->get()['data'][0];

                //Join시 변수명은 무조건 대문자로 진행 데이터 업데이트시 문제발생함 대문자 필드 삭제 처리는 JS에 있음
                $board['REPLY']["data"][$index][strtoupper("user")] = $join_data;
            }
        }else {
            $this->jl->error("잘못된 접근입니다.");
        }

        $data = [
            'pid' => 'adm_qna_view',
            'isAdmPage' => true,
            "jl" => $this->jl,
            "board" => $board,
            "user" => $user
        ];

        return render('adm/qna_view', $data);
    }



}