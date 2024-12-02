<?php
namespace App\Libraries;

namespace App\Controllers\api;
use App\Controllers\BaseController;

use App\Libraries\Jl;
use App\Libraries\JlModel;

/*
 주의사항
 use Exception 을 하는순간 try catch 문 작동 안합니다.
 */

class UserController extends BaseController
{
    public $models = [];
    public $jl_response = array("message" => ""); // BaseController 내 response 란 객체가 존재해 변수명 변경
    public $join_table = '';
    public $get_tables = [];

    public function __construct() {
        $this->models['user'] = new JlModel(array("table" => "user"));
        $this->models['project_base'] = new JlModel(array("table" => "project_base"));
        //array_push($this->get_tables,array("table"=> "exam", "get_key" => "exam_key" ));
    }

    public function test(){
        $_method = $this->request->getPost('_method');

        $this->models['user']->insert(array(
            "user_type" => "ss",
            "user_id" => "ss",
            "user_pw" => "",
            "company_name" => "ss",
            "company_owner" => "ss",
            "company_person" => "ss",
            "company_person_phone" => "ss",
        ));


    }

    public function method() {
        $_method = $this->request->getPost('_method');

        switch (strtolower($_method)) {
            case "get" : {
                $this->get();
                break;
            }
            case "insert" : {
                $this->insert();
                break;
            }
            case "update" : {
                $this->update();
                break;
            }
            case "delete" : {
                $this->delete();
                break;
            }

            case "login" : {
                $this->login();
                break;
            }

            case "logout" : {
                $this->logout();
                break;
            }
        }
    }

    public function get() {
        $obj = $this->models['user']->jsonDecode($this->request->getPost('obj'));

        //필터링
        if($obj['primary']) $obj[$this->models['user']->primary] = $obj['primary'];
        if($obj['search_key1'] && $obj['search_value1_1'] && $obj['search_value1_2'] == "") $this->models['user']->where($obj['search_key1'],$obj['search_value1_1']);
        if($obj['search_key1'] && $obj['search_value1_1'] && $obj['search_value1_2']) $this->models['user']->between($obj['search_key1'],$obj['search_value1_1'],$obj['search_value1_2']);
        if($obj['search_like_key1'] && $obj['search_like_value1']) $this->models['user']->like($obj['search_like_key1'],$obj['search_like_value1']);
        if($obj['order_by_desc']) $this->models['user']->orderBy($obj['order_by_desc'],"DESC");
        if($obj['order_by_asc']) $this->models['user']->orderBy($obj['order_by_asc'],"ASC");
        if($obj['not_key1'] && $obj['not_value1']) $this->models['user']->where($obj['not_key1'],$obj['not_value1'],"AND NOT");
        if($obj['in_key1'] && $obj['in_value1']) $this->models['user']->in($obj['in_key1'],$this->models['user']->jsonDecode($obj['in_value1']));
        if($obj['like_key'] && $obj['like_value']) $this->models['user']->like($obj['like_key'],$obj['like_value']);

        //join
        if ($this->join_table) {
            $this->models['user']->join($this->join_table,"origin_key","join_key");
            // 조인 필터링
            //$model->where("join_column","value","AND",$join_table);
            //$model->between("join_column","start","end","AND",$join_table);
            //$model->in("join_column",array("value1","value2"),"AND",$join_table);
            //$model->like("join_column","value","AND",$join_table);
        }

        $object = $this->models['user']->where($obj)->get(array(
            "page" => $obj['page'],
            "limit" => $obj['limit'],
            //"source" => "joinTable",
            //"select" => "joinTable.SearchColumn AS alias",
            "sql" => true
        ));

        //getKey ex) 고유키로 필요한 테이블데이터를 조인대신 한번 더 조회해서 가져오는형식 속도는 join이랑 비슷하거나 빠름
        foreach($this->get_tables as $index => $info) {
            $joinModel = new JlModel(array(
                "table" => $info['table'],
            ));

            foreach ($object["data"] as $index => $data) {
                $joinModel->where($joinModel->primary, $data[$info['get_key']]);
                $join_data = $joinModel->get()['data'][0];

                //Join시 변수명은 무조건 대문자로 진행 데이터 업데이트시 문제발생함 대문자 필드 삭제 처리는 JS에 있음
                $object["data"][$index][strtoupper($info['table'])] = $join_data;
            }
        }

        $this->jl_response['data'] = $object['data'];
        $this->jl_response['count'] = $object['count'];
        $this->jl_response['filter'] = $object['filter'];
        $this->jl_response['obj'] = $obj;
        $this->jl_response['success'] = true;
        echo json_encode($this->jl_response);
    }

    public function insert() {
        $obj = $this->models['user']->jsonDecode($this->request->getPost('obj'));

        $data = $this->models['user']->where("user_id",$obj['user_id'])->get()['data'][0];

        if($data) $this->models['user']->error("이미 사용하고있는 아이디입니다.");

        $obj['user_pw'] = password_hash($obj['user_pw'],PASSWORD_DEFAULT);
        if($obj['change_user_pw']) $obj['user_pw'] = password_hash($obj['change_user_pw'],PASSWORD_DEFAULT);


        $this->models['user']->insert($obj);
        $this->jl_response['obj'] = $obj;
        $this->jl_response['success'] = true;
        echo json_encode($this->jl_response);



    }

    public function update() {
        $obj = $this->models['user']->jsonDecode($this->request->getPost('obj'));

        if($obj['change_user_pw']) $obj['user_pw'] = password_hash($obj['change_user_pw'],PASSWORD_DEFAULT);

        $this->models['user']->update($obj);
        $this->jl_response['success'] = true;
        echo json_encode($this->jl_response);
    }

    public function delete() {

    }

    public function login() {
        $obj = $this->models['user']->jsonDecode($this->request->getPost('obj'));

        //$obj['user_pw'] = password_hash($obj['user_pw'],PASSWORD_DEFAULT);

        $user = $this->models['user']->where('user_id',$obj['user_id'])->get()['data'][0];

        if(!$user) $this->models['user']->error("일치하는 회원 정보가 없습니다.");
        else {
            if (!password_verify($obj['user_pw'], $user['user_pw'])) $this->models['user']->error("일치하는 회원 정보가 없습니다.");
        }

        if(!$user['allow']) $this->models['user']->error("승인 대기중인 회원입니다.");

        //유저 세션 생성
        $session = session();
        $session->set(array(
            "user" => $user
        ));
        $this->jl_response['admin'] = false;

        //관리자 세션 생성
        if($user['level'] <= 0) {
            $session->set(array(
                "admin" => $user
            ));
            $this->jl_response['admin'] = true;
        }

        // 사이트 회원일때
        if($user['level'] == "5") {
            $this->models['project_base']->where('user_idx',$user['idx']);

        }
        // 회원의 관리자일때
        else if($user['level'] == "10") {
            $this->models['project_base']->where('user_idx',$user['parent']);
        }
        // 회원의 직원일때
        else if($user['level'] == "15") {
            $this->models['project_base']->where('person_idx',$user['idx']);
        }
        // 회원의 직원의 프로젝트 담당자
        else if($user['level'] == "20") {
            $this->models['project_base']->where('idx',$user['project']);
        }

        $projects = $this->models['project_base']->get();
        $project = $projects['data'][0];

        $session->set(array(
            "projects" => $projects,
            "project" => $project
        ));

        $this->jl_response['success'] = true;
        echo json_encode($this->jl_response);
    }

    public function logout() {
        $session = session();

        $session->remove('user');
        $session->remove('admin');
        $session->remove('project');

        return redirect()->to('login');
    }
}