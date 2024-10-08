<?php
namespace App\Libraries;
namespace App\Controllers\app;

use App\Controllers\BaseController;

use App\Libraries\Jl;
use App\Libraries\JlModel;
class PublishController extends BaseController
{
    /**
     * 퍼블리싱 컨트롤러
     *
     */

    public $models = [];
    public $jl;
    public $jl_response = array("message" => ""); // BaseController 내 response 란 객체가 존재해 변수명 변경

    public function __construct() {
        $this->jl = new Jl();
        $this->models['board'] = new JlModel(array("table" => "board"));
        $this->models['board_reply'] = new JlModel(array("table" => "board_reply"));
        $this->models['user'] = new JlModel(array("table" => "user"));
        $this->models['project_base'] = new JlModel(array("table" => "project_base"));
    }

    // 메인
    public function index(): string
    {
        $data = [
            'pid' => 'index',
        ];

        return render('app/index', $data);
    }

    // 로그인
    public function login(): string
    {
        $data = [
            'pid' => 'login',
            "jl" => $this->jl,
        ];

        return render('/login', $data);
    }

    // 회원가입
    public function signUp(): string
    {
        $data = [
            'pid' => 'sign_up',
            "jl" => $this->jl,
        ];

        return render('app/sign_up', $data);
    }

    // 아이디비밀번호 찾기
    public function findPw(): string
    {
        $data = [
            'pid' => 'find_pw',
        ];

        return render('app/find_pw', $data);
    }

    // 내정보 관리
    public function mypage(): string
    {
        $session = session();
        $user = $session->get('user');

        $data = [
            'pid' => 'mypage',
            "jl" => $this->jl,
            "user" => $user,
        ];

        return render('app/mypage', $data);
    }

    // FAQ
    public function faq(): string
    {
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
            'pid' => 'faq',
            "jl" => $this->jl,
            "board" => $board,
            "page" => $page,
        ];

        return render('app/faq', $data);
    }

    // 1:1문의
    public function qna(): string
    {
        $session = session();
        $user = $session->get('user');

        $obj = $this->request->getGet();

        $page = $obj['page'] ? $obj['page'] : 1;
        $limit = 10;

        $this->models['board']->where("code","qna");
        $this->models['board']->where("user_idx",$user['idx']);

        $board = $this->models['board']->get(array(
            "page" => $page,
            "limit" => $limit,
            "sql" => true,
        ));

        $data = [
            'pid' => 'qna',
            "jl" => $this->jl,
            "board" => $board,
            "page" => $page,
        ];

        return render('app/qna', $data);
    }

    // 1:1문의 > 상세
    public function qnaView(): string
    {
        $session = session();
        $user = $session->get("user");

        $obj = $this->request->getGet();
        $this->models['board']->where($obj);
        $board = $this->models['board']->get()['data'][0];


        if($board) {
            $board['USER'] = $this->models['user']->where('idx',$board['user_idx'])->get()['data'][0];
            $board['REPLY'] = $this->models['board_reply']->where('board_idx',$board['idx'])->get();

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
            'pid' => 'qna_view',
            "jl" => $this->jl,
            "board" => $board,
            "user" => $user
        ];

        return render('app/qna_view', $data);
    }

    // 1:1문의 > 등록
    public function qnaForm(): string
    {
        $data = [
            'pid' => 'qna_form',
            "jl" => $this->jl,
        ];

        return render('app/qna_form', $data);
    }



    // 프로젝트 관리
    public function project(): string
    {
        $session = session();
        $user = $session->get("user");

        $user_idx = $user['parent'] ? $user['parent'] : $user['idx'];
        $obj = $this->request->getGet();

        $this->models['project_base']->where("user_idx",$user_idx);

        if($obj['search_key'] && $obj['search_value']) $this->models['project_base']->like($obj['search_key'],$obj['search_value']);

        if($obj['start_between'] && $obj['end_between']) {
            $this->models['project_base']->groupStart();
            $this->models['project_base']->between("start_date",$obj['start_between'],$obj['end_between']);
            $this->models['project_base']->between("end_date",$obj['start_between'],$obj['end_between'],"OR");
            $this->models['project_base']->groupEnd();
        }

        $page = $obj['page'] ? $obj['page'] : 1;
        $limit = 10;

        $projects = $this->models['project_base']->get(array(
            "page" => $page,
            "limit" => $limit
        ));


        $data = [
            'pid' => 'project',
            "jl" => $this->jl,
            "user" => $user,
            "page" => $page,
            "projects" => $projects
        ];

        return render('app/project', $data);
    }

    // 회사 공개 프로젝트
    public function publicProject(): string
    {
        $data = [
            'pid' => 'public_project',
        ];

        return render('app/public_project', $data);
    }

    // 직원관리
    public function employee(): string
    {
        $session = session();
        $user = $session->get("user");

        $obj = $this->request->getGet();

        $page = $obj['page'] ? $obj['page'] : 1;
        $limit = 10;

        if($obj['search_key1'] && $obj['search_value1']) $this->models['user']->like($obj['search_key1'],$obj['search_value1']);

        $staff = $this->models['user']->where("parent",$user['idx'])->get(array(
            "page" => $page,
            "limit" => $limit
        ));

        $data = [
            'pid' => 'employee',
            "jl" => $this->jl,
            "user" => $user,
            "staff" => $staff,
            "page" => $page,
        ];

        return render('app/employee', $data);
    }


    // 종합공정
    public function overall(): string
    {
        $data = [
            'pid' => 'overall',
        ];

        return render('app/overall', $data);
    }

    // 작업관리 > 계획공정표
    public function schedule(): string
    {
        $data = [
            'pid' => 'schedule',
        ];

        return render('app/schedule', $data);
    }

    // 작업관리 > 계획공정표 테스트
    public function scheduleTest(): string
    {
        $data = [
            'pid' => 'schedule',
        ];

        return render('app/schedule_test', $data);
    }

    // 작업관리 > 주간공정표
    public function scheduleWeekly(): string
    {
        $data = [
            'pid' => 'schedule_weekly',
        ];

        return render('app/schedule_weekly', $data);
    }

    // 작업관리 > 금주작업
    public function weekTask(): string
    {
        $data = [
            'pid' => 'week_task',
        ];

        return render('app/week_task', $data);
    }

    // 기성관리
    public function payment(): string
    {
        $data = [
            'pid' => 'payment',
        ];

        return render('app/payment', $data);
    }

    // 내역관리 > 수량산출서
    public function record(): string
    {
        $data = [
            'pid' => 'record',
        ];

        return render('app/record', $data);
    }

    // 내역관리 > 내역서
    public function invoice(): string
    {
        $data = [
            'pid' => 'invoice',
        ];

        return render('app/invoice', $data);
    }

    // 내역관리 > 단가목록표
    public function priceList(): string
    {
        $data = [
            'pid' => 'price_list',
        ];

        return render('app/price_list', $data);
    }

    // 계정관리
    public function account(): string
    {
        $data = [
            'pid' => 'account',
        ];

        return render('app/account', $data);
    }

    // 파일함
    public function filebox(): string
    {
        $data = [
            'pid' => 'filebox',
        ];

        return render('app/filebox', $data);
    }

}