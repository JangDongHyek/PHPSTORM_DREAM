<?php namespace App\Controllers;

use App\Libraries\Model;
use CodeIgniter\RESTful\ResourceController;
use App\Models\GmarketApiModel;
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

    public function checkAPI($OrderNo) {
        $data['api_method'] = "POST";
        $data['api_url'] = "https://sa2.esmplus.com/account/v1/settle/getsettleorder";
        $data['api_data'] = [];
        $data['api_type'] = GM;
        $time_start = date('Y-m-d', strtotime('-60Day'));
        $time_end = date('Y-m-d', strtotime('+1Day'));

        $data['api_data'] = [
            "SiteType" => "G",
            "ContrNo" => $OrderNo,
            "SrchType" => "D7",
            "SrchStartDate" => $time_start,
            "SrchEndDate" => $time_end,
            "PageNo" => 0,
            "PageRowCnt" => 0
        ];

        $apiModel = new GmarketApiModel();
        $result = $apiModel->checkOrder($data);

        var_dump($result);
    }

}
