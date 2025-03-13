<?php
namespace App\Controllers\api;

use App\Controllers\BaseController;
use App\Libraries\Jl;
use App\Libraries\JlModel;
use App\Libraries\JlFile;
use App\Libraries\JlService;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Shared\Date;
class ProjectPriceController extends BaseController
{
    private $service;

    public function __construct() {
        $this->service = new JlService($_POST,$_FILES,$_SESSION);
    }

    public function method() {
        $method = $this->service->POST['_method'];

        $token = $this->service->session_model->where(array("client_ip" => $this->service->getClientIP(),"name" => "token"))->get()['data'][0];

        if(!$this->service->obj['jl_token']) $this->service->error("잘못된 접근입니다.");
        if(!$token) $this->service->error("토큰 세션이 없습니다.");
        if($token['content'] != $this->service->obj['jl_token']) $this->service->error("토큰 값이 서로 다릅니다.");


        $response = array(
            "success" => false,
            "message" => "_method가 존재하지않습니다."
        );

        if($method == "excel") $response = $this->excel();


        $trace_list = array("excel");
        if(in_array($method,$trace_list) && $response['trace']) {
            $object = array(
                "method" => $method,
                "response" => $response,
                "sessions" => $this->SESSION
            );
            $this->service->sessionTrace($object);
        }

        echo $this->service->jsonEncode($response);
    }

    public function excel() {
        if(!count($_FILES)) $this->service->error("파일이없습니다.");

        $file = $_FILES['upfile']['tmp_name'];

        $response = array(
            "success" => false,
            "message" => "실패"
        );

        try {
            // PHPSpreadsheet 네임스페이스 로드
            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file);

            foreach ($spreadsheet->getSheetNames() as $sheetIndex => $sheetName) {
                $sheet = $spreadsheet->getSheet($sheetIndex);
                $sheetName = $sheet->getTitle();

                // 데이터 읽기
                foreach ($sheet->getRowIterator() as $row) {
                    $currentRowIndex = $row->getRowIndex();
                    if($currentRowIndex == 1) continue;

                    $name = $sheet->getCellByColumnAndRow(2, $currentRowIndex)->getValue(); // B열 (2번째 열)
                    $standard = $sheet->getCellByColumnAndRow(3, $currentRowIndex)->getValue(); // C열 (3번째 열)
                    $material = $sheet->getCellByColumnAndRow(6, $currentRowIndex)->getValue(); // F열 (6번째 열)
                    $labour = $sheet->getCellByColumnAndRow(8, $currentRowIndex)->getValue(); // H열 (8번째 열)
                    $expense = $sheet->getCellByColumnAndRow(10, $currentRowIndex)->getValue(); // J열 (10번째 열)


                    if(!$name) continue;
                    if(!$standard) continue;



                    $material = $material ? $material : 0;
                    $labour = $labour ? $labour : 0;
                    $expense = $expense ? $expense : 0;

                    $data = array(
                        "project_idx" => $this->service->obj['project_idx'],
                        "category" => $sheetName,
                        "types" => "단가",
                        "name" => $name,
                        "standard" => $standard,
                        "material" => $material,
                        "labour" => $labour,
                        "expense" => $expense,
                        "contents" => "[]",
                    );


                    $this->service->model->insert($data);
                }
            }





            $response['success'] = true;
        } catch (\PhpOffice\PhpSpreadsheet\Reader\Exception $e) {
            $response['success'] = false;
            $response['message'] = "엑셀 파일을 읽는 도중 에러가 발생했습니다: " . $e->getMessage();
        }

        return $response;
    }

}