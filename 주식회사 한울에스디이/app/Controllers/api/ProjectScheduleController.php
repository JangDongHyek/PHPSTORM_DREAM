<?php
namespace App\Controllers\api;

use App\Controllers\BaseController;
use App\Libraries\Jl;
use App\Libraries\JlModel;
use App\Libraries\JlFile;
use App\Libraries\JlService;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PHPUnit\Util\Exception;

class ProjectScheduleController extends BaseController
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

        if($method == "excel_down") $response = $this->excelDown();
        if($method == "excel_upload") $response = $this->excelUpload();


        $trace_list = array("excel_down","excel_upload");
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

    public function excelUpload() {
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

                    $block_model = new JlModel("project_block");
                    $floor_model = new JlModel("project_floor");
                    $area_model = new JlModel("project_area");

                    $block_name = $sheet->getCellByColumnAndRow(1, $currentRowIndex)->getValue();
                    $floor_name = $sheet->getCellByColumnAndRow(2, $currentRowIndex)->getValue();
                    $area_name = $sheet->getCellByColumnAndRow(3, $currentRowIndex)->getValue();
                    $start_date = $sheet->getCellByColumnAndRow(4, $currentRowIndex)->getValue();
                    $end_date = $sheet->getCellByColumnAndRow(5, $currentRowIndex)->getValue();
                    $work_days = $sheet->getCellByColumnAndRow(6, $currentRowIndex)->getValue();

                    if (is_numeric($start_date)) {
                        $start_date = Date::excelToDateTimeObject($start_date)->format('Y-m-d');
                    }
                    if (is_numeric($end_date)) {
                        $end_date = Date::excelToDateTimeObject($end_date)->format('Y-m-d');
                    }

                    if (!$start_date || $start_date == '0000-00-00') {
                        $this->service->error("시작일이 없거나 0000-00-00 이면 안됩니다.");
                    }
                    if (!$end_date || $end_date == '0000-00-00') {
                        $this->service->error("마감일이 없거나 0000-00-00 이면 안됩니다.");
                    }
                    if (!$work_days || $work_days == '0') {
                        $this->service->error("소요일이 없거나 0 이면 안됩니다.");
                    }

                    $block = $block_model->where("name",$block_name)->get();
                    if($block['count'] == 0) $this->service->error("존재하지 않는 동입니다.");
                    $block = $block['data'][0];

                    $floor = $floor_model->where("block_idx",$block['idx'])->where("name",$floor_name)->get();
                    if($floor['count'] == 0) $this->service->error("존재하지 않는 층입니다.");
                    $floor = $floor['data'][0];

                    $area = $area_model->where("block_idx",$block['idx'])->where("floor_idx",$floor['idx'])->where("name",$area_name)->get();
                    if($area['count'] == 0) $this->service->error("존재하지 않는 구역입니다.");
                    $area = $area['data'][0];

                    $data = array(
                        "project_idx" => $this->service->obj['project_idx'],
                        "block_idx" => $block['idx'],
                        "floor_idx" => $floor['idx'],
                        "area_idx" => $area['idx'],
                    );

                    $exists = $this->service->model->where($data)->get();
                    if($exists['count'] != 0) {
                        $data = $exists['data'][0];
                    }
                    $data['start_date'] = $start_date;
                    $data['end_date'] = $end_date;
                    $data['work_days'] = $work_days;


                    if($exists['count'] == 0) {
                        $this->service->model->insert($data);
                    }else {
                        $this->service->model->update($data);
                    }
                }
            }





            $response['success'] = true;
        } catch (\PhpOffice\PhpSpreadsheet\Reader\Exception $e) {
            $response['success'] = false;
            $response['message'] = "엑셀 파일을 읽는 도중 에러가 발생했습니다: " . $e->getMessage();
        }

        return $response;
    }

    public function excelDown() {
        $response = array(
            "success" => false,
            "message" => "실패"
        );



        try {
            $blocks = $this->service->get();

            if($blocks['count'] == 0) $this->service->error("구역 추가후 이용해주세요.");
            $blocks = $blocks['data'];

            foreach ($blocks as $block) {
                if(count($block['$floors']) == 0) $this->service->error("구역 데이터중에 층이없는 동이있습니다. 동마다 층은 최소 하나라도 있어야합니다.");

                foreach($block['$floors'] as $floor) {
                    if(count($floor['$areas']) == 0) $this->service->error("층 데이터중에 구역이 없는 층이 있습니다. 층마다 구역은 최소 하나라도 있어야합니다.");
                }
            }

            $schedule_model = new JlModel("project_schedule");
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();

            $headers = ['동', '층', '구역', '시작일','마감일','소요일'];
            $sheet->fromArray($headers, null, 'A1'); // A1부터 채움
            $row = 2;

            foreach ($blocks as $block) {

                foreach($block['$floors'] as $floor) {

                    foreach($floor['$areas'] as $area) {
                        $schedule_model->where("block_idx",$block['idx']);
                        $schedule_model->where("floor_idx",$floor['idx']);
                        $exists = $schedule_model->where("area_idx",$area['idx'])->get();

                        $data = [
                            'A' . $row => $block['name'],  // 동
                            'B' . $row => $floor['name'],  // 층
                            'C' . $row => $area['name'],   // 구역
                            'D' . $row => '0000-00-00',  // 시작일
                            'E' . $row => '0000-00-00',    // 마감일
                            'F' . $row => '0',   // 소요일
                        ];

                        if($exists['count'] != 0) {
                            $exists = $exists['data'][0];

                            $data['D'.$row] = $exists['start_date'];
                            $data['E'.$row] = $exists['end_date'];
                            $data['F'.$row] = $exists['work_days'];
                        }



                        foreach ($data as $cell => $value) {
                            $sheet->setCellValue($cell, $value);
                        }

                        $row++;
                    }
                }
            }

            $filename = 'hierarchical_data.xlsx';
            $writer = new Xlsx($spreadsheet);

            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="' . $filename . '"');
            header('Cache-Control: max-age=0');

            $writer->save('php://output');
            exit;
        } catch (\PhpOffice\PhpSpreadsheet\Reader\Exception $e) {
            $response['success'] = false;
            $response['message'] = $e->getMessage();
        }

        return $response;
    }

}