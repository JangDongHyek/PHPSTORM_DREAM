<?php
/**
 * 관리자 상품관리
 * @property CategoryModel $CategoryModel
 */
class CategoryController extends CI_Controller
{
    public $response = array("message" => "");

    public function __construct()
    {
        parent::__construct();
        $this->load->model('CategoryModel');
    }

    public function postData() {
        try {
            $obj = str_replace('\\','',$this->input->post("obj"));
            $obj = json_decode($obj,true);

            $result = $this->CategoryModel->postData($obj);

            $this->response['data'] = $obj;
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

            $result = $this->CategoryModel->putData($obj);

            $this->response['data'] = $obj;
            $this->response['success'] = $result;

        }catch (Exception $e) {
            $this->response['success'] = false;
            $this->response['message'] = $e->getMessage();
        }


        echo json_encode($this->response);
    }

    public function getsData() {
        try {
            $filter = str_replace('\\','',$this->input->post("filter"));
            $filter = json_decode($filter,true);

            $filter["parent_idx"] = "";
            if($_POST["visible"]) $filter["visible"] = $_POST["visible"];

            $datas = $this->CategoryModel->getsData(array("parent_idx" => ""),$filter);

            foreach ($datas as $index => $data) {
                $data->childs = $this->CategoryModel->getsData(array(
                    "parent_idx" => $data->idx
                ));
            }

            $this->response['datas'] = $datas;
            $this->response['success'] = true;

        }catch (Exception $e) {
            $this->response['success'] = false;
            $this->response['message'] = $e->getMessage();
        }


        echo json_encode($this->response);
    }

    public function getData() {
        try {
            $data = $this->CategoryModel->getsData(array(
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

    public function deleteData() {
        try {
            $data = $this->CategoryModel->deleteData(array(
                "idx" => $this->input->post("idx")
            ));

            $data = $this->CategoryModel->deleteData(array(
                "parent_idx" => $this->input->post("idx")
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
