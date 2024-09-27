<?php
namespace App\Libraries;

namespace App\Controllers\app;
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

    public function __construct() {
        $this->models['user'] = new JlModel(array("table" => "user"));
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
    }

    public function insert() {
        $obj = $this->models['user']->jsonDecode($this->request->getPost('obj'));

        $data = $this->models['user']->where("user_id",$obj['user_id'])->get()['data'][0];

        if($data) $this->models['user']->error("이미 사용하고있는 아이디입니다.");

        $obj['user_pw'] = password_hash($obj['user_pw'],PASSWORD_DEFAULT);

        $this->models['user']->insert($obj);
        $this->jl_response['obj'] = $obj;
        $this->jl_response['success'] = true;
        echo json_encode($this->jl_response);



    }

    public function update() {
        $obj = $this->models['user']->jsonDecode($this->request->getPost('obj'));

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


        $this->jl_response['success'] = true;
        echo json_encode($this->jl_response);
    }

    public function logout() {
        $session = session();

        $session->remove('user');
        $session->remove('admin');

        return redirect()->to('login');
    }
}