<?php

namespace App\Controllers\adm;

use App\Controllers\BaseController;
use App\Models\EstimateModel;

class AEstimateController extends BaseController
{
    // 견적신청관리
    public function estimate(): string
    {
        $get = $this->request->getGet();

        $param = [
            'page' => $get['page'] ?? 1,
            'state' => $get['state'] ?? '', // 승인 상태
            'dtRange' => $get['dtRange'] ?? '', // 전체 , 오늘, 이번주, 이번달
            'sdt' => $get['sdt'] ?? '', //시작일
            'edt' => $get['edt'] ?? '', //끝일
            'dateType' => $get['dateType'] ?? '', // 날짜구분
        ];

        $resultData = (new EstimateModel())->getAEstimateList($param);

        $data = array_merge($resultData,[
            'pid' => 'adm_estimate',
            'isAdmPage' => true,
            'dtRange' => $get['dtRange'] ?? '',
            'sfl' => $get['sfl'] ?? '',
            'dataType' => $get['dataType'] ?? '',
            'sdt' => $get['sdt'] ?? '', //시작일
            'edt' => $get['edt'] ?? '', //끝일
            'param' => $param,
        ]);

        return render('adm/estimate/estimate', $data);
    }
}