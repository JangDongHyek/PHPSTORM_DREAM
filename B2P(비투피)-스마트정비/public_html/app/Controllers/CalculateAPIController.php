<?php namespace App\Controllers;

use App\Libraries\Model;
use CodeIgniter\RESTful\ResourceController;
use Matrix\Exception;

class CalculateAPIController extends ResourceController {
    public $api_response = array("message"=>"");

    public $model_config = array(
        "table" => "order_list",
        "primary" => "idx",
        "autoincrement" => true,
        "empty" => false
    );



    public function getData() {
        try {
            $model = new Model($this->model_config);
            $obj = $model->jsonDecode($_POST['obj']);

            //필터 가공
            foreach ($obj as $key => $value) {
                if(strpos($key,"primary") !== false) $obj[$model->primary] = $value;
                //if(strpos($key,"search_key") !== false) $column = $value;
                //if(strpos($key,"search_value") !== false) $obj[$column] = $value;
            }
            if($obj['s_date']) {
                $model->between("OrderDate",$obj['s_date'],$obj['e_date']);
            }
            if($obj['search_key'] && $obj['search_value']) {
                $model->like($obj['search_key'],$obj['search_value']);
            }

            $model->where($obj);

            $object = $model->get($obj["page"], $obj["limit"]);
            $this->api_response['sql'] = $model->getSql();
            $this->api_response['success'] = true;
            $this->api_response['response'] = $object;
            $this->api_response['filter'] = $obj;
        }catch (Exception $e) {
            $this->api_response['success'] = false;
            $this->api_response['message'] = $e->getMessage();
        }


        return $this->respond($this->api_response);
    }

}
