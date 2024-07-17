<?php
/**
 * 관리자 상품관리
 * @property CategoryModel $CategoryModel
 */
class AddOptionController extends CI_Controller
{
    public $response = array("message" => "");

    public function __construct()
    {
        parent::__construct();
        $this->load->model('AddOptionModel');
    }

    public function postData() {
        try {
            $obj = str_replace('\\','',$this->input->post("obj"));
            $obj = json_decode($obj,true);

            $result = $this->AddOptionModel->postData($obj);

            $this->response['response'] = $obj;
            $this->response['success'] = $result;

        }catch (Exception $e) {
            $this->response['success'] = false;
            $this->response['message'] = $e->getMessage();
        }


        echo json_encode($this->response);
    }

    public function putData() {
        try {
            $obj = str_replace('\\','',$this->input->post("obj"));
            $obj = json_decode($obj,true);

            $result = $this->AddOptionModel->putData($obj);

            $this->response['data'] = $obj;
            $this->response['success'] = $result;

        }catch (Exception $e) {
            $this->response['success'] = false;
            $this->response['message'] = $e->getMessage();
        }


        echo json_encode($this->response);
    }

    public function getData() {
        try {
            $filter = str_replace('\\','',$this->input->post("filter"));
            $filter = json_decode($filter,true);

            $data = $this->AddOptionModel->getsData($filter);

            $this->response['data'] = $data;
            $this->response['success'] = true;

        }catch (Exception $e) {
            $this->response['success'] = false;
            $this->response['message'] = $e->getMessage();
        }


        echo json_encode($this->response);
    }

    public function deleteData() {
        try {
            $data = $this->AddOptionModel->deleteData(array(
                "idx" => $this->input->post("idx")
            ));

            $this->response['data'] = $data;
            $this->response['success'] = true;

        }catch (Exception $e) {
            $this->response['success'] = false;
            $this->response['message'] = $e->getMessage();
        }


        echo json_encode($this->response);
    }

}
