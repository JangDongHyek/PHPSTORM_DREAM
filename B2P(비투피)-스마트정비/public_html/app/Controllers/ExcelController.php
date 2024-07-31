<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\GmAc\GoodsModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ExcelController extends BaseController {
    public function download($encodedPath = null) {
        $path = base64_decode($encodedPath);
        $filePath = WRITEPATH . "uploads/".$path;

        if (file_exists($filePath)) {
            $fileName  = $path;
            $tempFileName = explode("/",$filePath);
            if(is_array($tempFileName)){
                $fileName = end($tempFileName);
            }
            return $this->response->download($filePath, null)->setFileName($fileName);

        } else {
            return redirect()->back()->with('error', 'File not found');
        }
    }

    public function upload()
    {
        $excelType = $this->data['excelType'];
        $file = $this->request->getFile('excelFileInput');

        if ($file->isValid() && !$file->hasMoved()) {
            if ($excelType == "goodsExcel") {
                $uploadPath = WRITEPATH . 'uploads/goods/';
                $ext = $file->getClientExtension();
                if (!$ext) {
                    $ext = 'xls';
                }
                $mb_id = $this->data['member']['mb_id'];
                $originalName = $mb_id . "_" . get_uniqid(false, false, 30) . "." . $ext;
                $file->move($uploadPath, $originalName);

                // 큐에 작업 추가
                $this->addToQueue($uploadPath . $originalName, $mb_id);

                session()->setFlashdata('msg', '파일이 업로드되었으며 순차적으로 처리될 예정입니다.');
            }

            return redirect()->to("/goods/upload");
        } else {
            session()->setFlashdata('msg', '업로드에 실패하였습니다.');
        }

        return redirect()->back();
    }

    private function addToQueue($filePath, $mb_id){
        $filePath = sql_real_escape_string($filePath);
        $sql = "insert into `excel_queue` set `mb_id` = '{$mb_id}',
            `file_path` = '{$filePath}',
            `status` = 'pending'";
        sql_query($sql);
    }
}
