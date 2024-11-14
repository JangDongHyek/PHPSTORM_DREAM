<?php namespace App\Controllers;

use App\Libraries\Model;
use CodeIgniter\RESTful\ResourceController;
use App\Models\GmarketApiModel;
use Matrix\Exception;
use App\Libraries\JlModel;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx as XlsxWriter;

class CalculateAPIController extends ResourceController {
    public $api_response = array("message"=>"");

    public $model_config = array(
        "table" => "order_list",
        "primary" => "idx",
        "autoincrement" => true,
        "empty" => false
    );

    public function downloadExcel(){
        ob_start();

        // 스프레드시트 객체 생성
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // 엑셀 데이터 작성
        $sheet->setCellValue('A1', 'Header 1');
        $sheet->setCellValue('B1', 'Header 2');
        $sheet->setCellValue('A2', 'Data 1');
        $sheet->setCellValue('B2', 'Data 2');

        ob_end_clean();

        // 파일을 출력하기 위해 Writer 객체 생성
        $writer = new XlsxWriter($spreadsheet);

        // HTTP 헤더 설정
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="example.xlsx"');
        header('Cache-Control: max-age=0');

        // 파일 출력
        $writer->save('php://output');
        exit;
    }



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
