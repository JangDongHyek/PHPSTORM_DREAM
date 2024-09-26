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
    public $model;
    public $jl_response = array("message" => ""); // BaseController 내 response 란 객체가 존재해 변수명 변경

    public function __construct() {
        $this->model = new JlModel(array("table" => "user"));
    }

    public function test(){
        $_method = $this->request->getPost('_method');

        $this->model->insert(array(
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
            case "logout" : {
                $this->logout();
                break;
            }
        }
    }

    public function get() {
        $obj = $this->model->jsonDecode($this->request->getPost('obj'));

        $obj['user_pw'] = md5($obj['user_pw']);

        $user = $this->model->where($obj)->get()['data'][0];

        if(!$user) $this->model->error("맞는 회원 정보가 없습니다.");

        $session = session();
        $session->set(array(
            "user" => $user
        ));


        $this->jl_response['success'] = true;
        echo json_encode($this->jl_response);
    }

    public function insert() {
        $obj = $this->model->jsonDecode($this->request->getPost('obj'));

        $data = $this->model->where("user_id",$obj['user_id'])->get()['data'][0];

        if($data) $this->model->error("이미 사용하고있는 아이디입니다.");

        $obj['user_pw'] = md5($obj['user_pw']);

        $this->model->insert($obj);
        $this->jl_response['obj'] = $obj;
        $this->jl_response['success'] = true;
        echo json_encode($this->jl_response);



    }

    public function update() {

    }

    public function delete() {

    }

    public function logout() {
        $session = session();

        $session->remove('user');

        return redirect()->to('login');
    }
}