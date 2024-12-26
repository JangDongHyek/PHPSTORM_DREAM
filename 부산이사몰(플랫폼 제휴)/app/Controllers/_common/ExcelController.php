<?php

namespace App\Controllers\_common;

use App\Controllers\BaseController;
use App\Models\SmsModel;
use CodeIgniter\HTTP\ResponseInterface;
use PhpOffice\PhpSpreadsheet\IOFactory;
ini_set("memory_limit", "512M");
class ExcelController extends BaseController
{

    // 엑셀업로드
    // $file: 업로드된 엑셀파일
    // $excelRows: 읽어온 엑셀데이터
    public function uploadExcel(): ResponseInterface
    {
        $resultData = ['result'=>false, 'message' => '엑셀 업로드에 실패하였습니다.'];
        $file = $this->request->getFile('uploaded_file'); // input name
        $post = $this->request->getPost();
        $target = $post['target']; // 엑셀업로드 메뉴

        $spreadsheet = IOFactory::load($file);
        $sheet = $spreadsheet->getActiveSheet();
        $excelRows = $sheet->toArray();

        $response = (new SmsModel())->updateExcel($excelRows);

        if($response) {
            $resultData['result'] = true;
            $resultData['message'] = '';
        }

        return $this->response->setJSON($resultData);
    }
}